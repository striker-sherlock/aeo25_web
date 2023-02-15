<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CompetitionParticipant;

class ReregistrationControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attend = CompetitionParticipant::where('is_attend',1)->get();
        $notAttend = CompetitionParticipant::where('is_attend',0)->get();
        return view('re-registrations.index',[
            'attend' => $attend,
            'notAttend' => $notAttend,
            'allParticipants' => CompetitionParticipant::all(), 
        ]);
    }

  
    public function update(Request $request, $id)
    {
        $participant = CompetitionParticipant::find($id);
        $participant->update([
            'is_attend' => 1,
            'name' => $request->name,
            'updated_by' => Auth::guard('admin')->user()->name,
        ]);
        return redirect()->back()->with('success',$participant->name."'s attendance has been confirmed");
    }

    public function unConfirm($id){
        $participant = CompetitionParticipant::find($id);
        $participant->update([
            'is_attend' => 0,
            'updated_by' => Auth::guard('admin')->user()->name,
        ]);
        return redirect()->back()->with('success',$participant->name."'s attendance has succesfully canceled");
    }

     
}
