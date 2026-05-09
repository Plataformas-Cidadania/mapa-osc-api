<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\Proposta;
use App\Repositories\Transferegov\PropostaRepositoryInterface;

class PropostaRepositoryEloquent implements PropostaRepositoryInterface
{
    private $model;

    public function __construct(Proposta $_proposta)
    {
        $this->model = $_proposta;
    }

    public function get($id_proposta)
    {
        return $this->model::where('id_proposta', $id_proposta)->get();
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id_proposta, array $data)
    {
        return $this->model::where('id_proposta', $id_proposta)->update($data);
    }

    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }

    public function updateOrCreate(array $data)
    {
        return $this->model::updateOrCreate(
                    ['id_proposta' => $data['id_proposta']],
                    $data
                );
    }
}