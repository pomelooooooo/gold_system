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
        $productdetail = ProductDetails::select('product_details.*', 'type_gold.name')->leftJoin('type_gold', 'product_details.type_gold_id', '=', 'type_gold.id')->where('type', 'ทองใหม่');
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
        $productdetail = $productdetail->paginate(5);
        // dd($productdetail);
        $producttype = TypeGold::all();
        $product = Product::all();
        // dd($productdetail);
        return view('admin.productdetail.index', compact('product', 'productdetail', 'keyword','filter_type','filter_size','producttype'));
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
        $productdetail = ProductDetails::select('code')->orderBy('code', "desc")->first();
        if (!empty($productdetail)) {
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
        $productdetail = new ProductDetails(
            [
                'code' => $request->get('code'),
                'details' => $request->get('details'),
                'type_gold_id' => $request->get('type_gold_id'),
                'striped_id' => $request->get('striped_id'),
                'size' => $request->get('size'),
                'gram' => $request->get('gram'),
                'status' => $request->get('status'),
                'status_trade' => '0',
                'type' => 'ทองใหม่',
                'gratuity' => $request->get('gratuity'),
                'tray' => $request->get('tray'),
                'allprice' => $request->get('allprice'),
                'datetime' => $request->get('datetime'),
                'lot_id' => $request->get('lot_id'),
                'num' => $request->get('num'),
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
        return view('admin.productdetail.index', compact('productdetail', 'product'));
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
        $productdetail = ProductDetails::select('*')->paginate(5);
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
        $productdetail = ProductDetails::select('*')->paginate(5);
        $product = Product::all();
        return view('admin.productdetail.index', compact('productdetail', 'product'))->with('success', 'ลบข้อมูลเรียบร้อย');
    }

    public function getprice_of_gold($lot)
    {
        $product = Product::select('price_of_gold', 'type_gold.id', 'weight')->join('type_gold', 'type_gold.id', '=', 'products.type_gold_id')->where('products.lot_id', $lot)->first();
        return response()->json(["product" => $product]);
    }
}
