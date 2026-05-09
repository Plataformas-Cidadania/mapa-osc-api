<?php


namespace App\Services\Transferegov;

use App\Repositories\Transferegov\ProponenteRepositoryInterface;

class ProponenteService
{
    private $repo;

    public function __construct(ProponenteRepositoryInterface $_repo)
    {
        $this->repo = $_repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function get($id_proponente, $identif_proponente)
    {
        return $this->repo->get($id_proponente, $identif_proponente);
    }

    public function store(array $data)
    {
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->store($data);

    }

    public function update($id_proponente, $identif_proponente, array $data)
    {
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->update($id_proponente, $identif_proponente, $data);
    }

    public function destroy($id_proponente, $identif_proponente)
    {
        return $this->repo->destroy($id_proponente, $identif_proponente);
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
        $data['id_proponente'] = (int) $data['id_proponente'];
        return $data;
    }

}