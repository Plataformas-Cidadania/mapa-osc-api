<?php


namespace App\Services\Transferegov;

use App\Repositories\Transferegov\PropostaRepositoryInterface;

class PropostaService
{
    private $repo;

    public function __construct(PropostaRepositoryInterface $_repo)
    {
        $this->repo = $_repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function get($id_proposta)
    {
        return $this->repo->get($id_proposta);
    }

    public function store(array $data)
    {
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->store($data);
    }

    public function update($id_proposta, array $data)
    {
        //$data = $this->formatValues($data);
        // o banco de dados nao aceita strings vazias como data. Só null mesmo
        // Versoes futuras do laravel resolvem isso com um middleware que converte string vazia para null
        // esse metodo faz a mesma coisa.
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->update($id_proposta, $data);
    }

    public function destroy($id_proposta)
    {
        return $this->repo->destroy($id_proposta);
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

        $data['vl_global_prop'] = (double) str_replace('.', '', $data['vl_global_prop']);
        $data['vl_global_prop'] = (double) str_replace(',', '.', $data['vl_global_prop']);
        $data['vl_repasse_prop'] = (double) str_replace('.', '', $data['vl_repasse_prop']);
        $data['vl_repasse_prop'] = (double) str_replace(',', '.', $data['vl_repasse_prop']);
        $data['vl_contrapartida_prop'] = (double) str_replace('.', '', $data['vl_contrapartida_prop']);
        $data['vl_contrapartida_prop'] = (double) str_replace(',', '.', $data['vl_contrapartida_prop']);
        $data['id_proposta'] = (int) $data['id_proposta'];
        $data['cod_munic_ibge'] = (int) $data['cod_munic_ibge'];
        $data['cod_orgao_sup'] = (int) $data['cod_orgao_sup'];
        $data['dia_prop'] = (int) $data['dia_prop'];
        $data['mes_prop'] = (int) $data['mes_prop'];
        $data['ano_prop'] = (int) $data['ano_prop'];
        $data['cod_orgao'] = (int) $data['cod_orgao'];
        $data['cep_proponente'] = (int) $data['cep_proponente'];

        return $data;
    }

}