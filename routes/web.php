<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Backend\Businesses\Businesses;
use App\Livewire\Backend\ListTransactions\Qris;
use App\Livewire\Backend\Widhdrawal\Widhdrawal;
use App\Livewire\Backend\Notifications\Notification;
use App\Livewire\Backend\Businesses\BusinessesDetail;
use App\Livewire\Backend\Notifications\Notifications;
use App\Livewire\Backend\Transaction\TransactionQris;
use App\Livewire\Backend\Notifications\AddNotification;
use App\Livewire\Backend\Notifications\EditNotification;

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

    // TRANSACTION
    Route::get('/transactions', Qris::class)->name('transactions');

    // Notification
    Route::get('/notifications', Notification::class)->name('notifications');
    Route::get('/notifications-add', AddNotification::class)->name('notifications-add');
    Route::get('/notifications-edit', EditNotification::class)->name('notifications-edit');

});

