<?php

namespace App\Http\Controllers;

use App\Colony;
use App\Municipality;
use App\Region;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function import()
    {
        $path = public_path('Libro1.csv');
        $lines = file($path);
        $utf8_lines = array_map('utf8_encode', $lines);
        $array = array_map('str_getcsv', $utf8_lines);

        for ($i=1; $i<sizeof($array); ++$i) {
            $colony = new Colony();
            $colony->name = $array[$i][2];
            $colony->postal_code = $array[$i][3];
            $colony->municipality_id = $this->getMunicipalityId($array[$i][0], $array[$i][1]);
            $colony->save();
        }
    }

    public function getMunicipalityId($regionName, $municipalityName)
    {
        $municipality = Municipality::where('name', $municipalityName)->first();
        if ($municipality) {
            return $municipality->id;
        }

        $municipality = new Municipality();
        $municipality->name = $municipalityName;
        $region = Region::firstOrCreate([
            'name' => $regionName
        ]);
        $municipality->region_id = $region->id;
        $municipality->save(); // insert

        return $municipality->id;
    }

}
