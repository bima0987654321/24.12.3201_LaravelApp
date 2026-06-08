<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TransactionsController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
<<<<<<< Updated upstream
=======
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\AuthController;
>>>>>>> Stashed changes

Route::get('/', [HomeController::class, 'index']);
Route::get('/event-detail', [EventController::class, 'show']);
Route::get('/checkout', [EventController::class, 'checkout']);
Route::get('/ticket', [TicketController::class, 'index']);

Route::prefix('admin')->name('admin.')->group(function () {
<<<<<<< Updated upstream
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('events', AdminEventController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('transactions', AdminTransactionsController::class);
});
=======
    // Rute Login bebas akses
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    
    // Mengamankan Route Administrasi dengan Middleware IsAdmin yang sudah mencakup double protection
    Route::middleware(\App\Http\Middleware\IsAdmin::class)->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('events', AdminEventController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('transactions', AdminTransactionsController::class);
        Route::resource('partners', PartnerController::class);
    });
});
>>>>>>> Stashed changes
