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
        Route::get('/dashboard', Dashboard::class)->name('dashboard');

        Route::get('/products', ProductIndex::class)->name('products.index');
        Route::get('/products/form', ProductForm::class)->name('products.form');

        Route::get('/categories', \App\Livewire\Category\Index::class)->name('categories.index');
        Route::get('/categories/form', \App\Livewire\Category\Form::class)->name('categories.form');

        Route::get('/suppliers', \App\Livewire\Supplier\Index::class)->name('suppliers.index');
        Route::get('/suppliers/form', \App\Livewire\Supplier\Form::class)->name('suppliers.form');

        Route::get('/transactions/in', TransactionIn::class)->name('transactions.in');
        Route::get('/transactions/out', TransactionOut::class)->name('transactions.out');
    });
});
