<?php

namespace Larisso\Http\Controllers\Api;

use Illuminate\Http\Request;
use Larisso\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Larisso\Customer;
use Larisso\KategoriCustomer;

class CustomerController extends Controller
{

	public function getKodeCust(Request $request)
	{
		$data = Customer::select('kd_cust')->where('kd_kat', '=', $request->kategori)->where('cabang', '=', $request->cabang)->orderBy('kd_cust', 'desc')->get();

		if (count($data) > 0) {
			// print_r($data);
			$data = (int) substr($data[0]->kd_cust, 5, 8) + 1;
			$tmp = substr($request->cabang, 3, 1)."-".$request->kategori."".sprintf("%'.04d", $data);
		} else {
			$tmp = substr($request->cabang, 3, 1)."-".$request->kategori."".sprintf("%'.04d", 1);
		}
		return response()->json($tmp, 200);
	}

	public function getCustomer(Request $request)
	{
		$data = Customer::where('NM_CUST', 'like', '%'.$request->nm_cust.'%')->where('KD_KAT', '=', '03')->join('users', 'users.id', '=', 'customer.id')->get();

		if ($data) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}	
	}

}
