<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\ApprovalMiddleware;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

// Registration and Login routes
Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login');
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

// Middleware for approval
Route::middleware([ApprovalMiddleware::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
});

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');

//Contact route
Route::get('/autoforum-info', [ContactController::class, 'index'])->name('autoforum.info');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');


// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/topics', [TopicController::class, 'index'])->name('topics.index');
    Route::get('/topics/create', [TopicController::class, 'create'])->name('topics.create');
    Route::post('/topics', [TopicController::class, 'store'])->name('topics.store');
    Route::patch('/topics/{id}/close', [TopicController::class, 'close'])->name('topics.close');
    Route::get('/topics/{id}', [TopicController::class, 'show'])->name('topics.show');
    Route::post('/topics/{id}/posts', [PostController::class, 'store'])->name('posts.store');
    Route::post('/posts/{id}/like', [PostController::class, 'likePost'])->name('posts.like');
    Route::post('/posts/{id}/dislike', [PostController::class, 'dislikePost'])->name('posts.dislike');
    Route::post('/topics/{topic}/follow', [TopicController::class, 'follow'])->name('topics.follow');
    Route::post('/topics/{topic}/unfollow', [TopicController::class, 'unfollow'])->name('topics.unfollow');
    Route::post('/topics/ban', [TopicController::class, 'banUser'])->name('topics.banUser');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/news', [NewsController::class, 'store'])->name('news.store');
    Route::post('/posts/{post}/reply', [PostController::class, 'reply'])->name('posts.reply');
    Route::get('/profile/change-password', [ProfileController::class, 'showChangePasswordForm'])->name('profile.change-password');
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password.update');
    Route::get('/polls/create/{topic}', [PollController::class, 'create'])->name('polls.create');
    Route::post('/polls/store', [PollController::class, 'store'])->name('polls.store');
    Route::post('/profile/change-status', [ProfileController::class, 'changeStatus'])->name('profile.changeStatus');
    Route::post('/profile/delete-user', [ProfileController::class, 'deleteUser'])->name('profile.deleteUser');
    Route::post('/profile/change-usertype', [ProfileController::class, 'changeUsertype'])->name('profile.changeUsertype');
});


