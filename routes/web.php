<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/** @var TYPE_NAME $router */

use App\Services\Syst\DCSituacaoImovelService;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/api/documentation', function () {
    return view('swagger-lume::index');
});

//ROTA PAR CHEKAR AUTENTICAÇÃO DO USUARIO
$router->get('/api/check-token', ['middleware' => 'auth', function(){
    return 1;
}]);

$router->get('/api/', function () use ($router) {
        return ["description: API de dados do Mapa das Organizações da Sociedade Civil.",
        "version: 3.0.0",
        "homepage: https://mapaosc.ipea.gov.br/",
        "keywords: 'php', 'lumen', 'api', 'rest', 'server, 'http', 'json', 'mapaosc', 'ipea'",
        "license: LGPL-3.0",
        "authors: {Thiago Giannini Ramos, Fábio Barreto, Bruno Passos, Relison Galvão}"
    ];
});

$router->post('/api/user/','UsuarioController@store');
$router->group(['middleware' => 'auth'], function() use ($router){
    $router->get('/api/get-user-auth', 'UsuarioController@getUserAuth');
    $router->put('/api/user/{id_usuario}', 'UsuarioController@update');
    $router->post('/api/trocar-senha-na-area-restrita/','UsuarioController@trocarSenhaNaAreaRestrita');
});
$router->get('/api/activate-user/{id_usuario}/{hash}','UsuarioController@activate');
$router->post('/api/trocar-senha-user/','UsuarioController@trocarSenha');
$router->post('/api/esqueci-senha/','UsuarioController@esqueciSenha');

//Esta rota deve ser usada para gerar um key que deve ser colocado no .env. Esse key necessario para o uso do passport
$router->get('/key', function() {
    return \Illuminate\Support\Str::random(32);
});

$router->group(['prefix' => '/api'], function() use ($router) {

    //PARA ALIMENTAR O FRONT COM TODAS ESCOLHAS POSSIVEIS DA CATEGORIA


//---Certificados da OSC---///
    $router->get('/certificado/', 'DCCertificadoController@getAll');
    $router->get('/certificado/{id}', 'DCCertificadoController@get');

//---Indices do IPEA DATA---///
    $router->get('/indice_ipeadata/', 'DCIndiceController@getAll');

//---Situação do Imóvel---///
    $router->get('/situacao_imovel/', 'DCSituacaoImovelController@getAll');
    $router->get('/situacao_imovel/{id}', 'DCSituacaoImovelController@get');

//---Status do Projeto---///
    $router->get('/status_projeto/', 'DCStatusProjetoController@getAll');
    $router->get('/status_projeto/{id}', 'DCStatusProjetoController@get');

//---Abrangência do Projeto---///
    $router->get('/abrangencia_projeto/', 'DCAbrangenciaProjetoController@getAll');
    $router->get('/abrangencia_projeto/{id}', 'DCAbrangenciaProjetoController@get');

//---Zona de Atuação do Projeto---///
    $router->get('/zona_atuacao_projeto/', 'DCZonaAtuacaoProjetoController@getAll');
    $router->get('/zona_atuacao_projeto/{id}', 'DCZonaAtuacaoProjetoController@get');

//---Origem Fonte de Recursos do Projeto---///
    $router->get('/origem_fonte_recurso_projeto/', 'DCOrigemFonteRecursosProjetoController@getAll');
    $router->get('/origem_fonte_recurso_projeto/{id}', 'DCOrigemFonteRecursosProjetoController@get');

//---Tipo de Participaao---///
    $router->get('/tipo_participacao/', 'DCTipoParticipacaoController@getAll');
    $router->get('/tipo_participacao/{id}', 'DCTipoParticipacaoController@get');

//---Classe Econômica---///
    $router->get('/classe_economica/autocomplete/{param}', 'DCClasseAtividadeEconomicaController@getAutocomplete');

//---ODS----//
    $router->get('/objetivos/', 'DCObjetivoProjetoController@getAll');
    $router->get('/objetivos/metas/{id_obj}', 'DCMetaProjetoController@getMetasPorObjetivo');

//---AREA E SUBAREA DE ATUAÇÃO----//
    $router->get('/area_atuacao/', 'DCAreaAtuacaoController@getAll');
    $router->get('/subarea_atuacao/', 'DCSubAreaAtuacaoController@getAll');

//---SITUAÇÃO CADASTRAL----//
    $router->get('/situacao_cadastral/', 'DCSituacaoCadastralController@getAll');
    $router->get('/situacao_cadastral/{id}', 'DCSituacaoCadastralController@get');

//---PARTICIPAÇÃO SOCIAL----//
    $router->get('/ps_conselhos/', 'DCConselhoController@getAll');
    $router->get('/ps_conselhos/{id}', 'DCConselhoController@get');
    $router->get('/ps_conselhos_periodicidade/', 'DCPeriodicidadeReuniaoConselhoController@getAll');

    //--------------------------------Conferência-------------------------//
    $router->get('/ps_conferencias/', 'DCConferenciaController@getAll');
    $router->get('/ps_conferencia/{id}', 'DCConferenciaController@get');
    $router->get('/ps_conferencias_formas/', 'DCFormaParticipacaoConferenciaController@getAll');
    $router->get('/ps_conferencia_forma/{id}', 'DCFormaParticipacaoConferenciaController@get');

    //------------------------QUALIFICAÇÃO SÓCIO (QUADRO SOCIETÁRIO) -------------------------------------//
    $router->get('/qualificacao-socio/all', 'DCQualificacaoSocioController@getAll');
    $router->get('/qualificacao-socio/{id}', 'DCQualificacaoSocioController@get');

    //------------------------QUALIFICAÇÃO SÓCIO (QUADRO SOCIETÁRIO) -------------------------------------//
    $router->get('/tipo-socio/all', 'DCTipoSocioController@getAll');
    $router->get('/tipo-socio/{id}', 'DCTipoSocioController@get');
    //--------------------------//-----------------------------------------------------------//

    //-----------------------------------Outra-------------------------------//
    $router->post('/ps_outra/', 'ParticipacaoSocialOutraController@store');

    //---ROTAS da BUSCA HOME----//
    $router->get('/busca/municipio/{texto_busca}', 'DCBuscaHomeController@getListaMunicipios');
    $router->get('/busca/estado/{texto_busca}', 'DCBuscaHomeController@getListaEstados');
    $router->get('/busca/regiao/{texto_busca}', 'DCBuscaHomeController@getListaRegioes');
    $router->get('/busca/todas_localizacoes/{texto_busca}', 'DCBuscaHomeController@getListaTodasLocalizacoes');
    $router->get('/busca/cnpj/{cnpj}', 'OscController@getListaOscCnpjAutocomplete');
    $router->get('/busca/osc/{texto_busca}', 'OscController@getListaOscNomeCnpjAutocomplete');
    $router->get('/busca/osc-autocomplete', 'OscController@getListaOscNomeCnpjAutocomplete');


    //ROTAS PARA ALIMENTAR DADOS DO MAPA
    //---ROTAS LISTA OSC POR REGIÃO----//
    $router->get('/lista_osc/{pagina}', 'DCListaOSCsRegiaoController@getListaOSCsTotal');
    $router->get('/lista_osc/estado/{id_localidade}/{pagina}', 'DCListaOSCsRegiaoController@getListaOSCsEstado');
    $router->get('/lista_osc/municipio/{id_localidade}/{pagina}', 'DCListaOSCsRegiaoController@getListaOSCsMunicipio');
    $router->get('/lista_osc/regiao/{id_localidade}/{pagina}', 'DCListaOSCsRegiaoController@getListaOSCsRegiao');

    //Lista de Oscs Por Area de Atuação / Municipip / Geolocalização
    $router->get('/lista_por_area_atuacao/{cd_area_atuacao}/municipio/{cd_municipio}', 'OscController@getListaOscAreaAtuacaoAndMunicipio');
    $router->get('/lista_por_area_atuacao/{cd_area_atuacao}/{lat}/{lon}', 'OscController@getListaOscAreaAtuacaoAndGEO');
    $router->get('/lista_por_area_atuacao/{cd_area_atuacao}', 'OscController@getListaOscAreaAtuacao');

    //---- ROTAS PARA DADOS DE GEOLOCALIZAÇÃO AGRUPADOS
    $router->get('/geo/elem/{id}', 'DCGeoClusterController@get');
    $router->get('/geo/regioes/', 'DCGeoClusterController@getRegiaoAll');
    $router->get('/geo/estados/', 'DCGeoClusterController@getEstadoAll');

    $router->get('/geo/estados/regiao/{id_regiao}', 'DCGeoClusterController@getEstadosPorRegiao');
    $router->get('/geo/municipios/estado/{id_estado}', 'DCGeoClusterController@getMunicipiosPorEstado');

    $router->get('/geo/oscs/estado/{id_estado}', 'DCGeoClusterController@getOSCsPorEstado');
    $router->get('/geo/oscs/municipio/{id_municipio}', 'DCGeoClusterController@getOSCsPorMunicipio');

    //--------------------------//-----------------------------------------------------------//
    //---- ROTAS PARA DADOS DE IDH e GEOLOCALIZAÇÃO IPEADATA
    $router->get('/ipeadata/uff/{id}', 'DCIpeadataUffController@get');
    $router->get('/ipeadata/uffs/', 'DCIpeadataUffController@getAll');
    $router->get('/ipeadata/uffs/regiao/{id_regiao}', 'DCIpeadataUffController@getAllPorRegiao');

    $router->get('/ipeadata/municipio/{id}', 'DCIpeadataMunicipioController@get');
    $router->get('/ipeadata/municipios/', 'DCIpeadataMunicipioController@getAll');
    $router->get('/ipeadata/municipios/estado/{id_estado}', 'DCIpeadataMunicipioController@getAllPorEstado');

    //PERFIL LOCALIDADE
    $router->get('/perfil_localidade/evolucao_anual/{idlocalidade}', 'DCPerfilLocalidadeController@getEvolucaoQtdOscPorAno');
    $router->get('/perfil_localidade/caracteristicas/{idlocalidade}', 'DCPerfilLocalidadeController@getCaracteristicas');
    $router->get('/perfil_localidade/natureza_juridica/{idlocalidade}', 'DCPerfilLocalidadeController@getQtdNaturezaJuridica');
    $router->get('/perfil_localidade/repasse_recursos/{idlocalidade}', 'DCPerfilLocalidadeController@getRepasseRecursos');
    $router->get('/perfil_localidade/transferencias_federais/{idlocalidade}', 'DCPerfilLocalidadeController@getTransferenciasFederais');
    $router->get('/perfil_localidade/qtds_areas_atuacao/{idlocalidade}', 'DCPerfilLocalidadeController@getQtdOscPorAreasAtuacao');
    $router->get('/perfil_localidade/qtds_trabalhadores/{idlocalidade}', 'DCPerfilLocalidadeController@getQtdTrabalhadores');


     //-----------------------------------Inserir dados de perfil de acesso---------------------------//
     $router->post('/dados_perfil_de_acesso/', 'DadosPerfilDeAcessoController@store');

});

//ROTAS QUE PRECISAM DA AUTENTICAÇÃO DO USUARIO
//$router->group(['prefix' => '/api/osc'], function() use ($router){
$router->group(['middleware' => 'auth', 'prefix' => '/api/osc'], function() use ($router){

    //REPRESENTACAO OSC (ASSOCIAÇÃO COM USUÁRIOS)
    $router->get('/representacao/{id_osc}/{id_usuario}', 'RepresentacaoController@getRepresetacaoPorOscAndUsuario');
    $router->post('/representacao/', 'RepresentacaoController@store');
    $router->delete('/representacao/{id}', 'RepresentacaoController@delete');

    //ROTAS PADA ASSINATURA DE TERMOS PELO REPRESENTANTE USUARIO
    $router->get('/assinatura-termos/{id}', 'AssinaturaTermoController@get');
    $router->get('/assinatura-termos/', 'AssinaturaTermoController@getAll');
    $router->get('/assinatura-termos/all-por-representacao/{id_representacao}', 'AssinaturaTermoController@getAllPorRepresentacao');
    $router->get('/assinatura-termos/representacao/{id_representacao}/termo/{id_termo}', 'AssinaturaTermoController@getPorRepresentacaoAndTermo');
    $router->post('/assinatura-termos', 'AssinaturaTermoController@store');
    $router->delete('/assinatura-termos/{id}', 'AssinaturaTermoController@delete');

    //ROTAS PADA GERENCIAMENTOS DE TERMOS (CMS)
    $router->put('/termos/{id}', 'TermoController@update');
    $router->post('/termos', 'TermoController@store');
    $router->delete('/termos/{id_termo}', 'TermoController@delete');

    //ROTAS PADA DADOS DO REPRESENTANTE USUARIO
    $router->post('/user', 'OscController@getFromUsuario');

    //ROTAS GERAIS DO MODELO OSC
    $router->get('/list-oscs-usuario', 'OscController@getListaOscUsuarioAutenticado');
    $router->post('/', 'OscController@store');
    $router->put('/{id}', 'OscController@update');
    $router->delete('/{id}', 'OscController@destroy');

    //INFORMAÇÕES DE DADOS GERAIS
    $router->put('/dados_gerais/{id}', 'OscController@updateDadosGerais');

    //UPDATE IMAGEM OSC
    $router->post('/logo/{id}', 'OscController@updateLogo');

    //INFORMAÇÕES DE AREA E SUBAREA DE ATUAÇÃO DA OSC
    $router->put('/area_atuacao/{id}', 'AreaAtuacaoController@update');
    $router->post('/area_atuacao/', 'AreaAtuacaoController@store');
    $router->delete('/area_atuacao/{id}', 'AreaAtuacaoController@delete');

    //INFORMAÇÕES DE DESCRIÇÃO DA OSC
    $router->put('/descricao/{id}', 'DadosGeraisController@updateDescricao');

    //---------------------------------Objetivos (ODS) OSC--------------------------------------//
    $router->put('/objetivo/{id}', 'ObjetivoOscController@update');
    $router->post('/objetivo/', 'ObjetivoOscController@store');
    $router->delete('/objetivo/{id}', 'ObjetivoOscController@delete');

    //INFORMAÇÕES DE TITULAÇÕES E CERTIFICAÇÕES
    $router->post('/certificado/', 'CertificadoController@store');
    $router->delete('/certificado/{id_osc}', 'CertificadoController@delete');
    $router->put('/certificado/{id}', 'CertificadoController@update');

    //---------------------Relações de Trabalho-----------------------------------//
    $router->put('/rel_trabalho/{id_osc}', 'RelacoesTrabalhoController@update');

    //---------------------Governança----------------------------------------------//
    $router->put('/governanca/{id}', 'GovernancaController@update');
    $router->post('/governanca/', 'GovernancaController@store');
    $router->delete('/governanca/{id}', 'GovernancaController@delete');

    //---------------------Conselho Fiscal----------------------------------------------//
    $router->post('/conselho/', 'ConselhoFiscalController@store');
    $router->put('/conselho/{id}', 'ConselhoFiscalController@update');
    $router->delete('/conselho/{id}', 'ConselhoFiscalController@delete');

    //------------------------------Conselho-----------------------------//
    $router->post('/ps_conselho/', 'ParticipacaoSocialConselhoController@store');
    $router->put('/ps_conselho/{id}', 'ParticipacaoSocialConselhoController@update');
    $router->delete('/ps_conselho/{id}', 'ParticipacaoSocialConselhoController@delete');

    //--------------------------------Conferência-------------------------//
    $router->post('/ps_conferencia/', 'ParticipacaoSocialConferenciaController@store');
    $router->put('/ps_conferencia/{id}', 'ParticipacaoSocialConferenciaController@update');
    $router->delete('/ps_conferencia/{id}', 'ParticipacaoSocialConferenciaController@delete');

    //-----------------------------------Outra-------------------------------//
    $router->post('/ps_outra/', 'ParticipacaoSocialOutraController@store');
    $router->put('/ps_outra/{id}', 'ParticipacaoSocialOutraController@update');
    $router->delete('/ps_outra/{id}', 'ParticipacaoSocialOutraController@delete');

    //INFORMAÇÕES DE FONTES DE RECURSOS DA OSC
    $router->post('/fonte_recursos/', 'FonteRecursosController@store');
    $router->put('/fonte_recursos/{id}', 'FonteRecursosController@update');
    $router->delete('/fonte_recursos/{id}', 'FonteRecursosController@delete');

    //INFORMAÇÕES DE RECURSOS DA OSC
    $router->post('/recursos/', 'RecursosOSCController@store');
    $router->put('/recursos/{id}', 'RecursosOSCController@update');
    $router->delete('/recursos/{id}', 'RecursosOSCController@delete');

    //INFORMAÇÕES DE PROJETOS
    $router->put('/projeto/{id}', 'ProjetoController@update');
    $router->post('/projeto/', 'ProjetoController@store');
    $router->delete('/projeto/{id}', 'ProjetoController@delete');

    //------------------------------Parceiras OSC Projeto--------------------------------------//
    $router->put('/projeto/parceira/{id}', 'OscParceiraProjetoController@update');
    $router->post('/projeto/parceira/', 'OscParceiraProjetoController@store');
    $router->delete('/projeto/parceira/{id}', 'OscParceiraProjetoController@delete');

    //-------------------Tipo Parcerias Projeto-----------------------//
    $router->put('/projeto/tipo_parceria/{id}', 'TipoParceriaProjetoController@update');
    $router->post('/projeto/tipo_parceria/', 'TipoParceriaProjetoController@store');
    $router->delete('/projeto/tipo_parceria/{id}', 'TipoParceriaProjetoController@delete');

    //----------------------------Localizações Projeto---------------------------//
    $router->put('/projeto/localizacao/{id}', 'LocalizacaoProjetoController@update');
    $router->post('/projeto/localizacao/', 'LocalizacaoProjetoController@store');
    $router->delete('/projeto/localizacao/{id}', 'LocalizacaoProjetoController@delete');

    //-----------------------------Financiador Projeto------------------------------//
    $router->put('/projeto/financiador/{id}', 'FinanciadorProjetoController@update');
    $router->post('/projeto/financiador/', 'FinanciadorProjetoController@store');
    $router->delete('/projeto/financiador/{id}', 'FinanciadorProjetoController@delete');

    //---------------------------------Objetivos Projeto--------------------------------------//
    $router->put('/projeto/objetivo/{id}', 'ObjetivoProjetoController@update');
    $router->post('/projeto/objetivo/', 'ObjetivoProjetoController@store');
    $router->delete('/projeto/objetivo/{id}', 'ObjetivoProjetoController@delete');

    //-----------------------------------Publico Beneficiado Projeto---------------------------//
    $router->put('/projeto/publico/{id}', 'PublicoBeneficiadoProjetoController@update');
    $router->post('/projeto/publico/', 'PublicoBeneficiadoProjetoController@store');
    $router->delete('/projeto/publico/{id}', 'PublicoBeneficiadoProjetoController@delete');

    //-----------------------------------Fontes de Recursos Projeto---------------------------//
    $router->put('/projeto/recurso/{id}', 'FonteRecursosProjetoController@update');
    $router->post('/projeto/recurso/', 'FonteRecursosProjetoController@store');
    $router->delete('/projeto/recurso/{id}', 'FonteRecursosProjetoController@delete');

    //------------------------QUADRO SOCIETÁRIO OSC-------------------------------------//
    $router->post('/quadro-societario/', 'QuadroSocietarioController@store');
    $router->delete('/quadro-societario/{id}', 'QuadroSocietarioController@delete');
});

//ROTAS SEM AUTENTICAÇÃO DO USUARIO
$router->group(['prefix' => '/api/osc'], function() use ($router){

    //ROTAS PADA GERENCIAMENTOS DE TERMOS (CMS)
    $router->get('/termos/{id}', 'TermoController@get');
    $router->get('/termos', 'TermoController@getAll');

    //BUSCA AVANÇADA
    $router->get('/busca_avancada/{type_result}/{limit}/{offset}', 'BuscaAvancadaController@buscarOSCs');
    $router->post('/busca_avancada/{type_result}/{limit}/{offset}', 'BuscaAvancadaController@buscarOSCs');
    $router->post('/exportar/', 'BuscaAvancadaController@exportarOscs');

    $router->get('/busca/geo/{tx_parametro}', 'DCGeoClusterController@getOSCsPorRazaoSocial');

    //ROTAS BARRA DE TRANSPARENCIA OSC
    $router->get('/indice_preenchimento/{id_osc}', 'BarratransparenciaController@getBarraPorOSC');
    $router->get('/indice_preenchimento_com_calculo/{id_osc}', 'BarratransparenciaController@getBarraPorOscComCalculo');

    //INFORMAÇÕES RESUMIDAS PARA SELEÇÃO NO MAPA
    $router->get('/popup/{id_osc}', 'OscController@getPopupOSC');

    //ROTAS GERAIS DO MODELO OSC
    $router->get('/', 'OscController@getAll');
    $router->get('/{id}', 'OscController@get');
    $router->get('/quantitativo/situacao-cadastral', 'OscController@getQuantitativoOscPorSituacaoCadastral');

    //ROTAS PARA POPULAR DADOS DA HOME

    //Listas das recentemente atualizadas
    $router->get('/lista_atualizada/{tam}', 'OscController@getListaOscAtualizadas');

    //Gráficos da home
    $router->get('/grafico/{tipo}', 'OscController@getGrafico');

    //INFORMAÇÕES DE CABEÇALHO
    $router->get('/cabecalho/{id}', 'OscController@getCabecalho');

    //INFORMAÇÕES DE DADOS GERAIS
    $router->get('/dados_gerais/{id}', 'OscController@getDadosGerais');
    $router->get('/logo/{id}', 'OscController@getLogo');

    //INFORMAÇÕES DE AREA E SUBAREA DE ATUAÇÃO DA OSC
    $router->get('/areas_atuacao/{id_osc}', 'AreaAtuacaoController@getAreasAtuacaoPorOSC');
    $router->get('/area_atuacao/{id}', 'AreaAtuacaoController@get');

    //INFORMAÇÕES DE AREA E SUBAREA DE ATUAÇÃO DA OSC DEFINIDAS PELO REPRESENTANTE
    $router->get('/areas_atuacao_rep/{id_osc}', 'AreaAtuacaoRepresentanteController@getAreasAtuacaoRepPorOSC');
    $router->get('/area_atuacao_rep/{id}', 'AreaAtuacaoRepresentanteController@get');
    $router->put('/area_atuacao_rep/{id}', 'AreaAtuacaoRepresentanteController@update');
    $router->post('/area_atuacao_rep/', 'AreaAtuacaoRepresentanteController@store');
    $router->delete('/area_atuacao_rep/{id}', 'AreaAtuacaoRepresentanteController@delete');

    //INFORMAÇÕES DE DESCRIÇÃO DA OSC
    $router->get('/descricao/{id}', 'DadosGeraisController@getDescricao');

    //---------------------------------Objetivos (ODS) OSC--------------------------------------//
    $router->get('/objetivos/{id_projeto}', 'ObjetivoOscController@getObjetivosPorOsc');
    $router->get('/objetivo/{id}', 'ObjetivoOscController@get');

    //INFORMAÇÕES DE TITULAÇÕES E CERTIFICAÇÕES
    $router->get('/certificado/{id}', 'CertificadoController@get');
    $router->get('/certificados/{id_osc}', 'CertificadoController@getCertificadosPorOSC');

    //INFORMAÇÕES DAS RELAÇÕES DE TRABALHO E GOVERNANÇA
    $router->get('/rel_trabalho_e_governanca/{id_osc}', 'OscController@getRelTrabalhoAndGovernanca');

    //---------------------Relações de Trabalho-----------------------------------//
    $router->get('/rel_trabalho/{id_osc}', 'RelacoesTrabalhoController@get');

    //---------------------Governança----------------------------------------------//
    $router->get('/governanca/{id}', 'GovernancaController@get');

    //---------------------Conselho Fiscal----------------------------------------------//
    $router->get('/conselho/{id}', 'ConselhoFiscalController@get');

    //INFORMAÇÕES DE ESPAÇOS DE PARTICIPAÇÃO SOCIAL
    $router->get('/participacao_social/{id}', 'OscController@getParticipacaoSocial');

    //------------------------------Conselho-----------------------------//
    $router->get('/ps_conselho/{id}', 'ParticipacaoSocialConselhoController@get');
    $router->get('/ps_conselhos/{id}', 'ParticipacaoSocialConselhoController@getParticipacaoSocialConselhoPorOSC');

    //--------------------------------Conferência-------------------------//
    $router->get('/ps_conferencia/{id}', 'ParticipacaoSocialConferenciaController@get');
    $router->get('/ps_conferencias/{id}', 'ParticipacaoSocialConferenciaController@getParticipacaoSocialConferenciaPorOSC');

    //-----------------------------------Outra-------------------------------//
    $router->get('/ps_outra/{id}', 'ParticipacaoSocialOutraController@get');
    $router->get('/ps_outras/{id}', 'ParticipacaoSocialOutraController@getParticipacaoSocialOutraPorOSC');

  //INFORMAÇÕES DE RECURSOS DA OSC
    $router->get('/recursos/{ano}/{id_osc}', 'RecursosOSCController@getRecursosPorOSC');
    $router->get('/anos_recursos/{id_osc}', 'RecursosOSCController@getAnoRecursosPorOSC');

    //INFORMAÇÕES DE ANOS QUE NÃO OBTEVERAM RECURSOS DA OSC
    $router->get('/sem_recursos/{ano}/{id_osc}', 'SemRecursosOSCController@getAnosSemRecursosPorOSC');
    $router->post('/sem_recursos/', 'SemRecursosOSCController@store');
    $router->delete('/sem_recursos/{id_osc}/{ano}/{origem}', 'SemRecursosOSCController@delete');

    //INFORMAÇÕES DE PROJETOS
    $router->get('/projetos/{id_osc}', 'OscController@getProjetos');
    $router->get('/projeto/{id}', 'ProjetoController@get');

    //------------------------------Parceiras OSC Projeto--------------------------------------//
    $router->get('/projeto/parceiras/{id_projeto}', 'OscParceiraProjetoController@getParceriasPorProjeto');
    $router->get('/projeto/parceira/{id}', 'OscParceiraProjetoController@get');

    //-------------------Tipo Parcerias Projeto-----------------------//
    $router->get('/projeto/tipo_parcerias/{id_projeto}', 'TipoParceriaProjetoController@getTipoParceriasPorProjeto');
    $router->get('/projeto/tipo_parceria/{id}', 'TipoParceriaProjetoController@get');

    //----------------------------Localizações Projeto---------------------------//
    $router->get('/projeto/localizacoes/{id_projeto}', 'LocalizacaoProjetoController@getLocalizacoesPorProjeto');
    $router->get('/projeto/localizacao/{id}', 'LocalizacaoProjetoController@get');

    //-----------------------------Financiador Projeto------------------------------//
    $router->get('/projeto/financiadores/{id_projeto}', 'FinanciadorProjetoController@getFinanciadoresPorProjeto');
    $router->get('/projeto/financiador/{id}', 'FinanciadorProjetoController@get');

    //---------------------------------Objetivos Projeto--------------------------------------//
    $router->get('/projeto/objetivos/{id_projeto}', 'ObjetivoProjetoController@getObjetivosPorProjeto');
    $router->get('/projeto/objetivo/{id}', 'ObjetivoProjetoController@get');

    //-----------------------------------Publico Beneficiado Projeto---------------------------//
    $router->get('/projeto/publicos/{id_projeto}', 'PublicoBeneficiadoProjetoController@getPublicoBeneficiadoPorProjeto');
    $router->get('/projeto/publico/{id}', 'PublicoBeneficiadoProjetoController@get');

    //-----------------------------------Fontes de Recursos Projeto---------------------------//
    $router->get('/projeto/recursos/{id_projeto}', 'FonteRecursosProjetoController@getFonteRecursosPorProjeto');
    $router->get('/projeto/recurso/{id}', 'FonteRecursosProjetoController@get');

    //------------------------QUADRO SOCIETÁRIO OSC-------------------------------------//
    $router->get('/quadro-societario/{id}', 'QuadroSocietarioController@get');
    $router->get('/quadro-societario-por-osc/{id_osc}', 'QuadroSocietarioController@getQuadroSocietarioPorOSC');
});



