<?php

namespace Larisso\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Larisso\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Larisso\Mail\EmailActivation;
use Larisso\User;
use Larisso\Customer;
use Validator;

class RegisterController extends Controller
{
	public function validator(Request $request)
	{

		$validasi = Validator::make($request->all(), [
			'name' => 'required|string|max:255',
			'tanggal_lahir' => 'required|date',
			'email' => 'required|string|email|max:255|unique:users,email',
			'no_telp' => 'required|string|unique:users,no_telp',
			'password' => 'required|string|min:6',
		]);

		if ($validasi->fails()) {
			return response()->json(['message' => 'Unauthorized', 'error' => $validasi->errors()], 422);
		} else {
			return response()->json(['message' => 'Validasi Berhasil'], 200);
		}
	}

	public function register(Request $request)
	{
		$otor;
		if ($request->kd_kat == "02") {
			$otor = "2";
		} else if ($request->kd_kat == "03") {
			$otor = "3";
		}
		$user = User::insertGetId([
			'name' => $request->name,
			'tanggal_lahir' => $request->tanggal_lahir,
			'email' => $request->email,
			'alamat' => $request->alamat,
			'no_telp' => $request->no_telp,
			'password' => bcrypt($request->password),
			'api_token' => bin2hex(openssl_random_pseudo_bytes(30)),
			'firebase_token' => $request->firebase_token,
			'email_activation' => '0', 
			'otoritas'	=> $otor,
			'activation_token' => substr(str_shuffle("0123456789"), 0, 4)
		]);

		$data = Customer::where('kd_kat', '=', $request->kd_kat)->where('cabang', '=', "01-Online")->max('kd_cust');

		if ($data) {
            // print_r($data);
			$data = (int) substr($data, 5, 8) + 1;
			$tmp = "O-".$request->kd_kat."".sprintf("%'.04d", $data);
		} else {
			$tmp = "O-".$request->kd_kat."".sprintf("%'.04d", 1);
		}

		$save = Customer::insert([
			'kd_cust'		=> $tmp,
			'id'			=> $user,
			'cabang'		=> "01-Online",
			'kd_kat'		=> $request->kd_kat,
			'nm_cust'		=> $request->name,
			'alm_cust'		=> $request->alamat,
			'krd_limit'		=> 1000000,
			'e_mail'		=> $request->email,
			'hp'			=> $request->no_telp,
			'top'			=> 30
		]);

		if ($save) {
			$register = User::where('id', '=', $user)->first();

			$name = $register['name'];
			$token = $register['activation_token'];
			Mail::to($register['email'])->send(new EmailActivation($name, $token));

			return response()->json(compact('register'), 200);
		} else {
			return response()->json(['error' => 'Registration Failed'], 401);
		}
	}

	public function aktifasi(Request $request)
	{
		$user = User::where('id', '=', $request->id)->where('activation_token', '=', $request->token)->update([
			'email_activation'		=> '1',
			'activation_token'		=> ""
		]);

		if ($user) {
			return response()->json(['message' => 'Aktifasi Berhasil'], 200);
		} else {
			return response()->json(['message' => 'Aktifasi Gagal, silahkan perikasa kembali kode aktifasi Anda'], 401);
		}
	}

	
}
