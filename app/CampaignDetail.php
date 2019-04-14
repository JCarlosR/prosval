<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignDetail extends Model
{
    public function getPreparedMessage()
    {
        $message = $this->message;
        $message  = str_replace("{nombre}", $this->name, $message);
        $message  = str_replace("{propiedad}", $this->property, $message);
        return $message;
    }

    public function getPreparedPhone()
    {
        // clear spaces in phone number
        return str_replace(' ', '', $this->phone);
    }

    public function saveAsNewContactIfNotExists()
    {
        $contactNotExists = !Contact::where('phone', $this->phone)->exists();

        if ($contactNotExists) {
            $contact = new Contact();
            $contact->name = $this->name;
            $contact->phone = $this->phone;
            $contact->email = null;
            $contact->type = "Generado luego de envío";
            $contact->link = $this->link;
            $contact->colony_id = null;

            $contact->save();
        }
    }
}
