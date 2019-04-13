<?php

namespace App\Http\Controllers;

use App\Lamparin\Anuncio;
use Illuminate\Http\Request;

class ScrapingController extends Controller
{
    protected $stringFields = [
        'colonia', 'copia_tel', 'titulo', 'descripcion', 'precio1', 'precio2', 'vendedor', 'telefono', 'email', 'codigo_postal', 'imagen', 'link', 'link_compartir', 'fecha_nro', 'fecha_carga', 'sku'
    ];

    public function lamparin()
    {
        // $ar = $db->traer_campos();
        $ar = [
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

        foreach ($ar as $k=>$v) {
            if (!in_array($v, $this->stringFields)) {
                if (in_array($v, $combos)){
                    $combo = '<select name="'.$v.'">';
                    $combo .= $this->traer_datos_combo($v);
                    $combo .= '</select>';
                    $html_campos[] = '<label for="'.$v.'">'.ucwords(str_replace('_', ' ', $v)).' = </label>'.$combo;
                } else {
                    if ($v == 'id') {
                        $html_campos[] = '<label for="'.$v.'">'.ucwords(str_replace('_', ' ', $v)).' >= </label><input type="text" name="'.$v.'">';
                    } elseif ($v == 'fecha_anuncio') {
                        $html_campos[] = '<label for="'.$v.'">'.ucwords(str_replace('_', ' ', $v)).' entre </label><input type="text" name="'.$v.'[]" placeholder="formato: AAAA-MM-DD">&nbsp;&nbsp;y&nbsp;&nbsp;<input type="text" name="'.$v.'[]" placeholder="formato: AAAA-MM-DD">';
                    } else {
                        $html_campos[] = '<label for="'.$v.'">'.ucwords(str_replace('_', ' ', $v)).' = </label><input type="text" name="'.$v.'">';
                    }
                }
            }
        }

        return view('scraping.lamparin', compact('html_campos'));
    }

    private function traer_datos_combo($field='aviso') {
        // $sql = 'select distinct '.$p_campo.' as valor from anuncios order by '.$p_campo;
        $results = Anuncio::select($field)->distinct()->orderBy($field)->pluck($field);

        $options[] = '<option value="">-- Seleccione una opcion --</option>';
        foreach ($results as $value) {
            // $valor = $row['valor'];
            $options[] = '<option value="'.$value.'">'.$value.'</option>';
        }

        return implode('', $options);
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
