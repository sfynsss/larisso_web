<?php

namespace Larisso\Http\Controllers\Api;

use Illuminate\Http\Request;
use Larisso\Http\Controllers\Controller;
use Larisso\Penawaran;

class PenawaranController extends Controller
{
  public function index(Request $request)
 	{
 		$data = Penawaran::all();
 
 		if (count($data) > 0) {
 			return response()->json(['message' => 'Data Ditemukan', 'data' => $data], 200);
 		} else {
 			return response()->json(['message' => 'Data Tidak Ditemukan'], 401);
 		}
 	}
}
