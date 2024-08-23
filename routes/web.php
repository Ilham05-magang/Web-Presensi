<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Notifications\ResetPassword;

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






Route::middleware('guest')->group(function () {
    Route::get('/admin', [AuthController::class, 'adminindex'])->name('register.admin');
    Route::post('/register/admin', [AuthController::class, 'registeradmin'])->name('register.create.admin');
    Route::get('/register', [AuthController::class, 'registerindex'])->name('register');
    Route::post('/register/karyawan', [AuthController::class, 'registerkaryawan'])->name('register.create.karyawan');
    Route::get('/login', [AuthController::class, 'loginindex'])->name('login');
    Route::post('/login', [AuthController::class, 'loginUser'])->name('loginUser');

    Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('reset-password/{token}', [ResetPassword::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [ResetPassword::class, 'reset'])->name('password.update');
    // tambahkan rute lain yang hanya bisa diakses oleh tamu
});

Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/inactive', [AuthController::class, 'inactive'])->name('inactive');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/adminhome', function () {
        return view('admintesting');
    })->name('admintesting')->middleware("userAccess:admin");

    Route::middleware(['userAccess:karyawan'])->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('home');
        Route::put('/presensi', [UserController::class, 'presensi'])->name('presensi');
        Route::post('/presensi', [UserController::class, 'presensi'])->name('presensi');
        Route::put('/izin', [UserController::class, 'izin'])->name('izin');
    });

    Route::middleware(['userAccess:admin'])->group(function () {
        #Admin Route
        Route::get('/dashboard', [AdminController::class, 'indexAdmin'])->name('dashboard');
        Route::get('/dashboard/presensi', [AdminController::class, 'PresensiAdmin'])->name('dashboard.presensi');
        Route::get('/dashboard/divisi', [AdminController::class, 'DivisiAdmin'])->name('dashboard.divisi');
        Route::get('/dashboard/laporan', [AdminController::class, 'LaporanAdmin'])->name('dashboard.laporan');
        Route::get('/dashboard/karyawan', [AdminController::class, 'KaryawanAdmin'])->name('dashboard.karyawan');
        Route::get('/dashboard/pengaturan', [AdminController::class, 'PengaturanAdmin'])->name('dashboard.pengaturan');
    });
});
