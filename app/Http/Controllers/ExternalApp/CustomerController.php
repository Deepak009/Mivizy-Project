<?php

namespace App\Http\Controllers\ExternalApp;

use Exception;
use App\Services\CustomerService;
use App\Http\Requests\ExternalApp\CustomerCreateRequest;
use App\Http\Requests\ExternalApp\CustomerUpdateRequest;

class CustomerController
{
    /**
     * Constructor function
     *
     * @param CustomerService           $service
     */
    public function __construct(CustomerService $service)
    {
        $this->service = $service;
    }

    public function store(CustomerCreateRequest $request){
        try{
            $customer = $this->service->create($request->validated());
        }
        catch(Exception $e){
            throw $e;
        }
        return response()->json([
            "message" => "Customer stored Successfully.",
            "customer" => $customer->makeHidden('user')
        ], 200);
    }

    /**
     * Update
     *
     * @param  $ext_app_id
     * @param  CustomerUpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($ext_app_id, CustomerUpdateRequest $request)
    {
        try {
            $customer = $this->service->findByExternalAppId($ext_app_id);
            if (empty($customer)) {
                return response()->json([
                    "message" => "Invalid external_app_id. Customer does not exist.",
                    "customer" => null
                ], 404);
            }
            $customer = $this->service->update($customer, $request->validated());
        } catch (Exception $e) {
            throw $e;
        }
        return response()->json([
            "message" => "Customer updated Successfully.",
            "customer" => $customer->makeHidden('user')
        ], 200);
    }

    /**
     * Get
     *
     * @param  $ext_app_id
     * @return \Illuminate\Http\Response
     */
    public function get($ext_app_id)
    {
        try {
            $customer = $this->service->findByExternalAppId($ext_app_id);
            if (empty($customer)) {
                return response()->json([
                    "message" => "Customer does not exist.",
                    "customer" => null
                ], 404);
            }
        } catch (Exception $e) {
            throw $e;
        }
        return response()->json([
            "message" => "Customer details fetched Successfully.",
            "customer" => $customer->makeHidden('user')
        ], 200);
    }

    /**
     * Delete
     *
     * @param  $ext_app_id
     * @return \Illuminate\Http\Response
     */
    public function delete($ext_app_id)
    {
        try {
            $customer = $this->service->findByExternalAppId($ext_app_id);
            if (empty($customer)) {
                return response()->json([
                    "message" => "Customer does not exist.",
                    "customer" => null
                ], 404);
            }
            $this->service->delete($customer);
        } catch (Exception $e) {
            throw $e;
        }
        return response()->json([
            "message" => "Customer deleted Successfully.",
        ], 200);
    }
}
