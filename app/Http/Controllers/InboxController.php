<?php

namespace App\Http\Controllers;

use App\Contact;
use App\InboxMessage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $contacts = Contact::where('spam', false)->get();

        if ($request->has('contact')) {
            $selected_contact = $contacts->where('id', $request->input('contact'))->first();
        } else {
            $selected_contact = $contacts->first();
        }

        $destination = '52' . str_replace(' ', '', $selected_contact->phone); // prepend country code
        $inboxMessages = InboxMessage::where('destination', $destination)->get([
            'reference_id', 'message', 'response', 'sent_date', 'received_date', 'confirmation_date', 'type'
        ]);
        // dd($inboxMessages);

        $messages = collect();

        foreach ($inboxMessages as $inboxMessage) {
            // print_r($message->reference_id);
            // echo '<br>';
            $message = [];
            if ($inboxMessage->type == 'R') {
                $message['content'] = $inboxMessage->response;
                $message['date'] = $inboxMessage->received_date;
                $message['admin_chat'] = false;
            } elseif ($inboxMessage->type == 'C') {
                $message['content'] = $inboxMessage->message;
                $message['date'] = $inboxMessage->confirmation_date;
                $message['admin_chat'] = true;
            }
            if ($message['content'] != '')
                $messages->push($message);
        }
        // dd($messages);

        return view('inbox')->with(compact('contacts', 'selected_contact', 'messages'));
    }

    public function sendMessage(Request $request)
    {
        $phone = $request->input('destination_phone');
        $phone  =  str_replace(' ', '', $phone); // clear spaces in phone number
        $message = $request->input('new_message');

        $response = sendSms($phone, $message);

        $now = Carbon::now();
        if ($response->estatus == 'ok') {
            $notification = "Se envió satisfactoriamente un SMS a $phone a las $now";

            // register
            $inboxMessage = new InboxMessage();
            $inboxMessage->reference_id = $response->referencia;
            $inboxMessage->type = 'C'; // Confirmed sent message

            if (! $this->alreadyStored($inboxMessage->reference_id, $inboxMessage->type)) {
                $inboxMessage->destination = "52$phone";
                $inboxMessage->status = 0; // Entregado
                $inboxMessage->message = $message;
                $inboxMessage->confirmation_date = Carbon::now();
                $inboxMessage->save();
            }
        } else {
            $errorCode = $response->mensaje;
            $notification = "No se pudo enviar un SMS a $phone a las $now ($errorCode)";
        }

        return back()->with(compact('notification'));
    }

    public function alreadyStored($reference, $type) {
        return InboxMessage::where('type', $type)->where('reference_id', $reference)->exists();
    }
}
