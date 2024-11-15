<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GabunganController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SupplierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/items', [ItemController::class, 'index']);
Route::post('/items', [ItemController::class, 'store']);
Route::get('/category', [CategoryController::class, 'index']);
Route::post('/category', [CategoryController::class, 'store']);
Route::get('/supplier', [SupplierController::class, 'index']);
Route::post('/supplier', [SupplierController::class, 'store']);
Route::get('/ringkasan-stok', [ItemController::class, 'ringkasanStok']);
Route::get('/minimum-stok', [ItemController::class, 'stokDiBawahAmbang']);
Route::post('/per-category', [ItemController::class, 'barangPerKategori']);
Route::get('/ringkasan-category', [CategoryController::class, 'ringkasanPerKategori']);
Route::get('/ringkasan-pemasok', [SupplierController::class, 'ringkasanBarangPerPemasok']);
Route::get('/ringkasan-all', [ItemController::class, 'ringkasanKeseluruhan']);