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
            dd($request->all());
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

}
