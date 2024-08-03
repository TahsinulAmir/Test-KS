<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProdukController;
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

Route::get('/', [ProdukController::class, 'index']);

Route::get('/login', [AuthController::class, 'index']);
Route::post('/prosesLogin', [AuthController::class, 'prosesLogin']);
Route::get('/prosesLogout', [AuthController::class, 'prosesLogout']);

Route::get('/keranjang', [KeranjangController::class, 'keranjang']);
Route::post('/tambah-keranjang', [KeranjangController::class, 'tambahKeranjang']);
Route::post('/hapusKeranjang/{id}', [KeranjangController::class, 'hapusKeranjang']);
Route::post('/updateJumlah/{id}', [KeranjangController::class, 'updateKeranjang']);

Route::get('/order', [OrderController::class, 'index']);
Route::get('/order/{id}', [OrderController::class, 'detailOrder']);
Route::post('/prosesOrder', [OrderController::class, 'prosesCheckout']);
Route::post('/prosesPembayaran/{id}', [OrderController::class, 'prosesPembayaran']);
