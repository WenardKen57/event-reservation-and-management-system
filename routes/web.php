<?php

use App\Http\Controllers\EventPackageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerReservationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $emailVerificationRequest) {
    $emailVerificationRequest->fullfil();

    return redirect('/profile');
})->middleware('auth', 'signed')->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard');

    Route::get('/create-event-package', [EventPackageController::class, 'create'])
    ->name('admin.create-event-package');

    Route::post('/store-event-package', [EventPackageController::class, 'store'])
    ->name('admin.store-event-package');

    Route::delete('/admin/event-package/{id}', [EventPackageController::class, 'destroyEventPackage'])
    ->name('admin.delete-event-package');

    Route::get('/admin/event-package/{id}/edit', [EventPackageController::class, 'editEventPackage'])
    ->name('admin.edit-event-package');

    Route::put('/admin/event-package/{id}', [EventPackageController::class, 'updateEventPackage'])
    ->name('admin.update-event-package');

});

Route::middleware(['auth', 'role:customer'])->group(function () {

    Route::get('customer/dashboard', [CustomerController::class, 'dashboard'])
    ->name('customer.dashboard');

    Route::get('/reservation/create', [CustomerReservationController::class, 'create'])->name('customer.reservation.create');
    Route::post('/reservation/store', [CustomerReservationController::class, 'store'])->name('customer.reservation.store');
    Route::delete('/reservation/{id}/cancel', [CustomerReservationController::class, 'cancel'])
    ->name('customer.reservation.cancel');
});



require __DIR__.'/auth.php';
