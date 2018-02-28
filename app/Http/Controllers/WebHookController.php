<?php

namespace App\Http\Controllers;

use App\InboxMessage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebHookController extends Controller
{
    public function webHook(Request $request)
    {
        Log::info($request->all());

        if ($request->has('referencia')) {
            $message = new InboxMessage();
            $message->reference_id = $request->input('referencia');
            $message->type = 'C'; // Confirmation

            // used only for update status
            if ($message->alreadyStored()) {
                $message = InboxMessage::where('type', 'C')->where('reference_id', $message->reference_id)->first();
                $message->destination = $request->input('destino');
                $message->status = $request->input('status');
                $message->confirmation_date = Carbon::createFromFormat('YmdHis', $request->input('fecha')); // '20170809230022'
                $message->save();
            }
        } elseif ($request->has('referenciaid')) {
            $message = new InboxMessage();
            $message->reference_id = $request->input('referenciaid');
            $message->received_date = $request->input('fecharespuesta');
            $message->type = 'R'; // Response

            if (! $message->alreadyStored()) {
                $message->destination = $request->input('destinatario');
                $message->message = $request->input('mensaje');
                $message->response = $request->input('respuesta');
                $message->sent_date = $request->input('fechaenvio');
                $message->save();
            }
        }

        return "OK";
    }

    public function alreadyStored($reference, $type) {
        return InboxMessage::where('type', $type)->where('reference_id', $reference)->exists();
    }

}
