<?php
namespace App\Services;

use DB;

use App\Models\User;
use App\Models\DietChartTemplate;

class DietChartTemplateService
{
    protected $model;

    public function __construct(DietChartTemplate $model)
    {
        $this->model = $model;
    }

    public function get($dieticianId, $with=[])
    {
        return $this->model->whereDieticianId($dieticianId)->with($with)->latest()->get();
    }

    public function store(array $payload)
    {
        return $this->model->create($payload);
    }

    public function associateMassItems(DietChartTemplate $chart, array $items)
    {
        return $chart->dietChartItems()->createMany($items);
    }
}
