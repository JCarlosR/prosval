<?php

namespace App\Console\Commands;

use App\Campaign;
use App\CampaignDetail;
use App\Contact;
use App\InboxMessage;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendManualCampaignDetails extends Command
{

    protected $signature = 'campaigns:send';

    protected $description = 'Send message (SMS or WhatsApp) depending on the details of the active campaigns.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $campaigns = Campaign::where('status', 'Programado')->get();

        foreach ($campaigns as $campaign) {
            // messages to send
            $details = $campaign->details()->where('status', 'Pendiente')->get();
            // dd($details);

            foreach ($details as $detail) {
                $now = Carbon::now();
                $schedule_date_time = new Carbon($detail->schedule_date. ' ' . $detail->schedule_time);

                // dd($now->diffInMinutes($schedule_date_time));

                if ($now->diffInMinutes($schedule_date_time) < 2) {
                   $this->deliverMessage($detail);
                }
            }

            if (! $campaign->details()->where('status', 'Pendiente')->exists()) {
                $campaign->status = 'Finalizado';
                $campaign->save();
            }
        }
    }

    private function deliverMessage(CampaignDetail $detail, $type='SMS')
    {
        if ($type === 'SMS')
            $this->sendSmsMessage($detail);
        elseif ($type === 'WhatsApp')
            $this->sendWhatsAppMessage($detail);
    }

    private function sendSmsMessage(CampaignDetail $detail)
    {
        // prepare message
        $message = $detail->getPreparedMessage();
        $phone = $detail->phone;

        $response = sendSms($phone, $message);

        $now = Carbon::now();

        // handle sms api response
        if ($response->estatus == 'ok') {
            $detail->status = 'Enviado';
            $this->info("Envió satisfactorio: SMS a $phone, a las $now");

            // register
            $inboxMessage = new InboxMessage();
            $inboxMessage->reference_id = $response->referencia;
            $inboxMessage->type = 'C'; // Confirmed sent message

            if (! $inboxMessage->alreadyStored()) {
                $inboxMessage->destination = "52$phone";
                $inboxMessage->status = null; // it has to wait for the callback (for real confirmation)
                $inboxMessage->message = $message;
                $inboxMessage->confirmation_date = $now;
                $inboxMessage->save();
            }
        } else {
            $errorCode = $response->mensaje;
            $detail->status = "Error ($errorCode)";
            $this->info("Envío fallido: SMS a $phone, a las $now ($errorCode)");
        }
        $saved = $detail->save();

        if ($saved) {
            // register new contact
            $detail->saveAsNewContactIfNotExists();
        }
    }

    private function sendWhatsAppMessage(CampaignDetail $detail)
    {

    }
}
