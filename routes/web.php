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
    Route::get('/user/edit/{id}',[UserInfoController::class,'edit'])->name('user.edit');
    Route::post('/user/update/{id}',[UserInfoController::class,'update'])->name('user.update');
    Route::get('user/delete/{id}',[UserInfoController::class,'destroy'])->name('user.delete');
    Route::get('user/restore/{id}',[UserInfoController::class,'restore'])->name('user.restore');
});

Auth::routes([
    'login'=>false
]);

Route::post('/signup',[LoginController::class,'signUp'])->name('signup');
Route::get('/login',function (){
    return view('auth.login');
})->name('login');
Route::get('/lg',function (){
Auth::logout();
});