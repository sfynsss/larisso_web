<?php

namespace Larisso\Http\Controllers\Api;

use Illuminate\Http\Request;
use Larisso\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Larisso\DetVoucher;
use Larisso\Customer;

class VoucherController extends Controller
{
	public function getVoucher(Request $request)
	{
		$kd_cust = Customer::where('id', '=', $request->id)->first();
		$data = DetVoucher::select('*')->join('mst_voucher', 'mst_voucher.kd_voucher', '=', 'det_voucher.kd_voucher')->where('det_voucher.kd_cust', '=', $kd_cust['KD_CUST'])->where('status_voucher', '=', "AKTIF")->get();

		if (count($data) > 0) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}
	}

	public function validasi(Request $request)
	{
		if ($request->data == "kosong") {
			return response()->json("gagal", 200);
		} else {
			$tmp_kd_voucher = explode(";", $request->data);
			for ($i=0; $i < count($tmp_kd_voucher); $i++) { 
				$update = Voucher::where('kd_voucher', '=', $tmp_kd_voucher[$i])->where('status_voucher', '=', "NON-AKTIF")->update([
					'status_voucher'	=> "AKTIF"
				]);
			}

			if ($update) {
				return response()->json("berhasil", 200);
			} else {
				return response()->json("Voucher Telah Aktif", 200);
			}
		}
	}

}
