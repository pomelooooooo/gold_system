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
use App\PledgeLine;
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
        $pledge = Pledge::select("pledges.*", 'customer.name as namecustomer', 'customer.lastname as lastnamecustomer', 'customer.tel as telcustomer')->leftJoin('customer', 'pledges.customer_id', '=', 'customer.id')->orderBy('created_at', "desc");
        if (!empty($keyword)) {
            $pledge = $pledge->where('pledges.id', 'like', "%$keyword%")
                ->orWhere('pledges.customer_id', 'like', "%$keyword%");
        }
        $filter_customer = $request->get('filter_customer');
        if (!empty($filter_customer)) {
            $pledge = $pledge->where('pledges.customer_id', $filter_customer);
        }
        $pledge = $pledge->paginate(10);
        $customer = Customer::all();
        $users = User::all();
        return view('admin.pledge.index', compact('customer', 'users', 'pledge', 'keyword', 'filter_customer',));
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
        $code = "D" . $code;
        $pledge = Pledge::all();
        $product = Product::all();
        $producttype = TypeGold::all();
        $users = User::all();
        $customer = Customer::all();
        $striped = Striped::all();
        return view('admin.pledge.create', compact('product', 'gold_type', 'users', 'customer', 'striped', 'code', 'pledge', 'producttype'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pledge = Pledge::select('group_id')->orderBy('group_id', "desc")->first();
        if (!empty($pledge)) {
            $group_id = $pledge->group_id + 1;
        } else {
            $group_id = 1;
        }
        $price_pledge = $weight = $piece = 0;
        foreach ($request->allprice as $key => $price) {
            $price_pledge += $price;
            $weight += $request->gram[$key];
            $piece++;
        }
        $pledges = new Pledge(
            [
                'group_id' => $group_id,
                'user_id' => $request->get('user_id'),
                'customer_id' => $request->get('customer_id'),
                'status_check' => '0',
                'piece' => $piece,
                'weight' => $weight,
                'price_pledge' => $price_pledge,
                'installment_start' => $request->get('installment_start'),
                'installment_next' => $request->get('installment_next'),
            ]
        );
        $pledges->save();

        foreach ($request->get('code') as $key => $value) {
            $productdetail = new ProductDetails(
                [
                    'code' => $request->get('code')[$key],
                    'details' => $request->get('details')[$key],
                    'type_gold_id' => $request->get('type_gold_id')[$key],
                    'striped_id' => $request->get('striped_id')[$key],
                    'size' => $request->get('size')[$key],
                    'gram' => $request->get('gram')[$key],
                    'status' => '1',
                    'status_trade' => '3',
                    'type' => 'ทองจำนำ',
                    'allprice' => $request->get('allprice')[$key],
                    'user_id' => $request->get('user_id'),
                    'customer_id' => $request->get('customer_id'),
                    'datetime' => $request->get('datetime'),
                ]
            );
            $productdetail->save();

            $pledgeLine = new PledgeLine([
                'pledges_id' => $pledges->id,
                'product_detail_id' => $productdetail->id,
                'interest_per' => $request->get('interest_per')[$key],
                'interest_bath' => $request->get('interest_bath')[$key],
                'status_check' => '0',
            ]);
            $pledgeLine->save();
        }

        return redirect()->route('pledge.index');
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
        $pledges = Pledge::find($id);
        $producttype = TypeGold::all();
        $users = User::all();
        $customer = Customer::all();
        $striped = Striped::all();
        return view('admin.pledge.edit', compact('productdetail', 'producttype', 'striped', 'pledges', 'customer', 'users', 'gold_type', 'id'));
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
        $pledge = Pledge::find($id);
        $pledge->group_id = $request->get('group_id');
        $pledge->customer_id = $request->get('customer_id');
        $pledge->user_id = $request->get('user_id');
        $pledge->price_pledge = $request->get('price_pledge');
        $pledge->status_check = $request->get('status_check');
        $pledge->interest_per = $request->get('interest_per');
        $pledge->interest_bath = $request->get('interest_bath');
        $pledge->installment_start = $request->get('installment_start');
        $pledge->installment_next = $request->get('installment_next');
        $pledge->installment_end = $request->get('installment_end');
        $pledge->save();
        $customer = Customer::all();
        $users = User::all();
        // return view('admin.buy.index', compact('buy','users','customer', 'id'));
        return redirect()->route('pledge.index')->with(['productdetail' => $productdetail, 'users' => $users, 'customer' => $customer, 'pledge' => $pledge]);
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

    public function getTel($id)
    {
        $customer = Customer::where('id', $id)->first();
        // dd($customer);
        return response()->json(["customer" => $customer]);
    }
}
