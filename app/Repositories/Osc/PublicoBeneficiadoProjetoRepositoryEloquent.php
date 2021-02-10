<?php


namespace App\Repositories\Osc;

use App\Models\Osc\PublicoBeneficiadoProjeto;
use App\Repositories\Osc\PublicoBeneficiadoProjetoRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class PublicoBeneficiadoProjetoRepositoryEloquent implements PublicoBeneficiadoProjetoRepositoryInterface
{
    private $model;

    public function __construct(PublicoBeneficiadoProjeto $_publico)
    {
        $this->model = $_publico;
    }

    public function get($id)
    {
        $_objetivo = $this->model->find($id);

        return $_objetivo;
    }

    public function getPublicoBeneficiadoPorProjeto($_id_projeto)
    {
        $_objetivos = $this->model->where('id_projeto', $_id_projeto)->get();

        return $_objetivos;
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