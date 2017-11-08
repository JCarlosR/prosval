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
        $message = new InboxMessage();
        if ($request->has('referencia')) {
            $message->reference_id = $request->input('referencia');
            $message->type = 'C'; // Confirmation
            $message->destination = $request->input('destino');
            $message->status = $request->input('status');
            $message->confirmation_date = Carbon::createFromFormat('YmdHis', $request->input('fecha')); // '20170809230022'
        } else {
            $message->reference_id = $request->input('referenciaid');
            $message->type = 'R'; // Response
            $message->destination = $request->input('destinatario');
            $message->message = $request->input('mensaje');
            $message->response = $request->input('respuesta');
            $message->sent_date = $request->input('fechaenvio');
            $message->received_date = $request->input('fecharespuesta');
        }
        $message->save();

        return "OK";
    }
}
