<?php


namespace App\Repositories\Osc;

use App\Models\Osc\SemRecurso;
use App\Repositories\Osc\SemRecursosOSCRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SemRecursosOSCRepositoryEloquent implements SemRecursosOSCRepositoryInterface
{
    private $model;

    public function __construct(SemRecurso $_recurso)
    {
        $this->model = $_recurso;
    }

    public function getAnosSemRecursosPorOSC($_id_osc, $ano)
    {
        $_recursos = $this->model->where('id_osc', $_id_osc)->where('ano',$ano)->get();
       
        $nrecursos_ano_origem = [];

        $anoAnt  =  NULL;
        $origemAnt = NULL;

        foreach ($_recursos as $item)
        {
            $ano = $item->ano;
            $item_nrecurso = [               
                'origem' => $item->dc_origem_fonte_recurso,
                'ft_nao_possui' => $item->ft_nao_possui,
           ];

           if ($ano == $anoAnt)
           {
               array_push($nrecursos_ano_origem[$ano],$item_nrecurso); 
            }
           else
           {
                $nrecursos_ano_origem[$ano] = [];
                array_push($nrecursos_ano_origem[$ano],$item_nrecurso);
            }
            $anoAnt = $ano;
         }
        
        return $nrecursos_ano_origem;
    }
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function delete($id_osc, $ano, $origem)
    {
        $semRecurso =  $this->model->where('id_osc',$id_osc)
                            ->where('ano',$ano)
        ->where('cd_origem_fonte_recursos_osc',$origem)
        ->delete();       
        return  $semRecurso;
    }
}