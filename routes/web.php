<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminTransactionsController;


Route::get('/', [HomeController::class, 'index']);
Route::get('/event-detail', [EventController::class, 'show']);
Route::get('/checkout', [EventController::class, 'checkout']);
Route::get('/ticket', [TicketController::class, 'index']);

Route::prefix('admin')->group(function () {
    Route::get('/admin-dashboard', [DashboardController::class, 'index']);
    Route::get('/admin-events', [AdminEventController::class, 'index']);
    Route::get('/admin-categories', [CategoryController::class, 'index']);
    Route::get('/admin-transactions', [AdminTransactionsController::class, 'index']);
});