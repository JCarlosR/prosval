<?php

namespace Prosval\Services;

use Symfony\Component\Process\Process;

class WhatsAppSender
{
    private $message;
    private $phone;
    private $scriptPath;
    private $python;

    public function __construct()
    {
        // windows example: 'D:\Python\WhatsAppBot\to_arguments.py'
        // linux example: "/var/www/WhatsAppBot/to_arguments.py"
        $this->scriptPath = env('PYTHON_SCRIPT_PATH', 'D:\Python\WhatsAppBot\to_arguments.py');

        // the command is python3 in some installations
        $this->python = env('PYTHON_COMMAND', 'python');
    }

    public function setMessage($inputMessage)
    {
        $this->message = '"'. $inputMessage . '"';
    }

    public function setPhone($inputPhone, $countryCode='52')
    {
        $this->phone = $countryCode . $inputPhone;
    }

    public function send()
    {
        $process = new Process("$this->python $this->scriptPath -m $this->message -p $this->phone");

        $process->run();
        // $process->start();

        $success = $process->isSuccessful();

        if ($success) {
            $message = $process->getOutput();
        } else {
            $message = $process->getErrorOutput();
        }

        return compact('success', 'message');
    }
}