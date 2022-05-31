<?php

namespace App\Http\Controllers\Api;

use App\Models\OPDSchedule;
use Illuminate\Http\Request;
use App\Services\OPDScheduleService;
use App\Services\OPDCategoryService;
use App\Http\Controllers\Controller;

class OPDScheduleController extends Controller
{
    private $service;
    /**
     * Constructor function
     *
     * @param OPDScheduleService $service
     * @param OPDCategoryService $service
     */
    public function __construct(OPDScheduleService $service, OPDCategoryService $opd_category_service)
    {
        $this->service = $service;
        $this->opd_category_service = $opd_category_service;
    }

    public function index(Request $request)
    {
        return response()->json($this->service->get($request->all()));
    }

	/**
     * Return the opd categories
     *
     * @return \Illuminate\Http\Response
     */
    public function getOPDCategories()
    {
		$opd_categories = $this->opd_category_service->all();
        return response()->json([ "opd_categories" => $opd_categories ]);
    }
}
