<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

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
    return $request->user();
});

Route::get('actings', [ApiController::class, 'getActings']);
Route::get('users', [ApiController::class, 'getUsers']);

Route::get('admin/actings', [ApiController::class, 'getActingsInAdmin']);

Route::get('logistics', [ApiController::class, 'getLogistics']);
Route::get('specializeds', [ApiController::class, 'getSpecializeds']);