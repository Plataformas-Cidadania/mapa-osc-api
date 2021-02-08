<?php


namespace App\Repositories\Osc;

use App\Models\Osc\FinanciadorProjeto;
use App\Repositories\Osc\FinanciadorProjetoRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class FinanciadorProjetoRepositoryEloquent implements FinanciadorProjetoRepositoryInterface
{
    private $model;

    public function __construct(FinanciadorProjeto $financiadorProjeto)
    {
        $this->model = $financiadorProjeto;
    }

    public function get($id)
    {
        $_parceria = $this->model->find($id);

        return $_parceria;
    }

    public function getFinanciadoresPorProjeto($id_projeto)
    {
        $_parcerias = $this->model->where('id_projeto', $id_projeto)->get();

        return $_parcerias;
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