<?php

use Illuminate\Support\Facades\Route;

// USER CONTROLLERS
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CheckoutController;

// ADMIN CONTROLLERS
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TransactionsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PartnersController;
use App\Http\Controllers\Admin\EventController as EventAdminController;

/*
|--------------------------------------------------------------------------
| ROUTE REDIRECT DEFAULT LOGIN
|--------------------------------------------------------------------------
*/
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');


/*
|--------------------------------------------------------------------------
| USER AREA (Untuk Pengunjung Biasa - Tanpa Middleware)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rute Detail Event
Route::get('/event-detail/{id}', [EventController::class, 'show'])->name('event.detail');

// Rute Tampilan Halaman Checkout (Diperbarui menggunakan Route Model Binding)
Route::get('/checkout/{event}', [CheckoutController::class, 'create'])->name('checkout.create');

// Rute Proses Simpan Checkout (Diperbarui menggunakan Route Model Binding)
Route::post('/checkout/{event}', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/payment/{order_id}', [CheckoutController::class, 'payment'])->name('checkout.payment');
Route::get('/success/{order_id}', [CheckoutController::class, 'success'])->name('checkout.success');

// Rute e-ticket alternatif (Jika menggunakan Order ID)
Route::get('/e-ticket/{order_id}', [EventController::class, 'showTicket'])->name('ticket.show');

// Rute Halaman Tiket
Route::get('/ticket/{id}', [TicketController::class, 'index'])->name('ticket');


/*
|--------------------------------------------------------------------------
| ADMIN AREA (Khusus Halaman Admin)
|--------------------------------------------------------------------------
*/
// Grouping untuk URL berawalan /admin
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Rute Login & Logout (Bebas akses, tidak boleh masuk middleware auth)
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // MENGAMANKAN ROUTE ADMINISTRASI DI BALIK TEMBOK (MIDDLEWARE)
    Route::middleware(['auth', 'admin'])->group(function () {
        
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
        Route::get('transactions', [\App\Http\Controllers\Admin\TransactionController::class, 'index'])->name('transactions.index');

        // CATEGORIES
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        // PARTNERS CRUD
        Route::resource('partners', PartnersController::class);
        
        
    });
});