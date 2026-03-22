<?php


use App\Http\Controllers\User\UserDashboardController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {

    Route::middleware(['auth', 'verified',RoleMiddleware::class.':user'])->group(function () {

        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
        Route::post('/savemeal',[UserDashboardController::class,'saveMeal'])->name('saveMeal');
        Route::post('/saveMealOff',[UserDashboardController::class,'saveMealOff'])->name('saveMealOff');
        

    });
});
