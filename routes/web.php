<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\dashboardController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', [DashboardController::class, 'index'])->name('student.index');


Route::get('/', [authController::class, 'login'])->name('auth.login');
Route::post('/storeregister', [authController::class, 'storeregister'])->name('auth.storeregister');
Route::post('/storelogin', [authController::class, 'storelogin'])->name('auth.storelogin');
Route::get('logout', [authController::class, 'logout'])->name('auth.logout');

Route::group(['middleware' => 'login'], function () {
    Route::get('/index', [DashboardController::class, 'index'])->name('student.index');
    Route::post('/store', [DashboardController::class, 'store'])->name('student.store');
    Route::get('/edit/{id}', [DashboardController::class, 'edit'])->name('student.edit');
    Route::post('/update', [DashboardController::class, 'update'])->name('student.update');
    Route::get('/delete/{id}', [DashboardController::class, 'delete'])->name('student.delete');
    Route::post('/import', [DashboardController::class, 'import'])->name('student.import');


});
