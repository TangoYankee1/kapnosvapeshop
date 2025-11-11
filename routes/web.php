<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\BrandController;

// Age Gate Routes
Route::get('/age-gate', function () {
    return view('age.gate');
})->name('age.gate');

Route::post('/age-gate', function () {
    if (request('action') === 'confirm') {
        session(['age_verified' => true]);
        return redirect('/');
    }

    return redirect('https://www.google.com');
})->name('age.gate.submit');

Route::middleware(['age.gate'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->middleware('auth')->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->middleware('auth')->name('checkout.store');


    Route::get('/', [ProductController::class, 'index'])->name('home');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/cart/data', [CartController::class, 'data'])->name('cart.data');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Public Product Routes
    Route::get('/shop', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');

    // Admin Routes
    Route::middleware(['auth', 'check.role'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/orders', [AdminController::class, 'listOrders'])->name('orders.list');
        Route::get('/orders/{order}', [AdminController::class, 'showOrder'])->name('orders.show');

        // Product Management Routes
        Route::get('/products', [ProductController::class, 'adminIndex'])->name('products.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

        Route::resource('brands', BrandController::class)->except(['show']);
    });
});

require __DIR__.'/auth.php';
