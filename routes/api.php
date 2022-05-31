<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\DietChartController;
use App\Http\Controllers\Api\QuestionSetController;
use App\Http\Controllers\Api\OPDScheduleController;
use App\Http\Controllers\Api\BloodRequestController;
use App\Http\Controllers\Api\DietQuestionFeedbackController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/request-otp', [AuthController::class, 'requestOTP'])->name('request-otp');
Route::post('/sign-in', [AuthController::class, 'signIn'])->name('sign-in');

Route::group(["prefix"=>"opd-schedules"],function(){
	Route::get('/opd-categories', [OPDScheduleController::class, 'getOPDCategories'])->name('opd-schedules.opd-categories');
	Route::get('/', [OPDScheduleController::class, 'index'])->name('opd-schedules.index');
});

Route::group(["prefix"=>"banners"],function(){
	Route::get('/', [BannerController::class, 'index'])->name('banners.index');
});

Route::group(["prefix"=>"getcategories"],function(){
	Route::get('/', [BannerController::class, 'getCategories']);
});

Route::group(["middleware" => "auth:api"], function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::group(["prefix"=>"question-sets"],function(){
        Route::get('/', [QuestionSetController::class, 'get'])->name('question-sets.get');
    });
    Route::group(["prefix"=>"diet-question-feedbacks"],function(){
        Route::post('/', [DietQuestionFeedbackController::class, 'store'])->name('diet-question-feedbacks.store');
    });
    Route::group(["prefix"=>"diet-charts"],function(){
        Route::get('/', [DietChartController::class, 'get'])->name('diet-charts.get');
    });
	Route::group(["prefix"=>"blood-requests"],function(){
		Route::get('blood-groups', [BloodRequestController::class, 'getBloodGroups'])->name('blood-requests.blood-groups');
		Route::get('/', [BloodRequestController::class, 'index'])->name('blood-requests.index');
		Route::post('/', [BloodRequestController::class, 'store'])->name('blood-requests.store');
    });
});
