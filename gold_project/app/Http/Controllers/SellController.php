<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\ProductDetails;
use App\Product;
use App\TypeGold;
use App\Sell;
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
        $productdetail = ProductDetails::select("*");
        if (!empty($keyword)) {
            $productdetail = $productdetail->where('product_details.code', 'like', "%$keyword%")
                ->orWhere('product_details.details', 'like', "%$keyword%")
                ->orWhere('product_details.type_gold_id', 'like', "%$keyword%")
                ->orWhere('product_details.size', 'like', "%$keyword%")
                ->orWhere('product_details.lot_id', 'like', "%$keyword%");
        }
        $productdetail = $productdetail->paginate(5);
        // dd($productdetail);
        $product = Product::all();
        $users = User::all();
        // dd($productdetail);
        return view('admin.sell.index', compact('product', 'productdetail','users', 'keyword'));
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
        $productdetail = ProductDetails::select('*')->paginate(5);
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
        return view('admin.sell.edit', compact('productdetail', 'product','customer','users','producttype', 'gold_type', 'id'));
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
        $productdetail->type_gold_id = $request->get('type_gold_id');
        $productdetail->status_trade = '1';
        $productdetail->size = $request->get('size');
        $productdetail->user_id = $request->get('user_id');
        $productdetail->customer_id = $request->get('customer_id');
        $productdetail->allprice = $request->get('allprice');
        $productdetail->gratuity = $request->get('gratuity');
        $productdetail->sellprice = $request->get('sellprice');
        $productdetail->datetime = $request->get('datetime');

        // $managegold->pic = $request->get('pic');
        if ($request->hasFile('pic')) {
            $destination = 'assets/img/gold' . $productdetail->pic;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('pic');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('assets/img/gold', $filename);
            $productdetail->pic = $filename;
        }
        $productdetail->save();
        $productdetail = ProductDetails::select('*')->paginate(5);
        $product = Product::all();
        $customer = Customer::all();
        return view('admin.sell.index', compact('productdetail', 'product','customer', 'id'));
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
        $productdetail = ProductDetails::select('*')->paginate(5);
        $product = Product::all();
        $customer = Customer::all();
        return view('admin.sell.index', compact('productdetail','customer', 'product'))->with('success', 'ลบข้อมูลเรียบร้อย');
    }
}
