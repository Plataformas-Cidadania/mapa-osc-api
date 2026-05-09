<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\Empenho;

class EmpenhoRepositoryEloquent implements EmpenhoRepositoryInterface
{
    private $model;

    public function __construct(Empenho $_empenho)
    {
        $this->model = $_empenho;
    }

    public function get($id_empenho, $nr_convenio)
    {
        return $this->model::where('id_empenho', $id_empenho)
                            ->where('nr_convenio', $nr_convenio)->get();
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id_empenho, $nr_convenio, array $data)
    {
        return $this->model::where('id_empenho', $id_empenho)
                            ->where('nr_convenio', $nr_convenio)->update($data);
    }

    public function destroy($id_empenho, $nr_convenio)
    {
        return $this->model->find('id_empenho', $id_empenho)
                            ->find('nr_convenio', $nr_convenio)->delete();
    }

    public function updateOrCreate(array $data)
    {
        return $this->model::updateOrCreate(
                    ['id_empenho' => $data['id_empenho'], 'nr_convenio' => $data['nr_convenio']],
                    $data
                );
    }
}