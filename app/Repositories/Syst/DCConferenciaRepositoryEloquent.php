<?php


namespace App\Repositories\Syst;

use App\Models\Syst\DCConferencia;
use App\Repositories\Syst\DCConferenciaRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class DCConferenciaRepositoryEloquent implements DCConferenciaRepositoryInterface
{
    private $model;

    public function __construct(DCConferencia $_modelo)
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