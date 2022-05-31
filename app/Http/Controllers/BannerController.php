<?php

namespace App\Http\Controllers;

use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use App\Services\BannerService;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    protected $service;

    public function __construct(BannerService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->service->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerRequest $request)
    {
        $banner = $this->service->find($request->id);

        if($this->service->update($banner, $request)) {
            return response()->json($banner);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        return response()->json($banner);
    }
}
