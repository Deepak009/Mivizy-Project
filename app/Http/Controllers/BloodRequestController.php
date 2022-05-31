<?php

namespace App\Http\Controllers;

use App\Models\BloodRequest;
use Illuminate\Http\Request;
use App\Services\BloodRequestService;
use App\Http\Requests\BloodRequestRequest;

class BloodRequestController extends Controller
{
    private $service;

    /**
     * Constructor function
     *
     * @param BloodRequestService $service
     */
    public function __construct(BloodRequestService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return response()->json($this->service->get($request->all()));
    }

	/**
     * Update
     *
     * @param  BloodRequest  $blood_request
     * @param  BloodRequestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(BloodRequest $blood_request, BloodRequestRequest $request)
    {
        $payload = $request->validated();

        return response()->json(
            $this->service->update($blood_request, $payload)
        );
    }

	/**
	 * @param BloodRequest  $blood_request
	 * @return \Illuminate\Http\Response
	 */
	public function show(BloodRequest $blood_request)
    {
		$blood_request->load('user');
        return response()->json($blood_request);
    }
}
