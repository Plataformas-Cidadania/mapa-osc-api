<?php
namespace App\Repositories\Transferegov;

use App\Models\Transferegov\Consorcio;

class ConsorcioRepositoryEloquent implements ConsorcioRepositoryInterface
{
    private $model;

    public function __construct(Consorcio $_consorcio)
    {
        $this->model = $_consorcio;
    }

    public function get($id_proposta, $cnpj_consorcio, $codigo_cnae_secundario)
    {
        return $this->model::where('id_proposta', $id_proposta)
                            ->where('cnpj_consorcio', $cnpj_consorcio)
                            ->where('codigo_cnae_secundario', $codigo_cnae_secundario)->get();
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id_proposta, $cnpj_consorcio, $codigo_cnae_secundario, array $data)
    {
        return $this->model::where('id_proposta', $id_proposta)
                             ->where('cnpj_consorcio', $cnpj_consorcio)
                             ->where('codigo_cnae_secundario', $codigo_cnae_secundario)->update($data);
    }

    public function destroy($id_proposta, $cnpj_consorcio, $codigo_cnae_secundario)
    {
        return $this->model->find('id_proposta', $id_proposta)
                            ->find('cnpj_consorcio', $cnpj_consorcio)
                            ->find('codigo_cnae_secundario', $codigo_cnae_secundario)->delete();
    }

    public function updateOrCreate(array $data)
    {
        return $this->model::updateOrCreate(
                    ['id_proposta' => $data['id_proposta'], 'cnpj_consorcio' => $data['cnpj_consorcio'], 'codigo_cnae_secundario' => $data['codigo_cnae_secundario']],
                    $data
                );
    }
}