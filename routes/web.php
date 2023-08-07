<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\MobileController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\SewaMobilController;
use App\Http\Controllers\User\RetruntMobilController;



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

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'OnlyAdmin']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});


Route::group(['middleware' => ['auth', 'OnlyUsers']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::controller(ProfileController::class)->prefix('profile')->group(function () {
        Route::get('', 'index')->name('profile');
        Route::put('/user-update', 'updatePassword')->name('profile.update');
    });

    Route::controller(MobileController::class)->prefix('mobile')->group(function () {
        Route::get('', 'index')->name('mobile');
        Route::get('/create', 'create')->name('mobile.create');
        Route::post('/store', 'store')->name('mobile.store');
        Route::get('/show/{id}', 'show')->name('mobile.show');
        Route::get('/edit/{id}', 'edit')->name('mobile.edit');
        Route::post('/update/{id}', 'update')->name('mobile.update');
        Route::delete('/destroy/{id}', 'destroy')->name('mobile.destroy');
    });

    Route::controller(SewaMobilController::class)->prefix('sewa')->group(function () {
        Route::get('', 'index')->name('sewa');
        Route::get('/create', 'create')->name('sewa.create');
        Route::post('/store', 'store')->name('sewa.store');
        // Route::get('/get-harga', 'getHarga')->name('sewa.get-harga');
    });


    Route::controller(RetruntMobilController::class)->prefix('retrunt')->group(function () {
        Route::get('', 'index')->name('retrunt');
        Route::post('/retruntCar', 'returnCar')->name('retrunt.retruntCar');
    });

});



