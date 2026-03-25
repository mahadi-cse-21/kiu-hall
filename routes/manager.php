<?php

use App\Http\Controllers\Manager\ManagerDashboardController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix('manager')->group(function () {

    Route::middleware(['auth', 'verified', RoleMiddleware::class . ':manager'])->group(function () {

        Route::get('/dashboard', [ManagerDashboardController::class, 'index'])->name('manager.dashboard');
        
        Route::get('/payments',[ManagerDashboardController::class,'payment'])->name('manager.payments');



        Route::get('/meals',[ManagerDashboardController::class,'meals'])->name('manager.meal-tracking');


        Route::get('/bazars',[ManagerDashboardController::class,'bazars'])->name('manager.bazars');


        Route::get('/guest',[ManagerDashboardController::class,'guest'])->name('manager.guest');

        Route::get('/makemanager',[ManagerDashboardController::class,'makemanager'])->name('manager.makemanager');


        Route::post('/update', [ManagerDashboardController::class, 'updatemeal'])->name('updatemeal');

        Route::post('/addbazar', [ManagerDashboardController::class, 'addBazar'])->name('addbazar');
        Route::post('/guestmeal', [ManagerDashboardController::class, 'guestmeal'])->name('guestmeal');
        
        Route::post('/addpayment', [ManagerDashboardController::class, 'addPayment'])->name('addpayment');


        
    });
});
