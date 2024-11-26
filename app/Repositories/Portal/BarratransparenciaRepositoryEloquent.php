<?php


namespace App\Repositories\Portal;

use App\Models\Portal\BarraTransparencia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BarratransparenciaRepositoryEloquent implements BarratransparenciaRepositoryInterface
{
    private $model;

    public function __construct(BarraTransparencia $_barra)
    {
        $this->model = $_barra;
    }

    public function getBarraPorOSC($id_osc)
    {
//        $regs = $this->model->where('id_osc', $id_osc)->get();

        $sql = $query = "SELECT 
			id_osc,
            transparencia_dados_gerais,
            peso_dados_gerais,
            transparencia_area_atuacao,
            peso_area_atuacao,
            transparencia_descricao,
            peso_descricao,
            transparencia_titulos_certificacoes,
            peso_titulos_certificacoes,
            transparencia_relacoes_trabalho_governanca,
            peso_relacoes_trabalho_governanca,
            transparencia_espacos_participacao_social,
            peso_espacos_participacao_social,
            transparencia_projetos_atividades_programas,
            peso_projetos_atividades_programas,
            transparencia_fontes_recursos,
            peso_fontes_recursos,
            transparencia_osc 
		FROM 
			portal.vw_osc_barra_transparencia 
		WHERE 
			vw_osc_barra_transparencia.id_osc = " . $id_osc;

        $regs = DB::select($sql);

        return $regs;
    }

    public function getBarraPorOscComCalculo($id_osc)
    {
        $regs = $this->model->where('id_osc', $id_osc)->get();

        $dados_resultado = [
            'id_osc',
            'id_barra_transparencia',
            'transparencia_dados_gerais',
            'peso_dados_gerais',
            'transparencia_area_atuacao',
            'peso_area_atuacao',
            'transparencia_descricao',
            'peso_descricao',
            'transparencia_titulos_certificacoes',
            'peso_titulos_certificacoes',
            'transparencia_relacoes_trabalho_governanca',
            'peso_relacoes_trabalho_governanca',
            'transparencia_espacos_participacao_social',
            'peso_espacos_participacao_social',
            'transparencia_projetos_atividades_programas',
            'peso_projetos_atividades_programas',
            'transparencia_fontes_recursos',
            'peso_fontes_recursos',
            'transparencia_osc'
        ];

        return $dados_resultado;
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }
}
