<?php

namespace App\Http\Controllers;

use App\Managegold;
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
        $managegold = Managegold::all()->toArray();
        return view('admin.set_price.index', compact('managegold'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.set_price.set-price');
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
                'striped' => $request->get('striped'),
                'bath' => $request->get('bath'),
                'salung' => $request->get('salung'),
                'gram' => $request->get('gram'),
                'status' => $request->get('status'),
                'date_of_import' => $request->get('date_of_import'),
                'price_of_gold' => $request->get('price_of_gold'),
                'gratuity' => $request->get('gratuity'),
                'tray' => $request->get('tray'),
                'allprice' => $request->get('allprice'),
                // 'pic' => $request->file('pic'),
            ]
        );
        if ($request->hasFile('pic')) {
            $file = $request->file('pic');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('assets/img/gold', $filename);
            $managegold->pic = $filename;
        }
        // $image = $request->file('pic');
        // $new_name = rand() .'.'. $image->getClientOriginalExtension();
        // $image -> move(public_path('assets/img/gold'),$new_name);
        // dd($managegold);
        $managegold->save();
        $managegold = Managegold::all()->toArray();
        return view('admin.set_price.index', compact('managegold'));
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
        return view('admin.set_price.edit', compact('managegold', 'id'));
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
        $managegold->striped = $request->get('striped');
        $managegold->bath = $request->get('bath');
        $managegold->salung = $request->get('salung');
        $managegold->gram = $request->get('gram');
        $managegold->status = $request->get('status');
        $managegold->date_of_import = $request->get('date_of_import');
        $managegold->price_of_gold = $request->get('price_of_gold');
        $managegold->gratuity = $request->get('gratuity');
        $managegold->tray = $request->get('tray');
        $managegold->allprice = $request->get('allprice');
        // $managegold->pic = $request->get('pic');
        if ($request->hasFile('pic')) {
            $destination = 'assets/img/gold' . $managegold->pic;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('pic');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('assets/img/gold', $filename);
            $managegold->pic = $filename;
        }
        $managegold->save();
        $managegold = Managegold::all()->toArray();
        return view('admin.set_price.index', compact('managegold', 'id'));
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
        return view('admin.set_price.index', compact('managegold'))->with('success', 'ลบข้อมูลเรียบร้อย');
    }
}
