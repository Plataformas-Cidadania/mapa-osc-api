<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\Emenda;

class EmendaRepositoryEloquent implements EmendaRepositoryInterface
{
    private $model;

    public function __construct(Emenda $_emenda)
    {
        $this->model = $_emenda;
    }

    public function get($cod_programa_emenda, $beneficiario_emenda, $nr_emenda)
    {
        return $this->model::where('cod_programa_emenda', $cod_programa_emenda)
                            ->where('beneficiario_emenda', $beneficiario_emenda)
                            ->where('nr_emenda', $nr_emenda)->get();
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($cod_programa_emenda, $beneficiario_emenda, $nr_emenda, array $data)
    {
        return $this->model::where('cod_programa_emenda', $cod_programa_emenda)
                            ->where('beneficiario_emenda', $beneficiario_emenda)
                            ->where('nr_emenda', $nr_emenda)->update($data);
    }

    public function destroy($cod_programa_emenda, $beneficiario_emenda, $nr_emenda)
    {
        return $this->model->find($cod_programa_emenda)->find($beneficiario_emenda)->find($nr_emenda)->delete();
    }

    public function updateOrCreate(array $data)
    {
        return $this->model::updateOrCreate(
                    ['cod_programa_emenda' => $data['cod_programa_emenda'], 'beneficiario_emenda' => $data['beneficiario_emenda'], 'nr_emenda' => $data['nr_emenda']],
                    $data
                );
    }
}