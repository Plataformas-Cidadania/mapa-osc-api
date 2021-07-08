<?php


namespace App\Repositories\Syst;

use App\Models\Syst\DCClasseAtividadeEconomica;
use App\Repositories\Syst\DCClasseAtividadeEconomicaRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Util\TratarString;

class DCClasseAtividadeEconomicaRepositoryEloquent implements DCClasseAtividadeEconomicaRepositoryInterface
{
    private $model;

    public function __construct(DCClasseAtividadeEconomica $_modelo)
    {
        $this->model = $_modelo;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function get($_id)
    {
        $classe = $this->model->find($_id);

        return $classe;
    }

    public function getAutocomplete($_param)
    {
        $tx_parametro = strtolower($_param);

        $tx_parametro = str_replace('_', ' ', $tx_parametro);

        $query = "SELECT 
				cd_classe_atividade_economica::TEXT, 
				tx_nome_classe_atividade_economica
			FROM 
				syst.dc_classe_atividade_economica
			WHERE 
				UNACCENT(tx_nome_classe_atividade_economica) ILIKE '" . $tx_parametro . "%'
                ORDER BY similarity(tx_nome_classe_atividade_economica, '" . $tx_parametro . "') DESC";

        $regs = DB::select($query);

        return $regs;
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