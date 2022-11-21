<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\FollowUp;
use App\Models\FollowUpType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FollowUpController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index($type)
    {

        if ($type === "national") {

            $followUpList = FollowUp::where('is_national', true)->orderByDesc('priority')->get();
        } else if ($type === "international") {

            $followUpList = FollowUp::where('is_national', false)->orderByDesc('priority')->get();
        }

        return view('follow-ups.index', [
            'deletedfollowUps' => FollowUp::onlyTrashed()->orderByDesc('priority')->get(),
            'type' => $type,
            'followUpTypes' => FollowUpType::all(),
            'followUps' => $followUpList,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {

        return view('follow-ups.create', [
            'users' => User::all(),
            'admins' => Admin::all(),
            'creator' => Auth::guard('admin')->user(),
            'followUpTypes' => FollowUpType::all(),
            'type' => $type,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateFollowUp($request);

        FollowUp::create([
            'creator_id' => Auth::guard('admin')->user()->id,
            'pic_id' => Auth::guard('admin')->user()->id,
            'admin_id' => Auth::guard('admin')->user()->id,
            'is_national' => $request->is_national,
            'type_id' => $request->type_id,
            'priority' => $request->priority,
            'detail' => $request->detail,
            'notes' => $request->notes,
            'status' => $request->status,
            'created_by' =>  Auth::guard('admin')->user()->name,
            'user_id' =>  $request->user_id,
        ]);

        if ($request->is_national == true) {
            $admins = Admin::where('division_id', 'NR')->get();
            //masukin email
            return redirect()->route('follow-ups.index', 'national')->with('success', 'Create New Follow Up Success');
        } else {
            $admins = Admin::where('division_id', 'IR')->get();
            //masukin email
            return redirect()->route('follow-ups.index', 'international')->with('success', 'Create New Follow Up Success');
        }
    }

    public function edit(FollowUp $followUp)
    {
        if ($followUp->is_national == true) {
            $admins = Admin::where('division_id', 'NR')->get();
        } else {
            $admins = Admin::where('division_id', 'IR')->get();
        }

        return view('follow-ups.edit', [
            'followUp' => $followUp,
            'followUpType' => FollowUpType::all(),
            'users' => User::all(),
            'staffRegists' => $admins,
        ]);
    }

    public function assignPIC(Request $request, FollowUp $followUp)
    {
        $followUp->update([
            'pic_id' => $request->pic_id,
            'status' => 2,
        ]);
        $PIC = Admin::where('id', $request->pic_id)->first();

        if ($followUp->is_national == true) {
            return redirect()->route('follow-ups.index', "national")->with('success', 'Assigning Follow Up Success');
        } else {
            return redirect()->route('follow-ups.index', "international")->with('success', 'Assigning Follow Up Success');
        }
    }

    public function updateStatus(FollowUp $followUp)
    {
        $followUp->update([
            'status' => 3,
        ]);

        if ($followUp->is_national == true) {
            return redirect()->route('follow-ups.index', "national")->with('success', 'Success Update Status');
        } else {
            return redirect()->route('follow-ups.index', "international")->with('success', 'Success Update Status');
        }
    }

    public function update(Request $request, FollowUp $followUp)
    {
        $request->validate([
            'notes' => 'required|string',
        ]);

        $followUp->update([
            'notes' => $request->notes,
            'status' => 3,
        ]);

        if ($followUp->is_national == true) {
            return redirect()->route('follow-ups.index', "national")->with('success', 'Success Update Status');
        } else {
            return redirect()->route('follow-ups.index', "international")->with('success', 'Success Update Status');
        }
    }

    public function show(FollowUp $followUp)
    {
        return view ('follow-ups.show', [
            'followUp' => $followUp,
            'admins' => Admin::all(),
            'users' => User::all(),
        ]);
    }

    public function destroy(FollowUp $followUp)
    {
        $followUp->delete();
        return redirect()->back()->with('success', 'Delete Follow-Up Success');
    }

    public function restore($id)
    {
        FollowUp::onlyTrashed()->find($id)->restore();

        return redirect()->back()->with('success', 'Restore Success');
    }

    public function delete($id)
    {
        FollowUp::onlyTrashed()->find($id)->forceDelete();

        return redirect()->back()->with('success', 'Delete Success');
    }

    protected function validateFollowUp(Request $request)
    {

        $request->validate([
            'is_national' => 'required|boolean',
            'priority' => 'required|integer',
            'detail' => 'required|string',
            'notes' => 'nullable|string',
            'status' => 'required|integer',
            'type_id' => 'required|integer',
            'user_id' => 'required|integer|exists:users,id'
        ], [
            'user_id.exists' => 'User ID is Invalid'
        ]);
    }
}
