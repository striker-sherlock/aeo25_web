<?php

namespace App\Http\Controllers;

use App\Models\Environment;
use Illuminate\Http\Request;

class EnvironmentController extends Controller
{
    public function __construct(){
        $this->middleware('IsAdmin');
    }
    public function index()
    {
        return view("environments.index", [
            "environments" => Environment::all()
        ]);
    }

    public function validateRequest($request)
    {
        $request->validate([
            'env_code' => 'required|string',
            'env_name' => 'required|string',
            'start_time' => 'nullable|date_format:d-m-Y H:i',
            'end_time' => 'nullable|date_format:d-m-Y H:i'
        ]);
     
    }

    public function create()
    {
        return view("environments.create");
    }

    public function store(Request $request)
    {
      $this->validateRequest($request);

        Environment::create([
            'created_by' => 'PIC',
            "env_name" => $request->env_name,
            "env_code" => $request->env_code,
            "start_time" => $request->start_time,
            "end_time" => $request->end_time,
        ]);

        return redirect()->route("environments.index")->with('Success',"Environment Created Successfully!");
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
    public function edit (Environment $environment)
    {
        return view('environments.edit', [
            'env' => $environment
        ]);
    }

    public function update(Request $request, Environment $environment)
    {
        $this->validateRequest($request, FALSE);

        $environment->update([
            'env_name' => $request->env_name,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time
        ]);

        return redirect()->route('environments.index')->with('success','Environment Updated Successfully!');
    }

    public function destroy(Environment $environment)
    {
        $environment->delete();
        return redirect()->back()->with("success","Environment ".$environment->env_name." Successfuly Deleted");
    }

    
}
