<?php

namespace App\Console\Commands;

use App\Campaign;
use App\CampaignDetail;
use App\Contact;
use App\InboxMessage;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Prosval\Services\WhatsAppSender;

class SendManualCampaignDetails extends Command
{

    protected $signature = 'campaigns:send';
    protected $description = 'Send message (SMS or WhatsApp) depending on the details of the active campaigns.';

    protected $whatsApp;

    public function __construct(WhatsAppSender $whatsAppSender)
    {
        parent::__construct();

        $this->whatsApp = $whatsAppSender;
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
        // prepare message and phone
        $message = $detail->getPreparedMessage();
        $phone = $detail->getPreparedPhone();

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
            $errorMessage = $response->mensaje;

            $detail->response = $errorMessage;
            $detail->status = "Error SMS";

            $this->info("Envío fallido: SMS a $phone, a las $now ($errorMessage)");
        }

        $saved = $detail->save();

        if ($saved) {
            // register new contact
            $detail->saveAsNewContactIfNotExists();
        }
    }

    private function sendWhatsAppMessage(CampaignDetail $detail)
    {
        // prepare and set message and phone
        $message = $detail->getPreparedMessage();
        $this->whatsApp->setMessage($message);

        $phone = $detail->getPreparedPhone();
        $this->whatsApp->setPhone($phone);

        $now = Carbon::now();

        $result = $this->whatsApp->send();

        // handle response
        if ($result['success']) {
            $detail->status = 'Enviado';

            $this->info("Envió satisfactorio: WhatsApp a $phone, a las $now");

            // register
            /*
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
            */
        } else {
            $detail->status = "Error WhatsApp";

            $errorMessage = $result['message'];
            $this->info("Envío fallido: SMS a $phone, a las $now ($errorMessage)");
        }

        $detail->response = $result['message'];
        $saved = $detail->save();

        if ($saved) {
            // register new contact
            $detail->saveAsNewContactIfNotExists();
        }
    }
}
