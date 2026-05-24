<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CheckoutController; // MENAMBAHKAN INI

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TransactionsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PartnersController;
use App\Models\Event;
use App\Http\Controllers\Admin\EventController as EventAdminController;

/*
|--------------------------------------------------------------------------
| USER AREA (Untuk Pengunjung Biasa)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Rute Detail Event
Route::get('/event-detail/{id}', [EventController::class, 'show'])->name('event.detail');

// Rute Tampilan Halaman Checkout
Route::get('/checkout/{id}', [EventController::class, 'checkout'])->name('checkout');

// Rute Proses Simpan Checkout (DIUBAH: Menggunakan CheckoutController)
Route::post('/checkout/process/{id}', [CheckoutController::class, 'process'])->name('checkout.process');

// Rute e-ticket alternatif (Jika menggunakan Order ID)
Route::get('/e-ticket/{order_id}', [EventController::class, 'showTicket'])->name('ticket.show');

// Rute Halaman Tiket (DIUBAH: Menggunakan TicketController agar terhubung dengan data Event & Nama)
Route::get('/ticket/{id}', [TicketController::class, 'index'])->name('ticket');


/*
|--------------------------------------------------------------------------
| ADMIN AREA (Khusus Halaman Admin)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // EVENTS CRUD
    Route::get('/events', [EventAdminController::class, 'index'])->name('events.index');
    Route::get('/events/create', [EventAdminController::class, 'create'])->name('events.create');
    Route::post('/events', [EventAdminController::class, 'store'])->name('events.store');
    Route::get('/events/{event}/edit', [EventAdminController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [EventAdminController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [EventAdminController::class, 'destroy'])->name('events.destroy');

    // TRANSACTIONS
    Route::get('/transactions', [TransactionsController::class, 'index'])->name('transactions.index');

    // CATEGORIES
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // PARTNERS CRUD
    // PARTNERS CRUD

// PARTNERS CRUD (Otomatis membuat rute index, create, store, edit, update, destroy)
Route::resource('partners', App\Http\Controllers\Admin\PartnersController::class);



});