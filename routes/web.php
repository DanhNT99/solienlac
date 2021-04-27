<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController\HocSinhController;
use App\Http\Controllers\MyController\GiaoVienController;
use App\Http\Controllers\MyController\LoginController;

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


Route::prefix('admin')->group(function () {
    Route::get('index', function () {
        return view('admin/layouts/index');
    });
    Route::post('index', [LoginController::class,'handleLogout'])->name('handleLogout');

    Route::prefix('hocsinh')->group(function () {
        Route::get('danhsach', [HocSinhController::class,'index']);
        Route::get('them', [HocSinhController::class, 'indexThem']);
    });

    Route::prefix('giaovien')->group(function () {
        Route::get('danhsach', [GiaoVienController::class,'index']);
        Route::get('them', [GiaoVienController::class,'indexThem']);
    });
});

Route::prefix('login')->group(function () {
    Route::get('index',[LoginController::class, 'index']);
    Route::post('index',[LoginController::class, 'handleLogin'])->name('handleLogin');
    
});

    
