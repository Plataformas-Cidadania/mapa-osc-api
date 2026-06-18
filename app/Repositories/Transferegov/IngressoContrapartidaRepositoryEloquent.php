<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\IngressoContrapartida;

class IngressoContrapartidaRepositoryEloquent implements IngressoContrapartidaRepositoryInterface
{
    private $model;

    public function __construct(IngressoContrapartida $_ingresso_contrapartida)
    {
        $this->model = $_ingresso_contrapartida;
    }

    public function get($nr_convenio, $dt_ingresso_contrapartida)
    {
        return $this->model::where('nr_convenio', $nr_convenio)
                            ->where('dt_ingresso_contrapartida', $dt_ingresso_contrapartida)->get();
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($nr_convenio, $dt_ingresso_contrapartida, array $data)
    {
        return $this->model::where('nr_convenio', $nr_convenio)
                             ->where('dt_ingresso_contrapartida', $dt_ingresso_contrapartida)->update($data);
    }

    public function destroy($nr_convenio, $dt_ingresso_contrapartida)
    {
        return $this->model->find('nr_convenio', $nr_convenio)
                            ->find('dt_ingresso_contrapartida', $dt_ingresso_contrapartida)->delete();
    }

    public function updateOrCreate(array $data)
    {
        return $this->model::updateOrCreate(
                    ['nr_convenio' => $data['nr_convenio'], 'dt_ingresso_contrapartida' => $data['dt_ingresso_contrapartida']],
                    $data
                );
    }
}