<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserInfoController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;


Route::prefix('admin')->group(function(){
    Route::get('/users',[UserInfoController::class,"index"])->name("user.index");
    Route::get('users/create', function (){
        return view("admin.users.create");
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
