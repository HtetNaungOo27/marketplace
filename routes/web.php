<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Vendor\ProductManager;
use App\Livewire\Shop\ProductListing;

Route::get('/', ProductListing::class)->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});


Route::middleware(['auth'])->group(function () {

    Route::get('/vendor/dashboard', function () {
        return view('vendor.dashboard');
    });

    Route::get('/delivery/dashboard', function () {
        return view('delivery.dashboard');
    });

    Route::get('/vendor/products', ProductManager::class);

});

require __DIR__.'/settings.php';
