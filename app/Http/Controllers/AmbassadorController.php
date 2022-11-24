<?php

namespace App\Http\Controllers;

use App\Models\Ambassador;
use Illuminate\Http\Request;

class AmbassadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ambassadors.index', [
            'ambassadors' => Ambassador::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ambassadors.create');
    }

    public function manage()
    {
        return view('ambassadors.manage', [
            'ambassadors' => Ambassador::all()
        ]);
    }

    public function store(Request $request)
    {
        $this->validateAmbassador();

        if ($request->hasFile('photo')) {
            $extension = $request->file('photo')->getClientOriginalExtension();
            $file_name = $request->name . time() . '.' . $extension;
            $path = $request->file('photo')->storeAs('public/images/ambassador', $file_name);
        }

        Ambassador::create([
            'name' => $request->name,
            'institution' => $request->institution,
            'testimony' => $request->testimony,
            'photo' => $file_name,
            'created_by' => 'admin',
        ]);

        return redirect()->route('ambassadors.manage')->with('success', 'Success Create New Ambassador');
    }



    public function edit(Ambassador $ambassador)
    {
        return view('ambassadors.edit', [
            'ambassador' => $ambassador
        ]);
    }

    public function update(Request $request, ambassador $ambassador)
    {
        $request->validate([
            'name' => 'required|string',
            'institution' => 'required|string',
            'testimony' => 'required|string',
            'photo_new' => 'image|nullable|max:1999|mimes:jpg,png,jpeg',
        ]);

        if ($request->hasFile('photo_new')) {
            $extension = $request->file('photo_new')->getClientOriginalExtension();
            $file_name = $request->name . time() . '.' . $extension;
            $path = $request->file('photo_new')->storeAs('public/images/ambassador', $file_name);
        } else {
            $file_name = request('photo_old');
        }

        $ambassador->update([
            'name' => $request->name,
            'institution' => $request->institution,
            'testimony' => $request->testimony,
            'photo' => $file_name,
        ]);

        return redirect()->route('ambassadors.manage')->with('success', 'Success Edit Ambassador');
    }

    public function destroy(Ambassador $ambassador)
    {
        $ambassador->delete();

        return redirect()->back()->with('success', 'Delete Ambassador');
    }


    protected function validateAmbassador()
    {
        return request()->validate([
            'name' => 'required|string',
            'institution' => 'required|string',
            'testimony' => 'required|string',
            'photo' => 'image|required|max:1999|mimes:jpg,png,jpeg',
        ]);
    }
}
