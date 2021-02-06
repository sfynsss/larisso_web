<?php

namespace Larisso\Http\Controllers\Api;

use Illuminate\Http\Request;
use Larisso\Http\Controllers\Controller;
use Steevenz\Rajaongkir;
use Larisso\OngkirCod;

class PengirimanController extends Controller
{
	// protected $rajaongkir;

	// public function __construct(){
	// 	$config['api_key'] = '51c18ce3b552d19636e6e1b1f371fdef';
	// 	$config['account_type'] = 'pro';

	// 	$rajaongkir = new Rajaongkir($config);
	// }

	public function getProvinsi()
	{
		$rajaongkir = new Rajaongkir('51c18ce3b552d19636e6e1b1f371fdef', Rajaongkir::ACCOUNT_PRO);
		$data = $rajaongkir->getProvinces();

		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}

	public function getKota(Request $request)
	{
		$rajaongkir = new Rajaongkir('51c18ce3b552d19636e6e1b1f371fdef', Rajaongkir::ACCOUNT_PRO);
		$data = $rajaongkir->getCities($request->id);

		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}

	public function getKecamatan(Request $request)
	{
		$rajaongkir = new Rajaongkir('51c18ce3b552d19636e6e1b1f371fdef', Rajaongkir::ACCOUNT_PRO);
		$data = $rajaongkir->getSubdistricts($request->id);

		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}

	public function cekOngkir(Request $request)
	{
		$rajaongkir = new Rajaongkir('51c18ce3b552d19636e6e1b1f371fdef', Rajaongkir::ACCOUNT_PRO);
		$data = $rajaongkir->getCost(['city' => $request->asal], ['subdistrict' => $request->destinasi], $request->berat, $request->kurir);
		
		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data['costs']], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}

	public function cekOngkirCod(Request $request)
	{
		$data = OngkirCod::where('sts_aktif', '=', '1')->get();
		
		if (count($data) > 0) {
			$harga = $data[0]->harga_awal + (($request->jarak-2) * $data[0]->harga_per_km);
			return response()->json(['message' => $harga], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}

	public function lacakPengiriman(Request $request)
	{
		$rajaongkir = new Rajaongkir('51c18ce3b552d19636e6e1b1f371fdef', Rajaongkir::ACCOUNT_PRO);
		$data = $rajaongkir->getWaybill($request->resi, $request->kurir);

		if(false === ($waybill = $rajaongkir->getWaybill($request->resi, $request->kurir))) {
			print_r($rajaongkir->getErrors());
		} else {
			return response()->json(['message' => 'Data Ditemukan', compact('data')], 200);
		}
		
		// if (count($data) > 0) {
		// 	return response()->json(['message' => 'Data Ditemukan', compact('data')], 200);
		// } else {
		// 	return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		// }
	}

	public function lacakResi(Request $request)
	{
		$rajaongkir = new Rajaongkir('51c18ce3b552d19636e6e1b1f371fdef', Rajaongkir::ACCOUNT_PRO);
		$status = $rajaongkir->getWaybill($request->resi, $request->kurir);

		if(false === ($waybill = $rajaongkir->getWaybill($request->resi, $request->kurir))) {
			// print_r("disini");
			return response()->json(['message' => 'Data Tidak Ditemukan'], 400);
		} else {
			// print_r($status);	
			// print_r($status['summary']);	
			// $data['status_terkirim'] = $status['delivered'];
			// $data['kode_kurir'] = $status['summary']['courier_code'];
			// $data['nama_kurir'] = $status['summary']['courier_name'];
			// $data['resi'] = $status['summary']['waybill_number'];
			// $data['tipe_pengiriman'] = $status['summary']['service_code'];
			// $data['tgl_kirim'] = $status['summary']['waybill_date'];
			$data = $status['manifest'];
			// print_r($data);
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		}
	}

}
