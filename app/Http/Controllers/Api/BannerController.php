<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\BannerService;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    private $service;
    /**
     * Constructor function
     *
     * @param BannerService $service
     */
    public function __construct(BannerService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return response()->json(['banners' => $this->service->get()], 200);
    }


    public function getCategories(Request $request)
    {

            $RESP['result'] = 'true';
            $RESP['data'] = $this->service->getallCats();
            

        return response()->json($RESP, 200);
    }

}
