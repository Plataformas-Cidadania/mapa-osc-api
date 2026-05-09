<?php


namespace App\Services\Transferegov;

use App\Repositories\Transferegov\EmendaRepositoryInterface;

class EmendaService
{
    private $repo;

    public function __construct(EmendaRepositoryInterface $_repo)
    {
        $this->repo = $_repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function get($cod_programa_emenda, $beneficiario_emenda, $nr_emenda)
    {
        return $this->repo->get($cod_programa_emenda, $beneficiario_emenda, $nr_emenda);
    }

    public function store(array $data)
    {
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->store($data);
    }

    public function update($cod_programa_emenda, $beneficiario_emenda, $nr_emenda, array $data)
    {
        //$data = $this->formatValues($data);
        // o banco de dados nao aceita strings vazias como data. Só null mesmo
        // Versoes futuras do laravel resolvem isso com um middleware que converte string vazia para null
        // esse metodo faz a mesma coisa.
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->update($cod_programa_emenda, $beneficiario_emenda, $nr_emenda, $data);
    }

    public function destroy($cod_programa_emenda, $beneficiario_emenda, $nr_emenda)
    {
        return $this->repo->destroy($cod_programa_emenda, $beneficiario_emenda, $nr_emenda);
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

        $data['cod_programa_emenda'] = (int) $data['cod_programa_emenda'];
        $data['id_proposta'] = (int) $data['id_proposta'];
        $data['nr_emenda'] = (int) $data['nr_emenda'];
        $data['beneficiario_emenda'] = (int) $data['beneficiario_emenda'];
        $data['valor_repasse_proposta_emenda'] = (double) str_replace('.', '', $data['valor_repasse_proposta_emenda']);
        $data['valor_repasse_emenda'] = (double) str_replace(',', '.', $data['valor_repasse_emenda']);

        return $data;
    }

}