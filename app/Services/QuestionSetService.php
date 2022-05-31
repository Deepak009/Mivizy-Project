<?php

namespace App\Services;

use App\Models\QuestionSet;

class QuestionSetService
{
    protected $model;

    /**
     * Constructor function
     *
     * @param User           $model
     */
    public function __construct(QuestionSet $model)
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
}
