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

    public function getBarraPorOSC_OLD($id_osc)
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

//    public function getBarraPorOscComCalculo($id_osc)
    public function getBarraPorOSC($id_osc)
    {
        $regs = $this->model->where('id_osc', $id_osc)->get();

        $pesoDadosGerais = DB::table('portal.tb_peso_barra_transparencia')
            ->where('id_peso_barra_transparencia', 1)
            ->value('peso_secao');

        $pesoAreaAtuacao = DB::table('portal.tb_peso_barra_transparencia')
            ->where('id_peso_barra_transparencia', 2)
            ->value('peso_secao');

        $pesoDescricao = DB::table('portal.tb_peso_barra_transparencia')
            ->where('id_peso_barra_transparencia', 3)
            ->value('peso_secao');

        $pesoTitulosCertificacoes = DB::table('portal.tb_peso_barra_transparencia')
            ->where('id_peso_barra_transparencia', 4)
            ->value('peso_secao');

        $pesoRelacoesTrabalhoGovernanca = DB::table('portal.tb_peso_barra_transparencia')
            ->where('id_peso_barra_transparencia', 5)
            ->value('peso_secao');

        $pesoEspacosParticipacaoSocial = DB::table('portal.tb_peso_barra_transparencia')
            ->where('id_peso_barra_transparencia', 6)
            ->value('peso_secao');

        $pesoProjetosAtividadesProgramas = DB::table('portal.tb_peso_barra_transparencia')
            ->where('id_peso_barra_transparencia', 7)
            ->value('peso_secao');

        $pesoFontesRecursos = DB::table('portal.tb_peso_barra_transparencia')
            ->where('id_peso_barra_transparencia', 8)
            ->value('peso_secao');

        $transparenciaOsc = 0.0
            + $this->getPontuacaoDadosGerais($id_osc) * $pesoDadosGerais / 100
            + $this->getPontuacaoAreaAtuacao($id_osc) * $pesoAreaAtuacao / 100
            + $this->getPontuacaoDescricao($id_osc) * $pesoDescricao / 100
            + $this->getPontuacaoTitulosCertificacoes($id_osc) * $pesoTitulosCertificacoes / 100
            + $this->getPontuacaoRelacoesTrabalhoGovernanca($id_osc) * $pesoRelacoesTrabalhoGovernanca / 100
            + $this->getPontuacaoEspacosParticipacaoSocial($id_osc) * $pesoEspacosParticipacaoSocial / 100
            + $this->getPontuacaoProjetosAtividadesProgramas($id_osc) * $pesoProjetosAtividadesProgramas / 100
            + $this->getPontuacaoFontesRecursos($id_osc) * $pesoFontesRecursos / 100;

        $transparenciaOsc = round($transparenciaOsc, 2);

        $dados_resultado = [
            'id_osc' => $id_osc,

            'transparencia_dados_gerais' => $this->getPontuacaoDadosGerais($id_osc),
            'peso_dados_gerais' => $pesoDadosGerais,

            'transparencia_area_atuacao' => $this->getPontuacaoAreaAtuacao($id_osc),
            'peso_area_atuacao' => $pesoAreaAtuacao,

            'transparencia_descricao' => $this->getPontuacaoDescricao($id_osc),
            'peso_descricao' => $pesoDescricao,

            'transparencia_titulos_certificacoes' => $this->getPontuacaoTitulosCertificacoes($id_osc),
            'peso_titulos_certificacoes' => $pesoTitulosCertificacoes,

            'transparencia_relacoes_trabalho_governanca' => $this->getPontuacaoRelacoesTrabalhoGovernanca($id_osc),
            'peso_relacoes_trabalho_governanca' => $pesoRelacoesTrabalhoGovernanca,

            'transparencia_espacos_participacao_social' => $this->getPontuacaoEspacosParticipacaoSocial($id_osc),
            'peso_espacos_participacao_social' => $pesoEspacosParticipacaoSocial,

            'transparencia_projetos_atividades_programas' => $this->getPontuacaoProjetosAtividadesProgramas($id_osc),
            'peso_projetos_atividades_programas' => $pesoProjetosAtividadesProgramas,

            'transparencia_fontes_recursos' => $this->getPontuacao($id_osc),
            'peso_fontes_recursos' => $pesoFontesRecursos,

            'transparencia_osc' => $transparenciaOsc
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

    public function getPontuacaoDadosGerais(int $osc): float
    {
        $pesoCampo = 100.0 / 12.0;

        $dados = DB::table('osc.tb_dados_gerais as dados_gerais')
            ->leftJoin('osc.tb_contato as contato', 'dados_gerais.id_osc', '=', 'contato.id_osc')
            ->leftJoin('osc.tb_localizacao as localizacao', 'dados_gerais.id_osc', '=', 'localizacao.id_osc')
            ->where('dados_gerais.id_osc', $osc)
            ->select([
                'dados_gerais.*',
                'contato.*',
                'localizacao.*',
                DB::raw("
                    EXISTS (
                        SELECT 1 
                        FROM osc.tb_objetivo_osc 
                        WHERE id_osc = {$osc} 
                          AND cd_meta_osc IS NOT NULL
                    ) as possui_objetivo
                ")
            ])
            ->first();

        if (!$dados) {
            return 0.0;
        }

        $pontuacao = 0.0;

        // 1
        if (!is_null($dados->tx_nome_fantasia_osc)) {
            $pontuacao += $pesoCampo;
        }

        // 2
        if (
            $dados->bo_nao_possui_sigla_osc === true ||
            ($dados->bo_nao_possui_sigla_osc === false && !is_null($dados->tx_sigla_osc))
        ) {
            $pontuacao += $pesoCampo;
        }

        // 3
        if (!is_null($dados->cd_situacao_imovel_osc)) {
            $pontuacao += $pesoCampo;
        }

        // 4
        if (!is_null($dados->tx_nome_responsavel_legal)) {
            $pontuacao += $pesoCampo;
        }

        // 5
        if (!is_null($dados->dt_ano_cadastro_cnpj)) {
            $pontuacao += $pesoCampo;
        }

        // 6
        if (!is_null($dados->dt_fundacao_osc)) {
            $pontuacao += $pesoCampo;
        }

        // 7
        if (!is_null($dados->tx_resumo_osc)) {
            $pontuacao += $pesoCampo;
        }

        // 8
        if (
            $dados->bo_nao_possui_email === true ||
            ($dados->bo_nao_possui_email === false && !is_null($dados->tx_email))
        ) {
            $pontuacao += $pesoCampo;
        }

        // 9
        if (
            $dados->bo_nao_possui_site === true ||
            ($dados->bo_nao_possui_site === false && !is_null($dados->tx_site))
        ) {
            $pontuacao += $pesoCampo;
        }

        // 10
        if (!is_null($dados->tx_endereco)) {
            $pontuacao += $pesoCampo;
        }

        // 11
        if (!is_null($dados->tx_telefone)) {
            $pontuacao += $pesoCampo;
        }

        // 12
        if ($dados->possui_objetivo) {
            $pontuacao += $pesoCampo;
        }

        return round($pontuacao, 2);
    }

    public function getPontuacaoAreaAtuacao(int $osc): float
    {
        $pesoCampo = 100.0 / 2.0;

        // Verifica se existe área de atuação
        $existeAreaAtuacao = DB::table('osc.tb_area_atuacao')
            ->where('id_osc', $osc)
            ->exists();

        // Busca classe de atividade econômica
        $dadosGerais = DB::table('osc.tb_dados_gerais')
            ->where('id_osc', $osc)
            ->select('cd_classe_atividade_economica_osc')
            ->first();

        if (!$dadosGerais) {
            return 0.0;
        }

        $pontuacao = 0.0;

        // 1
        if ($existeAreaAtuacao) {
            $pontuacao += $pesoCampo;
        }

        // 2
        if (!is_null($dadosGerais->cd_classe_atividade_economica_osc)) {
            $pontuacao += $pesoCampo;
        }

        return $pontuacao;
    }

    public function getPontuacaoDescricao(int $osc): float
    {
        $pesoCampo = 100.0 / 5.0; // 20

        $dados = DB::table('osc.tb_dados_gerais')
            ->where('id_osc', $osc)
            ->select([
                'tx_historico',
                'tx_missao_osc',
                'tx_visao_osc',
                'tx_finalidades_estatutarias',
                'tx_link_estatuto_osc',
            ])
            ->first();

        if (!$dados) {
            return 0.0;
        }

        $pontuacao = 0.0;

        if (!is_null($dados->tx_historico)) {
            $pontuacao += $pesoCampo;
        }

        if (!is_null($dados->tx_missao_osc)) {
            $pontuacao += $pesoCampo;
        }

        if (!is_null($dados->tx_visao_osc)) {
            $pontuacao += $pesoCampo;
        }

        if (!is_null($dados->tx_finalidades_estatutarias)) {
            $pontuacao += $pesoCampo;
        }

        if (!is_null($dados->tx_link_estatuto_osc)) {
            $pontuacao += $pesoCampo;
        }

        return $pontuacao;
    }

    public function getPontuacaoTitulosCertificacoes(int $osc): float
    {
        $existeCertificado = DB::table('osc.tb_certificado')
            ->where('id_osc', $osc)
            ->exists();

        return $existeCertificado ? 100.0 : 0.0;
    }

    public function getPontuacaoRelacoesTrabalhoGovernanca(int $osc): float
    {
        $pesoCampo = 100.0 / 5.0; // 20

        // 1) Soma das relações de trabalho
        $relacoes = DB::table('osc.tb_relacoes_trabalho')
            ->where('id_osc', $osc)
            ->select([
                'nr_trabalhadores_vinculo',
                'nr_trabalhadores_deficiencia',
                'nr_trabalhadores_voluntarios',
            ])
            ->first();

        $sumRelacoesTrabalho = 0.0;

        if ($relacoes) {
            if (!is_null($relacoes->nr_trabalhadores_vinculo)) {
                $sumRelacoesTrabalho += $pesoCampo;
            }

            if (!is_null($relacoes->nr_trabalhadores_deficiencia)) {
                $sumRelacoesTrabalho += $pesoCampo;
            }

            if (!is_null($relacoes->nr_trabalhadores_voluntarios)) {
                $sumRelacoesTrabalho += $pesoCampo;
            }
        }

        // 2) Governança
        $existeDirigente = DB::table('osc.tb_governanca')
            ->where('id_osc', $osc)
            ->whereNotNull('tx_nome_dirigente')
            ->exists();

        $existeConselheiro = DB::table('osc.tb_conselho_fiscal')
            ->where('id_osc', $osc)
            ->whereNotNull('tx_nome_conselheiro')
            ->exists();

        $pontuacao = 0.0;

        if ($existeDirigente) {
            $pontuacao += $pesoCampo;
        }

        if ($existeConselheiro) {
            $pontuacao += $pesoCampo;
        }

        // 3) Soma com relações de trabalho
        $pontuacao += $sumRelacoesTrabalho;

        return $pontuacao;
    }

    public function getPontuacaoEspacosParticipacaoSocial(int $osc): float
    {
        $pesoCampo = 100.0 / 10.0; // 10

        $pontuacao = 0.0;

        // -------- CONSELHO --------

        if (DB::table('osc.tb_participacao_social_conselho')
            ->where('id_osc', $osc)
            ->whereNotNull('cd_conselho')
            ->exists()
        ) {
            $pontuacao += $pesoCampo;
        }

        if (DB::table('osc.tb_participacao_social_conselho')
            ->where('id_osc', $osc)
            ->whereNotNull('cd_tipo_participacao')
            ->exists()
        ) {
            $pontuacao += $pesoCampo;
        }

        if (DB::table('osc.tb_participacao_social_conselho')
            ->where('id_osc', $osc)
            ->whereNotNull('cd_periodicidade_reuniao_conselho')
            ->exists()
        ) {
            $pontuacao += $pesoCampo;
        }

        if (DB::table('osc.tb_participacao_social_conselho')
            ->where('id_osc', $osc)
            ->whereNotNull('dt_data_inicio_conselho')
            ->exists()
        ) {
            $pontuacao += $pesoCampo;
        }

        if (DB::table('osc.tb_participacao_social_conselho')
            ->where('id_osc', $osc)
            ->whereNotNull('dt_data_fim_conselho')
            ->exists()
        ) {
            $pontuacao += $pesoCampo;
        }

        // Representante do conselho
        if (DB::table('osc.tb_representante_conselho as rc')
            ->join(
                'osc.tb_participacao_social_conselho as pc',
                'rc.id_participacao_social_conselho',
                '=',
                'pc.id_conselho'
            )
            ->where('pc.id_osc', $osc)
            ->whereNotNull('rc.tx_nome_representante_conselho')
            ->exists()
        ) {
            $pontuacao += $pesoCampo;
        }

        // -------- CONFERÊNCIA --------

        if (DB::table('osc.tb_participacao_social_conferencia')
            ->where('id_osc', $osc)
            ->whereNotNull('cd_conferencia')
            ->exists()
        ) {
            $pontuacao += $pesoCampo;
        }

        if (DB::table('osc.tb_participacao_social_conferencia')
            ->where('id_osc', $osc)
            ->whereNotNull('dt_ano_realizacao')
            ->exists()
        ) {
            $pontuacao += $pesoCampo;
        }

        if (DB::table('osc.tb_participacao_social_conferencia')
            ->where('id_osc', $osc)
            ->whereNotNull('cd_forma_participacao_conferencia')
            ->exists()
        ) {
            $pontuacao += $pesoCampo;
        }

        // -------- OUTRA PARTICIPAÇÃO --------

        if (DB::table('osc.tb_participacao_social_outra')
            ->where('id_osc', $osc)
            ->whereNotNull('tx_nome_participacao_social_outra')
            ->exists()
        ) {
            $pontuacao += $pesoCampo;
        }

        return $pontuacao;
    }

    public function getPontuacaoProjetosAtividadesProgramas(int $osc): float
    {
        $pesoCampo = 100.0 / 10.0; // 10

        $pontuacao = 0.0;

        // -------- PROJETO --------

        if (DB::table('osc.tb_projeto')
            ->where('id_osc', $osc)
            ->whereNotNull('tx_descricao_projeto')
            ->exists()
        ) {
            $pontuacao += $pesoCampo;
        }

        if (DB::table('osc.tb_projeto')
            ->where('id_osc', $osc)
            ->whereNotNull('cd_status_projeto')
            ->exists()
        ) {
            $pontuacao += $pesoCampo;
        }

        if (DB::table('osc.tb_projeto')
            ->where('id_osc', $osc)
            ->whereNotNull('dt_data_inicio_projeto')
            ->exists()
        ) {
            $pontuacao += $pesoCampo;
        }

        if (DB::table('osc.tb_projeto')
            ->where('id_osc', $osc)
            ->whereNotNull('dt_data_fim_projeto')
            ->exists()
        ) {
            $pontuacao += $pesoCampo;
        }

        if (DB::table('osc.tb_projeto')
            ->where('id_osc', $osc)
            ->whereNotNull('nr_valor_total_projeto')
            ->exists()
        ) {
            $pontuacao += $pesoCampo;
        }

        if (DB::table('osc.tb_projeto')
            ->where('id_osc', $osc)
            ->whereNotNull('nr_valor_captado_projeto')
            ->exists()
        ) {
            $pontuacao += $pesoCampo;
        }

        if (DB::table('osc.tb_projeto')
            ->where('id_osc', $osc)
            ->whereNotNull('cd_abrangencia_projeto')
            ->exists()
        ) {
            $pontuacao += $pesoCampo;
        }

        if (DB::table('osc.tb_projeto')
            ->where('id_osc', $osc)
            ->whereNotNull('cd_zona_atuacao_projeto')
            ->exists()
        ) {
            $pontuacao += $pesoCampo;
        }

        // -------- FONTE DE RECURSOS --------

        if (DB::table('osc.tb_fonte_recursos_projeto as fr')
            ->join('osc.tb_projeto as p', 'fr.id_projeto', '=', 'p.id_projeto')
            ->where('p.id_osc', $osc)
            ->whereNotNull('fr.cd_origem_fonte_recursos_projeto')
            ->exists()
        ) {
            $pontuacao += $pesoCampo;
        }

        // -------- OBJETIVO DO PROJETO --------

        if (DB::table('osc.tb_objetivo_projeto as op')
            ->join('osc.tb_projeto as p', 'op.id_projeto', '=', 'p.id_projeto')
            ->where('p.id_osc', $osc)
            ->whereNotNull('op.cd_meta_projeto')
            ->exists()
        ) {
            $pontuacao += $pesoCampo;
        }

        return $pontuacao;
    }

    public function getPontuacaoFontesRecursos(int $osc): float
    {
        $pesoCampo = 100.0 / 4.0; // 25

        $rows = DB::table('osc.tb_recursos_osc as r')
            ->join(
                'syst.dc_fonte_recursos_osc as fr', // 🔴 TROQUE para o nome real
                'r.cd_fonte_recursos_osc',                  // 🔴 TROQUE a chave
                '=',
                'fr.cd_fonte_recursos_osc'                  // 🔴 TROQUE a chave
            )
            ->join(
                'syst.dc_origem_fonte_recursos_osc as d',
                'fr.cd_origem_fonte_recursos_osc',
                '=',
                'd.cd_origem_fonte_recursos_osc'
            )
            ->where('r.id_osc', $osc)
            ->select('d.tx_nome_origem_fonte_recursos_osc')
            ->get();

        if ($rows->isEmpty()) {
            return 0.0;
        }

        $soma = 0.0;
        $count = 0;

        foreach ($rows as $row) {
            // COUNT(*) do seu SQL conta todas as linhas
            $count++;

            if ($row->tx_nome_origem_fonte_recursos_osc === null) {
                continue;
            }

            switch ($row->tx_nome_origem_fonte_recursos_osc) {
                case 'Recursos públicos':
                case 'Recursos privados':
                case 'Recursos não financeiros':
                case 'Recursos próprios':
                    $soma += $pesoCampo;
                    break;
            }
        }

        if ($count === 0) {
            return 0.0;
        }

        return round($soma / $count, 2);
    }

    public function getPontuacao(int $osc): float
    {
        $pesoCampo = 100.0 / 4.0; // 25

        $rows = DB::table('osc.tb_recursos_osc as r')
            ->join(
                'syst.dc_fonte_recursos_osc as fr',
                'r.cd_fonte_recursos_osc',
                '=',
                'fr.cd_fonte_recursos_osc'
            )
            ->join(
                'syst.dc_origem_fonte_recursos_osc as d',
                'fr.cd_origem_fonte_recursos_osc',
                '=',
                'd.cd_origem_fonte_recursos_osc'
            )
            ->where('r.id_osc', $osc)
            ->select('d.tx_nome_origem_fonte_recursos_osc')
            ->distinct() // 🔥 importante: garante 1 por tipo
            ->get();

        if ($rows->isEmpty()) {
            return 0.0;
        }

        $mapaPontuacao = [
            'Recursos públicos'        => 25.0,
            'Recursos privados'       => 25.0,
            'Recursos não financeiros'=> 25.0,
            'Recursos próprios'       => 25.0,
        ];

        $soma = 0.0;

        foreach ($rows as $row) {
            $nome = $row->tx_nome_origem_fonte_recursos_osc;

            if ($nome !== null && isset($mapaPontuacao[$nome])) {
                $soma += $mapaPontuacao[$nome];
            }
        }

    // segurança extra
        return min(100.0, round($soma, 2));

    }
}
