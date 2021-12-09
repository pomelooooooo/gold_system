<?php

namespace App\Http\Controllers;

use App\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $manufacturer = Manufacturer::all();
        return view('admin.manufacturer.index', compact('manufacturer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $manufacturer = Manufacturer::all();
        return view('admin.manufacturer.create', compact('manufacturer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $manufacturer = new Manufacturer(
            [
                'code' => $request->get('code'),
                'name' => $request->get('name'),
                'tel' => $request->get('tel'),
                'address' => $request->get('address'),
            ]
        );
        $manufacturer->save();
        $manufacturer = Manufacturer::all();
        return view('admin.manufacturer.index', compact('manufacturer'));
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
        $manufacturer = Manufacturer::find($id);
        return view('admin.manufacturer.edit', compact('manufacturer', 'id'));
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
        $manufacturer = Manufacturer::find($id);
        $manufacturer->code = $request->get('code');
        $manufacturer->name = $request->get('name');
        $manufacturer->tel = $request->get('tel');
        $manufacturer->address = $request->get('address');
        $manufacturer->save();
        $manufacturer = Manufacturer::all();
        return view('admin.manufacturer.index', compact('manufacturer', 'id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manufacturer = Manufacturer::find($id);
        $manufacturer->delete();
        $manufacturer = Manufacturer::all();
        return view('admin.manufacturer.index', compact('manufacturer'))->with('success', 'ลบข้อมูลเรียบร้อย');
    }
}