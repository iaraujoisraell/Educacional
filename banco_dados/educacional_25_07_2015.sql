-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 25-Jul-2015 às 23:53
-- Versão do servidor: 5.6.15-log
-- PHP Version: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `educacional`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acessos`
--

CREATE TABLE IF NOT EXISTS `acessos` (
  `acessos_id` int(11) NOT NULL AUTO_INCREMENT,
  `menus_id` int(11) NOT NULL,
  `perfis_id` int(11) NOT NULL,
  PRIMARY KEY (`acessos_id`),
  KEY `fk_acessos_menus1_idx` (`menus_id`),
  KEY `fk_acessos_perfis1_idx` (`perfis_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Extraindo dados da tabela `acessos`
--

INSERT INTO `acessos` (`acessos_id`, `menus_id`, `perfis_id`) VALUES
(1, 23, 11),
(2, 24, 11),
(3, 25, 11),
(4, 19, 11),
(6, 26, 11),
(7, 28, 11),
(8, 30, 11),
(9, 32, 11),
(10, 33, 11),
(11, 34, 11),
(12, 35, 11),
(13, 36, 11),
(15, 37, 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `acoes`
--

CREATE TABLE IF NOT EXISTS `acoes` (
  `acoes_id` int(11) NOT NULL AUTO_INCREMENT,
  `aca_tx_descricao` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`acoes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `level` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`, `level`) VALUES
(1, 'Mr. Admin', 'admin@admin', 'admin', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `bolsas`
--

CREATE TABLE IF NOT EXISTS `bolsas` (
  `bolsas_id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(250) NOT NULL COMMENT 'Nome da Bolsa:\n\n\nBolsa Universidade,\nFIES, ETc.',
  `porcentagem_minima` double NOT NULL COMMENT 'a porcentagem mínima da bolsa:\n\n20%, 30%',
  `porcentagem_maxima` double NOT NULL COMMENT 'a porcentagem máxima da bolsa,\n\n50%, 100%.',
  PRIMARY KEY (`bolsas_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `bolsas`
--

INSERT INTO `bolsas` (`bolsas_id`, `descricao`, `porcentagem_minima`, `porcentagem_maxima`) VALUES
(1, 'bolsa universidade', 49, 55),
(2, 'Pro Uni', 60, 70),
(3, 'Bolsa Faculdade', 30, 20),
(4, 'AJIDIXJISAHXUSHAUEHDKDUSHSUSS', 0, 0),
(5, 'TURMA TESTE', 0, 0),
(6, 'TURMA TESTE', 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `bolsa_periodo`
--

CREATE TABLE IF NOT EXISTS `bolsa_periodo` (
  `bolsa_periodo_id` int(11) NOT NULL AUTO_INCREMENT,
  `periodo_letivo_id` int(11) NOT NULL,
  `bolsas_id` int(11) NOT NULL,
  PRIMARY KEY (`bolsa_periodo_id`),
  KEY `fk_bolsa_periodo_periodo_letivo1` (`periodo_letivo_id`),
  KEY `fk_bolsa_periodo_bolsas1` (`bolsas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro_aluno`
--

CREATE TABLE IF NOT EXISTS `cadastro_aluno` (
  `cadastro_aluno_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) NOT NULL,
  `cpf` int(11) NOT NULL,
  `rg` varchar(15) NOT NULL,
  `rg_uf` varchar(2) DEFAULT NULL,
  `rg_orgao_expeditor` varchar(50) DEFAULT NULL,
  `data_nascimento` date NOT NULL,
  `pais_origem` varchar(3) NOT NULL COMMENT 'só se deve escolher um país de origem se a opcao de nacionalidade for estrageira = 3.\n\nse a nacionalidade for a opção 1 ou 2, o país de origem deve ser = BRA.\n',
  `uf_nascimento` char(2) DEFAULT NULL COMMENT 'só pode ser informado se a nacionalidade for brasileira. opção 1.',
  `municipio_nascimento` int(7) DEFAULT NULL COMMENT 'Deve aparecer somente se for selecionado um UF.\n\nusar a tabela corporativa TC_MUNICIPIO ',
  `sexo` int(11) NOT NULL COMMENT '0- Mesculino\n1 - Feminino',
  `estado_civil` int(11) NOT NULL COMMENT '1 - Solteiro(a)\n2 - Casado(a)\n3 - Divorciado(a)\n4 - Viuvo(a)\n5 - Outro(a)',
  `cep` varchar(10) NOT NULL,
  `endereco` varchar(200) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `complemento` varchar(200) DEFAULT NULL,
  `uf` varchar(2) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `titulo` varchar(20) DEFAULT NULL,
  `uf_titulo` varchar(2) DEFAULT NULL,
  `fone` varchar(14) NOT NULL,
  `celular` varchar(14) NOT NULL,
  `email` varchar(200) NOT NULL,
  `nacionalidade` int(1) NOT NULL COMMENT '1 - Brasileira\n2 - Brasileira-Nascido no exterior ou naturalizado.\n3 - Estrangeira',
  `cor` int(11) NOT NULL COMMENT '1-Branca\n2-Preta\n3-Parda\n4-Amarela\n5-Indígina\n6-Não dispoe da informação\n7-O aluno não quis declarar',
  `mae` varchar(120) DEFAULT NULL,
  `pai` varchar(120) DEFAULT NULL,
  `conjuge` varchar(250) DEFAULT NULL,
  `uf_cert_reservista` varchar(2) DEFAULT NULL,
  `documento_estrangeiro` varchar(20) DEFAULT NULL COMMENT 'Usado somente em caso de estrangeiro. \nsó pode ser informado o documento de estrangeiro quando a nacionalidade for = 3;',
  `cert_reservista` varchar(20) DEFAULT NULL,
  `responsavel` varchar(250) DEFAULT NULL,
  `fone_responsavel` varchar(9) DEFAULT NULL,
  `rg_responsavel` varchar(13) DEFAULT NULL,
  `cpf_responsavel` varchar(14) DEFAULT NULL,
  `cel_responsavel` varchar(9) DEFAULT NULL,
  `obs_doc` varchar(200) NOT NULL,
  `candidato_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`cadastro_aluno_id`),
  KEY `fk_cadastro_aluno_candidato1` (`candidato_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `cadastro_aluno`
--

INSERT INTO `cadastro_aluno` (`cadastro_aluno_id`, `nome`, `cpf`, `rg`, `rg_uf`, `rg_orgao_expeditor`, `data_nascimento`, `pais_origem`, `uf_nascimento`, `municipio_nascimento`, `sexo`, `estado_civil`, `cep`, `endereco`, `bairro`, `complemento`, `uf`, `cidade`, `titulo`, `uf_titulo`, `fone`, `celular`, `email`, `nacionalidade`, `cor`, `mae`, `pai`, `conjuge`, `uf_cert_reservista`, `documento_estrangeiro`, `cert_reservista`, `responsavel`, `fone_responsavel`, `rg_responsavel`, `cpf_responsavel`, `cel_responsavel`, `obs_doc`, `candidato_id`) VALUES
(2, 'KAROLINE INGRID', 307561208, '24101290', 'AM', 'SESEP', '2015-10-03', 'BRA', 'AM', 0, 0, 0, '6907906', 'Rua sátiro dias', 'São Francisco', 'CASA', 'AM', 'Manaus', '4545456456', 'AM', '9239999898', '823565656', 'karol_ingrid_avinte@hotmail.com', 0, 0, 'MARIA LUCIA DE OLIVEIRA AVINTE', 'HAHDUAHSDU', 'DHASUDHADHU', 'HS', 'DSHAUDHU', 'DSHAUDAUDH', '', '', '', '', '', '0', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `candidato`
--

CREATE TABLE IF NOT EXISTS `candidato` (
  `candidato_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `can_ch_sexo` char(1) DEFAULT NULL,
  `can_tx_cpf` char(14) DEFAULT NULL,
  `can_tx_rg` varchar(14) DEFAULT NULL,
  `can_tx_orgaoRg` varchar(50) DEFAULT NULL,
  `can_tx_ufRg` char(2) DEFAULT NULL,
  `can_tx_pai` varchar(150) DEFAULT NULL,
  `can_tx_mae` varchar(150) DEFAULT NULL,
  `can_dt_dtNasc` varchar(10) DEFAULT NULL,
  `can_tx_email` varchar(200) DEFAULT NULL,
  `can_tx_necessidade` varchar(10) DEFAULT NULL,
  `can_tx_endereco` varchar(200) DEFAULT NULL,
  `can_tx_bairro` varchar(100) DEFAULT NULL,
  `can_tx_cidade` varchar(100) DEFAULT NULL,
  `can_ch_uf` char(2) DEFAULT NULL,
  `can_tx_cep` varchar(10) DEFAULT NULL,
  `can_tx_complemento` varchar(200) DEFAULT NULL,
  `can_tx_telefone` varchar(14) DEFAULT NULL,
  `can_tx_celular` varchar(14) DEFAULT NULL,
  `can_tx_op01` varchar(100) DEFAULT NULL,
  `can_tx_op02` varchar(100) DEFAULT NULL,
  `can_tx_data` varchar(10) DEFAULT NULL,
  `can_tx_hora` varchar(8) DEFAULT NULL,
  `can_tx_mao` char(1) DEFAULT NULL,
  `can_tx_profissao` varchar(25) DEFAULT NULL,
  `can_tx_nome_amigo` varchar(100) DEFAULT NULL,
  `can_tx_curso_amigo` varchar(30) DEFAULT NULL,
  `can_tx_periodo_amigo` varchar(5) DEFAULT NULL,
  `can_tx_formacao` varchar(100) DEFAULT NULL,
  `can_tx_nacionalidade` varchar(50) DEFAULT NULL,
  `can_tx_outros_contatos` varchar(300) DEFAULT NULL,
  `can_tx_turno01` varchar(1) DEFAULT NULL,
  `can_tx_turno02` varchar(1) DEFAULT NULL,
  `can_tx_naturalidade` varchar(100) DEFAULT NULL,
  `can_ch_estvic` varchar(1) DEFAULT NULL,
  `can_tx_conjuje` varchar(250) DEFAULT NULL,
  `can_tx_cert_reserv` varchar(25) DEFAULT NULL,
  `can_tx_uf_cert_reserv` varchar(3) DEFAULT NULL,
  `can_tx_titulo` varchar(25) DEFAULT NULL,
  `can_tx_uf_titulo` varchar(3) DEFAULT NULL,
  `can_tx_uf_nasc` varchar(2) DEFAULT NULL,
  `can_tx_se_irmaos` varchar(2) DEFAULT '',
  `can_tx_se_filhos` varchar(2) DEFAULT '',
  `can_tx_se_etnia` varchar(2) DEFAULT '',
  `can_tx_se_moradia` varchar(2) DEFAULT '',
  `can_tx_se_renda` varchar(2) DEFAULT '',
  `can_tx_se_membros` varchar(2) DEFAULT '',
  `can_tx_se_trabalhando` varchar(2) DEFAULT '',
  `can_tx_se_uf_ef` varchar(2) DEFAULT '',
  `can_tx_se_bolsa` varchar(2) DEFAULT '',
  `can_tx_se_uf_em` varchar(2) DEFAULT '',
  `can_tx_se_ch` varchar(2) DEFAULT '',
  `can_tx_integralizacao01` varchar(2) DEFAULT '',
  `can_tx_integralizacao02` varchar(2) DEFAULT '',
  `can_tx_ciente` varchar(50) DEFAULT NULL,
  `can_nb_referencia` int(11) DEFAULT NULL,
  `vest_nb_codigo` int(11) NOT NULL,
  PRIMARY KEY (`candidato_id`),
  KEY `fk_candidato_vestibular_idx` (`vest_nb_codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `candidato`
--

INSERT INTO `candidato` (`candidato_id`, `nome`, `can_ch_sexo`, `can_tx_cpf`, `can_tx_rg`, `can_tx_orgaoRg`, `can_tx_ufRg`, `can_tx_pai`, `can_tx_mae`, `can_dt_dtNasc`, `can_tx_email`, `can_tx_necessidade`, `can_tx_endereco`, `can_tx_bairro`, `can_tx_cidade`, `can_ch_uf`, `can_tx_cep`, `can_tx_complemento`, `can_tx_telefone`, `can_tx_celular`, `can_tx_op01`, `can_tx_op02`, `can_tx_data`, `can_tx_hora`, `can_tx_mao`, `can_tx_profissao`, `can_tx_nome_amigo`, `can_tx_curso_amigo`, `can_tx_periodo_amigo`, `can_tx_formacao`, `can_tx_nacionalidade`, `can_tx_outros_contatos`, `can_tx_turno01`, `can_tx_turno02`, `can_tx_naturalidade`, `can_ch_estvic`, `can_tx_conjuje`, `can_tx_cert_reserv`, `can_tx_uf_cert_reserv`, `can_tx_titulo`, `can_tx_uf_titulo`, `can_tx_uf_nasc`, `can_tx_se_irmaos`, `can_tx_se_filhos`, `can_tx_se_etnia`, `can_tx_se_moradia`, `can_tx_se_renda`, `can_tx_se_membros`, `can_tx_se_trabalhando`, `can_tx_se_uf_ef`, `can_tx_se_bolsa`, `can_tx_se_uf_em`, `can_tx_se_ch`, `can_tx_integralizacao01`, `can_tx_integralizacao02`, `can_tx_ciente`, `can_nb_referencia`, `vest_nb_codigo`) VALUES
(1, 'Mario Jose da Silva', 'M', '003.075.612-08', '2410129-0', 'SSP', 'AM', NULL, 'Maria Jose da Silva', '1991-10-03', 'mario@hotmail.com', NULL, 'Rua: Sátiro Dias ', 'São Francisco', 'Manaus', 'AM', '69079060', 'CASA', '(92) 3664-5199', '(92)8195-9014', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 496),
(3, 'Karoline Ingrid de Oliveira Avinte', 'F', '003.075.612-08', '2410129-0', 'SSP', 'AM', NULL, 'Joana da Silva', '1992-10-03', 'joana_silva@hotmail.com', NULL, 'Rua: Sátiro Dias', 'São Francisco', 'Manaus', 'AM', '69079060', 'CASA', '(92) 3664-5166', '(92)8195-9014', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 496),
(5, 'Pedro Martins', 'M', '145.058.658-09', '2018745-0', 'SSP', 'AM', NULL, 'Carmen Silva', '1993-10-03', 'pedro@gmail.com', NULL, 'Rua: Pimenta Bueno', 'São Francisco', 'Manaus', 'AM', '69014107', 'APARTAMENTO', '(92) 3664-5688', '(92)8270-2518', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 497),
(6, 'Leonardo Menezes Silva', 'M', '676.443.123-00', '4355665-7', 'SSP', 'AM', NULL, 'Joana Martins', '1991-05-05', 'teste@teste.com', NULL, 'Rua: Pimenta Bueno', 'São Francisco', 'Manaus', 'AM', '69014107', 'APARTAMENTO', '(92) 3664-5688', '(92)8270-2518', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 497);

-- --------------------------------------------------------

--
-- Estrutura da tabela `chamada_vestibular`
--

CREATE TABLE IF NOT EXISTS `chamada_vestibular` (
  `chamada_vestibular_id` int(11) NOT NULL AUTO_INCREMENT,
  `cv_nb_resposta` int(11) NOT NULL,
  `can_nb_codigo` int(11) NOT NULL,
  `cv_tx_ponto_prova` varchar(5) DEFAULT NULL,
  `cv_tx_ponto_redacao` varchar(5) DEFAULT NULL,
  `cv_nb_aprovado` int(11) DEFAULT NULL COMMENT '0- reprovado;\n1- Aprovado;',
  `vest_nb_codigo` int(11) NOT NULL,
  PRIMARY KEY (`chamada_vestibular_id`),
  KEY `fk_chamada_vestibular_candidato1` (`can_nb_codigo`),
  KEY `fk_chamada_vestibular_vestibular1_idx` (`vest_nb_codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `chamada_vestibular`
--

INSERT INTO `chamada_vestibular` (`chamada_vestibular_id`, `cv_nb_resposta`, `can_nb_codigo`, `cv_tx_ponto_prova`, `cv_tx_ponto_redacao`, `cv_nb_aprovado`, `vest_nb_codigo`) VALUES
(1, 1, 6, NULL, NULL, NULL, 497),
(2, 0, 5, NULL, NULL, NULL, 497),
(3, 1, 3, NULL, NULL, NULL, 496),
(4, 0, 1, NULL, NULL, NULL, 496);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--

CREATE TABLE IF NOT EXISTS `cursos` (
  `cursos_id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `cur_tx_descricao` varchar(100) NOT NULL,
  `cur_tx_duracao` varchar(15) DEFAULT NULL,
  `cur_tx_abreviatura` varchar(10) DEFAULT NULL,
  `cur_nb_ativ_comp_obrigatoria` int(11) DEFAULT '0',
  `cur_nb_estagio_obrigatoria` int(11) DEFAULT '0',
  `cur_fl_valor` double DEFAULT '0',
  `cur_tx_habilitacao` varchar(200) DEFAULT NULL,
  `cur_tx_coordenador` varchar(250) DEFAULT NULL,
  `instituicao_id` int(11) NOT NULL,
  `modalidade` int(11) DEFAULT NULL COMMENT '1 - Presencial\n2 - A Distancia',
  PRIMARY KEY (`cursos_id`) USING BTREE,
  KEY `fk_curso_instituicao1` (`instituicao_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `cursos`
--

INSERT INTO `cursos` (`cursos_id`, `cur_tx_descricao`, `cur_tx_duracao`, `cur_tx_abreviatura`, `cur_nb_ativ_comp_obrigatoria`, `cur_nb_estagio_obrigatoria`, `cur_fl_valor`, `cur_tx_habilitacao`, `cur_tx_coordenador`, `instituicao_id`, `modalidade`) VALUES
(0000000001, 'ADMINISTRAÇÃO ', '8 semestres', 'ADM', 400, 400, 500, 'ADMINISTRAÇÃO ', 'Prof. José Carlos ', 1, NULL),
(0000000003, 'PEDAGOGIA', '6 semestres', 'PED', 200, 200, 400, 'PEDAGOGO', 'Profa. Elda', 1, NULL),
(0000000004, 'CIÊNCIAS TEOLÓGIAS', '8 SEMESTRES', 'CT', 444, 44, 700, 'CIÊNCIAS TEOLÓGIAS', 'JOÃO', 1, NULL),
(0000000005, 'COMUNICAÇÃO SOCIAL: JORNALISMO', '8 SEMESTRES', 'CS', 4444, 44, 1880, 'JORNALISMO', 'Profa. MacrI', 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_censo_aluno`
--

CREATE TABLE IF NOT EXISTS `dados_censo_aluno` (
  `dados_censo_aluno_id` int(11) NOT NULL AUTO_INCREMENT,
  `aluno_deficiencia` int(11) NOT NULL COMMENT '0 - NAO\n1 - SIM\n2 - NAO DISPOE da INFORMACAO',
  `ad_cegueira` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `ad_baixa_visao` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `ad_surdez` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `ad_auditiva` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `ad_fisica` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `ad_surdogagueira` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `ad_multipla` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `ad_intelectual` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `ad_autismo` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `ad_asperger` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `ad_rett` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `ad_transtorno` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `ad_superdotacao` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `cadastro_aluno_id` int(11) NOT NULL,
  `tipo_registro` int(11) DEFAULT '40' COMMENT 'Salvar sempre como 40',
  `tipo_arquivo` int(11) DEFAULT '4' COMMENT 'salvar com o valor: 4',
  PRIMARY KEY (`dados_censo_aluno_id`),
  KEY `fk_dados_censo_aluno_cadastro_aluno1` (`cadastro_aluno_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_censo_vinculo_curso`
--

CREATE TABLE IF NOT EXISTS `dados_censo_vinculo_curso` (
  `dados_censo_id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_registro` int(2) NOT NULL DEFAULT '42' COMMENT 'Salvar sempre como 42',
  `codigo_curso_inep` int(12) NOT NULL COMMENT 'ID do curso no INEP',
  `curso_origem` int(11) DEFAULT NULL COMMENT 'se a situação do vinculo do aluno for = 5 - Transferido para outro curso da mesma instituição, deve ser informado o código do curso de origem, código no INEP.',
  `semestre_conclusao` varchar(15) DEFAULT NULL COMMENT 'Valores:\n\n1 - 1o Semestre\n2 - 2o Semestre',
  `parfor` int(11) DEFAULT NULL COMMENT 'deve ser informado quando o curso possui o grau de licenciatura.\n\n0 - Não\n1 - SIM',
  `tipo_escola` int(11) DEFAULT NULL COMMENT 'Tipo de escola que concluiu o ensino médio.\n\n\n0- Privado\n1 - Público\n2 - Não dispõe da informação',
  `fi_vestibular` int(11) NOT NULL COMMENT 'a forma de ingresso foi vestibular?\n\n0- NÃO\n1 - SIM',
  `fi_enem` int(11) NOT NULL COMMENT '0 - NÃO\n1 - SIM',
  `fi_avaliacao_seriada` int(11) NOT NULL COMMENT '0 - NÃO\n1 - SIM',
  `fi_selecao_simplificada` int(11) NOT NULL COMMENT '0 - NÃO\n1 - SIM',
  `fi_pecg` int(11) DEFAULT NULL COMMENT 'Este campo só é informado se a nacionalidade do aluno for ESTRANGEIRA\n\n0 - NÃO\n1 - SIM',
  `fi_transferencia_exoficcio` int(11) NOT NULL COMMENT '0 - NÃO\n1 - SIM',
  `fi_decisao_judicial` int(11) NOT NULL COMMENT '0 - NÃO\n1 - SIM',
  `fi_vagas_remanescentes` int(11) NOT NULL COMMENT '0 - NÃO\n1 - SIM',
  `fi_programas_especiais` int(11) NOT NULL,
  `mobilidade_academica` int(11) NOT NULL COMMENT '0 - NÃO\n1 - SIM',
  `ies_destino` int(12) DEFAULT NULL COMMENT 'só é possível informar se no campo MOBILIDADE ACADÊMICA = 1.\n\n',
  `mobilidade_academica_internacional` int(11) DEFAULT NULL COMMENT 'se informado a opcao 1 na MOBILIDADE ACADÊMICA\n\nvalores válidos:\n1 - Intercambio\n2 - Ciências sem fronteiras',
  `pais_destino` int(11) DEFAULT NULL COMMENT 'obrigatório quando for selecionado a opção TIPO DE MOBILIDADE ACADÊMICA INTERNACIONAL.\n\nVer código do país na tabela.',
  `programa_reserva_vagas` int(11) NOT NULL COMMENT '0 - não\n1 - SIM',
  `pr_etnico` int(11) DEFAULT NULL COMMENT '0- nao\n1- sim',
  `pr_pessoa_deficiencia` int(11) DEFAULT NULL COMMENT '0- nao\n1- sim',
  `pr_procedente_escola_publica` int(11) DEFAULT NULL COMMENT '0- nao\n1- sim',
  `pr_renda_familiar` int(11) DEFAULT NULL COMMENT '0- nao\n1- sim',
  `pr_outros` int(11) DEFAULT NULL COMMENT '0- nao\n1- sim',
  `financiamento_estudantil` int(11) NOT NULL COMMENT '0 - NAO\n1 - SIM',
  `fe_fies` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `fi_governo_estadual` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `fi_governo_municipal` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `fe_ies` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `fe_entidades_externas` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `fnr_prouni_integral` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `fnr_prouni_parcial` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `fnr_entidades_externas` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `fnr_governo_estadual` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `fnr_ies` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `fnr_governo_municipal` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `apoio_social` int(11) NOT NULL COMMENT '0 - NAO\n1 - SIM',
  `as_alimentacao` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `as_moradia` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `as_transporte` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `as_material_didatico` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `as_bolsa_trabalho` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `as_bolsa_permanencia` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `atividade_extracurricular` int(11) NOT NULL COMMENT '0 - NAO\n1 - SIM',
  `ae_pesquisa` int(11) DEFAULT NULL,
  `bolsa_ae_pesquisa` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `ae_extensao` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `bolsa_ae_extensao` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `ae_monitoria` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `bolsa_ae_monitoria` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `ae_estagio_nao_obrigatorio` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `bolsa_ae_estagio_nao_obrigatorio` int(11) DEFAULT NULL COMMENT '0 - NAO\n1 - SIM',
  `matricula_aluno_id` int(11) NOT NULL,
  PRIMARY KEY (`dados_censo_id`),
  KEY `fk_dados_censo_vinculo_curso_matricula_aluno1` (`matricula_aluno_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE IF NOT EXISTS `disciplina` (
  `disciplina_id` int(11) NOT NULL AUTO_INCREMENT,
  `disc_tx_descricao` varchar(350) NOT NULL,
  `disc_tx_abrev` varchar(100) NOT NULL,
  `cursos_id` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`disciplina_id`),
  KEY `fk_disciplina_cursos1` (`cursos_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`disciplina_id`, `disc_tx_descricao`, `disc_tx_abrev`, `cursos_id`) VALUES
(7, 'TEORIA GERAL DA ADMINISTRACAO ', 'TGA', 0000000001),
(8, 'PORTUGUES INSTRUMENTAL', 'PTI', 0000000001),
(9, 'MATEMATICA APLICADA ', 'MTA', 0000000001),
(10, 'METÓDO E TÉCNICA DA PESQUISA CIENTÍFICA', 'MTPC', 0000000001),
(11, 'TEORIA ECONOMICA', 'TEOE', 0000000001),
(12, 'PSICOLOGIA E COMPORTAMENTO ORGANIZACIONAL', 'PCO', 0000000001),
(13, 'GESTÃO DAS ORGANIZAÇÕES', 'GDO', 0000000001),
(14, 'FILOSOFIA E ÉTICA PROFISSIONAL', 'FEP', 0000000001),
(15, 'MATEMATICA FINANCEIRA', 'MTF', 0000000001),
(16, 'CONTABILIDADE GERAL', 'CTG', 0000000001),
(17, 'ESTUDOS ANTROPOLÓGICOS E SOCIOLÓGICOS', 'EAS', 0000000001),
(18, 'ECONOMIA DAS ORGANIZAÇÕES', 'ECO', 0000000001),
(19, 'CULTURA RELIGIOSA', 'CTR', 0000000001),
(20, 'ORGANIZAÇÃO,SISTEMAS E MÉTODOS', 'OSM', 0000000001),
(21, 'LEGISLAÇÃO EMPRESARIAL', 'LGE', 0000000001),
(22, 'ADMINISTRAÇÃO FINANCEIRA E ORÇAMENTÁRIA', 'AFO', 0000000001),
(23, 'CUSTOS EMPRESARIAIS', 'CTE', 0000000001),
(24, 'ADMINISTRAÇÃO DE SERVIÇOS', 'ADS', 0000000001),
(25, 'DESENVOLVIMENTO GERENCIAL', 'DSG', 0000000001),
(26, 'ADMINISTRAÇÃO DE SISTEMAS DE INFORMAÇÃO', 'ASI', 0000000001),
(27, 'ADMINISTRAÇÃO DA PRODUÇÃO', 'ADP', 0000000001),
(28, 'ESTATÍSTICA', 'EST', 0000000001),
(29, 'GESTÃO DA QUALIDADE', 'GDQ', 0000000001),
(30, 'ADMINISTRAÇÃO DE RECURSOS HUMANOS', 'ARH', 0000000001),
(31, 'INFORMÁTICA APLICADA', 'IFA', 0000000001),
(32, 'NIVELAMENTO-LÓGICA DE RACIOCÍNIO', 'NLR', 0000000001),
(33, 'GESTÃO DE RECURSOS HUMANOS ', 'GRH', 0000000001),
(34, 'ADMINISTRAÇÃO PÚBLICA', 'ADP', 0000000001),
(35, 'NEGOCIAÇÃO EMPRESARIAL', 'NGE', 0000000001),
(36, 'LEGISLAÇÃO TRABALHISTA', 'LGT', 0000000001),
(37, 'ADMINISTRAÇÃO MERCADOLÓGICA I', 'AMI', 0000000001),
(38, 'INTELiGÊNCIA COMPETITIVA E GESTAO DO CONHECIMENTO', 'ICGC', 0000000001),
(39, 'LOGISTICA EMPRESARIAL ', 'LGE', 0000000001),
(40, 'COMERCIO EXTERIOR', 'CME', 0000000001),
(41, 'LEGISLAÇÃO TRIBUTÁRIA ', 'LTB', 0000000001),
(42, 'GESTÃO DO MEIO AMBIENTE', 'GMA', 0000000001),
(43, 'ADMINISTRAÇÃO MERCADOLÓGICA II', 'AMII', 0000000001),
(44, 'FUNDAMENTOS BÁSICOS DE ESTÁGIO', 'FBE', 0000000001),
(45, 'LIBRAS', 'LIB', 0000000001),
(46, 'ESTÁGIO SUPERVISIONADO', 'ESP', 0000000001),
(47, 'TRABALHO DE CONCLUSÃO DE CURSO I', 'TCCI', 0000000001),
(48, 'GESTÃO E AVALIAÇÃO DE PROJETOS', 'GAP', 0000000001),
(49, 'PLANEJAMENTO E GESTÃO ESTRATÉGICA', 'PGE', 0000000001),
(50, 'GESTÃO DE RISCO', 'GRC', 0000000001),
(51, 'GESTÃO ESTRATÉGICA DE VENDAS', 'GEV', 0000000001),
(52, 'TRABALHO DE CONCLUSÃO DE CURSO II', 'TCCII', 0000000001),
(53, 'EMPREENDEDORISMO', 'EPD', 0000000001),
(54, 'TERCEIRO SETOR E RESPONSABILIDADE SOCIAL', 'TSRS', 0000000001),
(55, 'CULTURA RELIGIOSA ', 'CRL', 0000000001),
(56, 'TEORIA ECONOMICA', 'TEE', 0000000001);

-- --------------------------------------------------------

--
-- Estrutura da tabela `etapa`
--

CREATE TABLE IF NOT EXISTS `etapa` (
  `etapa_id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) NOT NULL COMMENT 'é o nome abreviado da etapa,\nex.:\n\nNota I BIM\nF. I BIM\n',
  `descricao` varchar(200) NOT NULL COMMENT 'descrição mais completa da etapa:\nAvaliação do I BImestre',
  `valor` float NOT NULL COMMENT 'O Valor máximo que a nota pode ser.\n\nex. : 10, 100\n',
  `data_avaliacao` date DEFAULT NULL,
  `peso_avaliacao` int(11) NOT NULL COMMENT 'O valor do peso da avaliação,\n\nEx:\n\nEtapa 1, peso = 1,\n\nValor da etapa = Valor da nota X o valor do peso.\n',
  `etapa_periodo_id` int(11) NOT NULL,
  `tipo_etapa` int(11) NOT NULL COMMENT '1 - Nota\n2 - Falta',
  `media` double NOT NULL COMMENT 'média para aprovação na etapa,\n\nem alguns casos,\n\nse tem:\n\nI bim, II Bim e PF\n\ne a média na PF é diferente do I e II Bim.',
  PRIMARY KEY (`etapa_id`),
  KEY `fk_etapa_etapa_periodo1` (`etapa_periodo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `etapa_periodo`
--

CREATE TABLE IF NOT EXISTS `etapa_periodo` (
  `etapa_periodo_id` int(11) NOT NULL AUTO_INCREMENT,
  `periodo_letivo_id` int(11) NOT NULL,
  `media_notas` double NOT NULL COMMENT 'A média para aprovação',
  `porcentagem_faltas` int(11) NOT NULL COMMENT 'A porcentagem de falta permitida, ex:\n\n25%, acima disso, seria reprovado.',
  PRIMARY KEY (`etapa_periodo_id`),
  KEY `fk_etapa_periodo_periodo_letivo1` (`periodo_letivo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `instituicao`
--

CREATE TABLE IF NOT EXISTS `instituicao` (
  `instituicao_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_abreviatura` varchar(50) NOT NULL,
  `nome_instituicao` varchar(250) NOT NULL,
  `logo_instituicao` varchar(250) DEFAULT NULL,
  `id_inep` int(12) DEFAULT NULL,
  `tipo_registro` int(2) NOT NULL DEFAULT '40' COMMENT 'Informação para o censo do MEC, o tipo de registro será sempre 40.',
  `tipo_arquivo` int(1) NOT NULL COMMENT 'informação para o censo MEC, o tipo do arquivo será sempre 4.\n',
  `endereco` varchar(300) DEFAULT NULL,
  `contato` varchar(200) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `site` varchar(100) DEFAULT NULL,
  `cnpj` varchar(25) DEFAULT NULL,
  `ie` varchar(25) DEFAULT NULL,
  `im` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`instituicao_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `instituicao`
--

INSERT INTO `instituicao` (`instituicao_id`, `nome_abreviatura`, `nome_instituicao`, `logo_instituicao`, `id_inep`, `tipo_registro`, `tipo_arquivo`, `endereco`, `contato`, `email`, `site`, `cnpj`, `ie`, `im`) VALUES
(1, 'FBN', 'Faculdade Boas Novas', NULL, NULL, 40, 42, 'Gen. Rodrigo Octávio 1655', '92 32372214', 'contato@fbnovas.edu.br', 'www.fbnovas.edu.br', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `phrase_id` int(11) NOT NULL AUTO_INCREMENT,
  `phrase` longtext COLLATE utf8_unicode_ci NOT NULL,
  `Portugues` longtext COLLATE utf8_unicode_ci NOT NULL,
  `Português` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`phrase_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5190 ;

--
-- Extraindo dados da tabela `language`
--

INSERT INTO `language` (`phrase_id`, `phrase`, `Portugues`, `Português`) VALUES
(1, 'login', 'Login', ''),
(2, 'account_type', 'Tipo da Conta', ''),
(3, 'admin', 'Administrador', ''),
(4, 'teacher', 'Professor', ''),
(5, 'student', 'Aluno', ''),
(6, 'parent', 'Responsável', ''),
(7, 'email', 'Email', ''),
(8, 'password', 'Senha', ''),
(9, 'forgot_password ?', 'Esqueceu sua Senha?', ''),
(10, 'reset_password', 'Resetar a Senha', ''),
(11, 'reset', 'Resetar', ''),
(12, 'admin_dashboard', 'Painel de Administração', ''),
(13, 'account', 'Conta', ''),
(14, 'profile', 'Perfil', ''),
(15, 'change_password', 'Alterar Senha', ''),
(16, 'logout', 'Sair', ''),
(17, 'panel', 'Painel', ''),
(18, 'dashboard_help', 'Carregar o Dashboard', ''),
(19, 'dashboard', 'Administração', ''),
(20, 'student_help', 'Carregar os Alunos', ''),
(21, 'teacher_help', 'Carregar os Professores', ''),
(22, 'subject_help', 'Carregar os Assuntos', ''),
(23, 'subject', 'Assunto', ''),
(24, 'class_help', 'Carregar as Turmas', ''),
(25, 'class', 'Turma', ''),
(26, 'exam_help', 'Carregar as Avaliações', ''),
(27, 'exam', 'Avaliações', ''),
(28, 'marks_help', 'Carregar os Agendamentos de Atendimentos', ''),
(29, 'marks-attendance', 'Agenda de atendimento', ''),
(30, 'grade_help', 'Carregar as Grades', ''),
(31, 'exam-grade', 'Grade de Avaliações', ''),
(32, 'class_routine_help', 'Carregar as Turmas', ''),
(33, 'class_routine', 'Rotina da Turma', ''),
(34, 'invoice_help', 'Carregar as Faturas', ''),
(35, 'payment', 'Pagamento', ''),
(36, 'book_help', 'Carregar os Livros', ''),
(37, 'library', 'Biblioteca', ''),
(38, 'transport_help', 'Carregar os Transportes', ''),
(39, 'transport', 'Transporte', ''),
(40, 'dormitory_help', 'Carregar os Dormitórios', ''),
(41, 'dormitory', 'Dormitório', ''),
(42, 'noticeboard_help', 'Carregar Quadro de Avisos', ''),
(43, 'noticeboard-event', 'Painel de Eventos', ''),
(44, 'bed_ward_help', 'Carregarr Configurações', ''),
(45, 'settings', 'Definições', ''),
(46, 'system_settings', 'Configuração do Sistema', ''),
(47, 'manage_language', 'Gerenciar Idiomas', ''),
(48, 'backup_restore', 'Backup/Restaurar', ''),
(49, 'profile_help', 'Carregar os Perfis', ''),
(50, 'Gerenciar Alunos', 'Gerenciar Alunos', ''),
(51, 'manage_teacher', 'Gerenciar Professores', ''),
(52, 'noticeboard', 'Quadro de avisos', ''),
(53, 'language', 'Idioma', ''),
(54, 'backup', 'Backup', ''),
(55, 'calendar_schedule', 'Agenda', ''),
(56, 'select_a_class', 'Selecionar a Classe', ''),
(57, 'student_list', 'Lista de Alunos', ''),
(58, 'add_student', 'Adicionar Aluno', ''),
(59, 'roll', 'Movimentar', ''),
(60, 'photo', 'Foto', ''),
(61, 'student_name', 'Nome Estudante', ''),
(62, 'address', 'Endereço', ''),
(63, 'options', 'Opções', ''),
(64, 'marksheet', 'Folha', ''),
(65, 'id_card', 'Cartão', ''),
(66, 'edit', 'Editar', ''),
(67, 'delete', 'Deletar', ''),
(68, 'personal_profile', 'Perfil do Profissional', ''),
(69, 'academic_result', 'Resultado Acadêmico', ''),
(70, 'name', 'Nome', ''),
(71, 'birthday', 'Aniversário', ''),
(72, 'sex', 'Sexo', ''),
(73, 'male', 'Maculino', ''),
(74, 'female', 'Feminino', ''),
(75, 'religion', 'Religião', ''),
(76, 'blood_group', 'Grupo Sanguíneo', ''),
(77, 'phone', 'Telefone', ''),
(78, 'father_name', 'Nome do Pai', ''),
(79, 'mother_name', 'Nome da mãe', ''),
(80, 'edit_student', 'Editar Aluno', ''),
(81, 'teacher_list', 'Lista de Professores', ''),
(82, 'add_teacher', 'Adicionar Professor', ''),
(83, 'teacher_name', 'Nome do Professor', ''),
(84, 'edit_teacher', 'Editar Professor', ''),
(85, 'manage_parent', 'Gerenciar Responsáveis', ''),
(86, 'parent_list', 'Lista de Responsáveis', ''),
(87, 'parent_name', 'Nome do Responsável', ''),
(88, 'relation_with_student', 'Relacionamento com o Aluno', ''),
(89, 'parent_email', 'Email do Responsável', ''),
(90, 'parent_phone', 'Telefone do Responsável', ''),
(91, 'parrent_address', 'Endereço do Responsável', ''),
(92, 'parrent_occupation', 'Ocupação do Responsável', ''),
(93, 'add', 'Adicionar', ''),
(94, 'parent_of', 'Responsável de', ''),
(95, 'profession', 'Profissão', ''),
(96, 'edit_parent', 'Editar Responsável', ''),
(97, 'add_parent', 'Adicionar Responsável', ''),
(98, 'manage_subject', 'Gerenciar Assuntos', ''),
(99, 'subject_list', 'Lista de Assuntos', ''),
(100, 'add_subject', 'Adicionar Assunto', ''),
(101, 'subject_name', 'Nome da Assunto', ''),
(102, 'edit_subject', 'Editar Assunto', ''),
(103, 'manage_class', 'Gerenciar Turmas', ''),
(104, 'class_list', 'Lista de Turmas', ''),
(105, 'add_class', 'Adicionar Turma', ''),
(106, 'class_name', 'Nome da Turma', ''),
(107, 'numeric_name', 'Número da Turma', ''),
(108, 'name_numeric', 'Descrição da Truma', ''),
(109, 'edit_class', 'Editar Turma', ''),
(110, 'manage_exam', 'Gerenciar Avaliações', ''),
(111, 'exam_list', 'Lista de Avaliações', ''),
(112, 'add_exam', 'Adicionar Avaliação', ''),
(113, 'exam_name', 'Nome da Avaliação', ''),
(114, 'date', 'Data', ''),
(115, 'comment', 'Comentário', ''),
(116, 'edit_exam', 'Editar Avaliação', ''),
(117, 'manage_exam_marks', 'Gerenciar Marcação de Avaliação', ''),
(118, 'manage_marks', 'Gerenciar Marcas', ''),
(119, 'select_exam', 'Selecionar Avaliação', ''),
(120, 'select_class', 'Selecionar Turma', ''),
(121, 'select_subject', 'Selecione Assunto', ''),
(122, 'select_an_exam', 'Selecione uma Avaliação', ''),
(123, 'mark_obtained', 'Marcação Obtida', ''),
(124, 'attendance', 'Atendimento', ''),
(125, 'manage_grade', 'Gerenciar Grade', ''),
(126, 'grade_list', 'Lista de Grade', ''),
(127, 'add_grade', 'Adicionar Grade', ''),
(128, 'grade_name', 'Nome da Grade', ''),
(129, 'grade_point', '', ''),
(130, 'mark_from', '', ''),
(131, 'mark_upto', '', ''),
(132, 'edit_grade', 'Editar Grade', ''),
(133, 'manage_class_routine', 'Gerenciar Rotina da Turma', ''),
(134, 'class_routine_list', 'Lista de Rotinas das Turmas', ''),
(135, 'add_class_routine', 'Adicionar Rotina de Turma', ''),
(136, 'day', 'Dia', ''),
(137, 'starting_time', 'Hora Início', ''),
(138, 'ending_time', 'Hora Fim', ''),
(139, 'edit_class_routine', 'Editar Rotina de Classe', ''),
(140, 'manage_invoice/payment', 'Gerenciar Pagamentos', ''),
(141, 'invoice/payment_list', 'Lista de Pagamentos', ''),
(142, 'add_invoice/payment', 'Adicionar Pagamento', ''),
(143, 'title', 'Título', ''),
(144, 'description', 'Descrição', ''),
(145, 'amount', 'Valor', ''),
(146, 'status', 'Situação', ''),
(147, 'view_invoice', 'Visualizar  Recibo', ''),
(148, 'paid', 'Pago', ''),
(149, 'unpaid', 'Não Pago', ''),
(150, 'add_invoice', 'Adicionar Pagamento', ''),
(151, 'payment_to', 'Pagamento', ''),
(152, 'bill_to', 'Cliente', ''),
(153, 'invoice_title', 'Título da Fatura', ''),
(154, 'invoice_id', 'Nº. da Fatura', ''),
(155, 'edit_invoice', 'Editar Fatura', ''),
(156, 'manage_library_books', 'Gerenciar Biblioteca', ''),
(157, 'book_list', 'Lista de Livros', ''),
(158, 'add_book', 'Adicionar Livro', ''),
(159, 'book_name', 'Título do Livro', ''),
(160, 'author', 'Autor', ''),
(161, 'price', 'Preço', ''),
(162, 'available', 'Disponível', ''),
(163, 'unavailable', 'Indisponível', ''),
(164, 'edit_book', 'Editar Livro', ''),
(165, 'manage_transport', 'Gerenciar Transporte', ''),
(166, 'transport_list', 'Lista de Transportes', ''),
(167, 'add_transport', 'Adicionar Transporte', ''),
(168, 'route_name', 'Descrição da Rota', ''),
(169, 'number_of_vehicle', 'Placa do Veículo', ''),
(170, 'route_fare', 'Tarifa', ''),
(171, 'edit_transport', 'Editar Transporte', ''),
(172, 'manage_dormitory', 'Gerenciar Dormitório', ''),
(173, 'dormitory_list', 'Lista de Dormitórios', ''),
(174, 'add_dormitory', 'Adicionar Dormitório', ''),
(175, 'dormitory_name', 'Descrição do Dormitórios', ''),
(176, 'number_of_room', 'Número do Quarto', ''),
(177, 'manage_noticeboard', 'Gerenciar Quadro de Avisos', ''),
(178, 'noticeboard_list', 'Lista de Quadro de Avisos', ''),
(179, 'add_noticeboard', 'Adicionar Quadro de Avisos', ''),
(180, 'notice', 'Aviso', ''),
(181, 'add_notice', 'Adicionar Aviso', ''),
(182, 'edit_noticeboard', 'Editar Quadro de Avisos', ''),
(183, 'system_name', 'Nome do Sistema', ''),
(184, 'save', 'Salvar', ''),
(185, 'system_title', 'Título do Sistema', ''),
(186, 'paypal_email', 'Email Para Pagamento', ''),
(187, 'currency', 'Modeda', ''),
(188, 'phrase_list', 'Lista de Frases', ''),
(189, 'add_phrase', 'Adicionar Frase', ''),
(190, 'add_language', 'Adicionar Idioma', ''),
(191, 'phrase', 'Frase', ''),
(192, 'manage_backup_restore', 'Gerenciar Backup/Restaurar', ''),
(193, 'restore', 'Restarar', ''),
(194, 'mark', 'Marcação', ''),
(195, 'grade', 'Grade', ''),
(196, 'invoice', 'Fatura', ''),
(197, 'book', 'Livro', ''),
(198, 'all', 'Todos', ''),
(199, 'upload_&_restore_from_backup', 'Upload para Restaurar Backup', ''),
(200, 'manage_profile', 'Gerenciar Perfil', ''),
(201, 'update_profile', 'Atualizar Perfil', ''),
(202, 'new_password', 'Nova Senha', ''),
(203, 'confirm_new_password', 'Confirmar Nova Senha', ''),
(204, 'update_password', 'Alterar Senha', ''),
(205, 'teacher_dashboard', 'Dashboard do Professor', ''),
(206, 'backup_restore_help', 'Backup/Restaurar', ''),
(207, 'student_dashboard', 'Dashboard do Aluno', ''),
(208, 'parent_dashboard', 'Dashboard do Responsável', ''),
(209, 'view_marks', 'Visualizar Marcação', ''),
(210, 'delete_language', 'Excluir Idioma', ''),
(211, 'settings_updated', 'Configuração Atualizada', ''),
(212, 'update_phrase', 'Alterar Frase', ''),
(213, 'login_failed', 'Falha na Autenticação', ''),
(214, 'option', 'Opções', ''),
(215, 'edit_phrase', 'Editar Frase', ''),
(216, 'system_email', 'Email do Sistema', ''),
(217, 'password_updated', 'Senha Atualizada', ''),
(218, 'password_mismatch', 'Senha Diferente', ''),
(219, 'account_not_found', 'Conta Não encontrada!!', ''),
(220, 'account_updated', 'Atualizar Conta', ''),
(221, 'password_sent', 'Senha Enviada', ''),
(222, 'notice_updated', 'Aviso Atualizado', ''),
(223, 'Espanhol', 'Espanhol', ''),
(238, 'gerenciar_estudante', '', ''),
(237, 'manage_student', '', ''),
(236, 'fornecedor', '', ''),
(235, 'vendas', '', ''),
(234, 'orçamento', '', ''),
(233, 'clientes', '', ''),
(232, 'comercial', '', ''),
(239, 'painel_administrativo', '', ''),
(240, 'professor', '', ''),
(241, 'aluno', '', ''),
(242, 'gerenciar_aluno', '', ''),
(243, 'alunos', '', ''),
(733, 'Processo Seletivo', '', ''),
(734, 'Processo Seletivo', '', ''),
(735, 'Processo Seletivo', '', ''),
(736, 'Processo Seletivo', '', ''),
(737, 'Processo Seletivo', '', ''),
(738, 'Processo Seletivo', '', ''),
(739, 'Processo Seletivo', '', ''),
(740, 'Processo Seletivo', '', ''),
(741, 'Processo Seletivo', '', ''),
(742, 'Processo Seletivo', '', ''),
(743, 'Processo Seletivo', '', ''),
(744, 'Processo Seletivo', '', ''),
(745, 'Processo Seletivo', '', ''),
(746, 'Processo Seletivo', '', ''),
(747, 'Processo Seletivo', '', ''),
(748, 'Processo Seletivo', '', ''),
(749, 'Processo Seletivo', '', ''),
(750, 'Processo Seletivo', '', ''),
(751, 'Processo Seletivo', '', ''),
(752, 'Processo Seletivo', '', ''),
(753, 'Processo Seletivo', '', ''),
(754, 'Processo Seletivo', '', ''),
(755, 'Processo Seletivo', '', ''),
(756, 'Processo Seletivo', '', ''),
(757, 'cadastro vestibular', '', ''),
(758, 'chamada vestibular', '', ''),
(759, 'candidato', '', ''),
(760, 'Processo Seletivo', '', ''),
(761, 'Processo Seletivo', '', ''),
(762, 'Processo Seletivo', '', ''),
(763, 'Processo Seletivo', '', ''),
(764, 'Processo Seletivo', '', ''),
(765, 'Processo Seletivo', '', ''),
(766, 'Processo Seletivo', '', ''),
(767, 'Processo Seletivo', '', ''),
(768, 'Processo Seletivo', '', ''),
(769, 'Processo Seletivo', '', ''),
(770, 'Processo Seletivo', '', ''),
(771, 'Processo Seletivo', '', ''),
(772, 'Processo Seletivo', '', ''),
(773, 'Processo Seletivo', '', ''),
(774, 'Processo Seletivo', '', ''),
(775, 'Processo Seletivo', '', ''),
(776, 'Processo Seletivo', '', ''),
(777, 'Processo Seletivo', '', ''),
(778, 'Processo Seletivo', '', ''),
(779, 'Processo Seletivo', '', ''),
(780, 'Processo Seletivo', '', ''),
(781, 'Processo Seletivo', '', ''),
(782, 'Processo Seletivo', '', ''),
(783, 'Processo Seletivo', '', ''),
(784, 'Processo Seletivo', '', ''),
(785, 'Processo Seletivo', '', ''),
(786, 'Processo Seletivo', '', ''),
(787, 'Processo Seletivo', '', ''),
(788, 'Processo Seletivo', '', ''),
(789, 'Processo Seletivo', '', ''),
(790, 'Processo Seletivo', '', ''),
(791, 'Processo Seletivo', '', ''),
(792, 'Processo Seletivo', '', ''),
(793, 'Processo Seletivo', '', ''),
(794, 'Processo Seletivo', '', ''),
(795, 'Processo Seletivo', '', ''),
(796, 'Processo Seletivo', '', ''),
(797, 'Processo Seletivo', '', ''),
(798, 'Processo Seletivo', '', ''),
(799, 'Processo Seletivo', '', ''),
(800, 'Processo Seletivo', '', ''),
(801, 'Processo Seletivo', '', ''),
(802, 'Processo Seletivo', '', ''),
(803, 'Processo Seletivo', '', ''),
(804, 'Processo Seletivo', '', ''),
(805, 'Processo Seletivo', '', ''),
(806, 'Processo Seletivo', '', ''),
(807, 'Processo Seletivo', '', ''),
(808, 'Processo Seletivo', '', ''),
(809, 'Processo Seletivo', '', ''),
(810, 'Processo Seletivo', '', ''),
(811, 'Processo Seletivo', '', ''),
(812, 'Processo Seletivo', '', ''),
(813, 'Processo Seletivo', '', ''),
(814, 'Processo Seletivo', '', ''),
(815, 'Processo Seletivo', '', ''),
(816, 'Processo Seletivo', '', ''),
(817, 'Processo Seletivo', '', ''),
(818, 'Processo Seletivo', '', ''),
(819, 'Processo Seletivo', '', ''),
(820, 'Processo Seletivo', '', ''),
(821, 'Processo Seletivo', '', ''),
(822, 'Processo Seletivo', '', ''),
(823, 'Processo Seletivo', '', ''),
(824, 'Processo Seletivo', '', ''),
(825, 'Processo Seletivo', '', ''),
(826, 'Processo Seletivo', '', ''),
(827, 'Processo Seletivo', '', ''),
(828, 'Processo Seletivo', '', ''),
(829, 'Processo Seletivo', '', ''),
(830, 'Processo Seletivo', '', ''),
(831, 'Processo Seletivo', '', ''),
(832, 'Processo Seletivo', '', ''),
(833, 'Processo Seletivo', '', ''),
(834, 'Processo Seletivo', '', ''),
(835, 'Processo Seletivo', '', ''),
(836, 'Processo Seletivo', '', ''),
(837, 'Processo Seletivo', '', ''),
(838, 'Processo Seletivo', '', ''),
(839, 'Processo Seletivo', '', ''),
(840, 'Processo Seletivo', '', ''),
(841, 'Processo Seletivo', '', ''),
(842, 'Processo Seletivo', '', ''),
(843, 'Processo Seletivo', '', ''),
(844, 'Processo Seletivo', '', ''),
(845, 'Processo Seletivo', '', ''),
(846, 'Processo Seletivo', '', ''),
(847, 'Processo Seletivo', '', ''),
(848, 'Processo Seletivo', '', ''),
(849, 'Processo Seletivo', '', ''),
(850, 'Processo Seletivo', '', ''),
(851, 'Processo Seletivo', '', ''),
(852, 'Processo Seletivo', '', ''),
(853, 'Processo Seletivo', '', ''),
(854, 'Processo Seletivo', '', ''),
(855, 'Processo Seletivo', '', ''),
(856, 'Processo Seletivo', '', ''),
(857, 'Processo Seletivo', '', ''),
(858, 'Processo Seletivo', '', ''),
(859, 'Processo Seletivo', '', ''),
(860, 'Processo Seletivo', '', ''),
(861, 'Processo Seletivo', '', ''),
(862, 'Processo Seletivo', '', ''),
(863, 'Processo Seletivo', '', ''),
(864, 'Processo Seletivo', '', ''),
(865, 'Processo Seletivo', '', ''),
(866, 'Processo Seletivo', '', ''),
(867, 'Processo Seletivo', '', ''),
(868, 'Processo Seletivo', '', ''),
(869, 'Processo Seletivo', '', ''),
(870, 'Processo Seletivo', '', ''),
(871, 'Processo Seletivo', '', ''),
(872, 'Processo Seletivo', '', ''),
(873, 'Processo Seletivo', '', ''),
(874, 'Processo Seletivo', '', ''),
(875, 'Processo Seletivo', '', ''),
(876, 'Processo Seletivo', '', ''),
(877, 'Processo Seletivo', '', ''),
(878, 'Processo Seletivo', '', ''),
(879, 'Processo Seletivo', '', ''),
(880, 'Processo Seletivo', '', ''),
(881, 'Processo Seletivo', '', ''),
(882, 'Processo Seletivo', '', ''),
(883, 'Processo Seletivo', '', ''),
(884, 'Processo Seletivo', '', ''),
(885, 'Processo Seletivo', '', ''),
(886, 'Processo Seletivo', '', ''),
(887, 'Processo Seletivo', '', ''),
(888, 'Processo Seletivo', '', ''),
(889, 'Processo Seletivo', '', ''),
(890, 'Processo Seletivo', '', ''),
(891, 'Processo Seletivo', '', ''),
(892, 'Processo Seletivo', '', ''),
(893, 'Processo Seletivo', '', ''),
(894, 'Processo Seletivo', '', ''),
(895, 'Processo Seletivo', '', ''),
(896, 'Processo Seletivo', '', ''),
(897, 'Processo Seletivo', '', ''),
(898, 'Processo Seletivo', '', ''),
(899, 'Processo Seletivo', '', ''),
(900, 'Processo Seletivo', '', ''),
(901, 'Processo Seletivo', '', ''),
(902, 'Processo Seletivo', '', ''),
(903, 'Processo Seletivo', '', ''),
(904, 'Processo Seletivo', '', ''),
(905, 'Processo Seletivo', '', ''),
(906, 'Processo Seletivo', '', ''),
(907, 'Processo Seletivo', '', ''),
(908, 'Processo Seletivo', '', ''),
(909, 'Processo Seletivo', '', ''),
(910, 'Processo Seletivo', '', ''),
(911, 'Processo Seletivo', '', ''),
(912, 'Processo Seletivo', '', ''),
(913, 'Processo Seletivo', '', ''),
(914, 'Processo Seletivo', '', ''),
(915, 'Processo Seletivo', '', ''),
(916, 'Processo Seletivo', '', ''),
(917, 'Processo Seletivo', '', ''),
(918, 'Processo Seletivo', '', ''),
(919, 'Processo Seletivo', '', ''),
(920, 'Processo Seletivo', '', ''),
(921, 'Processo Seletivo', '', ''),
(922, 'Processo Seletivo', '', ''),
(923, 'Processo Seletivo', '', ''),
(924, 'Processo Seletivo', '', ''),
(925, 'Processo Seletivo', '', ''),
(926, 'Processo Seletivo', '', ''),
(927, 'Processo Seletivo', '', ''),
(928, 'Processo Seletivo', '', ''),
(929, 'Processo Seletivo', '', ''),
(930, 'Processo Seletivo', '', ''),
(931, 'Processo Seletivo', '', ''),
(932, 'Processo Seletivo', '', ''),
(933, 'Processo Seletivo', '', ''),
(934, 'Processo Seletivo', '', ''),
(935, 'Processo Seletivo', '', ''),
(936, 'Processo Seletivo', '', ''),
(937, 'Processo Seletivo', '', ''),
(938, 'Processo Seletivo', '', ''),
(939, 'Processo Seletivo', '', ''),
(940, 'Processo Seletivo', '', ''),
(941, 'Processo Seletivo', '', ''),
(942, 'Processo Seletivo', '', ''),
(943, 'Processo Seletivo', '', ''),
(944, 'Processo Seletivo', '', ''),
(945, 'Processo Seletivo', '', ''),
(946, 'Processo Seletivo', '', ''),
(947, 'Processo Seletivo', '', ''),
(948, 'Processo Seletivo', '', ''),
(949, 'Processo Seletivo', '', ''),
(950, 'Processo Seletivo', '', ''),
(951, 'Processo Seletivo', '', ''),
(952, 'Processo Seletivo', '', ''),
(953, 'Processo Seletivo', '', ''),
(954, 'Processo Seletivo', '', ''),
(955, 'Processo Seletivo', '', ''),
(956, 'Processo Seletivo', '', ''),
(957, 'Processo Seletivo', '', ''),
(958, 'Processo Seletivo', '', ''),
(959, 'Processo Seletivo', '', ''),
(960, 'Processo Seletivo', '', ''),
(961, 'Processo Seletivo', '', ''),
(962, 'Processo Seletivo', '', ''),
(963, 'Processo Seletivo', '', ''),
(964, 'Processo Seletivo', '', ''),
(965, 'Processo Seletivo', '', ''),
(966, 'Processo Seletivo', '', ''),
(967, 'Processo Seletivo', '', ''),
(968, 'Processo Seletivo', '', ''),
(969, 'Processo Seletivo', '', ''),
(970, 'Processo Seletivo', '', ''),
(971, 'Processo Seletivo', '', ''),
(972, 'Processo Seletivo', '', ''),
(973, 'Processo Seletivo', '', ''),
(974, 'Processo Seletivo', '', ''),
(975, 'Processo Seletivo', '', ''),
(976, 'Processo Seletivo', '', ''),
(977, 'Processo Seletivo', '', ''),
(978, 'Processo Seletivo', '', ''),
(979, 'Processo Seletivo', '', ''),
(980, 'Processo Seletivo', '', ''),
(981, 'Processo Seletivo', '', ''),
(982, 'Processo Seletivo', '', ''),
(983, 'Processo Seletivo', '', ''),
(984, 'Processo Seletivo', '', ''),
(985, 'Processo Seletivo', '', ''),
(986, 'Processo Seletivo', '', ''),
(987, 'Processo Seletivo', '', ''),
(988, 'Processo Seletivo', '', ''),
(989, 'Processo Seletivo', '', ''),
(990, 'Processo Seletivo', '', ''),
(991, 'Processo Seletivo', '', ''),
(992, 'Processo Seletivo', '', ''),
(993, 'Processo Seletivo', '', ''),
(994, 'Processo Seletivo', '', ''),
(995, 'Processo Seletivo', '', ''),
(996, 'Processo Seletivo', '', ''),
(997, 'Processo Seletivo', '', ''),
(998, 'Processo Seletivo', '', ''),
(999, 'Processo Seletivo', '', ''),
(1000, 'Processo Seletivo', '', ''),
(1001, 'Processo Seletivo', '', ''),
(1002, 'Processo Seletivo', '', ''),
(1003, 'Processo Seletivo', '', ''),
(1004, 'Processo Seletivo', '', ''),
(1005, 'Processo Seletivo', '', ''),
(1006, 'Processo Seletivo', '', ''),
(1007, 'Processo Seletivo', '', ''),
(1008, 'Processo Seletivo', '', ''),
(1009, 'Processo Seletivo', '', ''),
(1010, 'Processo Seletivo', '', ''),
(1011, 'Processo Seletivo', '', ''),
(1012, 'Processo Seletivo', '', ''),
(1013, 'Processo Seletivo', '', ''),
(1014, 'Processo Seletivo', '', ''),
(1015, 'Processo Seletivo', '', ''),
(1016, 'Processo Seletivo', '', ''),
(1017, 'Processo Seletivo', '', ''),
(1018, 'Processo Seletivo', '', ''),
(1019, 'Processo Seletivo', '', ''),
(1020, 'Processo Seletivo', '', ''),
(1021, 'Processo Seletivo', '', ''),
(1022, 'Processo Seletivo', '', ''),
(1023, 'Processo Seletivo', '', ''),
(1024, 'Processo Seletivo', '', ''),
(1025, 'Processo Seletivo', '', ''),
(1026, 'Processo Seletivo', '', ''),
(1027, 'Processo Seletivo', '', ''),
(1028, 'Processo Seletivo', '', ''),
(1029, 'Processo Seletivo', '', ''),
(1030, 'Processo Seletivo', '', ''),
(1031, 'Processo Seletivo', '', ''),
(1032, 'Processo Seletivo', '', ''),
(1033, 'Processo Seletivo', '', ''),
(1034, 'Processo Seletivo', '', ''),
(1035, 'Processo Seletivo', '', ''),
(1036, 'Processo Seletivo', '', ''),
(1037, 'Processo Seletivo', '', ''),
(1038, 'Processo Seletivo', '', ''),
(1039, 'Processo Seletivo', '', ''),
(1040, 'Processo Seletivo', '', ''),
(1041, 'Processo Seletivo', '', ''),
(1042, 'Processo Seletivo', '', ''),
(1043, 'Processo Seletivo', '', ''),
(1044, 'Processo Seletivo', '', ''),
(1045, 'Processo Seletivo', '', ''),
(1046, 'Processo Seletivo', '', ''),
(1047, 'Processo Seletivo', '', ''),
(1048, 'Processo Seletivo', '', ''),
(1049, 'Processo Seletivo', '', ''),
(1050, 'Processo Seletivo', '', ''),
(1051, 'Processo Seletivo', '', ''),
(1052, 'Processo Seletivo', '', ''),
(1053, 'Processo Seletivo', '', ''),
(1054, 'Processo Seletivo', '', ''),
(1055, 'Processo Seletivo', '', ''),
(1056, 'Processo Seletivo', '', ''),
(1057, 'Processo Seletivo', '', ''),
(1058, 'Processo Seletivo', '', ''),
(1059, 'Processo Seletivo', '', ''),
(1060, 'Processo Seletivo', '', ''),
(1061, 'Processo Seletivo', '', ''),
(1062, 'Processo Seletivo', '', ''),
(1063, 'Processo Seletivo', '', ''),
(1064, 'Processo Seletivo', '', ''),
(1065, 'Processo Seletivo', '', ''),
(1066, 'Processo Seletivo', '', ''),
(1067, 'Processo Seletivo', '', ''),
(1068, 'Processo Seletivo', '', ''),
(1069, 'Processo Seletivo', '', ''),
(1070, 'Processo Seletivo', '', ''),
(1071, 'Processo Seletivo', '', ''),
(1072, 'Processo Seletivo', '', ''),
(1073, 'Processo Seletivo', '', ''),
(1074, 'Processo Seletivo', '', ''),
(1075, 'Processo Seletivo', '', ''),
(1076, 'Processo Seletivo', '', ''),
(1077, 'Processo Seletivo', '', ''),
(1078, 'Processo Seletivo', '', ''),
(1079, 'Processo Seletivo', '', ''),
(1080, 'Processo Seletivo', '', ''),
(1081, 'Processo Seletivo', '', ''),
(1082, 'Processo Seletivo', '', ''),
(1083, 'Processo Seletivo', '', ''),
(1084, 'Processo Seletivo', '', ''),
(1085, 'Processo Seletivo', '', ''),
(1086, 'Processo Seletivo', '', ''),
(1087, 'Processo Seletivo', '', ''),
(1088, 'Processo Seletivo', '', ''),
(1089, 'Processo Seletivo', '', ''),
(1090, 'Processo Seletivo', '', ''),
(1091, 'Processo Seletivo', '', ''),
(1092, 'Processo Seletivo', '', ''),
(1093, 'Processo Seletivo', '', ''),
(1094, 'Processo Seletivo', '', ''),
(1095, 'Processo Seletivo', '', ''),
(1096, 'Processo Seletivo', '', ''),
(1097, 'Processo Seletivo', '', ''),
(1098, 'Processo Seletivo', '', ''),
(1099, 'Processo Seletivo', '', ''),
(1100, 'Processo Seletivo', '', ''),
(1101, 'Processo Seletivo', '', ''),
(1102, 'Processo Seletivo', '', ''),
(1103, 'Processo Seletivo', '', ''),
(1104, 'Processo Seletivo', '', ''),
(1105, 'Processo Seletivo', '', ''),
(1106, 'Processo Seletivo', '', ''),
(1107, 'Processo Seletivo', '', ''),
(1108, 'Processo Seletivo', '', ''),
(1109, 'Processo Seletivo', '', ''),
(1110, 'Processo Seletivo', '', ''),
(1111, 'Processo Seletivo', '', ''),
(1112, 'Processo Seletivo', '', ''),
(1113, 'Processo Seletivo', '', ''),
(1114, 'vestibular', '', ''),
(1115, 'Processo Seletivo', '', ''),
(1116, 'Processo Seletivo', '', ''),
(1117, 'Processo Seletivo', '', ''),
(1118, 'Processo Seletivo', '', ''),
(1119, 'Processo Seletivo', '', ''),
(1120, 'Processo Seletivo', '', ''),
(1121, 'Processo Seletivo', '', ''),
(1122, 'Processo Seletivo', '', ''),
(1123, 'Processo Seletivo', '', ''),
(1124, 'chamada vest', '', ''),
(1125, 'Processo Seletivo', '', ''),
(1126, 'Processo Seletivo', '', ''),
(1127, 'Processo Seletivo', '', ''),
(1128, 'Processo Seletivo', '', ''),
(1129, 'Processo Seletivo', '', ''),
(1130, 'Processo Seletivo', '', ''),
(1131, 'Processo Seletivo', '', ''),
(1132, 'Processo Seletivo', '', ''),
(1133, 'Processo Seletivo', '', ''),
(1134, 'Processo Seletivo', '', ''),
(1135, 'Processo Seletivo', '', ''),
(1136, 'Processo Seletivo', '', ''),
(1137, 'Processo Seletivo', '', ''),
(1138, 'Processo Seletivo', '', ''),
(1139, 'Processo Seletivo', '', ''),
(1140, 'Processo Seletivo', '', ''),
(1141, 'Processo Seletivo', '', ''),
(1142, 'Processo Seletivo', '', ''),
(1143, 'Processo Seletivo', '', ''),
(1144, 'Processo Seletivo', '', ''),
(1145, 'Processo Seletivo', '', ''),
(1146, 'Processo Seletivo', '', ''),
(1147, 'Processo Seletivo', '', ''),
(1148, 'Processo Seletivo', '', ''),
(1149, 'Processo Seletivo', '', ''),
(1150, 'Processo Seletivo', '', ''),
(1151, 'Processo Seletivo', '', ''),
(1152, 'Processo Seletivo', '', ''),
(1153, 'Processo Seletivo', '', ''),
(1154, 'Processo Seletivo', '', ''),
(1155, 'Processo Seletivo', '', ''),
(1156, 'Processo Seletivo', '', ''),
(1157, 'Processo Seletivo', '', ''),
(1158, 'Processo Seletivo', '', ''),
(1159, 'Processo Seletivo', '', ''),
(1160, 'Processo Seletivo', '', ''),
(1161, 'Processo Seletivo', '', ''),
(1162, 'Processo Seletivo', '', ''),
(1163, 'Processo Seletivo', '', ''),
(1164, 'Processo Seletivo', '', ''),
(1165, 'Processo Seletivo', '', ''),
(1166, 'Processo Seletivo', '', ''),
(1167, 'Processo Seletivo', '', ''),
(1168, 'Processo Seletivo', '', ''),
(1169, 'Processo Seletivo', '', ''),
(1170, 'Processo Seletivo', '', ''),
(1171, 'Processo Seletivo', '', ''),
(1172, 'Processo Seletivo', '', ''),
(1173, 'Processo Seletivo', '', ''),
(1174, 'Processo Seletivo', '', ''),
(1175, 'Processo Seletivo', '', ''),
(1176, 'Processo Seletivo', '', ''),
(1177, 'Processo Seletivo', '', ''),
(1178, 'Processo Seletivo', '', ''),
(1179, 'Processo Seletivo', '', ''),
(1180, 'Processo Seletivo', '', ''),
(1181, 'Processo Seletivo', '', ''),
(1182, 'Processo Seletivo', '', ''),
(1183, 'Processo Seletivo', '', ''),
(1184, 'Processo Seletivo', '', ''),
(1185, 'Processo Seletivo', '', ''),
(1186, 'Processo Seletivo', '', ''),
(1187, 'Processo Seletivo', '', ''),
(1188, 'Processo Seletivo', '', ''),
(1189, 'Processo Seletivo', '', ''),
(1190, 'Processo Seletivo', '', ''),
(1191, 'Processo Seletivo', '', ''),
(1192, 'Processo Seletivo', '', ''),
(1193, 'Processo Seletivo', '', ''),
(1194, 'Processo Seletivo', '', ''),
(1195, 'Processo Seletivo', '', ''),
(1196, 'Processo Seletivo', '', ''),
(1197, 'Processo Seletivo', '', ''),
(1198, 'Processo Seletivo', '', ''),
(1199, 'Processo Seletivo', '', ''),
(1200, 'Processo Seletivo', '', ''),
(1201, 'Processo Seletivo', '', ''),
(1202, 'Processo Seletivo', '', ''),
(1203, 'Processo Seletivo', '', ''),
(1204, 'Processo Seletivo', '', ''),
(1205, 'Processo Seletivo', '', ''),
(1206, 'Processo Seletivo', '', ''),
(1207, 'Processo Seletivo', '', ''),
(1208, 'Processo Seletivo', '', ''),
(1209, 'Processo Seletivo', '', ''),
(1210, 'Processo Seletivo', '', ''),
(1211, 'Processo Seletivo', '', ''),
(1212, 'Processo Seletivo', '', ''),
(1213, 'Processo Seletivo', '', ''),
(1214, 'Processo Seletivo', '', ''),
(1215, 'Processo Seletivo', '', ''),
(1216, 'Processo Seletivo', '', ''),
(1217, 'Processo Seletivo', '', ''),
(1218, 'Processo Seletivo', '', ''),
(1219, 'Processo Seletivo', '', ''),
(1220, 'Processo Seletivo', '', ''),
(1221, 'Processo Seletivo', '', ''),
(1222, 'Processo Seletivo', '', ''),
(1223, 'Processo Seletivo', '', ''),
(1224, 'Processo Seletivo', '', ''),
(1225, 'Processo Seletivo', '', ''),
(1226, 'Processo Seletivo', '', ''),
(1227, 'ano', '', ''),
(1228, 'semestre', '', ''),
(1229, 'data_vestibular', '', ''),
(1230, 'tipo', '', ''),
(1231, 'data_realização', '', ''),
(1232, 'Processo Seletivo', '', ''),
(1233, 'Processo Seletivo', '', ''),
(1234, 'Processo Seletivo', '', ''),
(1235, 'lista_vestibular', '', ''),
(1236, 'add_vestibular', '', ''),
(1237, 'editar', '', ''),
(1238, 'deletar', '', ''),
(1239, 'Processo Seletivo', '', ''),
(1240, 'Processo Seletivo', '', ''),
(1241, 'Processo Seletivo', '', ''),
(1242, 'Processo Seletivo', '', ''),
(1243, 'Processo Seletivo', '', ''),
(1244, 'Processo Seletivo', '', ''),
(1245, 'Processo Seletivo', '', ''),
(1246, 'Processo Seletivo', '', ''),
(1247, 'Processo Seletivo', '', ''),
(1248, 'Processo Seletivo', '', ''),
(1249, 'Processo Seletivo', '', ''),
(1250, 'Processo Seletivo', '', ''),
(1251, 'Processo Seletivo', '', ''),
(1252, 'Processo Seletivo', '', ''),
(1253, 'Processo Seletivo', '', ''),
(1254, 'Processo Seletivo', '', ''),
(1255, 'Processo Seletivo', '', ''),
(1256, 'Processo Seletivo', '', ''),
(1257, 'Processo Seletivo', '', ''),
(1258, 'Processo Seletivo', '', ''),
(1259, 'Processo Seletivo', '', ''),
(1260, 'Processo Seletivo', '', ''),
(1261, 'Processo Seletivo', '', ''),
(1262, 'Processo Seletivo', '', ''),
(1263, 'Processo Seletivo', '', ''),
(1264, 'Processo Seletivo', '', ''),
(1265, 'Processo Seletivo', '', ''),
(1266, 'Processo Seletivo', '', ''),
(1267, 'Processo Seletivo', '', ''),
(1268, 'Processo Seletivo', '', ''),
(1269, 'Processo Seletivo', '', ''),
(1270, 'Processo Seletivo', '', ''),
(1271, 'Processo Seletivo', '', ''),
(1272, 'Processo Seletivo', '', ''),
(1273, 'Processo Seletivo', '', ''),
(1274, 'Processo Seletivo', '', ''),
(1275, 'Processo Seletivo', '', ''),
(1276, 'Processo Seletivo', '', ''),
(1277, 'Processo Seletivo', '', ''),
(1278, 'Processo Seletivo', '', ''),
(1279, 'Processo Seletivo', '', ''),
(1280, 'Processo Seletivo', '', ''),
(1281, 'Processo Seletivo', '', ''),
(1282, 'Processo Seletivo', '', ''),
(1283, 'Processo Seletivo', '', ''),
(1284, 'Processo Seletivo', '', ''),
(1285, 'Processo Seletivo', '', ''),
(1286, 'Processo Seletivo', '', ''),
(1287, 'Processo Seletivo', '', ''),
(1288, 'Processo Seletivo', '', ''),
(1289, 'Processo Seletivo', '', ''),
(1290, 'Processo Seletivo', '', ''),
(1291, 'Processo Seletivo', '', ''),
(1292, 'Processo Seletivo', '', ''),
(1293, 'Processo Seletivo', '', ''),
(1294, 'Processo Seletivo', '', ''),
(1295, 'Processo Seletivo', '', ''),
(1296, 'Processo Seletivo', '', ''),
(1297, 'Processo Seletivo', '', ''),
(1298, 'Processo Seletivo', '', ''),
(1299, 'Processo Seletivo', '', ''),
(1300, 'Processo Seletivo', '', ''),
(1301, 'Processo Seletivo', '', ''),
(1302, 'Processo Seletivo', '', ''),
(1303, 'Processo Seletivo', '', ''),
(1304, 'Processo Seletivo', '', ''),
(1305, 'Processo Seletivo', '', ''),
(1306, 'Processo Seletivo', '', ''),
(1307, 'Processo Seletivo', '', ''),
(1308, 'Processo Seletivo', '', ''),
(1309, 'Processo Seletivo', '', ''),
(1310, 'Processo Seletivo', '', ''),
(1311, 'Processo Seletivo', '', ''),
(1312, 'Processo Seletivo', '', ''),
(1313, 'Processo Seletivo', '', ''),
(1314, 'Processo Seletivo', '', ''),
(1315, 'Processo Seletivo', '', ''),
(1316, 'Processo Seletivo', '', ''),
(1317, 'Processo Seletivo', '', ''),
(1318, 'Processo Seletivo', '', ''),
(1319, 'Processo Seletivo', '', ''),
(1320, 'Processo Seletivo', '', ''),
(1321, 'Processo Seletivo', '', ''),
(1322, 'Processo Seletivo', '', ''),
(1323, 'Processo Seletivo', '', ''),
(1324, 'Processo Seletivo', '', ''),
(1325, 'Processo Seletivo', '', ''),
(1326, 'Processo Seletivo', '', ''),
(1327, 'Processo Seletivo', '', ''),
(1328, 'Processo Seletivo', '', ''),
(1329, 'Processo Seletivo', '', ''),
(1330, 'Processo Seletivo', '', ''),
(1331, 'Ano', '', ''),
(1332, 'Ano', '', ''),
(1333, 'Ano', '', ''),
(1334, 'Ano', '', ''),
(1335, 'Ano', '', ''),
(1336, 'Ano', '', ''),
(1337, 'Ano', '', ''),
(1338, 'Ano', '', ''),
(1339, 'Ano', '', ''),
(1340, 'Ano', '', ''),
(1341, 'Ano', '', ''),
(1342, 'Semestre', '', ''),
(1343, 'Ano', '', ''),
(1344, 'Semestre', '', ''),
(1345, 'I Semestre', '', ''),
(1346, 'II Semestre', '', ''),
(1347, 'Ano', '', ''),
(1348, 'Semestre', '', ''),
(1349, 'Ano', '', ''),
(1350, 'Semestre', '', ''),
(1351, 'Tipo', '', ''),
(1352, 'Macro', '', ''),
(1353, 'Agendado', '', ''),
(1354, 'Ano', '', ''),
(1355, 'Semestre', '', ''),
(1356, 'Tipo', '', ''),
(1357, 'Ano', '', ''),
(1358, 'Semestre', '', ''),
(1359, 'Tipo', '', ''),
(1360, 'Data Inscrição', '', ''),
(1361, 'Ano', '', ''),
(1362, 'Semestre', '', ''),
(1363, 'Tipo', '', ''),
(1364, 'Ano', '', ''),
(1365, 'Semestre', '', ''),
(1366, 'Tipo', '', ''),
(1367, 'Ano', '', ''),
(1368, 'Semestre', '', ''),
(1369, 'Tipo', '', ''),
(1370, 'Ano', '', ''),
(1371, 'Semestre', '', ''),
(1372, 'Tipo', '', ''),
(1373, 'data_inscrição', '', ''),
(1374, 'data_encerramento', '', ''),
(1375, 'Ano', '', ''),
(1376, 'Semestre', '', ''),
(1377, 'Tipo', '', ''),
(1378, 'Ano', '', ''),
(1379, 'Semestre', '', ''),
(1380, 'Tipo', '', ''),
(1381, 'Ano', '', ''),
(1382, 'Semestre', '', ''),
(1383, 'Tipo', '', ''),
(1384, 'Ano', '', ''),
(1385, 'Semestre', '', ''),
(1386, 'Tipo', '', ''),
(1387, 'Ano', '', ''),
(1388, 'Semestre', '', ''),
(1389, 'Tipo', '', ''),
(1390, 'Ano', '', ''),
(1391, 'Semestre', '', ''),
(1392, 'Tipo', '', ''),
(1393, 'Ano', '', ''),
(1394, 'Semestre', '', ''),
(1395, 'Tipo', '', ''),
(1396, 'Ano', '', ''),
(1397, 'Semestre', '', ''),
(1398, 'Tipo', '', ''),
(1399, 'Ano', '', ''),
(1400, 'Semestre', '', ''),
(1401, 'Tipo', '', ''),
(1402, 'Ano', '', ''),
(1403, 'Ano', '', ''),
(1404, 'Semestre', '', ''),
(1405, 'Tipo', '', ''),
(1406, 'Ano', '', ''),
(1407, 'Semestre', '', ''),
(1408, 'Tipo', '', ''),
(1409, 'Ano', '', ''),
(1410, 'Semestre', '', ''),
(1411, 'Tipo', '', ''),
(1412, 'data_resultado', '', ''),
(1413, 'Ano', '', ''),
(1414, 'Semestre', '', ''),
(1415, 'Tipo', '', ''),
(1416, 'Processo Seletivo', '', ''),
(1417, 'Processo Seletivo', '', ''),
(1418, 'Processo Seletivo', '', ''),
(1419, 'Processo Seletivo', '', ''),
(1420, 'Processo Seletivo', '', ''),
(1421, 'Processo Seletivo', '', ''),
(1422, 'Processo Seletivo', '', ''),
(1423, 'Processo Seletivo', '', ''),
(1424, 'Processo Seletivo', '', ''),
(1425, 'Processo Seletivo', '', ''),
(1426, 'Processo Seletivo', '', ''),
(1427, 'Processo Seletivo', '', ''),
(1428, 'Processo Seletivo', '', ''),
(1429, 'Processo Seletivo', '', ''),
(1430, 'Processo Seletivo', '', ''),
(1431, 'Processo Seletivo', '', ''),
(1432, 'Processo Seletivo', '', ''),
(1433, 'Processo Seletivo', '', ''),
(1434, 'Processo Seletivo', '', ''),
(1435, 'Processo Seletivo', '', ''),
(1436, 'Processo Seletivo', '', ''),
(1437, 'Processo Seletivo', '', ''),
(1438, 'Processo Seletivo', '', ''),
(1439, 'Processo Seletivo', '', ''),
(1440, 'Processo Seletivo', '', ''),
(1441, 'Processo Seletivo', '', ''),
(1442, 'Processo Seletivo', '', ''),
(1443, 'Processo Seletivo', '', ''),
(1444, 'Processo Seletivo', '', ''),
(1445, 'Processo Seletivo', '', ''),
(1446, 'Processo Seletivo', '', ''),
(1447, 'Processo Seletivo', '', ''),
(1448, 'Processo Seletivo', '', ''),
(1449, 'Processo Seletivo', '', ''),
(1450, 'Processo Seletivo', '', ''),
(1451, 'Processo Seletivo', '', ''),
(1452, 'Processo Seletivo', '', ''),
(1453, 'gerenciar_candidato', '', ''),
(1454, 'Processo Seletivo', '', ''),
(1455, 'Processo Seletivo', '', ''),
(1456, 'Processo Seletivo', '', ''),
(1457, 'Processo Seletivo', '', ''),
(1458, 'Processo Seletivo', '', ''),
(1459, 'Processo Seletivo', '', ''),
(1460, 'Processo Seletivo', '', ''),
(1461, 'lista_candidato', '', ''),
(1462, 'Processo Seletivo', '', ''),
(1463, 'Processo Seletivo', '', ''),
(1464, 'Processo Seletivo', '', ''),
(1465, 'Processo Seletivo', '', ''),
(1466, 'Processo Seletivo', '', ''),
(1467, 'Processo Seletivo', '', ''),
(1468, 'nome', '', ''),
(1469, 'Processo Seletivo', '', ''),
(1470, 'Processo Seletivo', '', ''),
(1471, 'Processo Seletivo', '', ''),
(1472, 'Processo Seletivo', '', ''),
(1473, 'Processo Seletivo', '', ''),
(1474, 'Processo Seletivo', '', ''),
(1475, 'Processo Seletivo', '', ''),
(1476, 'Processo Seletivo', '', ''),
(1477, 'Processo Seletivo', '', ''),
(1478, 'Ano', '', ''),
(1479, 'Semestre', '', ''),
(1480, 'Tipo', '', ''),
(1481, 'Processo Seletivo', '', ''),
(1482, 'Processo Seletivo', '', ''),
(1483, 'Processo Seletivo', '', ''),
(1484, 'sexo', '', ''),
(1485, 'CPF', '', ''),
(1486, 'Processo Seletivo', '', ''),
(1487, 'Processo Seletivo', '', ''),
(1488, 'Processo Seletivo', '', ''),
(1489, 'Processo Seletivo', '', ''),
(1490, 'Processo Seletivo', '', ''),
(1491, 'Processo Seletivo', '', ''),
(1492, 'Processo Seletivo', '', ''),
(1493, 'Processo Seletivo', '', ''),
(1494, 'Processo Seletivo', '', ''),
(1495, 'Processo Seletivo', '', ''),
(1496, 'Processo Seletivo', '', ''),
(1497, 'Processo Seletivo', '', ''),
(1498, 'Processo Seletivo', '', ''),
(1499, 'Processo Seletivo', '', ''),
(1500, 'Processo Seletivo', '', ''),
(1501, 'nomeADSDADADADA', '', ''),
(1502, 'nome_candidato', '', ''),
(1503, 'RG', '', ''),
(1504, 'Telefone', '', ''),
(1505, 'Processo Seletivo', '', ''),
(1506, 'Processo Seletivo', '', ''),
(1507, 'Processo Seletivo', '', ''),
(1508, 'Processo Seletivo', '', ''),
(1509, 'Processo Seletivo', '', ''),
(1510, 'Processo Seletivo', '', ''),
(1511, 'telefone', '', ''),
(1512, 'telefone', '', ''),
(1513, 'telefone', '', ''),
(1514, 'telefone', '', ''),
(1515, 'telefone', '', ''),
(1516, 'telefone', '', ''),
(1517, 'telefone', '', ''),
(1518, 'telefone', '', ''),
(1519, 'telefone', '', ''),
(1520, 'telefone', '', ''),
(1521, 'telefone', '', ''),
(1522, 'telefone', '', ''),
(1523, 'telefone', '', ''),
(1524, 'telefone', '', ''),
(1525, 'telefone', '', ''),
(1526, 'telefone', '', ''),
(1527, 'telefone', '', ''),
(1528, 'telefone', '', ''),
(1529, 'telefone', '', ''),
(5189, 'cpf', '', ''),
(5188, 'cpf', '', ''),
(5187, 'CADASTRO DE DADOS DA TURMA', '', ''),
(5186, 'cpf', '', ''),
(5185, 'CADASTRO DE DADOS ALUNO', '', ''),
(5184, 'cpf', '', ''),
(5183, '1', '', ''),
(5182, 'cpf', '', ''),
(5181, '1 ETAPA', '', ''),
(5180, 'cpf', '', ''),
(5179, 'Etapa1', '', ''),
(5178, 'cpf', '', ''),
(5177, 'cpf', '', ''),
(5176, 'cpf', '', ''),
(5175, 'cpf', '', ''),
(5174, 'avançar', '', ''),
(5173, 'cpf', '', ''),
(5172, 'cpf', '', ''),
(5171, 'cpf', '', ''),
(5170, 'cpf', '', ''),
(5169, 'cpf', '', ''),
(5168, 'cpf', '', ''),
(5167, 'cpf', '', ''),
(5166, 'cpf', '', ''),
(5165, 'cpf', '', ''),
(5164, 'cpf', '', ''),
(5163, 'cpf', '', ''),
(5162, 'cpf', '', ''),
(5161, 'cpf', '', ''),
(5160, 'opções', '', ''),
(5159, 'cpf', '', ''),
(5158, 'cpf', '', ''),
(5157, 'cpf', '', ''),
(5156, 'cpf', '', ''),
(5155, 'cpf', '', ''),
(5154, 'cpf', '', ''),
(5153, 'cpf', '', ''),
(5152, 'cpf', '', ''),
(5151, 'cpf', '', ''),
(5150, 'aluno_cadastro_com_sucesso', '', ''),
(5149, 'cpf', '', ''),
(5148, 'cpf', '', ''),
(5147, 'cpf', '', ''),
(5146, 'cpf', '', ''),
(5145, 'cpf', '', ''),
(5143, 'cpf', '', ''),
(5144, 'cpf', '', ''),
(5141, 'cpf', '', ''),
(5142, 'cpf', '', ''),
(5139, 'cpf', '', ''),
(5140, 'cpf', '', ''),
(5137, 'cpf', '', ''),
(5138, 'cpf', '', ''),
(5135, 'cpf', '', ''),
(5136, 'cpf', '', ''),
(5133, 'cpf', '', ''),
(5134, 'cpf', '', ''),
(5131, 'criar_aluno', '', ''),
(5132, 'cpf', '', ''),
(5130, 'cpf', '', ''),
(5129, 'cpf', '', ''),
(5128, 'situação_período', '', ''),
(5125, 'Opções', '', ''),
(5126, 'data_inicio', '', ''),
(5127, 'data_previsão_termino', '', ''),
(5124, 'dias_letivo', '', ''),
(5123, 'peridodo_letivo.', '', ''),
(5122, 'nova_etapa', '', ''),
(5121, 'lista_etapa', '', ''),
(5120, 'cpf', '', ''),
(5117, 'cpf', '', ''),
(5118, 'cpf', '', ''),
(5119, 'painel_financeiro', '', ''),
(5114, 'cpf', '', ''),
(5115, 'teste', '', ''),
(5116, '<a href="index.php?admin/dashboard">Painel Geral</a> > <a href="index.php?admin/educacional">Painel_educacional </a><b>></b> <a href="">Gerenciar_bolsas</a>', '', ''),
(5113, 'cpf', '', ''),
(5112, 'cpf', '', ''),
(5111, 'cpf', '', ''),
(5107, 'cpf', '', ''),
(5108, 'cpf', '', ''),
(5109, 'cpf', '', ''),
(5110, 'cpf', '', ''),
(5106, 'cpf', '', ''),
(5105, 'cpf', '', ''),
(5104, 'cpf', '', ''),
(5103, 'cpf', '', ''),
(5102, 'cpf', '', ''),
(5101, 'cpf', '', ''),
(5096, 'cpf', '', ''),
(5097, 'cpf', '', ''),
(5098, 'cpf', '', ''),
(5099, 'cpf', '', ''),
(5100, 'cpf', '', ''),
(5095, 'cpf', '', ''),
(5094, 'cpf', '', ''),
(5093, 'cpf', '', ''),
(5092, 'cpf', '', ''),
(5091, 'cpf', '', ''),
(5090, 'cpf', '', ''),
(5089, 'cpf', '', ''),
(5088, 'cpf', '', ''),
(5087, 'cpf', '', ''),
(5086, 'cpf', '', ''),
(5085, 'cpf', '', ''),
(5084, 'cpf', '', ''),
(5083, 'cpf', '', ''),
(5082, 'cpf', '', ''),
(5081, 'cpf', '', ''),
(5080, 'cpf', '', ''),
(5079, 'cpf', '', ''),
(5078, 'cpf', '', ''),
(5077, 'cpf', '', ''),
(5076, 'cpf', '', ''),
(5075, 'curso', '', ''),
(5074, 'cpf', '', ''),
(2020, 'Processo Seletivo', '', ''),
(2021, 'descrição', '', ''),
(2022, 'porcentagem_mínima', '', ''),
(2023, 'porcentagem_máxima', '', ''),
(2024, 'Processo Seletivo', '', ''),
(2025, 'Processo Seletivo', '', ''),
(2026, 'Processo Seletivo', '', ''),
(2027, 'Processo Seletivo', '', ''),
(2028, 'Processo Seletivo', '', ''),
(2029, 'Processo Seletivo', '', ''),
(2030, 'descricao', '', ''),
(2031, 'add_bolsa', '', ''),
(2032, 'bolsa_cadastrada_com_sucesso', '', ''),
(2033, 'Processo Seletivo', '', ''),
(2034, 'Processo Seletivo', '', ''),
(2035, 'Processo Seletivo', '', ''),
(2036, 'Processo Seletivo', '', ''),
(2037, 'Processo Seletivo', '', ''),
(2038, 'Processo Seletivo', '', ''),
(2039, 'Processo Seletivo', '', ''),
(2040, 'Processo Seletivo', '', ''),
(2041, 'Processo Seletivo', '', ''),
(2042, 'Processo Seletivo', '', ''),
(2043, 'Processo Seletivo', '', ''),
(2044, 'Processo Seletivo', '', ''),
(2045, 'Processo Seletivo', '', ''),
(2046, 'Processo Seletivo', '', ''),
(2047, 'Processo Seletivo', '', ''),
(2048, 'Processo Seletivo', '', ''),
(2049, 'Processo Seletivo', '', ''),
(2050, 'Processo Seletivo', '', ''),
(2051, 'Processo Seletivo', '', ''),
(2052, 'Processo Seletivo', '', ''),
(2053, 'Processo Seletivo', '', ''),
(2054, 'Processo Seletivo', '', ''),
(2055, 'Processo Seletivo', '', ''),
(2056, 'Processo Seletivo', '', ''),
(2057, 'Processo Seletivo', '', ''),
(2058, 'Processo Seletivo', '', ''),
(2059, 'Processo Seletivo', '', ''),
(2060, 'deletard', '', ''),
(2061, 'Processo Seletivo', '', ''),
(2062, 'Processo Seletivo', '', ''),
(2063, 'Processo Seletivo', '', ''),
(2064, 'Processo Seletivo', '', ''),
(2065, 'Processo Seletivo', '', ''),
(2066, 'Processo Seletivo', '', ''),
(2067, 'Processo Seletivo', '', ''),
(2068, 'Processo Seletivo', '', ''),
(2069, 'Ano', '', ''),
(2070, 'Semestre', '', ''),
(2071, 'Tipo', '', ''),
(2072, 'Processo Seletivo', '', ''),
(2073, 'Processo Seletivo', '', ''),
(2074, 'Processo Seletivo', '', ''),
(2075, 'Processo Seletivo', '', ''),
(2076, 'Processo Seletivo', '', ''),
(2077, 'Processo Seletivo', '', ''),
(2078, 'bolsa_deletada_com_sucesso', '', ''),
(2079, 'Processo Seletivo', '', ''),
(2080, 'Processo Seletivo', '', ''),
(2081, 'Processo Seletivo', '', ''),
(2082, 'Processo Seletivo', '', ''),
(2083, 'Processo Seletivo', '', ''),
(2084, 'Processo Seletivo', '', ''),
(2085, 'Processo Seletivo', '', ''),
(2086, 'Processo Seletivo', '', ''),
(2087, 'periodo_letivo', '', ''),
(2088, 'Processo Seletivo', '', ''),
(2089, 'Processo Seletivo', '', ''),
(2090, 'Processo Seletivo', '', ''),
(2091, 'Processo Seletivo', '', ''),
(2092, 'Processo Seletivo', '', ''),
(2093, 'Processo Seletivo', '', ''),
(2094, 'Processo Seletivo', '', ''),
(2095, 'Processo Seletivo', '', ''),
(2096, 'Processo Seletivo', '', ''),
(2097, 'Processo Seletivo', '', ''),
(2098, 'Processo Seletivo', '', ''),
(2099, 'Processo Seletivo', '', ''),
(2100, 'Processo Seletivo', '', ''),
(2101, 'Processo Seletivo', '', ''),
(2102, 'Processo Seletivo', '', ''),
(2103, 'Processo Seletivo', '', ''),
(2104, 'Processo Seletivo', '', ''),
(2105, 'Processo Seletivo', '', ''),
(2106, 'Processo Seletivo', '', ''),
(2107, 'Processo Seletivo', '', ''),
(2108, '<a href="index.php?admin/dashboard">Painel Geral</a> > <a href="index.php?admin/educacional">Painel_educacional </a><b>></b> <a href="">Gerenciar_cursos</a>', '', ''),
(2109, 'Processo Seletivo', '', ''),
(2110, 'Processo Seletivo', '', ''),
(2111, 'Processo Seletivo', '', ''),
(2112, 'Processo Seletivo', '', ''),
(2113, 'Processo Seletivo', '', ''),
(2114, 'Processo Seletivo', '', ''),
(2115, 'Processo Seletivo', '', ''),
(2116, 'Processo Seletivo', '', ''),
(2117, 'Processo Seletivo', '', ''),
(2118, 'Processo Seletivo', '', ''),
(2119, 'Processo Seletivo', '', ''),
(2120, 'Processo Seletivo', '', ''),
(2121, 'lista_cursos', '', ''),
(2122, 'novo curso', '', ''),
(2123, 'Nome do Curso', '', ''),
(2124, 'Nome Abrev. do Curso', '', ''),
(2125, 'coordenador(a)', '', ''),
(2126, 'duracao_do_curso_(semestre(s))', '', ''),
(2127, 'horas_de_atividade_complementares_obrigatorias', '', ''),
(2128, 'horas_de_estagio_obrigatoria', '', ''),
(2129, 'valor_do_curso', '', ''),
(2130, 'habilitacao_do_curso', '', ''),
(2131, 'Processo Seletivo', '', ''),
(2132, 'Processo Seletivo', '', ''),
(2133, 'Processo Seletivo', '', ''),
(2134, 'add_curso', '', ''),
(2135, 'criar_curso', '', ''),
(2136, 'Processo Seletivo', '', ''),
(2137, 'habilita', '', ''),
(2138, 'horas_de_estagio_obrigatorio', '', ''),
(2139, 'horas_de_atividade_complementares_obrigatorio', '', ''),
(2140, 'curso_cadastrado_com_sucesso', '', ''),
(2141, 'Abrev.', '', ''),
(2142, 'Curso', '', ''),
(2143, 'Habilitacao', '', ''),
(2144, 'Coordenador', '', ''),
(2145, 'Valor', '', ''),
(2146, 'op', '', ''),
(2147, 'op', '', ''),
(2148, 'op', '', ''),
(2149, 'op', '', ''),
(2150, 'op', '', ''),
(2151, 'op', '', ''),
(2152, 'op', '', ''),
(2153, 'curso_deletado_com_sucesso', '', ''),
(2154, 'op', '', ''),
(2155, 'Processo Seletivo', '', ''),
(2156, 'Processo Seletivo', '', ''),
(2157, 'Processo Seletivo', '', ''),
(2158, 'telefone', '', ''),
(2159, 'Processo Seletivo', '', ''),
(2160, 'Processo Seletivo', '', ''),
(2161, 'Processo Seletivo', '', ''),
(2162, 'Ano', '', ''),
(2163, 'Semestre', '', ''),
(2164, 'Tipo', '', ''),
(2165, 'Processo Seletivo', '', ''),
(2166, 'Processo Seletivo', '', ''),
(2167, 'Processo Seletivo', '', ''),
(2168, 'op', '', ''),
(2169, 'op', '', ''),
(2170, 'op', '', ''),
(2171, 'op', '', ''),
(2172, 'op', '', ''),
(2173, 'op', '', ''),
(2174, 'op', '', ''),
(2175, 'op', '', ''),
(2176, 'op', '', ''),
(2177, 'op', '', ''),
(2178, 'op', '', ''),
(2179, 'op', '', ''),
(2180, 'op', '', ''),
(2181, 'Processo Seletivo', '', ''),
(2182, 'Processo Seletivo', '', ''),
(2183, 'Processo Seletivo', '', ''),
(2184, 'op', '', ''),
(2185, 'op', '', ''),
(2186, 'op', '', ''),
(2187, 'op', '', ''),
(2188, 'op', '', ''),
(2189, 'op', '', ''),
(2190, 'editar_curso', '', ''),
(2191, 'op', '', ''),
(2192, 'op', '', ''),
(2193, 'Processo Seletivo', '', ''),
(2194, 'Processo Seletivo', '', ''),
(2195, 'Processo Seletivo', '', ''),
(2196, 'op', '', ''),
(2197, 'op', '', ''),
(2198, 'op', '', ''),
(2199, 'op', '', ''),
(2200, 'Processo Seletivo', '', ''),
(2201, 'opções', '', ''),
(2202, 'Habilitação', '', ''),
(2203, 'Opções', '', ''),
(2204, 'Habilitação', '', ''),
(2205, 'Opções', '', ''),
(2206, 'Processo Seletivo', '', ''),
(2207, 'Processo Seletivo', '', ''),
(2208, 'Processo Seletivo', '', ''),
(2209, 'Processo Seletivo', '', ''),
(2210, 'Processo Seletivo', '', ''),
(2211, 'Habilitação', '', ''),
(2212, 'Opções', '', ''),
(2213, 'Processo Seletivo', '', ''),
(2214, 'Processo Seletivo', '', ''),
(2215, 'Processo Seletivo', '', ''),
(2216, 'Processo Seletivo', '', ''),
(2217, 'Processo Seletivo', '', ''),
(2218, 'Processo Seletivo', '', ''),
(2219, 'Processo Seletivo', '', ''),
(2220, 'Processo Seletivo', '', ''),
(2221, 'Processo Seletivo', '', ''),
(2222, 'Processo Seletivo', '', ''),
(2223, 'Processo Seletivo', '', ''),
(2224, 'Habilitação', '', ''),
(2225, 'Opções', '', ''),
(2226, 'Habilitação', '', ''),
(2227, 'Opções', '', ''),
(2228, 'Processo Seletivo', '', ''),
(2229, 'Processo Seletivo', '', ''),
(2230, 'Processo Seletivo', '', ''),
(2231, 'Habilitação', '', ''),
(2232, 'Opções', '', ''),
(2233, 'Habilitação', '', ''),
(2234, 'Opções', '', ''),
(2235, 'Habilitação', '', ''),
(2236, 'Opções', '', ''),
(2237, 'Habilitação', '', ''),
(2238, 'Opções', '', ''),
(2239, 'Habilitação', '', ''),
(2240, 'Opções', '', ''),
(2241, 'Habilitação', '', ''),
(2242, 'Opções', '', ''),
(2243, 'Habilitação', '', ''),
(2244, 'Opções', '', ''),
(2245, 'Habilitação', '', ''),
(2246, 'Opções', '', ''),
(2247, 'Habilitação', '', ''),
(2248, 'Opções', '', ''),
(2249, 'Habilitação', '', ''),
(2250, 'Opções', '', ''),
(2251, 'Habilitação', '', ''),
(2252, 'Opções', '', ''),
(2253, 'Duração', '', ''),
(2254, 'Opções', '', ''),
(2255, 'Opções', '', ''),
(2256, 'Opções', '', ''),
(2257, 'Opções', '', ''),
(2258, 'Processo Seletivo', '', ''),
(2259, 'Opções', '', ''),
(2260, 'Processo Seletivo', '', ''),
(2261, 'Processo Seletivo', '', ''),
(2262, 'Processo Seletivo', '', ''),
(2263, 'Opções', '', ''),
(2264, 'Processo Seletivo', '', ''),
(2265, 'Processo Seletivo', '', ''),
(2266, 'Processo Seletivo', '', ''),
(2267, 'matriz', '', ''),
(2268, 'Processo Seletivo', '', ''),
(2269, '<a href="index.php?admin/dashboard">Painel Geral</a> > <a href="index.php?admin/educacional">Painel_educacional </a><b>></b> <a href="">Gerenciar_matrizes</a>', '', ''),
(2270, 'Opções', '', ''),
(2271, '<a href="index.php?admin/dashboard">Painel Geral</a> > <a href="index.php?admin/educacional">Painel_educacional </a><b>></b> <a href="">Gerenciar_matriz_curricular</a>', '', ''),
(2272, 'Opções', '', ''),
(2273, 'lista_matrizes', '', ''),
(2274, 'nova matriz', '', ''),
(2275, 'Opções', '', ''),
(2276, 'Opções', '', ''),
(2277, 'Opções', '', ''),
(2278, 'Processo Seletivo', '', ''),
(2279, 'Processo Seletivo', '', ''),
(2280, 'Processo Seletivo', '', ''),
(2281, 'Opções', '', ''),
(2282, 'Opções', '', ''),
(2283, 'criar_matriz', '', ''),
(2284, 'Opções', '', ''),
(2285, 'ANO', '', ''),
(2286, 'Semestre', '', ''),
(2287, 'Opções', '', ''),
(2288, 'Ano', '', ''),
(2289, 'Semestre', '', ''),
(2290, 'Opções', '', ''),
(2291, 'Ano', '', ''),
(2292, 'Semestre', '', ''),
(2293, 'Opções', '', ''),
(2294, 'Ano', '', ''),
(2295, 'Semestre', '', ''),
(2296, 'Opções', '', ''),
(2297, 'Ano', '', ''),
(2298, 'Semestre', '', ''),
(2299, 'Opções', '', ''),
(2300, 'Ano', '', ''),
(2301, 'Semestre', '', ''),
(2302, 'Processo Seletivo', '', ''),
(2303, 'Processo Seletivo', '', ''),
(2304, 'Processo Seletivo', '', ''),
(2305, 'Opções', '', ''),
(2306, 'Opções', '', ''),
(2307, 'Opções', '', ''),
(2308, 'Opções', '', ''),
(2309, 'Processo Seletivo', '', ''),
(2310, 'Processo Seletivo', '', ''),
(2311, 'Processo Seletivo', '', ''),
(2312, 'Opções', '', ''),
(2313, 'Ano', '', ''),
(2314, 'Semestre', '', ''),
(2315, 'Opções', '', ''),
(2316, 'Ano', '', ''),
(2317, 'Semestre', '', ''),
(2318, 'Opções', '', ''),
(2319, 'Ano', '', ''),
(2320, 'Semestre', '', ''),
(2321, 'matriz_cadastrada_com_sucesso', '', ''),
(2322, 'Opções', '', ''),
(2323, 'Ano', '', ''),
(2324, 'Semestre', '', ''),
(2325, 'Processo Seletivo', '', ''),
(2326, 'Processo Seletivo', '', ''),
(2327, 'Processo Seletivo', '', ''),
(2328, 'Ano', '', ''),
(2329, 'Semestre', '', ''),
(2330, 'Opções', '', ''),
(2331, 'Ano', '', ''),
(2332, 'Semestre', '', ''),
(2333, 'Processo Seletivo', '', ''),
(2334, 'Processo Seletivo', '', ''),
(2335, 'Processo Seletivo', '', ''),
(2336, 'Ano', '', ''),
(2337, 'Semestre', '', ''),
(2338, 'Opções', '', ''),
(2339, 'Ano', '', ''),
(2340, 'Semestre', '', ''),
(2341, 'Ano', '', ''),
(2342, 'Semestre', '', ''),
(2343, 'Opções', '', ''),
(2344, 'Ano', '', ''),
(2345, 'Semestre', '', ''),
(2346, 'Ano', '', ''),
(2347, 'Semestre', '', ''),
(2348, 'Opções', '', ''),
(2349, 'Ano', '', ''),
(2350, 'Semestre', '', ''),
(2351, 'Ano', '', ''),
(2352, 'Semestre', '', ''),
(2353, 'Opções', '', ''),
(2354, 'Ano', '', ''),
(2355, 'Semestre', '', ''),
(2356, 'Opções', '', ''),
(2357, 'Ano', '', ''),
(2358, 'Semestre', '', ''),
(2359, 'Opções', '', ''),
(2360, 'Ano', '', ''),
(2361, 'Semestre', '', ''),
(2362, 'Opções', '', ''),
(2363, 'Ano', '', ''),
(2364, 'Semestre', '', ''),
(2365, 'Opções', '', ''),
(2366, 'Ano', '', ''),
(2367, 'Semestre', '', ''),
(2368, 'Ano', '', ''),
(2369, 'Semestre', '', ''),
(2370, 'Opções', '', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `Portugues`, `Português`) VALUES
(2371, 'Ano', '', ''),
(2372, 'Semestre', '', ''),
(2373, 'Ano', '', ''),
(2374, 'Semestre', '', ''),
(2375, 'Opções', '', ''),
(2376, 'Ano', '', ''),
(2377, 'Semestre', '', ''),
(2378, 'Ano', '', ''),
(2379, 'Semestre', '', ''),
(2380, 'Opções', '', ''),
(2381, 'Ano', '', ''),
(2382, 'Semestre', '', ''),
(2383, 'Ano', '', ''),
(2384, 'Semestre', '', ''),
(2385, 'Opções', '', ''),
(2386, 'Ano', '', ''),
(2387, 'Semestre', '', ''),
(2388, 'Ano', '', ''),
(2389, 'Semestre', '', ''),
(2390, 'Opções', '', ''),
(2391, 'Ano', '', ''),
(2392, 'Semestre', '', ''),
(2393, 'Ano', '', ''),
(2394, 'Semestre', '', ''),
(2395, 'Opções', '', ''),
(2396, 'Ano', '', ''),
(2397, 'Semestre', '', ''),
(2398, 'Processo Seletivo', '', ''),
(2399, 'Processo Seletivo', '', ''),
(2400, 'Processo Seletivo', '', ''),
(2401, 'Ano', '', ''),
(2402, 'Semestre', '', ''),
(2403, 'Opções', '', ''),
(2404, 'Ano', '', ''),
(2405, 'Semestre', '', ''),
(2406, 'Ano', '', ''),
(2407, 'Semestre', '', ''),
(2408, 'Opções', '', ''),
(2409, 'Ano', '', ''),
(2410, 'Semestre', '', ''),
(2411, 'Ano', '', ''),
(2412, 'Semestre', '', ''),
(2413, 'Opções', '', ''),
(2414, 'Ano', '', ''),
(2415, 'Semestre', '', ''),
(2416, 'Ano', '', ''),
(2417, 'Semestre', '', ''),
(2418, 'Opções', '', ''),
(2419, 'Ano', '', ''),
(2420, 'Semestre', '', ''),
(2421, 'Disciplina', '', ''),
(2422, 'Carga_horaria', '', ''),
(2423, 'Crédito', '', ''),
(2424, 'Período', '', ''),
(2425, 'Ano', '', ''),
(2426, 'Semestre', '', ''),
(2427, 'Opções', '', ''),
(2428, 'Ano', '', ''),
(2429, 'Semestre', '', ''),
(2430, 'Ano', '', ''),
(2431, 'Semestre', '', ''),
(2432, 'Opções', '', ''),
(2433, 'Ano', '', ''),
(2434, 'Semestre', '', ''),
(2435, 'Carga_horaria/Crédito', '', ''),
(2436, 'Ano', '', ''),
(2437, 'Semestre', '', ''),
(2438, 'Opções', '', ''),
(2439, 'Ano', '', ''),
(2440, 'Semestre', '', ''),
(2441, 'Ano', '', ''),
(2442, 'Semestre', '', ''),
(2443, 'Opções', '', ''),
(2444, 'Ano', '', ''),
(2445, 'Semestre', '', ''),
(2446, 'Ano', '', ''),
(2447, 'Semestre', '', ''),
(2448, 'Opções', '', ''),
(2449, 'Ano', '', ''),
(2450, 'Semestre', '', ''),
(2451, 'Ano', '', ''),
(2452, 'Semestre', '', ''),
(2453, 'Opções', '', ''),
(2454, 'Ano', '', ''),
(2455, 'Semestre', '', ''),
(2456, 'Ano', '', ''),
(2457, 'Semestre', '', ''),
(2458, 'Opções', '', ''),
(2459, 'Ano', '', ''),
(2460, 'Semestre', '', ''),
(2461, 'Ano', '', ''),
(2462, 'Semestre', '', ''),
(2463, 'Opções', '', ''),
(2464, 'Ano', '', ''),
(2465, 'Semestre', '', ''),
(2466, 'Ano', '', ''),
(2467, 'Semestre', '', ''),
(2468, 'Opções', '', ''),
(2469, 'Ano', '', ''),
(2470, 'Semestre', '', ''),
(2471, 'Ano', '', ''),
(2472, 'Semestre', '', ''),
(2473, 'Opções', '', ''),
(2474, 'Ano', '', ''),
(2475, 'Semestre', '', ''),
(2476, 'Ano', '', ''),
(2477, 'Semestre', '', ''),
(2478, 'Opções', '', ''),
(2479, 'Ano', '', ''),
(2480, 'Semestre', '', ''),
(2481, 'Ano', '', ''),
(2482, 'Semestre', '', ''),
(2483, 'Opções', '', ''),
(2484, 'Ano', '', ''),
(2485, 'Semestre', '', ''),
(2486, 'Ano', '', ''),
(2487, 'Semestre', '', ''),
(2488, 'Opções', '', ''),
(2489, 'Ano', '', ''),
(2490, 'Semestre', '', ''),
(2491, 'Ano', '', ''),
(2492, 'Semestre', '', ''),
(2493, 'Opções', '', ''),
(2494, 'Ano', '', ''),
(2495, 'Semestre', '', ''),
(2496, 'adicionar_disciplina', '', ''),
(2497, 'Processo Seletivo', '', ''),
(2498, 'Processo Seletivo', '', ''),
(2499, 'Processo Seletivo', '', ''),
(2500, 'Ano', '', ''),
(2501, 'Semestre', '', ''),
(2502, 'Opções', '', ''),
(2503, 'Ano', '', ''),
(2504, 'Semestre', '', ''),
(2505, 'Cód. Disciplina', '', ''),
(2506, 'Ano', '', ''),
(2507, 'Semestre', '', ''),
(2508, 'Opções', '', ''),
(2509, 'Ano', '', ''),
(2510, 'Semestre', '', ''),
(2511, 'Ano', '', ''),
(2512, 'Semestre', '', ''),
(2513, 'Opções', '', ''),
(2514, 'Ano', '', ''),
(2515, 'Semestre', '', ''),
(2516, 'Ano', '', ''),
(2517, 'Semestre', '', ''),
(2518, 'Opções', '', ''),
(2519, 'Ano', '', ''),
(2520, 'Semestre', '', ''),
(2521, 'Ano', '', ''),
(2522, 'Semestre', '', ''),
(2523, 'Opções', '', ''),
(2524, 'Ano', '', ''),
(2525, 'Semestre', '', ''),
(2526, 'disciplina_cadastrada_com_sucesso', '', ''),
(2527, 'Ano', '', ''),
(2528, 'Semestre', '', ''),
(2529, 'Opções', '', ''),
(2530, 'Ano', '', ''),
(2531, 'Semestre', '', ''),
(2532, 'Processo Seletivo', '', ''),
(2533, 'Processo Seletivo', '', ''),
(2534, 'Processo Seletivo', '', ''),
(2535, 'Processo Seletivo', '', ''),
(2536, 'Ano', '', ''),
(2537, 'Semestre', '', ''),
(2538, 'Opções', '', ''),
(2539, 'Ano', '', ''),
(2540, 'Semestre', '', ''),
(2541, 'Ano', '', ''),
(2542, 'Semestre', '', ''),
(2543, 'Opções', '', ''),
(2544, 'Ano', '', ''),
(2545, 'Semestre', '', ''),
(2546, 'Processo Seletivo', '', ''),
(2547, 'Processo Seletivo', '', ''),
(2548, 'Processo Seletivo', '', ''),
(2549, 'Opções', '', ''),
(2550, 'Processo Seletivo', '', ''),
(2551, 'Processo Seletivo', '', ''),
(2552, 'Processo Seletivo', '', ''),
(2553, 'Ano', '', ''),
(2554, 'Semestre', '', ''),
(2555, 'Opções', '', ''),
(2556, 'Ano', '', ''),
(2557, 'Semestre', '', ''),
(2558, 'Ano', '', ''),
(2559, 'Semestre', '', ''),
(2560, 'Opções', '', ''),
(2561, 'Ano', '', ''),
(2562, 'Semestre', '', ''),
(2563, 'Ano', '', ''),
(2564, 'Semestre', '', ''),
(2565, 'Opções', '', ''),
(2566, 'Ano', '', ''),
(2567, 'Semestre', '', ''),
(2568, 'Ano', '', ''),
(2569, 'Semestre', '', ''),
(2570, 'Opções', '', ''),
(2571, 'Ano', '', ''),
(2572, 'Semestre', '', ''),
(2573, 'Ano', '', ''),
(2574, 'Semestre', '', ''),
(2575, 'Opções', '', ''),
(2576, 'Ano', '', ''),
(2577, 'Semestre', '', ''),
(2578, 'Processo Seletivo', '', ''),
(2579, 'Opções', '', ''),
(2580, 'Processo Seletivo', '', ''),
(2581, 'Ano', '', ''),
(2582, 'Semestre', '', ''),
(2583, 'Opções', '', ''),
(2584, 'Ano', '', ''),
(2585, 'Semestre', '', ''),
(2586, 'nova_disciplina', '', ''),
(2587, 'Ano', '', ''),
(2588, 'Semestre', '', ''),
(2589, 'Opções', '', ''),
(2590, 'Ano', '', ''),
(2591, 'Semestre', '', ''),
(2592, 'Ano', '', ''),
(2593, 'Semestre', '', ''),
(2594, 'Opções', '', ''),
(2595, 'Ano', '', ''),
(2596, 'Semestre', '', ''),
(2597, 'Ano', '', ''),
(2598, 'Semestre', '', ''),
(2599, 'Opções', '', ''),
(2600, 'Ano', '', ''),
(2601, 'Semestre', '', ''),
(2602, 'Ano', '', ''),
(2603, 'Semestre', '', ''),
(2604, 'Opções', '', ''),
(2605, 'Ano', '', ''),
(2606, 'Semestre', '', ''),
(2607, 'Ano', '', ''),
(2608, 'Semestre', '', ''),
(2609, 'Opções', '', ''),
(2610, 'Ano', '', ''),
(2611, 'Semestre', '', ''),
(2612, 'Ano', '', ''),
(2613, 'Semestre', '', ''),
(2614, 'Opções', '', ''),
(2615, 'Ano', '', ''),
(2616, 'Semestre', '', ''),
(2617, 'Ano', '', ''),
(2618, 'Semestre', '', ''),
(2619, 'Opções', '', ''),
(2620, 'Ano', '', ''),
(2621, 'Semestre', '', ''),
(2622, 'Processo Seletivo', '', ''),
(2623, 'Ano', '', ''),
(2624, 'Semestre', '', ''),
(2625, 'Opções', '', ''),
(2626, 'Ano', '', ''),
(2627, 'Semestre', '', ''),
(2628, 'Ano', '', ''),
(2629, 'Semestre', '', ''),
(2630, 'Opções', '', ''),
(2631, 'Ano', '', ''),
(2632, 'Semestre', '', ''),
(2633, 'Processo Seletivo', '', ''),
(2634, 'Ano', '', ''),
(2635, 'Semestre', '', ''),
(2636, 'Opções', '', ''),
(2637, 'Ano', '', ''),
(2638, 'Semestre', '', ''),
(2639, 'Ano', '', ''),
(2640, 'Semestre', '', ''),
(2641, 'Opções', '', ''),
(2642, 'Ano', '', ''),
(2643, 'Semestre', '', ''),
(2644, 'Ano', '', ''),
(2645, 'Semestre', '', ''),
(2646, 'Opções', '', ''),
(2647, 'Ano', '', ''),
(2648, 'Semestre', '', ''),
(2649, 'Processo Seletivo', '', ''),
(2650, 'Ano', '', ''),
(2651, 'Semestre', '', ''),
(2652, 'Opções', '', ''),
(2653, 'Ano', '', ''),
(2654, 'Semestre', '', ''),
(2655, 'Ano', '', ''),
(2656, 'Semestre', '', ''),
(2657, 'Opções', '', ''),
(2658, 'Ano', '', ''),
(2659, 'Semestre', '', ''),
(2660, 'Processo Seletivo', '', ''),
(2661, 'Ano', '', ''),
(2662, 'Semestre', '', ''),
(2663, 'Opções', '', ''),
(2664, 'Ano', '', ''),
(2665, 'Semestre', '', ''),
(2666, 'Ano', '', ''),
(2667, 'Semestre', '', ''),
(2668, 'Opções', '', ''),
(2669, 'Ano', '', ''),
(2670, 'Semestre', '', ''),
(2671, 'Ano', '', ''),
(2672, 'Semestre', '', ''),
(2673, 'Opções', '', ''),
(2674, 'Ano', '', ''),
(2675, 'Semestre', '', ''),
(2676, 'Ano', '', ''),
(2677, 'Semestre', '', ''),
(2678, 'Opções', '', ''),
(2679, 'Ano', '', ''),
(2680, 'Semestre', '', ''),
(2681, 'Ano', '', ''),
(2682, 'Semestre', '', ''),
(2683, 'Opções', '', ''),
(2684, 'Ano', '', ''),
(2685, 'Semestre', '', ''),
(2686, 'Ano', '', ''),
(2687, 'Semestre', '', ''),
(2688, 'Opções', '', ''),
(2689, 'Ano', '', ''),
(2690, 'Semestre', '', ''),
(2691, 'Processo Seletivo', '', ''),
(2692, 'Ano', '', ''),
(2693, 'Semestre', '', ''),
(2694, 'Opções', '', ''),
(2695, 'Ano', '', ''),
(2696, 'Semestre', '', ''),
(2697, 'Ano', '', ''),
(2698, 'Semestre', '', ''),
(2699, 'Opções', '', ''),
(2700, 'Ano', '', ''),
(2701, 'Semestre', '', ''),
(2702, 'Ano', '', ''),
(2703, 'Semestre', '', ''),
(2704, 'Opções', '', ''),
(2705, 'Ano', '', ''),
(2706, 'Semestre', '', ''),
(2707, 'Processo Seletivo', '', ''),
(2708, 'Processo Seletivo', '', ''),
(2709, 'Processo Seletivo', '', ''),
(2710, 'Ano', '', ''),
(2711, 'Semestre', '', ''),
(2712, 'Opções', '', ''),
(2713, 'Ano', '', ''),
(2714, 'Semestre', '', ''),
(2715, 'Ano', '', ''),
(2716, 'Semestre', '', ''),
(2717, 'Opções', '', ''),
(2718, 'Ano', '', ''),
(2719, 'Semestre', '', ''),
(2720, 'Ano', '', ''),
(2721, 'Semestre', '', ''),
(2722, 'Opções', '', ''),
(2723, 'Ano', '', ''),
(2724, 'Semestre', '', ''),
(2725, 'Ano', '', ''),
(2726, 'Semestre', '', ''),
(2727, 'Opções', '', ''),
(2728, 'Ano', '', ''),
(2729, 'Semestre', '', ''),
(2730, 'Ano', '', ''),
(2731, 'Semestre', '', ''),
(2732, 'Opções', '', ''),
(2733, 'Ano', '', ''),
(2734, 'Semestre', '', ''),
(2735, 'Ano', '', ''),
(2736, 'Semestre', '', ''),
(2737, 'Opções', '', ''),
(2738, 'Ano', '', ''),
(2739, 'Semestre', '', ''),
(2740, 'Ano', '', ''),
(2741, 'Semestre', '', ''),
(2742, 'Opções', '', ''),
(2743, 'Ano', '', ''),
(2744, 'Semestre', '', ''),
(2745, 'Ano', '', ''),
(2746, 'Semestre', '', ''),
(2747, 'Opções', '', ''),
(2748, 'Ano', '', ''),
(2749, 'Semestre', '', ''),
(2750, 'Ano', '', ''),
(2751, 'Semestre', '', ''),
(2752, 'Opções', '', ''),
(2753, 'Ano', '', ''),
(2754, 'Semestre', '', ''),
(2755, 'Ano', '', ''),
(2756, 'Semestre', '', ''),
(2757, 'Opções', '', ''),
(2758, 'Ano', '', ''),
(2759, 'Semestre', '', ''),
(2760, 'Ano', '', ''),
(2761, 'Semestre', '', ''),
(2762, 'Opções', '', ''),
(2763, 'Ano', '', ''),
(2764, 'Semestre', '', ''),
(2765, 'Ano', '', ''),
(2766, 'Semestre', '', ''),
(2767, 'Opções', '', ''),
(2768, 'Ano', '', ''),
(2769, 'Semestre', '', ''),
(2770, 'Cód.Disc.', '', ''),
(2771, 'C.H.', '', ''),
(2772, 'CR', '', ''),
(2773, 'Opções', '', ''),
(2774, 'Ano', '', ''),
(2775, 'Semestre', '', ''),
(2776, 'Opções', '', ''),
(2777, 'Ano', '', ''),
(2778, 'Semestre', '', ''),
(2779, 'Opções', '', ''),
(2780, 'Ano', '', ''),
(2781, 'Semestre', '', ''),
(2782, 'Opções', '', ''),
(2783, 'Ano', '', ''),
(2784, 'Semestre', '', ''),
(2785, 'Opções', '', ''),
(2786, 'Ano', '', ''),
(2787, 'Semestre', '', ''),
(2788, 'ADM', '', ''),
(2789, 'Opções', '', ''),
(2790, 'Ano', '', ''),
(2791, 'Semestre', '', ''),
(2792, 'MatrizADM-2015/I', '', ''),
(2793, 'Opções', '', ''),
(2794, 'Ano', '', ''),
(2795, 'Semestre', '', ''),
(2796, 'Matriz :ADM-2015/I', '', ''),
(2797, 'Opções', '', ''),
(2798, 'Ano', '', ''),
(2799, 'Semestre', '', ''),
(2800, 'Opções', '', ''),
(2801, 'Ano', '', ''),
(2802, 'Semestre', '', ''),
(2803, 'Opções', '', ''),
(2804, 'Ano', '', ''),
(2805, 'Semestre', '', ''),
(2806, 'Opções', '', ''),
(2807, 'Ano', '', ''),
(2808, 'Ano', '', ''),
(2809, 'Semestre', '', ''),
(2810, 'Opções', '', ''),
(2811, 'Carga Horária', '', ''),
(2812, 'Opções', '', ''),
(2813, 'Opções', '', ''),
(2814, 'Opções', '', ''),
(2815, 'Opções', '', ''),
(2816, 'Opções', '', ''),
(2817, 'criar_disciplina', '', ''),
(2818, 'Opções', '', ''),
(2819, 'Opções', '', ''),
(2820, 'Opções', '', ''),
(2821, 'Opções', '', ''),
(2822, 'Opções', '', ''),
(2823, 'Opções', '', ''),
(2824, 'Opções', '', ''),
(2825, 'Opções', '', ''),
(2826, 'Opções', '', ''),
(2827, 'Opções', '', ''),
(2828, 'Processo Seletivo', '', ''),
(2829, 'Ano', '', ''),
(2830, 'Semestre', '', ''),
(2831, 'Opções', '', ''),
(2832, 'Ano', '', ''),
(2833, 'Semestre', '', ''),
(2834, 'Opções', '', ''),
(2835, 'Matriz :ADM-2012/I', '', ''),
(2836, 'Opções', '', ''),
(2837, 'Opções', '', ''),
(2838, 'Opções', '', ''),
(2839, 'Opções', '', ''),
(2840, 'Opções', '', ''),
(2841, 'Opções', '', ''),
(2842, 'Opções', '', ''),
(2843, 'Opções', '', ''),
(2844, 'Opções', '', ''),
(2845, 'Opções', '', ''),
(2846, 'Opções', '', ''),
(2847, 'Opções', '', ''),
(2848, 'Opções', '', ''),
(2849, 'Opções', '', ''),
(2850, 'Opções', '', ''),
(2851, 'Opções', '', ''),
(2852, 'Opções', '', ''),
(2853, 'Opções', '', ''),
(2854, 'Opções', '', ''),
(2855, 'Opções', '', ''),
(2856, 'Opções', '', ''),
(2857, 'Opções', '', ''),
(2858, 'Opções', '', ''),
(2859, 'Opções', '', ''),
(2860, 'Opções', '', ''),
(2861, 'Opções', '', ''),
(2862, 'Opções', '', ''),
(2863, 'Opções', '', ''),
(2864, 'Opções', '', ''),
(2865, 'Opções', '', ''),
(2866, 'Opções', '', ''),
(2867, 'Opções', '', ''),
(2868, 'Opções', '', ''),
(2869, 'Opções', '', ''),
(2870, 'Opções', '', ''),
(2871, 'Opções', '', ''),
(2872, 'Opções', '', ''),
(2873, 'Opções', '', ''),
(2874, 'Opções', '', ''),
(2875, 'Opções', '', ''),
(2876, 'Opções', '', ''),
(2877, 'Opções', '', ''),
(2878, 'Opções', '', ''),
(2879, 'Opções', '', ''),
(2880, 'Opções', '', ''),
(2881, 'Opções', '', ''),
(2882, 'Opções', '', ''),
(2883, 'Opções', '', ''),
(2884, 'Opções', '', ''),
(2885, 'Opções', '', ''),
(2886, 'Opções', '', ''),
(2887, 'Opções', '', ''),
(2888, 'Carga_Horária', '', ''),
(2889, 'Opções', '', ''),
(2890, 'Carga_Horária', '', ''),
(2891, 'Opções', '', ''),
(2892, 'Carga_Horária', '', ''),
(2893, 'Opções', '', ''),
(2894, 'Carga_Horária', '', ''),
(2895, 'cód_disciplina', '', ''),
(2896, 'carga_horária', '', ''),
(2897, 'editar_disciplina', '', ''),
(2898, 'Opções', '', ''),
(2899, 'Carga_Horária', '', ''),
(2900, 'carga_horária', '', ''),
(2901, 'carga_horária', '', ''),
(2902, 'carga_horária', '', ''),
(2903, 'Processo Seletivo', '', ''),
(2904, 'Processo Seletivo', '', ''),
(2905, 'Processo Seletivo', '', ''),
(2906, 'Ano', '', ''),
(2907, 'Semestre', '', ''),
(2908, 'Opções', '', ''),
(2909, 'Ano', '', ''),
(2910, 'Semestre', '', ''),
(2911, 'Opções', '', ''),
(2912, 'Carga_Horária', '', ''),
(2913, 'carga_horária', '', ''),
(2914, 'carga_horária', '', ''),
(2915, 'Opções', '', ''),
(2916, 'Carga_Horária', '', ''),
(2917, 'Processo Seletivo', '', ''),
(2918, 'Processo Seletivo', '', ''),
(2919, 'Processo Seletivo', '', ''),
(2920, 'etapa', '', ''),
(2921, 'Ano', '', ''),
(2922, 'Semestre', '', ''),
(2923, 'Opções', '', ''),
(2924, 'Ano', '', ''),
(2925, 'Semestre', '', ''),
(2926, 'Opções', '', ''),
(2927, 'Carga_Horária', '', ''),
(2928, 'carga_horária', '', ''),
(2929, 'Processo Seletivo', '', ''),
(2930, 'Ano', '', ''),
(2931, 'Semestre', '', ''),
(2932, 'Opções', '', ''),
(2933, 'Ano', '', ''),
(2934, 'Semestre', '', ''),
(2935, 'Processo Seletivo', '', ''),
(2936, 'Ano', '', ''),
(2937, 'Semestre', '', ''),
(2938, 'Opções', '', ''),
(2939, 'Ano', '', ''),
(2940, 'Semestre', '', ''),
(2941, 'Processo Seletivo', '', ''),
(2942, 'Processo Seletivo', '', ''),
(2943, 'Processo Seletivo', '', ''),
(2944, 'Processo Seletivo', '', ''),
(2945, 'Ano', '', ''),
(2946, 'Semestre', '', ''),
(2947, 'Opções', '', ''),
(2948, 'Ano', '', ''),
(2949, 'Semestre', '', ''),
(2950, 'Opções', '', ''),
(2951, 'Carga_Horária', '', ''),
(2952, 'Processo Seletivo', '', ''),
(2953, 'Processo Seletivo', '', ''),
(2954, 'Processo Seletivo', '', ''),
(2955, 'Ano', '', ''),
(2956, 'Semestre', '', ''),
(2957, 'Opções', '', ''),
(2958, 'Ano', '', ''),
(2959, 'Semestre', '', ''),
(2960, 'Opções', '', ''),
(2961, 'Carga_Horária', '', ''),
(2962, 'Opções', '', ''),
(2963, 'Carga_Horária', '', ''),
(2964, 'Processo Seletivo', '', ''),
(2965, 'Processo Seletivo', '', ''),
(2966, 'Processo Seletivo', '', ''),
(2967, 'Ano', '', ''),
(2968, 'Semestre', '', ''),
(2969, 'Opções', '', ''),
(2970, 'Ano', '', ''),
(2971, 'Semestre', '', ''),
(2972, 'Opções', '', ''),
(2973, 'Carga_Horária', '', ''),
(2974, 'Opções', '', ''),
(2975, 'Carga_Horária', '', ''),
(2976, 'carga_horária', '', ''),
(2977, 'Opções', '', ''),
(2978, 'Carga_Horária', '', ''),
(2979, 'carga_horária', '', ''),
(2980, 'Opções', '', ''),
(2981, 'Carga_Horária', '', ''),
(2982, 'carga_horária', '', ''),
(2983, 'disciplina_alterada_com_sucesso', '', ''),
(2984, 'Opções', '', ''),
(2985, 'Carga_Horária', '', ''),
(2986, 'Opções', '', ''),
(2987, 'Carga_Horária', '', ''),
(2988, 'Processo Seletivo', '', ''),
(2989, 'Ano', '', ''),
(2990, 'Semestre', '', ''),
(2991, 'Opções', '', ''),
(2992, 'Ano', '', ''),
(2993, 'Semestre', '', ''),
(2994, 'Opções', '', ''),
(2995, 'Carga_Horária', '', ''),
(2996, 'carga_horária', '', ''),
(2997, 'Opções', '', ''),
(2998, 'Carga_Horária', '', ''),
(2999, 'Opções', '', ''),
(3000, 'Carga_Horária', '', ''),
(3001, 'Opções', '', ''),
(3002, 'Carga_Horária', '', ''),
(3003, 'Opções', '', ''),
(3004, 'Carga_Horária', '', ''),
(3005, 'disciplina_deletado_com_sucesso', '', ''),
(3006, 'Opções', '', ''),
(3007, 'Carga_Horária', '', ''),
(3008, 'Processo Seletivo', '', ''),
(3009, 'Ano', '', ''),
(3010, 'Semestre', '', ''),
(3011, 'Opções', '', ''),
(3012, 'Ano', '', ''),
(3013, 'Semestre', '', ''),
(3014, 'Opções', '', ''),
(3015, 'Carga_Horária', '', ''),
(3016, 'Opções', '', ''),
(3017, 'Carga_Horária', '', ''),
(3018, 'Opções', '', ''),
(3019, 'Carga_Horária', '', ''),
(3020, 'Opções', '', ''),
(3021, 'Carga_Horária', '', ''),
(3022, '<a href="index.php?admin/dashboard">Painel Geral</a> > <a href="index.php?admin/educacional">Painel_educacional </a><b>></b> <a href="index.php?educacional/matriz">Gerenciar_matriz_curricular</a>', '', ''),
(3023, 'Opções', '', ''),
(3024, 'Carga_Horária', '', ''),
(3025, 'Ano', '', ''),
(3026, 'Semestre', '', ''),
(3027, 'Opções', '', ''),
(3028, 'Ano', '', ''),
(3029, 'Semestre', '', ''),
(3030, 'Ano', '', ''),
(3031, 'Semestre', '', ''),
(3032, 'Opções', '', ''),
(3033, 'Ano', '', ''),
(3034, 'Semestre', '', ''),
(3035, 'Ano', '', ''),
(3036, 'Semestre', '', ''),
(3037, 'Opções', '', ''),
(3038, 'Ano', '', ''),
(3039, 'Semestre', '', ''),
(3040, 'Ano', '', ''),
(3041, 'Semestre', '', ''),
(3042, 'Opções', '', ''),
(3043, 'Ano', '', ''),
(3044, 'Semestre', '', ''),
(3045, 'matriz_deletada_com_sucesso', '', ''),
(3046, 'Ano', '', ''),
(3047, 'Semestre', '', ''),
(3048, 'Opções', '', ''),
(3049, 'Ano', '', ''),
(3050, 'Semestre', '', ''),
(3051, 'Ano', '', ''),
(3052, 'Semestre', '', ''),
(3053, 'Opções', '', ''),
(3054, 'Ano', '', ''),
(3055, 'Semestre', '', ''),
(3056, 'Ano', '', ''),
(3057, 'Semestre', '', ''),
(3058, 'Opções', '', ''),
(3059, 'Ano', '', ''),
(3060, 'Semestre', '', ''),
(3061, 'Matriz :PED-2015/II', '', ''),
(3062, 'Opções', '', ''),
(3063, 'Carga_Horária', '', ''),
(3064, 'Opções', '', ''),
(3065, 'Carga_Horária', '', ''),
(3066, '<a href="index.php?admin/dashboard">Home</a> > <a href="index.php?admin/educacional">educacional </a><b>></b> <a href="index.php?educacional/matriz">Gerenciar_matriz_curricular</a><b>></b> <a href="">disciplinas</a>', '', ''),
(3067, 'Opções', '', ''),
(3068, 'Carga_Horária', '', ''),
(3069, '<a href="index.php?admin/dashboard">Home</a> > <a href="index.php?admin/educacional">Educacional </a><b>></b> <a href="index.php?educacional/matriz">Gerenciar_matriz_curricular</a><b>></b> <a href="">Disciplinas</a>', '', ''),
(3070, 'Opções', '', ''),
(3071, 'Carga_Horária', '', ''),
(3072, '<a href="index.php?admin/dashboard">Home</a> > <a href="index.php?admin/educacional">Educacional </a><b>></b> <a href="index.php?educacional/matriz">Gerenciar_matriz_curricular</a><b> > </b> <a href="">Disciplinas</a>', '', ''),
(3073, 'Opções', '', ''),
(3074, 'Carga_Horária', '', ''),
(3075, '<a href="index.php?admin/dashboard">Home</a> > <a href="index.php?admin/educacional">educacional </a><b>></b> <a href="">Gerenciar_matriz_curricular</a>', '', ''),
(3076, 'Ano', '', ''),
(3077, 'Semestre', '', ''),
(3078, 'Opções', '', ''),
(3079, 'Ano', '', ''),
(3080, 'Semestre', '', ''),
(3081, 'Ano', '', ''),
(3082, 'Semestre', '', ''),
(3083, 'Opções', '', ''),
(3084, 'Ano', '', ''),
(3085, 'Semestre', '', ''),
(3086, 'Opções', '', ''),
(3087, 'Carga_Horária', '', ''),
(3088, 'Opções', '', ''),
(3089, 'Carga_Horária', '', ''),
(3090, 'Ano', '', ''),
(3091, 'Semestre', '', ''),
(3092, 'Opções', '', ''),
(3093, 'Ano', '', ''),
(3094, 'Semestre', '', ''),
(3095, 'Ano', '', ''),
(3096, 'Semestre', '', ''),
(3097, 'Opções', '', ''),
(3098, 'Ano', '', ''),
(3099, 'Semestre', '', ''),
(3100, 'Ano', '', ''),
(3101, 'Semestre', '', ''),
(3102, 'Opções', '', ''),
(3103, 'imprimir', '', ''),
(3104, 'Ano', '', ''),
(3105, 'Semestre', '', ''),
(3106, 'Ano', '', ''),
(3107, 'Semestre', '', ''),
(3108, 'Opções', '', ''),
(3109, 'Ano', '', ''),
(3110, 'Semestre', '', ''),
(3111, 'Opções', '', ''),
(3112, 'Carga_Horária', '', ''),
(3113, 'carga_horária', '', ''),
(3114, 'Ano', '', ''),
(3115, 'Semestre', '', ''),
(3116, 'Opções', '', ''),
(3117, 'Ano', '', ''),
(3118, 'Semestre', '', ''),
(3119, 'Ano', '', ''),
(3120, 'Semestre', '', ''),
(3121, 'Opções', '', ''),
(3122, 'Ano', '', ''),
(3123, 'Semestre', '', ''),
(3124, 'Ano', '', ''),
(3125, 'Semestre', '', ''),
(3126, 'Opções', '', ''),
(3127, 'Ano', '', ''),
(3128, 'Semestre', '', ''),
(3129, 'Ano', '', ''),
(3130, 'Semestre', '', ''),
(3131, 'Opções', '', ''),
(3132, 'Ano', '', ''),
(3133, 'Semestre', '', ''),
(3134, 'Opções', '', ''),
(3135, 'Carga_Horária', '', ''),
(3136, 'Ano', '', ''),
(3137, 'Semestre', '', ''),
(3138, 'Opções', '', ''),
(3139, 'Ano', '', ''),
(3140, 'Semestre', '', ''),
(3141, 'Ano', '', ''),
(3142, 'Semestre', '', ''),
(3143, 'Opções', '', ''),
(3144, 'Ano', '', ''),
(3145, 'Semestre', '', ''),
(3146, 'Opções', '', ''),
(3147, 'Carga_Horária', '', ''),
(3148, 'Ano', '', ''),
(3149, 'Semestre', '', ''),
(3150, 'Opções', '', ''),
(3151, 'Ano', '', ''),
(3152, 'Semestre', '', ''),
(3153, 'Ano', '', ''),
(3154, 'Semestre', '', ''),
(3155, 'Opções', '', ''),
(3156, 'Ano', '', ''),
(3157, 'Semestre', '', ''),
(3158, 'Opções', '', ''),
(3159, 'Carga_Horária', '', ''),
(3160, 'Ano', '', ''),
(3161, 'Semestre', '', ''),
(3162, 'Opções', '', ''),
(3163, 'Ano', '', ''),
(3164, 'Semestre', '', ''),
(3165, 'Opções', '', ''),
(3166, 'Carga_Horária', '', ''),
(3167, 'Opções', '', ''),
(3168, 'Carga_Horária', '', ''),
(3169, 'Ano', '', ''),
(3170, 'Semestre', '', ''),
(3171, 'Opções', '', ''),
(3172, 'Ano', '', ''),
(3173, 'Semestre', '', ''),
(3174, 'Ano', '', ''),
(3175, 'Semestre', '', ''),
(3176, 'Opções', '', ''),
(3177, 'Ano', '', ''),
(3178, 'Semestre', '', ''),
(3179, 'Opções', '', ''),
(3180, 'Carga_Horária', '', ''),
(3181, 'Opções', '', ''),
(3182, 'Carga_Horária', '', ''),
(3183, 'Ano', '', ''),
(3184, 'Semestre', '', ''),
(3185, 'Opções', '', ''),
(3186, 'Ano', '', ''),
(3187, 'Semestre', '', ''),
(3188, 'Ano', '', ''),
(3189, 'Semestre', '', ''),
(3190, 'Opções', '', ''),
(3191, 'Ano', '', ''),
(3192, 'Semestre', '', ''),
(3193, 'Ano', '', ''),
(3194, 'Semestre', '', ''),
(3195, 'Opções', '', ''),
(3196, 'Ano', '', ''),
(3197, 'Semestre', '', ''),
(3198, 'Ano', '', ''),
(3199, 'Semestre', '', ''),
(3200, 'Opções', '', ''),
(3201, 'Ano', '', ''),
(3202, 'Semestre', '', ''),
(3203, 'Ano', '', ''),
(3204, 'Semestre', '', ''),
(3205, 'Opções', '', ''),
(3206, 'Ano', '', ''),
(3207, 'Semestre', '', ''),
(3208, 'Ano', '', ''),
(3209, 'Semestre', '', ''),
(3210, 'Opções', '', ''),
(3211, 'Ano', '', ''),
(3212, 'Semestre', '', ''),
(3213, 'Ano', '', ''),
(3214, 'Semestre', '', ''),
(3215, 'Opções', '', ''),
(3216, 'Ano', '', ''),
(3217, 'Semestre', '', ''),
(3218, 'Ano', '', ''),
(3219, 'Semestre', '', ''),
(3220, 'Opções', '', ''),
(3221, 'Ano', '', ''),
(3222, 'Semestre', '', ''),
(3223, 'Ano', '', ''),
(3224, 'Semestre', '', ''),
(3225, 'Opções', '', ''),
(3226, 'Ano', '', ''),
(3227, 'Semestre', '', ''),
(3228, 'Ano', '', ''),
(3229, 'Semestre', '', ''),
(3230, 'Opções', '', ''),
(3231, 'Ano', '', ''),
(3232, 'Semestre', '', ''),
(3233, 'Ano', '', ''),
(3234, 'Semestre', '', ''),
(3235, 'Opções', '', ''),
(3236, 'Ano', '', ''),
(3237, 'Semestre', '', ''),
(3238, 'Ano', '', ''),
(3239, 'Semestre', '', ''),
(3240, 'Opções', '', ''),
(3241, 'Ano', '', ''),
(3242, 'Semestre', '', ''),
(3243, 'Ano', '', ''),
(3244, 'Semestre', '', ''),
(3245, 'Opções', '', ''),
(3246, 'Ano', '', ''),
(3247, 'Semestre', '', ''),
(3248, 'Ano', '', ''),
(3249, 'Semestre', '', ''),
(3250, 'Opções', '', ''),
(3251, 'Ano', '', ''),
(3252, 'Semestre', '', ''),
(3253, 'Opções', '', ''),
(3254, 'Carga_Horária', '', ''),
(3255, 'Ano', '', ''),
(3256, 'Semestre', '', ''),
(3257, 'Opções', '', ''),
(3258, 'Ano', '', ''),
(3259, 'Semestre', '', ''),
(3260, 'Ano', '', ''),
(3261, 'Semestre', '', ''),
(3262, 'Opções', '', ''),
(3263, 'Ano', '', ''),
(3264, 'Semestre', '', ''),
(3265, 'Opções', '', ''),
(3266, 'Carga_Horária', '', ''),
(5007, 'Financeiro', '', ''),
(5006, 'Educacional', '', ''),
(5005, 'Biblioteca', '', ''),
(5004, 'cpf', '', ''),
(5003, 'cpf', '', ''),
(5002, 'OBS_documento', '', ''),
(5001, 'cpf', '', ''),
(5000, 'celular_responsável', '', ''),
(4999, 'cpf', '', ''),
(4998, 'cpf', '', ''),
(4997, 'cpf', '', ''),
(4996, 'cpf', '', ''),
(4995, 'CPF_responsável', '', ''),
(4994, 'cpf', '', ''),
(4993, 'RG_responsavel', '', ''),
(4992, 'cpf', '', ''),
(4991, 'fone_responsavel', '', ''),
(4990, 'responsavel', '', ''),
(4989, 'cpf', '', ''),
(4988, 'certidão_reservista', '', ''),
(4987, 'cpf', '', ''),
(4986, 'certificado', '', ''),
(4985, 'documento_estrangeiro', '', ''),
(4984, 'uf_certidão_reservista', '', ''),
(4983, 'cpf', '', ''),
(4982, 'uf_certificado_reservista', '', ''),
(4981, 'conjuge', '', ''),
(4980, 'cpf', '', ''),
(4979, 'cpf', '', ''),
(4978, 'pai', '', ''),
(4977, 'mae', '', ''),
(4976, 'cpf', '', ''),
(4975, 'cpf', '', ''),
(4974, 'cor', '', ''),
(4973, 'nacionalidade', '', ''),
(4972, 'cpf', '', ''),
(4971, 'cpf', '', ''),
(4970, 'cpf', '', ''),
(4969, 'celular', '', ''),
(4968, 'cpf', '', ''),
(4967, 'fone', '', ''),
(4966, 'cpf', '', ''),
(4965, 'uf_titulo', '', ''),
(4964, 'cpf', '', ''),
(4963, 'add_turma', '', ''),
(4962, 'titulo', '', ''),
(4961, 'cidade', '', ''),
(4960, 'UF', '', ''),
(4959, 'complemento', '', ''),
(4958, 'bairro', '', ''),
(4957, 'endereco', '', ''),
(4956, 'cep', '', ''),
(4955, 'estado_civil', '', ''),
(4954, 'cidade_origem', '', ''),
(4953, 'UF_nascimento', '', ''),
(4952, 'pais_origem', '', ''),
(4951, 'RG_orgão_expeditor', '', ''),
(4950, 'RG_UF', '', ''),
(4949, 'cpf', '', ''),
(4948, 'data_nascimento', '', ''),
(4947, 'novo_aluno', '', ''),
(4946, 'lista_aluno', '', ''),
(4945, 'Educacional->', '', ''),
(5030, '<a href="index.php?admin/dashboard">Painel Geral</a> > <a href="index.php?admin/educacional">Painel_educacional </a><b>></b> <a href="">Gerenciar Turma</a>', '', ''),
(5029, 'cpf', '', ''),
(5028, 'cpf', '', ''),
(5027, 'cpf', '', ''),
(5026, 'cpf', '', ''),
(5025, 'cpf', '', ''),
(5024, 'cpf', '', ''),
(5023, 'cpf', '', ''),
(5022, 'cpf', '', ''),
(5021, 'cpf', '', ''),
(5020, 'cpf', '', ''),
(5019, 'cpf', '', ''),
(5018, 'cpf', '', ''),
(5017, 'cpf', '', ''),
(5016, 'cpf', '', ''),
(5015, 'cpf', '', ''),
(5014, 'cpf', '', ''),
(5013, 'cpf', '', ''),
(5012, 'gráfico', '', ''),
(5011, 'turma', '', ''),
(5010, 'cursos', '', ''),
(5009, 'bolsas', '', ''),
(5008, 'painel_educacional', '', ''),
(5056, 'curso', '', ''),
(5055, 'Semestre', '', ''),
(5054, 'Ano', '', ''),
(5053, 'Opções', '', ''),
(5052, 'Semestre', '', ''),
(5051, 'Ano', '', ''),
(5050, 'Semestre', '', ''),
(5049, 'Ano', '', ''),
(5048, 'Opções', '', ''),
(5047, 'Semestre', '', ''),
(5046, 'Ano', '', ''),
(5045, 'Carga_Horária', '', ''),
(5044, 'Opções', '', ''),
(5043, 'Semestre', '', ''),
(5042, 'Ano', '', ''),
(5041, 'Opções', '', ''),
(5037, 'periodo', '', ''),
(5038, 'cpf', '', ''),
(5039, 'Ano', '', ''),
(5040, 'Semestre', '', ''),
(5036, 'turno', '', ''),
(5035, 'curso', '', ''),
(5034, 'periodo', '', ''),
(5033, 'curso', '', ''),
(5032, 'nova_turma', '', ''),
(5031, 'lista_turma', '', ''),
(5073, 'curso', '', ''),
(5072, 'cpf', '', ''),
(5071, 'curso', '', ''),
(5070, 'cpf', '', ''),
(5069, 'cpf', '', ''),
(5068, 'curso', '', ''),
(5067, 'cpf', '', ''),
(5057, 'cpf', '', ''),
(5058, 'cpf', '', ''),
(5059, 'curso', '', ''),
(5060, 'cpf', '', ''),
(5061, 'cpf', '', ''),
(5062, 'curso', '', ''),
(5063, 'cpf', '', ''),
(5064, 'cpf', '', ''),
(5065, 'curso', '', ''),
(5066, 'cpf', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `logs_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_nb_tabela` int(11) DEFAULT NULL,
  `log_dt_data_hora` datetime DEFAULT NULL,
  `log_nb_codigo_tabela` int(11) DEFAULT NULL,
  `log_nb_usuario` int(11) DEFAULT NULL,
  `usuarios_id` int(11) NOT NULL,
  `acoes_id` int(11) NOT NULL,
  PRIMARY KEY (`logs_id`),
  KEY `FK_logs_usuario` (`usuarios_id`),
  KEY `fk_logs_acoes1` (`acoes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mark`
--

CREATE TABLE IF NOT EXISTS `mark` (
  `mark_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `mark_obtained` int(11) NOT NULL DEFAULT '0',
  `mark_total` int(11) NOT NULL DEFAULT '100',
  `attendance` int(11) NOT NULL DEFAULT '0',
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`mark_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `mark`
--

INSERT INTO `mark` (`mark_id`, `student_id`, `subject_id`, `class_id`, `exam_id`, `mark_obtained`, `mark_total`, `attendance`, `comment`) VALUES
(1, 4, 1, 2, 3, 10, 100, 3, ''),
(2, 6, 1, 2, 3, 0, 100, 0, ''),
(3, 9, 1, 2, 3, 0, 100, 0, ''),
(4, 10, 1, 2, 3, 0, 100, 0, ''),
(5, 1, 1, 4, 3, 10, 100, 10, ''),
(6, 4, 1, 4, 3, 0, 100, 0, ''),
(7, 5, 1, 4, 3, 0, 100, 0, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `matricula_aluno`
--

CREATE TABLE IF NOT EXISTS `matricula_aluno` (
  `matricula_aluno_id` int(11) NOT NULL AUTO_INCREMENT,
  `registro_academico` int(15) NOT NULL COMMENT 'Registro Acadêmico, ou número de matrícula',
  `data_matricula` date NOT NULL,
  `situacao` int(11) DEFAULT NULL COMMENT 'opções de acordo c o MEC\n\n1 - pré-matriculado\n2 - Cursando\n3 - Matrícula Trancada\n4 - Desvinculado do curso\n5 - Transferido para outro curso da mesma IES\n6 - Formado\n7 - Falecido',
  `semestre_ano_ingresso` varchar(6) DEFAULT NULL COMMENT 'Informação para o Censo\n\nSalvar no formato:\n\n012015\n\n\n',
  `forma_ingresso` int(11) DEFAULT NULL,
  `cadastro_aluno_id` int(11) NOT NULL,
  `curso_id` int(10) unsigned zerofill NOT NULL,
  `turno` int(11) DEFAULT NULL COMMENT '1 - Matutino\n2 - Vespertino\n3 - Noturno\n4 - Integral',
  PRIMARY KEY (`matricula_aluno_id`),
  KEY `fk_matricula_aluno_cadastro_aluno1` (`cadastro_aluno_id`),
  KEY `fk_matricula_aluno_curso1` (`curso_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `matricula_aluno`
--

INSERT INTO `matricula_aluno` (`matricula_aluno_id`, `registro_academico`, `data_matricula`, `situacao`, `semestre_ano_ingresso`, `forma_ingresso`, `cadastro_aluno_id`, `curso_id`, `turno`) VALUES
(1, 1, '2015-07-25', 1, '22015', 11, 2, 0000000003, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `matricula_aluno_turma`
--

CREATE TABLE IF NOT EXISTS `matricula_aluno_turma` (
  `matricula_aluno_turma_id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `situacao_aluno_turma` int(11) DEFAULT NULL COMMENT '1 - matriculado\n2 - Semestre concluído\n3 - pré-matriculado\n',
  `data_matricula_aluno_turma` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `matricula_aluno_id` int(11) NOT NULL,
  `turma_id` int(11) NOT NULL,
  PRIMARY KEY (`matricula_aluno_turma_id`),
  KEY `fk_matricula_turma_matricula_aluno1` (`matricula_aluno_id`),
  KEY `fk_matricula_turma_turma1` (`turma_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `matriz`
--

CREATE TABLE IF NOT EXISTS `matriz` (
  `matriz_id` int(11) NOT NULL AUTO_INCREMENT,
  `mat_tx_ano` varchar(4) NOT NULL,
  `mat_nb_total_hora` int(11) DEFAULT NULL,
  `mat_tx_semestre` varchar(2) NOT NULL,
  `cursos_id` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`matriz_id`),
  KEY `fk_matriz_curso1` (`cursos_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `matriz`
--

INSERT INTO `matriz` (`matriz_id`, `mat_tx_ano`, `mat_nb_total_hora`, `mat_tx_semestre`, `cursos_id`) VALUES
(1, '2012', NULL, 'I', 0000000001),
(2, '2013', NULL, 'I', 0000000003);

-- --------------------------------------------------------

--
-- Estrutura da tabela `matriz_disciplina`
--

CREATE TABLE IF NOT EXISTS `matriz_disciplina` (
  `matriz_disciplina_id` int(11) NOT NULL AUTO_INCREMENT,
  `matriz_id` int(11) NOT NULL,
  `periodo` int(11) DEFAULT NULL COMMENT '1 - I\n2 - II\n3 - III\n4 - IV\n5 - V\n6 - VI\n7 - VII\n8 - VIII',
  `disciplina_id` int(11) NOT NULL,
  `carga_horaria` int(11) NOT NULL,
  `credito` double DEFAULT NULL,
  PRIMARY KEY (`matriz_disciplina_id`),
  KEY `fk_matriz_disciplina_matriz1_idx` (`matriz_id`),
  KEY `fk_matriz_disciplina_disciplina1_idx` (`disciplina_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Extraindo dados da tabela `matriz_disciplina`
--

INSERT INTO `matriz_disciplina` (`matriz_disciplina_id`, `matriz_id`, `periodo`, `disciplina_id`, `carga_horaria`, `credito`) VALUES
(5, 1, 1, 7, 80, 4),
(6, 1, 1, 8, 40, 2),
(7, 1, 1, 9, 80, 4),
(8, 1, 1, 10, 40, 2),
(9, 1, 1, 11, 80, 4),
(10, 1, 1, 12, 80, 4),
(11, 1, 2, 13, 80, 4),
(12, 1, 2, 14, 40, 2),
(13, 1, 2, 15, 80, 4),
(14, 1, 2, 16, 80, 4),
(15, 1, 2, 17, 40, 2),
(16, 1, 2, 18, 40, 2),
(17, 1, 2, 19, 40, 2),
(18, 1, 3, 20, 80, 4),
(19, 1, 3, 21, 40, 2),
(20, 1, 3, 22, 80, 4),
(21, 1, 3, 23, 80, 4),
(22, 1, 3, 24, 40, 2),
(23, 1, 3, 25, 40, 2),
(24, 1, 4, 26, 80, 4),
(25, 1, 4, 27, 80, 4),
(26, 1, 4, 28, 80, 4),
(27, 1, 4, 29, 40, 2),
(28, 1, 4, 30, 40, 2),
(29, 1, 4, 31, 40, 2),
(30, 1, 4, 32, 40, 2),
(31, 1, 5, 33, 80, 4),
(32, 1, 5, 34, 80, 4),
(33, 1, 5, 35, 40, 2),
(34, 1, 5, 36, 40, 2),
(35, 1, 5, 37, 80, 4),
(36, 1, 5, 38, 40, 2),
(37, 1, 6, 39, 80, 4),
(38, 1, 6, 40, 80, 4),
(39, 1, 6, 41, 40, 2),
(40, 1, 6, 42, 40, 2),
(41, 1, 6, 43, 80, 4),
(42, 1, 6, 44, 40, 2),
(43, 1, 6, 45, 40, 2),
(44, 1, 7, 46, 70, 3.5),
(45, 1, 7, 47, 80, 4),
(46, 1, 7, 48, 80, 4),
(47, 1, 7, 49, 80, 4),
(48, 1, 7, 50, 80, 4),
(49, 1, 7, 51, 40, 2),
(50, 1, 8, 52, 80, 4),
(51, 1, 8, 53, 40, 2),
(52, 1, 8, 54, 40, 2),
(53, 1, 8, 55, 40, 2),
(54, 1, 8, 56, 40, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensalidades`
--

CREATE TABLE IF NOT EXISTS `mensalidades` (
  `mensalidades_id` int(11) NOT NULL AUTO_INCREMENT,
  `data_vencimento` date NOT NULL,
  `parcela` varchar(2) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `valor` float NOT NULL,
  `mes` varchar(45) DEFAULT NULL,
  `referente` varchar(45) DEFAULT NULL,
  `matricula_aluno_turma_id` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`mensalidades_id`),
  KEY `fk_mensalidades_matricula_aluno_turma1` (`matricula_aluno_turma_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `menus_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `men_tx_descricao` varchar(100) DEFAULT NULL,
  `men_tx_url` varchar(100) DEFAULT NULL,
  `men_nb_posicao` int(11) DEFAULT NULL,
  `modulos_id` int(11) NOT NULL,
  `men_tx_url_image` varchar(100) NOT NULL DEFAULT '',
  `men_tx_tabela` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`menus_id`),
  KEY `fk_menus_modulos1_idx` (`modulos_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Extraindo dados da tabela `menus`
--

INSERT INTO `menus` (`menus_id`, `nome`, `men_tx_descricao`, `men_tx_url`, `men_nb_posicao`, `modulos_id`, `men_tx_url_image`, `men_tx_tabela`) VALUES
(19, 'alunos', 'cadastro, update, delete de aluno', NULL, NULL, 2, 'template/images/icons/user.png', ''),
(20, 'contas', 'cadastro, update, delete de aluno', NULL, NULL, 2, '', ''),
(23, 'vestibular', NULL, 'index.php?admin/vestibular', NULL, 1, 'template/images/icons_menu/vestibular.png', 'vestibular'),
(24, 'chamada vest', NULL, 'index.php?admin/vestibularChamada', NULL, 1, 'template/images/icons_menu/chamada.png', 'vestibular'),
(25, 'candidato', NULL, 'index.php?admin/candidato', NULL, 1, 'template/images/icons_menu/candidato.png', 'candidato'),
(26, 'bolsas', NULL, 'index.php?educacional/bolsas', NULL, 3, 'template/images/icons_menu/bolsas.png', 'bolsas'),
(28, 'periodo_letivo', NULL, 'index.php?educacional/periodo', NULL, 3, 'template/images/icons_menu/periodo_letivo.png', 'periodo_letivo'),
(30, 'cursos', NULL, 'index.php?educacional/cursos', NULL, 3, 'template/images/icons_menu/bolsas.png', 'cursos'),
(32, 'matriz', NULL, 'index.php?educacional/matriz', NULL, 3, 'template/images/icons_menu/bolsas.png', 'matriz'),
(33, 'etapa', NULL, 'index.php?educacional/etapa', NULL, 3, 'template/images/icons_menu/bolsas.png', 'etapa'),
(34, 'professor', NULL, 'index.php?admin/teacher', NULL, 3, 'template/images/icons_menu/bolsas.png', 'professor'),
(35, 'teste', NULL, 'index.php?biblioteca/teste', NULL, 4, 'template/images/icons_menu/bolsas.png', 'professor'),
(36, 'turma', NULL, 'index.php?educacional/turma', NULL, 3, 'template/images/icons_menu/bolsas.png', 'turma'),
(37, 'aluno', NULL, 'index.php?educacional/aluno', NULL, 3, 'template/images/icons_menu/bolsas.png', 'cadastro_aluno');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modulos`
--

CREATE TABLE IF NOT EXISTS `modulos` (
  `modulos_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `mod_tx_url_imagem` varchar(300) DEFAULT NULL,
  `mod_tx_url` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`modulos_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `modulos`
--

INSERT INTO `modulos` (`modulos_id`, `nome`, `mod_tx_url_imagem`, `mod_tx_url`) VALUES
(1, 'Processo Seletivo', 'template/images/icons_modulo/processo_seletivo.png', 'index.php?admin/processo'),
(2, 'Financeiro', 'template/images/icons_modulo/financeiro.png', 'index.php?admin/financeiro'),
(3, 'Educacional', 'template/images/icons_modulo/educacional.png', 'index.php?admin/educacional'),
(4, 'Biblioteca', 'template/images/icons_modulo/educacional.png', 'index.php?admin/biblioteca');

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticeboard`
--

CREATE TABLE IF NOT EXISTS `noticeboard` (
  `notice_id` int(11) NOT NULL AUTO_INCREMENT,
  `notice_title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `notice` longtext COLLATE utf8_unicode_ci NOT NULL,
  `create_timestamp` int(11) NOT NULL,
  PRIMARY KEY (`notice_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `noticeboard`
--

INSERT INTO `noticeboard` (`notice_id`, `notice_title`, `notice`, `create_timestamp`) VALUES
(5, 'TESTE VALEU', 'cARNAVAL 2015', 0),
(7, 'KAROL', 'FTFTFTFTFTF', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamentos`
--

CREATE TABLE IF NOT EXISTS `pagamentos` (
  `pagamentos_id` int(11) NOT NULL AUTO_INCREMENT,
  `data_pagamento` date NOT NULL,
  `valor_pagamento` float NOT NULL,
  `forma_pagamento` int(11) NOT NULL,
  `desconto` float NOT NULL,
  `juros` float NOT NULL,
  `status_pagamento` int(11) NOT NULL,
  `mensalidades_id` int(11) NOT NULL,
  PRIMARY KEY (`pagamentos_id`),
  KEY `fk_pagamentos_mensalidades1` (`mensalidades_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pais`
--

CREATE TABLE IF NOT EXISTS `pais` (
  `pais_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(4) NOT NULL DEFAULT '',
  `nome` varchar(150) NOT NULL DEFAULT '',
  PRIMARY KEY (`pais_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfis`
--

CREATE TABLE IF NOT EXISTS `perfis` (
  `perfis_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `per_tx_descricao` varchar(100) NOT NULL,
  PRIMARY KEY (`perfis_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `perfis`
--

INSERT INTO `perfis` (`perfis_id`, `nome`, `per_tx_descricao`) VALUES
(11, 'admin geral do sistema', 'ADMINISTRADOR GERAL DO SISTEMA, POSSUI TODOS OS PRIVILEGIOS');

-- --------------------------------------------------------

--
-- Estrutura da tabela `periodo`
--

CREATE TABLE IF NOT EXISTS `periodo` (
  `periodo_id` int(11) NOT NULL AUTO_INCREMENT,
  `periodo` int(11) NOT NULL,
  PRIMARY KEY (`periodo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `periodo`
--

INSERT INTO `periodo` (`periodo_id`, `periodo`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `periodo_letivo`
--

CREATE TABLE IF NOT EXISTS `periodo_letivo` (
  `periodo_letivo_id` int(11) NOT NULL AUTO_INCREMENT,
  `periodo_letivo` varchar(50) NOT NULL COMMENT 'o período letívo pode ser:\n\n2015/1\n2015/2\n\nou só\n2015\ndependendo de como a escola funciona.',
  `periodo_letivo_descricao` varchar(250) NOT NULL COMMENT 'é a descrição do período letivo.\nEx.\n2o Semestre de 2015',
  `dias_letivos` int(11) DEFAULT NULL COMMENT 'Número de dias letivos referente ao período letivo.',
  `data_inicio` date NOT NULL COMMENT 'data de início do período letivo\n',
  `data_prev_termino` date DEFAULT NULL COMMENT 'data de previsao para o fim do período letivo',
  `data_termino` date DEFAULT NULL COMMENT 'Data de encerramento do período',
  `periodo_encerrado` int(11) NOT NULL COMMENT 'Informar se o período esta encerrado.\n\n0 - Período Encerrado;\n1 - Período Aberto;',
  `ano` int(11) NOT NULL,
  `semestre` int(11) NOT NULL,
  PRIMARY KEY (`periodo_letivo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `periodo_letivo`
--

INSERT INTO `periodo_letivo` (`periodo_letivo_id`, `periodo_letivo`, `periodo_letivo_descricao`, `dias_letivos`, `data_inicio`, `data_prev_termino`, `data_termino`, `periodo_encerrado`, `ano`, `semestre`) VALUES
(1, '2015/1', '1o. Semestre de 2015', 4944, '2015-10-02', '2015-08-07', '1970-01-01', 1, 2015, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE IF NOT EXISTS `professor` (
  `professor_id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `name` longtext NOT NULL,
  `birthday` longtext NOT NULL COMMENT '1- Masculino\n2- Feminino',
  `sex` longtext NOT NULL,
  `religion` longtext NOT NULL,
  `blood_group` longtext NOT NULL,
  `address` longtext NOT NULL,
  `phone` longtext NOT NULL,
  `email` longtext NOT NULL,
  `password` longtext NOT NULL,
  PRIMARY KEY (`professor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`professor_id`, `name`, `birthday`, `sex`, `religion`, `blood_group`, `address`, `phone`, `email`, `password`) VALUES
(0000000006, 'Israel Frota Araujo', '05/28/2015', 'male', '', '', 'Emílio Moreira 2176', '92982319913', 'iaraujo.israel@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor_turma`
--

CREATE TABLE IF NOT EXISTS `professor_turma` (
  `professor_turma_id` int(11) NOT NULL DEFAULT '0',
  `turma_id` int(11) NOT NULL DEFAULT '0',
  `teacher_id` int(11) NOT NULL,
  `matriz_disciplina_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`professor_turma_id`),
  KEY `fk_professor_turma_turma1` (`turma_id`),
  KEY `fk_professor_turma_teacher1` (`teacher_id`),
  KEY `FK_professor_turma_matriz_disciplina` (`matriz_disciplina_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `professor_turma`
--

INSERT INTO `professor_turma` (`professor_turma_id`, `turma_id`, `teacher_id`, `matriz_disciplina_id`) VALUES
(0, 2, 9, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`settings_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `settings`
--

INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES
(1, 'system_name', 'Faculdade Boas Novas'),
(2, 'system_title', 'Future Educacional'),
(3, 'address', 'Dhaka, Bangladesh'),
(4, 'phone', '+8012654159'),
(5, 'paypal_email', 'contato@dedial.com'),
(6, 'currency', 'BRL'),
(7, 'system_email', 'escolacontinental@yahoo.com.br');

-- --------------------------------------------------------

--
-- Estrutura da tabela `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `birthday` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sex` longtext COLLATE utf8_unicode_ci NOT NULL,
  `religion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `blood_group` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `father_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `mother_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `class_id` longtext COLLATE utf8_unicode_ci NOT NULL,
  `roll` longtext COLLATE utf8_unicode_ci NOT NULL,
  `transport_id` int(11) NOT NULL,
  `dormitory_id` int(11) NOT NULL,
  `dormitory_room_number` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `student`
--

INSERT INTO `student` (`student_id`, `name`, `birthday`, `sex`, `religion`, `blood_group`, `address`, `phone`, `email`, `password`, `father_name`, `mother_name`, `class_id`, `roll`, `transport_id`, `dormitory_id`, `dormitory_room_number`) VALUES
(1, 'Jonathan', '03/25/2015', 'male', '', '', '', '', 'mario@mario', '123', '', '', '4', '', 0, 0, ''),
(2, 'Maria', '03/04/2015', 'female', '', '', 'Maria', '1234 1234', 'maria@maria.com', 'maria', 'Maria', 'Maria', '7', '?', 0, 0, ''),
(3, 'symon', '03/23/2015', 'male', '', '', '', '', 'ok@ok', '123456', '', '', '8', '', 0, 0, ''),
(5, 'Caio', '', 'male', '', '', '', '', '', '', '', '', '4', '', 0, 0, ''),
(6, 'Zé', '', 'male', '', '', '', '', '', '', '', '', '9', '', 0, 0, ''),
(7, 'Edelvito Araujo', '03/30/2015', 'male', '', '', '', '', '', '', '', '', '8', '', 0, 0, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sub_menus`
--

CREATE TABLE IF NOT EXISTS `sub_menus` (
  `sub_menus_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `sub_tx_url` varchar(100) NOT NULL,
  `sub_nb_posicao` int(11) NOT NULL,
  `menus_id` int(11) NOT NULL,
  PRIMARY KEY (`sub_menus_id`),
  KEY `fk_sub_menus_menus1_idx` (`menus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `birthday` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sex` longtext COLLATE utf8_unicode_ci NOT NULL,
  `religion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `blood_group` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `name`, `birthday`, `sex`, `religion`, `blood_group`, `address`, `phone`, `email`, `password`) VALUES
(9, 'Israel Frota Araujo', '05/28/2015', 'male', '', '', 'Emílio Moreira 2176', '92982319913', 'iaraujo.israel@gmail.com', '123456'),
(12, 'professor 2', '05/29/2015', 'male', '', '', 'Emílio Moreira 2176', '92982319913', 'iaraujo.israel@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Estrutura da tabela `transport`
--

CREATE TABLE IF NOT EXISTS `transport` (
  `transport_id` int(11) NOT NULL AUTO_INCREMENT,
  `route_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `number_of_vehicle` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `route_fare` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`transport_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `transport`
--

INSERT INTO `transport` (`transport_id`, `route_name`, `number_of_vehicle`, `description`, `route_fare`) VALUES
(1, 'Centro', '1', 'Van do seu Mario', '10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE IF NOT EXISTS `turma` (
  `turma_id` int(11) NOT NULL AUTO_INCREMENT,
  `tur_tx_descricao` varchar(100) NOT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1 - Aberta\n0 - Fechada',
  `periodo_letivo_id` int(11) NOT NULL,
  `matriz_id` int(11) NOT NULL,
  `periodo_id` int(11) NOT NULL,
  `turno_id` int(11) NOT NULL,
  PRIMARY KEY (`turma_id`),
  KEY `fk_turma_periodo_letivo1` (`periodo_letivo_id`),
  KEY `fk_turma_matriz1` (`matriz_id`),
  KEY `fk_turma_periodo1` (`periodo_id`),
  KEY `fk_turma_turno1_idx` (`turno_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`turma_id`, `tur_tx_descricao`, `status`, `periodo_letivo_id`, `matriz_id`, `periodo_id`, `turno_id`) VALUES
(1, 'teste', 0, 1, 2, 8, 1),
(2, 'ADM 1', 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turno`
--

CREATE TABLE IF NOT EXISTS `turno` (
  `turno_id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) DEFAULT NULL,
  `horario` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`turno_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `turno`
--

INSERT INTO `turno` (`turno_id`, `descricao`, `horario`) VALUES
(1, 'Matutino', '08:00 as 12:00'),
(2, 'Vespertino', '13:00 as 17:00'),
(3, 'Noturno', '18:00 as 22:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuarios_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL DEFAULT '',
  `usu_tx_login` varchar(45) NOT NULL DEFAULT '',
  `usu_tx_senha` varchar(32) NOT NULL DEFAULT '',
  `usu_tx_email` varchar(100) NOT NULL DEFAULT '',
  `perfis_id` int(11) NOT NULL,
  `usu_tx_url_foto` varchar(200) DEFAULT NULL,
  `usu_nb_tipo` int(2) unsigned NOT NULL DEFAULT '0' COMMENT '1 - aluno;\n2 - professor;\n3 - coordenador;\n4 - funcionário administrativo;\n5 - administrador do sistema;',
  `usu_nb_status` int(11) DEFAULT NULL COMMENT '1 - Ativo\n0 - Inativo',
  PRIMARY KEY (`usuarios_id`),
  KEY `FK_usuarios_2` (`perfis_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`usuarios_id`, `nome`, `usu_tx_login`, `usu_tx_senha`, `usu_tx_email`, `perfis_id`, `usu_tx_url_foto`, `usu_nb_tipo`, `usu_nb_status`) VALUES
(1, 'Karol Oliveira', 'karol', '123', '', 11, NULL, 0, NULL),
(2, 'Joao', 'joao', '123', '', 11, NULL, 0, NULL),
(3, 'Israel Araujo', 'israel', '1234', '', 11, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vestibular`
--

CREATE TABLE IF NOT EXISTS `vestibular` (
  `vestibular_id` int(11) NOT NULL AUTO_INCREMENT,
  `vest_nb_ano` varchar(4) NOT NULL,
  `vest_dt_realizacao` date NOT NULL DEFAULT '0000-00-00',
  `vest_tx_semestre` varchar(2) NOT NULL DEFAULT '',
  `vest_nb_tipo` int(1) NOT NULL DEFAULT '0',
  `vest_dt_inscricao` date NOT NULL DEFAULT '0000-00-00',
  `vest_dt_encerramento` date NOT NULL,
  `vest_dt_resultado` date NOT NULL,
  `vest_tx_inicio` varchar(6) NOT NULL,
  `vest_tx_fim` varchar(6) NOT NULL,
  PRIMARY KEY (`vestibular_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=498 ;

--
-- Extraindo dados da tabela `vestibular`
--

INSERT INTO `vestibular` (`vestibular_id`, `vest_nb_ano`, `vest_dt_realizacao`, `vest_tx_semestre`, `vest_nb_tipo`, `vest_dt_inscricao`, `vest_dt_encerramento`, `vest_dt_resultado`, `vest_tx_inicio`, `vest_tx_fim`) VALUES
(496, '2015', '2015-04-28', 'II', 1, '2015-04-23', '2015-04-23', '2015-04-30', '14:15', '17:15'),
(497, '2015', '2015-04-29', 'I', 2, '2015-04-23', '2015-04-23', '2015-04-30', '14:15', '17:15');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `acessos`
--
ALTER TABLE `acessos`
  ADD CONSTRAINT `fk_acessos_menus1` FOREIGN KEY (`menus_id`) REFERENCES `menus` (`menus_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_acessos_perfis1` FOREIGN KEY (`perfis_id`) REFERENCES `perfis` (`perfis_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `bolsa_periodo`
--
ALTER TABLE `bolsa_periodo`
  ADD CONSTRAINT `fk_bolsa_periodo_bolsas1` FOREIGN KEY (`bolsas_id`) REFERENCES `bolsas` (`bolsas_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bolsa_periodo_periodo_letivo1` FOREIGN KEY (`periodo_letivo_id`) REFERENCES `periodo_letivo` (`periodo_letivo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `candidato`
--
ALTER TABLE `candidato`
  ADD CONSTRAINT `fk_candidato_vestibular` FOREIGN KEY (`vest_nb_codigo`) REFERENCES `vestibular` (`vestibular_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `chamada_vestibular`
--
ALTER TABLE `chamada_vestibular`
  ADD CONSTRAINT `fk_chamada_vestibular_vestibular1` FOREIGN KEY (`vest_nb_codigo`) REFERENCES `vestibular` (`vestibular_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `fk_curso_instituicao1` FOREIGN KEY (`instituicao_id`) REFERENCES `instituicao` (`instituicao_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `dados_censo_aluno`
--
ALTER TABLE `dados_censo_aluno`
  ADD CONSTRAINT `fk_dados_censo_aluno_cadastro_aluno1` FOREIGN KEY (`cadastro_aluno_id`) REFERENCES `cadastro_aluno` (`cadastro_aluno_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `dados_censo_vinculo_curso`
--
ALTER TABLE `dados_censo_vinculo_curso`
  ADD CONSTRAINT `fk_dados_censo_vinculo_curso_matricula_aluno1` FOREIGN KEY (`matricula_aluno_id`) REFERENCES `matricula_aluno` (`matricula_aluno_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `fk_disciplina_cursos1` FOREIGN KEY (`cursos_id`) REFERENCES `cursos` (`cursos_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `etapa`
--
ALTER TABLE `etapa`
  ADD CONSTRAINT `fk_etapa_etapa_periodo1` FOREIGN KEY (`etapa_periodo_id`) REFERENCES `etapa_periodo` (`etapa_periodo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `etapa_periodo`
--
ALTER TABLE `etapa_periodo`
  ADD CONSTRAINT `fk_etapa_periodo_periodo_letivo1` FOREIGN KEY (`periodo_letivo_id`) REFERENCES `periodo_letivo` (`periodo_letivo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `fk_logs_acoes1` FOREIGN KEY (`acoes_id`) REFERENCES `acoes` (`acoes_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_logs_usuario` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`usuarios_id`);

--
-- Limitadores para a tabela `matricula_aluno`
--
ALTER TABLE `matricula_aluno`
  ADD CONSTRAINT `fk_matricula_aluno_cadastro_aluno1` FOREIGN KEY (`cadastro_aluno_id`) REFERENCES `cadastro_aluno` (`cadastro_aluno_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_matricula_aluno_curso1` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`cursos_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `matricula_aluno_turma`
--
ALTER TABLE `matricula_aluno_turma`
  ADD CONSTRAINT `fk_matricula_turma_matricula_aluno1` FOREIGN KEY (`matricula_aluno_id`) REFERENCES `matricula_aluno` (`matricula_aluno_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_matricula_turma_turma1` FOREIGN KEY (`turma_id`) REFERENCES `turma` (`turma_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `matriz`
--
ALTER TABLE `matriz`
  ADD CONSTRAINT `fk_matriz_curso1` FOREIGN KEY (`cursos_id`) REFERENCES `cursos` (`cursos_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `matriz_disciplina`
--
ALTER TABLE `matriz_disciplina`
  ADD CONSTRAINT `fk_matriz_disciplina_disciplina1` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplina` (`disciplina_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_matriz_disciplina_matriz1` FOREIGN KEY (`matriz_id`) REFERENCES `matriz` (`matriz_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `mensalidades`
--
ALTER TABLE `mensalidades`
  ADD CONSTRAINT `fk_mensalidades_matricula_aluno_turma1` FOREIGN KEY (`matricula_aluno_turma_id`) REFERENCES `matricula_aluno_turma` (`matricula_aluno_turma_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `fk_menus_modulos1` FOREIGN KEY (`modulos_id`) REFERENCES `modulos` (`modulos_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD CONSTRAINT `fk_pagamentos_mensalidades1` FOREIGN KEY (`mensalidades_id`) REFERENCES `mensalidades` (`mensalidades_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `professor_turma`
--
ALTER TABLE `professor_turma`
  ADD CONSTRAINT `FK_professor_turma_2` FOREIGN KEY (`turma_id`) REFERENCES `turma` (`turma_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_professor_turma_matriz_disciplina` FOREIGN KEY (`matriz_disciplina_id`) REFERENCES `matriz_disciplina` (`matriz_disciplina_id`),
  ADD CONSTRAINT `fk_professor_turma_teacher1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `sub_menus`
--
ALTER TABLE `sub_menus`
  ADD CONSTRAINT `fk_sub_menus_menus1` FOREIGN KEY (`menus_id`) REFERENCES `menus` (`menus_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `fk_turma_matriz1` FOREIGN KEY (`matriz_id`) REFERENCES `matriz` (`matriz_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_turma_periodo1` FOREIGN KEY (`periodo_id`) REFERENCES `periodo` (`periodo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_turma_periodo_letivo1` FOREIGN KEY (`periodo_letivo_id`) REFERENCES `periodo_letivo` (`periodo_letivo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_turma_turno1` FOREIGN KEY (`turno_id`) REFERENCES `turno` (`turno_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `FK_usuarios_2` FOREIGN KEY (`perfis_id`) REFERENCES `perfis` (`perfis_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
