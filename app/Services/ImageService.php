<?php

namespace App\Services;

use App\Models\Image;

class ImageService
{
    protected $model;

    /**
     * Constructor function
     *
     * @param Image  $model
     */
    public function __construct(Image $model)
    {
        $this->model = $model;
    }

     /**
     * Find the data by id
     *
     * @param int $id
     *
     */
    public function findBy($id)
    {
        return $this->model
                    ->where('id',$id)
                    ->first();
    }

    /**
	 * Model create method
	 *
	 * @param array $payload
	 * @return Model
	 */
	public function create(array $payload)
	{
		$model= new $this->model;
		$model->fill($payload);
		$model->save();
		return $model;
	}

	/**
	 * Model update method
	 *
	 * @param array $payload
	 * @return Model
	 */
	public function update($model, array $payload)
	{
		$model->fill($payload);
		$model->save();
		return $model;
	}

	/**
	 * This function find the Model included the deleted one if $findWithTrashed = true.
	 *
	 * @param $id
	 * @param Boolean $findWithTrashed
	 * @return Model
	 */
	public function find($id, $findWithTrashed = false)
	{
		$model = $this->model->where('id', $id);
		if($findWithTrashed)
		{
			$model = $model->withTrashed();
		}
		$model = $model->first();
		if(!$model){
			return false;
		}
		return $model;
	}

	/**
	 * This function will return the collectiob of the Model included the deleted one if $findWithTrashed = true.
	 *
	 * @param Boolean $findWithTrashed
	 * @return Collection Model
	 */
	public function all($findWithTrashed = false)
	{
		$models = $this->model;
		if($findWithTrashed)
		{
			$models = $models->withTrashed();
		}
		$models = $models->get();
		return $models;
	}

    /* This function is used to delete the model permanently
	 *
	 * @param Model $model
	 */
	public function delete($model)
	{
		$model->delete();
	}


}
