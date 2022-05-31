<?php

namespace App\Http\Controllers;

use App\Models\BloodDonor;
use Illuminate\Http\Request;
use App\Services\BloodDonorService;
use App\Http\Requests\BloodDonorRequest;

class BloodDonorController extends Controller
{
    private $service;
    /**
     * Constructor function
     *
     * @param BloodDonorService $service
     */
    public function __construct(BloodDonorService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return response()->json($this->service->get($request->all()));
    }

	/**
     * Create
     *
     * @param  BloodDonorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BloodDonorRequest $request)
    {
        $payload = $request->validated();

        return response()->json(
            $this->service->create($payload)
        );
    }

	/**
     * Update
     *
     * @param  BloodDonor  $blood_donor
     * @param  BloodDonorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(BloodDonor $blood_donor, BloodDonorRequest $request)
    {
        $payload = $request->validated();

        return response()->json(
            $this->service->update($blood_donor, $payload)
        );
    }

	/**
	 * @param BloodDonor  $blood_donor
	 * @return \Illuminate\Http\Response
	 */
	public function show(BloodDonor $blood_donor)
    {
        return response()->json($blood_donor);
    }

	/**
     * Return the blood groops
     *
     * @return \Illuminate\Http\Response
     */
    public function getBloodGroups()
    {
        return response()->json([ "blood_groups" => BLOODGROUPS ]);
    }
}
