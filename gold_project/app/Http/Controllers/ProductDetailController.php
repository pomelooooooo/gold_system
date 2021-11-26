<?php

namespace App\Http\Controllers;

use App\ProductDetails;
use App\Product;
use App\TypeGold;
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
        $productdetail = ProductDetails::select("*");
        if(!empty($keyword)){
            $productdetail = $productdetail->where('product_details.code', 'like', "%$keyword%")
            ->orWhere('product_details.details', 'like', "%$keyword%")
            ->orWhere('product_details.category', 'like', "%$keyword%")
            ->orWhere('product_details.size', 'like', "%$keyword%")
            ->orWhere('product_details.lot_id', 'like', "%$keyword%");
        }
        $productdetail = $productdetail->paginate(5);
        // dd($productdetail);
        $product = Product::all();
        // dd($productdetail);
        return view('admin.productdetail.index', compact('product','productdetail','keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gold_type = ["ทองในถาด","ทองในสต๊อค"];
        $productdetail = ProductDetails::select('code')->orderBy('code',"desc")->first();
        if(!empty($productdetail)){
            $code = $productdetail->code+1;
            $num = "0";
            for($i = strlen($code);$i < 4;$i++){
                $num .= "0";
            }
            $code = $num.$code;
            // dd($num.$code);
        }else{
            $code ="0001";
        }
        // dd($gold_type);
        $productdetail = ProductDetails::select('product_details.*', 'products.lot_id')->join('products', 'product_details.lot_id', '=', 'products.lot_id')->get();
        $product = Product::all();
        return view('admin.productdetail.create-productdetail', compact('product','productdetail','gold_type','code'));
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
                'num' => $request->get('num'),
            ]
        );
        if($request->hasFile('pic')){
            $file = $request->file('pic');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('assets/img/gold', $filename);
            $productdetail->pic = $filename;
        }
        $productdetail->save();
        $productdetail = ProductDetails::select('*')->paginate(5);
        $product = Product::all();
        // $productdetail = ProductDetails::all();
        // dd($productdescript[0]->code);
        // $managegold = Managegold::all()->toArray();
        return view('admin.productdetail.index', compact('productdetail','product'));
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
        $gold_type = ["ทองในถาด","ทองในสต๊อค"];
        $productdetail = ProductDetails::find($id);
        // $productdetail = ProductDetails::select('*')->get();
        $product = Product::all();
        // dd($gold_type);
        return view('admin.productdetail.edit', compact('productdetail','product','gold_type', 'id'));
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
        if($request->hasFile('pic')){
            $destination = 'assets/img/gold'.$productdetail->pic;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file = $request->file('pic');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('assets/img/gold', $filename);
            $productdetail->pic = $filename;
        }
        $productdetail->save();
        $productdetail = ProductDetails::select('*')->paginate(5);
        $product = Product::all();
        return view('admin.productdetail.index', compact('productdetail','product', 'id'));
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
        return view('admin.productdetail.index', compact('productdetail','product'))->with('success', 'ลบข้อมูลเรียบร้อย');
    }
}
