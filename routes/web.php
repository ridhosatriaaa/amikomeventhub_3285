<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TransactionsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\EventController as EventAdminController;


/*
|--------------------------------------------------------------------------
| USER AREA
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/event-detail/{id}', [EventController::class, 'show'])
    ->name('event.detail');

Route::get('/checkout', [EventController::class, 'checkout'])
    ->name('checkout');

Route::get('/ticket', [TicketController::class, 'index'])
    ->name('ticket');


/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | EVENTS CRUD
    |--------------------------------------------------------------------------
    */

    // INDEX
    Route::get('/events', [EventAdminController::class, 'index'])
        ->name('events.index');

    // CREATE
    Route::get('/events/create', [EventAdminController::class, 'create'])
        ->name('events.create');

    // STORE
    Route::post('/events', [EventAdminController::class, 'store'])
        ->name('events.store');

    // EDIT
    Route::get('/events/{event}/edit', [EventAdminController::class, 'edit'])
        ->name('events.edit');

    // UPDATE
    Route::put('/events/{event}', [EventAdminController::class, 'update'])
        ->name('events.update');

    // DELETE
    Route::delete('/events/{event}', [EventAdminController::class, 'destroy'])
        ->name('events.destroy');


    /*
    |--------------------------------------------------------------------------
    | TRANSACTIONS
    |--------------------------------------------------------------------------
    */

    Route::get('/transactions', [TransactionsController::class, 'index'])
        ->name('transactions.index');


    /*
    |--------------------------------------------------------------------------
    | CATEGORIES
    |--------------------------------------------------------------------------
    */

    Route::get('/categories', [CategoriesController::class, 'index'])
        ->name('categories.index');

});