<?php

namespace App\Services;

use App\Models\Banner;
use App\Models\OPDCategory;
use Illuminate\Support\Facades\File;

class BannerService
{ 
    protected $model;
    protected $OPDCategoryModel;

    /**
     * Constructor function
     *
     * @param Banner  $model
     */
    public function __construct(Banner $model, OPDCategory $OPDCategory)
    {
        $this->model = $model;
        $this->OPDCategoryModel = $OPDCategory;
        
    }

    /**
     * Model create method
     *
     * @param array $payload
     * @return Model
     */
    public function create(array $payload)
    {
        return $this->model->create($payload);
    }
    /**
     * Model update method
     *
     * @return Model
     */
    public function update($model, $payload)
    {
        $model->fill($payload->only(['description', 'order']));
        $model->save();

        if($payload->image) {
           $path = $payload->image->store('public/banners');

           $oldPath = $model->image->path;

           // need to move to image service

           if(File::exists($oldPath))
                File::delete($oldPath);

           $model->image()->update([
               'path' => $path,
               'filename' => $payload->image->getClientOriginalName(),
               'mime_type' => $payload->image->getMimeType(),
               'size_in_bytes' => $payload->image->getSize(),
           ]);
        }
        return $model;
    }
    /**
     * This function find the Model
     *
     * @param $id
     * @return Model
     */
    public function find($id)
    {
        return $this->model->find( $id);
    }

    /* This function is used to delete the model permanently
     *
     * @param int $id
     */
    public function delete($id)
    {
        $this->find($id)->delete();
    }

    public function get()
    {
        return $this->model->with(['image'])->get();
    }


    public function getallCats()
    {
        return $this->OPDCategoryModel->all();
    }

}
