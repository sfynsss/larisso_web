<?php

namespace Larisso\Http\Controllers;

use Illuminate\Http\Request;

class OutletController extends Controller
{
    public function index(){
    	return view('outlet.index');
    }
}
