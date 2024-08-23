<?php


namespace App\Services\Transferegov;

use App\Repositories\Transferegov\EtapaRepositoryInterface;

class EtapaService
{
    private $repo;

    public function __construct(EtapaRepositoryInterface $_repo)
    {
        $this->repo = $_repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function get($id_etapa, $id_meta, $nr_etapa)
    {
        return $this->repo->get($id_etapa, $id_meta, $nr_etapa);
    }

    public function store(array $data)
    {
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->store($data);

    }

    public function update($id_etapa, $id_meta, $nr_etapa, array $data)
    {
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->update($id_etapa, $id_meta, $nr_etapa, $data);
    }

    public function destroy($id_etapa, $id_meta, $nr_etapa)
    {
        return $this->repo->destroy($id_etapa, $id_meta, $nr_etapa);
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
        $data['id_etapa'] = (int) $data['id_etapa'];
        $data['id_meta'] = (int) $data['id_meta'];
        $data['nr_etapa'] = (int) $data['nr_etapa'];
        $data['data_inicio_etapa'] = date('Y-m-d',
                                                strtotime(
                                                    str_replace('/', '-', $data['data_inicio_etapa'])
                                                )
                                            );
        $data['data_fim_etapa'] = date('Y-m-d',
                                        strtotime(
                                            str_replace('/', '-', $data['data_fim_etapa'])
                                        )
                                    );        

        $data['qtd_etapa'] = (double) str_replace(',', '.', $data['qtd_etapa']);
        $data['vl_etapa'] = (double) str_replace(',', '.', $data['vl_etapa']);
        return $data;
    }

}