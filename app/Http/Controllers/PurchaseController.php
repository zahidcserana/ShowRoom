<?php

namespace App\Http\Controllers;
use DateTime;
use Illuminate\Http\Request;
use DB;

class PurchaseController extends Controller
{
    public function Index()
    {
    	$voucher = '';
    	$total_amount = '';
    	$data['voucher'] = $voucher;
    	$data['total_amount'] = $total_amount;
    	return view('purchase_form',$data);
    }
    public function Purchase(Request $request)
    {
    	$vouchar_no = '';
    	$total_amount = '';

    	if (isset($_POST['search'])) {
    		$vouchar_no = $_POST['voucher'];
    		$total_amount = DB::table('purchases')->where('vouchar_no',$vouchar_no)->first()->amount_t;

	    	$data['voucher'] = $vouchar_no;
	    	$data['total_amount'] = $total_amount;

	    	return view('purchase_form',$data);
    	}
    	$product_name = $request->input('product_name');
    	$vouchar_no = $request->input('vouchar_no');
    	$created_at = $request->input('created_at');
    	$brand = $request->input('brand');
    	$purchase_from = $request->input('purchase_from');
    	$quantity = $request->input('quantity');
    	$amount = $request->input('amount');
    	$other_expense = $request->input('other_expense');
    	$unit_price = $request->input('unit_price');
    	$purchase_by = $request->input('purchase_by');

		$fromFormat = 'm/j/Y';
        $toFormat = 'Y-m-d';
        $format = $fromFormat;
        $dateTimeObj = DateTime::createFromFormat ( $format , $created_at);
        $created_at = $dateTimeObj->format($toFormat);
        $amount_t = 0;
        for ($i=0; $i <count($product_name) ; $i++) { 
    		$amount_t+= ($quantity[$i]*$unit_price[$i])+$other_expense[$i];
    	}
    	for ($i=0; $i <count($product_name) ; $i++) { 

    		$input = array(
    						'vouchar_no' 		=> $vouchar_no,
					    	'created_at' 		=> $created_at,
					    	'product_name' 		=> $product_name[$i],
					    	'brand' 			=> $brand[$i],
					    	'purchase_from' 	=> $purchase_from[$i],
					    	'quantity' 			=> $quantity[$i],
					    	'amount' 			=> $amount[$i],
					    	'other_expense' 	=> $other_expense[$i],
					    	'unit_price' 		=> $unit_price[$i],
					    	'purchase_by' 		=> $purchase_by[$i],
					    	'amount_t' 			=> $amount_t
					   );

			DB::table('purchases')->insertGetId($input);
    	}

    	
    	return redirect()->route('purchase');
    }
}
