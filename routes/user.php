<?php

use App\Http\Controllers\MemberrequestController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Middleware\RoleMiddleware;
use App\Models\Memberrequest;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {

    Route::middleware(['auth', 'verified',RoleMiddleware::class.':user'])->group(function () {

        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
        Route::post('/savemeal',[UserDashboardController::class,'saveMeal'])->name('saveMeal');
        Route::post('/saveMealOff',[UserDashboardController::class,'saveMealOff'])->name('saveMealOff');
        Route::post('/request',[MemberrequestController::class,'update'])->name('request');
        

    });
});
