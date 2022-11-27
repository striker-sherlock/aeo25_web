<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    public function __construct(){
        $this->middleware('IsAdmin');
        $this->middleware('auth')->only(['create']);
        $this->middleware('IsShowed:ENV003')->only(['index', 'show']);
    }
    
    public function index()
    {
        return view('faqs.index', [
            'faqs' => Faq::all()
        ]);
    }  

    public function show()
    {
        return view('faqs.show', [
            'faqs' => Faq::all()
        ]);
    }  

    public function create() {
        return view('faqs.create');
    }

    public function store(Request $request) {
        $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);

        Faq::create([
            "created_by" => "admin",
            'question' => $request->question,
            'answer' => $request->answer
        ]);

        return redirect()->route('faqs.index');
        // return redirect('/faq')->with('status', 'Data has been successfully added!');
    }

    public function edit(Faq $faq) {
        return view('faqs.edit', ['faq' => $faq]);
    }

    public function update(Request $request, Faq $faq) {
        $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);

        $faq->update([
            "updated_by" => "admin",
            'question' => $request->question,
            'answer' => $request->answer
        ]);

        return redirect()->route('faqs.index');
        // return redirect('/faq')->with('status', 'Data berhasil diubah!');
    }

    public function destroy(Faq $faq) {
        Faq::destroy($faq->id);

        return redirect()->route('faqs.index');
        // return redirect('/faq')->with('status', 'Data berhasil dihapus!');
    } 
}
 
?>