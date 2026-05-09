<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\Etapa;

class EtapaRepositoryEloquent implements EtapaRepositoryInterface
{
    private $model;

    public function __construct(Etapa $_etapa)
    {
        $this->model = $_etapa;
    }

    public function get($id_etapa, $id_meta, $nr_etapa)
    {
        return $this->model::where('id_etapa', $id_etapa)
                            ->where('id_meta', $id_meta)
                            ->where('nr_etapa', $nr_etapa)->get();
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id_etapa, $id_meta, $nr_etapa, array $data)
    {
        return $this->model::where('id_etapa', $id_etapa)
                             ->where('id_meta', $id_meta)
                             ->where('nr_etapa', $nr_etapa)->update($data);
    }

    public function destroy($id_etapa, $id_meta, $nr_etapa)
    {
        return $this->model->find('id_etapa', $id_etapa)
                            ->find('id_meta', $id_meta)
                            ->find('nr_etapa', $nr_etapa)->delete();
    }

    public function updateOrCreate(array $data)
    {
        return $this->model::updateOrCreate(
                    ['id_etapa' => $data['id_etapa'], 'id_meta' => $data['id_meta'], 'nr_etapa' => $data['nr_etapa']],
                    $data
                );
    }
}