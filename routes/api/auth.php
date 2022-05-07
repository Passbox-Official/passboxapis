<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SignUpController;

$authMiddlewares = [
    'middleware' => ['signup'],
];

Route::group($authMiddlewares, function () {
    Route::post('/signup', [SignUpController::class, 'create_account']);
});
