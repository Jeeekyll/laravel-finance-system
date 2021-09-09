<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware('guest')->group(function () {
    Route::get('/register', [UserController::class, 'registrationForm'])->name('register.create');
    Route::post('/register', [UserController::class, 'register'])->name('register.store');
    Route::get('/login', [UserController::class, 'loginForm'])->name('login');
    Route::post('/login', [UserController::class, 'login'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions/create', [TransactionController::class, 'store'])->name('transactions.store');
    Route::delete('/transactions/{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy');

    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});





