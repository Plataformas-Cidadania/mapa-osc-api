<?php


namespace App\Services\Transferegov;

use App\Repositories\Transferegov\PagamentoRepositoryInterface;

class PagamentoService
{
    private $repo;

    public function __construct(PagamentoRepositoryInterface $_repo)
    {
        $this->repo = $_repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function get($nr_mov_fin, $nr_convenio)
    {
        return $this->repo->get($nr_mov_fin, $nr_convenio);
    }

    public function store(array $data)
    {
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->store($data);
    }

    public function update($nr_mov_fin, $nr_convenio, array $data)
    {
        //$data = $this->formatValues($data);
        // o banco de dados nao aceita strings vazias como data. Só null mesmo
        // Versoes futuras do laravel resolvem isso com um middleware que converte string vazia para null
        // esse metodo faz a mesma coisa.
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->update($nr_mov_fin, $nr_convenio, $data);
    }

    public function destroy($nr_mov_fin, $nr_convenio)
    {
        return $this->repo->destroy($nr_mov_fin, $nr_convenio);
    }

    public function updateOrCreate(array $data)
    {
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

        $data['nr_mov_fin'] = (int) $data['nr_mov_fin'];
        $data['nr_convenio'] = (int) $data['nr_convenio'];
        $data['vl_pago'] = (double) str_replace('.', '', $data['vl_pago']);

        return $data;
    }

}