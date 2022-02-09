<?php

namespace App\Http\Controllers;

use App\ProductDetails;
use App\Product;
use App\TypeGold;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Customer;
use App\Striped;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $stocknew = ProductDetails::select("product_details.*", 'type_gold.name')->leftJoin('type_gold', 'product_details.type_gold_id', '=', 'type_gold.id')->orderBy('code', "desc")->where('type', 'ทองใหม่');
        if (!empty($keyword)) {
            $stocknew = $stocknew->where('product_details.code', 'like', "%$keyword%")
                ->orWhere('product_details.details', 'like', "%$keyword%");
        }
        $filter_type = $request->get('filter_type');
        if (!empty($filter_type)) {
            $stocknew = $stocknew->where('product_details.type_gold_id', $filter_type);
        }
        $filter_size = $request->get('filter_size');
        if (!empty($filter_size)) {
            $stocknew = $stocknew->where('product_details.size', $filter_size);
        }
        $filter_status = $request->get('filter_status');
        if ($filter_status == '0' || $filter_status == '1') {
            $stocknew = $stocknew->where('product_details.status_trade', "$filter_status");
        }
        $filter_date = $request->get('filter_date');
        if (!empty($filter_date)) {
            $stocknew = $stocknew->whereDate('product_details.created_at', $filter_date);
        }
        $stocknew = $stocknew->paginate(5);
        
        $keyword2 = $request->get('search2');
        $stockold = ProductDetails::select("product_details.*", 'customer.name as namecustomer', 'customer.lastname as lastnamecustomer', 'users.name as nameemployee', 'users.lastname as lastnameemployee', 'type_gold.name')->leftJoin('customer', 'product_details.customer_id', '=', 'customer.id')->leftJoin('type_gold', 'product_details.type_gold_id', '=', 'type_gold.id')->leftJoin('users', 'product_details.user_id', '=', 'users.id')->orderBy('code', "desc")->where('type', 'ทองเก่า');
        if (!empty($keyword2)) {
            $stockold = $stockold->where('product_details.code', 'like', "%$keyword2%")
                ->orWhere('product_details.details', 'like', "%$keyword2%");
        }
        $filter_type2 = $request->get('filter_type2');
        if (!empty($filter_type2)) {
            $stockold = $stockold->where('product_details.type_gold_id', $filter_type2);
        }
        $filter_size2 = $request->get('filter_size2');
        if (!empty($filter_size2)) {
            $stockold = $stockold->where('product_details.size', $filter_size2);
        }
        $filter_date2 = $request->get('filter_date2');
        if (!empty($filter_date2)) {
            $stockold = $stockold->whereDate('product_details.created_at', $filter_date2);
        }
        $stockold = $stockold->paginate(5);
        $product = Product::all();
        $typegold = TypeGold::all();
        $user = User::all();
        $customer = Customer::all();
        $striped = Striped::all();
        // dd($filter_status);
        return view('admin.stock.index', compact('product', 'stocknew', 'stockold', 'typegold', 'user', 'customer', 'striped', 'keyword', 'filter_type', 'filter_size', 'filter_status', 'filter_date', 'keyword2', 'filter_type2', 'filter_size2', 'filter_date2'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function stocknew(Request $request)
    {
        $keyword = $request->get('search');
        $stocknew = ProductDetails::select("product_details.*", 'type_gold.name')->leftJoin('type_gold', 'product_details.type_gold_id', '=', 'type_gold.id')->orderBy('code', "desc")->where('type', 'ทองใหม่');
        if (!empty($keyword)) {
            $stocknew = $stocknew->where('product_details.code', 'like', "%$keyword%")
                ->orWhere('product_details.details', 'like', "%$keyword%");
        }
        $filter_type = $request->get('filter_type');
        if (!empty($filter_type)) {
            $stocknew = $stocknew->where('product_details.type_gold_id', $filter_type);
        }
        $filter_size = $request->get('filter_size');
        if (!empty($filter_size)) {
            $stocknew = $stocknew->where('product_details.size', $filter_size);
        }
        $filter_status = $request->get('filter_status');
        if ($filter_status == '0' || $filter_status == '1') {
            $stocknew = $stocknew->where('product_details.status_trade', "$filter_status");
        }
        $filter_date = $request->get('filter_date');
        if (!empty($filter_date)) {
            $stocknew = $stocknew->whereDate('product_details.created_at', $filter_date);
        }
        $stocknew = $stocknew->paginate(20);
        $product = Product::all();
        $typegold = TypeGold::all();
        $user = User::all();
        $customer = Customer::all();
        $striped = Striped::all();
        return view('admin.stock.stocknew', compact('product', 'stocknew', 'typegold', 'user', 'customer', 'striped', 'keyword', 'filter_type', 'filter_size', 'filter_status', 'filter_date'));
    }
    public function stockold(Request $request)
    {
        $keyword2 = $request->get('search2');
        $stockold = ProductDetails::select("product_details.*", 'customer.name as namecustomer', 'customer.lastname as lastnamecustomer', 'users.name as nameemployee', 'users.lastname as lastnameemployee', 'type_gold.name')->leftJoin('customer', 'product_details.customer_id', '=', 'customer.id')->leftJoin('type_gold', 'product_details.type_gold_id', '=', 'type_gold.id')->leftJoin('users', 'product_details.user_id', '=', 'users.id')->orderBy('code', "desc")->where('type', 'ทองเก่า');
        if (!empty($keyword2)) {
            $stockold = $stockold->where('product_details.code', 'like', "%$keyword2%")
                ->orWhere('product_details.details', 'like', "%$keyword2%");
        }
        $filter_type2 = $request->get('filter_type2');
        if (!empty($filter_type2)) {
            $stockold = $stockold->where('product_details.type_gold_id', $filter_type2);
        }
        $filter_size2 = $request->get('filter_size2');
        if (!empty($filter_size2)) {
            $stockold = $stockold->where('product_details.size', $filter_size2);
        }
        $filter_date2 = $request->get('filter_date2');
        if (!empty($filter_date2)) {
            $stockold = $stockold->whereDate('product_details.created_at', $filter_date2);
        }
        $stockold = $stockold->paginate(15);
        $product = Product::all();
        $typegold = TypeGold::all();
        $user = User::all();
        $customer = Customer::all();
        $striped = Striped::all();
        // dd($filter_status);
        return view('admin.stock.stockold', compact('product',  'stockold', 'typegold', 'user', 'customer', 'striped', 'keyword2', 'filter_type2', 'filter_size2', 'filter_date2'));
    }

    public function updateGroup(Request $request)
    {
        ProductDetails::whereIn('id', explode(",", $request->id))->update(['status_trade' => '3']);

        return response()->json(['status' => true], 200);
    }
}
