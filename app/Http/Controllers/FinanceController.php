<?php

namespace App\Http\Controllers;
use DateTime;
use DB;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
      public function Index()
    {
    	$voucher = '';
    	$total_amount = '';
    	$data['voucher'] = $voucher;
    	$data['total_amount'] = $total_amount;
    	return view('finance',$data);
    }
    public function Finance(Request $request)
    {
    	/*$vouchar_no = '';
    	$total_amount = '';

    	if (isset($_POST['search'])) {
    		$vouchar_no = $_POST['voucher'];
    		$total_amount = DB::table('sales')->where('vouchar_no',$vouchar_no)->first()->total;

	    	$data['voucher'] = $vouchar_no;
	    	$data['total_amount'] = $total_amount;

	    	return view('sale',$data);
    	}*/
    	$vouchar_no = $request->input('vouchar_no');
    	$created_at = $request->input('created_at');
    	$person = $request->input('person');
    	$purpose = $request->input('purpose');
    	$issue = $request->input('issue');
    	$used = $request->input('used');
    	$deposited = $request->input('deposited');

		$fromFormat = 'm/j/Y';
        $toFormat = 'Y-m-d';
        $format = $fromFormat;
        $dateTimeObj = DateTime::createFromFormat ( $format , $created_at);
        $created_at = $dateTimeObj->format($toFormat);
       
       /* for ($i=0; $i <count($product) ; $i++) { 
    		$amount_t+= ($quantity[$i]*$unit_price[$i])+$other_expense[$i];
    	}*/

		$input = array(
						'vouchar_no' 	=> $vouchar_no,
				    	'created_at' 	=> $created_at,
				    	'person' 		=> $person,
				    	'purpose' 		=> $purpose,
				    	'issue' 		=> $issue,
				    	'used' 			=> $used,
				    	'deposited' 	=> $deposited
				   );

		DB::table('finances')->insertGetId($input);
    	

    	
    	return redirect()->route('finance');
    }
    public function InventoryReport()
    {
         $p_data = DB::table('purchases')
        ->select(DB::raw('SUM(purchases.quantity) as p_quantity,group_concat(distinct(product_name)) as p_product'))
        ->groupBy('product_name')
        ->get();

        $s_data = DB::table('sales')
        ->select(DB::raw('SUM(sales.quantity) as s_quantity,group_concat(distinct(product)) as s_product'))
        ->groupBy('product')
        ->get();

        $r_data = DB::table('returns')
        ->select(DB::raw('SUM(returns.quantity) as r_quantity,group_concat(distinct(product)) as r_product'))
        ->groupBy('product')
        ->get();

        $product = array();
        $quantity = array();
        $quantity_p = array();
        $quantity_s = array();
        $quantity_r = array();
        for ($i=0; $i < count($p_data); $i++) { 
            $temp_product = $p_data[$i]->p_product;
            $temp_quantity = $p_data[$i]->p_quantity;
            $temp_quantity_s = 0;
            for ($j=0; $j < count($s_data); $j++) { 
                if ($temp_product==$s_data[$j]->s_product) {
                    $temp_quantity = $p_data[$i]->p_quantity - $s_data[$j]->s_quantity;
                    $temp_quantity_s = $s_data[$j]->s_quantity;
                }
            }
           /* $product[] = $temp_product;
            $quantity[] = $temp_quantity;
            $quantity_p[] = $p_data[$i]->p_quantity;
            $quantity_s[] = $temp_quantity_s;*/
      
        	$temp_quantity_r = 0;
        	for ($j=0; $j < count($r_data); $j++) { 
        		if ($temp_product==$r_data[$j]->r_product) {
        			$temp_quantity_r = $r_data[$j]->r_quantity;
        		}
        	}
        	$product[] = $temp_product;
        	$quantity[] = $temp_quantity + $temp_quantity_r;
        	$quantity_p[] = $p_data[$i]->p_quantity;
            $quantity_s[] = $temp_quantity_s;
        	$quantity_r[] = $temp_quantity_r;
        }

        $data['product'] 	= $product;
        $data['quantity'] 	= $quantity;
        $data['quantity_p'] = $quantity_p;
        $data['quantity_s'] = $quantity_s;
        $data['quantity_r'] = $quantity_r;
        $data['date_from'] 	= '';
        $data['date_to'] 	= '';
    	  
    	return view('inventory_report',$data);
    } 
    public function InventorySearch(Request $request)
    {
    	$date_from = $request->input('date_from');
    	$date_to = $request->input('date_to');

    	$fromFormat = 'm/j/Y';
        $toFormat = 'Y-m-d';
        $format = $fromFormat;
        $dateTimeObj = DateTime::createFromFormat ( $format , $date_from);
        $date_from = $dateTimeObj->format($toFormat);

        $fromFormat = 'm/j/Y';
        $toFormat = 'Y-m-d';
        $format = $fromFormat;
        $dateTimeObj = DateTime::createFromFormat ( $format , $date_to);
        $date_to = $dateTimeObj->format($toFormat);

        $r_data = DB::table('returns')
                ->select(DB::raw('SUM(returns.quantity) as r_quantity,group_concat(distinct(product)) as r_product'))
                ->where('created_at', '>=', $date_from)
                ->where('created_at', '<=', $date_to)
                ->groupBy('product')
                ->get();

         $p_data = DB::table('purchases')
        ->select(DB::raw('SUM(purchases.quantity) as p_quantity,group_concat(distinct(product_name)) as p_product'))
        ->where('created_at', '>=', $date_from)
        ->where('created_at', '<=', $date_to)
        ->groupBy('product_name')
        ->get();

        $s_data = DB::table('sales')
        ->select(DB::raw('SUM(sales.quantity) as s_quantity,group_concat(distinct(product)) as s_product'))
        ->where('created_at', '>=', $date_from)
        ->where('created_at', '<=', $date_to)
        ->groupBy('product')
        ->get();

        $product = array();
        $quantity = array();
        $quantity_p = array();
        $quantity_s = array();
        $quantity_r = array();
        for ($i=0; $i < count($p_data); $i++) { 
        	$temp_product = $p_data[$i]->p_product;
        	$temp_quantity = $p_data[$i]->p_quantity;
        	$temp_quantity_s = 0;
        	for ($j=0; $j < count($s_data); $j++) { 
        		if ($temp_product==$s_data[$i]->s_product) {
        			$temp_quantity = $p_data[$i]->p_quantity - $s_data[$i]->s_quantity;
        			$temp_quantity_s = $s_data[$i]->s_quantity;
        		}
        	}

        	$temp_quantity_r = 0;
            for ($j=0; $j < count($r_data); $j++) { 
                if ($temp_product==$r_data[$j]->r_product) {
                    $temp_quantity_r = $r_data[$j]->r_quantity;
                }
            }
            $product[] = $temp_product;
            $quantity[] = $temp_quantity + $temp_quantity_r;
            $quantity_p[] = $p_data[$i]->p_quantity;
            $quantity_s[] = $temp_quantity_s;
            $quantity_r[] = $temp_quantity_r;
        }


        $data['product'] 	= $product;
        $data['quantity'] 	= $quantity;
        $data['quantity_p'] = $quantity_p;
        $data['quantity_s'] = $quantity_s;
        $data['quantity_r'] = $quantity_r;
        $data['date_from'] 	= $date_from;
        $data['date_to'] 	= $date_to;
    	  
    	return view('inventory_report',$data);
    } 
    public function FinanceReport()
    {
    	$finances = DB::table('finances')
			        ->select(DB::raw('SUM(finances.used) as used'))
			        ->first();

         $p_data = DB::table('purchases')
        ->select(DB::raw('SUM(purchases.amount) as p_amount,group_concat(distinct(product_name)) as p_product'))
        ->groupBy('product_name')
        ->get();

        $s_data = DB::table('sales')
        ->select(DB::raw('SUM(sales.amount) as s_amount,group_concat(distinct(product)) as s_product'))
        ->groupBy('product')
        ->get();

        $r_data = DB::table('returns')
        ->select(DB::raw('SUM(returns.amount) as r_amount,group_concat(distinct(product)) as r_product'))
        ->groupBy('product')
        ->get();

        

        $product = array();
        $amount = array();
        $amount_p = array();
        $amount_s = array();
        $total_difference = 0;
        for ($i=0; $i < count($p_data); $i++) { 
        	$temp_product = $p_data[$i]->p_product;
        	$temp_amount = $p_data[$i]->p_amount;
        	$temp_amount_s = 0;
        	for ($j=0; $j < count($s_data); $j++) { 
        		if ($temp_product==$s_data[$i]->s_product) {
                    //$temp_amount = $s_data[$i]->s_amount - $p_data[$i]->p_amount;
        			$temp_amount = $s_data[$i]->s_amount;
        			$temp_amount_s = $s_data[$i]->s_amount;
        		}
        	}
        	/*$product[] = $temp_product;
        	//$amount[] = $temp_amount;
        	$total_difference+= $temp_amount;
        	$amount_p[] = $p_data[$i]->p_amount;
        	$amount_s[] = $temp_amount_s;*/

            $temp_amount_r = 0;
            for ($j=0; $j < count($r_data); $j++) { 
                if ($temp_product==$r_data[$j]->r_product) {
                    $temp_amount_r = $r_data[$j]->r_amount;
                }
            }
            $product[] = $temp_product;
            $difference = $temp_amount - $temp_amount_r;
            $total_difference+= $difference;
            $amount[] = $difference;
            $amount_p[] = $p_data[$i]->p_amount;
            $amount_s[] = $temp_amount_s;
            $amount_r[] = $temp_amount_r;
        }

        $data['product'] 	= $product;
        $data['amount'] 	= $amount;
        $data['amount_p'] = $amount_p;
        $data['amount_s'] = $amount_s;
        $data['amount_r'] = $amount_r;
        $data['total_difference'] = $total_difference;
        $data['date_from'] 	= '';
        $data['date_to'] 	= '';
        $data['used'] 	= $finances->used;
        $data['net_difference'] = $total_difference - $finances->used;
    	  
    	return view('finance_report',$data);
    } 
    public function FinanceSearch(Request $request)
    {
    	$date_from = $request->input('date_from');
    	$date_to = $request->input('date_to');

    	if ($date_from==NULL) {
    		$date_from = '00';
    	}
    	if ($date_to==NULL) {
    		$date_to = '00';
    	}

    	$fromFormat = 'm/j/Y';
        $toFormat = 'Y-m-d';
        $format = $fromFormat;
        $dateTimeObj = DateTime::createFromFormat ( $format , $date_from);
        $date_from = $dateTimeObj->format($toFormat);

        $fromFormat = 'm/j/Y';
        $toFormat = 'Y-m-d';
        $format = $fromFormat;
        $dateTimeObj = DateTime::createFromFormat ( $format , $date_to);
        $date_to = $dateTimeObj->format($toFormat);


         $finances = DB::table('finances')
			        ->select(DB::raw('SUM(finances.used) as used'))
			        ->where('created_at', '>=', $date_from)
			        ->where('created_at', '<=', $date_to)
			        ->first();
		

        $p_data = DB::table('purchases')
        ->select(DB::raw('SUM(purchases.amount) as p_amount,group_concat(distinct(product_name)) as p_product'))
        ->where('created_at', '>=', $date_from)
        ->where('created_at', '<=', $date_to)
        ->groupBy('product_name')
        ->get();

        $s_data = DB::table('sales')
        ->select(DB::raw('SUM(sales.amount) as s_amount,group_concat(distinct(product)) as s_product'))
        ->where('created_at', '>=', $date_from)
        ->where('created_at', '<=', $date_to)
        ->groupBy('product')
        ->get();

        $product = array();
        $amount = array();
        $amount_p = array();
        $amount_s = array();
        $total_difference = 0;
        for ($i=0; $i < count($p_data); $i++) { 
        	$temp_product = $p_data[$i]->p_product;
        	$temp_amount = $p_data[$i]->p_amount;
        	$temp_amount_s = 0;
        	for ($j=0; $j < count($s_data); $j++) { 
        		if ($temp_product==$s_data[$i]->s_product) {
        			$temp_amount =  $s_data[$i]->s_amount - $p_data[$i]->p_amount;
        			$temp_amount_s = $s_data[$i]->s_amount;
        		}
        	}
        	$product[] = $temp_product;
        	$amount[] = $temp_amount;
        	$total_difference+= $temp_amount;
        	$amount_p[] = $p_data[$i]->p_amount;
        	$amount_s[] = $temp_amount_s;
        }

        $data['product'] 	= $product;
        $data['amount'] 	= $amount;
        $data['amount_p'] = $amount_p;
        $data['amount_s'] = $amount_s;
        $data['total_difference'] = $total_difference;
        $data['date_from'] 	= $date_from;
        $data['date_to'] 	= $date_to;
        $data['used'] 	= $finances->used;
        $data['net_difference'] = $total_difference - $finances->used;
    	  
    	return view('finance_report',$data);
    }
}
