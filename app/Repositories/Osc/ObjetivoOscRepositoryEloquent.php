<?php


namespace App\Repositories\Osc;

use App\Models\Osc\ObjetivoOsc;
use App\Repositories\Osc\ObjetivoOscRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ObjetivoOscRepositoryEloquent implements ObjetivoOscRepositoryInterface
{
    private $model;

    public function __construct(ObjetivoOsc $_objetivo)
    {
        $this->model = $_objetivo;
    }

    public function get($id)
    {
        $_objetivo = $this->model->find($id);

        return $_objetivo;
    }

    public function getObjetivosPorOsc($_id_osc)
    {
        $_objetivos = $this->model->where('id_osc', $_id_osc)->get();

        return $_objetivos;
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