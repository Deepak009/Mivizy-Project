<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DoctorController;


require __DIR__."/spa.php";


Route::get('{any}', 'App\Http\Controllers\Controller@view')->where('any','.*');


//Route::get('/test', [DoctorController::class, 'store']);