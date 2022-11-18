<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\AccessControl;
use App\Models\Admin;
use Illuminate\Http\Request;

class AccessControlController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }


    public function index()
    {
        return view('access-controls.index', [
            'accessControls' => AccessControl::all()
        ]);
    }
    public function create()
    {
        return view('access-controls.create', [
            'accesses' => Access::orderBy('name')->get(),
            'admins' =>  Admin::all(),
        ]);

    }
   
    public function store(Request $request)
    {
        $this->validateAccessControl($request);

        AccessControl::create([
            'access_id' => $request->access_id,
            'admin_id' => $request->admin_id,
            'created_by' => 'admin',
        ]);

        return redirect()->route('access-controls.index')->with('success', 'New Access Created');
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
