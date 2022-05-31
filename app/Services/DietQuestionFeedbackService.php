<?php

namespace App\Services;

use App\Models\User;
use App\Models\DietQuestionFeedback;

class DietQuestionFeedbackService
{
    protected $model;

    /**
     * Constructor function
     *
     * @param DietQuestionFeedback           $model
     */
    public function __construct(DietQuestionFeedback $model)
    {
        $this->model = $model;
    }

    /**
     * Find the user by country_code and phone_number
     *
     * @param string           $country_code
     * @param string           $phone_number
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
	 * Model create method
	 *
	 * @param array $data
	 * @return Model
	 */
	public function create(array $data, User $user)
	{
		$model= new $this->model;
		$model->fill($data);
        $model->user()->associate($user);
		$model->save();
		return $model;
	}

    public function get(array $options=null,User $user)
    {
        return $this->model->with(['user', 'dietChart'])
            ->search($options)
            ->sort($options)
            ->when($user->isDietician, function($q) use($user) {
                $q->whereDoesntHave('dietChart')
                ->orWhereHas('dietChart', function($q) use($user){
                    $q->where('dietician_id', $user->id);
                });
            })
            ->paginate($options['itemsPerPage'] ?? 100);
    }

}
