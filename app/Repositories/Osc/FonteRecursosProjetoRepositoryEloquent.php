<?php


namespace App\Repositories\Osc;

use App\Models\Osc\FonteRecursosProjeto;
use App\Repositories\Osc\FonteRecursosProjetoRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class FonteRecursosProjetoRepositoryEloquent implements FonteRecursosProjetoRepositoryInterface
{
    private $model;

    public function __construct(FonteRecursosProjeto $_fonte)
    {
        $this->model = $_fonte;
    }

    public function get($id)
    {
        $_objetivo = $this->model->find($id);

        return $_objetivo;
    }

    public function getFonteRecursosPorProjeto($_id_projeto)
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