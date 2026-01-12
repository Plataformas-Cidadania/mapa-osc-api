<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\Prorroga;

class ProrrogaRepositoryEloquent implements ProrrogaRepositoryInterface
{
    private $model;

    public function __construct(Prorroga $_prorroga)
    {
        $this->model = $_prorroga;
    }

    public function get($nr_convenio, $nr_prorroga)
    {
        return $this->model::where('nr_convenio', $nr_convenio)
                            ->where('nr_prorroga', $nr_prorroga)->get();
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($nr_convenio, $nr_prorroga, array $data)
    {
        return $this->model::where('nr_convenio', $nr_convenio)
                             ->where('nr_prorroga', $nr_prorroga)->update($data);
    }

    public function destroy($nr_convenio, $nr_prorroga)
    {
        return $this->model->find('nr_convenio', $nr_convenio)
                            ->find('nr_prorroga', $nr_prorroga)->delete();
    }

    public function updateOrCreate(array $data)
    {
        return $this->model::updateOrCreate(
                    ['nr_convenio' => $data['nr_convenio'], 'nr_prorroga' => $data['nr_prorroga']],
                    $data
                );
    }
}