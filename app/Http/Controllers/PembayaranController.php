<?php

namespace Larisso\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Larisso\MstJual;

class PembayaranController extends Controller
{
	public function __construct(Request $request)
	{
		$this->request = $request;
        // Set your Merchant Server Key
		\Midtrans\Config::$serverKey = 'SB-Mid-server-R42h7zBQZua-ZwUg_PqPX9eX';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
		\Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
		\Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
		\Midtrans\Config::$is3ds = true;
	}

	public function get_transaction_status($order_id){
		try {
			$get_transaction_status = \Midtrans\Transaction::status($order_id);
		} catch (\Exception $e) {
			return 'error';
		}

		return $get_transaction_status;
	}

	public function get_paid(){
		$data = MstJual::where('sts_byr', 0)->get();
		if(!empty($data)){
			foreach ($data as $value) {
				$return = $this->get_transaction_status($value->transaction_id);
				if ($return->transaction_status == "settlement") {
					$update = MstJual::where('no_ent', $value->no_ent)->update([
						'sts_byr'	=> 1
					]);
				} else if ($return->transaction_status == "failur") {
					$update = MstJual::where('no_ent', $value->no_ent)->update([
						'sts_byr'	=> 2
					]);
				}
			}
		}
	}
}