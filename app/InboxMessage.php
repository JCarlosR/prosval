<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InboxMessage extends Model
{
    public function alreadyStored()
    {
        return InboxMessage::where('type', $this->type)
            ->where('reference_id', $this->reference)->exists();
    }

//    public function contact()
//    {
//        return $this->belongsTo(Contact::class, 'destination', 'phone');
//    }
}
