<?php namespace App\Observers;

use App\Contact;
use App\InboxMessage;
use Illuminate\Support\Facades\Log;

class InboxMessageObserver
{
    public function saved(InboxMessage $message)
    {
        // Log::info('saved event fired');

        // update to not read when client responses
        if ($message->type == 'R') {
            /*$updated = */Contact::where('phone', substr($message->destination, 2))
                ->update(['last_message_read' => false]);
            // Log::info($updated);
        }
    }
}