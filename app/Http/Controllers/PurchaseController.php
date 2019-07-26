<?php

namespace App\Http\Controllers;
use DateTime;
use Illuminate\Http\Request;
use DB;

class PurchaseController extends Controller
{
    public function Purchases()
    {
        $list = DB::table('purchases')->get();
        $voucher = '';
        $total_amount = '';
        $data['voucher'] = $voucher;
        $data['total_amount'] = $total_amount;
        $data['list'] = $list;
        return view('purchases',$data);
    }
    public function Index()
    {
        $list = DB::table('categories')->get();
    	$voucher = '';
    	$total_amount = '';
    	$data['voucher'] = $voucher;
        $data['total_amount'] = $total_amount;
    	$data['list'] = $list;
    	return view('purchase_form',$data);
    }
    public function Purchase(Request $request)
    {
        $list = DB::table('categories')->get();
    	$vouchar_no = '';
    	$total_amount = '';

    	if (isset($_POST['search'])) {
    		$vouchar_no = $_POST['voucher'];
    		$result = DB::table('purchases')->where('vouchar_no',$vouchar_no)->first();
            if ($result) {
                $total_amount = $result->amount_t;
            }
             else
            {
                 return redirect('purchase')->with('status', 'Invalid Vouchar No!');
            }
	    	$data['voucher'] = $vouchar_no;
            $data['total_amount'] = $total_amount;
            $data['list'] = $list;

	    	return view('purchase_form',$data);
    	}
    	$product_name = $request->input('product_name');
    	$vouchar_no = $request->input('vouchar_no');

        $result = DB::table('purchases')->where('vouchar_no',$vouchar_no)->first();
        if ($result) {
            return redirect('purchase')->with('status', 'Duplicate Vouchar No!');
        }
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
            //$amount_t+= ($quantity[$i]*$unit_price[$i])+$other_expense[$i];
    		$amount_t+= $amount[$i]+$other_expense[$i];
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

        $voucher = $vouchar_no;
        $total_amount = $amount_t;
        $data['voucher'] = $voucher;
        $data['total_amount'] = $total_amount;
        $data['msg'] = 'Successfully Added';
        $data['list'] = $list;
        
        return view('purchase_form',$data);
    	
    	//return redirect()->route('purchase');
    }
}
