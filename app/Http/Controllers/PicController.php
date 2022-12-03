<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Countries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PicController extends Controller
{
    public function __construct(){
        // $this->middleware(['auth', 'verified'])->only(['edit']);
        $this->middleware('IsAdmin')->only(['index']);
    }
    public function index()
    {
        $nationalPIC = User::join('countries','countries.id','users.country_id')
            ->where('countries.name' , 'LIKE' , 'Indonesia')
            ->select('users.*')
            ->get();
        $internationalPIC = User::join('countries','countries.id','users.country_id')
            ->where('countries.name' , 'NOT LIKE' , 'Indonesia')
            ->select('users.*')
            ->get();
        return view('users.index',[
            'nationalPIC' => $nationalPIC,
            'internationalPIC' => $internationalPIC 
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

 
    public function edit($id)
    {
        return view('users.edit',[ 
            'user' => User::find($id),
            'countries' => Countries::all(),
        ]);
    }
 
    public function adminEdit($id)
    {   
        return view('users.admin-edit',[ 
            'user' => User::find($id),
            'countries' => Countries::all(),
        ]);
    }
 
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'institution_name' => 'required|string',
            'institution_type' => 'required|string',
            'institution_old_logo' => 'nullable|image|mimes:png,jpeg,jpg|max:1999',
            'pic_name' => 'required|string',
            'pic_phone_number' => 'required|numeric',
            'old_password' => 'nullable',
            'password' => 'nullable|confirmed',
        ]);

        // match password yang lama dengan yang baru
        if($request->old_password){
            if(!Hash::check($request->old_password, auth()->user()->password)) return back()->with("error", "Old Password Doesn't match!");
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        $pic = $request->institution_name ;
        $fileName = str_replace(' ', '-', $pic );
        $fileName = preg_replace('/[^A-Za-z0-9\-]/', '', $fileName);
        $fileName = str_replace('-', '_', $fileName);
        $current = time();
        $username = strtolower(str_replace(' ', '', $request->pic_name));
        if($request->hasFile('institution_logo_new')){
            $extension = $request->institution_logo_new->getClientOriginalExtension();
            $fixedName = $fileName.'_'.$current.'.'.$extension;
            $path = $request->institution_logo_new->storeAs("public/institution_logo",$fixedName);
        }
        else $fixedName = $request->institution_logo_old;
        $user->update([
            'updated_by' => $username,
            'institution_name' => $request->institution_name,
            'institution_email' => $request->institution_email,
            'institution_type' => $request->institution_type,
            'institution_logo' => $fixedName,
            'country_id' => $request->country_id,
            'pic_name' => $request->pic_name,
            'pic_phone_number' => $request->pic_phone_number,
            'username' => $username,
        ]);

        return redirect()->route('dashboard')->with('success','Profile has successfuly updated');
    }

  
    public function destroy($id)
    {
        //
    }
}
