<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CustomerService;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    private $service;
    /**
     * Constructor function
     *
     * @param CustomerService $service
     */
    public function __construct(CustomerService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return response()->json($this->service->get($request->all()));
    }
}
