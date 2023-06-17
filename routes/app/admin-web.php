<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;


Route::namespace('admin')->prefix('admin')->group(function () {

    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');

    Route::post('/auth', [AdminController::class, 'auth'])->name('admin.auth');

    Route::middleware('admin')->group(function () {
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

        Route::get('/', [DashboardController::class, 'index'])->name('admin.index');

        Route::get('/usuarios', [DashboardController::class, 'users'])->name('admin.users');

        Route::get('/ramos', [DashboardController::class, 'actings'])->name('admin.actings');

        Route::post('/ramo/add', [DashboardController::class, 'addActing'])->name('admin.add.acting');
        
    });
});
