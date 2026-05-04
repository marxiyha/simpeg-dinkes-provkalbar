<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\Auth\OtpLoginController;
use App\Http\Middleware\EnsureEmailOtpVerified;

Route::inertia('/', 'welcome', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    // OTP Challenge routes (outside the EnsureEmailOtpVerified protection!)
    Route::inertia('/otp-challenge', 'auth/verify-otp')->name('otp.challenge');
    Route::post('/otp-verify', [OtpLoginController::class, 'verify2fa'])->name('otp.verify');

    // Fully protected routes (require both password auth AND email OTP)
    Route::middleware([EnsureEmailOtpVerified::class])->group(function () {
        // User
        Route::inertia('dashboard', 'user/dashboard')->name('dashboard');
        
        // Admin
        Route::prefix('admin')->name('admin.')->group(function(){
            Route::inertia('/dashboard', 'admin/dashboard')->name('dashboard');
        });
    });
});


require __DIR__.'/settings.php';
