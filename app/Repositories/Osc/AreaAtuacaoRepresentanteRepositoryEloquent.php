<?php


namespace App\Repositories\Osc;

use App\Models\Osc\AreaAtuacaoRepresentante;
use App\Repositories\Osc\AreaAtuacaoRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class AreaAtuacaoRepresentanteRepositoryEloquent implements AreaAtuacaoRepresentanteRepositoryInterface
{
    private $model;

    public function __construct(AreaAtuacaoRepresentante $_area_atuacao_rep)
    {
        $this->model = $_area_atuacao_rep;
    }

    public function get($_id)
    {
        return $this->model->find($_id);
    }

    public function getAreasAtuacaoRepPorOSC($_id_osc)
    {
        $areas_atuacao = $this->model->where('id_osc', $_id_osc)->get();

        return $areas_atuacao;
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        return $this->model->find($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }
}