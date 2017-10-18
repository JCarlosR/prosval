<?php

namespace App\Console\Commands;

use App\Campaign;
use App\CampaignDetail;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendManualCampaignDetails extends Command
{

    protected $signature = 'details:send';

    protected $description = 'Check and send the proper campaign details SMS';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $campaigns = Campaign::where('status', 'Programado')->get();
        foreach ($campaigns as $campaign) {
            $details = $campaign->details()->where('status', 'Pendiente')->get();
            // dd($details);
            foreach ($details as $detail) {
                $schedule_date_time = new Carbon($detail->schedule_date. ' ' . $detail->schedule_time);
                // dd($schedule_date_time);
                $now = Carbon::now();
                // dd($now->diffInMinutes($schedule_date_time));
                if ($now->diffInMinutes($schedule_date_time) < 2) {
                   $this->sendSmsAndMarkAsDelivered($detail);
                }
            }

            if (! $campaign->details()->where('status', 'Pendiente')->exists()) {
                $campaign->status = 'Finalizado';
                $campaigns->save();
            }
        }
    }

    public function sendSmsAndMarkAsDelivered(CampaignDetail $detail)
    {
        $message = $detail->message;
        $message  = str_replace(" ", "%20", $message);
        $phone  =  str_replace(' ', '', $detail->phone); // clear spaces in phone number

        $fields = [
            "apikey" => env('SMS_API_KEY'),
            "mensaje" => $message,
            "numcelular" => $phone,
            "numregion" => "52"
        ];
        $options = [
            CURLOPT_URL => "http://smsmasivos.com.mx/sms/api.envio.new.php",
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_POSTFIELDS => $fields
        ];
        curl_setopt_array($ch = curl_init(), $options);

        $response = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($response);

        $now = Carbon::now();
        if ($response['estatus'] == 'ok') {
            $detail->status = 'Enviado';
            $this->info("Se envió satisfactoriamente un SMS a $phone a las $now");
        } else {
            $errorCode = $response['mensaje'];
            $detail->status = "Error ($errorCode)";
            $this->info("No se pudo enviar un SMS a $phone a las $now ($errorCode)");
        }
        $detail->save();
    }
}
