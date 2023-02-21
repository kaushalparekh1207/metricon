<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', function () {
    return view('login');
});

Route::controller(AdminController::class)->group(function () {

    // Login Routes
    Route::view('/login', 'login')->name('login');
    Route::post('/admin_login', 'adminLogin');

    // Logout Routes
    // Route::get('/signout', function () {
    //     if (session('user')) {
    //         session()->pull('user');
    //         session()->pull('f_year_id');
    //     }
    //     return redirect('login');
    // });
});

Route::controller(DashboardController::class)->group(function () {

    // Login Routes
    Route::view('/dashboard', 'index');
    // Route::post('/admin_login', 'adminLogin');
});
