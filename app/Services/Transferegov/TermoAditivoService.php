<?php


namespace App\Services\Transferegov;

use App\Repositories\Transferegov\TermoAditivoRepositoryInterface;

class TermoAditivoService
{
    private $repo;

    public function __construct(TermoAditivoRepositoryInterface $_repo)
    {
        $this->repo = $_repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function get($nr_convenio, $numero_ta)
    {
        return $this->repo->get($nr_convenio, $numero_ta);
    }

    public function store(array $data)
    {
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->store($data);

    }

    public function update($nr_convenio, $numero_ta, array $data)
    {
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->update($nr_convenio, $numero_ta, $data);
    }

    public function destroy($nr_convenio, $numero_ta)
    {
        return $this->repo->destroy($nr_convenio, $numero_ta);
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
        $data['id_solicitacao'] = (int) $data['id_solicitacao'];
        $data['vl_global_ta'] = (double) str_replace(',', '.', $data['vl_global_ta']);
        $data['vl_repasse_ta'] = (double) str_replace(',', '.', $data['vl_repasse_ta']);
        $data['vl_contrapartida_ta'] = (double) str_replace(',', '.', $data['vl_contrapartida_ta']);
        $data['dt_assinatura_ta'] = date('Y-m-d',
                                                strtotime(
                                                    str_replace('/', '-', $data['dt_assinatura_ta'])
                                                )
                                            );
        $data['dt_inicio_ta'] = date('Y-m-d',
                                        strtotime(
                                            str_replace('/', '-', $data['dt_inicio_ta'])
                                        )
                                    );
        $data['dt_fim_ta'] = date('Y-m-d',
                                    strtotime(
                                        str_replace('/', '-', $data['dt_fim_ta'])
                                    )
                                );

        return $data;
    }

}