<?php


namespace App\Services\Transferegov;

use App\Repositories\Transferegov\ProgramaRepositoryInterface;

class ProgramaService
{
    private $repo;

    public function __construct(ProgramaRepositoryInterface $_repo)
    {
        $this->repo = $_repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function get($id_programa, $modalidade_programa, $natureza_juridica_programa, $uf_programa)
    {
        return $this->repo->get($id_programa, $modalidade_programa, $natureza_juridica_programa, $uf_programa);
    }

    public function store(array $data)
    {
        return $this->repo->store($data);
    }

    public function update($id_programa, $modalidade_programa, $natureza_juridica_programa, $uf_programa, array $data)
    {
        $data= $this->setEmptyStringsToNull($data);
        return $this->repo->update($id_programa, $modalidade_programa, $natureza_juridica_programa, $uf_programa, $data);
    }

    public function destroy($id_projeto)
    {
        return $this->repo->destroy($id_projeto);
    }

    public function updateOrCreate(array $data)
    {
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

}