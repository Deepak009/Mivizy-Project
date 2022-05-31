<?php

namespace App\Services;

use App\Models\OPDCategory;

class OPDCategoryService
{
    protected $model;

    /**
     * Constructor function
     *
     * @param OPDCategory  $model
     */
    public function __construct(OPDCategory $model)
    {
        $this->model = $model;
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
}
