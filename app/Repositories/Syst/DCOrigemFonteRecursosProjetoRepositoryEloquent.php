<?php


namespace App\Repositories\Syst;

use App\Models\Syst\DCOrigemFonteRecursosProjeto;
use App\Repositories\Syst\DCOrigemFonteRecursosProjetoRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class DCOrigemFonteRecursosProjetoRepositoryEloquent implements DCOrigemFonteRecursosProjetoRepositoryInterface
{
    private $model;

    public function __construct(DCOrigemFonteRecursosProjeto $_modelo)
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