<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgetController;
use App\Http\Controllers\ResetController;




// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/login', [AuthController::class, 'Login'] );
Route::post('/register', [AuthController::class, 'Register']);
Route::post('/forgetpassword', [ForgetController::class, 'Forget']);
Route::post('/resetpassword', [ResetController::class, 'Reset']);