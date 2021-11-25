<?php

namespace App\Http\Controllers;

use App\Product;
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
    public function index()
    {
        $product = Product::select('products.*', 'type_gold.category')->join('type_gold', 'products.type_gold_id', '=', 'type_gold.id')->get();
        // $product = $product->paginate(10);
        $type = TypeGold::all();
        return view('admin.product.index', compact('product','type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = Product::select('products.*', 'type_gold.category')->join('type_gold', 'products.type_gold_id', '=', 'type_gold.id')->get();
        $type = TypeGold::all();
        return view('admin.product.create-product', compact('product','type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type = TypeGold::select('category')->where('id',$request->get('type_gold_id'))->first();
        // dd($type);
        // dd(Carbon::parse($request->get('date_of_import'))->format("Ymd"));
        $date = Carbon::parse($request->get('date_of_import'))->format('Ymd');
        $weight = $request->get('weight');
        $lot_id = $type->category.$date.$weight;
        $product = new Product(
            [
                'lot_id' => "$lot_id",
                'weight' => $request->get('weight'),
                'lot_count' => $request->get('lot_count'),
                'date_of_import' => $request->get('date_of_import'),
                'price_of_gold' => $request->get('price_of_gold'),
                'type_gold_id' => $request->get('type_gold_id'),
                'wage' => $request->get('wage'),
            ]
        );
        $product->save();
        $product = Product::select('products.*', 'type_gold.category')->join('type_gold', 'products.type_gold_id', '=', 'type_gold.id')->get();
        $type = TypeGold::all();
        return view('admin.product.index',compact('product','type'));
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
        $product = Product::select('products.*', 'type_gold.category')->join('type_gold', 'products.type_gold_id', '=', 'type_gold.id')->find($id);
        $type = TypeGold::all();
        return view('admin.product.edit', compact('product','type', 'id'));
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
        // $product->weight = $request->get('weight');
        $product->lot_count = $request->get('lot_count');
        $product->date_of_import = $request->get('date_of_import');
        $product->price_of_gold = $request->get('price_of_gold');
        // $product->type_gold_id = $request->get('type_gold_id');
        $product->wage = $request->get('wage');
        $product->save();
        $product = Product::select('products.*', 'type_gold.category')->join('type_gold', 'products.type_gold_id', '=', 'type_gold.id')->get();
        $type = TypeGold::all();
        return view('admin.product.index', compact('product','type', 'id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        $product = Product::select('products.*', 'type_gold.category')->join('type_gold', 'products.type_gold_id', '=', 'type_gold.id')->get();
        $type = TypeGold::all();
        return view('admin.product.index', compact('product','type'))->with('success', 'ลบข้อมูลเรียบร้อย');
    }

}