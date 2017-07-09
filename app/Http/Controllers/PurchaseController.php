<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PurchaseController extends Controller
{
    public function Index()
    {
    	return view('purchase_form');
    }
    public function Purchase(Request $request)
    {
    	$input = $request->except(['_token']);
    	DB::table('purchases')->insertGetId($input);
    	return redirect()->route('purchase');
    }
}
