<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InboxMessage extends Model
{
    public function alreadyStored()
    {
        $query = InboxMessage::where('type', $this->type)
            ->where('reference_id', $this->reference_id);

        if ($this->type == 'R')
            $query = $query->where('sent_date', $this->sent_date);

        return $query->exists();
    }

//    public function contact()
//    {
//        return $this->belongsTo(Contact::class, 'destination', 'phone');
//    }
}
