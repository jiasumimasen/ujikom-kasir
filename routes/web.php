<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EditController;

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
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
Route::get('/user', [UserController::class, 'index'])->name('user');
Route::get('/order', [OrderController::class, 'index'])->name('order');
Route::get('/laporan', [OrderController::class, 'index'])->name('laporan');
Route::get('/general', [LaporanController::class, 'index'])->name('general');
Route::get('/order/edit', [OrderController::class, 'edit'])->name('order.edit');
Route::get('/item/create', [EditController::class, 'update'])->name('create');
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
// Route::get('/menus/show', [MenuController::class, 'index'])->name('show');
// Route::get('/menu', MenuController::class)->middleware('auth')->missing(fn () => redirect()->back());
