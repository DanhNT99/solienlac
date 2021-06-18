<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController\LoginController;
use App\Http\Controllers\MyController\PassController;

use App\Http\Controllers\MyController\PhuHuynhController;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\GiaoVien;
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

Route::group(['middleware' => 'AuthCheck', 'prefix' =>'admin'], function () {


    Route::post('index', [LoginController::class,'handleLogout'])->name('handleLogout');

    Route::group(['middleware' => 'CheckRole:Giáo viên chủ nhiệm|Quản trị viên'], function () {
        Route::get('index', function () {
            return view('admin/home/index');
        });

        Route::resource('hocsinh', 'App\Http\Controllers\MyController\HocSinhController');
        //roure delete student

        Route::get('hocsinh/{id}/delete', 'App\Http\Controllers\MyController\HocSinhController@delete');
        //route search student
        
        Route::get('searchStudent', 'App\Http\Controllers\MyController\HocSinhController@getSearch')->name('searchStudent'); 

        Route::resource('solienlac', 'App\Http\Controllers\MyController\SLLController');
    });

    Route::group(['middleware' => 'CheckRole:Giáo viên chủ nhiệm'], function () {

        Route::resource('ketquahoctap', 'App\Http\Controllers\MyController\KQHTController');

        Route::get('timkiemketquahoctap/{id}', 'App\Http\Controllers\MyController\KQHTController@getSearch');

        Route::resource('ketquarenluyen', 'App\Http\Controllers\MyController\KQRLController');
    });

    

    Route::group(['middleware' => 'CheckRole:Quản trị viên'], function () {

        Route::resource('phamchatnangluc', 'App\Http\Controllers\MyController\PCNLController');

        Route::resource('khoi', 'App\Http\Controllers\MyController\KhoiController');

        Route::get('khoi/{id}/delete', 'App\Http\Controllers\MyController\KhoiController@delete');

        Route::resource('lop', 'App\Http\Controllers\MyController\LopController');

        Route::get('lop/{id}/delete', 'App\Http\Controllers\MyController\LopController@delete');

        Route::resource('monhoc', 'App\Http\Controllers\MyController\MonHocController');

        Route::get('monhoc/{id}/delete', 'App\Http\Controllers\MyController\MonHocController@delete');

        Route::resource('phanmonhoc', 'App\Http\Controllers\MyController\PhanMonHocController');

        Route::get('phanmonhoc/{id}/delete', 'App\Http\Controllers\MyController\PhanMonHocController@delete');

        Route::resource('nienkhoa', 'App\Http\Controllers\MyController\NienKhoaController');

        Route::get('nienkhoa/{id}/delete', 'App\Http\Controllers\MyController\NienKhoaController@delete');

        Route::resource('hocky', 'App\Http\Controllers\MyController\HocKyController');

        Route::get('hocky/{id}/delete', 'App\Http\Controllers\MyController\HocKyController@delete');

        Route::resource('loaihocky', 'App\Http\Controllers\MyController\LoaiHocKyController');
    
        Route::get('loaihocky/{id}/delete', 'App\Http\Controllers\MyController\LoaiHocKyController@delete');
    
        Route::resource('tinh', 'App\Http\Controllers\MyController\TinhController');

        Route::resource('phuong', 'App\Http\Controllers\MyController\PhuongController');

        Route::resource('hoc', 'App\Http\Controllers\MyController\PCHTController');

        Route::get('hoc/{id}/delete', 'App\Http\Controllers\MyController\PCHTController@delete');

        Route::resource('giaovien', 'App\Http\Controllers\MyController\GiaoVienController');

        Route::get('searchTeach', 'App\Http\Controllers\MyController\GiaoVienController@getSearch')->name('searchTeach'); 

        Route::get('giaovien/{id}/delete', 'App\Http\Controllers\MyController\GiaoVienController@delete');

        Route::post('giaovien/excel', 'App\Http\Controllers\MyController\GiaoVienController@importExcel')->name('importExcel');

        Route::resource('phanconggiangday', 'App\Http\Controllers\MyController\PCGDController');

        Route::resource('quyen', 'App\Http\Controllers\MyController\QuyenController');

        Route::get('quyen/{id}/delete', 'App\Http\Controllers\MyController\QuyenController@delete');

        Route::resource('phanquyen', 'App\Http\Controllers\MyController\PhanQuyenController');
        
        Route::get('phanquyen/{id}/delete', 'App\Http\Controllers\MyController\PhanQuyenController@delete');

        Route::resource('chophepnhapdiem', 'App\Http\Controllers\MyController\NDGKController');

        Route::get('chophepnhapdiem/{id}/delete', 'App\Http\Controllers\MyController\NDGKController@delete');
    });


});


Route::group(['middleware' => 'AuthCheck', 'prefix' =>'phuhuynh'], function () {
    Route::get('index', [PhuHuynhController::class, 'index']);
    Route::get('ketquahoctap/{id}', [PhuHuynhController::class, 'ketquahoctap']);
    Route::get('timkiemketquahoctap', [PhuHuynhController::class, 'searchResultStudy'])->name('searchResultStudy'); 
});

Route::prefix('login')->group(function () {
    Route::get('/',[LoginController::class, 'index']);
    Route::post('/',[LoginController::class, 'handleLogin'])->name('handleLogin');
});

Route::prefix('changePass')->group(function () {
    Route::get('index', [PassController::class,'index']);
    Route::post('index',[PassController::class, 'handleChangePass'])->name('handleChangePass');
});

// Route::get('users', function () {
//     $user = GiaoVien::find();
//     $user->assignRole(['id'=>'1']);
//     // $role = Role::create(['name' => 'Giáo Viên']);
// });






    
