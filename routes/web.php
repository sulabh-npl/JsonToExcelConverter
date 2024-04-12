<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    PreLogin\AuthController,
    FormController,
    AccountController
};

Route::prefix('/login')->group(function(){

    Route::get('', [AuthController::class, 'login'])->name('login');

    Route::get('/github', [AuthController::class, 'redirectToProvider'])->name('login.github');

    Route::get('/github/callback', [AuthController::class, 'handleProviderCallback'])->name('login.github.callback');

})->middleware('guest');

Route::middleware(['auth'])->group(function () {

    Route::get('/', [FormController::class, 'index'])->name('home');

    Route::post('/', [FormController::class, 'convert'])->name('home.convert');

    Route::get('/logout', [AccountController::class, 'logout'])->name('logout');
});
