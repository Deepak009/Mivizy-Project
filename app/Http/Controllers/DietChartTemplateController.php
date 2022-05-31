<?php

namespace App\Http\Controllers;

use App\Http\Requests\DietChartTemplateRequest;
use App\Services\DietChartTemplateService;
use Illuminate\Http\Request;

class DietChartTemplateController extends Controller
{
    protected $service;


    public function __construct(DietChartTemplateService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->get(auth()->user()->id, ['dietChartTemplateItems.food.image']);
    }

    public function store(DietChartTemplateRequest $request)
    {
        $payload = $request->only(['remarks', 'valid_from', 'valid_upto', 'name']);

        $payload['dietician_id'] = auth()->id();

        $template = $this->service->store($payload);

        $items = collect($request->diet_chart_items)->map(function ($item) {
            return collect($item)->only(['slot', 'day_of_week', 'food_id', 'description']);
        })->toArray();

        $this->service->associateMassItems($template, $items);

        return $template;
    }
}
