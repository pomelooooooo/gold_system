<?php

namespace App\Http\Controllers;

use App\ProductDetails;
use App\Product;
use App\TypeGold;
use Illuminate\Http\Request;
use Carbon\Carbon;
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
        $buy = ProductDetails::select("*");
        if(!empty($keyword)){
            $buy = $buy->where('product_details.code', 'like', "%$keyword%")
            ->orWhere('product_details.details', 'like', "%$keyword%")
            ->orWhere('product_details.category', 'like', "%$keyword%")
            ->orWhere('product_details.size', 'like', "%$keyword%")
            ->orWhere('product_details.lot_id', 'like', "%$keyword%");
        }
        $buy = $buy->paginate(5);
        // dd($buy);
        $product = Product::all();
        // dd($buy);
        return view('admin.buy.index', compact('product','buy','keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gold_type = ["ทองในถาด","ทองในสต๊อค"];
        $buy = ProductDetails::select('code')->orderBy('code',"desc")->first();
        if(!empty($buy)){
            $code = $buy->code+1;
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
        $buy = ProductDetails::select('product_details.*', 'products.lot_id')->join('products', 'product_details.lot_id', '=', 'products.lot_id')->get();
        $product = Product::all();
        return view('admin.buy.create-buy', compact('product','buy','gold_type','code'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $buy = new ProductDetails(
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
            $buy->pic = $filename;
        }
        $buy->save();
        $buy = ProductDetails::select('*')->paginate(5);
        $product = Product::all();
        // $productdetail = ProductDetails::all();
        // dd($productdescript[0]->code);
        // $managegold = Managegold::all()->toArray();
        return view('admin.buy.index', compact('buy','product'));
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
        $buy = ProductDetails::find($id);
        // $productdetail = ProductDetails::select('*')->get();
        $product = Product::all();
        // dd($gold_type);
        return view('admin.buy.edit', compact('buy','product','gold_type', 'id'));
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
        $buy->category = $request->get('category');
        $buy->striped = $request->get('striped');
        $buy->size = $request->get('size');
        $buy->gram = $request->get('gram');
        $buy->status = $request->get('status');
        $buy->type = $request->get('type');
        $buy->gratuity = $request->get('gratuity');
        $buy->tray = $request->get('tray');
        $buy->allprice = $request->get('allprice');
        $buy->lot_id = $request->get('lot_id');

        // $managegold->pic = $request->get('pic');
        if($request->hasFile('pic')){
            $destination = 'assets/img/gold'.$buy->pic;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file = $request->file('pic');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('assets/img/gold', $filename);
            $buy->pic = $filename;
        }
        $buy->save();
        $buy = ProductDetails::select('*')->paginate(5);
        $product = Product::all();
        return view('admin.buy.index', compact('buy','product', 'id'));
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
        $buy = ProductDetails::select('*')->paginate(5);
        $product = Product::all();
        return view('admin.buy.index', compact('buy','product'))->with('success', 'ลบข้อมูลเรียบร้อย');
    }
}
