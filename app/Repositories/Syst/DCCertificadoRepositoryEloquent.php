<?php


namespace App\Repositories\Syst;

use App\Models\Syst\DCCertificado;
use App\Repositories\Syst\DCCertificadoRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class DCCertificadoRepositoryEloquent implements DCCertificadoRepositoryInterface
{
    private $model;

    public function __construct(DCCertificado $_modelo)
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