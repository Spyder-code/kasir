<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    return redirect('login');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['Owner']], function () {
    Route::get('/owner', 'OwnerController@index');
    Route::get('/owner/user', 'OwnerController@index');
    Route::get('/owner/produk', 'OwnerController@index');
    Route::get('/owner/laporan', 'OwnerController@index');
});

Route::group(['middleware' => ['Kasir']], function () {
    Route::get('/kasir', 'KasirController@index');
});

Route::get('/logout', 'Auth\LoginController@logout');

Route::view('/lihat', 'owner_view.user');
Route::view('/lihat2', 'owner_view.produk');
Route::view('/lihat3', 'owner_view.laporan');
Route::view('/lihat4', 'owner_view.perusahaan');
Route::view('/lihat5', 'owner_view.detail_produk');
