<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:contacts,email',
            'phone' => 'required|max:20',
            'country' => 'required|max:255',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
        ],[
            'name.required' => 'Please Enter Your name',
            'email.required' => 'Please Enter Your Email',
            'phone.required' => 'Please Enter Your phone',
            'country.required' => 'Please Enter Your country',
            'city.required' => 'Please Enter Your city',
            'state.required' => 'Please Enter Your state',
        ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        

        Contact::create($validatedData);

        return redirect()->route('contacts.index')->with('success', 'Details created successfully.');
    }

    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:contacts,email',
            'phone' => 'required|max:20',
            'country' => 'required|max:255',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
        ],[
            'name.required' => 'Please Enter Your name',
            'email.required' => 'Please Enter Your Email',
            'phone.required' => 'Please Enter Your phone',
            'country.required' => 'Please Enter Your country',
            'city.required' => 'Please Enter Your city',
            'state.required' => 'Please Enter Your state',
        ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        

        $contact->update($validatedData);

        return redirect()->route('contacts.index')->with('success', 'Details updated successfully.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Details deleted successfully.');
    }
}
