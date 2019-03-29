<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function send(Request $request)
    {
        $rules = [
            'phone' => 'required',
            'message' => 'required'
        ];
        $validatedData = $request->validate($rules);
        // dd($validatedData);

        $message = '"'. $validatedData['message'] . '"';
        $phone = $validatedData['phone'];

        $filePath = 'D:\Python\WhatsAppBot\to_arguments.py';

        $process = new Process("python $filePath -m $message -p $phone");

        $process->run();
        // $process->start();


        if ($process->isSuccessful())
            dd($process->getOutput());
        else
            dd($process->getErrorOutput());
    }
}
