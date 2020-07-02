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
   Route::get('/owner/home','OwnerController@index');
   // main dashboard
   Route::get('owner/dashboard/show', 'OwnerController@indexDashboard');
   Route::get('owner/dashboard/showgrafik', 'OwnerController@showDashboardGrafik');
   // perusahaan
   Route::get('/owner/perusahaan','OwnerController@indexPerusahaan')->name('perusahaan');
   Route::get('/owner/perusahaan/show','OwnerController@showPerusahaan')->name('perusahaan.show');
   Route::post('/owner/perusahaan/store', 'OwnerController@storePerusahaan')->name('perusahaan.store');
   Route::post('/owner/perusahaan/update/{id}', 'OwnerController@updatePerusahaan')->name('perusahaan.update');
   // profile
   Route::get('/owner/profile','OwnerController@indexOwner')->name('owner');
   Route::post('/owner/profile/update', 'OwnerController@updateOwner');
   Route::post('/owner/profile/updatepassword', 'OwnerController@updatePassword');
   // user
   Route::get('/owner/user', 'OwnerController@indexUser')->name('user');
   Route::post('/owner/user/store', 'OwnerController@storeUser')->name('user.store');
   Route::get('/owner/user/edit/{id}', 'OwnerController@editUser')->name('user.edit');
   Route::post('/owner/user/update/{id}', 'OwnerController@updateUser')->name('user.update');
   Route::get('/owner/user/destroy/{id}', 'OwnerController@destroyUser')->name('user.destroy');
   // produk
   Route::get('/owner/produk', 'OwnerController@indexProduk')->name('produk');
   Route::post('/owner/produk/store', 'OwnerController@storeProduk')->name('produk.store');
   Route::get('/owner/produk/show/{id}', 'OwnerController@showProduk')->name('produk.show');
   Route::get('/owner/produk/edit/{id}', 'OwnerController@editProduk')->name('produk.edit');
   Route::post('/owner/produk/update/{id}', 'OwnerController@updateProduk')->name('produk.update');
   Route::get('/owner/produk/destroy/{id}', 'OwnerController@destroyProduk')->name('produk.destroy');
   Route::get('/owner/produk/search/{id}', 'OwnerController@searchProduk')->name('produk.search');
   // kategori
   Route::get('/owner/kategori', 'OwnerController@indexKategori')->name('kategori');
   Route::post('/owner/kategori/store', 'OwnerController@storeKategori')->name('kategori.store');
   Route::get('/owner/kategori/edit/{id}', 'OwnerController@editKategori')->name('kategori.edit');
   Route::post('/owner/kategori/update/{id}', 'OwnerController@updateKategori')->name('kategori.update');
   Route::get('/owner/kategori/destroy/{id}', 'OwnerController@destroyKategori')->name('kategori.destroy');
   // laporan
   Route::get('/owner/laporantabel', 'OwnerController@indexLaporanTabel')->name('laporan.tabel');
   Route::get('/owner/laporangrafik', 'OwnerController@indexLaporanGrafik')->name('laporan.grafik');
   Route::get('/owner/laporan/show', 'OwnerController@showLaporan')->name('laporan.show');
});

Route::group(['middleware' => ['Kasir']], function () {
    Route::get('/kasir/pembayaran', 'KasirController@index');
    Route::get('/kasir/transaksi', 'KasirController@transaksi');
    Route::get('/kasir/produk', 'KasirController@produk');
    Route::get('/kasir/profile', 'KasirController@profile');
    Route::get('/kasir/transaksi/{id}', 'KasirController@detailTransaksi');
    Route::post('/kasir/kode', 'KasirController@kode');
    Route::post('/kasir/addCustomer', 'KasirController@addCustomer');
    Route::post('/kasir/addTransaksi', 'KasirController@addTransaksi');
    Route::post('/kasir/fetchHarga', 'KasirController@fetchHarga');
    Route::post('/kasir/fetchData', 'KasirController@fetchData');
    Route::post('/kasir/delete', 'KasirController@delete');
    Route::post('/kasir/bayar', 'KasirController@bayar');
    Route::post('/kasir/cari', 'KasirController@cari');
    Route::post('/kasir/cariTransaksi', 'KasirController@cariTransaksi');
});

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

// Route::view('/lihat', 'owner_view.tambah_perusahaan');
// Route::view('/lihat2', 'owner_view.produk');
// Route::view('/lihat3', 'owner_view.laporan');
// Route::view('/lihat4', 'owner_view.perusahaan');
// Route::view('/lihat5', 'owner_view.edit_kategori');
