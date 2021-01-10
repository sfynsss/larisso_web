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
// Route::get('/token', function ()
// {
//       echo csrf_token(); 
// });

Route::get('/', function () {
    // return view('welcome');
	return redirect('login');
});

Route::get('/privacy_policy', function () {
    // return view('welcome');
	return view('privacy_policy');
});

Auth::routes([
	'register' => false, // Registration Routes...
  	'reset' => false, // Password Reset Routes...
  	'verify' => false, // Email Verification Routes...
]);

Route::get('payments/completed', 'PembayaranController@completed');
Route::get('/midtrans/pay','PembayaranController@getPayment');
Route::get('/coba', "MidtransController@getSnapToken");
Route::post('/coba/charge', "MidtransController@getSnapToken");

Route::get('auth/activate', 'Auth\ActivationController@activate');
Route::get('auth/forgetPassword', 'Auth\ActivationController@forget');
Route::post('auth/gantiPassword', 'Auth\ActivationController@ganti');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/downloadData', 'HomeController@downloadData');

//Barang
Route::get('barang', 'BarangController@barang');
Route::get('detail_barang/{kd_brg}', 'BarangController@detail_barang');
Route::post('barang/import', 'BarangController@import');
Route::get('kategori_barang', 'BarangController@kategori_barang');
Route::post('edit_kategori', 'BarangController@edit_kategori');
Route::post('barang/input_kategori', 'BarangController@inputKategori');
Route::post('barang/edit_barang', 'BarangController@edit_barang');
//endOfBarang

//penjualan
Route::get('penjualan', 'PenjualanController@index');
Route::get('detPenjualan/{no_ent}', 'PenjualanController@detPenjualan');

Route::get('orderPenjualan', 'PenjualanController@orderPenjualan');
Route::get('detailOrder/{id}', 'PenjualanController@detailOrder');
Route::post('inputResi', 'PenjualanController@inputResi');
Route::post('simpanPenjualan', 'PenjualanController@simpanPenjualan');
//endOfPenjualan

//customer
Route::get('/customer', 'CustomerController@index');
Route::post('/tambahCustomer', 'CustomerController@tambahCustomer');
Route::get('/sinkronisasi', 'CustomerController@sinkronisasi');
Route::get('/downloadCustomer', 'CustomerController@downloadCustomer');
//endOfCustomer

//voucher
Route::get('/voucherFisik', 'VoucherController@voucherFisik');
Route::get('/eVoucher', 'VoucherController@eVoucher');
Route::get('/voucherGlobal', 'VoucherController@voucherGlobal');
Route::get('/settingVoucher', 'VoucherController@settingVoucher');
Route::post('/tambahVoucher', 'VoucherController@tambahVoucher');
Route::post('/tambahSettingVoucher', 'VoucherController@tambahSettingVoucher');
Route::get('/tukarVoucher', 'VoucherController@tukarVoucher');
Route::get('/sinkronisasiVoucher', 'VoucherController@sinkronisasiVoucher');
Route::get('validasiVoucher', 'VoucherController@validasi');	
Route::post('penukaranVoucher', 'VoucherController@penukaranVoucher');	
//endOfVoucher

//notif
Route::get('/notification', 'NotificationController@index');
Route::post('notifGlobal', 'NotificationController@notifGlobal');
Route::get('notifMultiDevice', 'NotificationController@toMultiDevice');
//endOfNotif

//user
Route::get('/cabang', 'CustomerController@cabang');
Route::post('/tambahCabang', 'CabangController@tambahCabang');
Route::post('/updateCabang', 'CabangController@updateCabang');
//endOfUser

//user
Route::get('/user/{id}', 'UserController@index');
Route::post('/tambahUser/{id}', 'UserController@tambahUser');
//endOfUser

//email
Route::get('/send/email', 'HomeController@mail');
//endOfEmail

//setting
Route::get('/penawaran', 'PenawaranController@index');
Route::post('inputPenawaran', 'PenawaranController@inputPenawaran');
//endofSetting

//ongkir cod
Route::get('/ongkircod', 'OngkirCodController@index');
Route::post('/tambahOngkirCod', 'OngkirCodController@tambahOngkirCod');
Route::post('/updateOngkirCod/{id}', 'OngkirCodController@updateOngkirCod');

//outlet
Route::get('/outlet', 'OutletController@index');
Route::post('/tambahOutlet', 'OutletController@tambahOutlet');