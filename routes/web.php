<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\DisposisiController;
use App\Http\Controllers\HistoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth'])
    ->group(function () {

        Route::resource(
            'surat',
            SuratController::class
        );

});


Route::middleware('auth')->group(function () {

    Route::post(
        '/surat/{surat}/approve',
        [ApprovalController::class,'approve']
    )->name('surat.approve');

});

Route::get(
    '/verifikasi/{token}',
    [ApprovalController::class,'verify']
)->name('verify.qr');


Route::middleware('auth')->group(function () {

    Route::get(
        '/surat-masuk',
        [DisposisiController::class,'index']
    )->name('surat.masuk');

    Route::post(
        '/disposisi/{id}/teruskan',
        [DisposisiController::class,'teruskan']
    )->name('disposisi.teruskan');

    Route::post(
        '/disposisi/{id}/revisi',
        [DisposisiController::class,'revisi']
    )->name('disposisi.revisi');

    Route::post(
        '/disposisi/{id}/tolak',
        [DisposisiController::class,'tolak']
    )->name('disposisi.tolak');

});

Route::middleware(['auth'])->group(function () {

    Route::get(
        '/approval',
        [ApprovalController::class, 'index']
    )->name('approval.index');

});


Route::middleware(['auth'])->group(function () {

    Route::get(
        '/history',
        [HistoryController::class, 'index']
    )->name('history.index');

});

require __DIR__.'/auth.php';
