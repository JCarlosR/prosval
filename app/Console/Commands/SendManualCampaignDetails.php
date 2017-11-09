<?php

namespace App\Console\Commands;

use App\Campaign;
use App\CampaignDetail;
use App\Contact;
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
                $campaign->save();
            }
        }
    }

    public function sendSmsAndMarkAsDelivered(CampaignDetail $detail)
    {
        $message = $detail->message;
        $message  = str_replace(" ", "%20", $message);

        $response = sendSms($detail->phone, $message);

        $now = Carbon::now();
        if ($response->estatus == 'ok') {
            $detail->status = 'Enviado';
            $this->info("Se envió satisfactoriamente un SMS a $phone a las $now");
        } else {
            $errorCode = $response->mensaje;
            $detail->status = "Error ($errorCode)";
            $this->info("No se pudo enviar un SMS a $phone a las $now ($errorCode)");
        }
        $saved = $detail->save();

        if ($saved) {
            // register new contact (if still not exists)
            if (Contact::where('phone', $detail->phone)->exists() == false) {
                $contact = new Contact();
                $contact->name = $detail->name;
                $contact->phone = $detail->phone;
                $contact->email = null;
                $contact->type = 'Generado luego de envío';
                $contact->link = $detail->link;
                $contact->colony_id = null;
                $contact->save();
            }
        }
    }
}
