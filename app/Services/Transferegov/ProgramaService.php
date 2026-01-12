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

    public function get($id_programa, $cod_programa, $natureza_juridica_programa, $uf_programa)
    {
        return $this->repo->get($id_programa, $cod_programa, $natureza_juridica_programa, $uf_programa);
    }

    public function store(array $data)
    {
        return $this->repo->store($data);
    }

    public function update($id_programa, $cod_programa, $natureza_juridica_programa, $uf_programa, array $data)
    {
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->update($id_programa, $cod_programa, $natureza_juridica_programa, $uf_programa, $data);
    }

    public function destroy($id_projeto)
    {
        return $this->repo->destroy($id_projeto);
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
        $data['id_programa'] = (int) $data['id_programa'];
        $data['cod_orgao_sup_programa'] = (int) $data['cod_orgao_sup_programa'];
        $data['cod_programa'] = (int) $data['cod_programa'];
        $data['ano_disponibilizacao'] = (int) $data['ano_disponibilizacao'];
        $data['data_disponibilizacao'] = date('Y-m-d', 
                                                strtotime(
                                                    str_replace('/', '-', $data['data_disponibilizacao'])
                                                )
                                            );
        $data['dt_prog_ini_receb_prop'] = date('Y-m-d', 
                                                strtotime(
                                                    str_replace('/', '-', $data['dt_prog_ini_receb_prop'])
                                                )
                                            );
        $data['dt_prog_fim_receb_prop'] = date('Y-m-d', 
                                                strtotime(
                                                    str_replace('/', '-', $data['dt_prog_fim_receb_prop'])
                                                )
                                            );
        $data['dt_prog_ini_emenda_par'] = date('Y-m-d', 
                                                strtotime(
                                                    str_replace('/', '-', $data['dt_prog_ini_emenda_par'])
                                                )
                                            );
        $data['dt_prog_fim_emenda_par'] = date('Y-m-d', 
                                                strtotime(
                                                    str_replace('/', '-', $data['dt_prog_fim_emenda_par'])
                                                )
                                            );
        $data['dt_prog_ini_benef_esp'] = date('Y-m-d', 
                                                strtotime(
                                                    str_replace('/', '-', $data['dt_prog_ini_benef_esp'])
                                                )
                                            );
        $data['dt_prog_fim_benef_esp'] = date('Y-m-d', 
                                                strtotime(
                                                    str_replace('/', '-', $data['dt_prog_fim_benef_esp'])
                                                )
                                            );

        return $data;
    }

}