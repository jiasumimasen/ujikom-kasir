<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EditController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();
// Route::get('/', function () {
//     return view('pages');
// });
Route::middleware(['auth'])->group(function () {
    // Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    // Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/', [UserController::class, 'store'])->name('user.store');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    });
    // Route::get('/order', [OrderController::class, 'index'])->name('order');
    // Route::get('/laporan', [OrderController::class, 'index'])->name('laporan');
    Route::get('/general', [LaporanController::class, 'index'])->name('general');
    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction');
    Route::post('/transaction', [TransactionController::class, 'store'])->name('transaction.store');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::post('/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');

    // Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::resource('transaksi', TransaksiController::class);

    // Route::get('/report', [ReportController::class, 'index'])->name('report');
    Route::get('/barang', [BarangController::class, 'index'])->name('barang');
    Route::get('/tambahbarang', [BarangController::class, 'create'])->name('tambahbarang');
    Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

    // Route::get('/menus/show', [MenuController::class, 'index'])->name('show');
    // Route::get('/menu', MenuController::class)->middleware('auth')->missing(fn () => redirect()->back());
    // Route::resource('barang', BarangController::class);
    // Route::resource('kategori', KategoriController::class);
    Route::get('/tambahkategori', [KategoriController::class, 'create'])->name('tambahkategori');
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
});
