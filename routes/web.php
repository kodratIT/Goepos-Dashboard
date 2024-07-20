<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Backend\Businesses\Businesses;
use App\Livewire\Backend\Widhdrawal\Widhdrawal;
use App\Livewire\Backend\Businesses\BusinessesDetail;
use App\Livewire\Backend\Transaction\TransactionQris;

Route::get('/', function () {
    return view('welcome');
});

// Middleware Group
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // BACKEND
    Route::get('/businesses', Businesses::class)->name('businesses');
    Route::get('/businesses/{id}', BusinessesDetail::class)->name('businesses.detail');
    Route::get('/businesses/{id}', BusinessesDetail::class)->name('businesses.detail');
    Route::get('/businesses/{id}/transaction/qris', TransactionQris::class)->name('transaction.qris');
    Route::get('/businesses/{id}/transaction/qris/widhdrawal', Widhdrawal::class)->name('widhdrawal.qris');
    Route::get('/businesses/{id}/transaction/qris/widhdrawal/verify', Widhdrawal::class)->name('widhdrawal.qris.verify');
});

