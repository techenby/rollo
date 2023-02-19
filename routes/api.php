<?php

use App\Http\Controllers\Api\ActivitiesController;
use App\Http\Controllers\Api\BlocksController;
use App\Http\Controllers\Api\SpacesController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/activities/current', [ActivitiesController::class, 'show']);

    Route::get('/blocks', [BlocksController::class, 'index']);
    Route::post('/blocks', [BlocksController::class, 'store']);
    Route::patch('/blocks/{block}/{method?}', [BlocksController::class, 'update']);

    Route::get('/spaces', [SpacesController::class, 'index']);
});
