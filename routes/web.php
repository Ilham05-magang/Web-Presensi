<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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



#auth route
Route::get('/login', [AuthController::class, 'loginindex'])->name('login');
Route::get('/register', [AuthController::class, 'registerindex'])->name('register');

Route::post('/register/karyawan', [AuthController::class, 'registerkaryawan'])->name('register.create.karyawan');

Route::get('/admin', [AuthController::class, 'adminindex'])->name('register.admin');
Route::post('/register/admin', [AuthController::class, 'registeradmin'])->name('register.create.admin');

Route::post('/login', [AuthController::class, 'loginUser'])->name('loginUser');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function() {
    Route::get('/adminhome', function () {
        return view('admintesting');})->name('admintesting')->middleware("userAccess:admin");
    Route::get("", [UserController::class,"presensi"])->name("presensi")->middleware("");
    
    Route::middleware(['userAccess:karyawan'])->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('home')->middleware('userAccess:karyawan');
        Route::get('/history-log', [UserController::class, 'historyLog'])->name('historyLog')->middleware('userAccess:karyawan');
        Route::get('/data-ganti-jam', [UserController::class, 'gantiJam'])->name('gantiJam')->middleware('userAccess:karyawan');
    });
});
