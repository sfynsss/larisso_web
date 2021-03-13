<?php

namespace Larisso\Http\Controllers;

use Illuminate\Http\Request;
use Larisso\Promo;
use Redirect;
use Session;

class PromoController extends Controller
{

    public function index()
    {
        $data = Promo::all();
        return view('promo.index', compact('data'));
    }

    public function updatePromo(Request $request)
    {
        $save = Promo::where('id', '=', '1')->update([
            "nama_promo"=> $request->nama_promo,
            "tgl_mulai" => $request->tgl_mulai,
            "tgl_akhir" => $request->tgl_akhir
        ]);

        if ($save) {
            Session::flash('success', "Data Berhasil Diubah !!!");
            return Redirect::back();
        } else {
            Session::flash('error', "Data Gagal Diubah !!!");
            return Redirect::back();
        }
    }

}
