<?php

namespace App\Http\Controllers;

use App\Manufacturer;
use App\Product;
use App\ProductDetails;
use App\TypeGold;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $product = Product::select("*");
        if (!empty($keyword)) {
            $product = $product->where('products.lot_id', 'like', "%$keyword%")
                ->orWhere('products.lot_count', 'like', "%$keyword%")
                ->orWhere('products.date_of_import', 'like', "%$keyword%")
                ->orWhere('products.price_of_gold', 'like', "%$keyword%");
        }
        $product = $product->paginate(5);
        $type = TypeGold::all();
        return view('admin.product.index', compact('product', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = Product::select('products.*', 'type_gold.category', 'manufacturers.code')->join('type_gold', 'products.type_gold_id', '=', 'type_gold.id')->join('manufacturers', 'products.manufacturer', '=', 'manufacturers.code')->get();
        $type = TypeGold::all();
        $manufacturer = Manufacturer::all();
        return view('admin.product.create-product', compact('product', 'type', 'manufacturer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type = TypeGold::select('category')->where('id', $request->get('type_gold_id'))->first();
        // dd($type);
        // dd(Carbon::parse($request->get('date_of_import'))->format("Ymd"));
        $date = Carbon::parse($request->get('date_of_import'))->format('Ymd');
        $weight = $request->get('weight');
        $lot_id = $type->category . $date . $weight;
        $product = new Product(
            [
                'lot_id' => "$lot_id",
                'weight' => $request->get('weight'),
                'lot_count' => $request->get('lot_count'),
                'date_of_import' => $request->get('date_of_import'),
                'price_of_gold' => $request->get('price_of_gold'),
                'type_gold_id' => $request->get('type_gold_id'),
                'manufacturer' => $request->get('manufacturer'),
            ]
        );
        $product->save();
        $product = Product::select('*')->paginate(5);
        return view('admin.product.index', compact('product'));
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
        // $product = Product::find($id);
        $product = Product::select('products.*', 'type_gold.category', 'manufacturers.code')->join('type_gold', 'products.type_gold_id', '=', 'type_gold.id')->join('manufacturers', 'products.manufacturer', '=', 'manufacturers.id')->find($id);
        $type = TypeGold::all();
        $manufacturer = Manufacturer::all();
        return view('admin.product.edit', compact('product', 'type', 'manufacturer', 'id'));
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
        $product = Product::find($id);
        $product->lot_id = $request->get('lot_id');
        $product->lot_count = $request->get('lot_count');
        $product->date_of_import = $request->get('date_of_import');
        $product->price_of_gold = $request->get('price_of_gold');
        $product->manufacturer = $request->get('manufacturer');
        $product->save();
        $product = Product::all();
        return redirect('/product')->with('product', $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response    
     */
    public function destroy($id,Request $request)
    {
        // dd($request);
        $productdetail = ProductDetails::where('lot_id', $request->lot_id )->first();
        if (!empty($productdetail)) {
            return response()->json(['status' => false], 200);
        }
        $product = Product::find($id);
        $product->delete();
        return response()->json(['status' => true], 200);
    }
}
