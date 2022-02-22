<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\ProductDetails;
use App\Product;
use App\TypeGold;
use App\Striped;
use App\Sell;
use App\FormSell;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\File;

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        // dd($request->get('sellall'));
        $sellall = $request->get('sellall');
        $productdetail = ProductDetails::select("product_details.*", 'users.name as nameemployee', 'users.lastname as lastnameemployee', 'type_gold.name')->leftJoin('users', 'product_details.user_id', '=', 'users.id')->leftJoin('type_gold', 'product_details.type_gold_id', '=', 'type_gold.id')->orderBy('created_at', "desc")->where('status_trade', '0')->where('type', 'ทองใหม่');
        if (!empty($keyword)) {
            $productdetail = $productdetail->where('product_details.code', 'like', "%$keyword%")
                ->orWhere('product_details.details', 'like', "%$keyword%")
                ->orWhere('product_details.type_gold_id', 'like', "%$keyword%")
                ->orWhere('product_details.size', 'like', "%$keyword%")
                ->orWhere('product_details.user_id', 'like', "%$keyword%")
                ->orWhere('product_details.striped', 'like', "%$keyword%")
                ->orWhere('product_details.status_trade', 'like', "%$keyword%");
        }
        $filter_type = $request->get('filter_type');
        if (!empty($filter_type)) {
            $productdetail = $productdetail->where('product_details.type_gold_id', $filter_type);
        }
        $filter_size = $request->get('filter_size');
        if (!empty($filter_size)) {
            $productdetail = $productdetail->where('product_details.size', $filter_size);
        }
        $productdetail = $productdetail->paginate(5);
        $product = Product::all();
        $users = User::all();
        $producttype = TypeGold::all();
        $sellall_arr = explode(',', $sellall);

        return view('admin.sell.index', compact('product', 'productdetail', 'users', 'keyword', 'producttype', 'filter_type', 'filter_size', 'sellall', 'sellall_arr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sell.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productdetail = new ProductDetails(
            [
                'code' => $request->get('code'),
                'details' => $request->get('details'),
                'type_gold_id' => $request->get('type_gold_id'),
                'striped' => $request->get('striped'),
                'size' => $request->get('size'),
                'gram' => $request->get('gram'),
                'status' => $request->get('status'),
                'status_trade' => '0',
                'type' => $request->get('type'),
                'gratuity' => $request->get('gratuity'),
                'tray' => $request->get('tray'),
                'allprice' => $request->get('allprice'),
                'datetime' => $request->get('datetime'),
                'lot_id' => $request->get('lot_id'),
                'num' => $request->get('num'),
                'user_id' => $request->get('user_id'),
                'customer_id' => $request->get('customer_id'),
                'sellprice' => $request->get('sellprice'),
            ]
        );
        if ($request->hasFile('pic')) {
            $file = $request->file('pic');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('assets/img/gold', $filename);
            $productdetail->pic = $filename;
        }
        $productdetail->save();
        $productdetail = ProductDetails::select('*')->paginate(10);
        $product = Product::all();
        return view('admin.sell.index', compact('productdetail', 'product'));
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
        $productdetail = ProductDetails::select('product_details.*', 'products.price_of_gold')->join('products', 'product_details.lot_id', '=', 'products.lot_id')->where('product_details.id', $id)->first();
        $product = Product::all();
        $users = User::all();
        $customer = Customer::all();
        $producttype = TypeGold::all();
        return view('admin.sell.edit', compact('productdetail', 'product', 'customer', 'users', 'producttype', 'gold_type', 'id'));
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
        // dd($request);
        $productdetail = ProductDetails::find($id);
        $productdetail->code = $request->get('code');
        $productdetail->type_gold_id = $request->get('type_gold_id');
        $productdetail->status_trade = '1';
        $productdetail->size = $request->get('size');
        $productdetail->user_id = $request->get('user_id');
        $productdetail->customer_id = $request->get('customer_id');
        $productdetail->allprice = $request->get('allprice');
        $productdetail->gratuity = $request->get('gratuity');
        $productdetail->sellprice = $request->get('sellprice');
        $productdetail->datetime = $request->get('datetime');
        $productdetail->save();
        $productdetail = ProductDetails::select('*')->paginate(10);
        $product = Product::all();
        $customer = Customer::all();
        $users = User::all();
        return view('admin.sell.index', compact('productdetail', 'users', 'product', 'customer', 'id'));
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
        $productdetail = ProductDetails::select('*')->paginate(10);
        $product = Product::all();
        $customer = Customer::all();
        return view('admin.sell.index', compact('productdetail', 'customer', 'product'))->with('success', 'ลบข้อมูลเรียบร้อย');
    }
    public function sell_group($id)
    {
        $gold_type = ["ทองในถาด", "ทองในสต๊อค"];
        $productdetail = ProductDetails::select('*')->whereIn('id', explode(",", $id))->get();
        // dd($productdetail);
        $users = User::all();
        $customer = Customer::all();
        $producttype = TypeGold::all();
        $striped = Striped::all();

        return view('admin.sell.edit', compact('productdetail', 'customer', 'striped', 'users', 'producttype', 'gold_type', 'id'));
    }
    public function updateGroup(Request $request)
    {
        foreach ($request->id as $key => $value) {
            $productdetail = ProductDetails::find($request->id[$key]);
            $productdetail->code = $request->code[$key];
            $productdetail->type_gold_id = $request->type_gold_id[$key];
            $productdetail->status_trade = '1';
            $productdetail->size = $request->size[$key];
            $productdetail->user_id = $request->user_id;
            $productdetail->customer_id = $request->customer_id;
            $productdetail->allprice = $request->allprice[$key];
            $productdetail->sellprice = $request->sellprice[$key];
            $productdetail->datetime = $request->datetime;
            $productdetail->save();
        }
        $productdetail = ProductDetails::select('*')->paginate(10);
        $product = Product::all();
        $customer = Customer::all();
        $users = User::all();
        // $reportSmelter = ReportSmelter::select('group_id')->orderBy('group_id', "desc")->first();
        // if (!empty($reportSmelter)) {
        //     $group_id = $reportSmelter->group_id + 1;
        // } else {
        //     $group_id = 1;
        // }

        return response()->json(['status' => true], 200);
        // return response()->json(['status' => true, 'id' => $group_id], 200);

        // return redirect()->route('sell.index')->with(['productdetail' => $productdetail, 'product' => $product, 'customer' => $customer, 'users' => $users]);
        // return view('admin.sell.index', compact('productdetail', 'product', 'customer'));
    }

    public function formSell()
    {
        return view('admin.sell.form');
    }

    public function formSelltest()
    {
        return view('admin.sell.form');
    }
}
