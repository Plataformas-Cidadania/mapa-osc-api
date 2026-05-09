<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\Meta;

class MetaRepositoryEloquent implements MetaRepositoryInterface
{
    private $model;

    public function __construct(Meta $_meta)
    {
        $this->model = $_meta;
    }

    public function get($id_meta, $id_proposta)
    {
        return $this->model::where('id_meta', $id_meta)
                            ->where('id_proposta', $id_proposta)->get();
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id_meta, $id_proposta, array $data)
    {
        return $this->model::where('id_meta', $id_meta)
                             ->where('id_proposta', $id_proposta)->update($data);
    }

    public function destroy($id_meta, $id_proposta)
    {
        return $this->model->find('id_meta', $id_meta)
                            ->find('id_proposta', $id_proposta)->delete();
    }

    public function updateOrCreate(array $data)
    {
        return $this->model::updateOrCreate(
                    ['id_meta' => $data['id_meta'], 'id_proposta' => $data['id_proposta']],
                    $data
                );
    }
}