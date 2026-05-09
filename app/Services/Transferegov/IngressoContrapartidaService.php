<?php


namespace App\Services\Transferegov;

use App\Repositories\Transferegov\IngressoContrapartidaRepositoryInterface;

class IngressoContrapartidaService
{
    private $repo;

    public function __construct(IngressoContrapartidaRepositoryInterface $_repo)
    {
        $this->repo = $_repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function get($nr_convenio, $dt_ingresso_contrapartida)
    {
        return $this->repo->get($nr_convenio, $dt_ingresso_contrapartida);
    }

    public function store(array $data)
    {
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->store($data);

    }

    public function update($nr_convenio, $dt_ingresso_contrapartida, array $data)
    {
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->update($nr_convenio, $dt_ingresso_contrapartida, $data);
    }

    public function destroy($nr_convenio, $dt_ingresso_contrapartida)
    {
        return $this->repo->destroy($nr_convenio, $dt_ingresso_contrapartida);
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
        $data['nr_convenio'] = (int) $data['nr_convenio'];
        $data['dt_ingresso_contrapartida'] = date('Y-m-d', 
                                                strtotime(
                                                    str_replace('/', '-', $data['dt_ingresso_contrapartida'])
                                                )
                                            );
        $data['vl_ingresso_contrapartida'] = (double) str_replace('.', '', $data['vl_ingresso_contrapartida']);

        return $data;
    }

}