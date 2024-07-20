<?php


namespace App\Services\Transferegov;

use App\Repositories\Transferegov\ProrrogaRepositoryInterface;

class ProrrogaService
{
    private $repo;

    public function __construct(ProrrogaRepositoryInterface $_repo)
    {
        $this->repo = $_repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function get($nr_convenio, $nr_prorroga)
    {
        return $this->repo->get($nr_convenio, $nr_prorroga);
    }

    public function store(array $data)
    {
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->store($data);

    }

    public function update($nr_convenio, $nr_prorroga, array $data)
    {
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->update($nr_convenio, $nr_prorroga, $data);
    }

    public function destroy($nr_convenio, $nr_prorroga)
    {
        return $this->repo->destroy($nr_convenio, $nr_prorroga);
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

    private function formatValues($data){
        $data['nr_convenio'] = (int) $data['nr_convenio'];
        $data['dias_prorroga'] = (int) $data['dias_prorroga'];
        $data['dt_inicio_prorroga'] = date('Y-m-d',
                                                strtotime(
                                                    str_replace('/', '-', $data['dt_inicio_prorroga'])
                                                )
                                            );
        $data['dt_fim_prorroga'] = date('Y-m-d',
                                        strtotime(
                                            str_replace('/', '-', $data['dt_fim_prorroga'])
                                        )
                                    );
        $data['dt_assinatura_prorroga'] = date('Y-m-d',
                                    strtotime(
                                        str_replace('/', '-', $data['dt_assinatura_prorroga'])
                                    )
                                );

        return $data;
    }

}