<?php

namespace App\Services;

use App\Models\OPDSchedule;

class OPDScheduleService
{
    protected $model;

    /**
     * Constructor function
     *
     * @param OPDSchedule  $model
     */
    public function __construct(OPDSchedule $model)
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
			->filterByOPDCategoryId($options['opd_category_id'] ?? null)
			->with('OPDCategory')
			->filterByDays($options['days'] ?? [])
            ->paginate($options['itemsPerPage'] ?? 100);
    }
}
