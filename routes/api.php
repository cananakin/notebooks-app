<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Instrument;
use App\Http\Controllers\OrderController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/ping', fn () => ['ok' => true]);

Route::get('/instruments', fn() => Instrument::orderBy('sku')->get());
Route::post('/orders', [OrderController::class, 'store']);