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
        $ipeadata = $this->model->select('*', DB::Raw('ST_AsGeoJSON(eduf_geometry) as eduf_geometry'))->get();

        return $ipeadata;
    }

    public function getAllPorRegiao($id_regiao)
    {
        //Utilização de Funções do BD dentro de comandos ELOQUENT
        $ipeadata = $this->model->select('*', DB::Raw('ST_AsGeoJSON(eduf_geometry) as eduf_geometry'))->where('edre_cd_regiao', $id_regiao)->get();

        return $ipeadata;
    }

    public function get($_id)
    {

        $ipeadata = $this->model->select('*', DB::Raw('ST_AsGeoJSON(eduf_geometry) as eduf_geometry'))->find($_id);

        return $ipeadata;
    }

    public function getAllLiftLeft()
    {
        //Utilização de Funções do BD dentro de comandos ELOQUENT
        $ipeadata = $this->model->select('*', DB::Raw('ST_AsGeoJSON(eduf_geometry) as geometry'))->get();

        return $this->mountAreas($ipeadata, null);
    }

    //Criar padrão para o Lift
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
        }

        return $areas;
    }
}