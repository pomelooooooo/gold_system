<?php

namespace App\Http\Controllers;

use App\Manufacturer;
use App\Product;
use Illuminate\Http\Request;
use PharIo\Manifest\Manifest;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $manufacturer = Manufacturer::select("*");
        if (!empty($keyword)) {
            $manufacturer = $manufacturer->where('manufacturers.code', 'like', "%$keyword%")
                ->orWhere('manufacturers.name', 'like', "%$keyword%")
                ->orWhere('manufacturers.address', 'like', "%$keyword%")
                ->orWhere('manufacturers.tel', 'like', "%$keyword%")
                ->orWhere('manufacturers.tax', 'like', "%$keyword%");
        }
        $manufacturer = $manufacturer->paginate(8);
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
                'tax' => $request->get('tax'),
            ]
        );
        $manufacturer->save();
        $manufacturer = Manufacturer::select('*')->paginate(5);
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
        $manufacturer->tax = $request->get('tax');
        $manufacturer->save();
        $manufacturer = Manufacturer::select('*')->paginate(5);
        // return view('admin.manufacturer.index', compact('manufacturer', 'id'));
        return redirect('/manufacturer')->with('manufacturer', $manufacturer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where('manufacturer', $id)->first();
        if (!empty($product)) {
            return response()->json(['status' => false], 200);
        }
        $manufacturer = Manufacturer::find($id);
        $manufacturer->delete();
        $manufacturer = Manufacturer::select('*')->paginate(5);
        return response()->json(['status' => true], 200);
    }

    public function validateCode($code, $id = '')
    {
        if (!empty($id)) {
            $managemanufactor = Manufacturer::where('code', $code)->where('id', '!=', $id)->first();
        } else {
            $managemanufactor = Manufacturer::where('code', $code)->first();
        }
        if (!empty($managemanufactor))
            return response()->json(['status' => false], 200);

        return response()->json(['status' => true], 200);
    }

    public function validateName($name, $id = '')
    {
        if (!empty($id)) {
            $managemanufactor = Manufacturer::where('name', $name)->where('id', '!=', $id)->first();
        } else {
            $managemanufactor = Manufacturer::where('name', $name)->first();
        }
        if (!empty($managemanufactor))
            return response()->json(['status' => false], 200);

        return response()->json(['status' => true], 200);
    }
}
