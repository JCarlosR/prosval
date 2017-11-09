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
        $inboxMessages = InboxMessage::where('type', 'R')->where('destination', $destination)->get([
            'reference_id', 'message', 'response', 'sent_date', 'received_date'
        ]);

        $last_reference_id = null;
        $messages = collect();

        foreach ($inboxMessages as $inboxMessage) {
            // print_r($message->reference_id);
            // echo '<br>';
            $message = [];
            if ($last_reference_id != $inboxMessage->reference_id) {
                $last_reference_id = $inboxMessage->reference_id;
                $message['content'] = $inboxMessage->message;
                $message['date'] = $inboxMessage->sent_date;
                $message['admin_chat'] = true;
                $messages->push($message);
                $message = [];
                // print_r($inboxMessage->message);
                // print_r($inboxMessage->sent_date);
                // echo '<br>';
            }
            $message['content'] = $inboxMessage->response;
            $message['date'] = $inboxMessage->received_date;
            $message['admin_chat'] = false;
            $messages->push($message);
            // print_r($inboxMessage->response);
            // print_r($inboxMessage->received_date);
            // echo '<br><br>';
        }
        // dd($messages);

        return view('inbox')->with(compact('contacts', 'selected_contact', 'messages'));
    }

    public function sendMessage(Request $request)
    {
        $phone = $request->input('destination_phone');
        $message = $request->input('new_message');
        $response = sendSms($phone, $message);

        $now = Carbon::now();
        if ($response->estatus == 'ok') {
            $notification = "Se envió satisfactoriamente un SMS a $phone a las $now";
        } else {
            $errorCode = $response->mensaje;
            $notification = "No se pudo enviar un SMS a $phone a las $now ($errorCode)";
        }

        return back()->with(compact('notification'));
    }
}
