<?php


namespace App\Repositories\Syst;

use App\Models\Syst\DCFormaParticipacaoConferencia;
use App\Repositories\Syst\DCFormaParticipacaoConferenciaRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class DCFormaParticipacaoConferenciaRepositoryEloquent implements DCFormaParticipacaoConferenciaRepositoryInterface
{
    private $model;

    public function __construct(DCFormaParticipacaoConferencia $_modelo)
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