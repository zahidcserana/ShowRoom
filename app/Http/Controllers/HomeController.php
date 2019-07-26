<?php

namespace App\Http\Controllers;
use DB;
use Session;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    /// Category
    public function CategoryForm()
    {
        return view('category_form');
    }

    public function CategoryAdd(Request $request)
    {
        $input = $request->except(['_token']);
        DB::table('categories')->insertGetId($input);
        //$data['msg'] = 'Successfully Added';
        Session::flash('success', 'Successfully Added');
        return redirect()->route('category');
    }

    public function CategoryInfo()
    {
        $list = DB::table('categories')->get();

        $data['title'] = 'Category';
        $data['header'] = 'Category Information';
        $data['list'] = $list;

        return view('categories',$data);
    }
    /// Item
    public function ItemForm()
    {
        $list = DB::table('categories')->get();
        $data['list'] = $list;
        return view('item_form',$data);
    }

    public function ItemAdd(Request $request)
    {
        $input = $request->except(['_token']);
        DB::table('items')->insertGetId($input);
        //$data['msg'] = 'Successfully Added';
        Session::flash('success', 'Successfully Added');
        return redirect()->route('item');
    }

     public function ItemInfo()
    {
        $list = DB::table('items')->get();

        $data['title'] = 'Item';
        $data['header'] = 'Item Information';
        $data['list'] = $list;

        return view('items',$data);
    }

    // ItemByCategory
    public function ItemByCategory(Request $request)
    {
        $category = $request->input('category');
        $list = DB::table('items')->where('category',$category)->get();

        echo json_encode(array('success' =>true, 'items'=>$list));
    }
    // GetItemStock
    public function GetItemStock(Request $request)
    {
        $item = $request->input('item');
        //$list = DB::table('items')->where('id',$item)->get();

        $r_data = DB::table('returns')
                ->select(DB::raw('SUM(returns.quantity) as r_quantity'))
                ->where('product', $item)
                ->first();

        $p_data = DB::table('purchases')
                ->select(DB::raw('SUM(purchases.quantity) as p_quantity'))
                ->where('product_name', $item)
                ->first();

        $s_data = DB::table('sales')
                ->select(DB::raw('SUM(sales.quantity) as s_quantity'))
                ->where('product', $item)
                ->first();

        $purchase = $p_data->p_quantity;
        $sale = $s_data->s_quantity;
        $return = $r_data->r_quantity;

        $stock = ($purchase + $return) - $sale;

        echo json_encode(array('success' =>true, 'stock'=>$stock));
    }
}
