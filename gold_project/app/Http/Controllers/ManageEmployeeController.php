<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
                'telephone' => $request->get('telephone'),
                'username' => $request->get('username'),
                'email' => $request->get('email'),
                'password' => $request->get('password'),
            ]
        );
        if ($request->hasFile('pic')) {
            $file = $request->file('pic');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('assets/img/employee', $filename);
            $manageemployee->pic = $filename;
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
        $manageemployee->telephone = $request->get('telephone');
        $manageemployee->username = $request->get('username');
        $manageemployee->email = $request->get('email');
        $manageemployee->password = $request->get('password');
        // $managegold->pic = $request->get('pic');
        if ($request->hasFile('pic')) {
            $destination = 'assets/img/employee' . $manageemployee->pic;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('pic');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('assets/img/employee', $filename);
            $manageemployee->pic = $filename;
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
