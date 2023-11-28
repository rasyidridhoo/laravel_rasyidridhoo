<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainMenuController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\RumahsakitController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticating'])->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/main', [MainMenuController::class, 'index'])->name('main.index')->middleware('auth');

//Rumah Sakit
Route::get('/rumahsakit', [RumahsakitController::class, 'index'])->name('rumahsakit.index')->middleware('auth');
Route::get('/rumahsakit/create', [RumahsakitController::class, 'create'])->name('rumahsakit.create')->middleware('auth');
Route::post('/rumahsakit/store', [RumahsakitController::class, 'store'])->name('rumahsakit.store')->middleware('auth');
Route::delete('/rumahsakit/{id}/delete', [RumahsakitController::class, 'destroy'])->name('rumahsakit.destroy')->middleware('auth');
Route::get('/rumahsakit/{id}/edit', [RumahsakitController::class, 'edit'])->name('rumahsakit.edit')->middleware('auth');
Route::put('/rumahsakit/{id}/update', [RumahsakitController::class, 'update'])->name('rumahsakit.update')->middleware('auth');

//Pasien
Route::get('/pasien', [PasienController::class, 'index'])->name('pasien.index')->middleware('auth');
Route::get('/pasien/create', [PasienController::class, 'create'])->name('pasien.create')->middleware('auth');
Route::post('/pasien/store', [PasienController::class, 'store'])->name('pasien.store')->middleware('auth');
Route::delete('/pasien/{id}/delete', [PasienController::class, 'destroy'])->name('pasien.destroy')->middleware('auth');
Route::get('/pasien/{id}/edit', [PasienController::class, 'edit'])->name('pasien.edit')->middleware('auth');
Route::put('/pasien/{id}/update', [PasienController::class, 'update'])->name('pasien.update')->middleware('auth');

Route::get('/filterPasien', [PasienController::class, 'filterPasien'])->name('filter.pasien')->middleware('auth');

