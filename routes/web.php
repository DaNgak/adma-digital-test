<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\MerekController;
use App\Http\Controllers\Admin\OrderTransportController;
use App\Http\Controllers\Admin\PricingOrderController;
use App\Http\Controllers\Admin\TransportController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\OrderTransportController as UserOrderTransportController;
use App\Http\Controllers\User\PricingOrderController as UserPricingOrderController;
use App\Http\Controllers\User\TransportController as UserTransportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });
    
    Route::get('/login', [AuthController::class, "index"])->name("login");
    Route::post('/register', [AuthController::class, "store"])->name("register.store");
    Route::post('/login', [AuthController::class, "login"])->name("login.store");
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, "logout"])->name("logout");
    Route::get('/dashboard', DashboardController::class)->name("dashboard.index");
    Route::prefix('dashboard')->group(function () {
        Route::resource('/user/order', UserOrderTransportController::class)->except(['destroy', 'edit', 'update']);
        Route::prefix('/user')->group(function () {
            Route::put('/order/cancel/{id}', [UserOrderTransportController::class, 'cancelOrder'])->name('user.order.cancel');
            Route::get('/order/history/index', [UserOrderTransportController::class, 'history'])->name('user.order.history');
            Route::get('/order/history/index/{id}', [UserOrderTransportController::class, 'historyDetail'])->name('user.order.history.show');
            Route::post('/order/history', [UserOrderTransportController::class, 'historySearch'])->name('user.order.history.search');
            Route::get('/transport', UserTransportController::class)->name('user.transport.index');
            Route::get('/pricing', UserPricingOrderController::class)->name('user.pricing-order.index');
        });
    });

    // Admin
    Route::prefix('/dashboard/admin')->middleware('admin')->group(function () {
        Route::resource('/location', LocationController::class)->except('show');
        Route::post('/location/search', [LocationController::class, 'search'])->name('location.search');
        Route::get('/location/trash', [LocationController::class, 'trashIndex'])->name('location.trash.index');
        Route::post('/location/trash', [LocationController::class, 'trashSearch'])->name('location.trash.search');
        Route::put('/location/trash/{id}', [LocationController::class, 'trashRestore'])->name('location.trash.restore');
        Route::delete('/location/trash/{id}', [LocationController::class, 'trashDestroy'])->name('location.trash.destroy');
        // merek
        Route::resource('/merek', MerekController::class)->except('show');
        Route::prefix('/merek')->group(function () {
            Route::get('/trash', [MerekController::class, 'trashIndex'])->name('merek.trash.index');
            Route::put('/trash/{id}', [MerekController::class, 'trashRestore'])->name('merek.trash.restore');
            Route::delete('/trash/{id}', [MerekController::class, 'trashDestroy'])->name('merek.trash.destroy');
        });
        // pricing-order
        Route::resource('/pricing-order', PricingOrderController::class)->except('show');
        Route::prefix('/pricing-order')->group(function () {
            Route::post('/search', [PricingOrderController::class, 'search'])->name('pricing-order.search');
            Route::get('/trash', [PricingOrderController::class, 'trashIndex'])->name('pricing-order.trash.index');
            Route::post('/trash', [PricingOrderController::class, 'trashSearch'])->name('pricing-order.trash.search');
            Route::put('/trash/{id}', [PricingOrderController::class, 'trashRestore'])->name('pricing-order.trash.restore');
            Route::delete('/trash/{id}', [PricingOrderController::class, 'trashDestroy'])->name('pricing-order.trash.destroy');
        });
        Route::resource('/transport', TransportController::class);
        // transport
        Route::prefix('/transport')->group(function () {
            Route::post('/search', [TransportController::class, 'search'])->name('transport.search');
            Route::get('/trash/index', [TransportController::class, 'trashIndex'])->name('transport.trash.index');
            Route::post('/trash/index', [TransportController::class, 'trashSearch'])->name('transport.trash.search');
            Route::get('/trash/{id}', [TransportController::class, 'trashShow'])->name('transport.trash.show');
            Route::put('/trash/{id}', [TransportController::class, 'trashRestore'])->name('transport.trash.restore');
            Route::delete('/trash/{id}', [TransportController::class, 'trashDestroy'])->name('transport.trash.destroy');
        });
        // order
        Route::resource('/order-transport', OrderTransportController::class)->except(['create', 'store', 'edit', 'update']);
        Route::prefix('/order-transport')->group(function () {
            Route::get('/search/index', [OrderTransportController::class, 'search'])->name('order-transport.search');
            Route::get('/trash/index', [OrderTransportController::class, 'trashIndex'])->name('order-transport.trash.index');
            Route::post('/trash/index', [OrderTransportController::class, 'trashSearch'])->name('order-transport.trash.search');
            Route::get('/trash/{id}', [OrderTransportController::class, 'trashShow'])->name('order-transport.trash.show');
            Route::put('/trash/{id}', [OrderTransportController::class, 'trashRestore'])->name('order-transport.trash.restore');
            Route::delete('/trash/{id}', [OrderTransportController::class, 'trashDestroy'])->name('order-transport.trash.destroy');
        });
    });
}); 
