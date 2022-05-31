<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DietQuestionFeedback;
use App\Services\DietQuestionFeedbackService;
use Illuminate\Http\Request;

class DietQuestionFeedbackController extends Controller
{
    protected $service;

    public function __construct(DietQuestionFeedbackService $service) {
        $this->service = $service;
    }


    public function index(Request $request)
    {
        return response()->json($this->service->get($request->all(), auth()->user()));
    }

    public function show(DietQuestionFeedback $dietQuestionFeedback)
    {
        $dietQuestionFeedback->load(['user']);

        return response()->json($dietQuestionFeedback);
    }
}
