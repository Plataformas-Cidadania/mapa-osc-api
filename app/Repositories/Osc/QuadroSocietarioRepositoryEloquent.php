<?php


namespace App\Repositories\Osc;

use App\Models\Osc\QuadroSocietario;

class QuadroSocietarioRepositoryEloquent implements QuadroSocietarioRepositoryInterface
{
    private $model;

    public function __construct(QuadroSocietario $_quadro_societario)
    {
        $this->model = $_quadro_societario;
    }

    public function get($id)
    {
        $_quadro_societario = $this->model->find($id);

        return $_quadro_societario;
    }

    public function getQuadroSocietarioPorOSC($_id_osc)
    {
//        $_quadro_societarios = $this->model->where('id_osc', $_id_osc)->get();
        $_quadro_societarios = $this->model->with(['qualificacaoSocio', 'tipoSocio'])->where('id_osc', $_id_osc)->get();

        return $_quadro_societarios;
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        return $this->model->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }
}