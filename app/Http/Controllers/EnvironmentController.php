<?php

namespace App\Http\Controllers;

use App\Models\Environment;
use Illuminate\Http\Request;

class EnvironmentController extends Controller
{

    public function index()
    {
        return view("environments.index", [
            "environments" => Environment::all()
        ]);
    }

    public function create()
    {
        return view("environments.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            "env_name" => 'required|string',
            "env_code" => 'required|string',
            "start" => 'nullable',
            "end" => 'nullable|after:start',
        ]);

        Environment::create([
            'created_by' => 'PIC',
            "env_name" => $request->env_name,
            "env_code" => $request->env_code,
        ]);
        return redirect()->route("environments.index");
    }

    public function updateVisibility(Environment $environment){

        $environment->update([
            "updated_by" => "PIC_UPDATE",
            'is_showed' => !$environment->is_showed,
        ]);
        if ($environment->is_showed == 1){
            return redirect()->route('environments.index')->with("success", $environment->env_name." is showed");
        }
        else{
            return redirect()->route('environments.index')->with("success", $environment->env_name." is hidden");
        }
    }
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Environment $environment)
    {
        $environment->delete();
        return redirect()->back()->with("success","Environment ".$environment->env_name." Successfuly Deleted");
    }
}
