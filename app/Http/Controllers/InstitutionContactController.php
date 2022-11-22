<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\InstitutionContact;
use Illuminate\Http\Request;

class InstitutionContactController extends Controller
{
    public function __construct(){
        $this->middleware('IsAdmin');
    }

    public function index()
    {
        return view('institution-contacts.index', [
            'institutionContacts' => InstitutionContact::all(),
        ]);
    }

    
    public function create()
    {
        return view('institution-contacts.create', [
            'admin' =>  Admin::all(),
        ]);
    }

    public function store(Request $request)
    {
        $this->validateInstitutionContact($request);

        InstitutionContact::create([
            'admin_id' => $request->admin_id,
            'division' => $request->division,
            'inst_type' => $request->inst_type,
            'institution_name' => $request->institution_name,
            'location' => $request->location,
            'pic_name' => $request->pic_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'informal_letter_sent' => $request->informal_letter_sent,
            'formal_letter_sent' => $request->formal_letter_sent,
            'whatsapp_sent' => $request->whatsapp_sent,
            'is_valid' => $request->is_valid,
            'reason' => $request->reason,
            'additional_notes' => $request->additional_notes,
            'created_by' => 'admin',

        ]);

        return redirect()->route('institution-contacts.index')->with('success', 'Data Succesfully Inserted');
    }


    public function edit(InstitutionContact $institutionContact)
    {
        return view('institution-contacts.edit', ['institution_contact' => $institutionContact]);
    }

    public function update(Request $request, InstitutionContact  $institutionContact)
    {
        $this->validateInstitutionContact($request);

        $institutionContact->update([
            'admin_id' => $request->admin_id,
            'division' => $request->division,
            'inst_type' => $request->inst_type,
            'institution_name' => $request->institution_name,
            'institution_name' => $request->institution_name,
            'location' => $request->location,
            'pic_name' => $request->pic_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'informal_letter_sent' => $request->informal_letter_sent,
            'formal_letter_sent' => $request->formal_letter_sent,
            'whatsapp_sent' => $request->whatsapp_sent,
            'is_valid' => $request->is_valid,
            'reason' => $request->reason,
            'additional_notes' => $request->additional_notes,
            'updated_by' => 'admin',

        ]);

        return redirect()->route('institution-contacts.index')->with('success', 'Data Successfully Updated');
    }

    protected function validateInstitutionContact(Request $request)
    {
        $request->validate([
            'admin_id' =>'required|integer',
            'division' =>'required|string',
            'inst_type' =>'required|string',
            'institution_name' =>'required|string',
            'location' =>'required|string',
            'pic_name' =>'required|string',
            'email' =>'required|string',
            'phone_number' =>'required|string',
            'informal_letter_sent' =>'required|integer',
            'formal_letter_sent' =>'required|integer',
            'whatsapp_sent' =>'required|integer',
            'is_valid' =>'required|boolean',
            'reason' =>'required|string',
            'additional_notes' => 'nullable|string',

        ]);
    }
}
