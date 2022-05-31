<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DietChart;
use App\Services\DietChartItemService;
use App\Services\DietChartService;
use Illuminate\Http\Request;

class DietChartController extends Controller
{
    protected $service;

    protected $itemService;

    public function __construct(DietChartService $service, DietChartItemService $itemService) {
        $this->service = $service;
        $this->itemService = $itemService;
    }

    public function getByFeedbackId($feedback)
    {
        return $this->service->findByFeedbackId($feedback);
    }

    public function save(Request $request)
    {
        $payload = $request->only(['remarks', 'valid_from', 'valid_upto']);
        $condition = $request->only(['diet_question_feedback_id', 'id']);

        $payload['dietician_id'] = auth()->id();

        $chart = $this->service->save($condition, $payload);
        if($chart->wasRecentlyCreated && $request->diet_chart_items && count($request->diet_chart_items)) {
            $items = collect($request->diet_chart_items)->map(function($item) {
                return collect($item)->only(['slot', 'day_of_week', 'food_id', 'description']);
            })->toArray();

            $this->service->associateMassItems($chart, $items);
        }

        return $chart;
    }

    public function updateItem(Request $request)
    {
        $condition = $request->only(['diet_chart_id', 'slot', 'day_of_week', 'food_id']);

        return $this->itemService->save($condition, $request->only('description'));
    }

    public function deleteItem(int $chart, int $item)
    {
        return $this->itemService->destroy($item, $chart);
    }
}
