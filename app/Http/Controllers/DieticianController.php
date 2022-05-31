<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DieticianService;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\DieticianRequest;
use App\Models\Dietician;

class DieticianController extends Controller
{
    private $service;
    /**
     * Constructor function
     *
     * @param FoodService $service
     */
    public function __construct(DieticianService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return response()->json(
            $this->service->get($request->all())
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DieticianRequest $request)
    {
        $payload = $request->validated();
        $payload['user']['password'] = Hash::make($request->password);

        return response()->json(
            $this->service->store($payload)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(
            $this->service->find($id)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DieticianRequest $request, Dietician $dietician)
    {
        $payload = $request->validated();

        if ($request->password) {
            $payload['password'] = Hash::make($request->password);
        }

        if ($this->service->update($dietician->id, $payload)) {
            return response()->json(
                $this->service->find($dietician->id)
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
