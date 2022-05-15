<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordController;

$sessionConfigs = [
    'middleware' => ['auth:sanctum'],
];
Route::group($sessionConfigs, function () {
    Route::resource('password', PasswordController::class);
    Route::post('password/find', [PasswordController::class, 'find']);
});
