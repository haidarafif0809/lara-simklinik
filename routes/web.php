<?php

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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' =>'auth'], function(){

	Route::resource('kategori', 'KategoriProdukController');
	Route::resource('kategori_transaksi', 'KategoriTransaksiController');
	Route::resource('kas', 'KasController');
	Route::resource('kas_masuk', 'KasMasukController');
	Route::resource('kas_keluar', 'KasKeluarController');
	Route::resource('kas_mutasi', 'KasMutasiController');
	Route::resource('komisi', 'KomisiProdukController');
	Route::resource('produk', 'ProdukController');
	Route::resource('pasien', 'PasienController');
	Route::resource('penjamin', 'PenjaminController');
	Route::resource('gudang', 'GudangController');
	Route::resource('suplier', 'SuplierController');
	Route::resource('poli', 'PoliController');
	Route::resource('user', 'UserController');
	Route::resource('otoritas', 'OtoritasController');
	Route::resource('satuan', 'SatuanController');
	Route::get('/otoritas/{id}/permission/', 'OtoritasController@permission')->name('otoritas.permission');

});
