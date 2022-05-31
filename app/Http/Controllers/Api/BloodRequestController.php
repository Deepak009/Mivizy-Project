<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\BloodRequestService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BloodRequestRequest;

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
		$user_id = auth()->user()->id;
		$payload = $request->all();
		$payload['user_id'] = $user_id;
		$response = $this->service->get($payload);
		return response()->json($response);
    }

    /**
     * Create
     *
     * @param  BloodRequestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BloodRequestRequest $request)
    {
        $payload = $request->validated();
		$payload['user_id'] = auth()->user()->id;
		$blood_request = $this->service->create($payload);
		if($blood_request){
			return response()->json(['message' => 'Your request has been successfully submitted to us. We will contact you soon.'], 200);
		}
    }

	/**
     * Return the blood groops
     *
     * @return \Illuminate\Http\Response
     */
    public function getBloodGroups()
    {
        return response()->json([ "blood_groups" => BLOODGROUPS, 'message' => 'Blood groop fetch successfully.' ]);
    }
}
