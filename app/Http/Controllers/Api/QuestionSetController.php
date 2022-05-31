<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

use App\Services\QuestionSetService;

class QuestionSetController extends Controller
{
    /**
     * Constructor function
     *
     * @param QuestionSetService           $service
     */
    public function __construct(QuestionSetService $service)
    {
        $this->service = $service;
    }

    public function get(Request $request){
        try{
            $selected_question_set_id=config('healthapp.selected_question_set_id');
            $question_set = $this->service->find($selected_question_set_id);
        }catch(Exception $e){
            throw $e;
        }
        return response()->json([
            'message' => 'Question Set fetch Successfully.',
            'question_set' => $question_set,
        ], 200);
    }

}
