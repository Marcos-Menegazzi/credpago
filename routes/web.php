<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('address')->group(function() {
    Route::get('/', [App\Http\Controllers\AddressController::class, 'index'])->name('address.index');
    Route::get('/refresh', [App\Http\Controllers\AddressController::class, 'refresh'])->name('address.refresh');
    Route::get('/create', [App\Http\Controllers\AddressController::class, 'create'])->name('address.create');
    Route::post('/store', [App\Http\Controllers\AddressController::class, 'store'])->name('address.store');
    Route::get('/show/{address}', [App\Http\Controllers\AddressController::class, 'show'])->name('address.show');
    Route::get('/edit/{address}', [App\Http\Controllers\AddressController::class, 'edit'])->name('address.edit');
    Route::put('/update/{address}', [App\Http\Controllers\AddressController::class, 'update'])->name('address.update');
    Route::delete('/destroy/{address}', [App\Http\Controllers\AddressController::class, 'destroy'])->name('address.destroy');
    Route::get('/details/{address}', [App\Http\Controllers\AddressController::class, 'details'])->name('address.details');
});