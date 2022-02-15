<?php

namespace App\Http\Controllers;

use App\ProductDetails;
use App\Product;
use App\TypeGold;
use App\Striped;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Customer;
use App\Pledge;
use Illuminate\Support\Facades\File;

class PledgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $productdetail = ProductDetails::select("product_details.*", 'customer.name as namecustomer', 'customer.lastname as lastnamecustomer', 'users.name as nameemployee', 'users.lastname as lastnameemployee', 'type_gold.name')->leftJoin('customer', 'product_details.customer_id', '=', 'customer.id')->leftJoin('type_gold', 'product_details.type_gold_id', '=', 'type_gold.id')->leftJoin('users', 'product_details.user_id', '=', 'users.id')->where('type', 'ทองจำนำ')->orderBy('created_at', "desc");
        if (!empty($keyword)) {
            $productdetail = $productdetail->where('product_details.code', 'like', "%$keyword%")
            ->orWhere('product_details.details', 'like', "%$keyword%")
            ->orWhere('product_details.type_gold_id', 'like', "%$keyword%")
            ->orWhere('product_details.category', 'like', "%$keyword%")
            ->orWhere('product_details.user_id', 'like', "%$keyword%")
            ->orWhere('product_details.customer_id', 'like', "%$keyword%");
        }
        $filter_type = $request->get('filter_type');
        if (!empty($filter_type)) {
            $productdetail = $productdetail->where('product_details.type_gold_id', $filter_type);
        }
        $filter_size = $request->get('filter_size');
        if (!empty($filter_size)) {
            $productdetail = $productdetail->where('product_details.size', $filter_size);
        }
        $productdetail = $productdetail->paginate(10);
        $producttype = TypeGold::all();
        $product = Product::all();
        $customer = Customer::all();
        $users = User::all();
        return view('admin.pledge.index', compact('product', 'productdetail','customer','users', 'keyword','filter_type','filter_size','producttype'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gold_type = ["ทองในถาด", "ทองในสต๊อค"];
        $productdetail = ProductDetails::select('code')->orderBy('code', "desc")->first();
        if (!empty($productdetail)) {
            $productdetail->code = substr($productdetail->code, 1);
            $code = $productdetail->code + 1;
            $num = "0";
            // dd(strlen(str_replace('0', '', $code)));
            if (strlen($code) <= 3) {
                for ($i = strlen($code); $i < 3; $i++) {
                    $num .= "0";
                }
                $code = $num . $code;
            }
        } else {
            $code = "0001";
        }
        $code = "P".$code;
        $product = Product::all();
        $producttype = TypeGold::all();
        $users = User::all();
        $customer = Customer::all();
        $striped = Striped::all();
        return view('admin.pledge.create', compact('product', 'gold_type','users','customer', 'striped', 'code', 'producttype'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->get('code') as $key => $value) {
            $productdetail = new ProductDetails(
                [
                    'code' => $request->get('code')[$key],
                    'details' => $request->get('details')[$key],
                    'type_gold_id' => $request->get('type_gold_id')[$key],
                    'striped_id' => $request->get('striped_id')[$key],
                    'size' => $request->get('size')[$key],
                    'gram' => $request->get('gram')[$key],
                    'status_trade' => '3',
                    'type' => 'ทองจำนำ',
                    'allprice' => $request->get('allprice')[$key],
                    'user_id' => $request->get('user_id'),
                    'customer_id' => $request->get('customer_id'),
                    'datetime' => $request->get('datetime'),
                ]
            );
            $productdetail->save();
            $pledges = new Pledge(
                [
                    'product_detail_id' => $productdetail->id,
                    'installment_start' => $request->get('installment_start'),
                    'installment_end' => $request->get('installment_end'),
                ]
            );
            $pledges -> save();
        }
        $producttype = TypeGold::all();
        $productdetail = ProductDetails::select("product_details.*", 'customer.name as namecustomer', 'customer.lastname as lastnamecustomer', 'users.name as nameemployee', 'users.lastname as lastnameemployee', 'type_gold.name')->leftJoin('customer', 'product_details.customer_id', '=', 'customer.id')->leftJoin('type_gold', 'product_details.type_gold_id', '=', 'type_gold.id')->leftJoin('users', 'product_details.user_id', '=', 'users.id')->where('type', 'ทองจำนำ')->orderBy('created_at', "desc")->paginate(5);
        $customer = Customer::all();
        $users = User::all();
        return view('admin.pledge.index', compact('productdetail', 'producttype', 'customer', 'users'));
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
        $gold_type = ["ทองในถาด", "ทองในสต๊อค"];
        $productdetail = ProductDetails::find($id);
        $producttype = TypeGold::all();
        $users = User::all();
        $customer = Customer::all();
        $striped = Striped::all();
        return view('admin.pledge.edit', compact('productdetail', 'producttype', 'striped', 'customer', 'users', 'gold_type', 'id'));
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
        $productdetail = ProductDetails::find($id);
        $productdetail->code = $request->get('code');
        $productdetail->details = $request->get('details');
        $productdetail->striped_id = $request->get('striped_id');
        $productdetail->size = $request->get('size');
        $productdetail->gram = $request->get('gram');
        $productdetail->status_trade = '0';
        $productdetail->type = 'ทองจำนำ';
        $productdetail->gratuity = $request->get('gratuity');
        $productdetail->user_id = $request->get('user_id');
        $productdetail->datetime = $request->get('datetime');
        $productdetail->customer_id = $request->get('customer_id');
        $productdetail->type_gold_id = $request->get('type_gold_id');
        $productdetail->allprice = $request->get('allprice');
        $productdetail->save();
        $productdetail = ProductDetails::select("product_details.*", 'customer.name as namecustomer', 'customer.lastname as lastnamecustomer', 'users.name as nameemployee', 'users.lastname as lastnameemployee', 'type_gold.name')->leftJoin('customer', 'product_details.customer_id', '=', 'customer.id')->leftJoin('type_gold', 'product_details.type_gold_id', '=', 'type_gold.id')->leftJoin('users', 'product_details.user_id', '=', 'users.id')->where('type', 'ทองจำนำ')->orderBy('created_at', "desc")->paginate(5);
        $customer = Customer::all();
        $users = User::all();
        // return view('admin.buy.index', compact('buy','users','customer', 'id'));
        return redirect()->route('pledge.index')->with(['productdetail' => $productdetail, 'users' => $users, 'customer' => $customer]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productdetail = ProductDetails::find($id);
        $productdetail->delete();
        $productdetail = ProductDetails::select("product_details.*", 'customer.name as namecustomer', 'customer.lastname as lastnamecustomer', 'users.name as nameemployee', 'users.lastname as lastnameemployee', 'type_gold.name')->leftJoin('customer', 'product_details.customer_id', '=', 'customer.id')->leftJoin('type_gold', 'product_details.type_gold_id', '=', 'type_gold.id')->leftJoin('users', 'product_details.user_id', '=', 'users.id')->where('type', 'ทองจำนำ')->orderBy('created_at', "desc")->paginate(5);
        $product = Product::all();
        $customer = Customer::all();
        $users = User::all();
        $producttype = TypeGold::all();
        return response()->json(['status' => true], 200);
    }
}
