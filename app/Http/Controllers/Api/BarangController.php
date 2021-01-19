<?php

namespace Larisso\Http\Controllers\Api;

use Illuminate\Http\Request;
use Larisso\Http\Controllers\Controller;
use Larisso\KategoriAndroid;
use Larisso\Barang;

class BarangController extends Controller
{
	public function getBarang(Request $request)
	{
		$data = Barang::where('kd_kat_android', '=', $request->kd_kategori)->where('kd_outlet', '=', $request->kd_outlet)->get();

		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}

	public function getBarangByName(Request $request)
	{
		$data = Barang::where('nm_brg', 'like', '%'.$request->nm_brg.'%')->where('kd_outlet', '=', $request->kd_outlet)->get();

		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}

	public function getKodeKategori(Request $request)
	{
		$data = KategoriAndroid::select('kd_kat_android')->orderBy('kd_kat_android', 'desc')->get();

		if (count($data) > 0) {
			// print_r($data);
			$data = (int) substr($data[0]->kd_kat_android, 5, 8) + 1;
			$tmp = "A".sprintf("%'.05d", $data);
		} else {
			$tmp = "A".sprintf("%'.05d", 1);
		}
		return response()->json($tmp, 200);
	}

	public function getKategori(Request $request)
	{
		if ($request->filter == "all") {
			$data = KategoriAndroid::where('sts_tampil', '=', '1')->where('kd_outlet', '=', $request->kd_outlet)->get();
		} else {
			$data = KategoriAndroid::take($request->filter)->where('sts_tampil', '=', '1')->where('kd_outlet', '=', $request->kd_outlet)->get();
		}

		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}

	public function getKategoriAll()
	{
		$data = KategoriAndroid::where('sts_tampil', '=', '1')->get();

		return response()->json($data, 200);
	}

	public function getBarangSales(Request $request)
	{
		$data = Barang::where('nm_brg', 'like', '%'.$request->nm_brg.'%')->orWhere('kd_brg', '=', $request->nm_brg)->get();

		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}
}
