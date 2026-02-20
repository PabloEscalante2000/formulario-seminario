<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\VerificacionController;
use Illuminate\Support\Facades\Route;

Route::get('/token/{token}', [InvitationController::class, 'show'])->name('invitation.show');
Route::post('/token/{token}', [InvitationController::class, 'store'])->name('invitation.store');

Route::get('/verificar/{token}', [VerificacionController::class, 'show'])->name('verificacion.show');

Route::get('/admin/login', [AdminController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/tokens', [AdminController::class, 'createToken'])->name('admin.tokens.create');
});
