<?php

use App\Http\Controllers\AlertController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('alert/batch-store', [AlertController::class, 'batchStore']);
Route::put('alert/batch-update', [AlertController::class, 'batchUpdate']);
Route::delete('alert/batch-destroy', [AlertController::class, 'batchDestroy']);
Route::apiResource('alert', AlertController::class)->only(['index', 'store', 'show', 'destroy']);
