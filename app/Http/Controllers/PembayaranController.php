<?php

namespace Larisso\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class PembayaranController extends Controller
{
	function getPayment()
	{
		$client = new Client();
		try {
			$res = $client->request('GET','http://192.168.1.15:8000/coba', []);
			$data = json_decode($res->getBody()->getContents());
			return view('payment',['token'=> $data->token]);
		} catch (Exception $e) {
			dd($e->getMessage());
		}
	}

	public function completed(Request $request)
	{
		// $order_id = $request->query('order_id');
		// $save = MstJual::where('no_ent', '=', $order_id)->update([
		// 	"sts_byr"	=> 1,
		// ]);

		// if ($save) {
		// 	return response()->json(['message' => 'Ubah Status MST Jual Berhasil'], 200);
		// } else {
		// 	return response()->json(['message' => 'Ubah Status MST Jual Gagal'], 401);
		// }

		$notif = new \Midtrans\Notification();

		$transaction = $notif->transaction_status;
		$fraud = $notif->fraud_status;

		error_log("Order ID $notif->order_id: "."transaction status = $transaction, fraud staus = $fraud");

		if ($transaction == 'capture') {
			if ($fraud == 'challenge') {
      // TODO Set payment status in merchant's database to 'challenge'
			}
			else if ($fraud == 'accept') {
      // TODO Set payment status in merchant's database to 'success'
				$save = MstJual::where('no_ent', '=', $notif->order_id)->update([
					"sts_byr"	=> 1,
				]);
			}
		}else if ($transaction == 'settlement') {
			// TODO set payment status in merchant's database to 'Settlement'
			$save = MstJual::where('no_ent', '=', $notif->order_id)->update([
				"sts_byr"	=> 1,
			]);
		} 
		else if ($transaction == 'cancel') {
			if ($fraud == 'challenge') {
      // TODO Set payment status in merchant's database to 'failure'
			}
			else if ($fraud == 'accept') {
      // TODO Set payment status in merchant's database to 'failure'
			}
		}
		else if ($transaction == 'deny') {
      // TODO Set payment status in merchant's database to 'failure'
		}
	}
}
