<?php

use Illuminate\Support\Facades\Route;
use PhpCsFixer\FixerFactory;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\TransactionsController;
use App\Http\Controllers\Admin\CategoriesController;

// Route::get('/', function () {
//     return '<h1>Ini adalah Halaman Tentang Aplikasi Event Hub</h1>';
// });

// Route::get('/kontak', function () {
//  return view('contact');
// });

// Route::get('/profil', function () {
//  return view('profil');
// });

// Route::get('/katalog', function () {
//  return view('katalog');
// });

// Route::get('/bantuan', function () {
//  return view('bantuan');
// });

//user area
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/event-detail', [EventController::class, 'show']);
Route::get('/checkout', [EventController::class, 'checkout']);
Route::get('/ticket', [TicketController::class, 'index']);




//admin area
Route::group(['prefix' => 'admin', 'as' =>'admin'], function () {
    Route::get('/events', [AdminEventController::class, 'index'])->name('events');
    Route::get('/transactions', [TransactionsController::class, 'index'])->name('transactions');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
});