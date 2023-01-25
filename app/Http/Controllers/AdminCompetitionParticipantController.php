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
        $this->middleware('IsAdmin')->only(['edit','index']);
    }
    public function pageValidation($competition){
        if(Auth::guard('admin')->user()->division_id != $competition){
            if(Auth::guard('admin')->user()->division_id == 'OC' 
            && ($competition == 'SSW' || $competition == 'RD')) return false;          
            if(Auth::guard('admin')->user()->division_id == 'CP') return false ;
            if(Auth::guard('admin')->user()->department_id != 'CP') return false;
            return true;
        } 
        
        
        
    }
 
    public function index($competition){
        if($this->pageValidation($competition)) return redirect()->back()->with('error','you are not authorized for this page');
        
        return view('competition-participants.index',[
            'competitionParticipants'=> CompetitionParticipant::where('competition_id',$competition)->get(),
            'competition' => Competition::find($competition),
            'allCompetitions' => Competition::all(),
            'trashed' => CompetitionParticipant::onlyTrashed()->get()->where('competition_id',$competition),
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

        $competitionParticipant = CompetitionParticipant::find($id);
        $competitionID = $competitionParticipant->competition->id;
        if (!Auth::guard('admin')->check()){
            $competitionParticipant->update([
                'additional_notes' => $request->note,
            ]);
            return redirect()->back()->with('success','Note is successfully added');
        }
        else{
            $name= $request->nama;
            $fileName = str_replace(' ', '-', $name);
            $fileName = preg_replace('/[^A-Za-z0-9\-]/', '', $fileName);
            $fileName = str_replace('-', '_', $fileName);
            $current = time();
            
            if($request->hasFile('profile_picture_new')){
                $extension = $request->file('profile_picture_new')->getClientOriginalExtension();
                $fixedName = $fileName.'_'.$current.'.'.$extension;
                $path = $request->file("profile_picture_new")->storeAs("public/profile_picture/".$competitionID,$fixedName);
            }
            else $fixedName = $request->profile_picture_old;
            // dd($competitionParticipant);
            $competitionParticipant->update([
                'name' => $request->nama,
                'email' => $request->email,
                'gender' => $request->gender,
                'birth_date' => $request->birth ,
                'phone_number' => $request->phone,
                'profile_picture' => $fixedName,
                'additional_notes' => $request->notes,
                'is_vegetarian' => $request->vegetarian,
                // 'food_allergic' => $request->food_allergic,
            ]);

        }
        return redirect()->route('competition-participants.index',$competitionParticipant->competition->id)->with('success','Participant has successfully updated');
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
