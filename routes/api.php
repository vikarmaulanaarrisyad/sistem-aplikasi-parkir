<?php

use App\Http\Controllers\API\ParkirApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::apiResource('/parkir', ParkirApiController::class);
Route::post('/parkir/upload_image', [ParkirApiController::class, 'uploadImage']);
Route::post('/parkir/upload', [ParkirApiController::class, 'uploadImage1']);
