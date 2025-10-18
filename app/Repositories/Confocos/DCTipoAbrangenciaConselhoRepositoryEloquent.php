<?php


namespace App\Repositories\Confocos;

use App\Models\Confocos\DCTipoAbrangenciaConselho;

class DCTipoAbrangenciaConselhoRepositoryEloquent implements DCTipoAbrangenciaConselhoRepositoryInterface
{
    private $model;

    public function __construct(DCTipoAbrangenciaConselho $_modelo)
    {
        $this->model = $_modelo;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function get($_id)
    {
        $areas_atuacao = $this->model->find($_id);

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