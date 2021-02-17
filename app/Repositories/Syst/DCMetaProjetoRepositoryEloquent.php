<?php


namespace App\Repositories\Syst;

use App\Models\Syst\DCMetaProjeto;
use App\Repositories\Syst\DCMetaProjetoRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class DCMetaProjetoRepositoryEloquent implements DCMetaProjetoRepositoryInterface
{
    private $model;

    public function __construct(DCMetaProjeto $_modelo)
    {
        $this->model = $_modelo;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function get($_id)
    {
        $meta = $this->model->find($_id);

        return $meta;
    }

    public function getMetasPorObjetivo($_id_objetivo)
    {
        $metas = $this->model->where('cd_objetivo_projeto', $_id_objetivo)->get();

        return $metas;
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