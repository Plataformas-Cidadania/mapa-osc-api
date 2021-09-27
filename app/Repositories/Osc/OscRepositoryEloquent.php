<?php


namespace App\Repositories\Osc;

use App\Models\Osc\Contato;
use App\Models\Osc\DadosGerais;
use App\Models\Osc\Localizacao;
use App\Models\Osc\ObjetivoOsc;
use App\Models\Osc\Osc;
use App\Repositories\Osc\OscRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PHPUnit\Util\Json;
use function MongoDB\BSON\toJSON;
use function Sodium\add;

class OscRepositoryEloquent implements OscRepositoryInterface
{
    private $model;

    public function __construct(Osc $_osc)
    {
        $this->model = $_osc;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function get($id)
    {
        $osc = $this->model->find($id);

        return $osc;
    }

    public function getNumeroTotalOSCs()
    {
        $total_osc = $this->model->where('bo_osc_ativa', 1)->count();

        return $total_osc;
    }

    public function getCabecalho($id)
    {
        //$osc = $this->model->where('id_osc', $id)->with('dados_gerais:id_osc,tx_razao_social_osc,ft_razao_social_osc,'/*im_logo,*/.'ft_logo,cd_natureza_juridica_osc,ft_natureza_juridica_osc')->get();

        $osc = $this->model->find($id);
        //dd($osc);

        $cabecalho = [
            'cd_identificador_osc' => $osc->cd_identificador_osc,
            'ft_identificador_osc' => $osc->ft_identificador_osc,
            'tx_razao_social_osc' => $osc->dados_gerais->tx_razao_social_osc,
            'ft_razao_social_osc' => $osc->dados_gerais->ft_razao_social_osc,
            'im_logo' => $osc->dados_gerais->im_logo,
            'ft_logo' => $osc->dados_gerais->ft_logo,
            'cd_natureza_juridica_osc' => $osc->dados_gerais->cd_natureza_juridica_osc,
            'tx_nome_natureza_juridica_osc' => $osc->dados_gerais->natureza_juridica->tx_nome_natureza_juridica,
            'ft_natureza_juridica_osc' => $osc->dados_gerais->ft_natureza_juridica_osc,
            'ft_natureza_juridica_osc' => $osc->dados_gerais->ft_natureza_juridica_osc,
            'dt_atualizacao' => $osc->updated_at,
        ];

        return $cabecalho;
    }

    public function getDadosGerais($id)
    {
        $osc = $this->model->find($id);


        $dados_gerais = [
            //DADOS GERAIS
            'tx_sigla_osc' => $osc->dados_gerais->tx_sigla_osc,
            'ft_sigla_osc' => $osc->dados_gerais->ft_sigla_osc,
            'tx_nome_fantasia_osc' => $osc->dados_gerais->tx_nome_fantasia_osc,
            'ft_nome_fantasia_osc' => $osc->dados_gerais->ft_nome_fantasia_osc,
            'tx_resumo_osc' => $osc->dados_gerais->tx_resumo_osc,
            'ft_resumo_osc' => $osc->dados_gerais->ft_resumo_osc,
            'cd_classe_atividade_economica_osc' => $osc->dados_gerais->cd_classe_atividade_economica_osc,//É A ATIVIDADE ECONÔMICA, N SEI PQ TROCARAM
            'tx_nome_classe_atividade_economica' => $osc->dados_gerais->classe_atividade_economica === null ? "" : $osc->dados_gerais->classe_atividade_economica->tx_nome_classe_atividade_economica,//É A ATIVIDADE ECONÔMICA, N SEI PQ TROCARAM
            'ft_classe_atividade_economica_osc' => $osc->dados_gerais->ft_classe_atividade_economica_osc,//É A ATIVIDADE ECONÔMICA, N SEI PQ TROCARAM
            'tx_nome_responsavel_legal' => $osc->dados_gerais->tx_nome_responsavel_legal,
            'ft_nome_responsavel_legal' => $osc->dados_gerais->ft_nome_responsavel_legal,
            'cd_situacao_imovel_osc' => $osc->dados_gerais->cd_situacao_imovel_osc,
            'tx_nome_situacao_imovel_osc' => $osc->dados_gerais->situacao_imovel === null ? "" : $osc->dados_gerais->situacao_imovel->tx_nome_situacao_imovel,//É A ATIVIDADE ECONÔMICA, N SEI PQ TROCARAM
            'ft_situacao_imovel_osc' => $osc->dados_gerais->ft_situacao_imovel_osc,
            'dt_ano_cadastro_cnpj' => $osc->dados_gerais->dt_ano_cadastro_cnpj,
            'ft_ano_cadastro_cnpj' => $osc->dados_gerais->ft_ano_cadastro_cnpj,
            'dt_fundacao_osc' => $osc->dados_gerais->dt_fundacao_osc,
            'ft_fundacao_osc' => $osc->dados_gerais->ft_fundacao_osc,
            //LOCALIZAÇÃO
            'tx_endereco' => $osc->localizacao->tx_endereco,
            'ft_endereco' => $osc->localizacao->ft_endereco,
            'nr_localizacao' => $osc->localizacao->nr_localizacao,
            'ft_localizacao' => $osc->localizacao->ft_localizacao,
            'tx_endereco_complemento' => $osc->localizacao->tx_endereco_complemento,
            'ft_endereco_complemento' => $osc->localizacao->ft_endereco_complemento,
            'tx_bairro' => $osc->localizacao->tx_bairro,
            'ft_bairro' => $osc->localizacao->ft_bairro,
            'cd_municipio' => $osc->localizacao->cd_municipio,
            'tx_nome_municipio' => $osc->localizacao->municipio->edmu_nm_municipio,
            'ft_municipio' => $osc->localizacao->ft_municipio,
            'tx_nome_uf' => $osc->localizacao->municipio === null ? "" : $osc->localizacao->municipio->uf->eduf_nm_uf,
            'tx_sigla_uf' => $osc->localizacao->municipio === null ? "" : $osc->localizacao->municipio->uf->eduf_sg_uf,
            //'ft_uf' => $osc->localizacao->municipio->uf->eduf_sg_uf//MESMA FONTE DO MUNICIPIO PODE REPETIR
            'nr_cep' => $osc->localizacao->nr_cep,
            'ft_cep' => $osc->localizacao->ft_cep,
            'geo_localizacao' => $osc->localizacao->geo_localizacao,//,'geo_lat','geo_lng' | VER COMO CONVERTER DEPOIS
            //CONTATOS
            'tx_site' => $osc->contato->tx_site,
            'ft_site' => $osc->contato->ft_site,
            'tx_email' => $osc->contato->tx_email,
            'ft_email' => $osc->contato->ft_email,
            'tx_telefone' => $osc->contato->tx_telefone,
            'ft_telefone' => $osc->contato->ft_telefone,
            'bo_nao_possui_site' => $osc->contato->bo_nao_possui_site,
            'bo_nao_possui_email' => $osc->contato->bo_nao_possui_email,
            'bo_nao_possui_sigla_osc' => $osc->contato->bo_nao_possui_sigla_osc,
            //OBJETIVOS
            'objetivos_metas' => $osc->objetivos,
        ];

        $geo = Localizacao::select(DB::Raw('ST_AsGeoJSON(geo_localizacao) as geo_localizacao'))->where('id_osc', $id)->get();
        $coo = json_decode($geo[0]->geo_localizacao)->coordinates;
        $dados_gerais['geo_localizacao'] = $coo;
        //dd($coo);
        return $dados_gerais;
    }

    public function updateLogo($id, array $data){
        $dados_gerais = DadosGerais::find($id);

        if (is_null($dados_gerais))
        {
            return false;
        }
        $dados_gerais->fill($data);
        $dados_gerais->save();

        $dados_atualizados = [
            'im_logo' => $dados_gerais->im_logo,
        ];

        return $dados_atualizados;
    }

    public function getLogo($id){
        $dados_gerais = DadosGerais::find($id);

        if(is_null($dados_gerais)){
            return false;
        }
        return $dados_gerais->im_logo;
    }

    public function updateDadosGerais($id, array $data)
    {

        //dd($data);
        $dados_gerais = DadosGerais::find($id);

        if (is_null($dados_gerais))
        {
            return false;
        }

        $dados_gerais->fill($data);
        $dados_gerais->save();

        $contato = Contato::find($id);

        if (is_null($contato))
        {
            return false;
        }

        $contato->fill($data);
        $contato->save();

        $metas = $data["objetivos_metas"];
        ObjetivoOsc::where('id_osc', $id)->whereNotIn('cd_meta_osc', $metas)->delete();
        $objetivos_metas = ObjetivoOsc::where('id_osc', $id)->get();
        
        foreach ($metas as $meta)
        {
            $existe = false;
            foreach ($objetivos_metas as $item)
            {
                if ($item->cd_meta_osc == $meta)
                {
                    $existe = true;
                }
            }
            if (!$existe)
            {
                $newObjetivo = new ObjetivoOsc();

                $newObjetivo->id_osc = $id;
                $newObjetivo->cd_meta_osc = $meta;
                $newObjetivo->bo_oficial = false;
                $newObjetivo->ft_objetivo_osc = 'Representante';

                $newObjetivo->save();

                $objetivos_metas->push($newObjetivo);
            }
        }

        //dd($objetivos);

        $dados_atualizados = [
            //DADOS GERAIS
            'tx_sigla_osc' => $dados_gerais->tx_sigla_osc,
            'ft_sigla_osc' => $dados_gerais->ft_sigla_osc,
            'tx_nome_fantasia_osc' => $dados_gerais->tx_nome_fantasia_osc,
            'ft_nome_fantasia_osc' => $dados_gerais->ft_nome_fantasia_osc,
            'tx_resumo_osc' => $dados_gerais->tx_resumo_osc,
            'ft_resumo_osc' => $dados_gerais->ft_resumo_osc,
            'cd_classe_atividade_economica_osc' => $dados_gerais->cd_classe_atividade_economica_osc,//É A ATIVIDADE ECONÔMICA, N SEI PQ TROCARAM
            'tx_nome_classe_atividade_economica' => $dados_gerais->classe_atividade_economica === null ? "" : $dados_gerais->classe_atividade_economica->tx_nome_classe_atividade_economica,//É A ATIVIDADE ECONÔMICA, N SEI PQ TROCARAM
            'ft_classe_atividade_economica_osc' => $dados_gerais->ft_classe_atividade_economica_osc,//É A ATIVIDADE ECONÔMICA, N SEI PQ TROCARAM
            'tx_nome_responsavel_legal' => $dados_gerais->tx_nome_responsavel_legal,
            'ft_nome_responsavel_legal' => $dados_gerais->ft_nome_responsavel_legal,
            'cd_situacao_imovel_osc' => $dados_gerais->cd_situacao_imovel_osc,
            'tx_nome_situacao_imovel_osc' => $dados_gerais->situacao_imovel === null ? "" : $dados_gerais->situacao_imovel->tx_nome_situacao_imovel,//É A ATIVIDADE ECONÔMICA, N SEI PQ TROCARAM
            'ft_situacao_imovel_osc' => $dados_gerais->ft_situacao_imovel_osc,
            'dt_ano_cadastro_cnpj' => $dados_gerais->dt_ano_cadastro_cnpj,
            'ft_ano_cadastro_cnpj' => $dados_gerais->ft_ano_cadastro_cnpj,
            'dt_fundacao_osc' => $dados_gerais->dt_fundacao_osc,
            'ft_fundacao_osc' => $dados_gerais->ft_fundacao_osc,

            //CONTATOS
            'tx_site' => $contato->tx_site,
            'ft_site' => $contato->ft_site,
            'tx_email' => $contato->tx_email,
            'ft_email' => $contato->ft_email,
            'tx_telefone' => $contato->tx_telefone,
            'ft_telefone' => $contato->ft_telefone,
            'bo_nao_possui_site' => $contato->bo_nao_possui_site,
            'bo_nao_possui_email' => $contato->bo_nao_possui_email,
            'bo_nao_possui_sigla_osc' => $contato->bo_nao_possui_sigla_osc,

            //OBJETIVOS
            'objetivos_metas' => $objetivos_metas
        ];

        return $dados_atualizados;

        //$dados_gerais->tx_razao_social_osc =$dados[0]["tx_nome_fantasia_osc"];
    }

    public function getRelTrabalhoAndGovernanca($id)
    {
        $osc = $this->model->find($id);

        $relacoes_trabalho = $osc->relacoes_trabalho;

        $nr_trabalhores = $osc->relacoes_trabalho->nr_trabalhadores_vinculo + $osc->relacoes_trabalho->nr_trabalhadores_deficiencia + $osc->relacoes_trabalho->nr_trabalhadores_voluntarios;

        $relacoes_trabalho['nr_trabalhores'] = $nr_trabalhores;

        $dados = [
            'governanca' => $osc->quadro_de_dirigentes,
            'conselho_fiscal' => $osc->conselho_fiscal,
            'relacoes_trabalho' => $relacoes_trabalho,
        ];

        return $dados;
    }

    public function getProjetos($id)
    {
        $osc = $this->model->find($id);

        $projetos = $osc->projetos;

        $dados = [];

        $total_valor_projetos = 0;
        foreach ($projetos as $projeto) {
            //array_push($dados, ['nome_projeto'] => $projeto->tx_nome_projeto);
            $var = ['id' => $projeto->id_projeto,'titulo' => $projeto->tx_nome_projeto, 'data_inicio' => $projeto->dt_data_inicio_projeto];
            //$total_valor_projetos += $projeto->nr_valor_total_projeto;
            array_push($dados, $var);
        }

        /*
        $resultado = [
            $dados,
            "nr_valor_total" => $total_valor_projetos
        ];
        */
        //array_push($dados, ["nr_valor_total" => $total_valor_projetos]);

        //return $resultado;


        return $dados;
    }

    public function getParticipacaoSocial($id)
    {
        $osc = $this->model->find($id);

        $dados = [
            'conselhos_politicas_publicas' => $osc->conselhos_politicas_publicas,
            'conferencias_politicas_publicas' => $osc->conferencias_politicas_publicas,
            'outros_espacos_participacao_social' => $osc->outros_espacos_participacao_social,
        ];

        return $dados;
    }

    public function getFontesRecursos($id)
    {
        $osc = $this->model->find($id);

        $dados = [
            'conselhos_politicas_publicas' => $osc->conselhos_politicas_publicas,
            'conferencias_politicas_publicas' => $osc->conferencias_politicas_publicas,
            'outros_espacos_participacao_social' => $osc->outros_espacos_participacao_social,
        ];

        return $dados;
    }

    public function update($id, array $data)
    {
        return $this->model->find($id)->update($data);
    }

    public function getListaOscAtualizadas($tam_lista)
    {
        $sql = 'SELECT id_osc, tx_nome_osc FROM portal.vw_log_alteracao ORDER BY dt_alteracao DESC LIMIT '.$tam_lista;

        return DB::select($sql);
    }

    public function getGrafico($tipo_graf)
    {
        $sql = 'SELECT * FROM portal.tb_analise 
                INNER JOIN syst.tb_tipo_grafico ON 
                    tb_analise.tipo_grafico = tb_tipo_grafico.id_grafico 
                WHERE tb_analise.ativo AND tb_analise.id_analise = ' . $tipo_graf;

        $resultado = DB::select($sql);

        $analise = $resultado[0];

        $serie1 = json_decode($analise->series_1);
        $analise->series_1 = $serie1;

        $serie2 = json_decode($analise->series_2);
        $analise->series_2 = $serie2;

        $delimitadores = ["'", "{", "}"];//Utlizado para retirar impecilios para transformação em JSON

        $fontes_n_chaves_e_aspas = str_replace($delimitadores, "", $analise->fontes);
        $vet_fontes = explode(",", $fontes_n_chaves_e_aspas);
        $analise->fontes = $vet_fontes;

        $titulos_n_chaves_e_aspas = str_replace($delimitadores, "", $analise->titulo_colunas);
        $vet_titulos = explode(",", $titulos_n_chaves_e_aspas);
        $analise->titulo_colunas = $vet_titulos;

        $configuracao_n_chaves_e_aspas = str_replace($delimitadores, "", $analise->configuracao);
        $vet_configuracao = explode(",", $configuracao_n_chaves_e_aspas);
        $analise->configuracao = $vet_configuracao;

        return $analise;
    }

    public function getListaOscAreaAtuacaoAndMunicipio($cd_area_atuacao, $cd_municipio, $limit)
    {
        $sql = $query = "SELECT vw_osc_area_atuacao.id_osc, vw_busca_resultado.tx_nome_osc 
			FROM portal.vw_osc_area_atuacao 
			INNER JOIN osc.vw_busca_resultado ON vw_osc_area_atuacao.id_osc = vw_busca_resultado.id_osc
			INNER JOIN osc.vw_geo_osc ON vw_geo_osc.id_osc = vw_osc_area_atuacao.id_osc
            AND vw_osc_area_atuacao.id_osc <> 789809 
			WHERE vw_osc_area_atuacao.cd_area_atuacao = " . $cd_area_atuacao . "
			 AND vw_geo_osc.cd_municipio = " . $cd_municipio . "
			GROUP BY vw_osc_area_atuacao.id_osc, vw_busca_resultado.tx_nome_osc, vw_busca_resultado.tx_nome_osc,  vw_geo_osc.geo_lng, vw_geo_osc.geo_lat
			LIMIT " . $limit;

        $resultado = DB::select($sql);

        return $resultado;
    }

    public function getListaOscAreaAtuacaoAndGEO($cd_area_atuacao, $geo, $limit)
    {
        $sql = $query = "SELECT vw_osc_area_atuacao.id_osc, vw_busca_resultado.tx_nome_osc 
			FROM portal.vw_osc_area_atuacao 
			INNER JOIN osc.vw_busca_resultado ON vw_osc_area_atuacao.id_osc = vw_busca_resultado.id_osc
			INNER JOIN osc.vw_geo_osc ON vw_geo_osc.id_osc = vw_osc_area_atuacao.id_osc
            AND vw_osc_area_atuacao.id_osc <> 789809 
			WHERE vw_osc_area_atuacao.cd_area_atuacao = " . $cd_area_atuacao . "
			GROUP BY vw_osc_area_atuacao.id_osc, vw_busca_resultado.tx_nome_osc, vw_busca_resultado.tx_nome_osc,  vw_geo_osc.geo_lng, vw_geo_osc.geo_lat
			ORDER BY ST_Distance(
			    ST_GeomFromText('POINT(' || vw_geo_osc.geo_lng || ' ' || vw_geo_osc.geo_lat || ')', 4674), 
			    ST_GeomFromText('POINT(" . $geo[1] . " " . $geo[0] . ")', 4674)
		        )
		    LIMIT " . $limit;

        //dd($sql);

        $resultado = DB::select($sql);

        return $resultado;
    }

    public function getListaOscAreaAtuacao($cd_area_atuacao, $limit)
    {
        $sql = $query = "SELECT vw_osc_area_atuacao.id_osc, vw_busca_resultado.tx_nome_osc 
			FROM portal.vw_osc_area_atuacao 
			INNER JOIN osc.vw_busca_resultado ON vw_osc_area_atuacao.id_osc = vw_busca_resultado.id_osc
            AND vw_osc_area_atuacao.id_osc <> 789809 
			WHERE vw_osc_area_atuacao.cd_area_atuacao = " . $cd_area_atuacao . "
			GROUP BY vw_osc_area_atuacao.id_osc, vw_busca_resultado.tx_nome_osc
			LIMIT " . $limit;

        $resultado = DB::select($sql);

        return $resultado;
    }

    public function getPerfilLocalidadeCaracteristicas($id_localidade)
    {
        $sql = $query = "SELECT
			nome_localidade AS tx_localidade,
			CASE
				WHEN tipo_localidade = 'regiao' THEN 'Região'
				WHEN tipo_localidade = 'estado' THEN 'Estado'
				WHEN tipo_localidade = 'municipio' THEN 'Município'
			END AS tx_tipo_localidade
		FROM analysis.vw_perfil_localidade_caracteristicas
		WHERE localidade = " . $id_localidade;

        $resultado = DB::select($sql);

        $analise = $resultado;

        return $analise;
    }

    public function getPopupOSC($id_osc)
    {
        $sql = $query = "SELECT 
			vw_osc_dados_gerais.tx_nome_osc, 
			LTRIM((COALESCE(vw_osc_dados_gerais.tx_endereco, '') || COALESCE(', ' || vw_osc_dados_gerais.nr_localizacao::TEXT, '') || COALESCE(' - ' || vw_osc_dados_gerais.tx_endereco_complemento, '')), ' ,-') AS tx_endereco, 
			(vw_osc_dados_gerais.tx_bairro || ', ' || vw_osc_dados_gerais.tx_nome_municipio || ' - ' || vw_osc_dados_gerais.tx_sigla_uf) AS tx_bairro, 
			vw_osc_dados_gerais.tx_nome_natureza_juridica_osc, 
			vw_osc_dados_gerais.tx_nome_atividade_economica_osc 
		FROM 
			portal.vw_osc_dados_gerais 
		WHERE 
			vw_osc_dados_gerais.id_osc = " . $id_osc;

        $resultado = DB::select($sql);

        return $resultado;
    }

    public function getListaOscsPorIds(array $ids){
        return DB::table('osc.tb_dados_gerais')->select('id_osc', 'tx_razao_social_osc')->whereIn('id_osc', $ids)->get();
    }

    public function getListaOscCnpjAutocomplete($cnpj){
        return DB::table('osc.vw_busca_osc')->where(DB::Raw('CAST(cd_identificador_osc AS TEXT)'), 'like', "$cnpj%")->get();
    }

    public function getListaOscNomeCnpjAutocomplete($texto_busca){
        $numeros = preg_replace('/[^0-9]/', '', $texto_busca);;
        return DB::table('osc.vw_busca_osc')
            ->where(DB::Raw('CAST(cd_identificador_osc AS TEXT)'), 'like', "$numeros%")
            ->orWhere('tx_nome_osc', 'ilike', "%$texto_busca%")
            ->orWhere('tx_razao_social_osc', 'ilike', "%$texto_busca%")
            ->orWhere('tx_nome_fantasia_osc', 'ilike', "%$texto_busca%")
            ->take(30)
            ->get();
    }

}
