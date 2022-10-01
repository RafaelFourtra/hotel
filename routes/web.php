<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\RiwayatPenjualanController;
use App\Http\Controllers\LaporanController;
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
    return view('auth.login');
});

Route::group(['middleware' => ['auth']], function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout',[DashboardController::class, 'Logout'])->name('logout');

    Route::resource('/kamar', KamarController::class);
    Route::get('/edit/{id}', [KamarController::class, 'edit'])->name('kamar.edit');
    Route::post('/update/{id}', [KamarController::class, 'update'])->name('kamar.update');
    Route::get('/delete/{id}', [KamarController::class, 'delete'])->name('kamar.delete');

    
    Route::post('/store', [PenjualanController::class, 'store'])->name('penjualan.store');
    Route::resource('/penjualan', PenjualanController::class);

    Route::resource("/riwayatpenjualan",RiwayatPenjualanController::class);
    Route::get('/detailriwayat/{id}', [RiwayatPenjualanController::class, 'show'])->name('riwayatpenjualan.show');
    Route::get('/edittrans/{id}', [RiwayatPenjualanController::class, 'edit']);
    Route::post('/updatetrans/{id}', [RiwayatPenjualanController::class, 'update']);
    Route::get('/searchfromdate', [RiwayatPenjualanController::class, 'searchfromDate']);
    Route::get('/riwayatpenjualan/cetakstruk/{id}', [RiwayatPenjualanController::class, 'print']);

    Route::match(['get', 'post'], "/laporan", [LaporanController::class, 'index'])->name('laporan.index');
    Route::match(['get', 'post'], "/laporanbulanan", [LaporanController::class, 'bulanan'])->name('laporan.bulanan');
    Route::get('/exportlaporan/{datefrom}/{dateto}', [LaporanController::class, 'export']);
    Route::get('/exportlaporanbulanan/{datefrom}/{dateto}', [LaporanController::class, 'exportbulanan']);

});


require __DIR__.'/auth.php';
