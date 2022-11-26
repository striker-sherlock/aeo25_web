<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\Request;
use App\Exports\ParticipantExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\CompetitionParticipant;

class AdminCompetitionParticipantController extends Controller
{
    public function __construct(){
        $this->middleware('IsAdmin')->only(['edit']);
    }

    public function index($competition){
        // $trashed = CompetitionParticipant::onlyTrashed()->get();
        // dd($competitionParticipants);
        return view('competition-participants.index',[
            'competitionParticipants'=> CompetitionParticipant::where('competition_id',$competition)->get(),
            'competition' => Competition::find($competition),
            // 'trashed' => $trashed,
        ]);
    }

    public function show($user, $id){
        $competition = Competition::find($id);
        $competitionParticipants = CompetitionParticipant::where('pic_id',$user)
                                    ->where('competition_id',$id);
  
        return view('competition-participants.show',[
            'competitionParticipants' => $competitionParticipants->get(),
        ]);
    }

    public function edit(CompetitionParticipant $competitionParticipant){
        
        return view('competition-participants.edit',[
            'participant' => $competitionParticipant
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'nama' => 'nullable|string',
            'email' => 'nullable|string',
            'gender' => 'nullable',
            'phone' => 'nullable|numeric',
            'birth' => 'nullable|date_format:Y-m-d',
            'profile_picture' => 'nullable|image|max:1999|mimes:jpeg,jpg,png',
            'note' => 'nullable|string '
        ]);
        // dd(Auth::user()->pic_name);
        $competitionParticipant = CompetitionParticipant::find($id);
        if (!Auth::guard('admin')->check()){
            $competitionParticipant->update([
                'addictional_notes' => $request->note,
            ]);
            return redirect()->back()->with('success','Note is successfully added');
        }
        else{
            $name= $request->nama;
            $fileName = str_replace(' ', '-', $name);
            $fileName = preg_replace('/[^A-Za-z0-9\-]/', '', $fileName);
            $fileName = str_replace('-', '_', $fileName);
            $current = time();
    
            if($request->hasFile('profile_picture')){
                $extension = $request->file('profile_picture')->getClientOriginalExtension();
                $fixedName = $fileName.'_'.$current.'.'.$extension;
                $path = $request->file("profile_picture")->storeAs("public/profile_picture/".$request->competition_id,$fixedName);
            }
            else $fixedName = $request->profile_picture_old;
            $competitionParticipant->update([
                'name' => $request->nama,
                'email' => $request->email,
                'gender' => $request->gender,
                'birth_date' => $request->birth ,
                'phone_number' => $request->phone,
                'profile_picture' => $fixedName,
                'addictional_notes' => $request->notes,
            ]);

        }
        return redirect()->back()->with('success','Participant is successfully updated');
    } 

    public function export($competition){
        $competitionName = Competition::find($competition)->name;
        return Excel::download(new ParticipantExport($competition), $competitionName.'Participant.xlsx');
    }

    public function destroy(CompetitionParticipant $competitionParticipant) // SOFT DELETE
    {
        $competitionParticipant->delete();
        return redirect()->back();
    }

    public function delete($id) // HARD DELETE
    {
        CompetitionParticipant::where('id', $id)->forceDelete();
        return redirect()->back();
    }

    public function restore($id)
    {
        CompetitionParticipant::where('id', $id)->restore();
        return redirect()->back();
    }

}
