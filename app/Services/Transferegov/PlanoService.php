<?php


namespace App\Services\Transferegov;

use App\Repositories\Transferegov\PlanoRepositoryInterface;

class PlanoService
{
    private $repo;

    public function __construct(PlanoRepositoryInterface $_repo)
    {
        $this->repo = $_repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function get($id_proposta, $id_item_pad, $cod_natureza_despesa)
    {
        return $this->repo->get($id_proposta, $id_item_pad, $cod_natureza_despesa);
    }

    public function store(array $data)
    {
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->store($data);
    }

    public function update($id_proposta, $id_item_pad, $cod_natureza_despesa, array $data)
    {
        //$data = $this->formatValues($data);
        // o banco de dados nao aceita strings vazias como data. Só null mesmo
        // Versoes futuras do laravel resolvem isso com um middleware que converte string vazia para null
        // esse metodo faz a mesma coisa.
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->update($id_proposta, $id_item_pad, $cod_natureza_despesa, $data);
    }

    public function destroy($id_proposta, $id_item_pad, $cod_natureza_despesa)
    {
        return $this->repo->destroy($id_proposta, $id_item_pad, $cod_natureza_despesa);
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
        $data['id_item_pad'] = (int) $data['id_item_pad'];
        $data['cod_natureza_despesa'] = (int) $data['cod_natureza_despesa'];
        $data['natureza_aquisicao'] = (int) $data['natureza_aquisicao'];
        $data['qtd_item'] = (double) str_replace(',', '.', $data['qtd_item']);
        $data['valor_unitario_item'] = (double) str_replace(',', '.', $data['valor_unitario_item']);
        $data['valor_total_item'] = (double) str_replace(',', '.', $data['valor_total_item']);

        return $data;
    }

}