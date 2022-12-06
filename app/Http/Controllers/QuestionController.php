<?php

namespace App\Http\Controllers;

use App\Mail\QuestionNotificationMail;
use App\Mail\QuestionReplyMail;
use App\Models\Admin;
use App\Models\Countries;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class QuestionController extends Controller
{

    public function __construct()
    {
        $this->middleware('IsAdmin')->except('store');

    }

   
    public function index()
    {
        return view('questions.index', [
            'questions' => Question::all(),
            'countries' => Countries::all(),
        ]);
    }

  
    public function create()
    {
        return view('questions.create', [
            'countries' => Countries::all(),
        ]);
    }

   
    public function store(Request $request)
    {
        $this->validateQuestion();

        Question::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'question' => $request->question,
            'is_responded' => false,
            'country_id' => $request->country_id,
            'admin_id' => '1',
            'created_by' => $request->name,

        ]);

        $country = Countries::find($request->country_id);

        $questionNotification = [
            'subject' => "New Question Notification",
            'division' => "MIT - Registration Department",
            'body' => "A new question from <b>" . $request->name . "</b> has been submitted! <br> Kindly reply it as soon as possible through AEO website by clicking the button bellow.",
            'link' => "http://aeo.mybnec.org/questions" 
        ];

        $admins = Admin::where('department_id', 'MITR')->get();
        Mail::to($admins)->send(new QuestionNotificationMail($questionNotification));
        
        return redirect()->route('home')->with('success', 'Question Submitted');
    }

    public function viewreply(Question $question)
    {
        return view('questions.reply', [
            'question' => $question
        ]);

    }

    public function reply(Request $request, Question $question)
    {
        $request->validate([
            'reply' => 'nullable|string',
        ]);

        $confirmMail = [
            'question' => $question->question,
            'name' => $question->name,
            'body' => $request->reply,
        ];

        Mail::to($question->email)->send(new QuestionReplyMail($confirmMail));

        $question->update([
            'is_responded' => 1,
            'admin_id' => Auth::guard('admin')->user()->id,
            'answer' => $request->reply,
        ]);

        return redirect()->route('questions.index')->with('success', 'Reply sent');
    }



   
    public function destroy(Question $question)
    {
        $question->delete();

        return redirect()->back()->with('success', 'Question successfully deleted');
    }



    protected function validateQuestion()
    {
        return request()->validate([
            'name' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|string',
            'question' => 'required|string',
            'country_id' => 'required|integer',
        ]);
    }
}
