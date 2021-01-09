<?php

namespace Larisso\Http\Controllers;

use Illuminate\Http\Request;
use Larisso\SettingVoucher;
use Larisso\MstVoucher;
use Larisso\DetVoucher;
use Larisso\TukarVoucher;
use Larisso\User;
use Session;
use Redirect;
use store;

class VoucherController extends Controller
{
	public function voucherFisik()
	{
		$data = MstVoucher::where('jenis_voucher', '=', 'FISIK')->get();
		return view('Voucher.voucherFisik', compact('data'));
	}

	public function eVoucher()
	{
		$data = MstVoucher::join('customer', 'customer.kd_cust', '=', 'mst_voucher.kd_cust')->where('jenis_voucher', '=', 'ELEKTRONIK')->get();
		return view('Voucher.eVoucher', compact('data'));
	}

	public function voucherGlobal()
	{
		$data = MstVoucher::where('jenis_voucher', '=', 'ELEKTRONIK')->get();
		$user = User::join('customer', 'customer.id', '=', 'users.id')->where('otoritas', '>', '0')->where('email_activation', '<>', '0')->get();
		return view('Voucher.voucherGlobal', compact('data', 'user'));
	}

	public function settingVoucher()
	{
		$data = SettingVoucher::all();
		return view('Voucher.settingVoucher', compact('data'));
	}

	public function tukarVoucher()
	{
		$data = TukarVoucher::join('voucher', 'voucher.kd_voucher', '=', 'tukar_voucher.kd_voucher')->join('customer', 'voucher.kd_cust', '=', 'customer.kd_cust')->get();
		return view('Voucher.tukarVoucher', compact('data'));
	}

	public function tambahVoucher(Request $request)
	{
		// if ($request->banyak != "") {
		$insert = MstVoucher::insert([
			"kd_voucher"		=> $request->kode_voucher,
			"nama_voucher"		=> $request->nama_voucher,
			"nilai_voucher"		=> $request->nilai_voucher,
			"tgl_berlaku_1"		=> $request->tgl_start,
			"tgl_berlaku_2"		=> $request->tgl_end,
			"sk"				=> $request->sk,
			"jenis_voucher"		=> "ELEKTRONIK",
			"status_voucher"	=> "AKTIF"
		]);

		if ($request->user[0] == "semua") {
			$user = User::join('customer', 'customer.id', '=', 'users.id')->get();
			foreach ($user as $data) {
				$save2 = DetVoucher::insert([
					"kd_voucher"	=> $request->kode_voucher,
					"kd_cust"		=> $data->KD_CUST
				]);
			}
		} else {
			for ($i=0; $i < count($request->user); $i++) { 
				$save2 = DetVoucher::insert([
					"kd_voucher"	=> $request->kode_voucher,
					"kd_cust"		=> $request->user[$i]
				]);
			}
		}

		if ($save2) {
			Session::flash('success', "Data Berhasil Ditambahkan !!!");
			return Redirect::back();
		} else {
			Session::flash('error', "Data Gagal Ditambahkan !!!");
			return Redirect::back();
		}
		// }
	}

	public function tambahSettingVoucher(Request $request)
	{
		$path = $request->file('gambar')->store(
			'voucher', 'public'
		);

		$insert = SettingVoucher::insert([
			"nama_voucher"		=> $request->nama_voucher,
			"gambar_voucher"	=> $path,
			"nilai_voucher"		=> $request->nilai_voucher,
			"ketentuan"			=> $request->ketentuan,
			"masa_berlaku"		=> $request->masa_berlaku,
			"sk"				=> $request->sk
		]);

		if ($insert) {
			Session::flash('success', "Data Berhasil Ditambahkan !!!");
			return Redirect::back();
		} else {
			Session::flash('error', "Data Gagal Ditambahkan !!!");
			return Redirect::back();
		}
	}

	public function validasi()
	{
		$update = Voucher::where('jenis_voucher', '=', 'FISIK')->where('status_voucher', '=', "NON-AKTIF")->update([
			'status_voucher'	=> "AKTIF"
		]);

		if ($update) {
			Session::flash('success', "Validasi Berhasil !!!");
			return Redirect::back();
		} else {
			Session::flash('error', "Validasi Gagal !!!");
			return Redirect::back();
		}
	}

	public function penukaranVoucher(Request $request)
	{
		$data = Voucher::where('kd_voucher', '=', $request->kd_voucher)->update([
			'status_voucher'	=> "DIGUNAKAN"
		]);

		$data2 = TukarVoucher::insert([
			'kd_voucher'	=> $request->kd_voucher,
			'no_kartu'		=> $request->no_kartu
		]);

		if ($data && $data2) {
			$client = new \GuzzleHttp\Client();
			$myip = \request()->ip();
			$response = $client->request('POST', "http://".$myip."/senyum_sinkron/index.php/voucher/updateVoucher", [
				'form_params'       => [
					'NO_VOUCHER'       	=> $request->kd_voucher,
					'NO_KARTU'       	=> $request->no_kartu
				]
			]);

			$body = json_decode($response->getBody(), true);

			if ($body['success'] == "Data Berhasil Ditambahkan") {
				Session::flash('success', "Data Berhasil Ditambahkan !!!");
				return Redirect::back();
			} else {
				Session::flash('error', "Data Gagal Ditambahkan !!!");
				return Redirect::back();
			}
		} else {
			Session::flash('error', "Data Gagal Ditambahkan !!!");
			return Redirect::back();
		}

	}
}
