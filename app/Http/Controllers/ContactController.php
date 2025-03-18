<?php

namespace App\Http\Controllers;

use App\Model\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact()
    {
        return view('website.contact');
    }
    public function index()
    {
        $contacts=Contact::all();
        return view('WebMonitor.contact.index',compact('contacts'));
    }
    public function show($id)
    {
        $Contact = Contact::findOrFail($id);
        return view('WebMonitor.contact.show', ['contact' => $Contact]);
    }

    public function save(Request $request)
    {
        $validated = $request->validate( [
            'name' => 'required|string',
            'email' => 'required|email',
            'subject' => 'required|min:3|max:200',
            'message' => 'required|min:7|max:254',
        ], [
            'name.required'=>'مطلوووووووووووووووووووووب',
            'email.email'=>'خطاء في الايميل',
            'email.required'=>'مطلوووووووووووووووووووووب',
            'subject.required'=>'مطلوووووووووووووووووووووب',
            'message.required'=>'مطلوووووووووووووووووووووب',
        ] );
        Contact::create([
            "name" => $request->name,
            "email" => $request->email,
            "subject" => $request->subject,
            "message" => $request->message,
        ]);
        return redirect()->back()->with('success', "The message was send  successfully  ");
    }

    public function delete($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->back()->with('delete', "The message was deleted  successfully  ");
    }
}


