<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SppController;
use App\Http\Controllers\KelaController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PembayaranController;

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

Auth::routes();

Route::group(['middleware' => ['auth']], function()
{
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/', function () {
        return view('welcome');
    });
    
    // SPP
    Route::get('/spps', [SppController::class, 'index'])->name('spps');    
    Route::get('/spp/create', [SppController::class, 'create'])->name('spp.create');    
    Route::post('/spp/create', [SppController::class, 'store'])->name('spp.store');    
    Route::get('/spp/{id}/edit', [SppController::class, 'edit'])->name('spp.edit');    
    Route::patch('/spp/{id}/update', [SppController::class, 'update'])->name('spp.update');    
    Route::delete('/spp/{id}/destroy', [SppController::class, 'destroy'])->name('spp.destroy');    

    // Kelas
    Route::get('/kelas', [KelaController::class, 'index'])->name('kelas');    
    Route::get('/kela/create', [KelaController::class, 'create'])->name('kela.create');    
    Route::post('/kela/create', [KelaController::class, 'store'])->name('kela.store');    
    Route::get('/kela/{id}/edit', [KelaController::class, 'edit'])->name('kela.edit');    
    Route::patch('/kela/{id}/update', [KelaController::class, 'update'])->name('kela.update');    
    Route::delete('/kela/{id}/destroy', [KelaController::class, 'destroy'])->name('kela.destroy');    

    // Siswa
    Route::get('/siswas', [SiswaController::class, 'index'])->name('siswas');    
    Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');    
    Route::post('/siswa/create', [SiswaController::class, 'store'])->name('siswa.store');    
    Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');    
    Route::patch('/siswa/{id}/update', [SiswaController::class, 'update'])->name('siswa.update');    
    Route::delete('/siswa/{id}/destroy', [SiswaController::class, 'destroy'])->name('siswa.destroy');    

    // Pembayaran
    Route::get('/pembayarans', [PembayaranController::class, 'index'])->name('pembayarans');    
    Route::get('/pembayaran/create', [PembayaranController::class, 'create'])->name('pembayaran.create');    
    Route::post('/pembayaran/create', [PembayaranController::class, 'store'])->name('pembayaran.store');    
    Route::get('/pembayaran/{id}/edit', [PembayaranController::class, 'edit'])->name('pembayaran.edit');    
    Route::get('/pembayaran/{id}/show', [PembayaranController::class, 'show'])->name('pembayaran.show');    
    Route::patch('/pembayaran/{id}/update', [PembayaranController::class, 'update'])->name('pembayaran.update');    
    Route::delete('/pembayaran/{id}/destroy', [PembayaranController::class, 'destroy'])->name('pembayaran.destroy');    

    // Get Data SPP
    Route::get('pembayaran/get-data/{nisn}', [PembayaranController::class, 'getDataSpp']);

    // Export Excel
    Route::get('/pembayaran/export/excel', [PembayaranController::class, 'exportExcel'])->name('pembayaran.export');

    // Riwayat Pembayaran
    Route::get('/pembayaran/riwayat', [PembayaranController::class, 'riwayatPembayaran'])->name('pembayaran.riwayat');
    
    });