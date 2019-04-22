<?php

namespace App\Http\Controllers;

use App\Lamparin\Anuncio;
use Illuminate\Http\Request;
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
                } /*else {
                    if ($fieldName == 'id') {
                        $html_campos[] = '<label for="'.$fieldName.'">' . $label . ' >= </label><input type="text" name="'.$fieldName.'">';
                    } elseif ($fieldName == 'fecha_anuncio') {
                        $html_campos[] = '<label for="'.$fieldName.'">' . $label . ' entre </label><input type="text" name="'.$fieldName.'[]" placeholder="formato: AAAA-MM-DD">&nbsp;&nbsp;y&nbsp;&nbsp;<input type="text" name="'.$fieldName.'[]" placeholder="formato: AAAA-MM-DD">';
                    } else {
                        $html_campos[] = '<label for="'.$fieldName.'">' . $label . ' = </label><input type="text" name="'.$fieldName.'">';
                    }
                }*/

                $fields[] = $field;
            }
        }

        // dd($fields);
        return view('scraping.lamparin', compact('fields'));
    }

    private function getOptionsSelect($field='aviso') {
        // 'select distinct '.$p_campo.' as valor from anuncios order by ' . $p_campo
        $options = Anuncio::select($field)->distinct()->orderBy($field)->pluck($field);
        return $options->toArray();
    }

    public function generateDownloadLink(Request $request)
    {
        $parameters = $request->except('_token');

        $query = Anuncio::query();

        foreach ($parameters as $key => $value) {
            if(!in_array($key, $this->stringFields) && !empty($value)){
                if ($key == 'id') {
                    // $campos_where[] = $key." >= ".addslashes($value);
                    $query->where('id', '>=', $value);
                } elseif ($key == 'fecha_anuncio'){
                    if(!empty($value[1])) {
                        // $campos_where[] = $key." between '".addslashes($value[0])." 00:00' and '".addslashes($value[1])." 23:59'";
                        $from = $value[0] . ' 00:00';
                        $to = $value[1] . ' 23:59';
                        $query->whereBetween('fecha_anuncio', [
                            $from, $to
                        ]);
                    }
                } else {
                    // $campos_where[] = $key." = '".addslashes($value)."'";
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

        // $ar = $db->traer(0, $s_where);
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
            // unset($row['copia_tel']);

            $string = implode("@|@", array_values($row->toArray()));

            $string = str_replace("\r", '', $string); // --- replace with empty space
            $string = str_replace("\n", ' ', $string); // --- replace with space
            $string = str_replace("\t", '', $string); // --- replace with space
            $string = str_replace("@|@", "\t", $string); // --- replace with space

            $content .= utf8_decode($string)."\r\n";
        }

        /*
        header("Content-Disposition: attachment; filename=\"anuncios.xls\"");
        header("Content-Type: application/vnd.ms-excel");
        */

        return response($content)->withHeaders([
            'Content-Disposition' => 'attachment; filename="anuncios.xls"',
            'Content-Type' => 'application/vnd.ms-excel'
        ]);
    }
}
