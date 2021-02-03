<?php


namespace App\Repositories\Osc;

use App\Models\Osc\OscParceiraProjeto;
use App\Repositories\Osc\OscParceiraProjetoRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class OscParceiraProjetoRepositoryEloquent implements OscParceiraProjetoRepositoryInterface
{
    private $model;

    public function __construct(OscParceiraProjeto $_parceria)
    {
        $this->model = $_parceria;
    }

    public function get($id)
    {
        $_parceria = $this->model->find($id);

        return $_parceria;
    }

    public function getParceriasPorProjeto($_id_projeto)
    {
        $_parcerias = $this->model->where('id_projeto', $_id_projeto)->get();

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