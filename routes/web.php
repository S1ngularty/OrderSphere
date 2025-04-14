<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserInfoController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\CategoryController;

Route::prefix('admin')->group(function(){
    Route::get('/users',[UserInfoController::class,"index"])->name("user.index");

});
