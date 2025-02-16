<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

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

Route::get('/', [PageController::class, 'viewLoginPage'])->middleware('guest')->name('login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [PageController::class, 'viewDashboardPage'])->name('dashboard');
    Route::get('user/{username}', [PageController::class, 'viewManageUserPage'])->name('manage-user');
    Route::get('user/logs/{username}', [PageController::class, 'viewUserLogsPage'])->name('user-logs');

    // auth
    Route::post('logout', [UserController::class, 'logout'])->name('logout');
});