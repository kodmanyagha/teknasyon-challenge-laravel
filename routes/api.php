<?php

use Illuminate\Support\Facades\Route;

Route::post('auth/registerDevice', [\App\Http\Controllers\Api\AuthController::class, 'registerDevice']);
Route::post('auth/registerUser', [\App\Http\Controllers\Api\AuthController::class, 'registerUser']);
Route::middleware('auth:api')->get('/auth/user/me', [\App\Http\Controllers\Api\AuthController::class, 'currentUser']);

Route::post('subscription/purchase', [\App\Http\Controllers\Api\SubscriptionController::class, 'purchase']);
Route::post('subscription/check', [\App\Http\Controllers\Api\SubscriptionController::class, 'check']);

Route::post('mock/purchaseCheck/google', [\App\Http\Controllers\Api\MockPurchaseCheckController::class, 'check'])->name('mock.purchaseCheck.google');
Route::post('mock/purchaseCheck/apple', [\App\Http\Controllers\Api\MockPurchaseCheckController::class, 'check'])->name('mock.purchaseCheck.apple');

