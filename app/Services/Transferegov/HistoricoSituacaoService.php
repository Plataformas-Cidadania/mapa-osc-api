<?php


namespace App\Services\Transferegov;

use App\Repositories\Transferegov\HistoricoSituacaoRepositoryInterface;

class HistoricoSituacaoService
{
    private $repo;

    public function __construct(HistoricoSituacaoRepositoryInterface $_repo)
    {
        $this->repo = $_repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function get($id_proposta, $nr_convenio, $dia_historico_sit)
    {
        return $this->repo->get($id_proposta, $nr_convenio, $dia_historico_sit);
    }

    public function store(array $data)
    {
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->store($data);
    }

    public function update($id_proposta, $nr_convenio, $dia_historico_sit, array $data)
    {
        //$data = $this->formatValues($data);
        // o banco de dados nao aceita strings vazias como data. Só null mesmo
        // Versoes futuras do laravel resolvem isso com um middleware que converte string vazia para null
        // esse metodo faz a mesma coisa.
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->update($id_proposta, $nr_convenio, $dia_historico_sit, $data);
    }

    public function destroy($id_proposta, $nr_convenio, $dia_historico_sit)
    {
        return $this->repo->destroy($id_proposta, $nr_convenio, $dia_historico_sit);
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
        $data['id_proposta'] = (int) $data['id_proposta'];
        $data['nr_convenio'] = (int) $data['nr_convenio'];
        $data['dias_historico_sit'] = (int) $data['dias_historico_sit'];
        $data['cod_historico_sit'] = (int) $data['cod_historico_sit'];

        return $data;
    }

}