<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\DisposisiController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\DashboardController;
use \App\Http\Controllers\RoleController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
->middleware(['auth', 'verified'])
->name('dashboard');

Route::get(
    '/verifikasi/{token}',
    [ApprovalController::class, 'verify']
)->name('verify.qr');

Route::middleware(['auth'])->group(function () {

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');

    Route::resource(
        'users',
        UserController::class
    );

    Route::resource(
        'surat',
        SuratController::class
    );

    Route::get(
        '/approval',
        [ApprovalController::class, 'index']
    )->name('approval.index');

    Route::post(
        '/surat/{surat}/approve',
        [ApprovalController::class, 'approve']
    )->name('surat.approve');

    Route::get(
        '/surat-masuk',
        [DisposisiController::class, 'index']
    )->name('surat.masuk');

    Route::post(
        '/surat/{surat}/teruskan',
        [DisposisiController::class, 'teruskan']
    )->name('disposisi.teruskan');

    Route::post(
        '/surat/{surat}/revisi',
        [DisposisiController::class, 'revisi']
    )->name('disposisi.revisi');

    Route::post(
        '/surat/{surat}/tolak',
        [DisposisiController::class, 'tolak']
    )->name('disposisi.tolak');

    Route::get(
        '/history',
        [HistoryController::class, 'index']
    )->name('history.index');

    Route::resource(
        'roles',
        RoleController::class
    );  
});

require __DIR__.'/auth.php';