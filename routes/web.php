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


Route::prefix('admin')->group(function () {
    Route::get('index', function () {
        return view('admin.layouts.index');
    });

    Route::prefix('hocsinh')->group(function () {
        Route::get('danhsach', function () {
            return view('admin.hocsinh.danhsach');
        });
        Route::get('them', function () {
            return view('admin.hocsinh.them');
        });
    });

    Route::prefix('giaovien')->group(function () {
        Route::get('danhsach', function () {
            return view('admin.giaovien.danhsach');
        });
        Route::get('them', function () {
            return view('admin.giaovien.them');
        });
    });

    Route::prefix('phuhuynh')->group(function () {
        Route::get('danhsach', function () {
            return view('admin.phuhuynh.danhsach');
        });
        Route::get('them', function () {
            return view('admin.phuhuynh.them');
        });
    });

    Route::prefix('lop')->group(function () {
        Route::get('danhsach', function () {
            return view('admin.lop.danhsach');
        });
        Route::get('them', function () {
            return view('admin.lop.them');
        });
    });
    Route::prefix('khoi')->group(function () {
        Route::get('danhsach', function () {
            return view('admin.khoi.danhsach');
        });
        Route::get('them', function () {
            return view('admin.khoi.them');
        });
    });
});

Route::prefix('login')->group(function () {
    Route::get('index', function () {
        return view("login.index");
    });
});