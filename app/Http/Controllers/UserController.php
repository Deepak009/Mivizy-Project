<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $service;
    /**
     * Constructor function
     *
     * @param FoodService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return response()->json(
            $this->service->get($request->all(), Role::ADMIN)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $payload = $request->validated();
        $payload['password'] = Hash::make($request->password);

        return response()->json(
            $this->service->storeUser($payload, Role::ADMIN)
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
            $this->service->find($id, Role::ADMIN)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $payload = $request->validated();

        if ($request->password) {
            $payload['password'] = Hash::make($request->password);
        }

        if ($this->service->update($id, $payload)) {
            return response()->json(
                $this->service->find($id, Role::ADMIN)
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
