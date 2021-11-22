<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
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
        $product = Product::all()->toArray();
        return view('admin.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create-product');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product(
            [
                'lot_id' => $request->get('lot_id'),
                'lot_count' => $request->get('lot_count'),
                'date_of_import' => $request->get('date_of_import'),
                'price_of_gold' => $request->get('price_of_gold'),
                'wage' => $request->get('wage'),
            ]
        );
        $product->save();
        $product = Product::all()->toArray();
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
        $product = Product::find($id);
        return view('admin.product.edit', compact('product', 'id'));
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
        $product->wage = $request->get('wage');
        $product->save();
        $product = Product::all()->toArray();
        return view('admin.product.index', compact('product', 'id'));
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
        $product = Product::all();
        return view('admin.product.index', compact('product'))->with('success', 'ลบข้อมูลเรียบร้อย');
    }

}
