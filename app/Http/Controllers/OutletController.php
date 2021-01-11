<?php

namespace Larisso\Http\Controllers;

use Illuminate\Http\Request;
use Larisso\Outlet;
use Session;
use Redirect;

class OutletController extends Controller
{
    public function index(){
    	$data = Outlet::all();

    	return view('outlet.index', compact('data'));
    }

    public function tambahOutlet(Request $request)
    {
    	$status = 0;

    	if ($request->status == 1) {
    		$status = 1	;
    	} 

    	$insert = Outlet::insert([
    		'kd_outlet'			=> $request->kd_outlet,
    		'nama_outlet'		=> $request->nama_outlet,
    		'keterangan'		=> $request->keterangan,
    		'status'			=> $status,
    	]);

    	if ($insert) {
    		Session::flash('success', "Data Berhasil Ditambahkan !!!");
            return Redirect::back();
    	} else {
    		Session::flash('error', "Data Gagal Ditambahkan !!!");
            return Redirect::back();
    	}
    }

    public function ubahOutlet(Request $request)
    {
    	$status = 0;

    	if ($request->status == 1) {
    		$status = 1	;
    	} 

    	$insert = Outlet::where('kd_outlet', '=', $request->kd_outlet)->update([
    		'nama_outlet'		=> $request->nama_outlet,
    		'keterangan'		=> $request->keterangan,
    		'status'			=> $status,
    	]);

    	if ($insert) {
    		Session::flash('success', "Data Berhasil Diubah !!!");
            return Redirect::back();
    	} else {
    		Session::flash('error', "Data Gagal Diubah !!!");
            return Redirect::back();
    	}
    }

    public function deleteOutlet($id)
    {
    	$insert = Outlet::where('kd_outlet', '=', $id)->delete();

    	if ($insert) {
    		Session::flash('success', "Data Berhasil Dihapus !!!");
            return Redirect::back();
    	} else {
    		Session::flash('error', "Data Gagal Dihapus !!!");
            return Redirect::back();
    	}
    }
}
