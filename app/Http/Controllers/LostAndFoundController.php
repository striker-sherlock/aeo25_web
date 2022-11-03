<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LostAndFound;
use Illuminate\Support\Facades\File;

class LostAndFoundController extends Controller
{
    public function index()
    {
        return view('lost-and-found.index', [
            'lost_and_found' => LostAndFound::all()
        ]);
    } 

    public function show()
    {
        return view('lost-and-found.show', [
            'lost_and_found' => LostAndFound::all()
        ]);
    }

    public function create() {
        return view('lost-and-found.create');
    }

    public function store(Request $request) {
        
        $request->validate([
            'item' => 'required',
            'image' => 'required',
            'location' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);

        LostAndFound::create([
            "created_by" => "admin",
            'item' => $request->item,
            'image' => $request->file('image')->getClientOriginalName(),	
            'location' => $request->location,
            'description' => $request->description,
            'status' => $request->status
        ]);

        $file = $request->file('image');
        $file->move(public_path('/images/lost-and-found'), $file->getClientOriginalName());

        return redirect()->route('lost-and-found.index');
        // return redirect('/lost-and-found')->with('status', 'Data has been successfully added!');
    }

    public function edit(LostAndFound $lost_and_found) {
        return view('lost-and-found.edit', ['lost_and_found' => $lost_and_found]);
    }

    public function update(Request $request, LostAndFound $lost_and_found) {
        $request->validate([
            'item' => 'required',
            'image' => 'required',
            'location' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);

        if ($request->hasfile('image')) {
            $path = "storage/images/lost-and-found/" . $lost_and_found->image;
            File::delete($path);

            $lost_and_found->update([
                "updated_by" => "admin",
                'item' => $request->item,
                'image' => $request->file('image')->getClientOriginalName(),
                'location' => $request->location,
                'description' => $request->description,
                'status' => $request->status
            ]);

            $file = $request->file('image');
            $file->move(public_path('/images/lost-and-found'), $file->getClientOriginalName());
        } else {
            $lost_and_found->update([
                "updated_by" => "admin",
                'item' => $request->item,
                'location' => $request->location,
                'description' => $request->description,
                'status' => $request->status
            ]);
        }

        return redirect()->route('lost-and-found.index');
        // return redirect('/lost-and-found')->with('status', 'Data berhasil diubah!');
    }

    public function destroy(LostAndFound $lost_and_found) {
        LostAndFound::destroy($lost_and_found->id);

        return redirect()->route('lost-and-found.index');
        // return redirect('/lost-and-found')->with('status', 'Data berhasil dihapus!');
    }
}
