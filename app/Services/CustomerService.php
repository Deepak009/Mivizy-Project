<?php

namespace App\Services;

use DB;
use Exception;

use App\Models\Customer;
use App\Services\UserService;

class CustomerService
{
    protected $model;

    /**
     * Constructor function
     *
     * @param Customer  $model
     */
    public function __construct(Customer $model)
    {
        $this->model = $model;
        $this->user_service = app(UserService::class);
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
        try{
            DB::beginTransaction();
            $user = $this->user_service->create($payload);
            $model = new $this->model;
            // filter out the allowable payload
            $payload = collect($payload);
            $payload = $payload->only($this->model->getFillable())->toArray();
            $model->fill($payload);
            $model->user()->associate($user);
            $model->save();
        }catch(Exception $e){
            DB::rollback();
            throw $e;
        }
        DB::commit();
		return $model;
	}

    /**
     * Model update method
     *
     * @param Model $model
     * @return Model
     */
	public function update($model, array $payload)
	{
        try {
            $this->user_service->update($model->user_id, $payload);
            // filter out the allowable payload
            $payload = collect($payload);
            $payload = $payload->only($this->model->getFillable())->toArray();
            $model->fill($payload);
            $model->save();
            $model->refresh();
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
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
		return $this->model->find($id);
	}

    /**
     * This function find by external app id the Model
     *
     * @param $external_app_id
     * @return Model
     */
    public function findByExternalAppId($external_app_id)
    {
        return $this->model->whereExternalAppId($external_app_id)->first();
    }


	/**
	 * This function will return the collection of the Model
	 *
	 * @return Collection Model
	 */
	public function all()
	{
		return $this->model->all();
	}

    /* This function is used to delete the model permanently
	 *
	 * @param Model $model
	 */
	public function delete($model)
	{
        try {
            $model->user->forceDelete();
            $model->delete();
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return;
	}

    public function get(array $options=null)
    {
        return $this->model->with(['user'])
            ->search($options)
            ->sort($options)
            ->paginate($options['itemsPerPage'] ?? 100);
    }
}
