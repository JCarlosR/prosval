<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use SoftDeletes;

    public function details()
    {
        return $this->hasMany(CampaignDetail::class);
    }

    public function getNextScheduleDateAttribute()
    {
        if ($this->status == 'Pendiente')
            return '-'; // it has to be 'Programado' to start sending SMS messages

        $nextDetail = $this->details()->where('status', 'Pendiente')->orderBy('schedule_date')->first();

        if ($nextDetail)
            return $nextDetail->schedule_date;

        return '-';
    }
}
