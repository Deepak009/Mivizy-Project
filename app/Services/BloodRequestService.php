<?php

namespace App\Services;

use App\Models\BloodRequest;

class BloodRequestService
{
    protected $model;

    /**
     * Constructor function
     *
     * @param BloodRequest  $model
     */
    public function __construct(BloodRequest $model)
    {
        $this->model = $model;
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
	 * This function find the Model included the deleted
	 *
	 * @param $id
	 * @return Model
	 */
	public function find($id)
	{
		return $this->model->where('id', $id);
	}

    /* This function is used to delete the model permanently
	 *
	 * @param int $id
	 */
	public function delete($id)
	{
		$this->find($id)->delete();
	}

	public function get(array $options=null)
    {
        return $this->model
            ->search($options)
            ->sort($options)
			->filterByUserId($options['user_id'] ?? null)
			->with('user')
            ->paginate($options['itemsPerPage'] ?? 100);
    }
}
