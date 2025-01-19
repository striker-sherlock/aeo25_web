<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AdminController;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('IsAdmin');
    }

    public function index()
    {
        return view('admins.index', [
            'admins' => Admin::all(),
        ]);
    }

   
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {

    }

    
    public function edit(Admin $admin)
    {
        return view('admins.edit', [
            'admin' => $admin,
        ]);
    }

   
    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name'=> 'required|string',
            'nim'=> 'required|string',
            'email'=> 'required|string',
            'position_id'=> 'required|numeric',
            'department_id'=> 'required|string',
            'department'=> 'required|string',
            'division_id'=> 'required|string',
            'division'=> 'required|string',
            'password'=> 'nullable|string',
        ]);

        if($request->position_id == 1){
            $request->position = "SC";
        }
        else if($request->position_id==2){
            $request->position = "Director";
        }
        else if($request->position_id==3){
            $request->position = "Coordinator";
        }
        else if($request->position_id==4){
            $request->position = "Senior Staff";
        }
        else if($request->position_id==5){
            $request->position = "Staff";
        }

        $admin->update([
            'name'=>$request->name,
            'nim'=>$request->nim,
            'email'=>$request->email,
            'position_id'=>$request->position_id,
            'position'=>$request->position,
            'department_id'=>$request->department_id,
            'department'=>$request->department,
            'division_id'=>$request->division_id,
            'division'=>$request->division,
            'password'=>Hash::make($request->password),
        ]);
        return redirect()->route('admins.index')->with('success','Profile has successfuly updated');
    }

    
    // public function destroy($id)
    // {
    //     //
    // }
}
