<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ManageEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $manageemployee = User::select("*");
        if (!empty($keyword)) {
            $manageemployee = $manageemployee->where('users.name', 'like', "%$keyword%")
                ->orWhere('users.lastname', 'like', "%$keyword%")
                ->orWhere('users.idcard', 'like', "%$keyword%")
                ->orWhere('users.telephone', 'like', "%$keyword%");
        }
        $manageemployee = $manageemployee->paginate(5);
        return view('admin.manage_employee.index', compact('manageemployee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.manage_employee.create-employee');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate_id_card = User::where('idcard', $request->idcard)->first();
        if (!empty($validate_id_card)) {
            return response()->json(['status' => false], 200);
        }
        $manageemployee = new User(
            [
                'name' => $request->name,
                'lastname' => $request->lastname,
                'idcard' => $request->idcard,
                'address' => $request->address,
                'address_now' => $request->address_now,
                'telephone' => $request->telephone,
                'username' => $request->username,
                'email' => $request->email,
                'date_card_start' => $request->date_card_start,
                'date_card_end' => $request->date_card_end,
                'password' => Hash::make($request->password),
            ]
        );
        $picture = json_decode($request->data)->picture;
        if ($picture) {
            $img = $picture;
            $folderPath = "assets/img/employee/"; //path location
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $uniqid = $request->idcard;
            $file = $folderPath . $uniqid . '.' . $image_type;
            file_put_contents($file, $image_base64);
            $manageemployee->picture = $uniqid . '.' . $image_type;
        }
        // dd($manageemployee);
        $manageemployee->save();
        $manageemployee = User::select('*')->paginate(5);
        // return view('admin.manage_employee.index', compact('manageemployee'));
        return response()->json(['status' => true], 200);
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
        $manageemployee = User::find($id);
        return view('admin.manage_employee.edit', compact('manageemployee', 'id'));
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
        $validate_id_card = User::where('idcard', $request->get('idcard'))->where('id', '!=', $id)->first();
        if (!empty($validate_id_card)) {
            return response()->json(['status' => false], 200);
        }
        $manageemployee = User::find($id);
        $manageemployee->name = $request->get('name');
        $manageemployee->lastname = $request->get('lastname');
        $manageemployee->idcard = $request->get('idcard');
        $manageemployee->address = $request->get('address');
        $manageemployee->address_now = $request->get('address_now');
        $manageemployee->telephone = $request->get('telephone');
        $manageemployee->username = $request->get('username');
        $manageemployee->email = $request->get('email');
        $manageemployee->date_card_start = $request->get('date_card_start');
        $manageemployee->date_card_end = $request->get('date_card_end');
        // $manageemployee->password =  Hash::make($request->get('password'));
        // $managegold->pic = $request->get('pic');
        if ($request->hasFile('picture')) {
            $destination = 'assets/img/employee' . $manageemployee->picture;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('picture');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('assets/img/employee', $filename);
            $manageemployee->picture = $filename;
        }
        $manageemployee->save();
        $manageemployee = User::select('*')->paginate(5);
        return response()->json(['status' => true], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manageemployee = User::find($id);
        $manageemployee->delete();
        $manageemployee = User::select('*')->paginate(5);
        return response()->json(['status' => true], 200);
    }

    public function validateIdcard($idCard, $id = '')
    {
        if (!empty($id)) {
            $manageemployee = User::where('idcard', $idCard)->where('id', '!=', $id)->first();
        } else {
            $manageemployee = User::where('idcard', $idCard)->first();
        }
        if (!empty($manageemployee))
            return response()->json(['status' => false], 200);

        return response()->json(['status' => true], 200);
    }

    public function validateTel($Tel, $id = '')
    {
        if (!empty($id)) {
            $manageemployee = User::where('telephone', $Tel)->where('id', '!=', $id)->first();
        } else {
            $manageemployee = User::where('telephone', $Tel)->first();
        }
        if (!empty($manageemployee))
            return response()->json(['status' => false], 200);

        return response()->json(['status' => true], 200);
    }

    public function reset_password(Request $request){
        $manageemployee = User::find($request->json('id'));
        if(empty($request->json('password'))){
            return response()->json(['status' => false], 500);
        }
        $manageemployee->password =  Hash::make($request->json('password'));
        $manageemployee->save();

        return response()->json(['status' => true], 200);
    }
}
