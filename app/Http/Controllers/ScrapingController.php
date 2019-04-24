<?php

namespace App\Http\Controllers;

use App\Lamparin\Anuncio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use stdClass;

class ScrapingController extends Controller
{
    protected $stringFields = [
        'colonia', 'copia_tel', 'titulo', 'descripcion', 'precio1', 'precio2', 'vendedor', 'telefono', 'email', 'codigo_postal', 'imagen', 'link', 'link_compartir', 'fecha_nro', 'fecha_carga', 'sku'
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function lamparin()
    {
        // $fields = $db->traer_campos();
        $fieldNames = [
            'aviso',
            'tipo',
            'categoria',
            'titulo',
            'descripcion',
            'habitaciones',
            'superficie',
            'moneda1',
            'precio1',
            'moneda2',
            'precio2',
            'vendedor',
            'telefono',
            'email',
            'region',
            'municipio',
            'colonia',
            'codigo_postal',
            'imagen',
            'fecha_anuncio',
            'link',
            'link_compartir',
            'fecha_nro',
            'fecha_carga',
            'sitio',
            'sku',
            'id',
        ];

        $combos = [
            'aviso', 'tipo', 'categoria', 'moneda1', 'moneda2', 'region', 'municipio', 'colonia', 'sitio'
        ];

        $fields = [];

        foreach ($fieldNames as $fieldName) {
            if (!in_array($fieldName, $this->stringFields)) {
                $field = new stdClass();
                $field->name = $fieldName;
                $field->label = ucwords(str_replace('_', ' ', $fieldName));
                $field->is_select = in_array($fieldName, $combos);

                if ($field->is_select) {
                    $field->options = $this->getOptionsSelect($fieldName);

                    /*
                    if ($field->name == 'categoria')
                        dd($field->options);
                    */
                }

                $fields[] = $field;
            }
        }

        // dd($fields);
        return view('scraping.lamparin', compact('fields'));
    }

    private function getOptionsSelect($field='aviso') {
        $minute = 60;
        $hour = 60 * $minute;

        $options = Cache::remember("lamparin_select_options_$field", 24 * $hour, function () use ($field) {
            // select distinct $field from anuncios
            return Anuncio::select($field)
                ->whereNotNull($field)->where($field, '<>', ' ') // avoid empty values for options
                ->distinct()
                ->orderBy($field)->pluck($field);
        });

        return $options->toArray();
    }

    public function generateDownloadLink(Request $request)
    {
        $parameters = $request->except('_token');

        $query = Anuncio::query();

        foreach ($parameters as $key => $value) {
            if(!in_array($key, $this->stringFields) && !empty($value)){
                if ($key == 'id') {
                    // >=
                    $query->where('id', '>=', $value);
                } elseif ($key == 'fecha_anuncio'){
                    if(!empty($value[1])) {
                        // between $value[0] and $value[1]
                        $from = $value[0] . ' 00:00';
                        $to = $value[1] . ' 23:59';
                        $query->whereBetween('fecha_anuncio', [
                            $from, $to
                        ]);
                    }
                } else {
                    // =
                    $query->where($key, $value);
                }
            }
        }
        // $s_where = implode(' and ', $campos_where);

        return $this->exportExcel($query);
    }

    private function exportExcel($query)
    {
        /*
        $s_where = $request->input('conditions');

        if (empty($s_where)) {
            $notification = 'No se indicaron las condiciones de búsqueda.';
            return back()->with(compact('notification'));
        }
        // dd($s_where);
        */

        $results = $query->get();

        if ($results->count() == 0) {
            $notification = 'No se encontraron datos.';
            return back()->with(compact('notification'));
        }

        // dd($results->count());

        $modelArray = $results->first()->toArray();
        $content = implode("\t", array_keys($modelArray)) . "\r\n";
        // dd($content);

        foreach ($results as $key => $row) {
            $string = implode("@|@", array_values($row->toArray()));

            // replace special characters
            $string = str_replace("\r", '', $string);
            $string = str_replace("\n", ' ', $string);
            $string = str_replace("\t", '', $string);
            $string = str_replace("@|@", "\t", $string);

            $content .= utf8_decode($string)."\r\n";
        }

        return response($content)->withHeaders([
            'Content-Disposition' => 'attachment; filename="anuncios.xls"',
            'Content-Type' => 'application/vnd.ms-excel'
        ]);
    }
}
