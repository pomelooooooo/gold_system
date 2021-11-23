<?php

namespace App\Http\Controllers;

use App\ProductDetails;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class SetPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productdetail = ProductDetails::select('product_details.*', 'products.lot_id')->join('products', 'product_details.lot_id', '=', 'products.lot_id')->get();
        $product = Product::all();
        return view('admin.set_price.index', compact('product', 'productdetail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productdetail = ProductDetails::select('product_details.*', 'products.lot_id')->join('products', 'product_details.lot_id', '=', 'products.lot_id')->get();
        $product = Product::all();
        return view('admin.set_price.edit', compact('product', 'productdetail'));
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
                'category' => $request->get('category'),
                'striped' => $request->get('striped'),
                'size' => $request->get('size'),
                'gram' => $request->get('gram'),
                'status' => $request->get('status'),
                'type' => $request->get('type'),
                'gratuity' => $request->get('gratuity'),
                'tray' => $request->get('tray'),
                'allprice' => $request->get('allprice'),
                'lot_id' => $request->get('lot_id'),
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
        $productdescript = ProductDetails::select('product_details.*', 'products.lot_id')->join('products', 'product_details.lot_id', '=', 'products.lot_id')->get();
        $product = Product::all();
        // $managegold = Managegold::all()->toArray();
        return view('admin.set_price.index', compact('productdescript', 'product'));
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
        $productdetail = ProductDetails::find($id);
        $productdescript = ProductDetails::select('product_details.*', 'products.lot_id')->join('products', 'product_details.lot_id', '=', 'products.lot_id')->get();
        $product = Product::all();
        return view('admin.set_price.edit', compact('productdetail', 'productdescript', 'product', 'id'));
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
        $productdetail->category = $request->get('category');
        $productdetail->striped = $request->get('striped');
        $productdetail->size = $request->get('size');
        $productdetail->gram = $request->get('gram');
        $productdetail->status = $request->get('status');
        $productdetail->type = $request->get('type');
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
        $productdetail = ProductDetails::select('product_details.*', 'products.lot_id')->join('products', 'product_details.lot_id', '=', 'products.lot_id')->get();
        $product = Product::all();
        return view('admin.set_price.index', compact('productdetail', 'product', 'id'));
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
        $productdetail = ProductDetails::select('product_details.*', 'products.lot_id')->join('products', 'product_details.lot_id', '=', 'products.lot_id')->get();
        $product = Product::all();
        return view('admin.set_price.index', compact('productdetail', 'product'))->with('success', 'ลบข้อมูลเรียบร้อย');
    }
}
