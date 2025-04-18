<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserInfoController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

// admin side
Route::prefix('admin')->group(function(){
    Route::get('/users',[UserInfoController::class,"index"])->name("user.index");
    Route::get('users/create', function (){
        return view("admin.users.create");
    });
    Route::post('/user/store',[UserInfoController::class,'store'])->name('user.store');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/signup',[LoginController::class,'login'])->name('signup');
