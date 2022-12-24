<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Access;
use Illuminate\Http\Request;
use App\Models\AccessControl;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AccessControlController extends Controller
{

    public function __construct()
    {
        $this->middleware('IsAdmin');
        $this->middleware('IsMIT');
    }

    public function index()
    {
        $allDepartment = DB::table('admins')->distinct('deparment_id')->select('department_id','department')->get();
        return view('access-controls.index', [
            'admins' => Admin::orderBy('department_id')->get(),
            'allDeparments' => $allDepartment,
        ]);
    }

    public function show($id){
    
        $datas = AccessControl::where("admin_id",$id)->get();
        $access_ids =[];
 
        foreach($datas as $data){
            array_push($access_ids,$data->access_id);
        }
 
        return view("access-controls.show",[
            "accesses" => Access::orderBy('id')->get(),
            "user" => Admin::find($id),
            "access_id" => $access_ids
        ]);
    }

    public function create()
    {
        return view('access-controls.create', [
            'accesses' => Access::orderBy('name')->get(),
            'admins' =>  Admin::all(),
        ]);

    }
    public function accessDepartment (Request $request){
        $admins = Admin::where('department_id',$request->department_id)->get();
        return view('access-controls.department-access-control',[
            'admins' => $admins,
            'departmentID' => $request->department_id,
            "accesses" => Access::orderBy('id')->get(),
            'department' => $admins[0]->department,
        ]);
    }
   
    public function departmentStore(Request $request){
        $admins = Admin::where('department_id',$request->department_id)->get();
        foreach ($admins as $admin) {
            AccessControl::where('admin_id',$admin->id)->delete();
            if ($request->access_id){
                $len = count($request->access_id);
                for($i = 0; $i < $len; $i++){
                    AccessControl::insert([
                        "created_by" => Auth::guard('admin')->user()->name,
                        "admin_id" => $admin->id,
                        "access_id" => $request->access_id[$i],
                    ]);
                }
            }
        }
        return redirect()->route("access-controls.index")->with("success","Successfuly Added");
    }
    public function store(Request $request){
        AccessControl::where('admin_id',$request->user_id)->delete();
    
        if ($request->access_id){
            $len = count($request->access_id);
        for($i = 0; $i < $len; $i++){
            AccessControl::insert([
                "created_by" => Auth::guard('admin')->user()->name,
                "admin_id" => $request->user_id,
                "access_id" => $request->access_id[$i],
            ]);
        }
        }
        return redirect()->route("access-controls.index")->with("success","Successfuly Added");
    }
    
    public function edit(AccessControl $accessControl)
    {
        return view('access-controls.edit', [
            'accessControl' => $accessControl,
            'accesses' => Access::all(),
            'admins' => Admin::all(),
        ]);
    }

    public function update(Request $request, AccessControl $accessControl)
    {
        $this->validateAccessControl($request);

        $accessControl->update([
            'access_id' => $request->access_id,
            'admin_id' => $request->admin_id,
            'updated_by' => 'admin',
            
        ]);

        return redirect()->route('access-controls.index')->with('success','Access Updated');
    }


    public function destroy(AccessControl $accessControl)
    {
        $accessControl->delete();
        return redirect()->back()->with('success', 'Access Deleted');
    }

    protected function validateAccessControl(Request $request)
    {
        $request->validate([
            'access_id' => 'required|integer',
            'admin_id' => 'required|string',
        ]);
    }
}
