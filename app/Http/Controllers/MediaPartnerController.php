<?php

namespace App\Http\Controllers;

use App\Models\MediaPartner;
use Illuminate\Http\Request;

class MediaPartnerController extends Controller
{

    public function index()
    {
        return view('media-partners.index', [
            'media_partners' => MediaPartner::All(),
        ]);
    }

    public function create()
    {
        return view('media-partners.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'logo' => 'required|image|max:1999|mimes:jpg,png,jpeg',
        ]);

              //proses rename file 
              $name = $request->name;
              $newName = str_replace(' ', '-', $name);
              $newName = preg_replace('/[^A-Za-z0-9\-]/', '', $newName);
              $newName = str_replace('-', '_', $newName);
              $current = time();

        if ($request->hasFile('logo')) {
            $extension = $request->file('logo')->getClientOriginalExtension();
            $file_name =$newName. '_'. $current. '_logo.' .$extension;
            $path = $request->file('logo')->storeAs('public/logo/media-partner', $file_name);
        };

        MediaPartner::create([
            'name' => $request->name,
            'logo' => $file_name,
            'created_by' => 'admin',
            'is_showed' => true
        ]);

        return redirect()->route('media-partners.index')->with('success', 'Data Successfully Inserted');
    }


    public function edit(MediaPartner $media_partner)
    {
        return view('media-partners.edit', ['media_partner' => $media_partner]);
    }

    public function update(Request $request, MediaPartner $media_partner)
    {
        $request->validate([
            'name' => 'required|string',
            'logo_new' => 'image|nullable|max:1999|mimes:jpg,png,jpeg',
        ]);

        if ($request->hasFile('logo_new')) {
            $extension = $request->file('logo_new')->getClientOriginalExtension();
            $file_name = $request->name . '.' . $extension;
            $path = $request->file('logo_new')->storeAs('public/logo/media-partner', $file_name);
        } else {
            $file_name = request('logo');
        };

        $media_partner->update([
            'name' => $request->name,
            'logo' => $file_name,
            'updated_by' => 'admin'
        ]);

        return redirect()->route('media-partners.index')->with('success', 'Data Successfully Updated');
    }



    public function destroy(MediaPartner $mediaPartner)
    {
        $mediaPartner->delete();
        return redirect()->route('media-partners.index')->with('success', 'Data Successfully Deleted');
    }

    public function updateVisibility(MediaPartner $mediaPartner)
    {

        $mediaPartner->update([
            'is_showed' => !$mediaPartner->is_showed,
            'updated_by' => "admin",
        ]);

        return redirect()->route('media-partners.index');
    }

  
}
