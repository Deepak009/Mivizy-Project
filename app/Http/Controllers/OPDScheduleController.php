<?php

namespace App\Http\Controllers;

use App\Models\OPDSchedule;
use Illuminate\Http\Request;
use App\Services\OPDScheduleService;
use App\Services\OPDCategoryService;
use App\Http\Requests\OPDScheduleRequest;

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
     * Create
     *
     * @param  OPDScheduleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OPDScheduleRequest $request)
    {
        $payload = $request->validated();

        return response()->json(
            $this->service->create($payload)
        );
    }

	/**
     * Update
     *
     * @param  OPDSchedule  $opd_schedule
     * @param  OPDScheduleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(OPDSchedule $opd_schedule, OPDScheduleRequest $request)
    {
        $payload = $request->validated();

        return response()->json(
            $this->service->update($opd_schedule, $payload)
        );
    }

	/**
	 * @param OPDSchedule  $opd_schedule
	 * @return \Illuminate\Http\Response
	 */
	public function show(OPDSchedule $opd_schedule)
    {
        return response()->json($opd_schedule);
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

    /**
     * delete
     *
     * @param  OPDSchedule  $opd_schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(OPDSchedule $opd_schedule)
    {

        return response()->json(
            $this->service->delete($opd_schedule->id)
        );
    }
}
