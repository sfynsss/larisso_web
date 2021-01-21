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

	public function completed($id)
	{
		// $data = str_replace('-', '/', $id);
		// print_r($data);
        // try {
        // } catch (\Exception $e) {
        //     return 'error';
        // }
        $get_transaction_status = \Midtrans\Transaction::status("INVJ0121/00004/00000001");
        var_dump($get_transaction_status);

        // return $get_transaction_status;
	}
}
