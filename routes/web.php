<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

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
Route::get('/history-log', function () {
    return view('user.history-log',['title'=>"History log"]);
});
Route::get('/data-ganti-jam', function () {
    return view('user.data-ganti-jam',['title'=>"Data ganti jam"]);
});

#auth route
Route::get('/login', [AuthController::class, 'loginindex'])->name('login');
Route::get('/register', [AuthController::class, 'registerindex'])->name('register');

Route::post('/register/karyawan', [AuthController::class, 'registerkaryawan'])->name('register.create.karyawan');

Route::get('/admin', [AuthController::class, 'adminindex'])->name('register.admin');
Route::post('/register/admin', [AuthController::class, 'registeradmin'])->name('register.create.admin');


#Admin Route
Route::get('/dashboard', [AdminController::class, 'indexAdmin'])->name('dashboard');
Route::get('/dashboard/presensi', [AdminController::class, 'PresensiAdmin'])->name('dashboard.presensi');
Route::get('/dashboard/divisi', [AdminController::class, 'DivisiAdmin'])->name('dashboard.divisi');
Route::get('/dashboard/laporan', [AdminController::class, 'LaporanAdmin'])->name('dashboard.laporan');
Route::get('/dashboard/karyawan', [AdminController::class, 'KaryawanAdmin'])->name('dashboard.karyawan');
Route::get('/dashboard/pengaturan', [AdminController::class, 'PengaturanAdmin'])->name('dashboard.pengaturan');
