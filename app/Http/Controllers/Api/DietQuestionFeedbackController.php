<?php

namespace App\Http\Controllers\Api;

use Exception;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

use App\Services\DietQuestionFeedbackService;
use App\Http\Requests\Api\DietQuestionFeedbackRequest;

class DietQuestionFeedbackController extends Controller
{
    /**
     * Constructor function
     *
     * @param DietQuestionFeedbackService           $service
     */
    public function __construct(DietQuestionFeedbackService $service)
    {
        $this->service = $service;
    }

    public function store(DietQuestionFeedbackRequest $request){
        try{
            $user = auth()->user();
            $data['question_set_id'] = $request->question_set_id;
            $data['feedback'] = $request->feedback;
            $this->service->create($data, $user);
        }
        catch(Exception $e){
            throw $e;
        }
        return response()->json([
            'message' => 'Feedback stored Successfully.',
        ], 200);
    }

}
