<html >
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="template/jquery.quick.search.js"></script>
    <?php include 'application/views/header.php'; ?>
    <style type="text/css">

        body{ font-family:"Trebuchet MS", Arial, Helvetica, sans-serif }

        *{
            margin: 0px;
            padding: 0px;
            font-family: Fineness Regular;
        }
        a:link { text-decoration:none;  }
        a:visited { text-decoration:none;  }
        a:hover { text-decoration:none;  }
        a:active { text-decoration:none;  }


        /* > Para o input */
        .input-search{
            width: 300px;
            border: 1px solid #CCC;
            padding:5px 14px;
            font-size:12px;
            margin:10px 0;
            float:left;

            -webkit-border-radius:15px;
            -moz-border-radius:15px;
            -ms-border-radius:15px;
            -o-border-radius:15px;
            border-radius:15px;
        }
        .input-search::-webkit-input-placeholder{ font-style:italic }
        .input-search:-moz-placeholder			{ font-style:italic }
        .input-search:-ms-input-placeholder		{ font-style:italic }





    </style>
    <script language="JavaScript" type="text/javascript">

        function ShowHideDIV(NomeDIV, Valor) {

            if (Valor == "1")
            {
                document.getElementById(NomeDIV).style.display = "block";

            }
            else
            {
                document.getElementById(NomeDIV).style.display = "none";
            }
        }
    </script>
    <?php

    function exibirData($data) {
        $rData = explode("-", $data);
        $rData = $rData[2] . '/' . $rData[1] . '/' . $rData[0];
        return $rData;
    }
    ?>
    <script language="JavaScript" type="text/javascript">
        function mascara(t, mask) {
            var i = t.value.length;
            var saida = mask.substring(1, 0);
            var texto = mask.substring(i)
            if (texto.substring(0, 1) != saida) {
                t.value += texto.substring(0, 1);
            }
        }
    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }



        function buscar_paginacao_despesas() {
            var status = $('#status').val();  //codigo do estado escolhido
            var mes_de = $('#mes_de').val();
            var ano_de = $('#ano_de').val();
            var mes_ate = $('#mes_ate').val();
            var ano_ate = $('#ano_ate').val();
            var busca = $('#busca').val();

            //if ((aluno) || (curso != '0') || (turma != '0')) {
            var url = 'index.php?admin/carrega_table_receitas/' + status + '/' + mes_de + '/' + ano_de + '/' + mes_ate + '/' + ano_ate;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_paginacao').html(dataReturn);  //coloco na div o retorno da requisicao
            });
            //  }else{
            //      alert('Selecione um curso e turma');
            //  }
        }


    </script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();
                $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
            });
        });

        function exibir_div(el) {
            var display = document.getElementById(el).style.display;
            if (display == "none")
                document.getElementById(el).style.display = 'block';

        }

        function ocultar_div(el) {
            var display = document.getElementById(el).style.display;
            if (display == "block")
                document.getElementById(el).style.display = 'none';
        }
    </script>
    <script language="JavaScript" type="text/javascript">

            function ShowHideDIV(NomeDIV, Valor){

              if (Valor == "1") 
              {
                document.getElementById(NomeDIV).style.display = "block";
            
              }
              else
              {
                document.getElementById(NomeDIV).style.display = "none";
               }
            }
    </script>
    <script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

  function buscar_municipio() {
        var uf = $('#uf_nascimento').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (uf) {
            var url = 'index.php?admin/carrega_municipio_ficha_aluno/' + uf;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_muncipio_ficha_aluno').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }
        function buscar_deficiencia_ficha_aluno() {
        var deficiencia = $('#deficiencia').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (deficiencia) {
            var url = 'index.php?admin/carrega_doencas/' + deficiencia;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_doencas_ficha_aluno').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }
    function buscar_municipio_endereco() {
        var uf = $('#uf').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (uf) {
            var url = 'index.php?admin/carrega_municipio_ficha_aluno_endereco/' + uf;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_muncipio_ficha_aluno_endereco').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }
    
    function buscar_ficha_aluno(matricula) {
        var matricula_id = matricula;//$('#candidato_id').val(); 
        //se encontrou o estado
        if (matricula_id) {
            var url = 'index.php?admin/carrega_ficha_aluno/' + matricula_id;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#box').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        } else {
            alert('Selecione um aluno');
        }
    }

    function buscar_turma() {
        var curso = $('#curso').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (curso) {
            var url = 'index.php?admin/carrega_turma/' + curso;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_turma').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }

    function buscar_matriz() {
        var curso = $('#curso').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (curso) {
            var url = 'index.php?admin/carrega_matriz/' + curso;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_matriz').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }

    function buscar_paginacao() {
        var aluno = $('#aluno').val();  //codigo do estado escolhido
        var curso = $('#curso').val();
        var turma = $('#turma').val();
        //se encontrou o estado
        if ((aluno) || (curso) || (turma)) {
            var url = 'index.php?admin/carrega_table_paginacao/' + curso + '/' + turma + '/' + aluno;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_paginacao').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }

    function buscar_deficiencia2() {
        var deficiencia2 = $('#deficiencia2').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (deficiencia2) {
            var url = 'index.php?admin/carrega_doencas2/' + deficiencia2;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_doencas2').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }
</script>
    <body>
        <?php

        function datasql($databr) {
            if (!empty($databr)) {
                $p_dt = explode('/', $databr);
                $data_sql = $p_dt[2] . '-' . $p_dt[1] . '-' . $p_dt[0];
                return $data_sql;
            }
        }
        ?>
        <div id="wrapper">

            <!-- begin TOP NAVIGATION -->
            <?php include 'application/views/top.php'; ?>
            <!-- /.navbar-top -->
            <!-- end TOP NAVIGATION -->

            <!-- begin SIDE NAVIGATION -->
            <?php include 'application/views/menu_lateral.php'; ?>
            <!-- /.navbar-side -->
            <!-- end SIDE NAVIGATION -->

            <!-- begin MAIN PAGE CONTENT -->
            <div id="page-wrapper">
                
                <div class="page-content">


                    <!-- begin PAGE TITLE AREA -->
                    <!-- Use this section for each page's title and breadcrumb layout. In this example a date range picker is included within the breadcrumb. -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-title">
                                <h1>Ficha do aluno

                                </h1>
                                <ol class="breadcrumb">
                                    <li><i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                                    </li>
                                    <li class="active">Ficha de cadastro do aluno</li>
                                </ol>
                            </div>
                        </div>

                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <!-- end PAGE TITLE AREA -->
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="nav nav-tabs nav-tabs-left">

                                <?php
                                foreach ($turma as $row):
                                    $matricula = $row['matricula_aluno_id'];
                                endforeach;
                                ?>
                                <li >
                                    <a  href="index.php?admin/situacao_aluno/<?php echo $matricula; ?>" 	>
                                        <i class="icon-angle-left"></i> <?php echo get_phrase('voltar_para_situação_aluno'); ?>
                                    </a>
                                </li>

                            </ul>
                            
                            
                            <?php
    $sql = "SELECT *
                FROM matricula_aluno ma
                inner join cadastro_aluno ca on ca.cadastro_aluno_id = ma.cadastro_aluno_id
                inner join cursos cur on cur.cursos_id = ma.curso_id
                left join dados_censo_aluno dca on dca.cadastro_aluno_id = ca.cadastro_aluno_id
                where  ma.matricula_aluno_id = $matricula  ";
    //echo $sql;
    $MatrizArray = $this->db->query($sql)->result_array();

    $count = 1;

    foreach ($MatrizArray as $row):
        $matricula_aluno_id = $row['matricula_aluno_id'];
        $curso = $row['cur_tx_descricao'];
        if ($row['uf_nascimento']) {
            $uf_nascimento = $row['uf_nascimento'];
        } else {
            $uf_nascimento = 0;
        }

        if ($row['municipio_nascimento']) {
            $cidade_nascimento = $row['municipio_nascimento'];
        } else {
            $cidade_nascimento = 0;
        }
        
        if ($row['pais_origem']) {
            $pais_origem = $row['pais_origem'];
        } else {
            $pais_origem = 0;
        }

        /*** pais origem ***/
        $sql_pais_origem = "SELECT * FROM pais where codigo = '$pais_origem' ";
        $sqlpais_origem = $this->db->query($sql_pais_origem)->result_array();

        foreach ($sqlpais_origem as $row_po):
            $po_codigo = $row_po['codigo'];
            $po_nome = $row_po['nome'];
        endforeach;

        /*         * * UF nascimento** */
        $sql_uf_nascimento = "SELECT * FROM uf where codigo = $uf_nascimento ";
        $uf_nasc = $this->db->query($sql_uf_nascimento)->result_array();

        foreach ($uf_nasc as $row_uf):
            $uf_codigo = $row_uf['codigo'];
            $uf_nome = $row_uf['nome'];
        endforeach;

        /*         * * UF RG** */
        if ($row['rg_uf']) {
            $uf_rg = $row['rg_uf'];
        } else {
            $uf_rg = 0;
        }
        $sql_uf_rg = "SELECT * FROM uf where codigo = $uf_rg ";
        $uf_rg2 = $this->db->query($sql_uf_rg)->result_array();

        foreach ($uf_rg2 as $row_rg):
            $uf_rg_nome = $row_rg['nome'];
        endforeach;

        /*         * * UF TÍTULO** */
        if ($row['uf_titulo']) {
            $uf_titulo = $row['uf_titulo'];
        } else {
            $uf_titulo = 0;
        }
        $sql_uf_titulo = "SELECT * FROM uf where codigo = $uf_nascimento ";
        $uf_tit = $this->db->query($sql_uf_titulo)->result_array();

        foreach ($uf_tit as $row_tit):
            $uf_tit_nome = $row_tit['nome'];
        endforeach;

        /*         * * UF CERTIDÃO DE RESERVISTA** */
        if ($row['uf_cert_reservista']) {
            $uf_cert_reservista = $row['uf_cert_reservista'];
        } else {
            $uf_cert_reservista = 0;
        }
        $sql_uf_reservista = "SELECT * FROM uf where codigo = $uf_cert_reservista ";
        $uf_reservista = $this->db->query($sql_uf_reservista)->result_array();

        foreach ($uf_reservista as $row_reservista):
            $uf_reservista_nome = $row_reservista['nome'];
        endforeach;


        /*         * * UF ENDEREÇO - MORADIA** */
        if ($row['uf']) {
            $uf_endereco = $row['uf'];
        } else {
            $uf_endereco = 0;
        }
        $sql_uf_endereco = "SELECT * FROM uf where codigo = $uf_endereco ";
        $uf_end = $this->db->query($sql_uf_endereco)->result_array();

        foreach ($uf_end as $row_endereco):
            $uf_endereco_nome = $row_endereco['nome'];
        endforeach;


        /* município nascimento* */

        $sql = "SELECT * FROM municipio where codigo = $cidade_nascimento  ";
        $mun = $this->db->query($sql)->result_array();
        foreach ($mun as $row_mun):
            $mun_codigo = $row_mun['codigo'];
            $mun_nome = $row_mun['nome'];
        endforeach;

        $sexo = $row['sexo'];
        if ($sexo == '0') {
            $sexo_descricao = 'Masculino';
            $sexo_valor = '0';
        } else if ($sexo == '1') {
            $sexo_descricao = 'Feminino';
            $sexo_valor = '1';
        } else {
            $sexo_descricao = 'Não Informado';
        }


        $ec = $row['estado_civil'];
        if ($ec == '1') {
            $ec_descricao = 'Solteiro(a)';
        } else if ($ec == '2') {
            $ec_descricao = 'Casado(a)';
        } else if ($ec == '3') {
            $ec_descricao = 'Separado(a)/Divorciado(a)';
        } else if ($ec == '4') {
            $ec_descricao = 'Viuvo(a)';
        } else if ($ec == '5') {
            $ec_descricao = 'Outro';
        } else {
            $ec_descricao = 'Não Informado';
        }

        $nacionalidade = $row['nacionalidade'];
        if ($nacionalidade == '1') {
            $nacionalidade_tx = 'Brasileiro(a)';
        } else if ($nacionalidade == '2') {
            $nacionalidade_tx = 'Brasileiro(a) nascido no exterior ou naturalizado';
        } else if ($nacionalidade == '3') {
            $nacionalidade_tx = 'Estrangeiro';
        } else {
            $nacionalidade_tx = 'Não Informado';
        }

        $cor = $row['cor'];
        if ($cor == '1') {
            $cor_tx = 'Branca';
        } else if ($cor == '2') {
            $cor_tx = 'Preta';
        } else if ($cor == '3') {
            $cor_tx = 'Parda';
        } else if ($cor == '4') {
            $cor_tx = 'Amarela';
        } else if ($cor == '5') {
            $cor_tx = 'Não quis declarar';
        } else {
            $cor_tx = 'Não Informado';
        }

        $deficiencia = $row['aluno_deficiencia'];
        if ($deficiencia == '0') {
            $deficiencia_tx = 'Não';
        } else if ($deficiencia == '1') {
            $deficiencia_tx = 'sim';
        } else if ($deficiencia == '2') {
            $deficiencia_tx = 'Não Informado';
        } else {
            $deficiencia_tx = 'Não Informado';
        }

        $tipo_escola = $row['tipo_escola'];
        if ($tipo_escola == '0') {
            $tipo_escola_tx = 'PRIVADA';
        } else if ($tipo_escola == '1') {
            $tipo_escola_tx = 'PÚBLICA';
        } else if ($tipo_escola == '2') {
            $tipo_escola_tx = 'NÃO INFORMADO';
        } else {
            $tipo_escola_tx = 'NÃO INFORMADO';
        }

        $forma_ingresso = $row['forma_ingresso'];
        if ($forma_ingresso == '1') {
            $forma_ingresso_tx = 'VESTIBULAR';
        } else if ($forma_ingresso == '2') {
            $forma_ingresso_tx = 'ENEM';
        } else if ($forma_ingresso == '3') {
            $forma_ingresso_tx = 'AVALIAÇÃO SERIADA';
        } else if ($forma_ingresso == '4') {
            $forma_ingresso_tx = 'SELEÇÃO SIMPLIFICADA';
        } else if ($forma_ingresso == '5') {
            $forma_ingresso_tx = 'TRANSFERÊNCIA';
        } else if ($forma_ingresso == '6') {
            $forma_ingresso_tx = 'DECISÃO JUDICIAL';
        } else if ($forma_ingresso == '7') {
            $forma_ingresso_tx = 'VAGAS REMANESCENTE';
        } else if ($forma_ingresso == '8') {
            $forma_ingresso_tx = 'PROGRAMAS ESPECIAIS';
        } else {
            $forma_ingresso_tx = 'NÃO INFORMADO';
        }
        /*
         *  
         * 
          if ($opcao1 == '1') {
          $opcao1_tx = 'CIÊNCIAS TEOLÓGICAS';
          $opcao1_valor = '0000001';
          } else if ($opcao1 == '2') {
          $opcao1_tx = 'PEDAGOGIA';
          $opcao1_valor = '0000004';
          } else if ($opcao1 == '3') {
          $opcao1_tx = 'ADMINISTRAÇÃO';
          $opcao1_valor = '0000003';
          } else if ($opcao1 == '4') {
          $opcao1_tx = 'COMUNICAÇÃO SOCIAL: JORNALISMO';
          $opcao1_valor = '0000002';
          } else if ($opcao1 == '5') {
          $opcao1_tx = 'PUBLICIDADE E PROPAGANDA';
          $opcao1_valor = '0000009';
          }


          if ($turno1 == '1') {
          $turno1_tx = 'MAT';
          } else if ($turno1 == '3') {
          $turno1_tx = 'NOT';
          }
         */

        $se1 = $row['SE_txIrmaos'];
        if ($se1 == '1') {
            $se1_descricao = 'Nenhum';
        } else if ($se1 == '2') {
            $se1_descricao = 'Um';
        } else if ($se1 == '3') {
            $se1_descricao = 'Dois';
        } else if ($se1 == '4') {
            $se1_descricao = 'Três';
        } else if ($se1 == '5') {
            $se1_descricao = 'Quatro ou Mais';
        }

        $se2 = $row['SE_txFilhos'];
        if ($se2 == '1') {
            $se2_descricao = 'Nenhum';
        } else if ($se2 == '2') {
            $se2_descricao = 'Um';
        } else if ($se2 == '3') {
            $se2_descricao = 'Dois';
        } else if ($se2 == '4') {
            $se2_descricao = 'Três';
        } else if ($se2 == '5') {
            $se2_descricao = 'Quatro ou Mais';
        }

        // $se3 = $row['can_tx_se_etnia'];
        $se4 = $row['SE_txReside'];
        if ($se4 == '1') {
            $se4_descricao = 'Com pais e(ou) parentes';
        } else if ($se4 == '2') {
            $se4_descricao = 'Esposo(a) e(ou) com os filho(s)';
        } else if ($se4 == '3') {
            $se4_descricao = 'Com amigos(compartilhando despesas ou de favor)';
        } else if ($se4 == '4') {
            $se4_descricao = 'Com colegas, em alojamento universit&aacute;rio';
        } else if ($se4 == '5') {
            $se4_descricao = 'Sozinho(a)';
        }

        $se5 = $row['SE_txRenda'];
        if ($se5 == '1') {
            $se5_descricao = 'At&eacute; 3 sal&aacute;rios m&iacute;nimos';
        } else if ($se5 == '2') {
            $se5_descricao = 'Mais de 3 At&eacute; 10 sal&aacute;rios m&iacute;nimos';
        } else if ($se5 == '3') {
            $se5_descricao = 'Mais de 10 At&eacute; 20 sal&aacute;rios m&iacute;nimos';
        } else if ($se5 == '4') {
            $se5_descricao = 'Mais de 20 At&eacute; 30 sal&aacute;rios m&iacute;nimos';
        } else if ($se5 == '5') {
            $se5_descricao = 'Mais de 30 sal&aacute;rios m&iacute;nimos';
        }



        $se6 = $row['SE_txMembros'];
        if ($se6 == '1') {
            $se6_descricao = 'Nenhum';
        } else if ($se6 == '2') {
            $se6_descricao = 'Um ou dois';
        } else if ($se6 == '3') {
            $se6_descricao = 'Tr&ecirc;s ou quatro';
        } else if ($se6 == '4') {
            $se6_descricao = 'Cinco ou seis';
        } else if ($se6 == '5') {
            $se6_descricao = 'Mais de seis';
        }

        $se7 = $row['SE_txTrabalho'];
        if ($se7 == '1') {
            $se7_descricao = 'N&atilde;o trabalho e meus gastos s&atilde;o financiados pela fam&iacute;lia';
        } else if ($se7 == '2') {
            $se7_descricao = 'Trabalho e recebo ajuda da fam&iacute;lia';
        } else if ($se7 == '3') {
            $se7_descricao = 'Trabalho e me sustento';
        } else if ($se7 == '4') {
            $se7_descricao = 'Trabalho e contribuo com o sustento da fam&iacute;lia';
        } else if ($se7 == '5') {
            $se7_descricao = 'Trabalho e sou o principal respons&aacute;vel pelo sustento da fam&iacute;lia';
        }

        $se8 = $row['SE_txBolsa'];
        if ($se8 == '1') {
            $se8_descricao = 'Financiamento Estudantil';
        } else if ($se8 == '2') {
            $se8_descricao = 'Prouni integral';
        } else if ($se8 == '3') {
            $se8_descricao = 'Prouni parcial';
        } else if ($se8 == '4') {
            $se8_descricao = 'Bolsa integral ou pacial oferecida pela propria institui&ccedil;&atilde;o';
        } else if ($se8 == '5') {
            $se8_descricao = 'Bolsa integral ou parcial oferecida porentidadesexternas';
        } else if ($se8 == '6') {
            $se8_descricao = 'Outro(s)';
        } else if ($se8 == '7') {
            $se8_descricao = 'Nenhum';
        }
        ?>
                            <div class="portlet portlet-default">
                                <div class="portlet-heading">
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <br style="clear:both">
                                <div class="portlet-body">
                                    <div class="padded">
                    

                    <?php
                    foreach ($turma as $row):
                        $matricula = $row['matricula_aluno_id'];
                        $cadastro_aluno = $row['cadastro_aluno_id'];
                        $matriz_id = $row['matriz_id'];
                        $periodo_atual = $row['periodo_atual'];
                        $desperiodizado = $row['desperiodizado'];
                        $bolsista = $row['bolsista'];
                        $forma_ingresso = $row['forma_ingresso'];

                        if ($periodo_atual) {
                            $periodo_atual2 = $periodo_atual;
                        } else {
                            $periodo_atual2 = 'Não Informado';
                        }

                        if ($desperiodizado == 1) {
                            $desperiodizado2 = 'SIM';
                            $periodo_atual2 = 'Desperiodizado';
                        } else {
                            $desperiodizado2 = 'NÃO';
                        }

                        if ($bolsista == 1) {
                            $bolsista2 = 'SIM';
                        } else {
                            $bolsista2 = 'NÃO';
                        }

                        if ($forma_ingresso == 1) {
                            $forma_ingresso2 = 'VESTIBULAR';
                        } else if ($forma_ingresso == 2) {
                            $forma_ingresso2 = 'ENEM';
                        } else if ($forma_ingresso == 3) {
                            $forma_ingresso2 = 'AVALIAÇÃO SERIADA';
                        } else if ($forma_ingresso == 4) {
                            $forma_ingresso2 = 'SELEÇÃO SIMPLIFICADA';
                        } else if ($forma_ingresso == 5) {
                            $forma_ingresso2 = 'TRANSFERÊNCIA';
                        } else if ($forma_ingresso == 6) {
                            $forma_ingresso2 = 'DECISÃO JUDICIAL';
                        } else if ($forma_ingresso == 7) {
                            $forma_ingresso2 = 'VAGAS REMANESCENTE';
                        } else if ($forma_ingresso == 8) {
                            $forma_ingresso2 = 'PROGRAMAS ESPECIAIS';
                        } else {
                            $forma_ingresso2 = 'NÃO INFORMADO';
                        }
                        ?>
                    <input type="hidden" value="<?php echo $matricula; ?>" name="matricula_aluno_id">
                    <input type="hidden" value="<?php echo $cadastro_aluno; ?>" name="cadastro_aluno_id">
                    <div  style="background-color: threedhighlight; " class="tab-content">
                        <div style="margin-left: 15px;"  class="tab-pane fade in active">                            
                       <table width="100%" >
                            <tr>
                                <td width="15%">
                                    <div class="control-group">
                                        <label style="font-weight: bold " class="control-label"><?php echo get_phrase('reg. Acadêmico '); ?></label>
                                        <div class="controls">
                                            <?php echo $row['registro_academico']; ?>  
                                        </div>
                                    </div>
                                </td>
                                <td  width="30%">
                                    <div class="control-group">
                                        <label style="font-weight: bold " class="control-label"><?php echo get_phrase('Nome'); ?></label>
                                        <div class="controls">
                                            <?php echo $row['nome']; ?>

                                        </div>
                                    </div>
                                </td>


                                <td width="40%">
                                    <div class="control-group">
                                        <label style="font-weight: bold " class="control-label"><?php echo get_phrase('Curso'); ?></label>
                                        <div class="controls">
                                            <?php echo $row['cur_tx_descricao']; ?>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        </table>
                       <table width="100%" >
                            <?php
                            $sql_mt2 = "SELECT min(matricula_aluno_turma_id) as id, mat.ano as ano,mat.semestre as semestre, mat.periodo_letivo_id as periodo_letivo_id
                                    FROM matricula_aluno_turma mat
                                    left join periodo_letivo pl on pl.periodo_letivo_id = mat.periodo_letivo_id
                                    where matricula_aluno_id = $matricula ";
                            $uf_mt2 = $this->db->query($sql_mt2)->result_array();
                            foreach ($uf_mt2 as $row_mt2):
                                $ano = $row_mt2['ano'];
                                $semestre = $row_mt2['semestre'];
                                $periodo_letivo_id = $row_mt2['periodo_letivo_id'];

                                if ($periodo_letivo_id) {
                                    $sql_mt21 = "SELECT * FROM periodo_letivo where periodo_letivo_id =  $periodo_letivo_id ";
                                    $uf_mt21 = $this->db->query($sql_mt21)->result_array();
                                    foreach ($uf_mt21 as $row_mt22):
                                        $periodo_letivo = $row_mt22['periodo_letivo'];
                                    endforeach;
                                    $ano_igresso = $periodo_letivo;
                                }else {
                                    $ano_igresso = $ano . '/' . $semestre;
                                }
                            endforeach;
                            ?>
                            <tr>
                                <td width="15%" >
                                    <div class="control-group">
                                        <label style="font-weight: bold " class="control-label"><?php echo get_phrase('Ano de Ingresso'); ?></label>
                                        <div class="controls">
                                            <?php echo $ano_igresso; ?>

                                        </div>
                                    </div>
                                </td>
                                <?php
                                $sql_mt = "SELECT * FROM matriz where matriz_id = $matriz_id ";
                                $uf_mt = $this->db->query($sql_mt)->result_array();
                                foreach ($uf_mt as $row_mt):
                                    $mt_ano = $row_mt['mat_tx_ano'];
                                    $mt_semestre = $row_mt['mat_tx_semestre'];
                                endforeach;
                                ?>
                                <td width="20%">
                                    <div class="control-group">
                                        <label style="font-weight: bold " class="control-label"><?php echo get_phrase('Forma_ingresso'); ?></label>
                                        <div class="controls">
                                            <?php echo $forma_ingresso2; ?>
                                        </div>
                                    </div>
                                </td>
                                <td width="20%">
                                    <div class="control-group">
                                        <label style="font-weight: bold " class="control-label"><?php echo get_phrase('Matriz_atual'); ?></label>
                                        <div class="controls">
                                            <?php echo $mt_ano; ?>/<?php echo $mt_semestre; ?>

                                        </div>
                                    </div>
                                </td>
                                <td width="20%">
                                    <div class="control-group">
                                        <label style="font-weight: bold " class="control-label"><?php echo get_phrase('periodo_atual'); ?></label>
                                        <div class="controls">
                                            <?php echo $periodo_atual2; ?>

                                        </div>
                                    </div>
                                </td>
                                <td width="20%">
                                    <div class="control-group">
                                        <label style="font-weight: bold " class="control-label"><?php echo get_phrase('Desperiodizado?'); ?></label>
                                        <div class="controls">
                                          <?php echo $desperiodizado2; ?>
                                        </div>
                                    </div>
                                </td>
                                <td width="20%">
                                    <div class="control-group">
                                        <label style="font-weight: bold " class="control-label"><?php echo get_phrase('Bolsista?'); ?></label>
                                        <div class="controls">
                                           
                                            <?php echo $bolsista2; ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>    
                        </div>
                    </div>
                        <?php
                    endforeach;
                    ?>
                    <ul style="background-color: threedhighlight; margin-top: 15px;" class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#dadospessoais"><font style="color: #0044cc">DADOS PESSOAIS</font></a></li>
                        <li><a data-toggle="tab" href="#menu1"><font style="color: #0044cc">DOCUMENTAÇÃO</font></a></li>
                        <li><a data-toggle="tab" href="#menu3"><font style="color: #0044cc">ENDEREÇO</font></a></li>
                        <li><a data-toggle="tab" href="#menu5"><font style="color: #0044cc">INFORMAÇÕES</font></a></li>
                        <li><a data-toggle="tab" href="#menu2"><font style="color: #0044cc">SOCIOECONOMICO</font></a></li>
                        <li><a data-toggle="tab" href="#menu6"><font style="color: #0044cc">RESPONSÁVEL</font></a></li>
                        <li><a data-toggle="tab" href="#menu7"><font style="color: #0044cc">OBSERVAÇÕES </font></a></li>
                    </ul>

                    <div  class="tab-content">
                        <div style="margin-left: 15px;" id="dadospessoais" class="tab-pane fade in active">
                              
                            <table width="100%" >
                                <tbody>
                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('nome :'); ?> <?php echo $row['nome']; ?></label>
                                                <div class="controls">
                                                
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('data_nascimento :'); ?><?php echo date($row['data_nascimento']); ?></label>
                                                
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('pais_origem :'); ?> <?php echo $po_nome; ?></label>
                                                

                                            </div>
                                        </td>

                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('UF_nascimento :'); ?><?php echo $uf_nome; ?></label>
                                                
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('cidade_origem :'); ?><?php echo $mun_nome; ?></label>
                                                
                                            </div>
                                        </td>

                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('sexo : '); ?> <?php echo $sexo_descricao; ?></label>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('estado_civil : '); ?><?php echo $ec_descricao; ?></label>

                                            </div>
                                        </td>
                                </tbody>
                            </table>
                        </div>
                        <div style="margin-left: 15px;" id="menu1" class="tab-pane fade">
                            <table width="100%" >
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('cpf : '); ?><?php echo $row['cpf']; ?></label>
                                                
                                            </div>
                                        </td>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('RG : '); ?><?php echo $row['rg']; ?></label>
                                                
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>


                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('RG_UF : '); ?><?php echo $row_uf['nome']; ?></label>
                                                
                                            </div>
                                        </td>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('RG_orgão_expeditor : '); ?><?php echo $row['rg_orgao_expeditor']; ?></label>
                                               
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('titulo :'); ?><?php echo $row['titulo']; ?></label>

                                               
                                            </div>
                                        </td>

                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('uf_titulo : '); ?><?php echo $uf_tit_nome; ?></label>

                                               

                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('documento_estrangeiro : '); ?><?php echo $row['documento_estrangeiro']; ?></label>

                                            </div>
                                        </td>

                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('certidão_reservista : '); ?><?php echo $row['cert_reservista']; ?></label>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('uf_certidão_reservista : '); ?><?php echo $uf_reservista_nome; ?></label>

                                                
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>                       
                        <div style="margin-left: 15px;" id="menu3" class="tab-pane fade">
                            <table width="100%" class="responsive">
                                <tbody>
                                    <tr>
                                            <td>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo get_phrase('cep : '); ?></label>
                                                    
                                                </div>
                                            </td>
                                            <td >
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo get_phrase('endereco : '); ?><?php echo $row['endereco']; ?></label>

                                                   

                                                </div>
                                            </td>
                                        </tr>
                                <tr>
                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('bairro : '); ?><?php echo $row['bairro']; ?></label>
                                           
                                        </div>
                                    </td>
                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('UF : '); ?><?php echo $uf_endereco_nome; ?></label>
                                            
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('cidade :'); ?> Manaus</label>
                                                
                                        </div>
                                    </td>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('complemento : '); ?><?php echo $row['compemento']; ?></label>


                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div style="margin-left: 15px;" id="menu5" class="tab-pane fade">
                            <table width="100%" class="responsive">
                                <tbody>

                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('nacionalidade : '); ?><?php echo $nacionalidade_tx; ?></label>

                                               
                                            </div>
                                        </td>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('cor/raça : '); ?><?php echo $cor_tx; ?></label>

                                            </div>
                                        </td>
                                    </tr>



                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('mae : '); ?><?php echo $row['mae']; ?></label>

                                            </div>
                                        </td>

                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('pai : '); ?><?php echo $row['pai']; ?></label>

                                                
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('conjuge : '); ?><?php echo $row['conjuge']; ?></label>
                                                
                                            </div>
                                        </td>

                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('Tem Alguma Deficiência? : '); ?><?php echo $deficiencia_tx; ?></label>

                                                

                                            </div>
                                        </td>


                                    </tr>
                                    
                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('Tipo de escola que concluiu o Ens. Médio : '); ?><?php echo $tipo_escola_tx; ?></label>

                                                

                                            </div>
                                        </td>

                                        <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('email : '); ?><?php echo $row['email']; ?></label>

                                            
                                        </div>
                                    </td>

                                    </tr>

                                </tbody>
                            </table>

                            <div  id="load_doencas_ficha_aluno">

                            </div>
                            <table width="100%" class="responsive">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('fone : '); ?><?php echo $row['fone']; ?></label>
                                                <div class="controls">
                                                    <input type="text" value="<?php echo $row['fone']; ?>" onkeypress="mascara(this, '#####-####')" maxlength="10"  id="fone" name="fone"/>
                                                </div>
                                            </div>
                                        </td>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('celular : '); ?><?php echo $row['celular']; ?></label>
                                                
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            
                        </div>
                        <div style="margin-left: 15px;" id="menu2" class="tab-pane fade">
                            <table width="100%" class="responsive">
                                <tbody>
                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('Quantos_irmãos_você_tem? '); ?></label>
                                                <div class="controls">
                                                    <div class="controls">
                                                        <SELECT   NAME="SE_txIrmaos">
                                                            <OPTION value="<?php echo $se1; ?>" ><?php echo $se1_descricao; ?></OPTION>
                                                           
                                                        </SELECT>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('Quantos filhos voc&ecirc; tem?'); ?></label>

                                                <div class="controls">
                                                    <div class="controls">
                                                        <div class="controls">
                                                            <SELECT   NAME="SE_txFilhos">
                                                                <OPTION value="<?php echo $se2; ?>" ><?php echo $se2_descricao; ?></OPTION>
                                                           
                                                            </SELECT>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('voc&ecirc; mora com quem?'); ?></label>
                                                <div class="controls">
                                                    <div class="controls">
                                                        <SELECT   NAME="SE_txReside">
                                                            <OPTION value="<?php echo $se4; ?>" ><?php echo $se4_descricao; ?></OPTION>
                                                        
                                                        </SELECT>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('Faixa de renda mensal? '); ?></label>
                                                <div class="controls">
                                                    <div class="controls">
                                                        <SELECT   NAME="SE_txRenda">
                                                        <OPTION value="<?php echo $se5; ?>" ><?php echo $se5_descricao; ?></OPTION>
                                                        
                                                        </SELECT>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('Quantas pessoas moram com voc&ecirc;?'); ?></label>
                                                <div class="controls">
                                                    <div class="controls">
                                                        <SELECT   NAME="SE_txMembros">
                                                            <OPTION value="<?php echo $se6; ?>" ><?php echo $se6_descricao; ?></OPTION>
                                                            
                                                        </SELECT>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('Qual situa&ccedil;&atilde;o descreve seu caso?'); ?></label>

                                                <div class="controls">

                                                    <div class="controls">
                                                        <SELECT  NAME="SE_txTrabalho">
                                                            <OPTION value="<?php echo $se7; ?>" ><?php echo $se7_descricao; ?></OPTION>
                                                              </SELECT>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                            </table>
                                <table width="100%" class="responsive">
                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('Você tem bolsa ou financiamento estudantil?'); ?></label>
                                            <div class="controls">
                                                <div class="controls">
                                                    <SELECT   NAME="SE_txBolsa">
                                                        <OPTION value="<?php echo $se8; ?>" ><?php echo $se8_descricao; ?></OPTION>
                                                        
                                                    </SELECT>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div style="margin-left: 15px;" id="menu6" class="tab-pane fade">
                            <table width="100%" class="responsive">
                                <tbody>


                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('responsavel : '); ?><?php echo $row['responsavel']; ?></label>

                                                

                                            </div>
                                        </td>

                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('fone_responsavel : '); ?><?php echo $row['fone_responsavel']; ?></label>

                                                
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('RG_responsavel : '); ?><?php echo $row['rg_responsavel']; ?></label>

                                                

                                            </div>
                                        </td>

                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('CPF_responsável : '); ?><?php echo $row['cpf_responsavel']; ?></label>

                                                
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td >
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('celular_responsável : '); ?><?php echo $row['cel_responsavel']; ?></label>

                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div style="margin-left: 15px;" id="menu7" class="tab-pane fade">
                            <table width="100%" class="responsive">
                                <tbody>

                                    <tr>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('OBSERVAÇÕES'); ?></label>

                                                <div class="controls">

                                                    <div class="controls">
                                                        <?php echo $row['observacao']; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                                </div>
                            </div>
                            <!-- /.portlet -->
                        </div>
                    </div>
                </div>
                
      <?php
        endforeach;
        ?>
            </div>
            <!-- /#page-wrapper -->
            <!-- end MAIN PAGE CONTENT -->

        </div>
      



        
        
        
        
        <div id="logout">
            <div class="logout-message">
                <img class="img-circle img-logout" src="<?php echo base_url(); ?>template/dashboard/img/profile-pic.jpg" alt="">
                <h3>
                    <i class="fa fa-sign-out text-green"></i> Ready to go?
                </h3>
                <p>Select "Logout" below if you are ready<br> to end your current session.</p>
                <ul class="list-inline">
                    <li>
                        <a href="login.html" class="btn btn-green">
                            <strong>Logout</strong>
                        </a>
                    </li>
                    <li>
                        <button class="logout_close btn btn-green">Cancel</button>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /#logout -->
        <!-- Logout Notification jQuery -->
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/popupoverlay/logout.js"></script>
        <!-- HISRC Retina Images -->
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/hisrc/hisrc.js"></script>

        <!-- PAGE LEVEL PLUGIN SCRIPTS -->
        <!-- HubSpot Messenger -->
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/messenger/messenger.min.js"></script>
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/messenger/messenger-theme-flat.js"></script>
        <!-- Date Range Picker -->
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/daterangepicker/moment.js"></script>
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- Morris Charts -->
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/morris/raphael-2.1.0.min.js"></script>
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/morris/morris.js"></script>
        <!-- Flot Charts -->
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/flot/jquery.flot.js"></script>
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/flot/jquery.flot.resize.js"></script>
        <!-- Sparkline Charts -->
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/sparkline/jquery.sparkline.min.js"></script>
        <!-- Moment.js -->
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/moment/moment.min.js"></script>
        <!-- jQuery Vector Map -->
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/jvectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
        <script src="<?php echo base_url(); ?>template/dashboard/js/demo/map-demo-data.js"></script>
        <!-- Easy Pie Chart -->
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/easypiechart/jquery.easypiechart.min.js"></script>
        <!-- DataTables -->
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/datatables/jquery.dataTables.js"></script>
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/datatables/datatables-bs3.js"></script>

        <!-- THEME SCRIPTS -->
        <script src="<?php echo base_url(); ?>template/dashboard/js/flex.js"></script>
        <script src="<?php echo base_url(); ?>template/dashboard/js/demo/dashboard-demo.js"></script>


    </body>

</html>
