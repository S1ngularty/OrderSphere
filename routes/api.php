<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\apiController;

Route::apiResource('/users',apiController::class);



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\CategoryController;
Route::post('/jwtlogin/submit',[Authcontroller::class,'login'])->name('jwtlogin');

Route::get('/category/charts',[CategoryController::class,'chart'])->name("category.chart")->middleware("auth:api");
