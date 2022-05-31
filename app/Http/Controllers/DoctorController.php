<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Doctor;
use App\Services\DoctorService;


class DoctorController extends Controller
{
 
    private $service;
    /**
     * Constructor function
     *
     * @param FoodService $service
     */
    public function __construct(DoctorService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return Doctor::all();
    }

    function getData(){
        return Doctor::all();
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        return response()->json($this->service->create($request));
        //return response()->json($request);
    }



    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
