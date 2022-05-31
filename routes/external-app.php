<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ExternalApp\CustomerController;

/*
|--------------------------------------------------------------------------
| External app Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'external-app'], function () {
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::patch('/customers/{ext_app_id}', [CustomerController::class, 'update'])->name('customers.update');
    Route::get('/customers/{ext_app_id}', [CustomerController::class, 'get'])->name('customers.get');
    Route::delete('/customers/{ext_app_id}', [CustomerController::class, 'delete'])->name('customers.delete');
});
