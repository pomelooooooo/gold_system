<?php

namespace App\Http\Controllers;

use App\Managegold;
use Illuminate\Http\Request;

class ManagegoldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $managegold = Managegold::all()->toArray();
        return view('admin.managegold.index', compact('managegold'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.managegold.create-gold');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $managegold = new Managegold(
            [
                'code' => $request->get('code'),
                'details' => $request->get('details'),
                'unit' => $request->get('unit'),
                'weight' => $request->get('weight'),
                'price' => $request->get('price'),
                'gratuity' => $request->get('gratuity'),
                'allprice' => $request->get('allprice'),
                'pic' => $request->get('pic'),
            ]
        );
        $managegold->save();
        $managegold = Managegold::all()->toArray();
        return view('admin.managegold.index', compact('managegold'));
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
        $managegold = Managegold::find($id);
        return view('admin.managegold.edit', compact('managegold', 'id'));
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
        $managegold = Managegold::find($id);
        $managegold->code = $request->get('code');
        $managegold->details = $request->get('details');
        $managegold->unit = $request->get('unit');
        $managegold->weight = $request->get('weight');
        $managegold->price = $request->get('price');
        $managegold->gratuity = $request->get('gratuity');
        $managegold->allprice = $request->get('allprice');
        $managegold->pic = $request->get('pic');
        $managegold->save();
        $managegold = Managegold::all()->toArray();
        return view('admin.managegold.index', compact('managegold', 'id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $managegold = Managegold::find($id);
        $managegold->delete();
        $managegold = Managegold::all();
        return view('admin.managegold.index', compact('managegold'))->with('success', 'ลบข้อมูลเรียบร้อย');
    }
}
