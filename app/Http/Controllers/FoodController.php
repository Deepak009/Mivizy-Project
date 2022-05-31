<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use App\Services\FoodService;
use App\Services\ImageService;
use App\Http\Requests\FoodRequest;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    private $service;
    /**
     * Constructor function
     *
     * @param FoodService $service
     */
    public function __construct(FoodService $service, ImageService $imageService)
    {
        $this->service = $service;
        $this->imageService = $imageService;
    }

    public function index(Request $request)
    {
        return response()->json($this->service->get($request->all()));
    }

    public function timeSlotWise()
    {
        $data = $this->service->getTimeSlotWiseFoods();
        return response()->json($data);
    }

	/**
     * Create
     *
     * @param  FoodRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FoodRequest $request)
    {
        $payload = $request->validated();

        return response()->json(
            $this->service->create($payload)
        );
    }

	/**
     * Update
     *
     * @param  Food  $food
     * @param  FoodRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Food $food, FoodRequest $request)
    {
        $payload = $request->validated();

        return response()->json(
            $this->service->update($food, $payload)
        );
    }

	/**
	 * @param Food  $food
	 * @return \Illuminate\Http\Response
	 */
	public function show(Food $food)
    {
        return response()->json($food);
    }

	/**
     * Return the slots
     *
     * @return \Illuminate\Http\Response
     */
    public function getSlots()
    {
        return response()->json([ "slots" => SLOTS ]);
    }

	/**
     * Return the food types
     *
     * @return \Illuminate\Http\Response
     */
    public function getFoodTypes()
    {
        return response()->json([ "food_types" => FOODTYPES ]);
    }
}
