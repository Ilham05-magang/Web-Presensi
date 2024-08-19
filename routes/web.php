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
// route user
Route::get('/', function () {
    return view('user.home',['title'=>"Presensi"]);
});
Route::get('/login', function () {
    return view('auth.login',['title'=>"Masuk akun"]);
});
Route::get('/register', function () {
    return view('auth.register',['title'=>"Buat akun"]);
});
