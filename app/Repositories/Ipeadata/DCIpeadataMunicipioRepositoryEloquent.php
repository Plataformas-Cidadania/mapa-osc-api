<?php


namespace App\Repositories\Ipeadata;

use App\Models\Ipeadata\DCIpeadataMunicipio;
use App\Repositories\Ipeadata\DCIpeadataMunicipioRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DCIpeadataMunicipioRepositoryEloquent implements DCIpeadataMunicipioRepositoryInterface
{
    private $model;

    public function __construct(DCIpeadataMunicipio $_modelo)
    {
        $this->model = $_modelo;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getAllPorEstado($id_estado)
    {
        $ipeadata = $this->model->select('*', DB::Raw('ST_AsGeoJSON(edmu_geometry) as edmu_geometry'))->where("eduf_cd_uf", $id_estado)->get();

        return $ipeadata;
    }

    public function get($_id)
    {
        $municipio = $this->model->find($_id);

        return $municipio;
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
        $areas['bounding_box_total'] = [];
        $areas['bounding_box_total']['type'] = 'FeatureCollection';
        $areas['bounding_box_total']['features'] = [];
        $object_bounding_box_total = json_decode($area[0]->bounding_box_total);
        $bounding_box_total = $object_bounding_box_total->coordinates;
        $areas['bounding_box_total'] = $bounding_box_total;
        //$areas['bounding_box_total'] = null;
        return $areas;
    }
}