<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Root redirect - goes to login or appropriate dashboard
Route::get('/', function () {
    return Auth::check() 
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

// Dynamic dashboard route - redirects based on user role
Route::get('/dashboard', function () {
    $user = Auth::user();
    
    if ($user->role == 'manager') {
        return redirect()->route('manager.dashboard');
    } elseif ($user->role == 'user') {
        return redirect()->route('user.dashboard');
    }
    
    // Fallback for other roles or if no specific role
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include other route files
require __DIR__.'/auth.php';
require __DIR__.'/user.php';
require __DIR__.'/manager.php';
