<?php

use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\UserController;
use App\Http\Controllers\Site\AuthController;

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::post('/register-profile', [AuthController::class, 'registerProfile'])->name('register.profile');

    Route::get('/servico/logistico/{id}', [HomeController::class, 'logisticService'])->name('logistic.service');

    Route::get('/servico/especializado/{id}', [HomeController::class, 'specializedService'])->name('specialized.service');

    Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('update.profile');
    Route::post('/update-address', [UserController::class, 'updateAddress'])->name('update.address');
    Route::post('/update-file', [UserController::class, 'updateFile'])->name('update.file');
    Route::post('/update-clip', [UserController::class, 'updateClipping'])->name('update.clip');
    Route::post('/delete-clip/{id}', [UserController::class, 'deleteClip'])->name('delete.clip');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'checkProfile'
])->group(function () { });
