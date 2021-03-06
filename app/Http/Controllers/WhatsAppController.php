<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Prosval\Services\WhatsAppSender;
use Symfony\Component\Process\Process;

class WhatsAppController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('whats-app.index');
    }

    public function send(Request $request, WhatsAppSender $whatsApp)
    {
        $rules = [
            'phone' => 'required',
            'message' => 'required'
        ];
        $validatedData = $request->validate($rules);

        $validatedData['phone'] = str_replace(' ', '', $validatedData['phone']);

        $whatsApp->setMessage($validatedData['message']);
        $whatsApp->setPhone($validatedData['phone']);

        $result = $whatsApp->send();

        if ($result['success']) {
            // $notification = 'El mensaje fue enviado correctamente.';
            $notification = $result['message'];
            return back()->with(compact('notification'));
        } else {
            return $result['message'];
        }
    }
}
