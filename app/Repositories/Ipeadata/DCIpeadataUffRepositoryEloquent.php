<?php


namespace App\Repositories\Ipeadata;

use App\Models\Ipeadata\DCIpeadataUff;
use App\Repositories\Ipeadata\DCIpeadataUffRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DCIpeadataUffRepositoryEloquent implements DCIpeadataUffRepositoryInterface
{
    private $model;

    public function __construct(DCIpeadataUff $_modelo)
    {
        $this->model = $_modelo;
    }

    public function getAll()
    {
        //Utilização de Funções do BD dentro de comandos ELOQUENT
        $ipeadata = $this->model->select('*', DB::Raw('ST_AsGeoJSON(eduf_geometry) as geometry'))->get();

        return $this->mountAreas($ipeadata, null);
    }

    public function get($_id)
    {
        /*
        $ipeadata = $this->model->select('*', DB::Raw('ST_AsGeoJSON(eduf_geometry) as eduf_geometry'))->find($_id);

        //dd($valores = $ipeadata->eduf_geometry);
        $valores = $ipeadata->eduf_geometry;

        $teste = $this->mountAreas($valores, null);

        dd($teste);

        return $ipeadata;
        */
    }

    private function mountAreas($valores, $area){
        $areas = [];
        $areas['type'] = 'FeatureCollection';
        $areas['features'] = [];
        foreach($valores as $index => $valor){
            $areas['features'][$index]['type'] = 'Feature';
            $areas['features'][$index]['id'] = $index;
            $areas['features'][$index]['properties']['sigla'] = $valor->sigla;
            $areas['features'][$index]['properties']['nome'] = $valor->nome;
            $areas['features'][$index]['properties']['total'] = $valor->total;
            $areas['features'][$index]['properties']['x'] = $valor->x;
            $areas['features'][$index]['properties']['y'] = $valor->y;
            //ADV-90 - Não está carregando o mapa de munícipios
            //erro de memória no log "Allowed memory size of 536870912 bytes exhausted" com a linha abaixo.
            //Log::info([$valor->geometry]);
            //$areas['features'][$index]['geometry'] = json_decode($valor->geometry);
            $areas['features'][$index]['geometry'] = $valor->geometry;
            //$areas['features'][$index]['centro'] = $valor->centro_de_tudo;
        }
        //$areas['bounding_box_total'] = [];
        //$areas['bounding_box_total']['type'] = 'FeatureCollection';
        //$areas['bounding_box_total']['features'] = [];
        //$object_bounding_box_total = json_decode($area[0]->bounding_box_total);
        //$bounding_box_total = $object_bounding_box_total->coordinates;
        //$areas['bounding_box_total'] = $bounding_box_total;
        //$areas['bounding_box_total'] = null;
        return $areas;
    }
}