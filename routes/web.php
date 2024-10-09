<?php

use App\Http\Controllers\dashboard\AuthController;
use App\Http\Controllers\dashboard\ContactUsController;
use App\Http\Controllers\dashboard\SubscriptionController;
use App\Http\Controllers\dashboard\UserController;
use App\Http\Controllers\dashboard\PostController;
use App\Http\Controllers\dashboard\UserSubscriptionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\homePageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'customLogin'])->name('customLogin');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'customRegister'])->name('customRegister');
Route::get('/forget-password', [AuthController::class, 'forgetPassword'])->name('forgetPassword');
Route::post('/forget-password', [AuthController::class, 'customForgetPassword'])->name('resetPassword');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/', [homePageController::class, 'index'])->name('home');

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('home.dashboard');

    //this user routes for dashboard
    Route::resource('users', UserController::class);
    Route::put('/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');

    //this user posts routes for dashboard
    Route::resource('posts', PostController::class);

    //this user subscriptions routes for dashboard
    Route::resource('subscriptions', SubscriptionController::class);

    //this user subscriptions routes for dashboard
    Route::resource('user_subscriptions', UserSubscriptionController::class);

    //this contact us routes for dashboard
    Route::resource('contact_us', ContactUsController::class);

});
