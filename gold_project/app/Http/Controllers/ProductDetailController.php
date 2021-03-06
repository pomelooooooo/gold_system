<?php

namespace App\Http\Controllers;

use App\ProductDetails;
use App\Product;
use App\TypeGold;
use App\Striped;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class ProductDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $productdetail = ProductDetails::select('product_details.*', 'type_gold.name as typegoldname','stripeds.name as stripedname')->leftJoin('type_gold', 'product_details.type_gold_id', '=', 'type_gold.id')->leftJoin('stripeds', 'product_details.striped_id', '=', 'stripeds.id')->where('type', 'ทองใหม่')->where('status_trade', '0')->orderBy('created_at', "desc");
        if (!empty($keyword)) {
            $productdetail = $productdetail->where('product_details.code', 'like', "%$keyword%")
                ->orWhere('product_details.details', 'like', "%$keyword%")
                ->orWhere('product_details.type_gold_id', 'like', "%$keyword%")
                ->orWhere('product_details.size', 'like', "%$keyword%")
                ->orWhere('product_details.lot_id', 'like', "%$keyword%");
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
        // dd($productdetail);
        $producttype = TypeGold::all();
        $product = Product::all();
        // dd($productdetail);
        return view('admin.productdetail.index', compact('product', 'productdetail', 'keyword', 'filter_type', 'filter_size', 'producttype'));
        // return redirect('/productdetail')->with(['productdetail' => $productdetail, 'product' => $product , 'keyword' => $keyword]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gold_type = ["ทองในถาด", "ทองในสต๊อค"];
        $productdetail = ProductDetails::select('code')->where('code', 'LIKE', 'N%')->orderBy('code', "desc")->first();
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
        $code = "N" . $code;
        $product = Product::all();
        $producttype = TypeGold::all();
        $striped = Striped::all();
        return view('admin.productdetail.create-productdetail', compact('product', 'gold_type', 'striped', 'code', 'producttype'));
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
                    'code' => $value,
                    'details' => $request->details[$key],
                    'type_gold_id' => $request->type_gold_id[$key],
                    'striped_id' => $request->striped_id[$key],
                    'size' => $request->size[$key],
                    'gram' => $request->gram[$key],
                    'status' => $request->status[$key],
                    'status_trade' => '0',
                    'type' => 'ทองใหม่',
                    'gratuity' => $request->gratuity[$key],
                    'tray' => $request->tray[$key],
                    'allprice' => $request->allprice[$key],
                    'lot_id' => $request->lot_id[$key],
                ]
            );
            if ($request->hasFile('pic.' . $key)) {
                $file = $request->file('pic')[$key];
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('assets/img/gold', $filename);
                $productdetail->pic = $filename;
            }
            $productdetail->save();
        }

        $productdetail = ProductDetails::select('product_details.*', 'type_gold.name')->leftJoin('type_gold', 'product_details.type_gold_id', '=', 'type_gold.id')->where('type', 'ทองใหม่')->orderBy('created_at', "desc")->paginate(10);
        $product = Product::all();
        $producttype = TypeGold::all();

        return redirect('/productdetail')->with(['productdetail' => $productdetail, 'product' => $product]);
        // return view('admin.productdetail.index', compact('productdetail', 'product', 'producttype'));

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
        $producttype = TypeGold::all();
        $striped = Striped::all();
        return view('admin.productdetail.edit', compact('productdetail', 'product', 'producttype', 'striped', 'gold_type', 'id'));
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
        $productdetail->type_gold_id = $request->get('type_gold_id');
        $productdetail->striped_id = $request->get('striped_id');
        $productdetail->size = $request->get('size');
        $productdetail->gram = $request->get('gram');
        $productdetail->status = $request->get('status');
        $productdetail->status_trade = '0';
        $productdetail->type = 'ทองใหม่';
        $productdetail->gratuity = $request->get('gratuity');
        $productdetail->tray = $request->get('tray');
        $productdetail->allprice = $request->get('allprice');
        $productdetail->lot_id = $request->get('lot_id');

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
        $productdetail = ProductDetails::select('*')->paginate(10);
        $product = Product::all();
        // return view('admin.productdetail.index', compact('productdetail', 'product', 'id'));
        return redirect('/productdetail')->with(['productdetail' => $productdetail, 'product' => $product]);
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
        return response()->json(['status' => true], 200);
    }

    public function getprice_of_gold($lot)
    {
        $product = Product::select('price_of_gold', 'type_gold.id', 'weight')->join('type_gold', 'type_gold.id', '=', 'products.type_gold_id')->where('products.lot_id', $lot)->first();
        return response()->json(["product" => $product]);
    }
}
