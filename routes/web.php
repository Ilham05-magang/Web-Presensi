<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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
    return view('user.home',['title'=>"Presensi"]);
});

#auth route
Route::get('/login', [AuthController::class, 'loginindex'])->name('login');
Route::get('/register', [AuthController::class, 'registerindex'])->name('register');

Route::post('/register/karyawan', [AuthController::class, 'registerkaryawan'])->name('register.create.karyawan');

Route::get('/admin', [AuthController::class, 'adminindex'])->name('register.admin');
Route::post('/register/admin', [AuthController::class, 'registeradmin'])->name('register.create.admin');
