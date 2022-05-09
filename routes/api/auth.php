<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;

$guestConfigs = [
    'middleware' => ['check.bearer.token'],
];
Route::group($guestConfigs, function () {
    Route::post('/signup', [SignUpController::class, 'create_account'])->middleware('signup');
    Route::post('/login', [LoginController::class, 'do_login'])->middleware(['login', 'max.device.login']);
});

$sessionConfigs = [
    'middleware' => ['auth:sanctum'],
];
Route::group($sessionConfigs, function () {
    Route::get('/devices', [UserController::class, 'logged_in_devices']);
    Route::delete('/devices/{device_id}', [UserController::class, 'delete_device']);
});
