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
    public function index()
    {
        $manageemployee = User::all()->toArray();
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
        $manageemployee = new User(
            [
                'name' => $request->get('name'),
                'lastname' => $request->get('lastname'),
                'idcard' => $request->get('idcard'),
                'address' => $request->get('address'),
                'address_now' => $request->get('address_now'),
                'telephone' => $request->get('telephone'),
                'username' => $request->get('username'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
            ]
        );
        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('assets/img/employee', $filename);
            $manageemployee->picture = $filename;
        }
        // $image = $request->file('pic');
        // $new_name = rand() .'.'. $image->getClientOriginalExtension();
        // $image -> move(public_path('assets/img/gold'),$new_name);
        // dd($managegold);
        $manageemployee->save();
        $manageemployee = User::all()->toArray();
        return view('admin.manage_employee.index', compact('manageemployee'));
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
        $manageemployee = User::find($id);
        $manageemployee->name = $request->get('name');
        $manageemployee->lastname = $request->get('lastname');
        $manageemployee->idcard = $request->get('idcard');
        $manageemployee->address = $request->get('address');
        $manageemployee->address_now = $request->get('address_now');
        $manageemployee->telephone = $request->get('telephone');
        $manageemployee->username = $request->get('username');
        $manageemployee->email = $request->get('email');
        $manageemployee->password =  Hash::make($request->get('password'));
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
        $manageemployee = User::all()->toArray();
        return view('admin.manage_employee.index', compact('manageemployee', 'id'));
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
        $manageemployee = User::all();
        return view('admin.manage_employee.index', compact('manageemployee'))->with('success', 'ลบข้อมูลเรียบร้อย');
    }
}
