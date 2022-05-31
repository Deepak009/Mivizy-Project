<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\DietChartService;

class DietChartController extends Controller
{
    /**
     * Constructor function
     *
     * @param DietChartService           $service
     */
    public function __construct(DietChartService $service)
    {
        $this->service = $service;
    }

    public function get(Request $request){
        try{
            $user = auth()->user();
            $diet_chart = $this->service->getUserActiveDietChart($user);
            if(empty($diet_chart)){
                return response()->json([
                    'message' => 'Diet Charts is not available yet.',
                ], 204);
            }
            $diet_chart_items = $diet_chart->dietChartItems ?? [];
            $diet_chart_items = $diet_chart_items->groupBy('day_of_week');
            $diet_chart_details = [];
            foreach(DAYS as $day_index => $day){
                $day_data = [
                    "day" => $day,
                    "slots" => []
                ];
                $items = collect($diet_chart_items[$day_index] ?? [])->groupBy('slot');
                foreach(SLOTS as $slot_index => $slot){
                    $day_data["slots"][] = [
                        "slot" => $slot,
                        "foods" => $items[$slot_index] ?? []
                    ];
                }
                $diet_chart_details[] = $day_data;
            }
            $diet_chart = [
                "remarks" => $diet_chart->remarks,
                "dietician_name" => optional($diet_chart->dietician)->name,
                "valid_from" => $diet_chart->valid_from,
                "valid_upto" => $diet_chart->valid_upto,
                "diet_chart" => $diet_chart_details
            ];
        }catch(Exception $e){
            throw $e;
        }
        return response()->json([
            'message' => 'Diet Charts Details.',
            'diet_chart' => $diet_chart,
        ], 200);
    }
}
