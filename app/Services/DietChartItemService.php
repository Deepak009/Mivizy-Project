<?php
namespace App\Services;

use App\Models\User;
use App\Models\DietChartItem;

class DietChartItemService
{
    protected $model;

    /**
     * Constructor function
     *
     */
    public function __construct(DietChartItem $model)
    {
        $this->model = $model;
    }

    public function save(array $condition, array $payload)
    {
        return $this->model->updateOrCreate($condition, $payload);
    }

    public function destroy(int $id, int $dietChartId)
    {
        return $this->model->where('id', $id)->where('diet_chart_id', $dietChartId)->delete();
    }

}
