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

Route::get('/', 'MainController@home')->name('home');
Route::match(['get', 'post'], '/registrasi', 'MainControler@registration')->name('register');
Route::match(['get', 'post'], '/cekstatus', 'MainController@check')->name('check');
Route::match(['get', 'post'], '/masuk', 'AuthController@login')->name('login');
Route::get('/logout', 'AuthController@logout')->name('logout');
Route::match(['get', 'post'], '/api/master', 'AdminController@api')->name('api');

Route::group(['prefix' => 'administrator', 'middleware' => 'auth.admin'], function (){
    Route::get('/', 'AdminController@home')->name('admin.home');
    Route::match(['get', 'post'], '/master/unit', 'MasterController@unit')->name('admin.master.unit');
    Route::match(['get', 'post'], '/master/bengkel', 'MasterController@garage')->name('admin.master.garage');
    Route::match(['get', 'post'], '/master/pengguna', 'MasterController@user')->name('admin.master.user');
    Route::match(['get', 'post'], '/monitoring', 'AdminController@monitoring')->name('admin.monitor');
    Route::match(['get', 'post'], '/laporan/unit', 'ReportController@unit')->name('admin.report.unit');
    Route::match(['get', 'post'], '/laporan/transaksi', 'ReportController@transaction')->name('admin.report.transaction');
    Route::match(['get', 'post'], '/pengaturan', 'ReportController@setting')->name('admin.setting');
});
