<?php

namespace App\Http\Controllers;

use App\Models\Merchandise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MerchandiseController extends Controller
{
 
    public function __construct(){
        $this->middleware('IsShowed:ENV011');
        $this->middleware('IsAdmin');
        $this->middleware('Access:28');
    }

    public function index()
    {
        return view('merchandises.index',[
            'merchandises' => Merchandise::all()
        ]);
    }

    public function create()
    {
        return view('merchandises.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'price' => 'required|numeric',
            'image.*' => 'required|image|mimes:jpg,jpeg,png|max:1999',
            'product_detail' => 'nullable',
            'type' => 'required|string',
        ]);

        $merchandisePhoto = [];
        if($files = $request->file('image')){
            $i = 1;
            foreach($files as $file){
                $newName = $request->nama;
                $newName = str_replace(' ', '-', $newName);
                $newName = str_replace('/[^A-Za-z0-9\-]/', '', $newName);
                $newName = str_replace('-', '_', $newName);
                $current = time();
                $extension = strtolower($file->extension());
                $fileName = $newName.'_'.$current.'_'.$i.'.'.$extension;
                $file->storeAs('public/merchandise/merchandise_photo', $fileName);
                $merchandisePhoto[] = $fileName;
                $i++;
            }
        }


        Merchandise::create([
            'name' => $request->nama,
            'image' => implode('; ', $merchandisePhoto),
            'price' => $request->price,
            'product_description' => $request->product_detail,
            'type' => $request->type,
            'created_by' => Auth::guard('admin')->user()->name,
        ]);

        return redirect()->route('merchandises.index')->with('success','Merchandise has successfuly created');
    }
  
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $merchandise = Merchandise::find($id);
        return view('merchandises.edit',[
            'merchandise' =>  $merchandise
        ]);
    }
    
    public function update(Request $request, $id)
    {
        
        $merchandise = Merchandise::find($id);
        $request->validate([
            'nama' => 'required|string',
            'price' => 'required|numeric',
            'image.*' => 'nullable|image|mimes:jpg,jpeg,png|max:1999',
            'product_detail' => 'nullable',
            'type' => 'required|string',
        ]);

        $merchandisePhoto = [];
        if($files = $request->file('image')){
            $i = 1;
            foreach($files as $file){
                $newName = $request->nama;
                $newName = str_replace(' ', '-', $newName);
                $newName = str_replace('/[^A-Za-z0-9\-]/', '', $newName);
                $newName = str_replace('-', '_', $newName);
                $current = time();
                $extension = strtolower($file->extension());
                $fileName = $newName.'_'.$current.'_'.$i.'.'.$extension;
                $file->storeAs('public/merchandise/merchandise_photo', $fileName);
                $merchandisePhoto[] = $fileName;
                $i++;
            }
        }
        else{
            $image_old = $request->image_old;
        }


        $merchandise->update([
            'name' => $request->nama,
            'image' => $request->hasFile('image') ? implode('; ', $merchandisePhoto) : $image_old,
            'price' => $request->price,
            'product_description' => $request->product_detail,
            'type' => $request->type,
            'created_by' => Auth::guard('admin')->user()->name,
        ]);
        return redirect()->route('merchandises.index')->with('success','Merchandise has successfuly updated');
    }
    
    public function destroy($id)
    {
        $merchandise = Merchandise::find($id);
        $merchandise->delete();
        return redirect()->route('merchandises.index')->with('success','Merchandise has successfuly deleted');
    }
}
