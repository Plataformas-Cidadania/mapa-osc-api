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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/api/', function () use ($router) {
        return ["description: API de dados do Mapa das Organizações da Sociedade Civil.",
        "version: 3.0.0",
        "homepage: https://mapaosc.ipea.gov.br/",
        "keywords: 'php', 'lumen', 'api', 'rest', 'server, 'http', 'json', 'mapaosc', 'ipea'",
        "license: LGPL-3.0",
        "authors: {Thiago Giannini Ramos, Fábio Barreto, Bruno Passos, Relison Galvão}"
    ];
});

$router->post('/api/user/', 'UsuarioController@store');

$router->get('/api/objetivos/', 'DCObjetivoProjetoController@getAll');
$router->get('/api/objetivos/metas/{id_obj}', 'DCMetaProjetoController@getMetasPorObjetivo');

$router->group(['prefix' => '/api/osc'], function() use ($router){

    //ROTAS GERAIS DO MODELO OSC
    $router->get('/', 'OscController@getAll');
    $router->get('/{id}', 'OscController@get');
    $router->post('/', 'OscController@store');
    $router->put('/{id}', 'OscController@update');
    $router->delete('/{id}', 'OscController@destroy');

    //ROTAS PARA POPULAR DADOS DA HOME

    //Listas das recentemente atualizadas
    $router->get('/lista_atualizada/{tam}', 'OscController@getListaOscAtualizadas');

    //Gráficos da home
    $router->get('/grafico/{tipo}', 'OscController@getGrafico');

    //Lista de Oscs Por Area de Atuação / Municipip / Geolocalização
    $router->get('/lista_por_area_atuacao/{cd_area_atuacao}/municipio/{cd_municipio}', 'OscController@getListaOscAreaAtuacao');
    $router->get('/lista_por_area_atuacao/{cd_area_atuacao}/municipio/{cd_municipio}', 'OscController@getListaOscAreaAtuacaoAndMunicipio');

    //INFORMAÇÕES PARA O GRÁFICO
    //$router->get('/total_oscs/', 'OscController@getNumeroTotalOSCs');
    //$router->get('/osc_com_certificacoes/', 'OscController@getNumeroOSCcomCertificacoes');

    //INFORMAÇÕES DE CABEÇALHO
    $router->get('/cabecalho/{id}', 'OscController@getCabecalho');

    //INFORMAÇÕES DE DADOS GERAIS
    $router->get('/dados_gerais/{id}', 'OscController@getDadosGerais');
    $router->put('/dados_gerais/{id}', 'OscController@updateDadosGerais');

    //UPDATE IMAGEM OSC
    $router->post('/logo/{id}', 'OscController@updateLogo');
    $router->get('/logo/{id}', 'OscController@getLogo');

    //INFORMAÇÕES DE AREA E SUBAREA DE ATUAÇÃO DA OSC
    $router->get('/areas_atuacao/{id_osc}', 'AreaAtuacaoController@getAreasAtuacaoPorOSC');
    $router->get('/area_atuacao/{id}', 'AreaAtuacaoController@get');
    $router->put('/area_atuacao/{id}', 'AreaAtuacaoController@update');
    $router->post('/area_atuacao/', 'AreaAtuacaoController@store');
    $router->delete('/area_atuacao/{id}', 'AreaAtuacaoController@delete');

    //INFORMAÇÕES DE DESCRIÇÃO DA OSC
    $router->get('/descricao/{id}', 'DadosGeraisController@getDescricao');
    $router->put('/descricao/{id}', 'DadosGeraisController@updateDescricao');

    //---------------------------------Objetivos (ODS) OSC--------------------------------------//
    $router->get('/objetivos/{id_projeto}', 'ObjetivoOscController@getObjetivosPorOsc');
    $router->get('/objetivo/{id}', 'ObjetivoOscController@get');
    $router->put('/objetivo/{id}', 'ObjetivoOscController@update');
    $router->post('/objetivo/', 'ObjetivoOscController@store');
    $router->delete('/objetivo/{id}', 'ObjetivoOscController@delete');

    //INFORMAÇÕES DE TITULAÇÕES E CERTIFICAÇÕES
    $router->get('/certificado/{id}', 'CertificadoController@get');
    $router->post('/certificado/', 'CertificadoController@store');
    $router->get('/certificados/{id_osc}', 'CertificadoController@getCertificadosPorOSC');
    $router->delete('/certificado/{id_osc}', 'CertificadoController@delete');
    $router->put('/certificado/{id}', 'CertificadoController@update');

    //INFORMAÇÕES DAS RELAÇÕES DE TRABALHO E GOVERNANÇA
    $router->get('/rel_trabalho_e_governanca/{id_osc}', 'OscController@getRelTrabalhoAndGovernanca');

    //---------------------Relações de Trabalho-----------------------------------//
    $router->get('/rel_trabalho/{id_osc}', 'RelacoesTrabalhoController@get');
    $router->put('/rel_trabalho/{id_osc}', 'RelacoesTrabalhoController@update');

    //---------------------Governança----------------------------------------------//
    $router->get('/governanca/{id}', 'GovernancaController@get');
    $router->put('/governanca/{id}', 'GovernancaController@update');
    $router->post('/governanca/', 'GovernancaController@store');
    $router->delete('/governanca/{id}', 'GovernancaController@delete');

    //---------------------Conselho Fiscal----------------------------------------------//
    $router->get('/conselho/{id}', 'ConselhoFiscalController@get');
    $router->post('/conselho/', 'ConselhoFiscalController@store');
    $router->put('/conselho/{id}', 'ConselhoFiscalController@update');
    $router->delete('/conselho/{id}', 'ConselhoFiscalController@delete');


    //INFORMAÇÕES DE ESPAÇOS DE PARTICIPAÇÃO SOCIAL
    $router->get('/participacao_social/{id}', 'OscController@getParticipacaoSocial');

    //------------------------------Conselho-----------------------------//
    $router->get('/ps_conselho/{id}', 'ParticipacaoSocialConselhoController@get');
    $router->get('/ps_conselhos/{id}', 'ParticipacaoSocialConselhoController@getParticipacaoSocialConselhoPorOSC');
    $router->post('/ps_conselho/', 'ParticipacaoSocialConselhoController@store');
    $router->put('/ps_conselho/{id}', 'ParticipacaoSocialConselhoController@update');
    $router->delete('/ps_conselho/{id}', 'ParticipacaoSocialConselhoController@delete');

    //--------------------------------Conferência-------------------------//
    $router->get('/ps_conferencia/{id}', 'ParticipacaoSocialConferenciaController@get');
    $router->get('/ps_conferencias/{id}', 'ParticipacaoSocialConferenciaController@getParticipacaoSocialConferenciaPorOSC');
    $router->post('/ps_conferencia/', 'ParticipacaoSocialConferenciaController@store');
    $router->put('/ps_conferencia/{id}', 'ParticipacaoSocialConferenciaController@update');
    $router->delete('/ps_conferencia/{id}', 'ParticipacaoSocialConferenciaController@delete');
    
    //-----------------------------------Outra-------------------------------//
    $router->get('/ps_outra/{id}', 'ParticipacaoSocialOutraController@get');
    $router->get('/ps_outras/{id}', 'ParticipacaoSocialOutraController@getParticipacaoSocialOutraPorOSC');
    $router->post('/ps_outra/', 'ParticipacaoSocialOutraController@store');
    $router->put('/ps_outra/{id}', 'ParticipacaoSocialOutraController@update');
    $router->delete('/ps_outra/{id}', 'ParticipacaoSocialOutraController@delete');

    //INFORMAÇÕES DE FONTES DE RECURSOS DA OSC
    $router->get('/fonte_recursos/{id_osc}', 'FonteRecursosController@getFonteRecursosPorOSC');
    $router->get('/anos_fonte_recursos/{id_osc}', 'FonteRecursosController@getAnoFonteRecursosPorOSC');
    $router->post('/fonte_recursos/', 'FonteRecursosController@store');
    $router->put('/fonte_recursos/{id}', 'FonteRecursosController@update');
    $router->delete('/fonte_recursos/{id}', 'FonteRecursosController@delete');

    //INFORMAÇÕES DE PROJETOS
    $router->get('/projetos/{id_osc}', 'OscController@getProjetos');
    $router->get('/projeto/{id}', 'ProjetoController@get');
    $router->put('/projeto/{id}', 'ProjetoController@update');
    $router->post('/projeto/', 'ProjetoController@store');
    $router->delete('/projeto/{id}', 'ProjetoController@delete');

    //------------------------------Parceiras OSC Projeto--------------------------------------//
    $router->get('/projeto/parceiras/{id_projeto}', 'OscParceiraProjetoController@getParceriasPorProjeto');
    $router->get('/projeto/parceira/{id}', 'OscParceiraProjetoController@get');
    $router->put('/projeto/parceira/{id}', 'OscParceiraProjetoController@update');
    $router->post('/projeto/parceira/', 'OscParceiraProjetoController@store');
    $router->delete('/projeto/parceira/{id}', 'OscParceiraProjetoController@delete');

    //-------------------Tipo Parcerias Projeto-----------------------//
    $router->get('/projeto/tipo_parcerias/{id_projeto}', 'TipoParceriaProjetoController@getTipoParceriasPorProjeto');
    $router->get('/projeto/tipo_parceria/{id}', 'TipoParceriaProjetoController@get');
    $router->put('/projeto/tipo_parceria/{id}', 'TipoParceriaProjetoController@update');
    $router->post('/projeto/tipo_parceria/', 'TipoParceriaProjetoController@store');
    $router->delete('/projeto/tipo_parceria/{id}', 'TipoParceriaProjetoController@delete');

    //----------------------------Localizações Projeto---------------------------//
    $router->get('/projeto/localizacoes/{id_projeto}', 'LocalizacaoProjetoController@getLocalizacoesPorProjeto');
    $router->get('/projeto/localizacao/{id}', 'LocalizacaoProjetoController@get');
    $router->put('/projeto/localizacao/{id}', 'LocalizacaoProjetoController@update');
    $router->post('/projeto/localizacao/', 'LocalizacaoProjetoController@store');
    $router->delete('/projeto/localizacao/{id}', 'LocalizacaoProjetoController@delete');

    //-----------------------------Financiador Projeto------------------------------//
    $router->get('/projeto/financiadores/{id_projeto}', 'FinanciadorProjetoController@getFinanciadoresPorProjeto');
    $router->get('/projeto/financiador/{id}', 'FinanciadorProjetoController@get');
    $router->put('/projeto/financiador/{id}', 'FinanciadorProjetoController@update');
    $router->post('/projeto/financiador/', 'FinanciadorProjetoController@store');
    $router->delete('/projeto/financiador/{id}', 'FinanciadorProjetoController@delete');

    //---------------------------------Objetivos Projeto--------------------------------------//
    $router->get('/projeto/objetivos/{id_projeto}', 'ObjetivoProjetoController@getObjetivosPorProjeto');
    $router->get('/projeto/objetivo/{id}', 'ObjetivoProjetoController@get');
    $router->put('/projeto/objetivo/{id}', 'ObjetivoProjetoController@update');
    $router->post('/projeto/objetivo/', 'ObjetivoProjetoController@store');
    $router->delete('/projeto/objetivo/{id}', 'ObjetivoProjetoController@delete');

    //-----------------------------------Publico Beneficiado Projeto---------------------------//
    $router->get('/projeto/publicos/{id_projeto}', 'PublicoBeneficiadoProjetoController@getPublicoBeneficiadoPorProjeto');
    $router->get('/projeto/publico/{id}', 'PublicoBeneficiadoProjetoController@get');
    $router->put('/projeto/publico/{id}', 'PublicoBeneficiadoProjetoController@update');
    $router->post('/projeto/publico/', 'PublicoBeneficiadoProjetoController@store');
    $router->delete('/projeto/publico/{id}', 'PublicoBeneficiadoProjetoController@delete');

    //-----------------------------------Fontes de Recursos Projeto---------------------------//
    $router->get('/projeto/recursos/{id_projeto}', 'FonteRecursosProjetoController@getFonteRecursosPorProjeto');
    $router->get('/projeto/recurso/{id}', 'FonteRecursosProjetoController@get');
    $router->put('/projeto/recurso/{id}', 'FonteRecursosProjetoController@update');
    $router->post('/projeto/recurso/', 'FonteRecursosProjetoController@store');
    $router->delete('/projeto/recurso/{id}', 'FonteRecursosProjetoController@delete');
});
