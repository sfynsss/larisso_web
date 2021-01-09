<?php

namespace Larisso\Http\Controllers;

use Illuminate\Http\Request;
use Larisso\User;
use Session;
use Redirect;

class UserController extends Controller
{
	public function index($id)
	{
		if ($id == "admin") {
			$data = User::where('otoritas', '!=', 1)->where('otoritas', '=', 4)->get();	
		} else if ($id == "sales") {
			$data = User::where('otoritas', '!=', 1)->where('otoritas', '=', 5)->get();	
		}

		$status = $id;
		return view('User.user', compact('data', 'status'));
	}

	public function tambahUser($id, Request $request)
	{
		if ($id == "admin") {
			$insert = User::insert([
				'name' => $request->name,
				'tanggal_lahir' => $request->tgl_lahir,
				'email' => $request->email,
				'alamat' => $request->alamat,
				'no_telp' => $request->no_telp,
				'password' => bcrypt($request->password),
				'api_token' => bin2hex(openssl_random_pseudo_bytes(30)),
				'email_activation' => '1', 
				'otoritas'	=> '4'
			]);
		} else if ($id == "sales") {
			$insert = User::insert([
				'name' => $request->name,
				'tanggal_lahir' => $request->tgl_lahir,
				'email' => $request->email,
				'alamat' => $request->alamat,
				'no_telp' => $request->no_telp,
				'password' => bcrypt($request->password),
				'api_token' => bin2hex(openssl_random_pseudo_bytes(30)),
				'email_activation' => '1', 
				'otoritas'	=> '5',
				'kd_peg'	=> $request->kd_peg
			]);	
		}

		if ($insert) {
			Session::flash('success', "Data Berhasil Ditambahkan !!!");
			return Redirect::back();
		} else {
			Session::flash('error', "Data Gagal Ditambahkan !!!");
			return Redirect::back();
		}
	}

}
