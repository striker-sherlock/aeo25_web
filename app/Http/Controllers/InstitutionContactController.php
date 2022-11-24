<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\InstitutionContact;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class InstitutionContactController extends Controller
{
    public function __construct(){
        $this->middleware('IsAdmin');
    }

    public function index($type)
    {
        if ($type == 'national') {
            $contactList = InstitutionContact::where([['division', 'NR'], ['is_valid', true]])->orderBy('id')->get();
            $invalidContacts = InstitutionContact::where([['division', 'NR'], ['is_valid', false]])->orderBy('id')->get();
        } elseif ($type == 'international') {
            $contactList = InstitutionContact::where([['division', 'IR'], ['is_valid', true]])->orderBy('id')->get();
            $invalidContacts = InstitutionContact::where([['division', 'IR'], ['is_valid', false]])->orderBy('id')->get();
        }

        return view('institution-contacts.index', [
            'validInstitutions' => $contactList,
            'invalidInstitutions' => $invalidContacts,
            'type' => $type,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {

        if ($type == 'national') {
            $admins = Admin::where('division_id', 'NR')->orderBy('id')->get();
        } else if ($type == 'international') {
            $admins = Admin::where('division_id', 'IR')->orderBy('id')->get();
        }
        return view('institution-contacts.create', [
            'admins' => $admins,
            'type' => $type,
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

        $type = $request->division;

        if ($type == 'NR') {
            return redirect()->route('institution-contacts.index', 'national')->with('success', 'Data Succesfully Inserted');
        } elseif ($type == 'IR') {
            return redirect()->route('institution-contacts.index', 'international')->with('success', 'Data Succesfully Inserted');
        }
    }


    public function edit($type, $id)
    {
        return view('institution-contacts.edit', [
            'institutionContact' => InstitutionContact::find($id),
            'admins' =>  Admin::where('department_id', 'MITR')->orderBy('id')->get(),
            'type' => $type,
        ]);
    }

    public function update(Request $request, InstitutionContact  $institutionContact)
    {
        $this->validateInstitutionContact($request);

        $institutionContact->update([
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
            'updated_by' => 'admin',

        ]);

        if ($institutionContact->division == 'NR') {
            return redirect()->route('institution-contacts.index', 'national')->with('success', 'Data Successfully Updated');
        } elseif ($institutionContact->division == 'IR') {
            return redirect()->route('institution-contacts.index', 'international')->with('success', 'Data Successfully Updated');
        };

    }

    protected function validateInstitutionContact(Request $request)
    {
        $request->validate([
            'admin_id' => 'required|integer',
            'division' => 'required|string',
            'inst_type' => 'required|string',
            'institution_name' => 'required|string',
            'location' => 'required|string',
            'pic_name' => 'required|string',
            'email' => 'required|string',
            'phone_number' => 'required|string',
            'informal_letter_sent' => 'required|integer',
            'formal_letter_sent' => 'required|integer',
            'whatsapp_sent' => 'required|integer',
            'is_valid' => 'required|boolean',
            'reason' => 'required|string',
            'additional_notes' => 'nullable|string',

        ]);
    }
}
