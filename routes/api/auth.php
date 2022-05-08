<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\Auth\LoginController;

$commonConfigs = [
    'middleware' => ['check.bearer.token'],
];

Route::group($commonConfigs, function () {
    Route::post('/signup', [SignUpController::class, 'create_account'])->middleware('signup');
    Route::post('/login', [LoginController::class, 'do_login'])->middleware(['login', 'max.device.login']);
});
