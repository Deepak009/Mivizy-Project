<?php
namespace App\Services;

use DB;

use App\Models\User;
use App\Models\DietChart;

class DietChartService
{
    protected $model;

    /**
     * Constructor function
     *
     */
    public function __construct(DietChart $model)
    {
        $this->model = $model;
    }

    public function getUserActiveDietChart(User $user)
	{

		$diet_chart_details =  $this->model->filterByUser($user)
                                ->where('valid_from', '<=',date('Y-m-d'))
                                ->where('valid_upto', '>=',date('Y-m-d'))
                                ->with('dietChartItems.food.image')
                                ->latest()
                                ->first();
        return $diet_chart_details;
	}

    public function save(array $condition, array $payload)
    {
        return $this->model->updateOrCreate($condition, $payload);
    }

    public function findByFeedbackId(int $feedbackId)
    {
        return $this->model
            ->where(['diet_question_feedback_id' => $feedbackId])
            ->with('dietChartItems.food.image')
            ->latest()
            ->first();
    }

    public function associateMassItems(DietChart $chart, array $items)
    {
        return $chart->dietChartItems()->createMany($items);
    }
}
