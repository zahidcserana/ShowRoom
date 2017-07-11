<?php

namespace App\Http\Controllers;
use DateTime;
use DB;
use Illuminate\Http\Request;

class SalesController extends Controller
{
     public function Index()
    {
    	$voucher = '';
    	$total_amount = '';
    	$data['voucher'] = $voucher;
    	$data['total_amount'] = $total_amount;
    	return view('sale',$data);
    }
    public function Sale(Request $request)
    {
    	$vouchar_no = '';
    	$total_amount = '';

    	if (isset($_POST['search'])) {
    		$vouchar_no = $_POST['voucher'];
    		$total_amount = DB::table('sales')->where('vouchar_no',$vouchar_no)->first()->total;

	    	$data['voucher'] = $vouchar_no;
	    	$data['total_amount'] = $total_amount;

	    	return view('sale',$data);
    	}
    	$shop = $request->input('shop');
    	$product = $request->input('product');
    	$vouchar_no = $request->input('vouchar_no');
    	$created_at = $request->input('created_at');
    	$quantity = $request->input('quantity');
    	$amount = $request->input('amount');
    	$unit_price = $request->input('unit_price');
    	$amount_t = $request->input('total');

		$fromFormat = 'm/j/Y';
        $toFormat = 'Y-m-d';
        $format = $fromFormat;
        $dateTimeObj = DateTime::createFromFormat ( $format , $created_at);
        $created_at = $dateTimeObj->format($toFormat);
       
       /* for ($i=0; $i <count($product) ; $i++) { 
    		$amount_t+= ($quantity[$i]*$unit_price[$i])+$other_expense[$i];
    	}*/
    	for ($i=0; $i <count($product) ; $i++) { 

    		$input = array(
    						'shop' 		=> $shop,
    						'vouchar_no' 		=> $vouchar_no,
					    	'created_at' 		=> $created_at,
					    	'product' 		=> $product[$i],
					    	'quantity' 			=> $quantity[$i],
					    	'amount' 			=> $amount[$i],
					    	'unit_price' 		=> $unit_price[$i],
					    	'total' 			=> $amount_t
					   );

			DB::table('sales')->insertGetId($input);
    	}

    	
    	return redirect()->route('sale');
    }
}
