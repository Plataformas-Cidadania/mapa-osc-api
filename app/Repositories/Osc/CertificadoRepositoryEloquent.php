<?php


namespace App\Repositories\Osc;

use App\Models\Osc\Certificado;
use App\Repositories\Osc\CertificadoRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CertificadoRepositoryEloquent implements CertificadoRepositoryInterface
{
    private $model;

    public function __construct(Certificado $_certificado)
    {
        $this->model = $_certificado;
    }

    public function get($id)
    {
        $certificado = $this->model->find($id);

        return $certificado;
    }

    public function getCertificadosPorOSC($_id_osc)
    {
        $certificado = $this->model->where('id_osc', $_id_osc)->get();

        return $certificado;
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        if($data["cd_uf"] == "NULL")
        {
            $data["cd_uf"] = NULL;
        }
        if($data["cd_municipio"] == "NULL")
        {
            $data["cd_municipio"] = NULL;
        }

        return $this->model->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }
}