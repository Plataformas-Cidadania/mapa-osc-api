<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\HistoricoSituacao;

class HistoricoSituacaoRepositoryEloquent implements HistoricoSituacaoRepositoryInterface
{
    private $model;

    public function __construct(HistoricoSituacao $_historico_situacao)
    {
        $this->model = $_historico_situacao;
    }

    public function get($id_proposta, $nr_convenio, $dia_historico_sit)
    {
        return $this->model::where('id_proposta', $id_proposta)
                            ->where('nr_convenio', $nr_convenio)
                            ->where('dia_historico_sit', $dia_historico_sit)->get();
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id_proposta, $nr_convenio, $dia_historico_sit, array $data)
    {
        return $this->model::where('id_proposta', $id_proposta)
                            ->where('nr_convenio', $nr_convenio)
                            ->where('dia_historico_sit', $dia_historico_sit)->update($data);
    }

    public function destroy($id_proposta, $nr_convenio, $dia_historico_sit)
    {
        return $this->model->find('id_proposta', $id_proposta)
                            ->find('nr_convenio', $nr_convenio)
                            ->where('dia_historico_sit', $dia_historico_sit)->delete();
    }

    public function updateOrCreate(array $data)
    {
        return $this->model::updateOrCreate(
                    ['id_proposta' => $data['id_proposta'], 'nr_convenio' => $data['nr_convenio'], 'dia_historico_sit' => $data['dia_historico_sit']],
                    $data
                );
    }
}