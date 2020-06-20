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
   Route::get('/owner/user', 'OwnerController@index');
   // produk
   Route::get('/owner/produk', 'OwnerController@indexProduk')->name('produk');
   Route::post('/owner/produk/store', 'OwnerController@storeProduk')->name('produk.store');
   Route::get('/owner/produk/show/{id}', 'OwnerController@showProduk')->name('produk.show');
   Route::get('/owner/produk/edit/{id}', 'OwnerController@editProduk')->name('produk.edit');
   Route::post('/owner/produk/update/{id}', 'OwnerController@updateProduk')->name('produk.update');
   Route::get('/owner/produk/destroy/{id}', 'OwnerController@destroyProduk')->name('produk.destroy');
   // kategori
   Route::get('/owner/kategori', 'OwnerController@indexKategori')->name('kategori');
   Route::post('/owner/kategori/store', 'OwnerController@storeKategori')->name('kategori.store');
   Route::get('/owner/kategori/edit/{id}', 'OwnerController@editKategori')->name('kategori.edit');
   Route::post('/owner/kategori/update/{id}', 'OwnerController@updateKategori')->name('kategori.update');
   Route::get('/owner/kategori/destroy/{id}', 'OwnerController@destroyKategori')->name('kategori.destroy');
   // laporan
   Route::get('/owner/laporantabel', 'OwnerController@indexLaporanTabel')->name('laporan.tabel');
});

Route::group(['middleware' => ['Kasir']], function () {
    Route::get('/kasir', 'KasirController@index');
});

Route::get('/logout', 'Auth\LoginController@logout');

// Route::view('/lihat', 'owner_view.user');
// Route::view('/lihat2', 'owner_view.produk');
// Route::view('/lihat3', 'owner_view.laporan');
// Route::view('/lihat4', 'owner_view.perusahaan');
// Route::view('/lihat5', 'owner_view.edit_kategori');
