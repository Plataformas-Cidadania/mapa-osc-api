<?php


namespace App\Services\Transferegov;

use App\Repositories\Transferegov\ConsorcioRepositoryInterface;

class ConsorcioService
{
    private $repo;

    public function __construct(ConsorcioRepositoryInterface $_repo)
    {
        $this->repo = $_repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function get($id_proposta, $cnpj_consorcio, $codigo_cnae_secundario)
    {
        return $this->repo->get($id_proposta, $cnpj_consorcio, $codigo_cnae_secundario);
    }

    public function store(array $data)
    {
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->store($data);

    }

    public function update($id_proposta, $cnpj_consorcio, $codigo_cnae_secundario, array $data)
    {
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->update($id_proposta, $cnpj_consorcio, $codigo_cnae_secundario, $data);
    }

    public function destroy($id_proposta, $cnpj_consorcio, $codigo_cnae_secundario)
    {
        return $this->repo->destroy($id_proposta, $cnpj_consorcio, $codigo_cnae_secundario);
    }

    public function updateOrCreate(array $data)
    {
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->updateOrCreate($data);
    }

    private function setEmptyStringsToNull($data)
    {
        foreach ($data as &$value) {
            if ($value === '')
                $value = null;
        }
        return $data;
    }

    private function formatValues($data){
        $data['id_proposta'] = (int) $data['id_proposta'];
        $data['cnpj_consorcio'] = (int) $data['cnpj_consorcio'];
        $data['codigo_cnae_primario'] = (int) $data['codigo_cnae_primario'];
        $data['codigo_cnae_secundario'] = (int) $data['codigo_cnae_secundario'];

        return $data;
    }

}