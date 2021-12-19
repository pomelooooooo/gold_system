<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ManageCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $managecustomer = Customer::select("*");
        if (!empty($keyword)) {
            $managecustomer = $managecustomer->where('customer.name', 'like', "%$keyword%")
                ->orWhere('customer.lastname', 'like', "%$keyword%")
                ->orWhere('customer.idcard', 'like', "%$keyword%")
                ->orWhere('customer.tel', 'like', "%$keyword%");
        }
        $managecustomer = $managecustomer->paginate(5);
        return view('admin.manage_customer.index', compact('managecustomer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manage_customer.create-customer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $managecustomer = new Customer(
            [
                'name' => $request->name,
                'lastname' => $request->lastname,
                'idcard' => $request->idcard,
                'address' => $request->address,
                'address_now' => $request->address_now,
                'tel' => $request->tel,
                'date_card_start' => $request->date_card_start,
                'date_card_end' => $request->date_card_end,
            ]
        );
        $picture = json_decode($request->data)->picture;
        if ($picture) {
            $img = $picture;
            $folderPath = "assets/img/customer/"; //path location
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $uniqid = $request->idcard;
            $file = $folderPath . $uniqid . '.' . $image_type;
            file_put_contents($file, $image_base64);
            $managecustomer->picture = $uniqid . '.' . $image_type;
        }
        $managecustomer->save();
        $managecustomer = Customer::select('*')->paginate(5);
        return view('admin.manage_customer.index', compact('managecustomer'));
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
        $managecustomer = Customer::find($id);
        return view('admin.manage_customer.edit', compact('managecustomer', 'id'));
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
        $managecustomer = Customer::find($id);
        $managecustomer->name = $request->get('name');
        $managecustomer->lastname = $request->get('lastname');
        $managecustomer->idcard = $request->get('idcard');
        $managecustomer->address = $request->get('address');
        $managecustomer->address_now = $request->get('address_now');
        $managecustomer->tel = $request->get('tel');
        $managecustomer->date_card_start = $request->get('date_card_start');
        $managecustomer->date_card_end = $request->get('date_card_end');
        if ($request->hasFile('picture')) {
            $destination = 'assets/img/customer' . $managecustomer->picture;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('picture');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('assets/img/customer', $filename);
            $managecustomer->picture = $filename;
        }
        $managecustomer->save();
        $managecustomer = Customer::select('*')->paginate(5);
        // return view('admin.manage_customer.index', compact('managecustomer', 'id'));
        return redirect('/manage_customer')->with('managecustomer' , $managecustomer);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $managecustomer = Customer::find($id);
        $managecustomer->delete();
        $managecustomer = Customer::select('*')->paginate(5);
        return view('admin.manage_customer.index', compact('managecustomer'))->with('success', 'ลบข้อมูลเรียบร้อย');
    }
}
