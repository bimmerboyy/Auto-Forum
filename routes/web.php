<?php

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\ApprovalMiddleware;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/register', [RegisterController::class, 'index'])->name('register.index');

Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::post('/login', [LoginController::class, 'store'])->middleware(ApprovalMiddleware::class)->name('login');

Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard')->middleware('auth')->middleware(\App\Http\Middleware\ApprovalMiddleware::class);;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/profile',function (){
    return view('profile');
});


