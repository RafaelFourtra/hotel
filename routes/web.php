<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KamarController;
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

});


require __DIR__.'/auth.php';
