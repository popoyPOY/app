<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\userController;
use Laravel\Sanctum\Sanctum;
use App\Models\Sanctum\PersonalAccessToken;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return '<b>hello</b>';
});

route::get('/hi', function(Request $request) {
    return response(['message' => 'hi']);
});

Route::prefix('/user')->group(function() {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/signup', [AuthController::class, 'createAccount']);
    Route::get('/me', [UserController::class, 'Account'])->middleware(['auth:sanctum']);
    Route::get('/logout', [UserController::class, 'Logout'])->middleware(['auth:sanctum']);
});