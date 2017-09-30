<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    public function colonies()
    {
        return $this->hasMany(Colony::class);
    }
}
