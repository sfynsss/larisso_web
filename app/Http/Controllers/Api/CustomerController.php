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
		$data = Customer::select('kd_cust')->orderBy('kd_cust', 'desc')->get();

		if (count($data) > 0) {
			// print_r($data);
			$data = (int) substr($data[0]->kd_cust, 2) + 1;
			$tmp = "01".sprintf("%'.06d", $data);
		} else {
			$tmp = "01".sprintf("%'.06d", 1);
		}
		return response()->json($tmp, 200);
	}

	public function getCustomer(Request $request)
	{
		$data = Customer::where('NM_CUST', 'like', '%'.$request->nm_cust.'%')->where('KD_KAT', '=', 'GROSIR')->join('users', 'users.id', '=', 'customer.id')->get();

		if ($data) {
			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
		} else {
			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
		}	
	}

}
