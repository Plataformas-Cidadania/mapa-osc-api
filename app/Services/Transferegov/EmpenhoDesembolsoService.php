<?php


namespace App\Services\Transferegov;

use App\Repositories\Transferegov\EmpenhoDesembolsoRepositoryInterface;

class EmpenhoDesembolsoService
{
    private $repo;

    public function __construct(EmpenhoDesembolsoRepositoryInterface $_repo)
    {
        $this->repo = $_repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function get($id_desembolso, $id_empenho)
    {
        return $this->repo->get($id_desembolso, $id_empenho);
    }

    public function store(array $data)
    {
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->store($data);

    }

    public function update($id_desembolso, $id_empenho, array $data)
    {
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->update($id_desembolso, $id_empenho, $data);
    }

    public function destroy($id_desembolso, $id_empenho)
    {
        return $this->repo->destroy($id_desembolso, $id_empenho);
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
        $data['id_desembolso'] = (int) $data['id_desembolso'];
        $data['id_empenho'] = (int) $data['id_empenho'];
        $data['valor_grupo'] = (double) str_replace(',', '.', $data['valor_grupo']);
        return $data;
    }

}