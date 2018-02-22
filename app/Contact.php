<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['last_message_read'];

    public function colony()
    {
        return $this->belongsTo(Colony::class);
    }

    public function getPhoneFormattedAttribute()
    {
        $phone = substr_replace($this->phone, ' ', 2, 0);
        $phone = substr_replace($phone, ' ', 7, 0);
        return $phone;
    }


}
