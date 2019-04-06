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

        // windows example: 'D:\Python\WhatsAppBot\to_arguments.py'
        // linux example: 'D:\Python\WhatsAppBot\to_arguments.py'
        $filePath = env('PYTHON_SCRIPT_PATH', 'D:\Python\WhatsAppBot\to_arguments.py');

        // PHP_OS could be 'Linux' or 'WINNT' (Windows)

        // the command is python3 in some installations
        $python = env('PYTHON_COMMAND', 'python');
        $process = new Process("$python $filePath -m $message -p $phone");

        $process->run();
        // $process->start();


        if ($process->isSuccessful()) {
            // $notification = 'El mensaje fue enviado correctamente.';
            $notification = $process->getOutput();
            return view('whats-app.index')->with(compact('notification'));
        } else
            dd($process->getErrorOutput());
    }
}
