<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\ObtvConvenente;

class ObtvConvenenteRepositoryEloquent implements ObtvConvenenteRepositoryInterface
{
    private $model;

    public function __construct(ObtvConvenente $_obtv_convenente)
    {
        $this->model = $_obtv_convenente;
    }

    public function get($nr_mov_fin)
    {
        return $this->model::where('nr_mov_fin', $nr_mov_fin)->get();
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($nr_mov_fin, array $data)
    {
        return $this->model::where('nr_mov_fin', $nr_mov_fin)->update($data);
    }

    public function destroy($nr_mov_fin)
    {
        return $this->model->find('nr_mov_fin', $nr_mov_fin)->delete();
    }

    public function updateOrCreate(array $data)
    {
        return $this->model::updateOrCreate(
                    ['nr_mov_fin' => $data['nr_mov_fin']],
                    $data
                );
    }
}