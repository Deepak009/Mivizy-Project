<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DietChartController;
use App\Http\Controllers\BloodDonorController;
use App\Http\Controllers\BloodRequestController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DietChartTemplateController;
use App\Http\Controllers\DieticianController;
use App\Http\Controllers\OPDScheduleController;
use App\Http\Controllers\DietQuestionFeedbackController;

use App\Http\Controllers\DoctorController;

Route::group(['prefix' => 'spa', 'as' => 'spa.'], function () {

    // auth
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
    Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');

    Route::group(['middleware' => ['auth', 'only-active-users']], function() {

        Route::post('update-password', [AuthController::class, 'updatePassword'])->name('update-password');
        Route::get('me', [AuthController::class, 'user'])->name('user');

        // diet chart
        Route::apiResource('diet-question-feedback', DietQuestionFeedbackController::class);
        Route::group(['prefix' => 'diet-charts', 'as' => 'diet-charts.'], function () {
            Route::get('get-by-feedback-id/{feedback}', [DietChartController::class, 'getByFeedbackId'])->name('get-by-feedback-id');
            Route::post('save', [DietChartController::class, 'save'])->name('save');
            Route::post('update-item', [DietChartController::class, 'updateItem'])->name('update-item');
            Route::delete('{chart}/delete-item/{item}', [DietChartController::class, 'deleteItem'])->name('delete-item');
            //diet chart template
            Route::apiResource('template', DietChartTemplateController::class);
        });


        // Food
        Route::group(['prefix' => 'foods', 'as' => 'foods.', 'middleware' => 'can:admin'], function () {
            Route::get('get-time-slot-wise', [FoodController::class, 'timeSlotWise'])->name('get-time-slot-wise');
            Route::get('food-types', [FoodController::class, 'getFoodTypes'])->name('food-types');
            Route::get('slots', [FoodController::class, 'getSlots'])->name('slots');
        });
        Route::apiResource('foods', FoodController::class)->middleware('can:admin');

        // Blood donor
        Route::get('blood-donors/blood-groups', [BloodDonorController::class, 'getBloodGroups'])->name('blood-donors.blood-groups')->middleware('can:admin');
        Route::apiResource('blood-donors', BloodDonorController::class)->middleware('can:admin');

        // Blood request
        Route::apiResource('blood-requests', BloodRequestController::class)->middleware('can:admin');

        // OPD schedule
        Route::get('opd-schedules/opd-categories', [OPDScheduleController::class, 'getOPDCategories'])->name('opd-schedules.opd-categories')->middleware('can:admin');
        Route::apiResource('opd-schedules', OPDScheduleController::class)->middleware('can:admin');

        // Users
        Route::apiResource('user', UserController::class)->middleware('can:admin');
        Route::apiResource('dietician', DieticianController::class)->middleware('can:admin');
        Route::apiResource('customers', CustomerController::class)->middleware('can:admin');
        Route::apiResource('banner', BannerController::class)->middleware('can:admin');

        Route::apiResource('doctors', DoctorController::class);

        

        Route::get('dashboard/data', [DashboardController::class, 'data'])->name('dashboard.data');
    });

});
