
CREATE SEQUENCE IF NOT EXISTS transferegov.tb_emenda_seq
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9223372036854775807
    CACHE 1;

CREATE TABLE IF NOT EXISTS transferegov.tb_programa
(
    id_programa bigint,
    cod_orgao_sup_programa integer,
    desc_orgao_sup_programa text COLLATE pg_catalog."default",
    cod_programa bigint,
    nome_programa text COLLATE pg_catalog."default",
    sit_programa name,
    data_disponibilizacao date,
    ano_disponibilizacao smallint,
    dt_prog_ini_receb_prop date,
    dt_prog_fim_receb_prop date,
    dt_prog_ini_emenda_par date,
    dt_prog_fim_emenda_par date,
    dt_prog_ini_benef_esp date,
    dt_prog_fim_benef_esp date,
    modalidade_programa name,
    natureza_juridica_programa name,
    uf_programa char(2),
    acao_orcamentaria  name,
    nome_subtipo_programa name,
    descricao_subtipo_programa text COLLATE pg_catalog."default",
    created_at TIMESTAMP,
	updated_at TIMESTAMP,
    CONSTRAINT pk_id_programa_cod_programa_uf_programa_natureza_juridica_programa PRIMARY KEY (id_programa, cod_programa, uf_programa, natureza_juridica_programa)
);


CREATE TABLE IF NOT EXISTS transferegov.tb_proposta
(
    id_proposta bigint,
    uf_proponente text COLLATE pg_catalog."default",
    munic_proponente text COLLATE pg_catalog."default",
    cod_munic_ibge integer,
    cod_orgao_sup integer,
    desc_orgao_sup text COLLATE pg_catalog."default",
    natureza_juridica text COLLATE pg_catalog."default",
    nr_proposta text COLLATE pg_catalog."default",
    dia_prop smallint,
    mes_prop smallint,
    ano_prop smallint,
    dia_proposta text COLLATE pg_catalog."default",
    cod_orgao integer,
    desc_orgao text COLLATE pg_catalog."default",
    modalidade text COLLATE pg_catalog."default",
    identif_proponente text COLLATE pg_catalog."default",
    nm_proponente text COLLATE pg_catalog."default",
    cep_proponente bigint,
    endereco_proponente text COLLATE pg_catalog."default",
    bairro_proponente text COLLATE pg_catalog."default",
    nm_banco text COLLATE pg_catalog."default",
    situacao_conta text COLLATE pg_catalog."default",
    situacao_projeto_basico text COLLATE pg_catalog."default",
    sit_proposta text COLLATE pg_catalog."default",
    dia_inic_vigencia_proposta text COLLATE pg_catalog."default",
    dia_fim_vigencia_proposta text COLLATE pg_catalog."default",
    objeto_proposta text COLLATE pg_catalog."default",
    item_investimento text COLLATE pg_catalog."default",
    enviada_mandataria text COLLATE pg_catalog."default",
    nome_subtipo_proposta text COLLATE pg_catalog."default",
    descricao_subtipo_proposta text COLLATE pg_catalog."default",
    vl_global_prop double precision,
    vl_repasse_prop double precision,
    vl_contrapartida_prop double precision,
    created_at TIMESTAMP,
	updated_at TIMESTAMP,
    CONSTRAINT pk_id_proposta PRIMARY KEY (id_proposta)
);

CREATE TABLE IF NOT EXISTS transferegov.tb_programa_proposta
(
    id_programa bigint,
    id_proposta bigint,
    created_at TIMESTAMP,
	updated_at TIMESTAMP,
    CONSTRAINT pk_programa_proposta PRIMARY KEY (id_programa, id_proposta)
);

CREATE TABLE IF NOT EXISTS transferegov.tb_convenio
(
    nr_convenio bigint,
    id_proposta bigint,
    nr_processo name,
    dia smallint,
    mes smallint,
    ano smallint,
    dia_assin_conv date,
    sit_convenio name,
    subsituacao_conv name,
    situacao_publicacao name,
    instrumento_ativo char(3),
    ind_opera_obtv char(3),
    ug_emitente integer,
    dia_publ_conv date,
    dia_inic_vigenc_conv date,
    dia_fim_vigenc_conv date,
    dia_fim_vigenc_original_conv date,
    dias_prest_contas smallint,
    dia_limite_prest_contas date,
    data_suspensiva date,
    data_retirada_suspensiva date,
    dias_clausula_suspensiva smallint,
    situacao_contratacao name,
    ind_assinado char(3),
    motivo_suspensao text COLLATE pg_catalog."default",
    ind_foto char(3),
    qtde_convenios smallint,
    qtd_ta smallint,
    qtd_prorroga smallint,
    vl_global_conv double precision,
    vl_repasse_conv double precision,
    vl_contrapartida_conv double precision,
    vl_empenhado_conv double precision,
    vl_desembolsado_conv double precision,
    vl_saldo_reman_tesouro double precision,
    vl_saldo_reman_convenente double precision,
    vl_rendimento_aplicacao double precision,
    vl_ingresso_contrapartida double precision,
    vl_saldo_conta double precision,
    valor_global_original_conv double precision,
    created_at TIMESTAMP,
	updated_at TIMESTAMP,
    CONSTRAINT pk_nr_convenio_id_proposta_nr_processo PRIMARY KEY (nr_convenio, id_proposta, nr_processo)
);

CREATE TABLE IF NOT EXISTS transferegov.tb_emenda
(
    --seq_emenda integer NOT NULL DEFAULT nextval('transferegov.tb_emenda_seq'::regclass),
    cod_programa_emenda bigint,
    id_proposta bigint,
    qualif_proponente text COLLATE pg_catalog."default",
    nr_emenda integer,
    nome_parlamentar text COLLATE pg_catalog."default",
    beneficiario_emenda bigint,
    ind_impositivo char(3),
    tipo_parlamentar text COLLATE pg_catalog."default",
    valor_repasse_proposta_emenda double precision,
    valor_repasse_emenda double precision,
    created_at TIMESTAMP,
	updated_at TIMESTAMP,
    CONSTRAINT pk_cod_programa_emenda_beneficiario_emenda PRIMARY KEY (cod_programa_emenda, beneficiario_emenda)
);

CREATE TABLE IF NOT EXISTS transferegov.tb_plano
(
    id_proposta bigint,
    id_item_pad bigint,
    cod_natureza_despesa bigint,
    sigla char(2),
    municipio name,
    natureza_aquisicao smallint,
    descricao_item text COLLATE pg_catalog."default",
    cep_item name,
    endereco_item text COLLATE pg_catalog."default",
    tipo_despesa_item name,
    natureza_despesa name,
    sit_item name,
    qtd_item double precision,
    valor_unitario_item double precision,
    valor_total_item double precision,
    created_at TIMESTAMP,
	updated_at TIMESTAMP,
    CONSTRAINT pk_id_proposta_id_item_pad_cod_natureza_despesa PRIMARY KEY (id_proposta, id_item_pad, cod_natureza_despesa)
);

CREATE TABLE IF NOT EXISTS transferegov.tb_empenho
(
    id_empenho bigint,
    nr_convenio bigint,
    nr_empenho bigint,
    tipo_nota smallint,
    desc_tipo_nota name,
    data_emissao name,
    cod_situacao_empenho name,
    desc_situacao_empenho name,
    ug_emitente integer,
    ug_responsavel integer,
    fonte_recurso name,
    natureza_despesa name,
    plano_interno name,
    ptres integer,
    valor_empenho double precision,
    created_at TIMESTAMP,
	updated_at TIMESTAMP,
    CONSTRAINT pk_id_empenho_nr_convenio PRIMARY KEY (id_empenho, nr_convenio)
);

CREATE TABLE IF NOT EXISTS transferegov.tb_desembolso
(
    id_desembolso bigint,
    nr_convenio bigint,
    dt_ult_desembolso name,
    qtd_dias_sem_desembolso smallint,
    data_desembolso name,
    ano_desembolso smallint,
    mes_desembolso smallint,
    nr_siafi name,
    ug_emitente_dh integer,
    observacao_dh text COLLATE pg_catalog."default",
    vl_desembolsado double precision,    
    created_at TIMESTAMP,
	updated_at TIMESTAMP,
    CONSTRAINT pk_id_desembolso_nr_convenio PRIMARY KEY (id_desembolso, nr_convenio)
);

CREATE TABLE IF NOT EXISTS transferegov.tb_pagamento
(
    nr_mov_fin bigint,
    nr_convenio bigint,
    identif_fornecedor name,
    nome_fornecedor name,
    tp_mov_financeira name,
    data_pag name,
    nr_dl name,
    desc_dl name,
    vl_pago double precision,    
    created_at TIMESTAMP,
	updated_at TIMESTAMP,
    CONSTRAINT pk_nr_mov_fin_nr_convenio PRIMARY KEY (nr_mov_fin, nr_convenio)
);

CREATE TABLE IF NOT EXISTS transferegov.tb_obtv_convenente
(
    nr_mov_fin bigint,
    identif_favorecido_obtv_conv name,
    nm_favorecido_obtv_conv name,
    tp_aquisicao name,
    vl_pago_obtv_conv double precision,    
    created_at TIMESTAMP,
	updated_at TIMESTAMP,
    CONSTRAINT pk_nr_mov_fin PRIMARY KEY (nr_mov_fin)
);

CREATE TABLE IF NOT EXISTS transferegov.tb_historico_situacao
(
    id_proposta bigint,
    nr_convenio bigint,
    dia_historico_sit name,
    historico_sit name,
    dias_historico_sit integer,
    cod_historico_sit smallint,
    created_at TIMESTAMP,
	updated_at TIMESTAMP,
    CONSTRAINT pk_id_proposta_nr_convenio_dia_historico_sit PRIMARY KEY (id_proposta, nr_convenio, dia_historico_sit)
);

CREATE TABLE IF NOT EXISTS transferegov.tb_ingresso_contrapartida
(
    nr_convenio bigint,
    dt_ingresso_contrapartida date,
    vl_ingresso_contrapartida double precision,
    created_at TIMESTAMP,
	updated_at TIMESTAMP,
    CONSTRAINT pk_nr_convenio_dt_ingresso_contrapartida PRIMARY KEY (nr_convenio, dt_ingresso_contrapartida)
);

CREATE TABLE IF NOT EXISTS transferegov.tb_termo_aditivo
(
    nr_convenio bigint,
    id_solicitacao integer,
    numero_ta name,
    tipo_ta name,
    vl_global_ta double precision,
    vl_repasse_ta double precision,
    vl_contrapartida_ta double precision,
    dt_assinatura_ta date,
    dt_inicio_ta date,
    dt_fim_ta date,
    justificativa_ta text COLLATE pg_catalog."default",
    created_at TIMESTAMP,
	updated_at TIMESTAMP,
    CONSTRAINT pk_nr_convenio_numero_ta PRIMARY KEY (nr_convenio, numero_ta)
);

CREATE TABLE IF NOT EXISTS transferegov.tb_prorroga
(
    nr_convenio bigint,
    nr_prorroga name,
    dias_prorroga integer,
    sit_prorroga name,
    dt_inicio_prorroga date,
    dt_fim_prorroga date,
    dt_assinatura_prorroga date,
    created_at TIMESTAMP,
	updated_at TIMESTAMP,
    CONSTRAINT pk_nr_convenio_nr_prorroga PRIMARY KEY (nr_convenio, nr_prorroga)
);

CREATE TABLE IF NOT EXISTS transferegov.tb_meta
(
    id_meta bigint,
    id_proposta bigint,
    nr_convenio bigint,
    cod_programa bigint,
    nome_programa smallint,
    tipo_meta name,
    desc_meta text COLLATE pg_catalog."default",
    data_inicio_meta date,
    data_fim_meta date,
    uf_meta char(2),
    municipio_meta name,
    endereco_meta name,
    cep_meta name,
    qtd_meta double precision,
    und_fornecimento_meta name,
    vl_meta double precision,
    created_at TIMESTAMP,
	updated_at TIMESTAMP,
    CONSTRAINT pk_id_meta_id_proposta PRIMARY KEY (id_meta, id_proposta)
);

CREATE TABLE IF NOT EXISTS transferegov.tb_etapa
(
    id_etapa bigint,
    id_meta bigint,
    nr_etapa integer,
    desc_etapa text COLLATE pg_catalog."default",
    uf_etapa char(2),
    municipio_etapa name,
    endereco_etapa name,
    cep_etapa name,
    qtd_etapa double precision,
    und_fornecimento_etapa name,
    vl_etapa double precision,
    data_inicio_etapa date,
    data_fim_etapa date,
    created_at TIMESTAMP,
	updated_at TIMESTAMP,
    CONSTRAINT pk_id_etapa_id_meta_nr_etapa PRIMARY KEY (id_etapa, id_meta, nr_etapa)
);

CREATE TABLE IF NOT EXISTS transferegov.tb_consorcio
(
    id_proposta bigint,
    cnpj_consorcio bigint,
    nome_consorcio name,
    codigo_cnae_primario bigint,
    codigo_cnae_secundario bigint,
    desc_cnae_primario name,
    desc_cnae_secundario name,
    cnpj_participante name,
    nome_participante name,    
    created_at TIMESTAMP,
	updated_at TIMESTAMP,
    CONSTRAINT pk_id_proposta_cnpj_consorcio_codigo_cnae_secundario PRIMARY KEY (id_proposta, cnpj_consorcio, codigo_cnae_secundario)
);

CREATE TABLE IF NOT EXISTS transferegov.tb_empenho_desembolso
(
    id_desembolso bigint,
    id_empenho bigint,
    valor_grupo double precision,    
    created_at TIMESTAMP,
	updated_at TIMESTAMP,
    CONSTRAINT pk_id_desembolso_id_empenho PRIMARY KEY (id_desembolso, id_empenho)
);

CREATE TABLE IF NOT EXISTS transferegov.tb_proponente
(
    id_proponente bigint,
    identif_proponente name,
    nm_proponente name,
    municipio_proponente name,
    uf_proponente char(2),
    endereco_proponente name,
    bairro_proponente name,
    cep_proponente name,
    email_proponente name,
    telefone_proponente name,
    fax_proponente name,   
    created_at TIMESTAMP,
	updated_at TIMESTAMP,
    CONSTRAINT pk_id_proponente_identif_proponente PRIMARY KEY (id_proponente, identif_proponente)
);

TABLESPACE pg_default;

ALTER TABLE IF EXISTS transferegov.tb_programa
    OWNER to postgres;

ALTER TABLE IF EXISTS transferegov.tb_programa_proposta
    OWNER to postgres;