<?php


namespace App\Services\Transferegov;

use App\Repositories\Transferegov\DesembolsoRepositoryInterface;

class DesembolsoService
{
    private $repo;

    public function __construct(DesembolsoRepositoryInterface $_repo)
    {
        $this->repo = $_repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function get($id_desembolso, $nr_convenio)
    {
        return $this->repo->get($id_desembolso, $nr_convenio);
    }

    public function store(array $data)
    {
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->store($data);
    }

    public function update($id_desembolso, $nr_convenio, array $data)
    {
        //$data = $this->formatValues($data);
        // o banco de dados nao aceita strings vazias como data. Só null mesmo
        // Versoes futuras do laravel resolvem isso com um middleware que converte string vazia para null
        // esse metodo faz a mesma coisa.
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->update($id_desembolso, $nr_convenio, $data);
    }

    public function destroy($id_desembolso, $nr_convenio)
    {
        return $this->repo->destroy($id_desembolso, $nr_convenio);
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

        $data['id_desembolso'] = (int) $data['id_desembolso'];
        $data['nr_convenio'] = (int) $data['nr_convenio'];
        $data['qtd_dias_sem_desembolso'] = (int) $data['qtd_dias_sem_desembolso'];
        $data['ano_desembolso'] = (int) $data['ano_desembolso'];
        $data['mes_desembolso'] = (int) $data['mes_desembolso'];
        $data['ug_emitente_dh'] = (int) $data['ug_emitente_dh'];
        $data['vl_desembolsado'] = (double) str_replace('.', '', $data['vl_desembolsado']);

        return $data;
    }

}