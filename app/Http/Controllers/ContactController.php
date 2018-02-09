<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Municipality;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function data()
    {
        $municipalities = Municipality::all();
        $contacts = Contact::where('spam', false)->with('colony')->paginate(20);
        return view('contact.data')->with(compact('municipalities', 'contacts'));
    }

    public function spam()
    {
        $contacts = Contact::where('spam', true)->get();
        return view('contact.spam')->with(compact('contacts'));
    }

    public function store(Request $request)
    {
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->phone = str_replace(' ', '', $request->phone);
        $contact->email = $request->email;
        $contact->type = $request->type;
        $contact->colony_id = $request->colony_id;
        $contact->link = $request->link;
        $contact->save();

        $notification = 'El contacto se ha registrado correctamente.';
        return back()->with(compact('notification'));
    }

    public function update(Request $request)
    {
        $contact = Contact::find($request->contact_id);
        $contact->name = $request->name;
        $contact->phone = str_replace(' ', '', $request->phone);
        $contact->email = $request->email;
        $contact->type = $request->type;
        $contact->colony_id = $request->colony_id;
        $contact->link = $request->link;
        $contact->save();

        $notification = 'La información del contacto se ha actualizado.';
        return back()->with(compact('notification'));
    }

    public function updateSpam(Request $request)
    {
        $contact = Contact::find($request->contact_id);
        $contact->name = $request->name;
        $contact->phone = $request->phone;
        $contact->save();

        $notification = 'La información del contacto se ha actualizado.';
        return back()->with(compact('notification'));
    }

    public function markAsSpam(Contact $contact)
    {
        $contact->spam = true;
        $contact->save();

        $notification = 'El contacto seleccionado se ha marcado como spam.';
        return back()->with(compact('notification'));
    }

    public function markAsActive(Contact $contact)
    {
        $contact->spam = false;
        $contact->save();

        $notification = 'El contacto seleccionado se ha marcado como un contacto válido.';
        return back()->with(compact('notification'));
    }
}
