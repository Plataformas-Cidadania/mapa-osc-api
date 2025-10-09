<?php


namespace App\Repositories\Osc;

use App\Models\Osc\Projeto;
use App\Repositories\Osc\ProjetoRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ProjetoRepositoryEloquent implements ProjetoRepositoryInterface
{
    private $model;

    public function __construct(Projeto $_projeto)
    {
        $this->model = $_projeto;
    }

    public function get($id)
    {
        $projeto = $this->model->find($id);

        $nr_valor_total_projeto = $projeto['nr_valor_total_projeto'];
        $numerosVetor = explode(".", $nr_valor_total_projeto);
        $qtdVetor = count($numerosVetor);
        if ($qtdVetor === 2) {
            if (strlen($numerosVetor[1]) === 1) {
                $nr_valor_total_projeto = $nr_valor_total_projeto . "0";
            }
        } else
        {
            $nr_valor_total_projeto = $nr_valor_total_projeto . ".00";
        }

        $projeto['nr_valor_total_projeto'] = $nr_valor_total_projeto;

        return $projeto;
    }

    public function getProjetosPorOSC($_id_osc)
    {
        $projeto = $this->model->where('id_osc', $_id_osc)->get();

        return $projeto;
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        return $this->model->find($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }
}