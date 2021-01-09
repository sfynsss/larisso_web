<?php

namespace Larisso\Http\Controllers;

use Illuminate\Http\Request;
use Larisso\Penawaran;

class PenawaranController extends Controller
{
  function index()
 	{
    $data = Penawaran::all();
 		return view('Penawaran.penawaran', compact('data'));
 	}
 	
 	function inputPenawaran(Request $request) {
 		$path = $request->file('gambar_penawaran')->store(
 			'gambar_penawaran', 'public'
 		);
 		
 		if ($path) {
 			$insert = Penawaran::insert([
 				"gambar"			    => $path,
 				"penawaran"	      => $request->penawaran
 			]);
 			
 			if ($insert) {
 				return back()->with('success','Data Penawaran Berhasil Diinputkan');
 			} else {
 				return back()->with('error','Data Penawaran Gagal Diinputkan');
 			}
 		} else {
 			return back()->with('error','Harap Periksa Kembali file inputan Anda !!!');
 		}
 	}
}
