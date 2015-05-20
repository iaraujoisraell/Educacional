-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.6.15-log


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema educacional
--

CREATE DATABASE IF NOT EXISTS educacional;
USE educacional;

--
-- Definition of table `acessos`
--

DROP TABLE IF EXISTS `acessos`;
CREATE TABLE `acessos` (
  `acessos_id` int(11) NOT NULL AUTO_INCREMENT,
  `menus_id` int(11) NOT NULL,
  `perfis_id` int(11) NOT NULL,
  PRIMARY KEY (`acessos_id`),
  KEY `fk_acessos_menus1_idx` (`menus_id`),
  KEY `fk_acessos_perfis1_idx` (`perfis_id`),
  CONSTRAINT `fk_acessos_menus1` FOREIGN KEY (`menus_id`) REFERENCES `menus` (`menus_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_acessos_perfis1` FOREIGN KEY (`perfis_id`) REFERENCES `perfis` (`perfis_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acessos`
--

/*!40000 ALTER TABLE `acessos` DISABLE KEYS */;
INSERT INTO `acessos` (`acessos_id`,`menus_id`,`perfis_id`) VALUES 
 (1,23,11),
 (2,24,11),
 (3,25,11),
 (4,19,11),
 (6,26,11),
 (7,28,11),
 (8,30,11);
/*!40000 ALTER TABLE `acessos` ENABLE KEYS */;


--
-- Definition of table `acoes`
--

DROP TABLE IF EXISTS `acoes`;
CREATE TABLE `acoes` (
  `acoes_id` int(11) NOT NULL AUTO_INCREMENT,
  `aca_tx_descricao` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`acoes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acoes`
--

/*!40000 ALTER TABLE `acoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `acoes` ENABLE KEYS */;


--
-- Definition of table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `level` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`admin_id`,`name`,`email`,`password`,`level`) VALUES 
 (1,'Mr. Admin','admin@admin','admin','1');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;


--
-- Definition of table `bolsa_periodo`
--

DROP TABLE IF EXISTS `bolsa_periodo`;
CREATE TABLE `bolsa_periodo` (
  `bolsa_periodo_id` int(11) NOT NULL AUTO_INCREMENT,
  `periodo_letivo_id` int(11) NOT NULL,
  `bolsas_id` int(11) NOT NULL,
  PRIMARY KEY (`bolsa_periodo_id`),
  KEY `fk_bolsa_periodo_periodo_letivo1` (`periodo_letivo_id`),
  KEY `fk_bolsa_periodo_bolsas1` (`bolsas_id`),
  CONSTRAINT `fk_bolsa_periodo_bolsas1` FOREIGN KEY (`bolsas_id`) REFERENCES `bolsas` (`bolsas_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_bolsa_periodo_periodo_letivo1` FOREIGN KEY (`periodo_letivo_id`) REFERENCES `periodo_letivo` (`periodo_letivo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bolsa_periodo`
--

/*!40000 ALTER TABLE `bolsa_periodo` DISABLE KEYS */;
/*!40000 ALTER TABLE `bolsa_periodo` ENABLE KEYS */;


--
-- Definition of table `bolsas`
--

DROP TABLE IF EXISTS `bolsas`;
CREATE TABLE `bolsas` (
  `bolsas_id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(250) NOT NULL COMMENT 'Nome da Bolsa:\n\n\nBolsa Universidade,\nFIES, ETc.',
  `porcentagem_minima` double NOT NULL COMMENT 'a porcentagem mínima da bolsa:\n\n20%, 30%',
  `porcentagem_maxima` double NOT NULL COMMENT 'a porcentagem máxima da bolsa,\n\n50%, 100%.',
  PRIMARY KEY (`bolsas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bolsas`
--

/*!40000 ALTER TABLE `bolsas` DISABLE KEYS */;
INSERT INTO `bolsas` (`bolsas_id`,`descricao`,`porcentagem_minima`,`porcentagem_maxima`) VALUES 
 (1,'bolsa universidade',49,55),
 (2,'Pro Uni',60,70),
 (3,'Bolsa Faculdade',30,20);
/*!40000 ALTER TABLE `bolsas` ENABLE KEYS */;


--
-- Definition of table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE `book` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `author` longtext COLLATE utf8_unicode_ci NOT NULL,
  `class_id` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` longtext COLLATE utf8_unicode_ci NOT NULL,
  `price` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `book`
--

/*!40000 ALTER TABLE `book` DISABLE KEYS */;
INSERT INTO `book` (`book_id`,`name`,`description`,`author`,`class_id`,`status`,`price`) VALUES 
 (1,'Camisa','df','df','4','unavailable','1300');
/*!40000 ALTER TABLE `book` ENABLE KEYS */;


--
-- Definition of table `candidato`
--

DROP TABLE IF EXISTS `candidato`;
CREATE TABLE `candidato` (
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
  KEY `fk_candidato_vestibular_idx` (`vest_nb_codigo`),
  CONSTRAINT `fk_candidato_vestibular` FOREIGN KEY (`vest_nb_codigo`) REFERENCES `vestibular` (`vestibular_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `candidato`
--

/*!40000 ALTER TABLE `candidato` DISABLE KEYS */;
INSERT INTO `candidato` (`candidato_id`,`nome`,`can_ch_sexo`,`can_tx_cpf`,`can_tx_rg`,`can_tx_orgaoRg`,`can_tx_ufRg`,`can_tx_pai`,`can_tx_mae`,`can_dt_dtNasc`,`can_tx_email`,`can_tx_necessidade`,`can_tx_endereco`,`can_tx_bairro`,`can_tx_cidade`,`can_ch_uf`,`can_tx_cep`,`can_tx_complemento`,`can_tx_telefone`,`can_tx_celular`,`can_tx_op01`,`can_tx_op02`,`can_tx_data`,`can_tx_hora`,`can_tx_mao`,`can_tx_profissao`,`can_tx_nome_amigo`,`can_tx_curso_amigo`,`can_tx_periodo_amigo`,`can_tx_formacao`,`can_tx_nacionalidade`,`can_tx_outros_contatos`,`can_tx_turno01`,`can_tx_turno02`,`can_tx_naturalidade`,`can_ch_estvic`,`can_tx_conjuje`,`can_tx_cert_reserv`,`can_tx_uf_cert_reserv`,`can_tx_titulo`,`can_tx_uf_titulo`,`can_tx_uf_nasc`,`can_tx_se_irmaos`,`can_tx_se_filhos`,`can_tx_se_etnia`,`can_tx_se_moradia`,`can_tx_se_renda`,`can_tx_se_membros`,`can_tx_se_trabalhando`,`can_tx_se_uf_ef`,`can_tx_se_bolsa`,`can_tx_se_uf_em`,`can_tx_se_ch`,`can_tx_integralizacao01`,`can_tx_integralizacao02`,`can_tx_ciente`,`can_nb_referencia`,`vest_nb_codigo`) VALUES 
 (1,'Mario Jose da Silva','M','003.075.612-08','2410129-0','SSP','AM',NULL,'Maria Jose da Silva','1991-10-03','mario@hotmail.com',NULL,'Rua: Sátiro Dias ','São Francisco','Manaus','AM','69079060','CASA','(92) 3664-5199','(92)8195-9014',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','','','','',NULL,NULL,496),
 (3,'Karoline Ingrid de Oliveira Avinte','F','003.075.612-08','2410129-0','SSP','AM',NULL,'Joana da Silva','1992-10-03','joana_silva@hotmail.com',NULL,'Rua: Sátiro Dias','São Francisco','Manaus','AM','69079060','CASA','(92) 3664-5166','(92)8195-9014',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','','','','',NULL,NULL,496),
 (5,'Pedro Martins','M','145.058.658-09','2018745-0','SSP','AM',NULL,'Carmen Silva','1993-10-03','pedro@gmail.com',NULL,'Rua: Pimenta Bueno','São Francisco','Manaus','AM','69014107','APARTAMENTO','(92) 3664-5688','(92)8270-2518',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','','','','',NULL,NULL,497),
 (6,'Leonardo Menezes Silva','M','676.443.123-00','4355665-7','SSP','AM',NULL,'Joana Martins','1991-05-05','teste@teste.com',NULL,'Rua: Pimenta Bueno','São Francisco','Manaus','AM','69014107','APARTAMENTO','(92) 3664-5688','(92)8270-2518',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','','','','','','','','','','',NULL,NULL,497);
/*!40000 ALTER TABLE `candidato` ENABLE KEYS */;


--
-- Definition of table `chamada_vestibular`
--

DROP TABLE IF EXISTS `chamada_vestibular`;
CREATE TABLE `chamada_vestibular` (
  `chamada_vestibular_id` int(11) NOT NULL AUTO_INCREMENT,
  `cv_nb_resposta` int(11) NOT NULL,
  `can_nb_codigo` int(11) NOT NULL,
  `cv_tx_ponto_prova` varchar(5) DEFAULT NULL,
  `cv_tx_ponto_redacao` varchar(5) DEFAULT NULL,
  `cv_nb_aprovado` int(11) DEFAULT NULL COMMENT '0- reprovado;\n1- Aprovado;',
  `vest_nb_codigo` int(11) NOT NULL,
  PRIMARY KEY (`chamada_vestibular_id`),
  KEY `fk_chamada_vestibular_candidato1` (`can_nb_codigo`),
  KEY `fk_chamada_vestibular_vestibular1_idx` (`vest_nb_codigo`),
  CONSTRAINT `fk_chamada_vestibular_vestibular1` FOREIGN KEY (`vest_nb_codigo`) REFERENCES `vestibular` (`vestibular_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chamada_vestibular`
--

/*!40000 ALTER TABLE `chamada_vestibular` DISABLE KEYS */;
INSERT INTO `chamada_vestibular` (`chamada_vestibular_id`,`cv_nb_resposta`,`can_nb_codigo`,`cv_tx_ponto_prova`,`cv_tx_ponto_redacao`,`cv_nb_aprovado`,`vest_nb_codigo`) VALUES 
 (1,1,6,NULL,NULL,NULL,497),
 (2,0,5,NULL,NULL,NULL,497),
 (3,1,3,NULL,NULL,NULL,496),
 (4,0,1,NULL,NULL,NULL,496);
/*!40000 ALTER TABLE `chamada_vestibular` ENABLE KEYS */;


--
-- Definition of table `class`
--

DROP TABLE IF EXISTS `class`;
CREATE TABLE `class` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `name_numeric` longtext COLLATE utf8_unicode_ci NOT NULL,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `class`
--

/*!40000 ALTER TABLE `class` DISABLE KEYS */;
INSERT INTO `class` (`class_id`,`name`,`name_numeric`,`teacher_id`) VALUES 
 (4,'3º Ano','3',2),
 (5,'ELETRONICA DE BANCADA','01',8),
 (6,'PÓS-ENFERMAGEM','PÓS-ENFERMAGEM',8),
 (7,'11','11',2),
 (8,'Avançado em Teologia Turma 1','Curso Teologia Tarde',3),
 (11,'Teste','Teste',3);
/*!40000 ALTER TABLE `class` ENABLE KEYS */;


--
-- Definition of table `class_routine`
--

DROP TABLE IF EXISTS `class_routine`;
CREATE TABLE `class_routine` (
  `class_routine_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `time_start` int(11) NOT NULL,
  `time_end` int(11) NOT NULL,
  `day` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`class_routine_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `class_routine`
--

/*!40000 ALTER TABLE `class_routine` DISABLE KEYS */;
INSERT INTO `class_routine` (`class_routine_id`,`class_id`,`subject_id`,`time_start`,`time_end`,`day`) VALUES 
 (1,1,0,14,16,'monday'),
 (2,2,1,2,4,'monday'),
 (3,2,1,24,13,'sunday'),
 (4,5,1,24,13,'sunday'),
 (5,4,1,9,10,'tuesday'),
 (6,5,1,0,0,'sunday'),
 (7,2,1,12,16,'thursday'),
 (8,8,2,20,21,'tuesday'),
 (9,4,1,0,0,'monday'),
 (10,4,2,1,4,'sunday');
/*!40000 ALTER TABLE `class_routine` ENABLE KEYS */;


--
-- Definition of table `cursos`
--

DROP TABLE IF EXISTS `cursos`;
CREATE TABLE `cursos` (
  `cursos_id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `cur_tx_descricao` varchar(100) NOT NULL,
  `cur_tx_duracao` varchar(10) DEFAULT NULL,
  `cur_tx_abreviatura` varchar(10) DEFAULT NULL,
  `cur_nb_ativ_comp_obrigatoria` int(11) DEFAULT '0',
  `cur_nb_estagio_obrigatoria` int(11) DEFAULT '0',
  `cur_fl_valor` double DEFAULT '0',
  `cur_tx_habilitacao` varchar(200) DEFAULT NULL,
  `cur_tx_coordenador` varchar(250) DEFAULT NULL,
  `instituicao_id` int(11) NOT NULL,
  `modalidade` int(11) DEFAULT NULL COMMENT '1 - Presencial\n2 - A Distancia',
  PRIMARY KEY (`cursos_id`) USING BTREE,
  KEY `fk_curso_instituicao1` (`instituicao_id`),
  CONSTRAINT `fk_curso_instituicao1` FOREIGN KEY (`instituicao_id`) REFERENCES `instituicao` (`instituicao_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cursos`
--

/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
INSERT INTO `cursos` (`cursos_id`,`cur_tx_descricao`,`cur_tx_duracao`,`cur_tx_abreviatura`,`cur_nb_ativ_comp_obrigatoria`,`cur_nb_estagio_obrigatoria`,`cur_fl_valor`,`cur_tx_habilitacao`,`cur_tx_coordenador`,`instituicao_id`,`modalidade`) VALUES 
 (0000000001,'ADMINISTRAÇÃO','8','ADM',400,400,500,'ADMINISTRAÇÃO','Prof. José Carlos',1,NULL),
 (0000000003,'PEDAGOGIA','8','PED',200,200,400,'PEDAGOGO','Profa. Elda',1,NULL);
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;


--
-- Definition of table `email_template`
--

DROP TABLE IF EXISTS `email_template`;
CREATE TABLE `email_template` (
  `email_template_id` int(11) NOT NULL AUTO_INCREMENT,
  `task` longtext COLLATE utf8_unicode_ci NOT NULL,
  `subject` longtext COLLATE utf8_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`email_template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email_template`
--

/*!40000 ALTER TABLE `email_template` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_template` ENABLE KEYS */;


--
-- Definition of table `etapa`
--

DROP TABLE IF EXISTS `etapa`;
CREATE TABLE `etapa` (
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
  KEY `fk_etapa_etapa_periodo1` (`etapa_periodo_id`),
  CONSTRAINT `fk_etapa_etapa_periodo1` FOREIGN KEY (`etapa_periodo_id`) REFERENCES `etapa_periodo` (`etapa_periodo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `etapa`
--

/*!40000 ALTER TABLE `etapa` DISABLE KEYS */;
/*!40000 ALTER TABLE `etapa` ENABLE KEYS */;


--
-- Definition of table `etapa_periodo`
--

DROP TABLE IF EXISTS `etapa_periodo`;
CREATE TABLE `etapa_periodo` (
  `etapa_periodo_id` int(11) NOT NULL AUTO_INCREMENT,
  `periodo_letivo_id` int(11) NOT NULL,
  `media_notas` double NOT NULL COMMENT 'A média para aprovação',
  `porcentagem_faltas` int(11) NOT NULL COMMENT 'A porcentagem de falta permitida, ex:\n\n25%, acima disso, seria reprovado.',
  PRIMARY KEY (`etapa_periodo_id`),
  KEY `fk_etapa_periodo_periodo_letivo1` (`periodo_letivo_id`),
  CONSTRAINT `fk_etapa_periodo_periodo_letivo1` FOREIGN KEY (`periodo_letivo_id`) REFERENCES `periodo_letivo` (`periodo_letivo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `etapa_periodo`
--

/*!40000 ALTER TABLE `etapa_periodo` DISABLE KEYS */;
/*!40000 ALTER TABLE `etapa_periodo` ENABLE KEYS */;


--
-- Definition of table `grade`
--

DROP TABLE IF EXISTS `grade`;
CREATE TABLE `grade` (
  `grade_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `grade_point` longtext COLLATE utf8_unicode_ci NOT NULL,
  `mark_from` int(11) NOT NULL,
  `mark_upto` int(11) NOT NULL,
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`grade_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `grade`
--

/*!40000 ALTER TABLE `grade` DISABLE KEYS */;
INSERT INTO `grade` (`grade_id`,`name`,`grade_point`,`mark_from`,`mark_upto`,`comment`) VALUES 
 (1,'Lucas','10',6,5,''),
 (3,'Jonas','5',7,9,'moderado'),
 (4,'Fabio','asdf',7,10,'teste'),
 (5,'Anatomia','10',10,6,'ok'),
 (6,'Aulas EM','',0,0,'');
/*!40000 ALTER TABLE `grade` ENABLE KEYS */;


--
-- Definition of table `instituicao`
--

DROP TABLE IF EXISTS `instituicao`;
CREATE TABLE `instituicao` (
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instituicao`
--

/*!40000 ALTER TABLE `instituicao` DISABLE KEYS */;
INSERT INTO `instituicao` (`instituicao_id`,`nome_abreviatura`,`nome_instituicao`,`logo_instituicao`,`id_inep`,`tipo_registro`,`tipo_arquivo`,`endereco`,`contato`,`email`,`site`,`cnpj`,`ie`,`im`) VALUES 
 (1,'FBN','Faculdade Boas Novas',NULL,NULL,40,42,'Gen. Rodrigo Octávio 1655','92 32372214','contato@fbnovas.edu.br','www.fbnovas.edu.br',NULL,NULL,NULL);
/*!40000 ALTER TABLE `instituicao` ENABLE KEYS */;


--
-- Definition of table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `creation_timestamp` int(11) NOT NULL,
  `payment_timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  `payment_method` longtext COLLATE utf8_unicode_ci NOT NULL,
  `payment_details` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'paid or unpaid',
  PRIMARY KEY (`invoice_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoice`
--

/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
INSERT INTO `invoice` (`invoice_id`,`student_id`,`title`,`description`,`amount`,`creation_timestamp`,`payment_timestamp`,`payment_method`,`payment_details`,`status`) VALUES 
 (1,4,'Cartão','Boleto',1,1420610400,'','','','paid'),
 (2,3,'boleto','teste descricao',100,1423029600,'','','','paid'),
 (4,1,'','Mensalidade',500,1425535200,'','','','paid'),
 (3,6,'Teste','teste',0,1424584800,'','','','paid'),
 (5,1,'aaaaaa','aaaa',200,1425362400,'','','','paid'),
 (6,1,'','',0,0,'','','','paid'),
 (7,2,'','',0,0,'','','','unpaid'),
 (8,1,'1','PARCELA 01 ',550,1424757600,'','','','paid'),
 (9,4,'','',0,-64800,'','','','unpaid');
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;


--
-- Definition of table `language`
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE `language` (
  `phrase_id` int(11) NOT NULL AUTO_INCREMENT,
  `phrase` longtext COLLATE utf8_unicode_ci NOT NULL,
  `Portugues` longtext COLLATE utf8_unicode_ci NOT NULL,
  `Português` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`phrase_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2181 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `language`
--

/*!40000 ALTER TABLE `language` DISABLE KEYS */;
INSERT INTO `language` (`phrase_id`,`phrase`,`Portugues`,`Português`) VALUES 
 (1,'login','Login',''),
 (2,'account_type','Tipo da Conta',''),
 (3,'admin','Administrador',''),
 (4,'teacher','Professor',''),
 (5,'student','Aluno',''),
 (6,'parent','Responsável',''),
 (7,'email','Email',''),
 (8,'password','Senha',''),
 (9,'forgot_password ?','Esqueceu sua Senha?',''),
 (10,'reset_password','Resetar a Senha',''),
 (11,'reset','Resetar',''),
 (12,'admin_dashboard','Painel de Administração',''),
 (13,'account','Conta',''),
 (14,'profile','Perfil',''),
 (15,'change_password','Alterar Senha',''),
 (16,'logout','Sair',''),
 (17,'panel','Painel',''),
 (18,'dashboard_help','Carregar o Dashboard',''),
 (19,'dashboard','Administração',''),
 (20,'student_help','Carregar os Alunos',''),
 (21,'teacher_help','Carregar os Professores',''),
 (22,'subject_help','Carregar os Assuntos',''),
 (23,'subject','Assunto',''),
 (24,'class_help','Carregar as Turmas',''),
 (25,'class','Turma',''),
 (26,'exam_help','Carregar as Avaliações',''),
 (27,'exam','Avaliações',''),
 (28,'marks_help','Carregar os Agendamentos de Atendimentos',''),
 (29,'marks-attendance','Agenda de atendimento',''),
 (30,'grade_help','Carregar as Grades',''),
 (31,'exam-grade','Grade de Avaliações',''),
 (32,'class_routine_help','Carregar as Turmas',''),
 (33,'class_routine','Rotina da Turma',''),
 (34,'invoice_help','Carregar as Faturas',''),
 (35,'payment','Pagamento',''),
 (36,'book_help','Carregar os Livros',''),
 (37,'library','Biblioteca',''),
 (38,'transport_help','Carregar os Transportes',''),
 (39,'transport','Transporte',''),
 (40,'dormitory_help','Carregar os Dormitórios',''),
 (41,'dormitory','Dormitório',''),
 (42,'noticeboard_help','Carregar Quadro de Avisos',''),
 (43,'noticeboard-event','Painel de Eventos',''),
 (44,'bed_ward_help','Carregarr Configurações',''),
 (45,'settings','Definições',''),
 (46,'system_settings','Configuração do Sistema',''),
 (47,'manage_language','Gerenciar Idiomas',''),
 (48,'backup_restore','Backup/Restaurar',''),
 (49,'profile_help','Carregar os Perfis',''),
 (50,'Gerenciar Alunos','Gerenciar Alunos',''),
 (51,'manage_teacher','Gerenciar Professores',''),
 (52,'noticeboard','Quadro de avisos',''),
 (53,'language','Idioma',''),
 (54,'backup','Backup',''),
 (55,'calendar_schedule','Agenda',''),
 (56,'select_a_class','Selecionar a Classe',''),
 (57,'student_list','Lista de Alunos',''),
 (58,'add_student','Adicionar Aluno',''),
 (59,'roll','Movimentar',''),
 (60,'photo','Foto',''),
 (61,'student_name','Nome Estudante',''),
 (62,'address','Endereço',''),
 (63,'options','Opções',''),
 (64,'marksheet','Folha',''),
 (65,'id_card','Cartão',''),
 (66,'edit','Editar',''),
 (67,'delete','Deletar',''),
 (68,'personal_profile','Perfil do Profissional',''),
 (69,'academic_result','Resultado Acadêmico',''),
 (70,'name','Nome',''),
 (71,'birthday','Aniversário',''),
 (72,'sex','Sexo',''),
 (73,'male','Maculino',''),
 (74,'female','Feminino',''),
 (75,'religion','Religião',''),
 (76,'blood_group','Grupo Sanguíneo',''),
 (77,'phone','Telefone',''),
 (78,'father_name','Nome do Pai',''),
 (79,'mother_name','Nome da mãe',''),
 (80,'edit_student','Editar Aluno',''),
 (81,'teacher_list','Lista de Professores',''),
 (82,'add_teacher','Adicionar Professor',''),
 (83,'teacher_name','Nome do Professor',''),
 (84,'edit_teacher','Editar Professor',''),
 (85,'manage_parent','Gerenciar Responsáveis',''),
 (86,'parent_list','Lista de Responsáveis',''),
 (87,'parent_name','Nome do Responsável',''),
 (88,'relation_with_student','Relacionamento com o Aluno',''),
 (89,'parent_email','Email do Responsável',''),
 (90,'parent_phone','Telefone do Responsável',''),
 (91,'parrent_address','Endereço do Responsável',''),
 (92,'parrent_occupation','Ocupação do Responsável',''),
 (93,'add','Adicionar',''),
 (94,'parent_of','Responsável de',''),
 (95,'profession','Profissão',''),
 (96,'edit_parent','Editar Responsável',''),
 (97,'add_parent','Adicionar Responsável',''),
 (98,'manage_subject','Gerenciar Assuntos',''),
 (99,'subject_list','Lista de Assuntos',''),
 (100,'add_subject','Adicionar Assunto',''),
 (101,'subject_name','Nome da Assunto',''),
 (102,'edit_subject','Editar Assunto',''),
 (103,'manage_class','Gerenciar Turmas',''),
 (104,'class_list','Lista de Turmas',''),
 (105,'add_class','Adicionar Turma',''),
 (106,'class_name','Nome da Turma',''),
 (107,'numeric_name','Número da Turma',''),
 (108,'name_numeric','Descrição da Truma',''),
 (109,'edit_class','Editar Turma',''),
 (110,'manage_exam','Gerenciar Avaliações',''),
 (111,'exam_list','Lista de Avaliações',''),
 (112,'add_exam','Adicionar Avaliação',''),
 (113,'exam_name','Nome da Avaliação',''),
 (114,'date','Data',''),
 (115,'comment','Comentário',''),
 (116,'edit_exam','Editar Avaliação',''),
 (117,'manage_exam_marks','Gerenciar Marcação de Avaliação',''),
 (118,'manage_marks','Gerenciar Marcas',''),
 (119,'select_exam','Selecionar Avaliação',''),
 (120,'select_class','Selecionar Turma',''),
 (121,'select_subject','Selecione Assunto',''),
 (122,'select_an_exam','Selecione uma Avaliação',''),
 (123,'mark_obtained','Marcação Obtida',''),
 (124,'attendance','Atendimento',''),
 (125,'manage_grade','Gerenciar Grade',''),
 (126,'grade_list','Lista de Grade',''),
 (127,'add_grade','Adicionar Grade',''),
 (128,'grade_name','Nome da Grade',''),
 (129,'grade_point','',''),
 (130,'mark_from','',''),
 (131,'mark_upto','',''),
 (132,'edit_grade','Editar Grade',''),
 (133,'manage_class_routine','Gerenciar Rotina da Turma',''),
 (134,'class_routine_list','Lista de Rotinas das Turmas',''),
 (135,'add_class_routine','Adicionar Rotina de Turma',''),
 (136,'day','Dia',''),
 (137,'starting_time','Hora Início',''),
 (138,'ending_time','Hora Fim',''),
 (139,'edit_class_routine','Editar Rotina de Classe',''),
 (140,'manage_invoice/payment','Gerenciar Pagamentos',''),
 (141,'invoice/payment_list','Lista de Pagamentos',''),
 (142,'add_invoice/payment','Adicionar Pagamento',''),
 (143,'title','Título',''),
 (144,'description','Descrição',''),
 (145,'amount','Valor',''),
 (146,'status','Situação',''),
 (147,'view_invoice','Visualizar  Recibo',''),
 (148,'paid','Pago',''),
 (149,'unpaid','Não Pago',''),
 (150,'add_invoice','Adicionar Pagamento',''),
 (151,'payment_to','Pagamento',''),
 (152,'bill_to','Cliente',''),
 (153,'invoice_title','Título da Fatura',''),
 (154,'invoice_id','Nº. da Fatura',''),
 (155,'edit_invoice','Editar Fatura',''),
 (156,'manage_library_books','Gerenciar Biblioteca',''),
 (157,'book_list','Lista de Livros',''),
 (158,'add_book','Adicionar Livro',''),
 (159,'book_name','Título do Livro',''),
 (160,'author','Autor',''),
 (161,'price','Preço',''),
 (162,'available','Disponível',''),
 (163,'unavailable','Indisponível',''),
 (164,'edit_book','Editar Livro',''),
 (165,'manage_transport','Gerenciar Transporte',''),
 (166,'transport_list','Lista de Transportes',''),
 (167,'add_transport','Adicionar Transporte',''),
 (168,'route_name','Descrição da Rota',''),
 (169,'number_of_vehicle','Placa do Veículo',''),
 (170,'route_fare','Tarifa',''),
 (171,'edit_transport','Editar Transporte',''),
 (172,'manage_dormitory','Gerenciar Dormitório',''),
 (173,'dormitory_list','Lista de Dormitórios',''),
 (174,'add_dormitory','Adicionar Dormitório',''),
 (175,'dormitory_name','Descrição do Dormitórios',''),
 (176,'number_of_room','Número do Quarto',''),
 (177,'manage_noticeboard','Gerenciar Quadro de Avisos',''),
 (178,'noticeboard_list','Lista de Quadro de Avisos',''),
 (179,'add_noticeboard','Adicionar Quadro de Avisos',''),
 (180,'notice','Aviso',''),
 (181,'add_notice','Adicionar Aviso',''),
 (182,'edit_noticeboard','Editar Quadro de Avisos',''),
 (183,'system_name','Nome do Sistema',''),
 (184,'save','Salvar',''),
 (185,'system_title','Título do Sistema',''),
 (186,'paypal_email','Email Para Pagamento',''),
 (187,'currency','Modeda',''),
 (188,'phrase_list','Lista de Frases',''),
 (189,'add_phrase','Adicionar Frase',''),
 (190,'add_language','Adicionar Idioma',''),
 (191,'phrase','Frase',''),
 (192,'manage_backup_restore','Gerenciar Backup/Restaurar',''),
 (193,'restore','Restarar',''),
 (194,'mark','Marcação',''),
 (195,'grade','Grade',''),
 (196,'invoice','Fatura',''),
 (197,'book','Livro',''),
 (198,'all','Todos',''),
 (199,'upload_&_restore_from_backup','Upload para Restaurar Backup',''),
 (200,'manage_profile','Gerenciar Perfil',''),
 (201,'update_profile','Atualizar Perfil',''),
 (202,'new_password','Nova Senha',''),
 (203,'confirm_new_password','Confirmar Nova Senha',''),
 (204,'update_password','Alterar Senha',''),
 (205,'teacher_dashboard','Dashboard do Professor',''),
 (206,'backup_restore_help','Backup/Restaurar',''),
 (207,'student_dashboard','Dashboard do Aluno',''),
 (208,'parent_dashboard','Dashboard do Responsável',''),
 (209,'view_marks','Visualizar Marcação',''),
 (210,'delete_language','Excluir Idioma',''),
 (211,'settings_updated','Configuração Atualizada',''),
 (212,'update_phrase','Alterar Frase',''),
 (213,'login_failed','Falha na Autenticação',''),
 (214,'option','Opções',''),
 (215,'edit_phrase','Editar Frase',''),
 (216,'system_email','Email do Sistema',''),
 (217,'password_updated','Senha Atualizada',''),
 (218,'password_mismatch','Senha Diferente',''),
 (219,'account_not_found','Conta Não encontrada!!',''),
 (220,'account_updated','Atualizar Conta',''),
 (221,'password_sent','Senha Enviada',''),
 (222,'notice_updated','Aviso Atualizado',''),
 (223,'Espanhol','Espanhol',''),
 (238,'gerenciar_estudante','',''),
 (237,'manage_student','',''),
 (236,'fornecedor','',''),
 (235,'vendas','',''),
 (234,'orçamento','',''),
 (233,'clientes','',''),
 (232,'comercial','',''),
 (239,'painel_administrativo','',''),
 (240,'professor','',''),
 (241,'aluno','',''),
 (242,'gerenciar_aluno','',''),
 (243,'alunos','',''),
 (244,'PROCESSO SELETIVO','',''),
 (245,'Processo Seletivo','',''),
 (246,'Processo Seletivo','',''),
 (247,'Processo Seletivo','',''),
 (248,'Processo Seletivo','',''),
 (249,'Financeiro','',''),
 (250,'Processo Seletivo','',''),
 (251,'Processo Seletivo','',''),
 (252,'Processo Seletivo','',''),
 (253,'Processo Seletivo','',''),
 (254,'Processo Seletivo','',''),
 (255,'Processo Seletivo','',''),
 (256,'Processo Seletivo','',''),
 (257,'Processo Seletivo','',''),
 (258,'Processo Seletivo','',''),
 (259,'Processo Seletivo','',''),
 (260,'Processo Seletivo','',''),
 (261,'Processo Seletivo','',''),
 (262,'Processo Seletivo','',''),
 (263,'Processo Seletivo','',''),
 (264,'Processo Seletivo','',''),
 (265,'Processo Seletivo','',''),
 (266,'Processo Seletivo','',''),
 (267,'Processo Seletivo','',''),
 (268,'Processo Seletivo','',''),
 (269,'Processo Seletivo','',''),
 (270,'Processo Seletivo','',''),
 (271,'Processo Seletivo','',''),
 (272,'Processo Seletivo','',''),
 (273,'Processo Seletivo','',''),
 (274,'Processo Seletivo','',''),
 (275,'Processo Seletivo','',''),
 (276,'Processo Seletivo','',''),
 (277,'Processo Seletivo','',''),
 (278,'Processo Seletivo','',''),
 (279,'Processo Seletivo','',''),
 (280,'Processo Seletivo','',''),
 (281,'Processo Seletivo','',''),
 (282,'Processo Seletivo','',''),
 (283,'Processo Seletivo','',''),
 (284,'Processo Seletivo','',''),
 (285,'Processo Seletivo','',''),
 (286,'Processo Seletivo','',''),
 (287,'Processo Seletivo','',''),
 (288,'Processo Seletivo','',''),
 (289,'Processo Seletivo','',''),
 (290,'Processo Seletivo','',''),
 (291,'Processo Seletivo','',''),
 (292,'Processo Seletivo','',''),
 (293,'Processo Seletivo','',''),
 (294,'Processo Seletivo','',''),
 (295,'Processo Seletivo','',''),
 (296,'Processo Seletivo','',''),
 (297,'Processo Seletivo','',''),
 (298,'Processo Seletivo','',''),
 (299,'Processo Seletivo','',''),
 (300,'Processo Seletivo','',''),
 (301,'Processo Seletivo','',''),
 (302,'Processo Seletivo','',''),
 (303,'Processo Seletivo','',''),
 (304,'Processo Seletivo','',''),
 (305,'Processo Seletivo','',''),
 (306,'painel_financeiro','',''),
 (307,'Processo Seletivo','',''),
 (308,'Processo Seletivo','',''),
 (309,'Processo Seletivo','',''),
 (310,'Processo Seletivo','',''),
 (311,'Processo Seletivo','',''),
 (312,'Processo Seletivo','',''),
 (313,'Processo Seletivo','',''),
 (314,'Processo Seletivo','',''),
 (315,'Processo Seletivo','',''),
 (316,'Processo Seletivo','',''),
 (317,'Processo Seletivo','',''),
 (318,'Processo Seletivo','',''),
 (319,'Processo Seletivo','',''),
 (320,'Processo Seletivo','',''),
 (321,'Processo Seletivo','',''),
 (322,'Processo Seletivo','',''),
 (323,'Processo Seletivo','',''),
 (324,'Processo Seletivo','',''),
 (325,'Processo Seletivo','',''),
 (326,'Processo Seletivo','',''),
 (327,'Processo Seletivo','',''),
 (328,'Processo Seletivo','',''),
 (329,'Processo Seletivo','',''),
 (330,'Processo Seletivo','',''),
 (331,'Processo Seletivo','',''),
 (332,'Processo Seletivo','',''),
 (333,'Processo Seletivo','',''),
 (334,'Processo Seletivo','',''),
 (335,'Processo Seletivo','',''),
 (336,'Processo Seletivo','',''),
 (337,'Processo Seletivo','',''),
 (338,'Processo Seletivo','',''),
 (339,'Processo Seletivo','',''),
 (340,'Processo Seletivo','',''),
 (341,'Processo Seletivo','',''),
 (342,'Processo Seletivo','',''),
 (343,'Processo Seletivo','',''),
 (344,'Processo Seletivo','',''),
 (345,'Processo Seletivo','',''),
 (346,'Processo Seletivo','',''),
 (347,'Processo Seletivo','',''),
 (348,'Processo Seletivo','',''),
 (349,'Processo Seletivo','',''),
 (350,'Processo Seletivo','',''),
 (351,'Processo Seletivo','',''),
 (352,'Processo Seletivo','',''),
 (353,'Processo Seletivo','',''),
 (354,'Processo Seletivo','',''),
 (355,'Processo Seletivo','',''),
 (356,'Processo Seletivo','',''),
 (357,'Processo Seletivo','',''),
 (358,'Processo Seletivo','',''),
 (359,'Processo Seletivo','',''),
 (360,'Processo Seletivo','',''),
 (361,'Processo Seletivo','',''),
 (362,'Processo Seletivo','',''),
 (363,'Processo Seletivo','',''),
 (364,'Processo Seletivo','',''),
 (365,'Processo Seletivo','',''),
 (366,'Processo Seletivo','',''),
 (367,'Processo Seletivo','',''),
 (368,'Processo Seletivo','',''),
 (369,'Processo Seletivo','',''),
 (370,'Processo Seletivo','',''),
 (371,'Processo Seletivo','',''),
 (372,'Processo Seletivo','',''),
 (373,'Processo Seletivo','',''),
 (374,'Processo Seletivo','',''),
 (375,'Processo Seletivo','',''),
 (376,'Processo Seletivo','',''),
 (377,'Processo Seletivo','',''),
 (378,'Processo Seletivo','',''),
 (379,'Processo Seletivo','',''),
 (380,'Processo Seletivo','',''),
 (381,'Processo Seletivo','',''),
 (382,'Processo Seletivo','',''),
 (383,'Processo Seletivo','',''),
 (384,'Processo Seletivo','',''),
 (385,'Processo Seletivo','',''),
 (386,'Processo Seletivo','',''),
 (387,'Processo Seletivo','',''),
 (388,'Processo Seletivo','',''),
 (389,'Processo Seletivo','',''),
 (390,'Processo Seletivo','',''),
 (391,'Processo Seletivo','',''),
 (392,'Processo Seletivo','',''),
 (393,'Processo Seletivo','',''),
 (394,'Processo Seletivo','',''),
 (395,'Processo Seletivo','',''),
 (396,'Processo Seletivo','',''),
 (397,'Processo Seletivo','',''),
 (398,'Processo Seletivo','',''),
 (399,'Processo Seletivo','',''),
 (400,'Processo Seletivo','',''),
 (401,'Processo Seletivo','',''),
 (402,'Processo Seletivo','',''),
 (403,'Processo Seletivo','',''),
 (404,'Processo Seletivo','',''),
 (405,'Processo Seletivo','',''),
 (406,'Processo Seletivo','',''),
 (407,'Processo Seletivo','',''),
 (408,'Processo Seletivo','',''),
 (409,'Processo Seletivo','',''),
 (410,'Processo Seletivo','',''),
 (411,'Processo Seletivo','',''),
 (412,'Processo Seletivo','',''),
 (413,'Processo Seletivo','',''),
 (414,'Processo Seletivo','',''),
 (415,'Processo Seletivo','',''),
 (416,'Processo Seletivo','',''),
 (417,'Processo Seletivo','',''),
 (418,'Processo Seletivo','',''),
 (419,'Processo Seletivo','',''),
 (420,'Processo Seletivo','',''),
 (421,'Processo Seletivo','',''),
 (422,'Processo Seletivo','',''),
 (423,'Processo Seletivo','',''),
 (424,'Processo Seletivo','',''),
 (425,'Processo Seletivo','',''),
 (426,'Processo Seletivo','',''),
 (427,'Processo Seletivo','',''),
 (428,'Processo Seletivo','',''),
 (429,'Processo Seletivo','',''),
 (430,'Processo Seletivo','',''),
 (431,'Processo Seletivo','',''),
 (432,'Processo Seletivo','',''),
 (433,'Processo Seletivo','',''),
 (434,'Processo Seletivo','',''),
 (435,'Processo Seletivo','',''),
 (436,'Processo Seletivo','',''),
 (437,'Processo Seletivo','',''),
 (438,'Processo Seletivo','',''),
 (439,'Processo Seletivo','',''),
 (440,'Processo Seletivo','',''),
 (441,'Processo Seletivo','',''),
 (442,'Processo Seletivo','',''),
 (443,'Processo Seletivo','',''),
 (444,'Processo Seletivo','',''),
 (445,'Processo Seletivo','',''),
 (446,'Processo Seletivo','',''),
 (447,'Processo Seletivo','',''),
 (448,'Processo Seletivo','',''),
 (449,'Processo Seletivo','',''),
 (450,'Processo Seletivo','',''),
 (451,'Processo Seletivo','',''),
 (452,'Processo Seletivo','',''),
 (453,'Processo Seletivo','',''),
 (454,'Processo Seletivo','',''),
 (455,'Processo Seletivo','',''),
 (456,'Processo Seletivo','',''),
 (457,'Processo Seletivo','',''),
 (458,'Processo Seletivo','',''),
 (459,'Processo Seletivo','',''),
 (460,'Processo Seletivo','',''),
 (461,'Processo Seletivo','',''),
 (462,'Processo Seletivo','',''),
 (463,'Processo Seletivo','',''),
 (464,'Processo Seletivo','',''),
 (465,'Processo Seletivo','',''),
 (466,'Processo Seletivo','',''),
 (467,'Processo Seletivo','',''),
 (468,'Processo Seletivo','',''),
 (469,'Processo Seletivo','',''),
 (470,'Processo Seletivo','',''),
 (471,'Processo Seletivo','',''),
 (472,'Processo Seletivo','',''),
 (473,'Processo Seletivo','',''),
 (474,'Processo Seletivo','',''),
 (475,'Processo Seletivo','',''),
 (476,'Processo Seletivo','',''),
 (477,'Processo Seletivo','',''),
 (478,'Processo Seletivo','',''),
 (479,'Processo Seletivo','',''),
 (480,'Processo Seletivo','',''),
 (481,'Processo Seletivo','',''),
 (482,'Processo Seletivo','',''),
 (483,'Processo Seletivo','',''),
 (484,'Processo Seletivo','',''),
 (485,'Processo Seletivo','',''),
 (486,'Processo Seletivo','',''),
 (487,'Processo Seletivo','',''),
 (488,'Processo Seletivo','',''),
 (489,'Processo Seletivo','',''),
 (490,'Processo Seletivo','',''),
 (491,'Processo Seletivo','',''),
 (492,'Processo Seletivo','',''),
 (493,'Processo Seletivo','',''),
 (494,'Processo Seletivo','',''),
 (495,'Processo Seletivo','',''),
 (496,'Processo Seletivo','',''),
 (497,'Processo Seletivo','',''),
 (498,'Processo Seletivo','',''),
 (499,'Processo Seletivo','',''),
 (500,'Processo Seletivo','',''),
 (501,'Processo Seletivo','',''),
 (502,'Processo Seletivo','',''),
 (503,'Processo Seletivo','',''),
 (504,'Processo Seletivo','',''),
 (505,'Processo Seletivo','',''),
 (506,'Processo Seletivo','',''),
 (507,'Processo Seletivo','',''),
 (508,'Processo Seletivo','',''),
 (509,'Processo Seletivo','',''),
 (510,'Processo Seletivo','',''),
 (511,'Processo Seletivo','',''),
 (512,'Processo Seletivo','',''),
 (513,'Processo Seletivo','',''),
 (514,'Processo Seletivo','',''),
 (515,'Processo Seletivo','',''),
 (516,'Processo Seletivo','',''),
 (517,'Processo Seletivo','',''),
 (518,'Processo Seletivo','',''),
 (519,'Processo Seletivo','',''),
 (520,'Processo Seletivo','',''),
 (521,'Processo Seletivo','',''),
 (522,'Processo Seletivo','',''),
 (523,'Processo Seletivo','',''),
 (524,'Processo Seletivo','',''),
 (525,'Processo Seletivo','',''),
 (526,'Processo Seletivo','',''),
 (527,'Processo Seletivo','',''),
 (528,'Processo Seletivo','',''),
 (529,'Processo Seletivo','',''),
 (530,'Processo Seletivo','',''),
 (531,'Processo Seletivo','',''),
 (532,'Processo Seletivo','',''),
 (533,'Processo Seletivo','',''),
 (534,'Processo Seletivo','',''),
 (535,'Processo Seletivo','',''),
 (536,'Processo Seletivo','',''),
 (537,'Processo Seletivo','',''),
 (538,'Processo Seletivo','',''),
 (539,'Processo Seletivo','',''),
 (540,'Processo Seletivo','',''),
 (541,'Processo Seletivo','',''),
 (542,'Processo Seletivo','',''),
 (543,'Processo Seletivo','',''),
 (544,'Processo Seletivo','',''),
 (545,'Processo Seletivo','',''),
 (546,'Processo Seletivo','',''),
 (547,'Processo Seletivo','',''),
 (548,'Processo Seletivo','',''),
 (549,'Processo Seletivo','',''),
 (550,'Processo Seletivo','',''),
 (551,'Processo Seletivo','',''),
 (552,'Processo Seletivo','',''),
 (553,'Processo Seletivo','',''),
 (554,'Processo Seletivo','',''),
 (555,'Processo Seletivo','',''),
 (556,'Processo Seletivo','',''),
 (557,'Processo Seletivo','',''),
 (558,'Processo Seletivo','',''),
 (559,'Processo Seletivo','',''),
 (560,'Processo Seletivo','',''),
 (561,'Processo Seletivo','',''),
 (562,'Processo Seletivo','',''),
 (563,'Processo Seletivo','',''),
 (564,'Processo Seletivo','',''),
 (565,'Processo Seletivo','',''),
 (566,'Processo Seletivo','',''),
 (567,'Processo Seletivo','',''),
 (568,'Processo Seletivo','',''),
 (569,'Processo Seletivo','',''),
 (570,'Processo Seletivo','',''),
 (571,'Processo Seletivo','',''),
 (572,'Processo Seletivo','',''),
 (573,'Processo Seletivo','',''),
 (574,'Processo Seletivo','',''),
 (575,'Processo Seletivo','',''),
 (576,'Processo Seletivo','',''),
 (577,'Processo Seletivo','',''),
 (578,'Processo Seletivo','',''),
 (579,'painel_processo_seletivo','',''),
 (580,'Processo Seletivo','',''),
 (581,'Processo Seletivo','',''),
 (582,'Processo Seletivo','',''),
 (583,'Processo Seletivo','',''),
 (584,'Processo Seletivo','',''),
 (585,'Processo Seletivo','',''),
 (586,'Processo Seletivo','',''),
 (587,'Processo Seletivo','',''),
 (588,'Processo Seletivo','',''),
 (589,'Processo Seletivo','',''),
 (590,'Processo Seletivo','',''),
 (591,'Processo Seletivo','',''),
 (592,'Processo Seletivo','',''),
 (593,'Processo Seletivo','',''),
 (594,'Processo Seletivo','',''),
 (595,'Processo Seletivo','',''),
 (596,'Processo Seletivo','',''),
 (597,'Processo Seletivo','',''),
 (598,'Processo Seletivo','',''),
 (599,'Processo Seletivo','',''),
 (600,'Processo Seletivo','',''),
 (601,'Processo Seletivo','',''),
 (602,'Processo Seletivo','',''),
 (603,'Processo Seletivo','',''),
 (604,'Processo Seletivo','',''),
 (605,'Processo Seletivo','',''),
 (606,'Processo Seletivo','',''),
 (607,'Processo Seletivo','',''),
 (608,'Processo Seletivo','',''),
 (609,'Processo Seletivo','',''),
 (610,'Processo Seletivo','',''),
 (611,'Processo Seletivo','',''),
 (612,'Processo Seletivo','',''),
 (613,'Processo Seletivo','',''),
 (614,'Processo Seletivo','',''),
 (615,'Processo Seletivo','',''),
 (616,'Processo Seletivo','',''),
 (617,'Processo Seletivo','',''),
 (618,'Processo Seletivo','',''),
 (619,'Processo Seletivo','',''),
 (620,'Processo Seletivo','',''),
 (621,'Processo Seletivo','',''),
 (622,'Processo Seletivo','',''),
 (623,'Processo Seletivo','',''),
 (624,'Processo Seletivo','',''),
 (625,'Processo Seletivo','',''),
 (626,'Processo Seletivo','',''),
 (627,'Processo Seletivo','',''),
 (628,'Processo Seletivo','',''),
 (629,'Processo Seletivo','',''),
 (630,'Processo Seletivo','',''),
 (631,'Processo Seletivo','',''),
 (632,'Processo Seletivo','',''),
 (633,'Processo Seletivo','',''),
 (634,'Processo Seletivo','',''),
 (635,'Processo Seletivo','',''),
 (636,'Processo Seletivo','',''),
 (637,'Processo Seletivo','',''),
 (638,'Processo Seletivo','',''),
 (639,'Processo Seletivo','',''),
 (640,'Processo Seletivo','',''),
 (641,'Processo Seletivo','',''),
 (642,'Processo Seletivo','',''),
 (643,'Processo Seletivo','',''),
 (644,'Processo Seletivo','',''),
 (645,'Processo Seletivo','',''),
 (646,'Processo Seletivo','',''),
 (647,'Processo Seletivo','',''),
 (648,'Processo Seletivo','',''),
 (649,'Processo Seletivo','',''),
 (650,'Processo Seletivo','',''),
 (651,'Processo Seletivo','',''),
 (652,'Processo Seletivo','',''),
 (653,'Processo Seletivo','',''),
 (654,'Processo Seletivo','',''),
 (655,'Processo Seletivo','',''),
 (656,'Processo Seletivo','',''),
 (657,'Processo Seletivo','',''),
 (658,'Processo Seletivo','',''),
 (659,'Processo Seletivo','',''),
 (660,'Processo Seletivo','',''),
 (661,'Processo Seletivo','',''),
 (662,'Processo Seletivo','',''),
 (663,'Processo Seletivo','',''),
 (664,'Processo Seletivo','',''),
 (665,'Processo Seletivo','',''),
 (666,'Processo Seletivo','',''),
 (667,'Processo Seletivo','',''),
 (668,'Processo Seletivo','',''),
 (669,'Processo Seletivo','',''),
 (670,'Processo Seletivo','',''),
 (671,'Processo Seletivo','',''),
 (672,'Processo Seletivo','',''),
 (673,'Processo Seletivo','',''),
 (674,'Processo Seletivo','',''),
 (675,'Processo Seletivo','',''),
 (676,'Processo Seletivo','',''),
 (677,'Processo Seletivo','',''),
 (678,'Processo Seletivo','',''),
 (679,'Processo Seletivo','',''),
 (680,'Processo Seletivo','',''),
 (681,'Processo Seletivo','',''),
 (682,'Processo Seletivo','',''),
 (683,'Processo Seletivo','',''),
 (684,'Processo Seletivo','',''),
 (685,'Processo Seletivo','',''),
 (686,'Processo Seletivo','',''),
 (687,'Processo Seletivo','',''),
 (688,'Processo Seletivo','',''),
 (689,'Processo Seletivo','',''),
 (690,'Processo Seletivo','',''),
 (691,'Processo Seletivo','',''),
 (692,'Processo Seletivo','',''),
 (693,'Processo Seletivo','',''),
 (694,'Processo Seletivo','',''),
 (695,'Processo Seletivo','',''),
 (696,'Processo Seletivo','',''),
 (697,'Processo Seletivo','',''),
 (698,'Processo Seletivo','',''),
 (699,'Processo Seletivo','',''),
 (700,'Processo Seletivo','',''),
 (701,'Processo Seletivo','',''),
 (702,'Processo Seletivo','',''),
 (703,'Processo Seletivo','',''),
 (704,'Processo Seletivo','',''),
 (705,'Processo Seletivo','',''),
 (706,'Processo Seletivo','',''),
 (707,'Processo Seletivo','',''),
 (708,'Processo Seletivo','',''),
 (709,'Processo Seletivo','',''),
 (710,'Processo Seletivo','',''),
 (711,'Processo Seletivo','',''),
 (712,'Processo Seletivo','',''),
 (713,'Processo Seletivo','',''),
 (714,'Processo Seletivo','',''),
 (715,'Processo Seletivo','',''),
 (716,'Processo Seletivo','',''),
 (717,'Processo Seletivo','',''),
 (718,'Processo Seletivo','',''),
 (719,'Processo Seletivo','',''),
 (720,'Processo Seletivo','',''),
 (721,'Processo Seletivo','',''),
 (722,'Processo Seletivo','',''),
 (723,'Processo Seletivo','',''),
 (724,'Processo Seletivo','',''),
 (725,'Processo Seletivo','',''),
 (726,'Processo Seletivo','',''),
 (727,'Processo Seletivo','',''),
 (728,'Processo Seletivo','',''),
 (729,'Processo Seletivo','',''),
 (730,'Processo Seletivo','',''),
 (731,'Processo Seletivo','',''),
 (732,'Processo Seletivo','',''),
 (733,'Processo Seletivo','',''),
 (734,'Processo Seletivo','',''),
 (735,'Processo Seletivo','',''),
 (736,'Processo Seletivo','',''),
 (737,'Processo Seletivo','',''),
 (738,'Processo Seletivo','',''),
 (739,'Processo Seletivo','',''),
 (740,'Processo Seletivo','',''),
 (741,'Processo Seletivo','',''),
 (742,'Processo Seletivo','',''),
 (743,'Processo Seletivo','',''),
 (744,'Processo Seletivo','',''),
 (745,'Processo Seletivo','',''),
 (746,'Processo Seletivo','',''),
 (747,'Processo Seletivo','',''),
 (748,'Processo Seletivo','',''),
 (749,'Processo Seletivo','',''),
 (750,'Processo Seletivo','',''),
 (751,'Processo Seletivo','',''),
 (752,'Processo Seletivo','',''),
 (753,'Processo Seletivo','',''),
 (754,'Processo Seletivo','',''),
 (755,'Processo Seletivo','',''),
 (756,'Processo Seletivo','',''),
 (757,'cadastro vestibular','',''),
 (758,'chamada vestibular','',''),
 (759,'candidato','',''),
 (760,'Processo Seletivo','',''),
 (761,'Processo Seletivo','',''),
 (762,'Processo Seletivo','',''),
 (763,'Processo Seletivo','',''),
 (764,'Processo Seletivo','',''),
 (765,'Processo Seletivo','',''),
 (766,'Processo Seletivo','',''),
 (767,'Processo Seletivo','',''),
 (768,'Processo Seletivo','',''),
 (769,'Processo Seletivo','',''),
 (770,'Processo Seletivo','',''),
 (771,'Processo Seletivo','',''),
 (772,'Processo Seletivo','',''),
 (773,'Processo Seletivo','',''),
 (774,'Processo Seletivo','',''),
 (775,'Processo Seletivo','',''),
 (776,'Processo Seletivo','',''),
 (777,'Processo Seletivo','',''),
 (778,'Processo Seletivo','',''),
 (779,'Processo Seletivo','',''),
 (780,'Processo Seletivo','',''),
 (781,'Processo Seletivo','',''),
 (782,'Processo Seletivo','',''),
 (783,'Processo Seletivo','',''),
 (784,'Processo Seletivo','',''),
 (785,'Processo Seletivo','',''),
 (786,'Processo Seletivo','',''),
 (787,'Processo Seletivo','',''),
 (788,'Processo Seletivo','',''),
 (789,'Processo Seletivo','',''),
 (790,'Processo Seletivo','',''),
 (791,'Processo Seletivo','',''),
 (792,'Processo Seletivo','',''),
 (793,'Processo Seletivo','',''),
 (794,'Processo Seletivo','',''),
 (795,'Processo Seletivo','',''),
 (796,'Processo Seletivo','',''),
 (797,'Processo Seletivo','',''),
 (798,'Processo Seletivo','',''),
 (799,'Processo Seletivo','',''),
 (800,'Processo Seletivo','',''),
 (801,'Processo Seletivo','',''),
 (802,'Processo Seletivo','',''),
 (803,'Processo Seletivo','',''),
 (804,'Processo Seletivo','',''),
 (805,'Processo Seletivo','',''),
 (806,'Processo Seletivo','',''),
 (807,'Processo Seletivo','',''),
 (808,'Processo Seletivo','',''),
 (809,'Processo Seletivo','',''),
 (810,'Processo Seletivo','',''),
 (811,'Processo Seletivo','',''),
 (812,'Processo Seletivo','',''),
 (813,'Processo Seletivo','',''),
 (814,'Processo Seletivo','',''),
 (815,'Processo Seletivo','',''),
 (816,'Processo Seletivo','',''),
 (817,'Processo Seletivo','',''),
 (818,'Processo Seletivo','',''),
 (819,'Processo Seletivo','',''),
 (820,'Processo Seletivo','',''),
 (821,'Processo Seletivo','',''),
 (822,'Processo Seletivo','',''),
 (823,'Processo Seletivo','',''),
 (824,'Processo Seletivo','',''),
 (825,'Processo Seletivo','',''),
 (826,'Processo Seletivo','',''),
 (827,'Processo Seletivo','',''),
 (828,'Processo Seletivo','',''),
 (829,'Processo Seletivo','',''),
 (830,'Processo Seletivo','',''),
 (831,'Processo Seletivo','',''),
 (832,'Processo Seletivo','',''),
 (833,'Processo Seletivo','',''),
 (834,'Processo Seletivo','',''),
 (835,'Processo Seletivo','',''),
 (836,'Processo Seletivo','',''),
 (837,'Processo Seletivo','',''),
 (838,'Processo Seletivo','',''),
 (839,'Processo Seletivo','',''),
 (840,'Processo Seletivo','',''),
 (841,'Processo Seletivo','',''),
 (842,'Processo Seletivo','',''),
 (843,'Processo Seletivo','',''),
 (844,'Processo Seletivo','',''),
 (845,'Processo Seletivo','',''),
 (846,'Processo Seletivo','',''),
 (847,'Processo Seletivo','',''),
 (848,'Processo Seletivo','',''),
 (849,'Processo Seletivo','',''),
 (850,'Processo Seletivo','',''),
 (851,'Processo Seletivo','',''),
 (852,'Processo Seletivo','',''),
 (853,'Processo Seletivo','',''),
 (854,'Processo Seletivo','',''),
 (855,'Processo Seletivo','',''),
 (856,'Processo Seletivo','',''),
 (857,'Processo Seletivo','',''),
 (858,'Processo Seletivo','',''),
 (859,'Processo Seletivo','',''),
 (860,'Processo Seletivo','',''),
 (861,'Processo Seletivo','',''),
 (862,'Processo Seletivo','',''),
 (863,'Processo Seletivo','',''),
 (864,'Processo Seletivo','',''),
 (865,'Processo Seletivo','',''),
 (866,'Processo Seletivo','',''),
 (867,'Processo Seletivo','',''),
 (868,'Processo Seletivo','',''),
 (869,'Processo Seletivo','',''),
 (870,'Processo Seletivo','',''),
 (871,'Processo Seletivo','',''),
 (872,'Processo Seletivo','',''),
 (873,'Processo Seletivo','',''),
 (874,'Processo Seletivo','',''),
 (875,'Processo Seletivo','',''),
 (876,'Processo Seletivo','',''),
 (877,'Processo Seletivo','',''),
 (878,'Processo Seletivo','',''),
 (879,'Processo Seletivo','',''),
 (880,'Processo Seletivo','',''),
 (881,'Processo Seletivo','',''),
 (882,'Processo Seletivo','',''),
 (883,'Processo Seletivo','',''),
 (884,'Processo Seletivo','',''),
 (885,'Processo Seletivo','',''),
 (886,'Processo Seletivo','',''),
 (887,'Processo Seletivo','',''),
 (888,'Processo Seletivo','',''),
 (889,'Processo Seletivo','',''),
 (890,'Processo Seletivo','',''),
 (891,'Processo Seletivo','',''),
 (892,'Processo Seletivo','',''),
 (893,'Processo Seletivo','',''),
 (894,'Processo Seletivo','',''),
 (895,'Processo Seletivo','',''),
 (896,'Processo Seletivo','',''),
 (897,'Processo Seletivo','',''),
 (898,'Processo Seletivo','',''),
 (899,'Processo Seletivo','',''),
 (900,'Processo Seletivo','',''),
 (901,'Processo Seletivo','',''),
 (902,'Processo Seletivo','',''),
 (903,'Processo Seletivo','',''),
 (904,'Processo Seletivo','',''),
 (905,'Processo Seletivo','',''),
 (906,'Processo Seletivo','',''),
 (907,'Processo Seletivo','',''),
 (908,'Processo Seletivo','',''),
 (909,'Processo Seletivo','',''),
 (910,'Processo Seletivo','',''),
 (911,'Processo Seletivo','',''),
 (912,'Processo Seletivo','',''),
 (913,'Processo Seletivo','',''),
 (914,'Processo Seletivo','',''),
 (915,'Processo Seletivo','',''),
 (916,'Processo Seletivo','',''),
 (917,'Processo Seletivo','',''),
 (918,'Processo Seletivo','',''),
 (919,'Processo Seletivo','',''),
 (920,'Processo Seletivo','',''),
 (921,'Processo Seletivo','',''),
 (922,'Processo Seletivo','',''),
 (923,'Processo Seletivo','',''),
 (924,'Processo Seletivo','',''),
 (925,'Processo Seletivo','',''),
 (926,'Processo Seletivo','',''),
 (927,'Processo Seletivo','',''),
 (928,'Processo Seletivo','',''),
 (929,'Processo Seletivo','',''),
 (930,'Processo Seletivo','',''),
 (931,'Processo Seletivo','',''),
 (932,'Processo Seletivo','',''),
 (933,'Processo Seletivo','',''),
 (934,'Processo Seletivo','',''),
 (935,'Processo Seletivo','',''),
 (936,'Processo Seletivo','',''),
 (937,'Processo Seletivo','',''),
 (938,'Processo Seletivo','',''),
 (939,'Processo Seletivo','',''),
 (940,'Processo Seletivo','',''),
 (941,'Processo Seletivo','',''),
 (942,'Processo Seletivo','',''),
 (943,'Processo Seletivo','',''),
 (944,'Processo Seletivo','',''),
 (945,'Processo Seletivo','',''),
 (946,'Processo Seletivo','',''),
 (947,'Processo Seletivo','',''),
 (948,'Processo Seletivo','',''),
 (949,'Processo Seletivo','',''),
 (950,'Processo Seletivo','',''),
 (951,'Processo Seletivo','',''),
 (952,'Processo Seletivo','',''),
 (953,'Processo Seletivo','',''),
 (954,'Processo Seletivo','',''),
 (955,'Processo Seletivo','',''),
 (956,'Processo Seletivo','',''),
 (957,'Processo Seletivo','',''),
 (958,'Processo Seletivo','',''),
 (959,'Processo Seletivo','',''),
 (960,'Processo Seletivo','',''),
 (961,'Processo Seletivo','',''),
 (962,'Processo Seletivo','',''),
 (963,'Processo Seletivo','',''),
 (964,'Processo Seletivo','',''),
 (965,'Processo Seletivo','',''),
 (966,'Processo Seletivo','',''),
 (967,'Processo Seletivo','',''),
 (968,'Processo Seletivo','',''),
 (969,'Processo Seletivo','',''),
 (970,'Processo Seletivo','',''),
 (971,'Processo Seletivo','',''),
 (972,'Processo Seletivo','',''),
 (973,'Processo Seletivo','',''),
 (974,'Processo Seletivo','',''),
 (975,'Processo Seletivo','',''),
 (976,'Processo Seletivo','',''),
 (977,'Processo Seletivo','',''),
 (978,'Processo Seletivo','',''),
 (979,'Processo Seletivo','',''),
 (980,'Processo Seletivo','',''),
 (981,'Processo Seletivo','',''),
 (982,'Processo Seletivo','',''),
 (983,'Processo Seletivo','',''),
 (984,'Processo Seletivo','',''),
 (985,'Processo Seletivo','',''),
 (986,'Processo Seletivo','',''),
 (987,'Processo Seletivo','',''),
 (988,'Processo Seletivo','',''),
 (989,'Processo Seletivo','',''),
 (990,'Processo Seletivo','',''),
 (991,'Processo Seletivo','',''),
 (992,'Processo Seletivo','',''),
 (993,'Processo Seletivo','',''),
 (994,'Processo Seletivo','',''),
 (995,'Processo Seletivo','',''),
 (996,'Processo Seletivo','',''),
 (997,'Processo Seletivo','',''),
 (998,'Processo Seletivo','',''),
 (999,'Processo Seletivo','',''),
 (1000,'Processo Seletivo','',''),
 (1001,'Processo Seletivo','',''),
 (1002,'Processo Seletivo','',''),
 (1003,'Processo Seletivo','',''),
 (1004,'Processo Seletivo','',''),
 (1005,'Processo Seletivo','',''),
 (1006,'Processo Seletivo','',''),
 (1007,'Processo Seletivo','',''),
 (1008,'Processo Seletivo','',''),
 (1009,'Processo Seletivo','',''),
 (1010,'Processo Seletivo','',''),
 (1011,'Processo Seletivo','',''),
 (1012,'Processo Seletivo','',''),
 (1013,'Processo Seletivo','',''),
 (1014,'Processo Seletivo','',''),
 (1015,'Processo Seletivo','',''),
 (1016,'Processo Seletivo','',''),
 (1017,'Processo Seletivo','',''),
 (1018,'Processo Seletivo','',''),
 (1019,'Processo Seletivo','',''),
 (1020,'Processo Seletivo','',''),
 (1021,'Processo Seletivo','',''),
 (1022,'Processo Seletivo','',''),
 (1023,'Processo Seletivo','',''),
 (1024,'Processo Seletivo','',''),
 (1025,'Processo Seletivo','',''),
 (1026,'Processo Seletivo','',''),
 (1027,'Processo Seletivo','',''),
 (1028,'Processo Seletivo','',''),
 (1029,'Processo Seletivo','',''),
 (1030,'Processo Seletivo','',''),
 (1031,'Processo Seletivo','',''),
 (1032,'Processo Seletivo','',''),
 (1033,'Processo Seletivo','',''),
 (1034,'Processo Seletivo','',''),
 (1035,'Processo Seletivo','',''),
 (1036,'Processo Seletivo','',''),
 (1037,'Processo Seletivo','',''),
 (1038,'Processo Seletivo','',''),
 (1039,'Processo Seletivo','',''),
 (1040,'Processo Seletivo','',''),
 (1041,'Processo Seletivo','',''),
 (1042,'Processo Seletivo','',''),
 (1043,'Processo Seletivo','',''),
 (1044,'Processo Seletivo','',''),
 (1045,'Processo Seletivo','',''),
 (1046,'Processo Seletivo','',''),
 (1047,'Processo Seletivo','',''),
 (1048,'Processo Seletivo','',''),
 (1049,'Processo Seletivo','',''),
 (1050,'Processo Seletivo','',''),
 (1051,'Processo Seletivo','',''),
 (1052,'Processo Seletivo','',''),
 (1053,'Processo Seletivo','',''),
 (1054,'Processo Seletivo','',''),
 (1055,'Processo Seletivo','',''),
 (1056,'Processo Seletivo','',''),
 (1057,'Processo Seletivo','',''),
 (1058,'Processo Seletivo','',''),
 (1059,'Processo Seletivo','',''),
 (1060,'Processo Seletivo','',''),
 (1061,'Processo Seletivo','',''),
 (1062,'Processo Seletivo','',''),
 (1063,'Processo Seletivo','',''),
 (1064,'Processo Seletivo','',''),
 (1065,'Processo Seletivo','',''),
 (1066,'Processo Seletivo','',''),
 (1067,'Processo Seletivo','',''),
 (1068,'Processo Seletivo','',''),
 (1069,'Processo Seletivo','',''),
 (1070,'Processo Seletivo','',''),
 (1071,'Processo Seletivo','',''),
 (1072,'Processo Seletivo','',''),
 (1073,'Processo Seletivo','',''),
 (1074,'Processo Seletivo','',''),
 (1075,'Processo Seletivo','',''),
 (1076,'Processo Seletivo','',''),
 (1077,'Processo Seletivo','',''),
 (1078,'Processo Seletivo','',''),
 (1079,'Processo Seletivo','',''),
 (1080,'Processo Seletivo','',''),
 (1081,'Processo Seletivo','',''),
 (1082,'Processo Seletivo','',''),
 (1083,'Processo Seletivo','',''),
 (1084,'Processo Seletivo','',''),
 (1085,'Processo Seletivo','',''),
 (1086,'Processo Seletivo','',''),
 (1087,'Processo Seletivo','',''),
 (1088,'Processo Seletivo','',''),
 (1089,'Processo Seletivo','',''),
 (1090,'Processo Seletivo','',''),
 (1091,'Processo Seletivo','',''),
 (1092,'Processo Seletivo','',''),
 (1093,'Processo Seletivo','',''),
 (1094,'Processo Seletivo','',''),
 (1095,'Processo Seletivo','',''),
 (1096,'Processo Seletivo','',''),
 (1097,'Processo Seletivo','',''),
 (1098,'Processo Seletivo','',''),
 (1099,'Processo Seletivo','',''),
 (1100,'Processo Seletivo','',''),
 (1101,'Processo Seletivo','',''),
 (1102,'Processo Seletivo','',''),
 (1103,'Processo Seletivo','',''),
 (1104,'Processo Seletivo','',''),
 (1105,'Processo Seletivo','',''),
 (1106,'Processo Seletivo','',''),
 (1107,'Processo Seletivo','',''),
 (1108,'Processo Seletivo','',''),
 (1109,'Processo Seletivo','',''),
 (1110,'Processo Seletivo','',''),
 (1111,'Processo Seletivo','',''),
 (1112,'Processo Seletivo','',''),
 (1113,'Processo Seletivo','',''),
 (1114,'vestibular','',''),
 (1115,'Processo Seletivo','',''),
 (1116,'Processo Seletivo','',''),
 (1117,'Processo Seletivo','',''),
 (1118,'Processo Seletivo','',''),
 (1119,'Processo Seletivo','',''),
 (1120,'Processo Seletivo','',''),
 (1121,'Processo Seletivo','',''),
 (1122,'Processo Seletivo','',''),
 (1123,'Processo Seletivo','',''),
 (1124,'chamada vest','',''),
 (1125,'Processo Seletivo','',''),
 (1126,'Processo Seletivo','',''),
 (1127,'Processo Seletivo','',''),
 (1128,'Processo Seletivo','',''),
 (1129,'Processo Seletivo','',''),
 (1130,'Processo Seletivo','',''),
 (1131,'Processo Seletivo','',''),
 (1132,'Processo Seletivo','',''),
 (1133,'Processo Seletivo','',''),
 (1134,'Processo Seletivo','',''),
 (1135,'Processo Seletivo','',''),
 (1136,'Processo Seletivo','',''),
 (1137,'Processo Seletivo','',''),
 (1138,'Processo Seletivo','',''),
 (1139,'Processo Seletivo','',''),
 (1140,'Processo Seletivo','',''),
 (1141,'Processo Seletivo','',''),
 (1142,'Processo Seletivo','',''),
 (1143,'Processo Seletivo','',''),
 (1144,'Processo Seletivo','',''),
 (1145,'Processo Seletivo','',''),
 (1146,'Processo Seletivo','',''),
 (1147,'Processo Seletivo','',''),
 (1148,'Processo Seletivo','',''),
 (1149,'Processo Seletivo','',''),
 (1150,'Processo Seletivo','',''),
 (1151,'Processo Seletivo','',''),
 (1152,'Processo Seletivo','',''),
 (1153,'Processo Seletivo','',''),
 (1154,'Processo Seletivo','',''),
 (1155,'Processo Seletivo','',''),
 (1156,'Processo Seletivo','',''),
 (1157,'Processo Seletivo','',''),
 (1158,'Processo Seletivo','',''),
 (1159,'Processo Seletivo','',''),
 (1160,'Processo Seletivo','',''),
 (1161,'Processo Seletivo','',''),
 (1162,'Processo Seletivo','',''),
 (1163,'Processo Seletivo','',''),
 (1164,'Processo Seletivo','',''),
 (1165,'Processo Seletivo','',''),
 (1166,'Processo Seletivo','',''),
 (1167,'Processo Seletivo','',''),
 (1168,'Processo Seletivo','',''),
 (1169,'Processo Seletivo','',''),
 (1170,'Processo Seletivo','',''),
 (1171,'Processo Seletivo','',''),
 (1172,'Processo Seletivo','',''),
 (1173,'Processo Seletivo','',''),
 (1174,'Processo Seletivo','',''),
 (1175,'Processo Seletivo','',''),
 (1176,'Processo Seletivo','',''),
 (1177,'Processo Seletivo','',''),
 (1178,'Processo Seletivo','',''),
 (1179,'Processo Seletivo','',''),
 (1180,'Processo Seletivo','',''),
 (1181,'Processo Seletivo','',''),
 (1182,'Processo Seletivo','',''),
 (1183,'Processo Seletivo','',''),
 (1184,'Processo Seletivo','',''),
 (1185,'Processo Seletivo','',''),
 (1186,'Processo Seletivo','',''),
 (1187,'Processo Seletivo','',''),
 (1188,'Processo Seletivo','',''),
 (1189,'Processo Seletivo','',''),
 (1190,'Processo Seletivo','',''),
 (1191,'Processo Seletivo','',''),
 (1192,'Processo Seletivo','',''),
 (1193,'Processo Seletivo','',''),
 (1194,'Processo Seletivo','',''),
 (1195,'Processo Seletivo','',''),
 (1196,'Processo Seletivo','',''),
 (1197,'Processo Seletivo','',''),
 (1198,'Processo Seletivo','',''),
 (1199,'Processo Seletivo','',''),
 (1200,'Processo Seletivo','',''),
 (1201,'Processo Seletivo','',''),
 (1202,'Processo Seletivo','',''),
 (1203,'Processo Seletivo','',''),
 (1204,'Processo Seletivo','',''),
 (1205,'Processo Seletivo','',''),
 (1206,'Processo Seletivo','',''),
 (1207,'Processo Seletivo','',''),
 (1208,'Processo Seletivo','',''),
 (1209,'Processo Seletivo','',''),
 (1210,'Processo Seletivo','',''),
 (1211,'Processo Seletivo','',''),
 (1212,'Processo Seletivo','',''),
 (1213,'Processo Seletivo','',''),
 (1214,'Processo Seletivo','',''),
 (1215,'Processo Seletivo','',''),
 (1216,'Processo Seletivo','',''),
 (1217,'Processo Seletivo','',''),
 (1218,'Processo Seletivo','',''),
 (1219,'Processo Seletivo','',''),
 (1220,'Processo Seletivo','',''),
 (1221,'Processo Seletivo','',''),
 (1222,'Processo Seletivo','',''),
 (1223,'Processo Seletivo','',''),
 (1224,'Processo Seletivo','',''),
 (1225,'Processo Seletivo','',''),
 (1226,'Processo Seletivo','',''),
 (1227,'ano','',''),
 (1228,'semestre','',''),
 (1229,'data_vestibular','',''),
 (1230,'tipo','',''),
 (1231,'data_realização','',''),
 (1232,'Processo Seletivo','',''),
 (1233,'Processo Seletivo','',''),
 (1234,'Processo Seletivo','',''),
 (1235,'lista_vestibular','',''),
 (1236,'add_vestibular','',''),
 (1237,'editar','',''),
 (1238,'deletar','',''),
 (1239,'Processo Seletivo','',''),
 (1240,'Processo Seletivo','',''),
 (1241,'Processo Seletivo','',''),
 (1242,'Processo Seletivo','',''),
 (1243,'Processo Seletivo','',''),
 (1244,'Processo Seletivo','',''),
 (1245,'Processo Seletivo','',''),
 (1246,'Processo Seletivo','',''),
 (1247,'Processo Seletivo','',''),
 (1248,'Processo Seletivo','',''),
 (1249,'Processo Seletivo','',''),
 (1250,'Processo Seletivo','',''),
 (1251,'Processo Seletivo','',''),
 (1252,'Processo Seletivo','',''),
 (1253,'Processo Seletivo','',''),
 (1254,'Processo Seletivo','',''),
 (1255,'Processo Seletivo','',''),
 (1256,'Processo Seletivo','',''),
 (1257,'Processo Seletivo','',''),
 (1258,'Processo Seletivo','',''),
 (1259,'Processo Seletivo','',''),
 (1260,'Processo Seletivo','',''),
 (1261,'Processo Seletivo','',''),
 (1262,'Processo Seletivo','',''),
 (1263,'Processo Seletivo','',''),
 (1264,'Processo Seletivo','',''),
 (1265,'Processo Seletivo','',''),
 (1266,'Processo Seletivo','',''),
 (1267,'Processo Seletivo','',''),
 (1268,'Processo Seletivo','',''),
 (1269,'Processo Seletivo','',''),
 (1270,'Processo Seletivo','',''),
 (1271,'Processo Seletivo','',''),
 (1272,'Processo Seletivo','',''),
 (1273,'Processo Seletivo','',''),
 (1274,'Processo Seletivo','',''),
 (1275,'Processo Seletivo','',''),
 (1276,'Processo Seletivo','',''),
 (1277,'Processo Seletivo','',''),
 (1278,'Processo Seletivo','',''),
 (1279,'Processo Seletivo','',''),
 (1280,'Processo Seletivo','',''),
 (1281,'Processo Seletivo','',''),
 (1282,'Processo Seletivo','',''),
 (1283,'Processo Seletivo','',''),
 (1284,'Processo Seletivo','',''),
 (1285,'Processo Seletivo','',''),
 (1286,'Processo Seletivo','',''),
 (1287,'Processo Seletivo','',''),
 (1288,'Processo Seletivo','',''),
 (1289,'Processo Seletivo','',''),
 (1290,'Processo Seletivo','',''),
 (1291,'Processo Seletivo','',''),
 (1292,'Processo Seletivo','',''),
 (1293,'Processo Seletivo','',''),
 (1294,'Processo Seletivo','',''),
 (1295,'Processo Seletivo','',''),
 (1296,'Processo Seletivo','',''),
 (1297,'Processo Seletivo','',''),
 (1298,'Processo Seletivo','',''),
 (1299,'Processo Seletivo','',''),
 (1300,'Processo Seletivo','',''),
 (1301,'Processo Seletivo','',''),
 (1302,'Processo Seletivo','',''),
 (1303,'Processo Seletivo','',''),
 (1304,'Processo Seletivo','',''),
 (1305,'Processo Seletivo','',''),
 (1306,'Processo Seletivo','',''),
 (1307,'Processo Seletivo','',''),
 (1308,'Processo Seletivo','',''),
 (1309,'Processo Seletivo','',''),
 (1310,'Processo Seletivo','',''),
 (1311,'Processo Seletivo','',''),
 (1312,'Processo Seletivo','',''),
 (1313,'Processo Seletivo','',''),
 (1314,'Processo Seletivo','',''),
 (1315,'Processo Seletivo','',''),
 (1316,'Processo Seletivo','',''),
 (1317,'Processo Seletivo','',''),
 (1318,'Processo Seletivo','',''),
 (1319,'Processo Seletivo','',''),
 (1320,'Processo Seletivo','',''),
 (1321,'Processo Seletivo','',''),
 (1322,'Processo Seletivo','',''),
 (1323,'Processo Seletivo','',''),
 (1324,'Processo Seletivo','',''),
 (1325,'Processo Seletivo','',''),
 (1326,'Processo Seletivo','',''),
 (1327,'Processo Seletivo','',''),
 (1328,'Processo Seletivo','',''),
 (1329,'Processo Seletivo','',''),
 (1330,'Processo Seletivo','',''),
 (1331,'Ano','',''),
 (1332,'Ano','',''),
 (1333,'Ano','',''),
 (1334,'Ano','',''),
 (1335,'Ano','',''),
 (1336,'Ano','',''),
 (1337,'Ano','',''),
 (1338,'Ano','',''),
 (1339,'Ano','',''),
 (1340,'Ano','',''),
 (1341,'Ano','',''),
 (1342,'Semestre','',''),
 (1343,'Ano','',''),
 (1344,'Semestre','',''),
 (1345,'I Semestre','',''),
 (1346,'II Semestre','',''),
 (1347,'Ano','',''),
 (1348,'Semestre','',''),
 (1349,'Ano','',''),
 (1350,'Semestre','',''),
 (1351,'Tipo','',''),
 (1352,'Macro','',''),
 (1353,'Agendado','',''),
 (1354,'Ano','',''),
 (1355,'Semestre','',''),
 (1356,'Tipo','',''),
 (1357,'Ano','',''),
 (1358,'Semestre','',''),
 (1359,'Tipo','',''),
 (1360,'Data Inscrição','',''),
 (1361,'Ano','',''),
 (1362,'Semestre','',''),
 (1363,'Tipo','',''),
 (1364,'Ano','',''),
 (1365,'Semestre','',''),
 (1366,'Tipo','',''),
 (1367,'Ano','',''),
 (1368,'Semestre','',''),
 (1369,'Tipo','',''),
 (1370,'Ano','',''),
 (1371,'Semestre','',''),
 (1372,'Tipo','',''),
 (1373,'data_inscrição','',''),
 (1374,'data_encerramento','',''),
 (1375,'Ano','',''),
 (1376,'Semestre','',''),
 (1377,'Tipo','',''),
 (1378,'Ano','',''),
 (1379,'Semestre','',''),
 (1380,'Tipo','',''),
 (1381,'Ano','',''),
 (1382,'Semestre','',''),
 (1383,'Tipo','',''),
 (1384,'Ano','',''),
 (1385,'Semestre','',''),
 (1386,'Tipo','',''),
 (1387,'Ano','',''),
 (1388,'Semestre','',''),
 (1389,'Tipo','',''),
 (1390,'Ano','',''),
 (1391,'Semestre','',''),
 (1392,'Tipo','',''),
 (1393,'Ano','',''),
 (1394,'Semestre','',''),
 (1395,'Tipo','',''),
 (1396,'Ano','',''),
 (1397,'Semestre','',''),
 (1398,'Tipo','',''),
 (1399,'Ano','',''),
 (1400,'Semestre','',''),
 (1401,'Tipo','',''),
 (1402,'Ano','',''),
 (1403,'Ano','',''),
 (1404,'Semestre','',''),
 (1405,'Tipo','',''),
 (1406,'Ano','',''),
 (1407,'Semestre','',''),
 (1408,'Tipo','',''),
 (1409,'Ano','',''),
 (1410,'Semestre','',''),
 (1411,'Tipo','',''),
 (1412,'data_resultado','',''),
 (1413,'Ano','',''),
 (1414,'Semestre','',''),
 (1415,'Tipo','',''),
 (1416,'Processo Seletivo','',''),
 (1417,'Processo Seletivo','',''),
 (1418,'Processo Seletivo','',''),
 (1419,'Processo Seletivo','',''),
 (1420,'Processo Seletivo','',''),
 (1421,'Processo Seletivo','',''),
 (1422,'Processo Seletivo','',''),
 (1423,'Processo Seletivo','',''),
 (1424,'Processo Seletivo','',''),
 (1425,'Processo Seletivo','',''),
 (1426,'Processo Seletivo','',''),
 (1427,'Processo Seletivo','',''),
 (1428,'Processo Seletivo','',''),
 (1429,'Processo Seletivo','',''),
 (1430,'Processo Seletivo','',''),
 (1431,'Processo Seletivo','',''),
 (1432,'Processo Seletivo','',''),
 (1433,'Processo Seletivo','',''),
 (1434,'Processo Seletivo','',''),
 (1435,'Processo Seletivo','',''),
 (1436,'Processo Seletivo','',''),
 (1437,'Processo Seletivo','',''),
 (1438,'Processo Seletivo','',''),
 (1439,'Processo Seletivo','',''),
 (1440,'Processo Seletivo','',''),
 (1441,'Processo Seletivo','',''),
 (1442,'Processo Seletivo','',''),
 (1443,'Processo Seletivo','',''),
 (1444,'Processo Seletivo','',''),
 (1445,'Processo Seletivo','',''),
 (1446,'Processo Seletivo','',''),
 (1447,'Processo Seletivo','',''),
 (1448,'Processo Seletivo','',''),
 (1449,'Processo Seletivo','',''),
 (1450,'Processo Seletivo','',''),
 (1451,'Processo Seletivo','',''),
 (1452,'Processo Seletivo','',''),
 (1453,'gerenciar_candidato','',''),
 (1454,'Processo Seletivo','',''),
 (1455,'Processo Seletivo','',''),
 (1456,'Processo Seletivo','',''),
 (1457,'Processo Seletivo','',''),
 (1458,'Processo Seletivo','',''),
 (1459,'Processo Seletivo','',''),
 (1460,'Processo Seletivo','',''),
 (1461,'lista_candidato','',''),
 (1462,'Processo Seletivo','',''),
 (1463,'Processo Seletivo','',''),
 (1464,'Processo Seletivo','',''),
 (1465,'Processo Seletivo','',''),
 (1466,'Processo Seletivo','',''),
 (1467,'Processo Seletivo','',''),
 (1468,'nome','',''),
 (1469,'Processo Seletivo','',''),
 (1470,'Processo Seletivo','',''),
 (1471,'Processo Seletivo','',''),
 (1472,'Processo Seletivo','',''),
 (1473,'Processo Seletivo','',''),
 (1474,'Processo Seletivo','',''),
 (1475,'Processo Seletivo','',''),
 (1476,'Processo Seletivo','',''),
 (1477,'Processo Seletivo','',''),
 (1478,'Ano','',''),
 (1479,'Semestre','',''),
 (1480,'Tipo','',''),
 (1481,'Processo Seletivo','',''),
 (1482,'Processo Seletivo','',''),
 (1483,'Processo Seletivo','',''),
 (1484,'sexo','',''),
 (1485,'CPF','',''),
 (1486,'Processo Seletivo','',''),
 (1487,'Processo Seletivo','',''),
 (1488,'Processo Seletivo','',''),
 (1489,'Processo Seletivo','',''),
 (1490,'Processo Seletivo','',''),
 (1491,'Processo Seletivo','',''),
 (1492,'Processo Seletivo','',''),
 (1493,'Processo Seletivo','',''),
 (1494,'Processo Seletivo','',''),
 (1495,'Processo Seletivo','',''),
 (1496,'Processo Seletivo','',''),
 (1497,'Processo Seletivo','',''),
 (1498,'Processo Seletivo','',''),
 (1499,'Processo Seletivo','',''),
 (1500,'Processo Seletivo','',''),
 (1501,'nomeADSDADADADA','',''),
 (1502,'nome_candidato','',''),
 (1503,'RG','',''),
 (1504,'Telefone','',''),
 (1505,'Processo Seletivo','',''),
 (1506,'Processo Seletivo','',''),
 (1507,'Processo Seletivo','',''),
 (1508,'Processo Seletivo','',''),
 (1509,'Processo Seletivo','',''),
 (1510,'Processo Seletivo','',''),
 (1511,'telefone','',''),
 (1512,'telefone','',''),
 (1513,'telefone','',''),
 (1514,'telefone','',''),
 (1515,'telefone','',''),
 (1516,'telefone','',''),
 (1517,'telefone','',''),
 (1518,'telefone','',''),
 (1519,'telefone','',''),
 (1520,'telefone','',''),
 (1521,'telefone','',''),
 (1522,'telefone','',''),
 (1523,'telefone','',''),
 (1524,'telefone','',''),
 (1525,'telefone','',''),
 (1526,'telefone','',''),
 (1527,'telefone','',''),
 (1528,'telefone','',''),
 (1529,'telefone','',''),
 (1530,'telefone','',''),
 (1531,'telefone','',''),
 (1532,'telefone','',''),
 (1533,'telefone','',''),
 (1534,'telefone','',''),
 (1535,'telefone','',''),
 (1536,'telefone','',''),
 (1537,'telefone','',''),
 (1538,'telefone','',''),
 (1539,'telefone','',''),
 (1540,'telefone','',''),
 (1541,'telefone','',''),
 (1542,'telefone','',''),
 (1543,'telefone','',''),
 (1544,'Processo Seletivo','',''),
 (1545,'Processo Seletivo','',''),
 (1546,'Processo Seletivo','',''),
 (1547,'Processo Seletivo','',''),
 (1548,'Processo Seletivo','',''),
 (1549,'Processo Seletivo','',''),
 (1550,'telefone','',''),
 (1551,'Processo Seletivo','',''),
 (1552,'Processo Seletivo','',''),
 (1553,'Processo Seletivo','',''),
 (1554,'Processo Seletivo','',''),
 (1555,'Processo Seletivo','',''),
 (1556,'Processo Seletivo','',''),
 (1557,'Processo Seletivo','',''),
 (1558,'Processo Seletivo','',''),
 (1559,'Processo Seletivo','',''),
 (1560,'Processo Seletivo','',''),
 (1561,'Processo Seletivo','',''),
 (1562,'telefone','',''),
 (1563,'Processo Seletivo','',''),
 (1564,'Processo Seletivo','',''),
 (1565,'Processo Seletivo','',''),
 (1566,'Processo Seletivo','',''),
 (1567,'Processo Seletivo','',''),
 (1568,'Processo Seletivo','',''),
 (1569,'telefone','',''),
 (1570,'Processo Seletivo','',''),
 (1571,'Processo Seletivo','',''),
 (1572,'Processo Seletivo','',''),
 (1573,'Processo Seletivo','',''),
 (1574,'Processo Seletivo','',''),
 (1575,'Processo Seletivo','',''),
 (1576,'telefone','',''),
 (1577,'Processo Seletivo','',''),
 (1578,'Processo Seletivo','',''),
 (1579,'Processo Seletivo','',''),
 (1580,'Processo Seletivo','',''),
 (1581,'Processo Seletivo','',''),
 (1582,'Processo Seletivo','',''),
 (1583,'Processo Seletivo','',''),
 (1584,'Processo Seletivo','',''),
 (1585,'Processo Seletivo','',''),
 (1586,'gerenciar_vetibular','',''),
 (1587,'Qtd Inscritos','',''),
 (1588,'Processo Seletivo','',''),
 (1589,'Processo Seletivo','',''),
 (1590,'Processo Seletivo','',''),
 (1591,'Processo Seletivo','',''),
 (1592,'chamada','',''),
 (1593,'pontuação','',''),
 (1594,'Inscritos','',''),
 (1595,'Qtd_Inscritos','',''),
 (1596,'Processo Seletivo','',''),
 (1597,'Processo Seletivo','',''),
 (1598,'Processo Seletivo','',''),
 (1599,'Processo Seletivo','',''),
 (1600,'Processo Seletivo','',''),
 (1601,'telefone','',''),
 (1602,'Processo Seletivo','',''),
 (1603,'Processo Seletivo','',''),
 (1604,'Processo Seletivo','',''),
 (1605,'Processo Seletivo','',''),
 (1606,'Processo Seletivo','',''),
 (1607,'Processo Seletivo','',''),
 (1608,'Processo Seletivo','',''),
 (1609,'Processo Seletivo','',''),
 (1610,'Processo Seletivo','',''),
 (1611,'Processo Seletivo','',''),
 (1612,'Processo Seletivo','',''),
 (1613,'Processo Seletivo','',''),
 (1614,'Processo Seletivo','',''),
 (1615,'Processo Seletivo','',''),
 (1616,'Processo Seletivo','',''),
 (1617,'Processo Seletivo','',''),
 (1618,'Processo Seletivo','',''),
 (1619,'Processo Seletivo','',''),
 (1620,'Processo Seletivo','',''),
 (1621,'Processo Seletivo','',''),
 (1622,'Processo Seletivo','',''),
 (1623,'Processo Seletivo','',''),
 (1624,'Processo Seletivo','',''),
 (1625,'Salvar dados','',''),
 (1626,'salvar_chamada','',''),
 (1627,'Processo Seletivo','',''),
 (1628,'Processo Seletivo','',''),
 (1629,'Processo Seletivo','',''),
 (1630,'Processo Seletivo','',''),
 (1631,'Processo Seletivo','',''),
 (1632,'Processo Seletivo','',''),
 (1633,'Processo Seletivo','',''),
 (1634,'Processo Seletivo','',''),
 (1635,'Processo Seletivo','',''),
 (1636,'Processo Seletivo','',''),
 (1637,'Processo Seletivo','',''),
 (1638,'Processo Seletivo','',''),
 (1639,'Processo Seletivo','',''),
 (1640,'Processo Seletivo','',''),
 (1641,'Processo Seletivo','',''),
 (1642,'Processo Seletivo','',''),
 (1643,'Processo Seletivo','',''),
 (1644,'Processo Seletivo','',''),
 (1645,'Processo Seletivo','',''),
 (1646,'Processo Seletivo','',''),
 (1647,'Processo Seletivo','',''),
 (1648,'Processo Seletivo','',''),
 (1649,'Processo Seletivo','',''),
 (1650,'Processo Seletivo','',''),
 (1651,'Processo Seletivo','',''),
 (1652,'Processo Seletivo','',''),
 (1653,'Processo Seletivo','',''),
 (1654,'Processo Seletivo','',''),
 (1655,'Processo Seletivo','',''),
 (1656,'Processo Seletivo','',''),
 (1657,'Processo Seletivo','',''),
 (1658,'Processo Seletivo','',''),
 (1659,'Processo Seletivo','',''),
 (1660,'Processo Seletivo','',''),
 (1661,'Processo Seletivo','',''),
 (1662,'Processo Seletivo','',''),
 (1663,'Processo Seletivo','',''),
 (1664,'telefone','',''),
 (1665,'Processo Seletivo','',''),
 (1666,'Processo Seletivo','',''),
 (1667,'Processo Seletivo','',''),
 (1668,'Processo Seletivo','',''),
 (1669,'Processo Seletivo','',''),
 (1670,'Processo Seletivo','',''),
 (1671,'chamada_cadastrada_com_sucesso','',''),
 (1672,'Processo Seletivo','',''),
 (1673,'Processo Seletivo','',''),
 (1674,'Processo Seletivo','',''),
 (1675,'Processo Seletivo','',''),
 (1676,'Processo Seletivo','',''),
 (1677,'Processo Seletivo','',''),
 (1678,'Processo Seletivo','',''),
 (1679,'Processo Seletivo','',''),
 (1680,'Processo Seletivo','',''),
 (1681,'Processo Seletivo','',''),
 (1682,'Processo Seletivo','',''),
 (1683,'Processo Seletivo','',''),
 (1684,'Processo Seletivo','',''),
 (1685,'Processo Seletivo','',''),
 (1686,'Processo Seletivo','',''),
 (1687,'telefone','',''),
 (1688,'Processo Seletivo','',''),
 (1689,'Processo Seletivo','',''),
 (1690,'Processo Seletivo','',''),
 (1691,'Processo Seletivo','',''),
 (1692,'Processo Seletivo','',''),
 (1693,'Processo Seletivo','',''),
 (1694,'Processo Seletivo','',''),
 (1695,'Processo Seletivo','',''),
 (1696,'Processo Seletivo','',''),
 (1697,'Processo Seletivo','',''),
 (1698,'Processo Seletivo','',''),
 (1699,'Processo Seletivo','',''),
 (1700,'Processo Seletivo','',''),
 (1701,'Processo Seletivo','',''),
 (1702,'Processo Seletivo','',''),
 (1703,'Processo Seletivo','',''),
 (1704,'Processo Seletivo','',''),
 (1705,'Processo Seletivo','',''),
 (1706,'ciências_teológicas','',''),
 (1707,'cursos','',''),
 (1708,'Processo Seletivo','',''),
 (1709,'Processo Seletivo','',''),
 (1710,'Processo Seletivo','',''),
 (1711,'Processo Seletivo','',''),
 (1712,'Processo Seletivo','',''),
 (1713,'Processo Seletivo','',''),
 (1714,'Processo Seletivo','',''),
 (1715,'Processo Seletivo','',''),
 (1716,'Processo Seletivo','',''),
 (1717,'Processo Seletivo','',''),
 (1718,'Processo Seletivo','',''),
 (1719,'Processo Seletivo','',''),
 (1720,'Processo Seletivo','',''),
 (1721,'Processo Seletivo','',''),
 (1722,'Processo Seletivo','',''),
 (1723,'Processo Seletivo','',''),
 (1724,'Processo Seletivo','',''),
 (1725,'telefone','',''),
 (1726,'Processo Seletivo','',''),
 (1727,'Processo Seletivo','',''),
 (1728,'Processo Seletivo','',''),
 (1729,'Processo Seletivo','',''),
 (1730,'Processo Seletivo','',''),
 (1731,'Processo Seletivo','',''),
 (1732,'Processo Seletivo','',''),
 (1733,'Processo Seletivo','',''),
 (1734,'Processo Seletivo','',''),
 (1735,'hora_inicio_prova','',''),
 (1736,'hora_termino_prova','',''),
 (1737,'data_abertura_inscrições_vestibular','',''),
 (1738,'data_encerramento_incrições_vestibular','',''),
 (1739,'Processo Seletivo','',''),
 (1740,'Processo Seletivo','',''),
 (1741,'Processo Seletivo','',''),
 (1742,'Processo Seletivo','',''),
 (1743,'Processo Seletivo','',''),
 (1744,'Processo Seletivo','',''),
 (1745,'data_divulgação_resultado','',''),
 (1746,'Processo Seletivo','',''),
 (1747,'Processo Seletivo','',''),
 (1748,'Processo Seletivo','',''),
 (1749,'Processo Seletivo','',''),
 (1750,'Processo Seletivo','',''),
 (1751,'Processo Seletivo','',''),
 (1752,'Processo Seletivo','',''),
 (1753,'Processo Seletivo','',''),
 (1754,'Processo Seletivo','',''),
 (1755,'Processo Seletivo','',''),
 (1756,'Processo Seletivo','',''),
 (1757,'Processo Seletivo','',''),
 (1758,'Processo Seletivo','',''),
 (1759,'Processo Seletivo','',''),
 (1760,'Processo Seletivo','',''),
 (1761,'Processo Seletivo','',''),
 (1762,'Processo Seletivo','',''),
 (1763,'Processo Seletivo','',''),
 (1764,'Processo Seletivo','',''),
 (1765,'Processo Seletivo','',''),
 (1766,'Processo Seletivo','',''),
 (1767,'Processo Seletivo','',''),
 (1768,'Processo Seletivo','',''),
 (1769,'Processo Seletivo','',''),
 (1770,'Processo Seletivo','',''),
 (1771,'Processo Seletivo','',''),
 (1772,'Processo Seletivo','',''),
 (1773,'Processo Seletivo','',''),
 (1774,'Processo Seletivo','',''),
 (1775,'Processo Seletivo','',''),
 (1776,'Processo Seletivo','',''),
 (1777,'Processo Seletivo','',''),
 (1778,'Processo Seletivo','',''),
 (1779,'Educacional','',''),
 (1780,'Processo Seletivo','',''),
 (1781,'Processo Seletivo','',''),
 (1782,'Processo Seletivo','',''),
 (1783,'Processo Seletivo','',''),
 (1784,'painel_educacional','',''),
 (1785,'Processo Seletivo','',''),
 (1786,'bolsas','',''),
 (1787,'Processo Seletivo','',''),
 (1788,'Processo Seletivo','',''),
 (1789,'Processo Seletivo','',''),
 (1790,'Processo Seletivo','',''),
 (1791,'Processo Seletivo','',''),
 (1792,'Processo Seletivo','',''),
 (1793,'Processo Seletivo','',''),
 (1794,'Processo Seletivo','',''),
 (1795,'Processo Seletivo','',''),
 (1796,'Processo Seletivo','',''),
 (1797,'Processo Seletivo','',''),
 (1798,'Processo Seletivo','',''),
 (1799,'Processo Seletivo','',''),
 (1800,'Processo Seletivo','',''),
 (1801,'Processo Seletivo','',''),
 (1802,'Processo Seletivo','',''),
 (1803,'Processo Seletivo','',''),
 (1804,'Processo Seletivo','',''),
 (1805,'Processo Seletivo','',''),
 (1806,'Processo Seletivo','',''),
 (1807,'Processo Seletivo','',''),
 (1808,'Processo Seletivo','',''),
 (1809,'Processo Seletivo','',''),
 (1810,'Processo Seletivo','',''),
 (1811,'Processo Seletivo','',''),
 (1812,'Processo Seletivo','',''),
 (1813,'Processo Seletivo','',''),
 (1814,'Processo Seletivo','',''),
 (1815,'Processo Seletivo','',''),
 (1816,'Processo Seletivo','',''),
 (1817,'Processo Seletivo','',''),
 (1818,'Processo Seletivo','',''),
 (1819,'Processo Seletivo','',''),
 (1820,'telefone','',''),
 (1821,'Processo Seletivo','',''),
 (1822,'Processo Seletivo','',''),
 (1823,'Processo Seletivo','',''),
 (1824,'Processo Seletivo','',''),
 (1825,'Processo Seletivo','',''),
 (1826,'Processo Seletivo','',''),
 (1827,'Processo Seletivo','',''),
 (1828,'Processo Seletivo','',''),
 (1829,'Processo Seletivo','',''),
 (1830,'Processo Seletivo','',''),
 (1831,'Processo Seletivo','',''),
 (1832,'Processo Seletivo','',''),
 (1833,'Processo Seletivo','',''),
 (1834,'Processo Seletivo','',''),
 (1835,'Processo Seletivo','',''),
 (1836,'Processo Seletivo','',''),
 (1837,'Processo Seletivo','',''),
 (1838,'Processo Seletivo','',''),
 (1839,'Processo Seletivo','',''),
 (1840,'Processo Seletivo','',''),
 (1841,'Processo Seletivo','',''),
 (1842,'Processo Seletivo','',''),
 (1843,'Processo Seletivo','',''),
 (1844,'Processo Seletivo','',''),
 (1845,'Processo Seletivo','',''),
 (1846,'Processo Seletivo','',''),
 (1847,'Processo Seletivo','',''),
 (1848,'gerenciar_bolsas','',''),
 (1849,'Processo Seletivo','',''),
 (1850,'Processo Seletivo','',''),
 (1851,'Processo Seletivo','',''),
 (1852,'Processo Seletivo','',''),
 (1853,'Processo Seletivo','',''),
 (1854,'Processo Seletivo','',''),
 (1855,'Processo Seletivo','',''),
 (1856,'Processo Seletivo','','');
INSERT INTO `language` (`phrase_id`,`phrase`,`Portugues`,`Português`) VALUES 
 (1857,'Processo Seletivo','',''),
 (1858,'Processo Seletivo','',''),
 (1859,'Processo Seletivo','',''),
 (1860,'Processo Seletivo','',''),
 (1861,'Processo Seletivo','',''),
 (1862,'Processo Seletivo','',''),
 (1863,'Processo Seletivo','',''),
 (1864,'Processo Seletivo','',''),
 (1865,'Processo Seletivo','',''),
 (1866,'Processo Seletivo','',''),
 (1867,'Processo Seletivo','',''),
 (1868,'Processo Seletivo','',''),
 (1869,'Processo Seletivo','',''),
 (1870,'Processo Seletivo','',''),
 (1871,'Processo Seletivo','',''),
 (1872,'Processo Seletivo','',''),
 (1873,'Processo Seletivo','',''),
 (1874,'Processo Seletivo','',''),
 (1875,'Processo Seletivo','',''),
 (1876,'Processo Seletivo','',''),
 (1877,'Processo Seletivo','',''),
 (1878,'Processo Seletivo','',''),
 (1879,'Processo Seletivo','',''),
 (1880,'Processo Seletivo','',''),
 (1881,'Processo Seletivo','',''),
 (1882,'Processo Seletivo','',''),
 (1883,'Processo Seletivo','',''),
 (1884,'Processo Seletivo','',''),
 (1885,'Processo Seletivo','',''),
 (1886,'Processo Seletivo','',''),
 (1887,'Processo Seletivo','',''),
 (1888,'Processo Seletivo','',''),
 (1889,'Processo Seletivo','',''),
 (1890,'Processo Seletivo','',''),
 (1891,'Processo Seletivo','',''),
 (1892,'Processo Seletivo','',''),
 (1893,'Processo Seletivo','',''),
 (1894,'Processo Seletivo','',''),
 (1895,'Processo Seletivo','',''),
 (1896,'Processo Seletivo','',''),
 (1897,'Processo Seletivo','',''),
 (1898,'Processo Seletivo','',''),
 (1899,'Processo Seletivo','',''),
 (1900,'Processo Seletivo','',''),
 (1901,'Processo Seletivo','',''),
 (1902,'Processo Seletivo','',''),
 (1903,'Processo Seletivo','',''),
 (1904,'Processo Seletivo','',''),
 (1905,'Processo Seletivo','',''),
 (1906,'Processo Seletivo','',''),
 (1907,'Processo Seletivo','',''),
 (1908,'Processo Seletivo','',''),
 (1909,'Processo Seletivo','',''),
 (1910,'Processo Seletivo','',''),
 (1911,'Processo Seletivo','',''),
 (1912,'Processo Seletivo','',''),
 (1913,'Processo Seletivo','',''),
 (1914,'Processo Seletivo','',''),
 (1915,'Processo Seletivo','',''),
 (1916,'Processo Seletivo','',''),
 (1917,'Processo Seletivo','',''),
 (1918,'telefone','',''),
 (1919,'telefone','',''),
 (1920,'Processo Seletivo','',''),
 (1921,'Processo Seletivo','',''),
 (1922,'Processo Seletivo','',''),
 (1923,'Processo Seletivo','',''),
 (1924,'Processo Seletivo','',''),
 (1925,'Processo Seletivo','',''),
 (1926,'Processo Seletivo','',''),
 (1927,'Processo Seletivo','',''),
 (1928,'Processo Seletivo','',''),
 (1929,'Processo Seletivo','',''),
 (1930,'Processo Seletivo','',''),
 (1931,'Processo Seletivo','',''),
 (1932,'Processo Seletivo','',''),
 (1933,'Processo Seletivo','',''),
 (1934,'Processo Seletivo','',''),
 (1935,'Processo Seletivo','',''),
 (1936,'Processo Seletivo','',''),
 (1937,'Processo Seletivo','',''),
 (1938,'Processo Seletivo','',''),
 (1939,'Processo Seletivo','',''),
 (1940,'Processo Seletivo','',''),
 (1941,'Processo Seletivo','',''),
 (1942,'Processo Seletivo','',''),
 (1943,'Processo Seletivo','',''),
 (1944,'Processo Seletivo','',''),
 (1945,'Processo Seletivo','',''),
 (1946,'Processo Seletivo','',''),
 (1947,'Processo Seletivo','',''),
 (1948,'Processo Seletivo','',''),
 (1949,'Processo Seletivo','',''),
 (1950,'Processo Seletivo','',''),
 (1951,'Processo Seletivo','',''),
 (1952,'Processo Seletivo','',''),
 (1953,'Processo Seletivo','',''),
 (1954,'Processo Seletivo','',''),
 (1955,'Processo Seletivo','',''),
 (1956,'Processo Seletivo','',''),
 (1957,'Processo Seletivo','',''),
 (1958,'Processo Seletivo','',''),
 (1959,'Processo Seletivo','',''),
 (1960,'Processo Seletivo','',''),
 (1961,'Processo Seletivo','',''),
 (1962,'Processo Seletivo','',''),
 (1963,'Processo Seletivo','',''),
 (1964,'Processo Seletivo','',''),
 (1965,'Processo Seletivo','',''),
 (1966,'Processo Seletivo','',''),
 (1967,'painel_educacional > gerenciar_bolsas >','',''),
 (1968,'painel_educacional > <a href=\"\">gerenciar_bolsas</a>','',''),
 (1969,'painel_educacional > <a href=\"\">Gerenciar_bolsas</a>','',''),
 (1970,'painel_educacional <b>></b> <a href=\"\">Gerenciar_bolsas</a>','',''),
 (1971,'<a href=\"\">painel_educacional</a><b>></b> <a href=\"\">Gerenciar_bolsas</a>','',''),
 (1972,'<a href=\"\">Painel_educacional</a><b>></b> <a href=\"\">Gerenciar_bolsas</a>','',''),
 (1973,'<a href=\"\">Painel_educacional </a><b>></b> <a href=\"\">Gerenciar_bolsas</a>','',''),
 (1974,'<a href=\"\">Painel_educacional </a><b>-></b> <a href=\"\">Gerenciar_bolsas</a>','',''),
 (1975,'Processo Seletivo','',''),
 (1976,'Processo Seletivo','',''),
 (1977,'Processo Seletivo','',''),
 (1978,'<a href=\"index.php?admin/educacional\">Painel_educacional </a><b>></b> <a href=\"\">Gerenciar_bolsas</a>','',''),
 (1979,'Processo Seletivo','',''),
 (1980,'Processo Seletivo','',''),
 (1981,'Processo Seletivo','',''),
 (1982,'Processo Seletivo','',''),
 (1983,'Processo Seletivo','',''),
 (1984,'Painel Geral <a href=\"index.php?admin/educacional\">Painel_educacional </a><b>></b> <a href=\"\">Gerenciar_bolsas</a>','',''),
 (1985,'Painel Geral > <a href=\"index.php?admin/educacional\">Painel_educacional </a><b>></b> <a href=\"\">Gerenciar_bolsas</a>','',''),
 (1986,'Painel Geral --> <a href=\"index.php?admin/educacional\">Painel_educacional </a><b>></b> <a href=\"\">Gerenciar_bolsas</a>','',''),
 (1987,'Processo Seletivo','',''),
 (1988,'Processo Seletivo','',''),
 (1989,'Processo Seletivo','',''),
 (1990,'<a href=\"\">Painel Geral</a> > <a href=\"index.php?admin/educacional\">Painel_educacional </a><b>></b> <a href=\"\">Gerenciar_bolsas</a>','',''),
 (1991,'Processo Seletivo','',''),
 (1992,'Processo Seletivo','',''),
 (1993,'Processo Seletivo','',''),
 (1994,'Processo Seletivo','',''),
 (1995,'Processo Seletivo','',''),
 (1996,'Processo Seletivo','',''),
 (1997,'<a href=\"index.php?admin/dashboard\">Painel Geral</a> > <a href=\"index.php?admin/educacional\">Painel_educacional </a><b>></b> <a href=\"\">Gerenciar_bolsas</a>','',''),
 (1998,'Processo Seletivo','',''),
 (1999,'Processo Seletivo','',''),
 (2000,'Processo Seletivo','',''),
 (2001,'Processo Seletivo','',''),
 (2002,'Processo Seletivo','',''),
 (2003,'Processo Seletivo','',''),
 (2004,'Processo Seletivo','',''),
 (2005,'lista_bolsas','',''),
 (2006,'add_bolsas','',''),
 (2007,'Processo Seletivo','',''),
 (2008,'Processo Seletivo','',''),
 (2009,'Processo Seletivo','',''),
 (2010,'Processo Seletivo','',''),
 (2011,'Processo Seletivo','',''),
 (2012,'Processo Seletivo','',''),
 (2013,'Processo Seletivo','',''),
 (2014,'Processo Seletivo','',''),
 (2015,'Processo Seletivo','',''),
 (2016,'Processo Seletivo','',''),
 (2017,'Processo Seletivo','',''),
 (2018,'Processo Seletivo','',''),
 (2019,'Processo Seletivo','',''),
 (2020,'Processo Seletivo','',''),
 (2021,'descrição','',''),
 (2022,'porcentagem_mínima','',''),
 (2023,'porcentagem_máxima','',''),
 (2024,'Processo Seletivo','',''),
 (2025,'Processo Seletivo','',''),
 (2026,'Processo Seletivo','',''),
 (2027,'Processo Seletivo','',''),
 (2028,'Processo Seletivo','',''),
 (2029,'Processo Seletivo','',''),
 (2030,'descricao','',''),
 (2031,'add_bolsa','',''),
 (2032,'bolsa_cadastrada_com_sucesso','',''),
 (2033,'Processo Seletivo','',''),
 (2034,'Processo Seletivo','',''),
 (2035,'Processo Seletivo','',''),
 (2036,'Processo Seletivo','',''),
 (2037,'Processo Seletivo','',''),
 (2038,'Processo Seletivo','',''),
 (2039,'Processo Seletivo','',''),
 (2040,'Processo Seletivo','',''),
 (2041,'Processo Seletivo','',''),
 (2042,'Processo Seletivo','',''),
 (2043,'Processo Seletivo','',''),
 (2044,'Processo Seletivo','',''),
 (2045,'Processo Seletivo','',''),
 (2046,'Processo Seletivo','',''),
 (2047,'Processo Seletivo','',''),
 (2048,'Processo Seletivo','',''),
 (2049,'Processo Seletivo','',''),
 (2050,'Processo Seletivo','',''),
 (2051,'Processo Seletivo','',''),
 (2052,'Processo Seletivo','',''),
 (2053,'Processo Seletivo','',''),
 (2054,'Processo Seletivo','',''),
 (2055,'Processo Seletivo','',''),
 (2056,'Processo Seletivo','',''),
 (2057,'Processo Seletivo','',''),
 (2058,'Processo Seletivo','',''),
 (2059,'Processo Seletivo','',''),
 (2060,'deletard','',''),
 (2061,'Processo Seletivo','',''),
 (2062,'Processo Seletivo','',''),
 (2063,'Processo Seletivo','',''),
 (2064,'Processo Seletivo','',''),
 (2065,'Processo Seletivo','',''),
 (2066,'Processo Seletivo','',''),
 (2067,'Processo Seletivo','',''),
 (2068,'Processo Seletivo','',''),
 (2069,'Ano','',''),
 (2070,'Semestre','',''),
 (2071,'Tipo','',''),
 (2072,'Processo Seletivo','',''),
 (2073,'Processo Seletivo','',''),
 (2074,'Processo Seletivo','',''),
 (2075,'Processo Seletivo','',''),
 (2076,'Processo Seletivo','',''),
 (2077,'Processo Seletivo','',''),
 (2078,'bolsa_deletada_com_sucesso','',''),
 (2079,'Processo Seletivo','',''),
 (2080,'Processo Seletivo','',''),
 (2081,'Processo Seletivo','',''),
 (2082,'Processo Seletivo','',''),
 (2083,'Processo Seletivo','',''),
 (2084,'Processo Seletivo','',''),
 (2085,'Processo Seletivo','',''),
 (2086,'Processo Seletivo','',''),
 (2087,'periodo_letivo','',''),
 (2088,'Processo Seletivo','',''),
 (2089,'Processo Seletivo','',''),
 (2090,'Processo Seletivo','',''),
 (2091,'Processo Seletivo','',''),
 (2092,'Processo Seletivo','',''),
 (2093,'Processo Seletivo','',''),
 (2094,'Processo Seletivo','',''),
 (2095,'Processo Seletivo','',''),
 (2096,'Processo Seletivo','',''),
 (2097,'Processo Seletivo','',''),
 (2098,'Processo Seletivo','',''),
 (2099,'Processo Seletivo','',''),
 (2100,'Processo Seletivo','',''),
 (2101,'Processo Seletivo','',''),
 (2102,'Processo Seletivo','',''),
 (2103,'Processo Seletivo','',''),
 (2104,'Processo Seletivo','',''),
 (2105,'Processo Seletivo','',''),
 (2106,'Processo Seletivo','',''),
 (2107,'Processo Seletivo','',''),
 (2108,'<a href=\"index.php?admin/dashboard\">Painel Geral</a> > <a href=\"index.php?admin/educacional\">Painel_educacional </a><b>></b> <a href=\"\">Gerenciar_cursos</a>','',''),
 (2109,'Processo Seletivo','',''),
 (2110,'Processo Seletivo','',''),
 (2111,'Processo Seletivo','',''),
 (2112,'Processo Seletivo','',''),
 (2113,'Processo Seletivo','',''),
 (2114,'Processo Seletivo','',''),
 (2115,'Processo Seletivo','',''),
 (2116,'Processo Seletivo','',''),
 (2117,'Processo Seletivo','',''),
 (2118,'Processo Seletivo','',''),
 (2119,'Processo Seletivo','',''),
 (2120,'Processo Seletivo','',''),
 (2121,'lista_cursos','',''),
 (2122,'novo curso','',''),
 (2123,'Nome do Curso','',''),
 (2124,'Nome Abrev. do Curso','',''),
 (2125,'coordenador(a)','',''),
 (2126,'duracao_do_curso_(semestre(s))','',''),
 (2127,'horas_de_atividade_complementares_obrigatorias','',''),
 (2128,'horas_de_estagio_obrigatoria','',''),
 (2129,'valor_do_curso','',''),
 (2130,'habilitacao_do_curso','',''),
 (2131,'Processo Seletivo','',''),
 (2132,'Processo Seletivo','',''),
 (2133,'Processo Seletivo','',''),
 (2134,'add_curso','',''),
 (2135,'criar_curso','',''),
 (2136,'Processo Seletivo','',''),
 (2137,'habilita','',''),
 (2138,'horas_de_estagio_obrigatorio','',''),
 (2139,'horas_de_atividade_complementares_obrigatorio','',''),
 (2140,'curso_cadastrado_com_sucesso','',''),
 (2141,'Abrev.','',''),
 (2142,'Curso','',''),
 (2143,'Habilitacao','',''),
 (2144,'Coordenador','',''),
 (2145,'Valor','',''),
 (2146,'op','',''),
 (2147,'op','',''),
 (2148,'op','',''),
 (2149,'op','',''),
 (2150,'op','',''),
 (2151,'op','',''),
 (2152,'op','',''),
 (2153,'curso_deletado_com_sucesso','',''),
 (2154,'op','',''),
 (2155,'Processo Seletivo','',''),
 (2156,'Processo Seletivo','',''),
 (2157,'Processo Seletivo','',''),
 (2158,'telefone','',''),
 (2159,'Processo Seletivo','',''),
 (2160,'Processo Seletivo','',''),
 (2161,'Processo Seletivo','',''),
 (2162,'Ano','',''),
 (2163,'Semestre','',''),
 (2164,'Tipo','',''),
 (2165,'Processo Seletivo','',''),
 (2166,'Processo Seletivo','',''),
 (2167,'Processo Seletivo','',''),
 (2168,'op','',''),
 (2169,'op','',''),
 (2170,'op','',''),
 (2171,'op','',''),
 (2172,'op','',''),
 (2173,'op','',''),
 (2174,'op','',''),
 (2175,'op','',''),
 (2176,'op','',''),
 (2177,'op','',''),
 (2178,'op','',''),
 (2179,'op','',''),
 (2180,'op','','');
/*!40000 ALTER TABLE `language` ENABLE KEYS */;


--
-- Definition of table `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs` (
  `logs_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_nb_tabela` int(11) DEFAULT NULL,
  `log_dt_data_hora` datetime DEFAULT NULL,
  `log_nb_codigo_tabela` int(11) DEFAULT NULL,
  `log_nb_usuario` int(11) DEFAULT NULL,
  `usuarios_id` int(11) NOT NULL,
  `acoes_id` int(11) NOT NULL,
  PRIMARY KEY (`logs_id`),
  KEY `FK_logs_usuario` (`usuarios_id`),
  KEY `fk_logs_acoes1` (`acoes_id`),
  CONSTRAINT `fk_logs_acoes1` FOREIGN KEY (`acoes_id`) REFERENCES `acoes` (`acoes_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_logs_usuario` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`usuarios_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logs`
--

/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;


--
-- Definition of table `mark`
--

DROP TABLE IF EXISTS `mark`;
CREATE TABLE `mark` (
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mark`
--

/*!40000 ALTER TABLE `mark` DISABLE KEYS */;
INSERT INTO `mark` (`mark_id`,`student_id`,`subject_id`,`class_id`,`exam_id`,`mark_obtained`,`mark_total`,`attendance`,`comment`) VALUES 
 (1,4,1,2,3,10,100,3,''),
 (2,6,1,2,3,0,100,0,''),
 (3,9,1,2,3,0,100,0,''),
 (4,10,1,2,3,0,100,0,''),
 (5,1,1,4,3,10,100,10,''),
 (6,4,1,4,3,0,100,0,''),
 (7,5,1,4,3,0,100,0,'');
/*!40000 ALTER TABLE `mark` ENABLE KEYS */;


--
-- Definition of table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `menus_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `men_tx_descricao` varchar(100) DEFAULT NULL,
  `men_tx_url` varchar(100) DEFAULT NULL,
  `men_nb_posicao` int(11) DEFAULT NULL,
  `modulos_id` int(11) NOT NULL,
  `men_tx_url_image` varchar(100) NOT NULL DEFAULT '',
  `men_tx_tabela` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`menus_id`),
  KEY `fk_menus_modulos1_idx` (`modulos_id`),
  CONSTRAINT `fk_menus_modulos1` FOREIGN KEY (`modulos_id`) REFERENCES `modulos` (`modulos_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menus`
--

/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` (`menus_id`,`nome`,`men_tx_descricao`,`men_tx_url`,`men_nb_posicao`,`modulos_id`,`men_tx_url_image`,`men_tx_tabela`) VALUES 
 (19,'alunos','cadastro, update, delete de aluno',NULL,NULL,2,'template/images/icons/user.png',''),
 (20,'contas','cadastro, update, delete de aluno',NULL,NULL,2,'',''),
 (23,'vestibular',NULL,'index.php?admin/vestibular',NULL,1,'template/images/icons_menu/vestibular.png','vestibular'),
 (24,'chamada vest',NULL,'index.php?admin/vestibularChamada',NULL,1,'template/images/icons_menu/chamada.png','vestibular'),
 (25,'candidato',NULL,'index.php?admin/candidato',NULL,1,'template/images/icons_menu/candidato.png','candidato'),
 (26,'bolsas',NULL,'index.php?educacional/bolsas',NULL,3,'template/images/icons_menu/bolsas.png','bolsas'),
 (28,'periodo_letivo',NULL,'index.php?educacional/periodo',NULL,3,'template/images/icons_menu/periodo_letivo.png','periodo_letivo'),
 (30,'cursos',NULL,'index.php?educacional/cursos',NULL,3,'template/images/icons_menu/bolsas.png','cursos');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;


--
-- Definition of table `modulos`
--

DROP TABLE IF EXISTS `modulos`;
CREATE TABLE `modulos` (
  `modulos_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `mod_tx_url_imagem` varchar(300) DEFAULT NULL,
  `mod_tx_url` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`modulos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modulos`
--

/*!40000 ALTER TABLE `modulos` DISABLE KEYS */;
INSERT INTO `modulos` (`modulos_id`,`nome`,`mod_tx_url_imagem`,`mod_tx_url`) VALUES 
 (1,'Processo Seletivo','template/images/icons_modulo/processo_seletivo.png','index.php?admin/processo'),
 (2,'Financeiro','template/images/icons_modulo/financeiro.png','index.php?admin/financeiro'),
 (3,'Educacional','template/images/icons_modulo/educacional.png','index.php?admin/educacional');
/*!40000 ALTER TABLE `modulos` ENABLE KEYS */;


--
-- Definition of table `noticeboard`
--

DROP TABLE IF EXISTS `noticeboard`;
CREATE TABLE `noticeboard` (
  `notice_id` int(11) NOT NULL AUTO_INCREMENT,
  `notice_title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `notice` longtext COLLATE utf8_unicode_ci NOT NULL,
  `create_timestamp` int(11) NOT NULL,
  PRIMARY KEY (`notice_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `noticeboard`
--

/*!40000 ALTER TABLE `noticeboard` DISABLE KEYS */;
INSERT INTO `noticeboard` (`notice_id`,`notice_title`,`notice`,`create_timestamp`) VALUES 
 (5,'TESTE VALEU','cARNAVAL 2015',0),
 (7,'KAROL','FTFTFTFTFTF',0);
/*!40000 ALTER TABLE `noticeboard` ENABLE KEYS */;


--
-- Definition of table `parent`
--

DROP TABLE IF EXISTS `parent`;
CREATE TABLE `parent` (
  `parent_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `student_id` int(11) NOT NULL,
  `relation_with_student` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `profession` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `parent`
--

/*!40000 ALTER TABLE `parent` DISABLE KEYS */;
INSERT INTO `parent` (`parent_id`,`name`,`email`,`password`,`student_id`,`relation_with_student`,`phone`,`address`,`profession`) VALUES 
 (1,'Pai Jorge','jorge@gbyteinfo.com.br','jorge232528',5,'Pai','2222-2222','rua teste','Autonomo'),
 (3,'xxxxx','resp@resp.com.br','1234',7,'Pai','6792446585','Miguel Angelo',''),
 (4,'Diogo','diogo.feitosa@tng.com.br','12345678',9,'Pai','1321357','Rua teste',''),
 (5,'dsfsdf','resp@resp','321',1,'ewrwr','324243','dsfsafa afasdfasf','coodenador');
/*!40000 ALTER TABLE `parent` ENABLE KEYS */;


--
-- Definition of table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_type` longtext COLLATE utf8_unicode_ci NOT NULL,
  `transaction_id` longtext COLLATE utf8_unicode_ci NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `method` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment`
--

/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;


--
-- Definition of table `perfis`
--

DROP TABLE IF EXISTS `perfis`;
CREATE TABLE `perfis` (
  `perfis_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `per_tx_descricao` varchar(100) NOT NULL,
  PRIMARY KEY (`perfis_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `perfis`
--

/*!40000 ALTER TABLE `perfis` DISABLE KEYS */;
INSERT INTO `perfis` (`perfis_id`,`nome`,`per_tx_descricao`) VALUES 
 (11,'admin geral do sistema','ADMINISTRADOR GERAL DO SISTEMA, POSSUI TODOS OS PRIVILEGIOS');
/*!40000 ALTER TABLE `perfis` ENABLE KEYS */;


--
-- Definition of table `periodo_letivo`
--

DROP TABLE IF EXISTS `periodo_letivo`;
CREATE TABLE `periodo_letivo` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `periodo_letivo`
--

/*!40000 ALTER TABLE `periodo_letivo` DISABLE KEYS */;
/*!40000 ALTER TABLE `periodo_letivo` ENABLE KEYS */;


--
-- Definition of table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`settings_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`settings_id`,`type`,`description`) VALUES 
 (1,'system_name','Faculdade Boas Novas'),
 (2,'system_title','Weconn Sistemas'),
 (3,'address','Dhaka, Bangladesh'),
 (4,'phone','+8012654159'),
 (5,'paypal_email','contato@dedial.com'),
 (6,'currency','BRL'),
 (7,'system_email','escolacontinental@yahoo.com.br');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;


--
-- Definition of table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `student`
--

/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` (`student_id`,`name`,`birthday`,`sex`,`religion`,`blood_group`,`address`,`phone`,`email`,`password`,`father_name`,`mother_name`,`class_id`,`roll`,`transport_id`,`dormitory_id`,`dormitory_room_number`) VALUES 
 (1,'Jonathan','03/25/2015','male','','','','','mario@mario','123','','','4','',0,0,''),
 (2,'Maria','03/04/2015','female','','','Maria','1234 1234','maria@maria.com','maria','Maria','Maria','7','?',0,0,''),
 (3,'symon','03/23/2015','male','','','','','ok@ok','123456','','','8','',0,0,''),
 (5,'Caio','','male','','','','','','','','','4','',0,0,''),
 (6,'Zé','','male','','','','','','','','','9','',0,0,''),
 (7,'Edelvito Araujo','03/30/2015','male','','','','','','','','','8','',0,0,'');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;


--
-- Definition of table `sub_menus`
--

DROP TABLE IF EXISTS `sub_menus`;
CREATE TABLE `sub_menus` (
  `sub_menus_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `sub_tx_url` varchar(100) NOT NULL,
  `sub_nb_posicao` int(11) NOT NULL,
  `menus_id` int(11) NOT NULL,
  PRIMARY KEY (`sub_menus_id`),
  KEY `fk_sub_menus_menus1_idx` (`menus_id`),
  CONSTRAINT `fk_sub_menus_menus1` FOREIGN KEY (`menus_id`) REFERENCES `menus` (`menus_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_menus`
--

/*!40000 ALTER TABLE `sub_menus` DISABLE KEYS */;
/*!40000 ALTER TABLE `sub_menus` ENABLE KEYS */;


--
-- Definition of table `subject`
--

DROP TABLE IF EXISTS `subject`;
CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subject`
--

/*!40000 ALTER TABLE `subject` DISABLE KEYS */;
INSERT INTO `subject` (`subject_id`,`name`,`class_id`,`teacher_id`) VALUES 
 (1,'Reunião',4,2),
 (2,'Prova',0,0),
 (3,'Prova',0,0);
/*!40000 ALTER TABLE `subject` ENABLE KEYS */;


--
-- Definition of table `teacher`
--

DROP TABLE IF EXISTS `teacher`;
CREATE TABLE `teacher` (
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `teacher`
--

/*!40000 ALTER TABLE `teacher` DISABLE KEYS */;
INSERT INTO `teacher` (`teacher_id`,`name`,`birthday`,`sex`,`religion`,`blood_group`,`address`,`phone`,`email`,`password`) VALUES 
 (2,'João da Silva','01/01/1970','male','','','Rua dos Marotos','55 1234 1234','joao@joao.com','joao'),
 (3,'teste','03/21/2015','male','','','teste','tete','professor@professor','123456'),
 (5,'Aloisio Santos','04/23/2015','male','','','Rua das marias','34922422598','aloisio@gmail.com','04131973'),
 (6,'jose mathias','04/15/1980','male','','','rua b','51656566565','maria@gmail.com','123456789');
/*!40000 ALTER TABLE `teacher` ENABLE KEYS */;


--
-- Definition of table `transport`
--

DROP TABLE IF EXISTS `transport`;
CREATE TABLE `transport` (
  `transport_id` int(11) NOT NULL AUTO_INCREMENT,
  `route_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `number_of_vehicle` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `route_fare` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`transport_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transport`
--

/*!40000 ALTER TABLE `transport` DISABLE KEYS */;
INSERT INTO `transport` (`transport_id`,`route_name`,`number_of_vehicle`,`description`,`route_fare`) VALUES 
 (1,'Centro','1','Van do seu Mario','10');
/*!40000 ALTER TABLE `transport` ENABLE KEYS */;


--
-- Definition of table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
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
  KEY `FK_usuarios_2` (`perfis_id`),
  CONSTRAINT `FK_usuarios_2` FOREIGN KEY (`perfis_id`) REFERENCES `perfis` (`perfis_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios`
--

/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`usuarios_id`,`nome`,`usu_tx_login`,`usu_tx_senha`,`usu_tx_email`,`perfis_id`,`usu_tx_url_foto`,`usu_nb_tipo`,`usu_nb_status`) VALUES 
 (1,'Karol Oliveira','karol','123','',11,NULL,0,NULL),
 (2,'Joao','joao','123','',11,NULL,0,NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;


--
-- Definition of table `vestibular`
--

DROP TABLE IF EXISTS `vestibular`;
CREATE TABLE `vestibular` (
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
) ENGINE=InnoDB AUTO_INCREMENT=498 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vestibular`
--

/*!40000 ALTER TABLE `vestibular` DISABLE KEYS */;
INSERT INTO `vestibular` (`vestibular_id`,`vest_nb_ano`,`vest_dt_realizacao`,`vest_tx_semestre`,`vest_nb_tipo`,`vest_dt_inscricao`,`vest_dt_encerramento`,`vest_dt_resultado`,`vest_tx_inicio`,`vest_tx_fim`) VALUES 
 (496,'2015','2015-04-28','II',1,'2015-04-23','2015-04-23','2015-04-30','14:15','17:15'),
 (497,'2015','2015-04-29','I',2,'2015-04-23','2015-04-23','2015-04-30','14:15','17:15');
/*!40000 ALTER TABLE `vestibular` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
