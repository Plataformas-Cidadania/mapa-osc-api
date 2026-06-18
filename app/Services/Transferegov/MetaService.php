<?php


namespace App\Services\Transferegov;

use App\Repositories\Transferegov\MetaRepositoryInterface;

class MetaService
{
    private $repo;

    public function __construct(MetaRepositoryInterface $_repo)
    {
        $this->repo = $_repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function get($id_meta, $id_proposta)
    {
        return $this->repo->get($id_meta, $id_proposta);
    }

    public function store(array $data)
    {
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->store($data);

    }

    public function update($id_meta, $id_proposta, array $data)
    {
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->update($id_meta, $id_proposta, $data);
    }

    public function destroy($id_meta, $id_proposta)
    {
        return $this->repo->destroy($id_meta, $id_proposta);
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
        $data['id_meta'] = (int) $data['id_meta'];
        $data['id_proposta'] = (int) $data['id_proposta'];
        $data['nr_convenio'] = (int) $data['nr_convenio'];
        $data['cod_programa'] = (int) $data['cod_programa'];
        $data['nr_meta'] = (int) $data['nr_meta'];
        
        $data['data_inicio_meta'] = date('Y-m-d',
                                                strtotime(
                                                    str_replace('/', '-', $data['data_inicio_meta'])
                                                )
                                            );
        $data['data_fim_meta'] = date('Y-m-d',
                                        strtotime(
                                            str_replace('/', '-', $data['data_fim_meta'])
                                        )
                                    );        

        $data['qtd_meta'] = (double) str_replace(',', '.', $data['qtd_meta']);
        $data['vl_meta'] = (double) str_replace(',', '.', $data['vl_meta']);
        return $data;
    }

}