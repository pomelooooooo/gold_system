<?php

namespace App\Http\Controllers;

use App\TypeGold;
use Illuminate\Http\Request;

class TypeGoldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = TypeGold::all();
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
        $type = TypeGold::all();
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
        $type = TypeGold::all();
        return view('admin.type_gold.index', compact('type', 'id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = TypeGold::find($id);
        $type->delete();
        $type = TypeGold::all();
        return view('admin.type_gold.index', compact('type'))->with('success', 'ลบข้อมูลเรียบร้อย');
    }
}
