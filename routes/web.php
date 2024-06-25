<?php

use App\Livewire\Backend\Businesses;
use Illuminate\Support\Facades\Route;
use App\Livewire\Backend\Businesses\BusinessesDetail;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


// BACKEND
Route::get('/businesses', Businesses::class)->name('businesses');
Route::get('/businesses/{id}', BusinessesDetail::class)->name('businesses.detail');

