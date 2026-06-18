<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\Convenio;
use App\Repositories\Transferegov\ConvenioRepositoryInterface;

class ConvenioRepositoryEloquent implements ConvenioRepositoryInterface
{
    private $model;

    public function __construct(Convenio $_convenio)
    {
        $this->model = $_convenio;
    }

    public function get($nr_convenio, $id_proposta, $nr_processo)
    {
        return $this->model::where('nr_convenio', $nr_convenio, $id_proposta, $nr_processo)->get();
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($nr_convenio, $id_proposta, $nr_processo, array $data)
    {
        return $this->model::where('nr_convenio', $nr_convenio, $id_proposta, $nr_processo)->update($data);
    }

    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }

    public function updateOrCreate(array $data)
    {
        return $this->model::updateOrCreate(
                    ['nr_convenio' => $data['nr_convenio'],'id_proposta' => $data['id_proposta'],'nr_processo' => $data['nr_processo'],],
                    $data
                );
    }
}