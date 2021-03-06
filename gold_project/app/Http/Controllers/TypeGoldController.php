<?php

namespace App\Http\Controllers;

use App\TypeGold;
use App\Product;
use App\ProductDetails;
use Illuminate\Http\Request;

class TypeGoldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $type = TypeGold::select("*");
        if (!empty($keyword)) {
            $type = $type->where('type_gold.category', 'like', "%$keyword%")
                ->orWhere('type_gold.name', 'like', "%$keyword%");
        }
        $type = $type->paginate(5);
        return view('admin.type_gold.index', compact('type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = TypeGold::all();
        return view('admin.type_gold.create-type', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type = new TypeGold(
            [
                'category' => $request->get('category'),
                'name' => $request->get('name'),
            ]
        );
        $type->save();
        $type = TypeGold::select('*')->paginate(5);
        return view('admin.type_gold.index', compact('type'));
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
        $type = TypeGold::find($id);
        // $stores = Stores::all()->toArray(); 
        return view('admin.type_gold.edit', compact('type', 'id'));
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
        $type = TypeGold::find($id);
        $type->category = $request->get('category');
        $type->name = $request->get('name');
        $type->save();
        $type = TypeGold::select('*')->paginate(5);
        // return view('admin.type_gold.index', compact('type', 'id'));
        return redirect('/type_gold')->with('type' , $type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where('type_gold_id', $id)->first();
        if (!empty($product)) {
            return response()->json(['status' => false], 200);
        }
        $productdetail = ProductDetails::where('type_gold_id', $id)->first();
        if (!empty($productdetail)) {
            return response()->json(['status' => false], 200);
        }
        $type = TypeGold::find($id);
        $type->delete();
        $type = TypeGold::select('*')->paginate(5);
        return response()->json(['status' => true], 200);
    }

    public function validateCategory($category, $id = '')
    {
        if (!empty($id)) {
            $managetypegold = TypeGold::where('category', $category)->where('id', '!=', $id)->first();
        } else {
            $managetypegold = TypeGold::where('category', $category)->first();
        }
        if (!empty($managetypegold))
            return response()->json(['status' => false], 200);

        return response()->json(['status' => true], 200);
    }

    public function validateName($name, $id = '')
    {
        if (!empty($id)) {
            $managetypegold = TypeGold::where('name', $name)->where('id', '!=', $id)->first();
        } else {
            $managetypegold = TypeGold::where('name', $name)->first();
        }
        if (!empty($managetypegold))
            return response()->json(['status' => false], 200);

        return response()->json(['status' => true], 200);
    }
}
