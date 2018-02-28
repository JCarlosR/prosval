<?php

namespace App\Http\Controllers;

use App\Contact;
use App\InboxMessage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class InboxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // $contacts = Contact::where('spam', false)->get();

        // DB::enableQueryLog();
        $lastMessages = InboxMessage::orderBy('id', 'desc')
            ->orderBy('destination')->distinct('destination')
            ->pluck('destination');
        // dd(DB::getQueryLog());

        $lastMessages = $lastMessages->map(function ($destination) {
            return substr($destination, 2);
        });

        // dd($lastMessages);
        $lastMessagesImploded = implode(',', $lastMessages->toArray());

        $contacts = Contact::where('spam', false)
            ->whereIn('phone', $lastMessages)
            ->groupBy('phone')->distinct('phone')
            ->orderBy('updated_at', 'desc')
            ->orderByRaw(DB::raw("FIELD(phone, $lastMessagesImploded)"))
            ->get();
        // dd($contacts);

        if ($request->has('contact')) {
            $selectedContact = $contacts->where('id', $request->input('contact'))->first();
        } else {
            $selectedContact = $contacts->first();
        }
        $messages = $this->getStructuredInboxMessages($selectedContact);

        return view('inbox')->with(compact('contacts', 'selectedContact', 'messages'));
    }

    private function getStructuredInboxMessages(Contact $contact)
    {
        // messages to show in the box
        $destination = '52' . $contact->phone; // prepend country code
        $inboxMessages = InboxMessage::where('destination', $destination)->get([
            'reference_id', 'message', 'response', 'sent_date', 'received_date', 'confirmation_date', 'type'
        ]);

        // re-structure messages to easily show in the view
        $messages = collect();
        // dd($inboxMessages->toArray());
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
                $message['confirmed'] =  $inboxMessage->status == 0;
            }

            if ($message['content'] != '')
                $messages->push($message);
        }
        return $messages;
    }

    public function renderInboxMessages(Contact $contact)
    {
        $messages = $this->getStructuredInboxMessages($contact);

        $contact->last_message_read = true;
        $contact->save();

        try {
            return view('inbox.message_section', [
                'messages' => $messages,
                'selectedContact' => $contact // param route name
            ])->render();
        } catch (Throwable $e) {
            return null;
        }
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

            if (! $inboxMessage->alreadyStored()) {
                $inboxMessage->destination = "52$phone";
                $inboxMessage->status = null; // Have to wait for the callback for real confirmation
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

}
