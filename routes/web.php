<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Vendor\ProductManager;
use App\Livewire\Shop\ProductListing;
use App\Livewire\Shop\ProductDetail;
use \App\Livewire\Shop\Cart;
use \App\Livewire\Shop\OrderSuccess;
use \App\Livewire\Shop\OrderHistory;
use \App\Livewire\Vendor\OrderManager;
use \App\Livewire\Vendor\PayoutManager;
use App\Livewire\Vendor\Dashboard as VendorDashboard;
use App\Livewire\Delivery\Dashboard as DeliveryDashboard;
use App\Orchid\Screens\DeliveryAssignScreen;
use \App\Livewire\Shop\CategoryPage;

Route::get('/', ProductListing::class)->name('home');
Route::get('/products/{product}', ProductDetail::class)->name('products.show');
Route::get('/cart', Cart::class)->name('cart');
Route::get('/categories', CategoryPage::class)->name('categories');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/vendor/dashboard', VendorDashboard::class)
    ->middleware('auth')
    ->name('vendor.dashboard');

    Route::get('/delivery/dashboard', function () {
        return view('delivery.dashboard');
    });

    Route::get('/vendor/products', ProductManager::class);
    Route::get('/orders', OrderHistory::class)->name('orders');

    Route::get('/vendor/orders',OrderManager ::class)->name('vendor.orders');

    Route::get('/vendor/payouts', PayoutManager::class)->name('vendor.payouts');

    Route::get('/delivery/dashboard', DeliveryDashboard::class)->name('delivery.dashboard');

    Route::screen('deliveries', DeliveryAssignScreen::class) ->name('platform.deliveries');

    Route::get('/order-success/{order}', OrderSuccess::class)->name('orders.success');

});

require __DIR__.'/settings.php';
