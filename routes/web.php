<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\GajiKaryawanController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\PengaturanController;

use App\Http\Controllers\UserController;
use App\Models\GajiKaryawan;

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

    Route::get('/forgot-password', [PasswordController::class, 'showForgotPasswordForm'])
        ->middleware('guest')
        ->name('password.request');

    Route::post('/forgot-password', [PasswordController::class, 'sendResetLinkEmail'])
        ->middleware('guest')
        ->name('password.email');

    Route::get('/reset-password/{token}', [PasswordController::class, 'showResetPasswordForm'])
        ->middleware('guest')
        ->name('password.reset');

    Route::post('/reset-password', [PasswordController::class, 'resetPassword'])
        ->middleware('guest')
        ->name('password.update');
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

        #Api Dashboard
        Route::get('/dashboard', [AdminController::class, 'indexAdmin'])->name('dashboard');

        #Api Divisi
        Route::get('/dashboard/divisi', [DivisiController::class, 'DivisiAdmin'])->name('dashboard.divisi');
        Route::get('/dashboard/divisi/{id}', [DivisiController::class, 'DetailDivisiAdmin'])->name('dashboard.divisi.show');
        Route::post('/dashboard/tambahdivisi', [DivisiController::class, 'TambahDivisi'])->name('dashboard.divisi.Tambah');
        Route::put('/dashboard/editdivisi/{id}', [DivisiController::class, 'EditDivisi'])->name('dashboard.divisi.Edit');
        Route::delete('/dashboard/deletedivisi/{id}', [DivisiController::class, 'DeleteDivisi'])->name('dashboard.divisi.Delete');
        Route::get('/dashboard/searchdivisi', [DivisiController::class, 'SearchDivisi'])->name('dashboard.divisi.Search');


        #Api Laporan
        Route::get('/dashboard/gaji', [GajiController::class, 'gajiAdmin'])->name('dashboard.gaji');
        Route::get('/dashboard/gaji/default/{id}', [GajiController::class, 'defaultGaji'])->name('dashboard.gaji.default');
        Route::post('/dashboard/gaji/postdefault/{id}', [GajiController::class, 'TambahDefaultGaji'])->name('dashboard.gaji.tambahdefault');
        Route::put('/dashboard/gaji/editdefault/{id}', [GajiController::class, 'EditDefaultGaji'])->name('dashboard.gaji.editdefault');
        Route::delete('/dashboard/gaji/deletedefault/{id}', [GajiController::class, 'DeleteDefaultGaji'])->name('dashboard.gaji.deletedefault');


        Route::get('/dashboard/gaji/input/{id}', [GajiController::class, 'inputGaji'])->name('dashboard.gaji.input');
        Route::get('/dashboard/gaji/searchinput/{id}', [GajiController::class, 'SearchInputGaji'])->name('dashboard.gaji.input.search');
        Route::get('/dashboard/gaji/riwayat/{id}', [GajiController::class, 'riwayatGaji'])->name('dashboard.gaji.riwayat');
        Route::post('/dashboard/gaji/postgaji/{id}', [GajiController::class, 'PostGajiKaryawan'])->name('dashboard.post.gaji');
        Route::get('/dashboard/gaji/detail', [GajiController::class, 'showDetailGaji'])->name('dashboard.gaji.detail');

        #Api Pengaturan
        Route::get('/dashboard/pengaturan/profile', [PengaturanController::class, 'PengaturanProfile'])->name('dashboard.pengaturan.profile');
        Route::put('/dashboard/pengaturan/editprofile/{id}', [PengaturanController::class, 'PengaturanEditProfile'])->name('dashboard.pengaturan.editprofile');

        Route::get('/dashboard/pengaturan/kantor', [PengaturanController::class, 'PengaturanKantor'])->name('dashboard.pengaturan.kantor');
        Route::post('/dashboard/pengaturan/tambahkantor', [PengaturanController::class, 'PengaturanTambahKantor'])->name('dashboard.pengaturan.tambahkantor');
        Route::put('/dashboard/pengaturan/editkantor/{id}', [PengaturanController::class, 'PengaturanEditKantor'])->name('dashboard.pengaturan.editkantor');
        Route::delete('/dashboard/pengaturan/deletekantor/{id}', [PengaturanController::class, 'PengaturanDeleteKantor'])->name('dashboard.pengaturan.deletekantor');

        Route::get('/dashboard/pengaturan/shift', [PengaturanController::class, 'PengaturanShift'])->name('dashboard.pengaturan.shift');
        Route::post('/dashboard/pengaturan/tambahshift', [PengaturanController::class, 'PengaturanTambahShift'])->name('dashboard.pengaturan.tambahshift');
        Route::put('/dashboard/pengaturan/editshift/{id}', [PengaturanController::class, 'PengaturanEditShift'])->name('dashboard.pengaturan.editshift');
        Route::delete('/dashboard/pengaturan/deleteshift/{id}', [PengaturanController::class, 'PengaturanDeleteShift'])->name('dashboard.pengaturan.deleteshift');


        Route::get('/dashboard/pengaturan/tanggal', [PengaturanController::class, 'PengaturanTanggal'])->name('dashboard.pengaturan.tanggal');
        Route::post('/dashboard/pengaturan/tambahTanggal', [PengaturanController::class, 'PengaturanTambahTanggal'])->name('dashboard.pengaturan.tambahtanggal');
        Route::put('/dashboard/pengaturan/edittanggal/{id}', [PengaturanController::class, 'PengaturanEditTanggal'])->name('dashboard.pengaturan.edittanggal');
        Route::delete('/dashboard/pengaturan/deletetanggal/{id}', [PengaturanController::class, 'PengaturanDeleteTanggal'])->name('dashboard.pengaturan.deletetanggal');

        Route::get('/dashboard/pengaturan/quotes', [PengaturanController::class, 'PengaturanQuotes'])->name('dashboard.pengaturan.quotes');
        Route::post('/dashboard/pengaturan/tambahquote', [PengaturanController::class, 'PengaturanTambahQuote'])->name('dashboard.pengaturan.tambahquote');
        Route::put('/dashboard/pengaturan/editquote/{id}', [PengaturanController::class, 'PengaturanEditQuote'])->name('dashboard.pengaturan.editquote');
        Route::delete('/dashboard/pengaturan/deletequote/{id}', [PengaturanController::class, 'PengaturanDeleteQuote'])->name('dashboard.pengaturan.deletequote');


        #Api Karyawan
        Route::get('/dashboard/karyawan', [KaryawanController::class, 'KaryawanAdmin'])->name('dashboard.karyawan');
        Route::get('/dashboard/karyawan/{id}', [KaryawanController::class, 'KaryawanDetailAdmin'])->name('dashboard.karyawan.show');
        Route::put('/dashboard/editkaryawan/{id}', [KaryawanController::class, 'EditKaryawanAdmin'])->name('dashboard.editkaryawan');
        Route::delete('/dashboard/deletekaryawan/{id}', [KaryawanController::class, 'DeleteKaryawanAdmin'])->name('dashboard.deletekaryawan');
        Route::get('/dashboard/pencariankaryawan', [KaryawanController::class, 'SearchKaryawanAdmin'])->name('dashboard.searchkaryawan');

        #Api Presensi
        Route::get('/dashboard/presensi', [PresensiController::class, 'PresensiAdmin'])->name('dashboard.presensi');
        Route::get('/dashboard/presensi/{id}', [PresensiController::class, 'ShowDetailAbsensi'])->name('dashboard.presensi.detail');
        Route::get('/dashboard/Searchpresensi/{id}', [PresensiController::class, 'SearchAbsensiByPeriode'])->name('dashboard.presensi.searchdetail');
        Route::get('/dashboard/pencarianpresensi/{tanggal}', [PresensiController::class, 'SearchPresensiAdmin'])->name('dashboard.searchpresensi');
        Route::get('/dashboard/pencarianbydatepresensi', [PresensiController::class, 'SearchPresensibyDateAdmin'])->name('dashboard.searchpresensibydate');
        Route::post('/dashboard/postpresensi/{tanggal}/{id}', [PresensiController::class, 'PostKehadiran'])->name('dashboard.postpresensi');
        Route::put('/dashboard/editpresensi/{id}', [PresensiController::class, 'EditPresensi'])->name('dashboard.editpresensi');
        Route::delete('/dashboard/editpresensi/{id}', [PresensiController::class, 'DeleteAbsensi'])->name('dashboard.deletepresensi');
    });
});
