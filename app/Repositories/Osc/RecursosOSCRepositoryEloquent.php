<?php


namespace App\Repositories\Osc;

use App\Models\Osc\Recurso;
use App\Repositories\Osc\RecursosOSCRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RecursosOSCRepositoryEloquent implements RecursosOSCRepositoryInterface
{
    private $recursoModel;

    public function __construct(Recurso $_recurso)
    {
        $this->recursoModel = $_recurso;
    }

    public function getRecursosPorOSC($_id_osc)
    {
        $_recursos = $this->recursoModel->where('id_osc', $_id_osc)->with('dc_fonte_recurso.dc_origem_fonte_recurso')
                                      ->orderBy('dt_ano_recursos_osc','asc')
                                      ->orderBy('cd_fonte_recursos_osc','asc')
                                      ->get();             
        $recursos_ano_origem = [];
        $anoAnt  =  NULL;
        $origemAnt = NULL;
        foreach ($_recursos as $item)
        {
            $ano = substr($item->dt_ano_recursos_osc, 0, -6);
            $origem = $item->dc_fonte_recurso->cd_origem_fonte_recursos_osc;
            $item_recurso = [
                'cd_fonte_recurso_osc' => $item->cd_fonte_recursos_osc,
                'tx_nome_fonte_recursos_osc' => $item->dc_fonte_recurso->tx_nome_fonte_recursos_osc,
                'id_recursos_osc' => $item->id_recursos_osc,
                'nr_valor_recursos_osc' => $item->nr_valor_recursos_osc,
                'ft_valor_recursos_osc' => $item->ft_valor_recursos_osc,
           ];
           if ($ano == $anoAnt)
           {
               if ($origem == $origemAnt)
               {
                array_push($recursos_ano_origem[$ano][$origem],$item_recurso); 
               }
               else
               {
                    $recursos_ano_origem[$ano][$origem] = ['tx_nome_origem_fonte_recursos_osc' => $item->dc_fonte_recurso->dc_origem_fonte_recurso->tx_nome_origem_fonte_recursos_osc];
                    array_push($recursos_ano_origem[$ano][$origem],$item_recurso);
               }
            }
           else
           {
                $recursos_ano_origem[$ano] = [];
                $recursos_ano_origem[$ano][$origem] = ['tx_nome_origem_fonte_recursos_osc' => $item->dc_fonte_recurso->dc_origem_fonte_recurso->tx_nome_origem_fonte_recursos_osc];
                array_push($recursos_ano_origem[$ano][$origem],$item_recurso);
            }
           $anoAnt = $ano;
           $origemAnt = $origem;
         }
        return $recursos_ano_origem;
    }
    
    public function getAnoRecursosPorOSC($_id_osc)
    {
        $anos_fonte_recursos = $this->recursoModel->where('id_osc', $_id_osc)->groupBy('id_osc','dt_ano_recursos_osc')->get(['id_osc', 'dt_ano_recursos_osc']);

        foreach ($anos_fonte_recursos as $item)
        {
            $item->dt_ano_recursos_osc = substr($item->dt_ano_recursos_osc, 0, -6);
        }

        return $anos_fonte_recursos;
    }

    public function store(array $data)
    {
        return $this->recursoModel->create($data);
    }

    public function update($id, array $data)
    {
        return $this->recursoModel->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->recursoModel->find($id)->delete();
    }
}