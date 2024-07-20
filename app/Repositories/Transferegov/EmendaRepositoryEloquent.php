<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\Emenda;

class EmendaRepositoryEloquent implements EmendaRepositoryInterface
{
    private $model;

    public function __construct(Emenda $_emenda)
    {
        $this->model = $_emenda;
    }

    public function get($seq_emenda)
    {
        return $this->model::where('seq_emenda', $seq_emenda)->get();
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($seq_emenda, array $data)
    {
        return $this->model::where('seq_emenda', $seq_emenda)->update($data);
    }

    public function destroy($seq_emenda)
    {
        return $this->model->find($seq_emenda)->delete();
    }

    public function updateOrCreate(array $data)
    {
        return $this->model::updateOrCreate(
                    ['cod_programa_emenda' => $data['cod_programa_emenda'], 'beneficiario_emenda' => $data['beneficiario_emenda'], 'nr_emenda' => $data['nr_emenda']],
                    $data
                );
    }
}