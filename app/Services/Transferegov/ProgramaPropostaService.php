<?php


namespace App\Services\Transferegov;

use App\Repositories\Transferegov\ProgramaPropostaRepositoryInterface;

class ProgramaPropostaService
{
    private $repo;

    public function __construct(ProgramaPropostaRepositoryInterface $_repo)
    {
        $this->repo = $_repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function get($id_programa, $id_projeto)
    {
        return $this->repo->get($id_programa, $id_projeto);
    }

    public function store(array $data)
    {
        return $this->repo->store($data);
    }

    public function update($id_programa, $id_projeto, array $data)
    {
        //$data = $this->formatValues($data);
        // o banco de dados nao aceita strings vazias como data. Só null mesmo
        // Versoes futuras do laravel resolvem isso com um middleware que converte string vazia para null
        // esse metodo faz a mesma coisa.
        $data= $this->setEmptyStringsToNull($data);
        return $this->repo->update($id_programa, $id_projeto, $data);
    }

    public function destroy($id_projeto)
    {
        return $this->repo->destroy($id_projeto);
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

        if(array_key_exists('id_programa', $data)){
            $data['id_programa'] = (int) $data['id_programa'];
        }
        if(array_key_exists('id_proposta', $data)){
            $data['id_proposta'] = (int) $data['id_proposta'];
        }

        return $data;
    }

}