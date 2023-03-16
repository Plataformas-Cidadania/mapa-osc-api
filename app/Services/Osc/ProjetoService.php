<?php


namespace App\Services\Osc;

use App\Repositories\Osc\ProjetoRepositoryInterface;
use Illuminate\Support\Facades\Log;

class ProjetoService
{
    private $repo;

    public function __construct(ProjetoRepositoryInterface $_repo)
    {
        $this->repo = $_repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function get($id)
    {
        return $this->repo->get($id);
    }

    public function getProjetosPorOSC($id_osc)
    {
        return $this->repo->getProjetosPorOSC($id_osc);
    }

    public function store(array $data)
    {
        $data = $this->formatValues($data);
        return $this->repo->store($data);
    }

    public function update($id, array $data)
    {
        $data = $this->formatValues($data);
        // o banco de dados nao aceita strings vazias como data. Só null mesmo
        // Versoes futuras do laravel resolvem isso com um middleware que converte string vazia para null
        // esse metodo faz a mesma coisa.
        $data= $this->setEmptyStringsToNull($data);
        return $this->repo->update($id, $data);
    }

    public function destroy($id_projeto)
    {
        return $this->repo->destroy($id_projeto);
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

        if(array_key_exists('nr_valor_total_projeto', $data)){
            $data['nr_valor_total_projeto'] = str_replace('.', '', $data['nr_valor_total_projeto']);
            $data['nr_valor_total_projeto'] = str_replace(',', '.', $data['nr_valor_total_projeto']);
        }

        if(array_key_exists('nr_valor_captado_projeto', $data)){
            $data['nr_valor_captado_projeto'] = str_replace('.', '', $data['nr_valor_captado_projeto']);
            $data['nr_valor_captado_projeto'] = str_replace(',', '.', $data['nr_valor_captado_projeto']);
        }


        return $data;
    }
}