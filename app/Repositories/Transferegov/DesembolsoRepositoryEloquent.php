<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\Desembolso;

class DesembolsoRepositoryEloquent implements DesembolsoRepositoryInterface
{
    private $model;

    public function __construct(Desembolso $_desembolso)
    {
        $this->model = $_desembolso;
    }

    public function get($id_desembolso, $nr_convenio)
    {
        return $this->model::where('id_desembolso', $id_desembolso)
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

    public function update($id_desembolso, $nr_convenio, array $data)
    {
        return $this->model::where('id_desembolso', $id_desembolso)
                            ->where('nr_convenio', $nr_convenio)->update($data);
    }

    public function destroy($id_desembolso, $nr_convenio)
    {
        return $this->model->find('id_desembolso', $id_desembolso)
                            ->find('nr_convenio', $nr_convenio)->delete();
    }

    public function updateOrCreate(array $data)
    {
        return $this->model::updateOrCreate(
                    ['id_desembolso' => $data['id_desembolso'], 'nr_convenio' => $data['nr_convenio']],
                    $data
                );
    }
}