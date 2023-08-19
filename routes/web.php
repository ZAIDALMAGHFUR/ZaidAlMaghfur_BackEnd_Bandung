<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Agent\MobileController;
use App\Http\Controllers\Agent\ProfileController;
use App\Http\Controllers\User\UserSewaController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Agent\DashboardController;
use App\Http\Controllers\Agent\SewaMobilController;
use App\Http\Controllers\User\ReqToAgentController;
use App\Http\Controllers\Admin\AdminAgentController;
use App\Http\Controllers\Admin\AdminMobilController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\UserRetruntController;
use App\Http\Controllers\User\cekUserAgentController;
use App\Http\Controllers\Agent\RetruntMobilController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\Admin\AdminAccAgentController;
use App\Http\Controllers\Admin\AdminUserSewaController;
use App\Http\Controllers\Admin\AdminUserRetruntController;



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

    Route::controller(AdminMobilController::class)->prefix('admin/mobile')->group(function () {
        Route::get('', 'index')->name('admin/mobile');
        Route::get('/create', 'create')->name('admin/mobile.create');
        Route::post('/store', 'store')->name('admin/mobile.store');
        Route::get('/show/{id}', 'show')->name('admin/mobile.show');
        Route::get('/edit/{id}', 'edit')->name('admin/mobile.edit');
        Route::post('/update/{id}', 'update')->name('admin/mobile.update');
        Route::delete('/destroy/{id}', 'destroy')->name('admin/mobile.destroy');
    });

    Route::controller(AdminUserController::class)->prefix('admin/user')->group(function () {
        Route::get('', 'index')->name('admin/user');
    });

    Route::controller(AdminAgentController::class)->prefix('admin/agent')->group(function () {
        Route::get('', 'index')->name('admin/agent');
    });


    Route::controller(AdminUserSewaController::class)->prefix('admin/user/sewa')->group(function () {
        Route::get('', 'index')->name('admin/user/sewa');
    });

    Route::controller(AdminUserRetruntController::class)->prefix('admin/user/retrunt')->group(function () {
        Route::get('', 'index')->name('admin/user/retrunt');
    });

    Route::controller(AdminAccAgentController::class)->prefix('admin/user/acc')->group(function () {
        Route::get('', 'index')->name('admin/user/acc');
        Route::post('/acc/{id}', 'acc')->name('admin/user/acc/acc');
    });
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



Route::group(['middleware' => ['auth', 'OnlyTes']], function () {
    Route::get('/user', [UserDashboardController::class, 'index'])->name('user');

    Route::controller(UserProfileController::class)->prefix('user/profile')->group(function () {
        Route::get('', 'index')->name('user/profile');
        Route::put('/user/update/profile', 'updatePassword')->name('user/profile/update');
    });


    Route::controller(UserSewaController::class)->prefix('user/sewa')->group(function () {
        Route::get('', 'index')->name('user/sewa');
        Route::get('/create', 'create')->name('user/sewa/create');
        Route::post('/store', 'store')->name('user/sewa/store')->middleware('CekUserPay:false');
        Route::get('/pay/{id}', 'pay')->name('user/sewa/pay');
        // Route::get('/get-harga', 'getHarga')->name('sewa.get-harga');
    });

    Route::controller(UserRetruntController::class)->prefix('user/retrunt')->group(function () {
        Route::get('', 'index')->name('user/retrunt');
        Route::post('/retruntCar', 'returnCar')->name('user/retrunt/retruntCar');
    });

    Route::controller(ReqToAgentController::class)->prefix('user/req')->group(function () {
        Route::get('', 'index')->name('user/req');
        Route::post('/reqagent', 'store')->name('user/req/post');
    });


    Route::get('/cek', [cekUserAgentController::class, 'index'])->name('cek');

});


