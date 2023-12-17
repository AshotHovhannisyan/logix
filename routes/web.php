<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::fallback(function () {
    return response()->view('errors', [], 404);
});

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.post');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register.post');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::post('/profile/change_email', [ProfileController::class, 'changeEmail'])->name('change_email.post');
Route::post('/profile/change_password', [ProfileController::class, 'changePassword'])->name('change_password.post');

Route::get('/profile/password_reset', [ProfileController::class, 'resetPassword'])->name('password.reset.email');
Route::get('/profile/email_reset', [ProfileController::class, 'resetEmail'])->name('email.reset.email');

Route::post('/profile/password_reset', [ProfileController::class, 'resetPassword'])->name('password.reset.email.post');
Route::post('/profile/email_reset', [ProfileController::class, 'resetEmail'])->name('email.reset.email.post');

Route::get('/article', [ArticleController::class, 'index'])->name('article');
Route::get('/article/create', [ArticleController::class, 'create'])->name('create');
Route::post('/article/store', [ArticleController::class, 'store'])->name('store.post');
