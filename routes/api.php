<?php

use App\Http\Controllers\CarsController;
use App\Http\Controllers\MarksController;
use App\Http\Controllers\ModelsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('marks')->group(function () {
    Route::get('/get', [MarksController::class, 'get']);
});
Route::prefix('models')->group(function () {
    Route::get('/get', [ModelsController::class, 'get']);
});
Route::prefix('cars')->group(function () {
    Route::get('/get', [CarsController::class, 'get']);
    Route::post('/create', [CarsController::class, 'create']);
    Route::post('/update', [CarsController::class, 'update']);
    Route::delete('/delete', [CarsController::class, 'delete']);
});
