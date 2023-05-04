<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\company\CompanyController;
use App\Http\Controllers\company\AdvertisementController;
use App\Http\Controllers\company\DatasetController;
use App\Http\Controllers\company\ChatController;
use App\Http\Controllers\company\MessageController;

Route::controller(AuthController::class)->group(function () {

    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});

Route::controller(CompanyController::class) -> group(function() {

    Route::get('profile', 'getProfile');
    Route::post('profile', 'updateProfile');

});

Route::apiResource("advertisement", AdvertisementController::class);
Route::apiResource("datasets", DatasetController::class);
Route::apiResource("chat", ChatController::class);

Route::post("message", [MessageController::class, 'store']);
Route::view("connect", "welcome");

// Authentication Routes
// Route::post('/login' , [AuthController::class, 'login']);
// Route::post('/register',[AuthController::class, 'register']);

//Protected routes
// Route::group(['middleware' => ['auth:sanctum']], function (){
//     Route::resource('/tasks', TaskController::class);
//     Route::post('/logout',[AuthController::class, 'logout']);
// });

// Route::get("test", function() {

//     return "TEST Function";

// });
