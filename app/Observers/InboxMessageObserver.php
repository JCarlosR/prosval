<?php

use App\Contact;
use App\InboxMessage;

class InboxMessageObserver
{
    public function saved(InboxMessage $message)
    {
        // update to not read when client responses
        if ($message->type == 'R') {
            Contact::where('phone', substr($message->destination, 2))
                ->update(['last_message_read' => false]);
        }
    }
}