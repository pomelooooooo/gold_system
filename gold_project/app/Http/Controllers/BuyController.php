<?php

namespace App\Http\Controllers;

use App\ProductDetails;
use App\Product;
use App\TypeGold;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Customer;
use App\FormBuy;
use App\Striped;
use PDF;
use Illuminate\Support\Facades\File;

class BuyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $buy = ProductDetails::select("product_details.*", 'customer.name as namecustomer', 'customer.lastname as lastnamecustomer', 'users.name as nameemployee', 'users.lastname as lastnameemployee', 'type_gold.name')->leftJoin('customer', 'product_details.customer_id', '=', 'customer.id')->leftJoin('type_gold', 'product_details.type_gold_id', '=', 'type_gold.id')->leftJoin('users', 'product_details.user_id', '=', 'users.id')->where('type', 'ทองเก่า');
        if (!empty($keyword)) {
            $buy = $buy->where('product_details.code', 'like', "%$keyword%")
                ->orWhere('product_details.details', 'like', "%$keyword%")
                ->orWhere('product_details.type_gold_id', 'like', "%$keyword%")
                ->orWhere('product_details.category', 'like', "%$keyword%")
                ->orWhere('product_details.user_id', 'like', "%$keyword%")
                ->orWhere('product_details.customer_id', 'like', "%$keyword%");
        }
        $filter_type = $request->get('filter_type');
        if (!empty($filter_type)) {
            $buy = $buy->where('product_details.type_gold_id', $filter_type);
        }
        $filter_size = $request->get('filter_size');
        if (!empty($filter_size)) {
            $buy = $buy->where('product_details.size', $filter_size);
        }
        $buy = $buy->orderBy('created_at', "desc");
        $buy = $buy->paginate(5);
        $customer = Customer::all();
        $producttype = TypeGold::all();
        $users = User::all();
        return view('admin.buy.index', compact('buy', 'users', 'keyword', 'customer', 'producttype', 'filter_type', 'filter_size'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gold_type = ["ทองในถาด", "ทองในสต๊อค"];
        $buy = ProductDetails::select('code')->orderBy('code', "desc")->where('type', 'ทองเก่า')->first();
        if (!empty($buy)) {
            $buy->code = substr($buy->code, 1);
            $code = $buy->code + 1;
            $num = "0";
            if (strlen($code) <= 3) {
                for ($i = strlen($code); $i < 3; $i++) {
                    $num .= "0";
                }
                $code = $num . $code;
            }
        } else {
            $code = "0001";
        }
        $code = "L" . $code;
        $producttype = TypeGold::all();
        $users = User::all();
        $customer = Customer::all();
        $striped = Striped::all();
        return view('admin.buy.create-buy', compact('producttype', 'buy', 'striped', 'gold_type', 'code', 'users', 'customer'));
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
            $buy = new ProductDetails(
                [
                    'code' => $request->get('code')[$key],
                    'details' => $request->get('details')[$key],
                    'type_gold_id' => $request->get('type_gold_id')[$key],
                    'striped_id' => $request->get('striped_id')[$key],
                    'size' => $request->get('size')[$key],
                    'gram' => $request->get('gram')[$key],
                    'status' => '1',
                    'status_trade' => '0',
                    'type' => 'ทองเก่า',
                    'allprice' => $request->get('allprice')[$key],
                    'user_id' => $request->get('user_id'),
                    'customer_id' => $request->get('customer_id'),
                    'datetime' => $request->get('datetime'),
                ]
            );
            if ($request->hasFile('pic')) {
                $file = $request->file('pic')[$key];

                $extension = $file->getClientOriginalExtension();
                $filename = time() . $key . '.' . $extension;
                $file->move('assets/img/gold', $filename);
                $buy->pic = $filename;
            }
            $buy->save();
        }

        $producttype = TypeGold::all();
        $buy = ProductDetails::select("product_details.*", 'customer.name as namecustomer', 'customer.lastname as lastnamecustomer', 'users.name as nameemployee', 'users.lastname as lastnameemployee', 'type_gold.name')->leftJoin('customer', 'product_details.customer_id', '=', 'customer.id')->leftJoin('type_gold', 'product_details.type_gold_id', '=', 'type_gold.id')->leftJoin('users', 'product_details.user_id', '=', 'users.id')->where('type', 'ทองเก่า')->orderBy('created_at', "desc")->paginate(5);
        $customer = Customer::all();
        $users = User::all();
        return redirect('/buy')->with(['producttype' => $producttype, 'buy' => $buy, 'customer' => $customer, 'users' => $users]);
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
        $buy = ProductDetails::find($id);
        $producttype = TypeGold::all();
        $users = User::all();
        $customer = Customer::all();
        $striped = Striped::all();
        return view('admin.buy.edit', compact('buy', 'producttype', 'striped', 'customer', 'users', 'gold_type', 'id'));
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
        $buy = ProductDetails::find($id);
        $buy->code = $request->get('code');
        $buy->details = $request->get('details');
        $buy->striped_id = $request->get('striped_id');
        $buy->size = $request->get('size');
        $buy->gram = $request->get('gram');
        $buy->status = '1';
        $buy->status_trade = '0';
        $buy->type = 'ทองเก่า';
        $buy->gratuity = $request->get('gratuity');
        $buy->user_id = $request->get('user_id');
        $buy->datetime = $request->get('datetime');
        $buy->customer_id = $request->get('customer_id');
        $buy->type_gold_id = $request->get('type_gold_id');
        $buy->allprice = $request->get('allprice');

        // $managegold->pic = $request->get('pic');
        if ($request->hasFile('pic')) {
            $destination = 'assets/img/gold' . $buy->pic;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('pic');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('assets/img/gold', $filename);
            $buy->pic = $filename;
        }
        $buy->save();
        $buy = ProductDetails::select("product_details.*", 'customer.name as namecustomer', 'users.name as nameemployee', 'type_gold.name')->leftJoin('customer', 'product_details.customer_id', '=', 'customer.id')->leftJoin('type_gold', 'product_details.type_gold_id', '=', 'type_gold.id')->leftJoin('users', 'product_details.user_id', '=', 'users.id')->where('type', 'ทองเก่า')->paginate(5);
        $customer = Customer::all();
        $users = User::all();
        // return view('admin.buy.index', compact('buy','users','customer', 'id'));
        return redirect()->route('buy.index')->with(['buy' => $buy, 'users' => $users, 'customer' => $customer]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buy = ProductDetails::find($id);
        $buy->delete();
        $buy = ProductDetails::select("product_details.*", 'customer.name as namecustomer', 'users.name as nameemployee', 'type_gold.name')->leftJoin('customer', 'product_details.customer_id', '=', 'customer.id')->leftJoin('type_gold', 'product_details.type_gold_id', '=', 'type_gold.id')->leftJoin('users', 'product_details.user_id', '=', 'users.id')->where('type', 'ทองเก่า')->paginate(5);
        $product = Product::all();
        $customer = Customer::all();
        $users = User::all();
        $producttype = TypeGold::all();
        return response()->json(['status' => true], 200);
    }

    public function updateGroup(Request $request)
    {
        $form_buy = FormBuy::select('group_id')->orderBy('group_id', "desc")->first();
        if (!empty($form_buy)) {
            $group_id = $form_buy->group_id + 1;
        } else {
            $group_id = 1;
        }
        foreach ($request->get('code') as $key => $value) {
            $buy = new ProductDetails(
                [
                    'code' => $request->get('code')[$key],
                    'details' => $request->get('details')[$key],
                    'type_gold_id' => $request->get('type_gold_id')[$key],
                    'striped_id' => $request->get('striped_id')[$key],
                    'size' => $request->get('size')[$key],
                    'gram' => $request->get('gram')[$key],
                    'status' => '1',
                    'status_trade' => '0',
                    'type' => 'ทองเก่า',
                    'allprice' => $request->get('allprice')[$key],
                    'user_id' => $request->get('user_id'),
                    'customer_id' => $request->get('customer_id'),
                    'datetime' => $request->get('datetime'),
                ]
            );
            if ($request->hasFile('pic')) {
                $file = $request->file('pic')[$key];

                $extension = $file->getClientOriginalExtension();
                $filename = time() . $key . '.' . $extension;
                $file->move('assets/img/gold', $filename);
                $buy->pic = $filename;
            }
            $buy->save();

            $formbuy = new FormBuy([
                'group_id' => $group_id,
                'product_detail_id' => $buy->id,
                'customer_id' => $request->get('customer_id'),
            ]);
            $formbuy->save();
        }

        $producttype = TypeGold::all();
        $buy = ProductDetails::select("product_details.*", 'customer.name as namecustomer', 'customer.lastname as lastnamecustomer', 'users.name as nameemployee', 'users.lastname as lastnameemployee', 'type_gold.name')->leftJoin('customer', 'product_details.customer_id', '=', 'customer.id')->leftJoin('type_gold', 'product_details.type_gold_id', '=', 'type_gold.id')->leftJoin('users', 'product_details.user_id', '=', 'users.id')->where('type', 'ทองเก่า')->orderBy('created_at', "desc")->paginate(5);
        $customer = Customer::all();
        $users = User::all();
        return response()->json(['status' => true, 'id' => $group_id], 200);
        // return redirect('/buy')->with(['producttype' => $producttype, 'buy' => $buy, 'customer' => $customer, 'users' => $users]);
    }

    public function formBuy($id)
    {
        $form = FormBuy::select('formbuy.*', 'customer.name as namecustomer', 'customer.lastname as lastnamecustomer', 'customer.idcard as idcardcustomer', 'customer.address as addresscustomer', 'product_details.details as detail', 'product_details.gram as gram', 'product_details.allprice')
            ->leftJoin('customer', 'formbuy.customer_id', '=', 'customer.id')->leftJoin('product_details', 'formbuy.product_detail_id', '=', 'product_details.id')->where('group_id', $id)->get();
        // dd($form[0]);
        $customer = Customer::all();
        $productdetail = ProductDetails::all();
        $pdf = PDF::loadView('admin.buy.form', compact('form', 'productdetail', 'customer'));

        // return view('admin.sell.form');
        return $pdf->stream('formbuy.pdf');
    }
}
