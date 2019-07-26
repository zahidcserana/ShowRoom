<?php

namespace App\Http\Controllers;
use DateTime;
use DB;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function Sales()
    {
        $list = DB::table('sales')->get();
        $voucher = '';
        $total_amount = '';
        $data['voucher'] = $voucher;
        $data['total_amount'] = $total_amount;
        $data['list'] = $list;
        return view('sales',$data);
    }
     public function Index()
    {
        $list = DB::table('categories')->get();

        $voucher = '';
        $total_amount = '';

        $lists = DB::table('purchases')
                ->select(DB::raw('group_concat(distinct(product_name)) as products'))
                ->groupBy('product_name')
                ->get();
        $product = array();
        foreach ($lists as $key => $value) {
            $product[] = $lists[$key]->products;
        }
        $data['voucher'] = $voucher;
        $data['total_amount'] = $total_amount;
        $data['product'] = $product;
        $data['list'] = $list;
        return view('sale',$data);
    }
    public function Sale(Request $request)
    {
        $list = DB::table('categories')->get();

        $vouchar_no = '';
        $total_amount = '';

        $lists = DB::table('purchases')
                ->select(DB::raw('group_concat(distinct(product_name)) as products'))
                ->groupBy('product_name')
                ->get();
        $product = array();
            foreach ($lists as $key => $value) {
            $product[] = $lists[$key]->products;
        }
        $data['product'] = $product;

        if (isset($_POST['search'])) {
            $vouchar_no = $_POST['voucher'];
            $result = DB::table('sales')->where('vouchar_no',$vouchar_no)->first();
            if ($result) {
                $total_amount = $result->total;
            }
            else
            {
                 return redirect('sale')->with('status', 'Invalid Vouchar No!');
            }
            
            $data['voucher'] = $vouchar_no;
            $data['total_amount'] = $total_amount;
            $data['list'] = $list;
            

            return view('sale',$data);
        }
        $shop = $request->input('shop');
        $product = $request->input('product');
        $vouchar_no = $request->input('vouchar_no');
        $result = DB::table('sales')->where('vouchar_no',$vouchar_no)->first();
        if ($result) {
            return redirect('sale')->with('status', 'Duplicate Vouchar No!');
        }
        $created_at = $request->input('created_at');
        $quantity = $request->input('quantity');
        $amount = $request->input('amount');
        $unit_price = $request->input('unit_price');
        $amount_t = $request->input('total');
        $due = $request->input('due');
        $less = $request->input('less');
        $totalSaleAmpunt = $amount_t - $less;
        

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
                            'shop'              => $shop,
                            'vouchar_no'        => $vouchar_no,
                            'created_at'        => $created_at,
                            'product'           => $product[$i],
                            'quantity'          => $quantity[$i],
                            'amount'            => $amount[$i],
                            'unit_price'        => $unit_price[$i],
                            'total'             => $totalSaleAmpunt,
                            'due'               => $due,
                            'less'              => $less
                       );

            DB::table('sales')->insertGetId($input);
        }

        $data['voucher'] = $vouchar_no;
        $data['total_amount'] = $totalSaleAmpunt;
        $data['list'] = $list;
        $data['msg'] = 'Successfully Added';

        return view('sale',$data);
        //return redirect()->route('sale');
    } 
    /// Return
    public function Returns()
    {
        $list = DB::table('returns')->get();
        $voucher = '';
        $total_amount = '';
        $data['voucher'] = $voucher;
        $data['total_amount'] = $total_amount;
        $data['list'] = $list;
        return view('returns',$data);
    }
    public function ReturnPrd()
    {
        $list = DB::table('categories')->get();
    	$voucher = '';
    	$total_amount = '';
    	$data['voucher'] = $voucher;

        $lists = DB::table('sales')
                ->select(DB::raw('group_concat(distinct(product)) as products'))
                ->groupBy('product')
                ->get();
        $product = array();
        foreach ($lists as $key => $value) {
            $product[] = $lists[$key]->products;
        }

         $lists = DB::table('sales')
                ->select(DB::raw('group_concat(distinct(vouchar_no)) as vouchars'))
                ->groupBy('vouchar_no')
                ->get();

        $vouchar_no = array();
        foreach ($lists as $key => $value) {
            $vouchar_no[] = $lists[$key]->vouchars;
        }

        $data['voucher'] = $voucher;
        $data['total_amount'] = $total_amount;
        $data['product'] = $product;
        $data['vouchar_no'] = $vouchar_no;
        $data['list'] = $list;

    	return view('return',$data);
    }
    public function ReturnProduct(Request $request)
    {
        ///print_r($_POST);exit();
    	$vouchar_no = '';
    	$total_amount = '';
/*
    	if (isset($_POST['search'])) {
    		$vouchar_no = $_POST['voucher'];
    		$total_amount = DB::table('sales')->where('vouchar_no',$vouchar_no)->first()->total;

	    	$data['voucher'] = $vouchar_no;
	    	$data['total_amount'] = $total_amount;

	    	return view('sale',$data);
    	}*/
        $vouchar_no = $request->input('vouchar_no');
    	$product = $request->input('product');
    	$created_at = $request->input('created_at');
    	$quantity = $request->input('quantity');
    	$amount = $request->input('amount');
    	$unit_price = $request->input('unit_price');

		$fromFormat = 'm/j/Y';
        $toFormat = 'Y-m-d';
        $format = $fromFormat;
        $dateTimeObj = DateTime::createFromFormat ( $format , $created_at);
        $created_at = $dateTimeObj->format($toFormat);

		$input = array(
                        'vouchar_no'    => $vouchar_no,
				    	'created_at' 	=> $created_at,
				    	'product' 		=> $product,
				    	'quantity' 		=> $quantity,
				    	'amount' 		=> $amount,
				    	'unit_price' 	=> $unit_price
				   );

		DB::table('returns')->insertGetId($input);
    	
    	return redirect()->route('return');
    }
}
