<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'Api\Auth\LoginController@login');
Route::post('register', 'Api\Auth\RegisterController@register');
Route::post('cekRegis', 'Api\RegistrasiController@cekRegis');
Route::post('registrasi', 'Api\RegistrasiController@registrasi');
Route::post('validator', 'Api\Auth\RegisterController@validator');
Route::post('aktifasi', 'Api\Auth\RegisterController@aktifasi');
Route::post('forgetPassword', 'Api\Auth\UserController@forgetPassword');

Route::put('putStatusMstJual/{no_ent}', 'Api\PenjualanController@putStatusMstJual');

Route::middleware('auth:api')->group(function () {
	//User
	Route::post('updateToken', 'Api\Auth\LoginController@updateToken');
	Route::post('tambahAlamat', 'Api\Auth\UserController@tambahAlamat');
	Route::post('ubahAlamat', 'Api\Auth\UserController@ubahAlamat');
	Route::post('getAlamat', 'Api\Auth\UserController@getAlamat');
	Route::get('getKdPeg', 'Api\Auth\UserController@getKdPeg');	
	//EndOfUser

	//customer
	Route::post('tambahCustomer', 'Api\CustomerController@tambahCustomer');	
	Route::post('getCustomer', 'Api\CustomerController@getCustomer');	
	Route::post('getKodeCust', 'Api\CustomerController@getKodeCust');	
	//endOfCustomer

	//Kunjungan
	Route::post('insertKunjungan', 'Api\KunjunganController@insertKunjungan');	
	Route::post('dataKunjungan', 'Api\KunjunganController@dataKunjungan');	
	//endOfKunjungan

	//Barang
	Route::post('getBarang', 'Api\BarangController@getBarang');
	Route::post('getBarangByName', 'Api\BarangController@getBarangByName');
	Route::post('getBarangSales', 'Api\BarangController@getBarangSales');
	//EndOfBarang

	//Transaksi
	Route::post('getNoEnt', 'Api\PenjualanController@getNoEnt');
	Route::post('inputPenjualan', 'Api\PenjualanController@inputPenjualan');
	Route::post('getDataTransaksi', 'Api\PenjualanController@getDataTransaksi');
	Route::post('getDetailTransaksi', 'Api\PenjualanController@getDetailTransaksi');


	Route::post('getNoFaktur', 'Api\PenjualanController@getNoEntOrderJual');
	Route::post('insertMasterOrderJual', 'Api\PenjualanController@insertMasterOrderJual');
	Route::post('insertDetailOrderJual', 'Api\PenjualanController@insertDetailOrderJual');
	Route::post('insertDetailOrderJual1', 'Api\PenjualanController@insertDetailOrderJual1');
	Route::post('getDataOrderJual', 'Api\PenjualanController@getDataOrderJual');


	//endOfTransaksi

	//kategori barang android
	Route::post('getKategori', 'Api\BarangController@getKategori');
	Route::post('getKategoriAll', 'Api\BarangController@getKategoriAll');
	Route::post('getKodeKategori', 'Api\BarangController@getKodeKategori');
	//endOfkategori

	//voucher
	Route::post('getVoucher', 'Api\VoucherController@getVoucher');
	Route::post('tambahVoucher', 'Api\VoucherController@tambahVoucher');
	Route::post('validasi', 'Api\VoucherController@validasi');
	Route::post('countPointVoucher', 'Api\VoucherController@countPointVoucher');
	Route::get('getSettingVoucher', 'Api\VoucherController@getSettingVoucher');
	//getVoucher

	//cart
	Route::post('inputToCart', 'Api\PenjualanController@inputToCart');
	Route::post('getDataCart', 'Api\PenjualanController@getDataCart');
	Route::post('updateCart', 'Api\PenjualanController@updateCart');
	Route::post('deleteCart', 'Api\PenjualanController@deleteCart');
	//endOfCart

	//Wishlist
	Route::post('inputToWishlist', 'Api\PenjualanController@inputToWishlist');
	Route::post('getDataWishlist', 'Api\PenjualanController@getDataWishlist');
	Route::post('deleteWishlist', 'Api\PenjualanController@deleteWishlist');
	//endOfWishlist

	//RajaOngkir
	Route::get('getProvinsi', 'Api\PengirimanController@getProvinsi');
	Route::post('getKota', 'Api\PengirimanController@getKota');
	Route::post('getKecamatan', 'Api\PengirimanController@getKecamatan');
	Route::post('cekOngkir', 'Api\PengirimanController@cekOngkir');
	Route::post('cekOngkirCod', 'Api\PengirimanController@cekOngkirCod');
	Route::post('lacakPengiriman', 'Api\PengirimanController@lacakPengiriman');
	//EndOfRajaOngkir

	//Notification
	Route::post('getNotif', 'Api\NotificationController@getNotif');
	//endOfNotification

	//OngkirCod
	Route::get('getOngkirCod', 'Api\OngkirCodController@getOngkirCod');

	//Penawaran
	Route::get('getPenawaran', 'Api\PenawaranController@index');
	//endOfPenawaran

	//Outlet
	Route::get('getKodeOutlet', 'Api\OutletController@getKodeOutlet');
	Route::get('getOutlet', 'Api\OutletController@getOutlet');
	//endOfOutlet

	//offline
	Route::post('inputPenjualanOffline', 'Api\PenjualanController@inputPenjualanOffline');
	Route::get('getSettingPoint', 'Api\VoucherController@getSettingPoint');
	Route::post('updateStatusVoucher', 'Api\VoucherController@updateStatusVoucher');
	Route::get('getCustomerOffline', 'Api\CustomerController@getCustomerOffline');
	//offline

	//pembayaran
	Route::get('getStatusPembayaran/{id}', 'Api\PembayaranController@get_transaction_status_midtrans');
});