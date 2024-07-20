<?php


namespace App\Services\Transferegov;

use App\Repositories\Transferegov\EmpenhoRepositoryInterface;

class EmpenhoService
{
    private $repo;

    public function __construct(EmpenhoRepositoryInterface $_repo)
    {
        $this->repo = $_repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function get($id_empenho, $nr_convenio)
    {
        return $this->repo->get($id_empenho, $nr_convenio);
    }

    public function store(array $data)
    {
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->store($data);
    }

    public function update($id_empenho, $nr_convenio, array $data)
    {
        //$data = $this->formatValues($data);
        // o banco de dados nao aceita strings vazias como data. Só null mesmo
        // Versoes futuras do laravel resolvem isso com um middleware que converte string vazia para null
        // esse metodo faz a mesma coisa.
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->update($id_empenho, $nr_convenio, $data);
    }

    public function destroy($id_empenho, $nr_convenio)
    {
        return $this->repo->destroy($id_empenho, $nr_convenio);
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

        $data['id_empenho'] = (int) $data['id_empenho'];
        $data['nr_convenio'] = (int) $data['nr_convenio'];
        $data['nr_empenho'] = (int) $data['nr_empenho'];
        $data['tipo_nota'] = (int) $data['tipo_nota'];
        $data['ug_emitente'] = (int) $data['ug_emitente'];
        $data['ug_responsavel'] = (int) $data['ug_responsavel'];
        $data['ptres'] = (int) $data['ptres'];
        $data['valor_empenho'] = (double) str_replace('.', '', $data['valor_empenho']);

        return $data;
    }

}