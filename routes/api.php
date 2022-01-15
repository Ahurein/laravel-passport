<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgetController;




// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/login', [AuthController::class, 'Login'] );
Route::post('/register', [AuthController::class, 'Register']);
Route::post('/forgetpassword', [ForgetController::class, 'Forget']);