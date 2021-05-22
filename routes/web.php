<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DtrController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\admin\accountController;
use App\Http\Controllers\UpdateAccountController;
use App\Http\Controllers\admin\MessageController as AdminMessageController;

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
Route::redirect('/', 'login');
Auth::routes(['request' => false, 'reset' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('/dtr', DtrController::class)->middleware('auth');

Route::put('update-account', UpdateAccountController::class)->middleware('auth');

Route::resource('admin-accounts', accountController::class)->middleware('auth');
Route::resource('admin-messages', AdminMessageController::class)->middleware('auth');
Route::resource('messages', MessageController::class);
Route::resource('notifications', NotificationController::class)->middleware('auth');