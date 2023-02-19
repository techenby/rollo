<?php

use App\Http\Controllers\Api\BlocksController;
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

Route::get('/blocks', [BlocksController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/blocks', [BlocksController::class, 'store']);
});
