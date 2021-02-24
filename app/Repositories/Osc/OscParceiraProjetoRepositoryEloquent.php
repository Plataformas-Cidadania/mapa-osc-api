<?php


namespace App\Repositories\Osc;

use App\Models\Osc\OscParceiraProjeto;
use App\Repositories\Osc\OscParceiraProjetoRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Array_;

class OscParceiraProjetoRepositoryEloquent implements OscParceiraProjetoRepositoryInterface
{
    private $model;

    public function __construct(OscParceiraProjeto $_parceria)
    {
        $this->model = $_parceria;
    }

    public function get($id)
    {
        $_parceria = $this->model->find($id);

        return $_parceria;
    }

    public function getParceriasPorProjeto($_id_projeto)
    {
        $parceiras = $this->model->where('id_projeto', $_id_projeto)->get();

        $vetor_dados = [];
        foreach ($parceiras as $parceira)
        {
            $dados = [
                "id_osc" => $parceira->id_osc,
                "id_projeto" => $parceira->id_projeto,
                "ft_osc_parceira_projeto" => $parceira->ft_osc_parceira_projeto,
                "bo_oficial" => $parceira->bo_oficial,
                "id_osc_parceira_projeto" => $parceira->id_osc_parceira_projeto,
                "tx_nome_fantasia_osc" => $parceira->osc->dados_gerais->tx_razao_social_osc
            ];

            array_push($vetor_dados, $dados);
        }

        return $vetor_dados;
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