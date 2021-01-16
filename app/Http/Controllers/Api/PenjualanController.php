<?php

namespace Larisso\Http\Controllers\Api;

use Illuminate\Http\Request;
use Larisso\Http\Controllers\Controller;
use Larisso\Cart;
use Larisso\Wishlist;
use Larisso\MstJual;
use Larisso\DetJual;
use Larisso\Customer;
use Larisso\VwMstJual;
use Larisso\MstOrderJual;
use Larisso\DetOrderJual;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
{
	public function inputToCart(Request $request)
	{
		$get = Cart::where('id_user', '=', $request->id_user)->where('kd_brg', '=', $request->kd_brg)->first();

		if ($get) {
			$update = Cart::where('id_user', '=', $request->id_user)->where('kd_brg', '=', $request->kd_brg)->increment("qty", $request->qty);

			if ($update) {
				return response()->json(['message' => 'Jumlah Barang ditambahkan'], 200);
			} else {
				return response()->json(['message' => 'Update Jumlah Barang Gagal'], 401);
			}	
		} else {
			$insert = Cart::insert([
				"id_user"			=> $request->id_user,
				"kd_brg"			=> $request->kd_brg,
				"nm_brg"			=> $request->nm_brg,
				"satuan1"			=> $request->satuan1,
				"harga_jl"			=> $request->harga_jl,
				"qty"				=> $request->qty,
				"gambar"			=> $request->gambar,
				"kategori_barang"	=> $request->kategori
			]);

			if ($insert) {
				return response()->json(['message' => 'Input Data Berhasil'], 200);
			} else {
				return response()->json(['message' => 'Input Data Gagal'], 401);
			}	
		}
	}

	public function getDataCart(Request $request)
	{
		$data = Cart::where('id_user', '=', $request->id_user)->get();

		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}

	public function updateCart(Request $request)
	{
		$update = Cart::where('id_user', '=', $request->id_user)->where('kd_brg', '=', $request->kd_brg)->update([
			"qty"				=> $request->qty,
		]);

		if ($update) {
			return response()->json(['message' => 'Update Jumlah Barang Berhasil'], 200);
		} else {
			return response()->json(['message' => 'Update Jumlah Barang Gagal'], 401);
		}	
	}

	public function deleteCart(Request $request)
	{
		$delete = Cart::where('id_user', '=', $request->id_user)->where('kd_brg', '=', $request->kd_brg)->delete();

		if ($delete) {
			return response()->json(['message' => 'Barang Berhasil Dihapus'], 200);
		} else {
			return response()->json(['message' => 'Barang Gagal Dihapus'], 401);
		}	
	}

	public function inputToWishlist(Request $request)
	{
		$get = Wishlist::where('id_user', '=', $request->id_user)->where('kd_brg', '=', $request->kd_brg)->first();

		if ($get) {
			return response()->json(['message' => 'Barang sudah ada dalam favorit'], 201);
		} else {
			$insert = Wishlist::insert([
				"id_user"			=> $request->id_user,
				"kd_brg"			=> $request->kd_brg,
				"nm_brg"			=> $request->nm_brg,
				"satuan1"			=> $request->satuan1,
				"harga_jl"			=> $request->harga_jl,
				"gambar"			=> $request->gambar,
				"kategori_barang"	=> $request->kategori
			]);

			if ($insert) {
				return response()->json(['message' => 'Input Data Berhasil'], 200);
			} else {
				return response()->json(['message' => 'Input Data Gagal'], 401);
			}	
		}
	}

	public function getDataWishlist(Request $request)
	{
		$data = Wishlist::where('id_user', '=', $request->id_user)->get();

		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}

	public function deleteWishlist(Request $request)
	{
		$delete = Wishlist::where('id_user', '=', $request->id_user)->where('kd_brg', '=', $request->kd_brg)->delete();

		if ($delete) {
			return response()->json(['message' => 'Barang Berhasil Dihapus'], 200);
		} else {
			return response()->json(['message' => 'Barang Gagal Dihapus'], 401);
		}	
	}

	public function getNoEnt(Request $request)
	{
		$no_ent = MstJual::where('id_user', '=', $request->id)->orderBy('no_ent', 'desc')->first();
		// $kd_cust = Customer::select('kd_cust')->where('id', '=', $request->id)->first();

		date_default_timezone_set("Asia/Jakarta");

		if ($no_ent) {
			$data = (int) substr($no_ent->no_ent, 15, 8) + 1;
			// print_r($data);
			$tmp = "INVJ".date('md').'/'.sprintf("%'.05d", $request->id).'/'.sprintf("%'.08d", $data);
		} else {
			$tmp = "INVJ".date('md').'/'.sprintf("%'.05d", $request->id).'/'.sprintf("%'.08d", 1);
		}

		return response()->json($tmp, 200);
	}

	public function inputPenjualan(Request $request)
	{
		$kd_cust = Customer::where('id', '=', $request->kd_cust)->get();

		$mst = MstJual::insertGetId([
			'no_ent'			=> $request->no_ent,
			'id_user'			=> $request->kd_cust,
			'kd_cust'			=> $kd_cust[0]->KD_CUST,
			'nm_penerima'		=> $request->nm_penerima,
			'alm_penerima'		=> $request->alm_penerima,
			'no_telp_penerima'	=> $request->no_telp_penerima,
			'total'				=> $request->total,
			'disc_pr'			=> $request->disc_pr,
			'disc_value'		=> $request->disc_value,
			'kd_voucher'		=> $request->kd_voucher,
			'jns_bayar'			=> $request->jns_bayar,
			'netto'				=> $request->netto,
			'ongkir'			=> $request->ongkir,
			'jns_pengiriman'	=> $request->jns_pengiriman,
			'no_resi'			=> $request->no_resi,
			'sts_byr'			=> $request->sts_bayar,
			'sts_jual'			=> $request->sts_jual
		]);

		$tmp_kd_brg			= explode(";", $request->kd_brg);
		$tmp_nm_brg			= explode(";", $request->nm_brg);
		$tmp_harga			= explode(";", $request->harga);
		$tmp_jumlah			= explode(";", $request->jumlah);

		for ($i=0; $i < count($tmp_kd_brg); $i++) { 
			$subtot = ($tmp_harga[$i] * $tmp_jumlah[$i]);
			$det = DetJual::insert([
				"no_ent"	=>	$request->no_ent,
				"kd_brg"	=>	$tmp_kd_brg[$i],
				"nm_brg"	=>	$tmp_nm_brg[$i],
				"harga"		=>	$tmp_harga[$i],
				"jumlah"	=>	$tmp_jumlah[$i],
				"satuan"	=>	$request->satuan,
				"sub_total"	=>	$subtot
			]);
		}

		if ($det) {
			$delete = Cart::where('id_user', '=', $request->kd_cust)->delete();
			if ($delete) {
				$sukses = "Input Order Berhasil";
				return response()->json(compact('sukses'), 200);
			} else {
				return response()->json('Hapus Cart gagal', 404);	
			}
		} else {
			return response()->json('Update gagal', 404);
		}
	}

	public function getDataTransaksi(Request $request)
	{
		$data = VwMstJual::where('id_user', '=', $request->id)->get();

		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}

	public function getDetailTransaksi(Request $request)
	{
		$data = DetJual::where('no_ent', '=', $request->no_ent)->get();

		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}

	public function getNoEntOrderJual(Request $request)
	{
		$data = MstOrderJual::where('KD_USER', '=', $request->username)->orderBy('NO_ENT', 'desc')->first();

		if ($data != false) {
			$st = $data->NO_ENT;
			$message = substr($st, strpos($st, "/")+5);
			return response()->json(compact('message'), 200);
		}else{
			$message = 'Data Tidak Ditemukan';
			return response()->json(compact('message'), 401);
		}
	}

	public function insertMasterOrderJual(Request $request)
	{
		$insert = MstOrderJual::insert([
			'NO_ENT'			=> $request->no_ent,
			'TANGGAL'			=> $request->tanggal,
			'KD_CUST'			=> $request->kd_cust,
			'TOTAL'				=> $request->total,
			'KD_USER'			=> $request->kd_user,
			'KD_PEG'			=> $request->kd_peg
		]);


		if ($insert) {
			return response()->json(['message' => 'Input Data Berhasil'], 200);
		} else {
			return response()->json(['message' => 'Input Data Gagal'], 401);
		}	
	}

	public function insertDetailOrderJual(Request $request)
	{
		$kd_brg 	= explode(',', $request->kd_brg);
		$nm_brg 	= explode(',', $request->nm_brg);
		$satuan 	= explode(',', $request->satuan);
		$jumlah 	= explode(',', $request->jumlah);
		$harga 		= explode(',', $request->harga);
		$sub_total 	= explode(',', $request->sub_total);
		$hpp 		= explode(',', $request->hpp);

		for ($i=0; $i < count($kd_brg); $i++) { 
			$insert = DetOrderJual::insert([
				'NO_ENT'	=> $request->no_ent,
				'KD_BRG'	=> $kd_brg[$i],
				'NM_BRG'	=> $nm_brg[$i],
				'SATUAN'	=> $satuan[$i],
				'JUMLAH'	=> $jumlah[$i],
				'HARGA'		=> $harga[$i],
				'SUB_TOTAL'	=> $sub_total[$i],
				'HPP'		=> $hpp[$i]
			]);
		}

		if ($insert) {
			return response()->json(['message' => 'Input Data Berhasil'], 200);
		} else {
			return response()->json(['message' => 'Input Data Gagal'], 401);
		}	
	}

	public function insertDetailOrderJual1(Request $request)
	{
		$kd_brg 	= explode(',', $request->kd_brg);
		$nm_brg 	= explode(',', $request->nm_brg);
		$satuan 	= explode(',', $request->satuan);
		$jumlah 	= explode(',', $request->jumlah);
		$harga 		= explode(',', $request->harga);
		$sub_total 	= explode(',', $request->sub_total);
		$hpp 		= explode(',', $request->hpp);

		for ($i=0; $i < count($kd_brg); $i++) { 
			$test = DetJual::where('NO_ENT', '=', $request->no_ent)->where('KD_BRG', '=', $kd_brg[$i])->get();
			if (count($test) > 0) {
				$insert = DetOrderJual::where('NO_ENT', '=', $request->no_ent)->where('KD_BRG', '=', $kd_brg[$i])->increment('JUMLAH', $jumlah[$i]);
				$insert = DetOrderJual::where('NO_ENT', '=', $request->no_ent)->where('KD_BRG', '=', $kd_brg[$i])->increment('SUB_TOTAL', ($jumlah[$i]*$harga[$i]));
			} else {
				$insert = DetOrderJual::insert([
					'NO_ENT'	=> $request->no_ent,
					'KD_BRG'	=> $kd_brg[$i],
					'NM_BRG'	=> $nm_brg[$i],
					'SATUAN'	=> $satuan[$i],
					'JUMLAH'	=> $jumlah[$i],
					'HARGA'		=> $harga[$i],
					'SUB_TOTAL'	=> $sub_total[$i],
					'HPP'		=> $hpp[$i]
				]);
			}
		}

		if ($insert) {
			$data = DetOrderJual::where('NO_ENT', '=', $request->no_ent)->get();
			$mst = MstOrderJual::join('customer', 'customer.KD_CUST', '=', 'mst_ord_jual_mob.KD_CUST')->where('NO_ENT', '=', $request->no_ent)->first();

			if (count($data) > 0) {
				return response()->json(['message' => 'Data Ditemukan', 'data' => compact('data', 'mst')], 200);
			} else {
				return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
			}
		} else {
			return response()->json(['message' => 'Input Data Gagal'], 401);	
		}
	}

	public function getDataOrderJual(Request $request)
	{
		$data = MstOrderJual::where('KD_USER', '=', $request->username)->join('customer', 'customer.KD_CUST', '=', 'mst_ord_jual_mob.KD_CUST')->where('TANGGAL', '>=', $request->tgl_start)->where('TANGGAL', '<=', $request->tgl_end)->get();

		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}

	public function putStatusMstJual(Request $request)
	{
		$save = MstJual::where('no_ent', '=', $request->no_ent)->update([
			"sts_byr"	=> 1,
		]);

		if ($save) {
			return response()->json(['message' => 'Ubah Status MST Jual Berhasil'], 200);
		} else {
			return response()->json(['message' => 'Ubah Status MST Jual Gagal'], 401);
		}
	}

	public function inputPenjualanOffline(Request $request)
	{
		$mst = MstJual::insert([
			'no_ent'			=> $request->no_ent,
			'tanggal'			=> $request->tanggal,
			'netto'				=> $request->netto,
			'kd_cust'			=> $request->kd_cust,
			'id_user'			=> Auth::user()->id,
			'kd_outlet'			=> Auth::user()->kd_outlet,
			'point'				=> $request->point,
			'sts_jual'			=> 'OFFLINE'
		]);

		if ($mst) {
			return response()->json(['message' => 'Input Master Jual Berhasil'], 200);
		} else {
			return response()->json(['message' => 'Input Master Jual Gagal'], 401);
		}
	}

}
