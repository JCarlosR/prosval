<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\CampaignDetail;
use App\Contact;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class CampaignController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function manual()
    {
        return view('campaign.create-manual');
    }

    public function store(Request $request)
    {
        $campaign = new Campaign();
        $campaign->name = $request->name;
        $campaign->status = 'Pendiente';
        $campaign->type = $request->type;
        $campaign->save();
        return redirect('/campaigns/edit/'.$campaign->id);
    }

    public function edit(Campaign $campaign)
    {
        $contacts = Contact::all(['name', 'phone'])->all();
        foreach ($contacts as $key => $contact) {
            $contacts[$key] = $contact->name . ' (' . $contact->phone . ')';
        }
        $contacts = json_encode($contacts);
        return view('campaign.edit-manual')->with(compact('campaign', 'contacts'));
    }

    public function automatic()
    {
        return view('campaign.automatic');
    }

    public function index()
    {
        $campaigns = Campaign::all();
        return view('campaign.index')->with(compact('campaigns'));
    }

    public function status(Campaign $campaign, Request $request)
    {
        if ($request->has('status')) {
            $campaign->status = $request->input('status');
            $saved = $campaign->save();

            if ($saved)
                $notification = 'Se ha modificado el estado de la campaña '.$campaign->name.' a '.$campaign->status.'.';
            return redirect('/campaigns')->with(compact('notification'));
        }

        return redirect('/campaigns');
    }

    public function upload(Request $request, Campaign $campaign)
    {
        $rules = [
            'csv' => 'required|mimes:csv,txt'
        ];
        $messages = [
            'csv.mimes' => 'Los datos se deben cargar a través de un archivo CSV.'
        ];
        $this->validate($request, $rules, $messages);
        // dd($request->all());

        $file = $request->file('csv');
        $contents = file_get_contents($file);
        $contents = str_replace("\r\n", "\r", $contents);
        $lines = explode("\r", $contents);
        // file function doesn't work for \r only (Mac case)
        // only works for \r\n EOL
        // dd($lines);
        $utf8_lines = array_map('utf8_encode', $lines);
        // dd($utf8_lines);
        $rows = array_map('str_getcsv', $utf8_lines);
        // dd($rows);
        $errors = [];
        $details = collect();

        foreach ($rows as $key => $item) {
            $row = $key +1;

            $schedule_date = $item[0];
            $schedule_time = $item[1];
            $name = $item[2];
            $phone = $item[3];
            $message = $item[4];

            if (isset($item[5]))
                $property = $item[5];
            else $property = null;

            if (isset($item[6]))
                $link = $item[6];
            else $link = null;

            // validate date
            try {
                $errorDate = "El formato de fecha debe ser dd/mm/yyyy en la fila $row.";
                list($d,$m,$y) = explode('/', $schedule_date);
                if (! checkdate($m,$d,$y)) {
                    $errors[] = $errorDate;
                    continue;
                }
            } catch (Exception $e) {
                $errors[] = $errorDate;
                continue;
            }

            // validate time
            if (! preg_match("/(2[0-3]|[01][0-9]):([0-5][0-9])/", $schedule_time)) {
                $errors[] = "El formato de la hora debe ser hh:mm considerando 24 horas, en la fila $row.";
                continue;
            }

            // name
            if ($name && substr_count($name, ' ')>2) {
                $errors[] = "Se admiten como máximo 3 palabras para el nombre. Revisar la fila $row.";
                continue;
            }

            // phone
            if (!$phone) {
                $errors[] = "No se ha ingresado un teléfono para la fila $row.";
                continue;
            }
            if (strlen($phone)!=8 && strlen($phone)!=10) {
                $errors[] = "Fila $row: El teléfono debe tener 8 dígitos, o tener 10 y empezar con 55.";
                continue;
            }
            if (strlen($phone)==8) {
                $phone = "55$phone";
            } else if (strlen($phone)==10 && substr($phone, 0, 2) != "55") {
                $errors[] = "Fila $row: El teléfono debe empezar con 55.";
                continue;
            }

            // property
            if ($property && strlen($property)>255) {
                $errors[] = "Fila $row: La propiedad no debe exceder los 255 caracteres.";
                continue;
            }

            // message
            if (strlen($message) < 10) {
                $errors[] = "Fila $row: El mensaje ingresado es demasiado corto.";
                continue;
            }
            if (strpos($message, '{nombre}') !== false && !$name) { // if found
                $errors[] = "Fila $row: El mensaje hace uso de la variable nombre, pero no se ha definido ningún nombre.";
                continue;
            }
            if (strpos($message, '{propiedad}') !== false && !$property) { // if found
                $errors[] = "Fila $row: El mensaje hace uso de la variable propiedad, pero no se ha definido ninguna propiedad.";
                continue;
            }
            $final_message = str_replace("{nombre}", $name, $message);
            $final_message = str_replace("{propiedad}", $property, $final_message);
            if (strlen($final_message) > 150) {
                $errors[] = "Fila $row: El mensaje es muy extenso (>150 caracteres) luego de reemplazar las variables.";
                continue;
            }

            // link
            if ($link && substr($link, 0, 4)!="http") {
                $errors[] = "Fila $row: Todo enlace debe empezar con http o https.";
                continue;
            }

            // replace non-existent name
            if (!$name) {
                $name = 'SinNom' . date('dmY');
            }

            $detail = new CampaignDetail();
            $detail->campaign_id = $campaign->id;
            $detail->schedule_date = Carbon::createFromFormat('d/m/Y', $schedule_date);
            $detail->schedule_time = $schedule_time;
            $detail->name = $name;
            $detail->phone = $phone;
            $detail->message = $message;
            $detail->property = $property;
            $detail->link = $link;
            $detail->status = 'Pendiente';
            $details->push($detail);
        }

        if (sizeof($errors) > 0) {
            return back()->withInput($request->input())
                ->withErrors($errors);
        }

        // if no errors
        foreach ($details as $detail) {
            $detail->save();
        }

        $n = sizeof($details);
        $notification = "Se han importado exitosamente $n destinatarios.";
        return back()->with(compact('notification'));
    }

    public function destroy(Campaign $campaign)
    {
        try {
            $campaign->delete();
            $notification = 'La campaña seleccionada se ha eliminado correctamente.';
            return back()->with(compact('notification'));
        } catch (Exception $e) {
            $notification = 'Ha ocurrido un error al eliminar la campaña.';
            return back()->with(compact('notification'));
        }
    }

}
