<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\TermoAditivo;

class TermoAditivoRepositoryEloquent implements TermoAditivoRepositoryInterface
{
    private $model;

    public function __construct(TermoAditivo $_termo_aditivo)
    {
        $this->model = $_termo_aditivo;
    }

    public function get($nr_convenio, $numero_ta)
    {
        return $this->model::where('nr_convenio', $nr_convenio)
                            ->where('numero_ta', $numero_ta)->get();
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($nr_convenio, $numero_ta, array $data)
    {
        return $this->model::where('nr_convenio', $nr_convenio)
                             ->where('numero_ta', $numero_ta)->update($data);
    }

    public function destroy($nr_convenio, $numero_ta)
    {
        return $this->model->find('nr_convenio', $nr_convenio)
                            ->find('numero_ta', $numero_ta)->delete();
    }

    public function updateOrCreate(array $data)
    {
        return $this->model::updateOrCreate(
                    ['nr_convenio' => $data['nr_convenio'], 'numero_ta' => $data['numero_ta']],
                    $data
                );
    }
}