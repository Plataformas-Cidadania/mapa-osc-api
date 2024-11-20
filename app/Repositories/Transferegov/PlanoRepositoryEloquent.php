<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\Plano;

class PlanoRepositoryEloquent implements PlanoRepositoryInterface
{
    private $model;

    public function __construct(Plano $_plano)
    {
        $this->model = $_plano;
    }

    public function get($id_proposta, $id_item_pad, $cod_natureza_despesa)
    {
        return $this->model::where('id_proposta', $id_proposta)
                            ->where('id_item_pad', $id_item_pad)
                            ->where('cod_natureza_despesa', $cod_natureza_despesa)->get();
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id_proposta, $id_item_pad, $cod_natureza_despesa, array $data)
    {
        return $this->model::where('id_proposta', $id_proposta)
                            ->where('id_item_pad', $id_item_pad)
                            ->where('cod_natureza_despesa', $cod_natureza_despesa)->update($data);
    }

    public function destroy($id_proposta, $id_item_pad, $cod_natureza_despesa)
    {
        return $this->model->find('id_proposta', $id_proposta)
                            ->find('id_item_pad', $id_item_pad)
                            ->find('cod_natureza_despesa', $cod_natureza_despesa)->delete();
    }

    public function updateOrCreate(array $data)
    {
        return $this->model::updateOrCreate(
                    ['id_proposta' => $data['id_proposta'], 'id_item_pad' => $data['id_item_pad'], 'cod_natureza_despesa' => $data['cod_natureza_despesa']],
                    $data
                );
    }
}