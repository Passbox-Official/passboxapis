<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordController;

$sessionConfigs = [
    'middleware' => ['auth:sanctum'],
];
Route::group($sessionConfigs, function () {
    Route::resource('password', PasswordController::class)->only([
        'store',
        'index',
        'destroy'
    ]);
    Route::post('password/find', [PasswordController::class, 'find']);
    Route::get('password/trashed', [PasswordController::class, 'trashed']);
    Route::put('password/trashed/restore/{id}', [PasswordController::class, 'restoreTrashed']);
});
