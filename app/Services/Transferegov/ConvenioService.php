<?php


namespace App\Services\Transferegov;

use App\Repositories\Transferegov\ConvenioRepositoryInterface;

class ConvenioService
{
    private $repo;

    public function __construct(ConvenioRepositoryInterface $_repo)
    {
        $this->repo = $_repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function get($nr_convenio, $id_proposta, $nr_processo)
    {
        return $this->repo->get($nr_convenio, $id_proposta, $nr_processo);
    }

    public function store(array $data)
    {
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->store($data);
    }

    public function update($nr_convenio, $id_proposta, $nr_processo, array $data)
    {
        //$data = $this->formatValues($data);
        // o banco de dados nao aceita strings vazias como data. Só null mesmo
        // Versoes futuras do laravel resolvem isso com um middleware que converte string vazia para null
        // esse metodo faz a mesma coisa.
        $data= $this->setEmptyStringsToNull($data);
        $data= $this->formatValues($data);
        return $this->repo->update($nr_convenio, $id_proposta, $nr_processo, $data);
    }

    public function destroy($nr_convenio, $id_proposta, $nr_processo)
    {
        return $this->repo->destroy($nr_convenio, $id_proposta, $nr_processo);
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
        $data['nr_convenio'] = (int) $data['nr_convenio'];
        $data['id_proposta'] = (int) $data['id_proposta'];
        $data['ug_emitente'] = (int) $data['ug_emitente'];
        $data['dia'] = (int) $data['dia'];
        $data['mes'] = (int) $data['mes'];
        $data['ano'] = (int) $data['ano'];
        $data['dias_prest_contas'] = (int) $data['dias_prest_contas'];
        $data['dias_clausula_suspensiva'] = (int) $data['dias_clausula_suspensiva'];
        $data['qtde_convenios'] = (int) $data['qtde_convenios'];
        $data['qtd_ta'] = (int) $data['qtd_ta'];
        $data['qtd_prorroga'] = (int) $data['qtd_prorroga'];
        $data['dia_assin_conv'] = date('Y-m-d',strtotime(str_replace('/', '-', $data['dia_assin_conv']))); 
        $data['dia_publ_conv'] = date('Y-m-d',strtotime(str_replace('/', '-', $data['dia_publ_conv']))); 
        $data['dia_inic_vigenc_conv'] = date('Y-m-d',strtotime(str_replace('/', '-', $data['dia_inic_vigenc_conv']))); 
        $data['dia_fim_vigenc_conv'] = date('Y-m-d',strtotime(str_replace('/', '-', $data['dia_fim_vigenc_conv']))); 
        $data['dia_fim_vigenc_original_conv'] = date('Y-m-d',strtotime(str_replace('/', '-', $data['dia_fim_vigenc_original_conv']))); 
        $data['dia_limite_prest_contas'] = date('Y-m-d',strtotime(str_replace('/', '-', $data['dia_limite_prest_contas']))); 
        $data['data_suspensiva'] = date('Y-m-d',strtotime(str_replace('/', '-', $data['data_suspensiva']))); 
        $data['data_retirada_suspensiva'] = date('Y-m-d',strtotime(str_replace('/', '-', $data['data_retirada_suspensiva']))); 
        $data['vl_global_conv'] = (double) str_replace('.', '', $data['vl_global_conv']);
        $data['vl_repasse_conv'] = (double) str_replace(',', '.', $data['vl_repasse_conv']);
        $data['vl_contrapartida_conv'] = (double) str_replace('.', '', $data['vl_contrapartida_conv']);
        $data['vl_empenhado_conv'] = (double) str_replace(',', '.', $data['vl_empenhado_conv']);
        $data['vl_desembolsado_conv'] = (double) str_replace('.', '', $data['vl_desembolsado_conv']);
        $data['vl_saldo_reman_tesouro'] = (double) str_replace(',', '.', $data['vl_saldo_reman_tesouro']);
        $data['vl_saldo_reman_convenente'] = (double) str_replace(',', '.', $data['vl_saldo_reman_convenente']);
        $data['vl_rendimento_aplicacao'] = (double) str_replace(',', '.', $data['vl_rendimento_aplicacao']);
        $data['vl_ingresso_contrapartida'] = (double) str_replace(',', '.', $data['vl_ingresso_contrapartida']);
        $data['vl_saldo_conta'] = (double) str_replace(',', '.', $data['vl_saldo_conta']);
        $data['valor_global_original_conv'] = (double) str_replace(',', '.', $data['valor_global_original_conv']);

        return $data;
    }

}