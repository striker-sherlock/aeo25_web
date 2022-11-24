<?php

namespace App\Http\Controllers;

use App\Models\CompetitionScore;
use App\Models\ScoreType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScoreTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('IsAdmin');
    }

    public function index()
    {
        return view('score-types.index', [
            'scoreTypes' => ScoreType::all()
        ]);
    }

    public function create()
    {
        return view('score-types.create');
    }

    private function validateRequest (Request $request)
    {
        $request->validate([
            'type_name' => 'required|string|unique:score_types,type_name'
        ]);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        ScoreType::create([
            'created_by' => 'Admin',
            'type_name' => $request->type_name,
        ]);

        return redirect()->route('score-types.index')->with('success', 'Score Types created successfully');
    }

    public function edit(ScoreType $scoreType)
    {
        return view('score-types.edit', [
            'scoreType' => $scoreType
        ]);
    }

    public function update(Request $request, ScoreType $scoreType)
    {
        $this->validateRequest($request);

        $scoreType->update([
            'updated_by' => 'Admin',
            'type_name' => $request->type_name
        ]);

        return redirect()->route('score-types.index')->with('success', 'Score Types updated successfully');
    }
    
    public function destroy(ScoreType $scoreType)
    {

        foreach (CompetitionScore::where('score_type_id', $scoreType->id) as $score){
            $score->delete();
        }

        $scoreType->delete();

        return redirect()->back()->with('success', 'Score Types deleted successfully');
    }
}
