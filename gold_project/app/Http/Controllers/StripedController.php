<?php

namespace App\Http\Controllers;

use App\Striped;
use Illuminate\Http\Request;

class StripedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $striped = Striped::select("*");
        if (!empty($keyword)) {
            $striped = $striped->where('striped.name', 'like', "%$keyword%");
        }
        $striped = $striped->paginate(5);
        return view('admin.striped.index', compact('striped'));
        // return view('admin.striped.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $striped = Striped::all();
        return view('admin.striped.create', compact('striped'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $striped = new Striped(
            [
                'name' => $request->get('name'),
            ]
        );
        $striped->save();
        $striped = Striped::select('*')->paginate(5);
        return view('admin.striped.index', compact('striped'));
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
        $striped = Striped::find($id);
        // $stores = Stores::all()->toArray(); 
        return view('admin.striped.edit', compact('striped', 'id'));
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
        $striped = Striped::find($id);
        $striped->name = $request->get('name');
        $striped->save();
        $striped = Striped::select('*')->paginate(5);
        // return view('admin.type_gold.index', compact('type', 'id'));
        return redirect('/striped')->with('striped', $striped);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $striped = Striped::find($id);
        $striped->delete();
        $striped = Striped::select('*')->paginate(5);
        return response()->json(['status' => true], 200);
    }
}
