<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;

use App\Http\Controllers\Controller;
use App\Livewire\Dashboard;
use App\Livewire\Product\Index as ProductIndex;
use App\Livewire\Product\Form as ProductForm;
use App\Livewire\Transaction\In as TransactionIn;
use App\Livewire\Transaction\Out as TransactionOut;

Route::middleware(['web'])->group(function () {
    Route::get('/', function () {
        return view('app');
    })->name('home');

    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.process');
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', function () { return view('pages.dashboard'); })->name('dashboard');

        Route::get('/products', function () { return view('pages.products'); })->name('products.index');
        Route::get('/products/form', ProductForm::class)->name('products.form');

        Route::get('/categories', function () { return view('pages.categories'); })->name('categories.index');
        Route::get('/categories/form', \App\Livewire\Category\Form::class)->name('categories.form');

        Route::get('/suppliers', function () { return view('pages.suppliers'); })->name('suppliers.index');
        Route::get('/suppliers/form', \App\Livewire\Supplier\Form::class)->name('suppliers.form');

        Route::get('/transactions/in', function () { return view('pages.transactions.in'); })->name('transactions.in');
        Route::get('/transactions/out', function () { return view('pages.transactions.out'); })->name('transactions.out');
    });
});
