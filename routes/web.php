<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Web\WebLoginController;

Route::get('/login', [WebLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [WebLoginController::class, 'login'])->name('login.post');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
