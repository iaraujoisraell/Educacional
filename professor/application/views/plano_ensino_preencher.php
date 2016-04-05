<html >
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="template/jquery.quick.search.js"></script>
    <?php include 'application/views/header.php'; ?>


    <style type="text/css">


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

        function buscar_table_disciplinas(mat_id) {
            // var turma = turma;
            var mat_id = mat_id;

            //if ((aluno) || (curso != '0') || (turma != '0')) {
            var url = 'index.php?admin/carrega_table_disciplinas/' + mat_id;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_disciplinas').html(dataReturn);  //coloco na div o retorno da requisicao
            });
            //  }else{
            //      alert('Selecione um curso e turma');
            //  }
        }

        function buscar_table_aulas_copiar() {
            var status = $('#status').val();  //codigo do estado escolhido
            var mes_de = $('#mes_de').val();
            var ano_de = $('#ano_de').val();
            var mes_ate = $('#mes_ate').val();
            var ano_ate = $('#ano_ate').val();
            var busca = $('#busca').val();

            //if ((aluno) || (curso != '0') || (turma != '0')) {
            var url = 'index.php?admin/carrega_table_plano_aula_copiar/' + status + '/' + mes_de + '/' + ano_de + '/' + mes_ate + '/' + ano_ate;  //caminho do arquivo php que irá buscar as cidades no BD
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



        var base_url = "<?php base_url() ?>http://www.fbnovas.edu.br/educacional";

        function buscar_paginacao_receber_pagamento() {
            var pdt_id = $('#pdt_professor').val();

            if ($('pdt_professor').val() == '0') {
                alert('Selecione uma disciplina');
            } else {
                var url = 'index.php?admin/carrega_table_plano_aula_copiar/' + pdt_id;  //caminho do arquivo php que irá buscar as cidades no BD
                $.get(url, function (dataReturn) {
                    $('#load_paginacao_rp').html(dataReturn);  //coloco na div o retorno da requisicao
                });
            }

        }

        function buscar_plano_aula_copiar() {

            var url = 'index.php?admin/carrega_table_plano_aula_copiar/';  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('load_paginacao').html(dataReturn);  //coloco na div o retorno da requisicao
            });

        }

        function carregaDadosPlanoJSon(id_pdt) {
            $.post(base_url + '/professor/index.php?/admin/dados_plano_ensino', {
                id: id_pdt
            }, function (data) {

                $('#ementa_pe').val(data.ementa);
                $('#objetivo_geral').val(data.objetivo_geral);
                $('#competencia_habilidade').val(data.competencia_habilidade);
                $('#instrumento').val(data.instrumento);
                $('#referencia_bibliografica').val(data.referencia);
                $('#avaliacao').val(data.avaliacao);
                $('#data').val(data.data);
                $('#quantidade_oe').val(data.quantidade_oe);
                $('#objetivo_especifico').val(data.objetivo_especifico);

                //alert(data.quantidade_oe);
                //aqui eu seto a o input hidden com o id do cliente, para que a edição funcione. Em cada tela aberta, eu seto o id do cliente. 
            }, 'json');
        }



        function copiar_plano() {

            var pdt_id = document.getElementById('pdt_professor').value;
            if (pdt_id == 0) {
                alert('Selecione uma Disciplina');
            } else {
                //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal
                carregaDadosPlanoJSon(pdt_id);

                buscar_paginacao_receber_pagamento();

            }

            // $('#flexModal').modal('show');


        }

        function MascaraMoeda1(objTextBox, SeparadorMilesimo, SeparadorDecimal, e) {
            var sep = 0;
            var key = '';
            var i = j = 0;
            var len = len2 = 0;
            var strCheck = '0123456789';
            var aux = aux2 = '';
            var whichCode = (window.Event) ? e.which : e.keyCode;
            if (whichCode == 13 || whichCode == 8)
                return true;
            key = String.fromCharCode(whichCode); // Valor para o código da Chave    
            if (strCheck.indexOf(key) == -1)
                return false; // Chave inválida    
            len = objTextBox.value.length;
            for (i = 0; i < len; i++)
                if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal))
                    break;
            aux = '';
            for (; i < len; i++)
                if (strCheck.indexOf(objTextBox.value.charAt(i)) != -1)
                    aux += objTextBox.value.charAt(i);
            aux += key;
            len = aux.length;
            if (len == 0)
                objTextBox.value = '';
            if (len == 1)
                objTextBox.value = '0' + SeparadorDecimal + '0' + aux;
            if (len == 2)
                objTextBox.value = '0' + SeparadorDecimal + aux;
            if (len > 2) {
                aux2 = '';
                for (j = 0, i = len - 3; i >= 0; i--) {
                    if (j == 3) {
                        aux2 += SeparadorMilesimo;
                        j = 0;
                    }
                    aux2 += aux.charAt(i);
                    j++;
                }
                objTextBox.value = '';
                len2 = aux2.length;
                for (i = len2 - 1; i >= 0; i--)
                    objTextBox.value += aux2.charAt(i);
                objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
            }
            return false;
        }



        /* Máscaras ER */
        function mascara(o, f) {
            v_obj = o
            v_fun = f
            setTimeout("execmascara()", 1)
        }
        function execmascara() {
            v_obj.value = v_fun(v_obj.value)
        }
        function mcep(v) {
            v = v.replace(/\D/g, "")                    //Remove tudo o que não é dígito
            v = v.replace(/^(\d{5})(\d)/, "$1-$2")         //Esse é tão fácil que não merece explicações
            return v
        }
        function mdata(v) {
            v = v.replace(/\D/g, "");                    //Remove tudo o que não é dígito
            v = v.replace(/(\d{2})(\d)/, "$1/$2");
            v = v.replace(/(\d{2})(\d)/, "$1/$2");

            v = v.replace(/(\d{2})(\d{2})$/, "$1$2");
            return v;
        }
        function mrg(v) {
            v = v.replace(/\D/g, '');
            v = v.replace(/^(\d{2})(\d)/g, "$1.$2");
            v = v.replace(/(\d{3})(\d)/g, "$1.$2");
            v = v.replace(/(\d{3})(\d)/g, "$1-$2");
            return v;
        }
        function mvalor(v) {
            v = v.replace(/\D/g, "");//Remove tudo o que não é dígito
            v = v.replace(/(\d)(\d{8})$/, "$1.$2");//coloca o ponto dos milhões
            v = v.replace(/(\d)(\d{5})$/, "$1.$2");//coloca o ponto dos milhares

            v = v.replace(/(\d)(\d{2})$/, "$1,$2");//coloca a virgula antes dos 2 últimos dígitos
            return v;
        }
        function id(el) {
            return document.getElementById(el);
        }
        function next(el, next)
        {
            if (el.value.length >= el.maxLength)
                id(next).focus();
        }
    </script>
    <script language='JavaScript'>
        function SomenteNumero(e) {
            var tecla = (window.event) ? event.keyCode : e.which;
            if ((tecla > 47 && tecla < 58))
                return true;
            else {
                if (tecla == 8 || tecla == 0)
                    return true;
                else
                    return false;
            }
        }




    </script>
    
    
    <body>
        <?php
       
      function fixEncoding($in_str){
    $cur_encoding = mb_detect_encoding($in_str) ;
    if($cur_encoding == "UTF-8" && mb_check_encoding($in_str,"UTF-8"))
      return $in_str;
    else
      return utf8_encode($in_str);
  }
  
  function fixDecoding($in_str){
    $cur_encoding = mb_detect_encoding($in_str) ;
    if($cur_encoding == "ISO-8859-1" && mb_check_encoding($in_str,"ISO-8859-1"))
      return $in_str;
    else
      return utf8_decode($in_str);
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
                    <?php
                    foreach ($cabecalho as $row):
                        $pdt_id = $row['pdt_nb_codigo'];
                        $pdt_codigo = $row['pdt_nb_codigo'];
                        $turma = $row['tur_tx_descricao'];
                        $disciplina = $row['disc_tx_descricao'];
                        $disciplina_id = $row['disciplina_id'];
                        $professor_nome = $row['nome'];
                        $curso_tx = $row['cur_tx_descricao'];
                        $ch = $row['carga_horaria'];
                        $professor_id = $row['professor_id'];
                        
                    endforeach;
                    ?>
                    
                    
                    
                      <?php
                      //VERIFICA SE JA EXISTE UM PLANO DE ENSINO PARA A DISCIPLINA E PERÍODO_LETIVO INFORMADO. SE NÃO TIVER CRIA UM, SENÃO CARREGA AS INFORMAÇÕES EXISTENTE.
                    $sql_pe = "SELECT *, pdt.pdt_nb_codigo as pdt FROM professor_disciplina_turma pdt
                                inner join professor_curso pc on pc.pc_nb_codigo = pdt.pc_nb_codigo
                                inner join plano_ensino pe on pe.pdt_nb_codigo = pdt.pdt_nb_codigo
                                where pdt.pdt_nb_codigo = $pdt_id ";
                    //echo $sql_pe;
                    $array_pe = $this->db->query($sql_pe)->result_array();
                   
                    $numrows_pe = 0;
                    foreach ($array_pe as $row_pe):
                        $pdt_id2 = $row_pe['pdt'];
                        $numrows_pe = 1;

                    endforeach;
                    
                    
                    if($numrows_pe == 0){
                         $data1['pdt_nb_codigo'] = $pdt_id;
                         $this->db->insert('plano_ensino', $data1);
                         $pe_codigo = mysql_insert_id();
                         
                         $data2['pe_nb_codigo'] = $pe_codigo;
                         $this->db->insert('objetivos_especificos', $data2);
                         $oe_id = mysql_insert_id();
                         
                         $data3['pe_nb_codigo'] = $pe_codigo;
                         $this->db->insert('competencias_habilidades', $data3);
                         $ch_id = mysql_insert_id();
                         
                         $data4['pe_nb_codigo'] = $pe_codigo;
                         $this->db->insert('avaliacao', $data4);
                         $ava_id = mysql_insert_id();
                         
                         //$data5['pe_nb_codigo'] = $pe_id;
                         //$this->db->insert('avaliacao', $data5);
                         //$ava_id = mysql_insert_id();
                         
                         $data6['disc_nb_codigo'] = $disciplina_id;
                         $this->db->insert('ementa', $data6);
                         $ementa_id = mysql_insert_id();
                         
                         $data7['emet_nb_codigo'] = $ementa_id;
                         $this->db->insert('referencias', $data7);
                         $ref_id = mysql_insert_id();
                         
                    }else if($numrows_pe == 1){
                        /********EMENTA**********/
                    $sql_pe = "SELECT * FROM ementa a "
                            . " inner join referencias r on r.emet_nb_codigo = a.emet_nb_codigo where a.disc_nb_codigo = $disciplina_id ";
                    $array_pe = $this->db->query($sql_pe)->result_array();
                    foreach ($array_pe as $row_pe):
                        $ementa_id = $row_pe['emet_nb_codigo'];
                        $ementa = $row_pe['ement_tx_descricao'];
                        $referencia = $row_pe['ref_tx_descricao'];
                    if($ementa){
                        
                    }else{
                        $ementa = "";
                    }
                        
                        
                    endforeach;
                    $sql_pe2 = "SELECT *, pe.pe_nb_codigo as pe_nb_codigo FROM plano_ensino pe
                    inner join avaliacao a on a.pe_nb_codigo = pe.pe_nb_codigo
                    inner join objetivos_especificos oe on oe.pe_nb_codigo = pe.pe_nb_codigo
                    inner join competencias_habilidades ch on ch.pe_nb_codigo = pe.pe_nb_codigo
                    where pe.pdt_nb_codigo = $pdt_id";
                    // echo $sql_pe2;
                    $array_pe2 = $this->db->query($sql_pe2)->result_array();
                    foreach ($array_pe2 as $row_pe2):
                        $pe_codigo = $row_pe2['pe_nb_codigo'];
                        $objetivo_geral = $row_pe2['pe_tx_objetivo_geral'];
                        $objetivo_especifico = $row_pe2['oe_tx_descricao'];
                        $competencias = $row_pe2['ch_tx_descricao'];
                        $avaliacao = $row_pe2['ava_tx_descricao'];
                        $instrumento = $row_pe2['pe_tx_instrumento'];
                        $data = $row_pe2['pe_tx_data'];
                    endforeach;
                    
                    
                    }
                    /****************PLANO DE ENSINO CONTEÚDO*************/
                   
                      //VERIFICA SE JA EXISTE UM PLANO DE ENSINO conteudo PARA A DISCIPLINA E PERÍODO_LETIVO INFORMADO. SE NÃO TIVER CRIA UM, SENÃO CARREGA AS INFORMAÇÕES EXISTENTE.
                    $sql_pec = "SELECT * FROM plano_ensino_conteudo where pe_nb_codigo = $pe_codigo ";
                    $array_pec = $this->db->query($sql_pec)->result_array();
                   
                    $numrows_pec = 0;
                    foreach ($array_pec as $row_pec):
                        $pec_codigo = $row_pec['pec_nb_codigo'];
                        $numrows_pec = 1;

                    endforeach;
                    
                    
                    
                    ?>
                    <!-- begin PAGE TITLE AREA -->
                    <!-- Use this section for each page's title and breadcrumb layout. In this example a date range picker is included within the breadcrumb. -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-title">
                                <h1>Plano de Ensino

                                </h1>
                                <ol class="breadcrumb">
                                    <li><i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                                    </li>
                                    <li class="active">Cadastro de Plano de Ensino</li>
                                </ol>
                            </div>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <!-- end PAGE TITLE AREA -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="portlet portlet-default">
                                <div class="portlet-heading">
                                    <div class="clearfix"></div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-responsive">  
                                        <div   class="tab-content">
                                            <div style="margin-left: 15px; "  class="tab-pane fade in active">                            
                                                <table class="table  table-striped  " width="100%"  cellpadding="0" cellspacing="0" border="0" >

                                                    <tr>
                                                        <td align="center" width="100%">
                                                            <div class="control-group">
                                                                <label style="font-weight: bold; margin: auto; " class="control-label"><?php echo get_phrase('PLANO DE ENSINO'); ?></label>
                                                                <div class="controls">
                                                                    <?php //echo $row['registro_academico'];  ?>  
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                </table>
                                                <table class="table  table-striped   " width="100%" cellpadding="0" cellspacing="0" border="0" >
                                                    <tr>
                                                        <td width="40%" >
                                                            <div class="control-group">
                                                                <label style="font-weight: bold " class="control-label"><?php echo get_phrase('CURSO : '); ?><?php echo $curso_tx; ?></label>

                                                            </div>
                                                        </td>

                                                        <td width="40%">
                                                            <div class="control-group">
                                                                <label style="font-weight: bold " class="control-label"><?php echo get_phrase('DISCIPLINA : '); ?><?php echo $disciplina; ?></label>

                                                            </div>
                                                        </td>

                                                        <td width="20%">
                                                            <div class="control-group">
                                                                <label style="font-weight: bold " class="control-label"><?php echo get_phrase('C.H.  '); ?><?php echo $ch; ?></label>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table class="table  table-striped   " width="100%" cellpadding="0" cellspacing="0" border="0" >

                                                    <tr>

                                                        <td width="100%">
                                                            <div class="control-group">
                                                                <label style="font-weight: bold " class="control-label"><?php echo get_phrase('PROFESSOR : '); ?><?php echo $professor_nome; ?></label>

                                                            </div>
                                                        </td>

                                                    </tr>
                                                </table>
                                                <table class="table  table-striped   " width="100%" cellpadding="0" cellspacing="0" border="0" >
                                                    <tr>
                                                        <td>
                                                            <select style="height: 32px;" name="pdt_professor" id="pdt_professor" class="input">
                                                                <option value="0">Você pode copiar os dados de outro plano de ensino.</option>          
                                                                <?php
                                                                $sql_mt = "SELECT `professor_disciplina_turma`.`pdt_nb_codigo`,`professor_id`, `nome`, `disc_tx_descricao`, `tur_tx_descricao`, `turma`.`ano` as ano,
                                                                        `turma`.`semestre` as semestre, `turno`.`descricao`, `cur_tx_abreviatura`, `periodo`, `mat_tx_ano`, `periodo_letivo`,
                                                                        `mat_tx_semestre`,`professor_curso`.`pc_nb_codigo` as prof_curso,`professor_disciplina_turma`.`pdt_nb_codigo` as pdt_id
                                                                        FROM (`professor`)
                                                                        JOIN `professor_curso` ON `professor_curso`.`prof_nb_codigo` = `professor`.`professor_id`
                                                                        JOIN `professor_disciplina_turma` ON `professor_disciplina_turma`.`pc_nb_codigo` = `professor_curso`.`pc_nb_codigo`
                                                                        JOIN `plano_ensino` ON `plano_ensino`.`pdt_nb_codigo` = `professor_disciplina_turma`.`pdt_nb_codigo`
                                                                        JOIN `disciplina` ON `disciplina`.`disciplina_id` = `professor_disciplina_turma`.`disc_nb_codigo`
                                                                        JOIN `turma` ON `turma`.`turma_id` = `professor_disciplina_turma`.`tur_nb_codigo`
                                                                        JOIN `turno` ON `turno`.`turno_id` = `turma`.`turno_id`
                                                                        left JOIN `periodo_letivo` ON `periodo_letivo`.`periodo_letivo_id` = `turma`.`periodo_letivo_id`
                                                                        JOIN `cursos` ON `cursos`.`cursos_id` = `turma`.`curso_id`
                                                                        JOIN `matriz` ON `matriz`.`matriz_id` = `turma`.`matriz_id`
                                                                        JOIN `matriz_disciplina` ON `matriz_disciplina`.`disciplina_id` = `disciplina`.`disciplina_id`
                                                                        WHERE `professor`.`professor_id` = '$professor_id' and `professor_disciplina_turma`.`pdt_nb_codigo` != $pdt_id order by periodo_letivo desc, ano desc";

                                                                $uf_mt = $this->db->query($sql_mt)->result_array();
                                                                foreach ($uf_mt as $row_mt):
                                                                    $pdt_id = $row_mt['pdt_id'];
                                                                    $disciplina = $row_mt['disc_tx_descricao'];
                                                                    $periodo_letivo = $row_mt['periodo_letivo'];
                                                                    if ($periodo_letivo) {
                                                                        $periodo_letivo = $row_mt['periodo_letivo'];
                                                                    } else {
                                                                        $periodo_letivo = $row_mt['ano'] . '/' . $row_mt['semestre'];
                                                                    }
                                                                    ?>  
                                                                    <option value="<?php echo $pdt_id; ?> "><?php echo $disciplina; ?> - <?php echo $periodo_letivo; ?></option>
                                                                    <?php
                                                                endforeach;
                                                                ?>

                                                            </select>
                                                            <button style="margin-left: 15px;" class="btn btn-blue" value="copiar" onclick="copiar_plano()">Copiar</button>
                                                        </td>
                                                    </tr>      
                                                </table>
                                                <table class="table  table-striped   " width="100%" cellpadding="0" cellspacing="0" border="0" >
                                                    <tr>
                                                        <td>

                                                        </td>
                                                    </tr>
                                                </table>
                                                <br><br>
                                                  <?php echo form_open('admin/minhas_disciplinas_plano_ensino/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                                                <input type="hidden" name="pe_nb_codigo" id="pe_nb_codigo" value="<?php echo $pe_codigo; ?>">
                                                <input type="hidden" name="ementa_id" id="ementa_id" value="<?php echo $ementa_id; ?>">
                                                <div class="portlet-body"> 
                                                    <table class="table  table-striped   " width="100%" cellpadding="0" cellspacing="0" border="0" >
                                                        <label style="font-weight: bold " class="control-label"><?php echo get_phrase('EMENTA : '); ?></label>
                                                        <tr>
                                                            <td>
                                                               
                                                               <textarea id="ementa_pe" name="ementa_pe" class="form-control" class="input" style="width: 100%" maxlength="500" rows="2" placeholder="Informe o objetivo geral."><?php echo $ementa; ?></textarea>

                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="portlet-body">
                                                    <table class="table  table-striped   " width="100%" cellpadding="0" cellspacing="0" border="0" >
                                                        <tr>
                                                            <td>    <label style="font-weight: bold " class="control-label"><?php echo get_phrase('OBJETIVO GERAL : '); ?></label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <textarea id="objetivo_geral" name="objetivo_geral" class="form-control" class="input" style="width: 100%" maxlength="500" rows="2" placeholder="Informe o objetivo geral."><?php echo $objetivo_geral; ?></textarea>

                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="portlet-body">
                                                    <table class="table  table-striped   " width="100%" cellpadding="0" cellspacing="0" border="0" >
                                                        <tr>
                                                            <td>    <label style="font-weight: bold " class="control-label"><?php echo get_phrase('OBJETIVOS ESPECÍFICOS : '); ?></label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <textarea id="objetivo_especifico" name="objetivo_especifico" class="form-control" class="input" style="width: 100%" maxlength="500" rows="4" placeholder="Informe os objetivos específicos."><?php echo $objetivo_especifico; ?></textarea>

                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="portlet-body">
                                                    <table class="table  table-striped   " width="100%" cellpadding="0" cellspacing="0" border="0" >
                                                        <tr>
                                                            <td>    <label style="font-weight: bold " class="control-label"><?php echo get_phrase('COMPETÊNCIAS E HABILIDADES  : '); ?></label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <textarea id="competencia_habilidade" name="competencia_habilidade" class="form-control" class="input" style="width: 100%" maxlength="500" rows="4" placeholder="Informe as competências e Habilidades da disciplina."><?php echo $competencias; ?></textarea>

                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="portlet-body">
                                                    <table class="table  table-striped   " width="100%" cellpadding="0" cellspacing="0" border="0" >
                                                        <tr>
                                                            <td>    <label style="font-weight: bold " class="control-label"><?php echo get_phrase('AVALIAÇÃO DO PROCESSO ENSINO-APRENDIZAGEM : '); ?></label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="avaliacao" id="avaliacao" value="<?php echo $avaliacao; ?>" class="form-control" maxlength="200" placeholder="Informa os tipos de avaliações que serão aplicados." id="basicMax" />
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="portlet-body">
                                                    <table class="table  table-striped   " width="100%" cellpadding="0" cellspacing="0" border="0" >
                                                        <tr>
                                                            <td>    <label style="font-weight: bold " class="control-label"><?php echo get_phrase('INSTRUMENTO : '); ?></label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="instrumento" id="instrumento" value="<?php echo $instrumento; ?>" class="form-control" maxlength="200" placeholder="Quadro, slides, internet, etc. ."  />
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="portlet-body">
                                                    <table class="table  table-striped   " width="100%" cellpadding="0" cellspacing="0" border="0" >
                                                        <tr>
                                                            <td>    
                                                                <label style="font-weight: bold " class="control-label"><?php echo get_phrase('DATA : '); ?></label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="data_pe" id="data_pe" class="form-control" value="<?php echo $data; ?>" maxlength="200" placeholder="A data pode ser de acordo com o calendário da instituição."  />
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>

                                                <table class="table  table-striped  " width="100%"  cellpadding="0" cellspacing="0" border="0" >
                                                    <tr>
                                                        <td align="center" width="100%">
                                                            <div class="control-group">
                                                                <label style="font-weight: bold; margin: auto; " class="control-label"><?php echo get_phrase('PLANO DE AULA'); ?></label>
                                                                <div class="controls">
                                                                <?php //echo $row['registro_academico'];   ?>  
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                </table>
                                                <div id="load_paginacao_rp">

                                                    <div  class="box-content">
                                                        <div id="dataTables">
                                                            <div id="situacao_financeira_table">
                                                                <table class="table lista-clientes table-striped table-bordered table-hover table-green " width="100%" style="border: 5px;" cellpadding="0" cellspacing="0" border="0" >
                                                                    <thead >
                                                                        <tr>
                                                                            <td width="10%" style="background-color: #2C3E50; color: #ffffff"><div>Aula</div></td>
                                                                            <td width="10%" style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Tempos'); ?></div></td>
                                                                            <td width="10%" style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Data'); ?></div></td>
                                                                            <td width="20%" style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Conteúdo'); ?></div></td>
                                                                            <td width="20%" style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Metodologia'); ?></div></td>
                                                                            <td width="20%" style="background-color: #2C3E50; color: #ffffff"><div><?php echo get_phrase('Recursos'); ?></div></td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php
                                                                    if($numrows_pec == 0){
                                                                        $numero_aula = $ch / 2;
                                                                      
                                                                        for ($i = 1; $i <= $numero_aula; $i++) {
                                                                            
                                                                        $data_aula['pdt_nb_codigo'] = $pdt_codigo;
                                                                        $this->db->insert('aulas', $data_aula);
                                                                        $aula_id = mysql_insert_id();
                                                                        
                                                                        $data_pec['aul_nb_codigo'] = $aula_id;
                                                                        $data_pec['pe_nb_codigo'] = $pe_codigo;
                                                                        $this->db->insert('plano_ensino_conteudo', $data_pec);
                                                                        $pec_id = mysql_insert_id();
                                                                        
                                                                        }
                                                                        
                                                                    } 
                                                                        /********CARREGA O CONTEÚDO DO PLANO DE AULA********* */
                                                                        $sql_pec2 = "SELECT * FROM plano_ensino_conteudo pec inner join aulas a on a.aul_nb_codigo = pec.aul_nb_codigo
                                                                        where pe_nb_codigo = $pe_codigo ";
                                                                        $array_pec2 = $this->db->query($sql_pec2)->result_array();
                                                                          $count = 1;
                                                                        foreach ($array_pec2 as $row_pec2):
                                                                            $conteudo = trim($row_pec2['pec_tx_descricao']);
                                                                            $metodologia = trim($row_pec2['pec_tx_estrategia']);
                                                                            $recursos = trim($row_pec2['pec_tx_recurso']);
                                                                            $tempos = $row_pec2['aul_tx_tempo'];
                                                                            $data_aula = $row_pec2['aul_dt_aula'];
                                                                            if($data_aula){
                                                                            $data_aula = date("d/m/Y", strtotime($data_aula));
                                                                            }else{
                                                                                $data_aula = "";
                                                                            }
                                                                            
                                                                            ?>
                                                                            <tr>
                                                                                <td><?php echo $count; ?></td>
                                                                                <td align="left"><input style="width: 80px;" type="text" class="form-control" maxlength="10" placeholder="ex: 1° e 2°" name="tempo<?php echo $count; ?>" id="tempo<?php echo $count; ?>" value="<?php echo $tempos; ?>" /></td>
                                                                                <td align="left"><input type="text" name="data<?php echo $count; ?>" id="data<?php echo $count; ?>" class="datepicker" value="<?php echo $data_aula; ?>" style="width: 100px;" /></td>
                                                                           
                                                                                <td align="left"><textarea name="conteudo<?php echo $count; ?>" id="conteudo<?php echo $count; ?>" class="form-control" class="input" style="width: 200px" maxlength="300" rows="4" placeholder="Conteúdo da aula."><?php echo $conteudo; ?></textarea> </td>
                                                                                <td align="left"><textarea name="metodologia<?php echo $count; ?>" id="metodologia<?php echo $count; ?>"  class="form-control" class="input" style="width: 200px" maxlength="300" rows="4" placeholder="Metodologia."><?php echo $metodologia; ?></textarea></td>
                                                                                <td align="center">
                                                                                    <textarea name="recurso<?php echo $count; ?>" id="recurso<?php echo $count; ?>" class="form-control" class="input" style="width: 200px" maxlength="300" rows="4" placeholder="Recursos."><?php echo $recursos; ?></textarea>
                                                                                </td>
                                                                            </tr>
                                                                                <?php
                                                                                $count++;
                                                                                endforeach;
                                                                            ?>
                                                                    </tbody>
                                                                </table>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br> 
                                                <div class="portlet-body">
                                                    <table class="table  table-striped   " width="100%" cellpadding="0" cellspacing="0" border="0" >
                                                        <tr>
                                                            <td>    <label style="font-weight: bold " class="control-label"><?php echo get_phrase('REFERÊNCIAS BIBLIOGRÁFICAS : '); ?></label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <textarea id="referencia_bibliografica" name="referencia_bibliografica" class="form-control" class="input" style="width: 100%" maxlength="500" rows="10" placeholder="Informe as Referências ."><?php echo $referencia; ?></textarea>

                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <br>
                                                
                                                                <table>
                                                                    <tr>
                                                                        <td align="center">

                                                                            <button type="submit" class="btn btn-blue" >Salvar Plano de Ensino</button>
                                                                        </td>
                                                                    </tr>

                                                                </table>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.portlet -->
                        </div>
                    </div>
                    <br>



                    <br>
<?php
// endforeach;
?>  
                </div>
            </div>
            <!-- /#page-wrapper -->
            <!-- end MAIN PAGE CONTENT -->

        </div>







        <!-- Logout Notification Box -->
        <!-- GLOBAL SCRIPTS -->
        <!-- Logout Notification Box -->

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

        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/popupoverlay/logout.js"></script>
        <!-- HISRC Retina Images -->
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/hisrc/hisrc.js"></script>

        <!-- PAGE LEVEL PLUGIN SCRIPTS -->
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/bootstrap-tokenfield/bootstrap-tokenfield.min.js"></script>
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/bootstrap-tokenfield/scrollspy.js"></script>
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/bootstrap-tokenfield/affix.js"></script>
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/bootstrap-tokenfield/typeahead.min.js"></script>
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/bootstrap-maxlength/bootstrap-maxlength.js"></script>
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>

        <!-- THEME SCRIPTS -->
        <script src="<?php echo base_url(); ?>template/dashboard/js/flex.js"></script>
        <script src="<?php echo base_url(); ?>template/dashboard/js/demo/advanced-form-demo.js"></script>
        <script language="JavaScript" type="text/javascript">
                                                                $('.datepicker').datepicker({
                                                                    format: 'dd/mm/yyyy',
                                                                    language: 'pt-BR'
                                                                });
        </script>
    </body>

</html>
