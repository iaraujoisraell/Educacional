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
        
         var base_url = "<?php base_url() ?>";

           function janelanovopagamento() {

            //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal


            $('#flexModal').modal('show');


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



    </script>
    
    <body>
     
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
                    foreach ($turma as $row):
                        $matricula = $row['matricula_aluno_id'];
                        $cadastro_aluno = $row['cadastro_aluno_id'];
                        $matriz_id = $row['matriz_id'];
                        $periodo_atual = $row['periodo_atual'];
                        $desperiodizado = $row['desperiodizado'];
                        $bolsista = $row['bolsista'];
                        $forma_ingresso = $row['forma_ingresso'];
                        $nome_aluno = $row['nome'];
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

                        <!-- begin PAGE TITLE AREA -->
                        <!-- Use this section for each page's title and breadcrumb layout. In this example a date range picker is included within the breadcrumb. -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="page-title">
                                    <h1>Histórico Financeiro do Aluno

                                    </h1>
                                    <ol class="breadcrumb">
                                        <li><i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                                        </li>
                                        <li class="active">Histórico Financeiro do Aluno</li>
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
                                    

                                   
                                    <div class="portlet-body">
                                        <div class="table-responsive">  
                                            <div   class="tab-content">
                                                <div style="margin-left: 15px;"  class="tab-pane fade in active">                            
                                                     <table class="table  table-striped  " width="100%"  cellpadding="0" cellspacing="0" border="0" >
                                            
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
                                                     <table class="table  table-striped   " width="100%" cellpadding="0" cellspacing="0" border="0" >
                                            
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
                                                            
                                                            //$matricula_aluno_turma_id = $row_mt2['matricula_aluno_turma_id'];

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

                                            <br>
                                            <table>
                                                <tr>
                                                    <td align="center">
                                                        <a  href="index.php?admin/ficha_aluno/<?php echo $matricula; ?>"  class="btn btn-blue btn-small" >
                                                            <i class="icon-wrench"></i> <?php echo get_phrase('Ficha_aluno'); ?>
                                                        </a>
                                                       
                                                    </td>
                                                </tr>

                                            </table>

                                            <br>

                                        </div>
                                        
                                    </div>
                                </div>
                                <!-- /.portlet -->
                            </div>
                            
                        </div>
                        <div id="dataTables">
                                <table class="table lista-clientes table-striped table-bordered table-hover  " width="100%" style="border: 5px;" cellpadding="0" cellspacing="0" border="0" >
                                    <thead >
                                        <tr>
                                            <td style="background-color: #2C3E50; color: #ffffff"><div>ID</div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Parcela'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Período_letivo'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Dt_vencimento'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Valor'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Referente'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('situação'); ?></div></td>
                                            <td style="background-color: #2C3E50; color: #ffffff"><div><?php echo get_phrase('opções'); ?></div></td>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql_mt22 = " select * FROM matricula_aluno_turma mat where matricula_aluno_id = $matricula ";
                                        $uf_mt22 = $this->db->query($sql_mt22)->result_array();
                                        foreach ($uf_mt22 as $row_mt22):
                                            $matricula_aluno_turma_id = $row_mt22['matricula_aluno_turma_id'];
                                            //echo $matricula_aluno_turma_id;

                                        

                                        $sql = "select mensalidade_id,men_dt_vencto,men_nb_numero_parcela,men_nb_status, men_fl_valor,men_tx_mes,
                                                            men_tx_obs, p.descricao as produto, referencia, mf_nb_forma_pagamento, m.periodo_letivo_id, CONCAT(t.ano,'/',t.semestre) AS periodo_letivo_turma, obs
                                                            FROM siga_financeiro.mensalidade m
                                                            left join siga_financeiro.movimento_financeiro mf on mf.mensalidades_id = m.mensalidade_id
                                                            inner join siga_financeiro.produto p on p.produto_id = m.produto_id
                                                            inner join matricula_aluno_turma mat on mat.matricula_aluno_turma_id = m.matricula_aluno_turma_id
                                                            inner join turma t on t.turma_id = mat.turma_id
                                                            where m.matricula_aluno_turma_id = $matricula_aluno_turma_id and m.matricula_aluno_id = $matricula

                                                            union

                                                            select mensalidade_id,men_dt_vencto, men_nb_numero_parcela, men_nb_status, men_fl_valor, men_tx_mes, men_tx_obs,
                                                            p.descricao as produto, referencia, mf_nb_forma_pagamento, m.periodo_letivo_id, CONCAT(t.ano,'/',t.semestre) AS periodo_letivo_turma, obs
                                                             FROM siga_financeiro.mensalidade m left join siga_financeiro.movimento_financeiro mf on mf.mensalidades_id = m.mensalidade_id
                                                             inner join matricula_aluno_turma mat on mat.matricula_aluno_turma_id = m.matricula_aluno_turma_id
                                                             left join siga_financeiro.produto p on p.produto_id = m.produto_id
                                                            inner join turma t on t.turma_id = mat.turma_id where m.matricula_aluno_turma_id = $matricula_aluno_turma_id";
                                        //echo  $sql;
                                        $MatrizArray = $this->db->query($sql)->result_array();
                                        $count = 1;
                                        foreach ($MatrizArray as $row2):
                                            $parcela = $row2['men_nb_numero_parcela'];

                                            if ($parcela > 6) {
                                                $parcela = '-';
                                            } else {
                                                $parcela = $row2['men_nb_numero_parcela'];
                                            }

                                            $data_vencimento = $row2['men_dt_vencto'];
                                            $data_vencimento = date("d/m/y", strtotime($data_vencimento));

                                            $valor = $row2['men_fl_valor'];
                                            $valor2 = number_format($valor, 2, ',', '.');



                                            $produto = $row2['produto'];

                                            $periodo_letivo_m = $row2['periodo_letivo_id'];

                                            if ($produto) {
                                                $produto = $row2['produto'];
                                            } else {
                                                $produto = $row2['referencia'];
                                            }
                                            $matricula_aluno_turma_id = $row2['matricula_aluno_turma_id'];


                                            $situacao = $row2['men_nb_status'];
                                            if ($situacao == '1') {
                                                $situacao2 = 'Pago';
                                            } else if ($situacao == '') {
                                                $situacao2 = 'Em aberto';
                                            } else if ($situacao == '3') {
                                                $situacao2 = 'Matricula Trancada';
                                            }

                                            //$sql.=" order by nome asc ";
                                            ?>

                                            <tr >
                                                <td><?php echo $count++; ?></td>
                                                <td align="left"><?php echo $parcela; ?></td>
                                                <td align="left"><?php echo $periodo_letivo_m; ?></td>
                                                <td align="left"><?php echo $data_vencimento; ?></td>
                                                <td align="left"><?php echo $valor2; ?> </td>
                                                <td align="left"><?php echo $produto; ?> </td>
                                                <td align="left"><?php echo $situacao2; ?></td>
                                                <td align="center">
                                                    <?php if ($situacao == '1') { ?>
                                                        <button href="javascript:;" class="btn btn-primary" data-target="#flexModal" onclick="janelanovopagamento();">Realizar Pagamento</button>
                                                    <?php } else if ($situacao == '2') { ?> 
                                                        <a  href="index.php?admin/carne_impressao/<?php echo $matricula; ?>/<?php echo $matricula_aluno_turma_id; ?>" target="_blank" class="btn btn-gray btn-small">
                                                            <button href="javascript:;" class="btn btn-primary"  ><i class="fa fa-print"> </i> Carnê</button></a>
                                                    <?php } ?> 
                                                </td>
                                            </tr>
                                            <?php
                                        endforeach;
                                        
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>

                            </div>
                                    
                                
                   
               
                        <?php
                    endforeach;
                    ?>  
                </div>
            </div>
            <!-- /#page-wrapper -->
            <!-- end MAIN PAGE CONTENT -->

        </div>
        <!-- /#wrapper -->
        <!-- Flex Modal -->
        <!-- *********************** NOVO REGISTRO ******************************  -->
        <div class="modal modal-flex fade" id="flexModal" tabindex="-1" role="dialog" aria-labelledby="flexModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="flexModalLabel">Pagamento Referente a Matrícula</h4>

                    </div>

                    <?php echo form_open('admin/situacao_financeiro_aluno/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <form method="post" action="<?php echo base_url(); ?>index.php?admin/contas_receber/create/" class="form-horizontal validatable" enctype="multipart/form-data">
                        <input type="hidden" value="<?php echo $matricula; ?>" name="matricula_aluno_id" id="matricula_aluno_id">
                        <input type="hidden" value="<?php echo $matricula_aluno_turma_id; ?>" name="matricula_aluno_turma_id" id="matricula_aluno_turma_id">
                        <input type="hidden" value="<?php echo $row2['periodo_letivo']; ?>" name="periodo_letivo" id="periodo_letivo">
                        
                        <div style="margin:auto; width: 450px;" class="modal-body">


                            <table>
                                <tr>
                                    <td>
                                        <font size="4px;">   Aluno </font>
                                    </td>
                                </tr>
                                <tr>
                                    <td >
                                        <input type="text" disabled="true" value="<?php echo $row['registro_academico']; ?> - <?php echo $nome_aluno; ?>" name="nome" class="input" style="height: 30px; width: 410px;">
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <td>
                                        <font size="4px;">  Referente ao Período Letívo </font>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" disabled value="<?php echo $row2['periodo_letivo']; ?>" name="periodo_letivo"  class="input" style="height: 30px; width: 410px;">
                                    </td>
                                </tr>
                            </table>
                            <table   class="table table-normal">
                                <tr>
                                    
                                    <td><b>Disciplina(s) do aluno. Turma : <?php echo $row2['tur_tx_descricao']; ?></b></td>
                                   
                                </tr>
                                <tr>
                                    <td>
                                
                                

                                <?php
                                // $candidato = $this->crud_model->get_demonstrativo_nota($current_matricula_aluno_turma_id);
                                $cont2 = 1;
                                $sql_candidato = "SELECT d.disc_tx_descricao as disciplina, dan_fl_nota_1bim as 1bim, dan_fl_nota_2bim as 2bim,dan_fl_nota_3bim as 3bim, dan_fl_media_final as media,dan_nb_total_falta as falta, dan_nb_situacao_final as situacao FROM disciplina_aluno da
left join disciplina_aluno_nota dan on dan.disciplina_aluno_id = da.disciplina_aluno_id
inner join disciplina d on d.disciplina_id = da.disciplina_id
where matricula_aluno_turma_id = $matricula_aluno_turma_id

union

SELECT d.disc_tx_descricao as disciplina, dan_fl_nota_1bim as 1bim, dan_fl_nota_2bim as 2bim,dan_fl_nota_3bim as 3bim, dan_fl_media_final as media,dan_nb_total_falta as falta, dan_nb_situacao_final as situacao FROM disciplina_aluno da
left join disciplina_aluno_nota dan on dan.disciplina_aluno_id = da.disciplina_aluno_id
inner join matriz_disciplina md on md.matriz_disciplina_id = da.matriz_disciplina_id
inner join disciplina d on d.disciplina_id = md.disciplina_id
where matricula_aluno_turma_id = $matricula_aluno_turma_id ";
                                $candidato = $this->db->query($sql_candidato)->result_array();
                                foreach ($candidato as $row_candidato):
                                    
                                    ?>
                                        <font style="font-size: 12px;">  <?php echo $cont2++; ?>-<?php echo $row_candidato['disciplina']; ?></font>
                                        
                                    </br>
                                    <?php
                                endforeach;
                                ?>
                           
                                        </td>
                                </tr>
                            </table>
                            <table width="61%">
                                <tr>
                                    <td width="20%">
                                        <font size="4px;">    Data do Pagamento </font><font style="color: red"> * </font>
                                    </td>
                                    <td width="21%">
                                        <font size="4px;">    Valor  </font><font style="color: red"> * </font>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" onkeypress="mascara(this, '##/##/####')" maxlength="10" minlength="10" placeholder="99/99/9999" id="calendario3" name="vencimento" required="true" class="input" style="height: 30px; width: 205px;" >
                                    </td>
                                    <td>
                                        <input type="text" placeholder="R$ 0.000,00" name="valor" onKeyPress="return(MascaraMoeda1(this, '.', ',', event))" id="valor_mask" required="true" class="input" style="height: 30px; width: 205px;" >
                                    </td>
                                </tr>
                            </table>
                            <table><tr>
                                    <td width="20%">
                                        <font size="4px;">    Forma de Pagamento </font><font style="color: red"> * </font>
                                    </td>
                                    
                                </tr>
                                <tr>
                                     <td>
                                        <select class="input" id="ocorrencia" name="forma_pagamento"  style="height: 30px; width: 410px;" >
                                                <option value="1">À Vista</option>
                                                <option value="2">C. Crédito</option>
                                                <option value="3">C. Débito</option>
                                                <option value="4">Cheque</option>
                                                <option value="5">Boleto</option>
                                                <option value="6">Tranferência Bancária</option>
                                            </select>
                                    </td>  
                                 </tr>
                            </table>
                            
                            <table>
                                <tr>
                                    <td>
                                        <font size="4px;">   Observação</font>
                                    </td>
                                </tr>

                                <tr>
                                    <td> <div id='historico'>
                                            <textarea class="input" name="historico" style="height: 50px; width: 410px;">

                                            </textarea></div>
                                    </td>
                                </tr>

                            </table>
                            <br>
                            
                            <div >
                                <table>
                                    <tr>
                                        <td width="20%">
                                            <font size="4px;">Deseja Gerar Mensalidades para o aluno?(<?php echo $row2['periodo_letivo']; ?>)</font>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>

                                            <select class="input" id="gerar_mensalidade" name="gerar_mensalidade"  style="height: 30px; width: 150px; " onchange="if (document.getElementById('gerar_mensalidade').value == 1) {
                                                    ShowHideDIV('mensalidades', 1);
                                                 
                                                } else {
                                                    ShowHideDIV('mensalidades', 0);
                                                
                                                }"  >
                                                <option  value="0">NÃO</option>
                                                <option   value="1">SIM</option>
                                            </select>

                                        </td>
                                    </tr>
                                </table>
                            </div>
                            
                            <div id="mensalidades" style="display: none">
                            <table width="60%">
                                <tr>
                                    <td width="20%">
                                        <font size="4px;">Dt Vencimento da 1a. Mensalidade (obs: parcelas mensais, não incluir a matrícula)</font>
                                    </td>

                                    
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" onkeypress="mascara(this, '##/##/####')" maxlength="10" minlength="10" placeholder="99/99/9999" id="calendario3" name="vencimento_mensalidade" required="true" class="input" style="height: 30px; width: 410px;" >
                                    </td>

                                 
                                 </tr>
                            </table>
                                <table width="60%">
                                <tr>
                                    <td width="20%">
                                        <font size="4px;">Valor das mensalidades</font>
                                    </td>

                                    
                                </tr>
                                
                                <tr>
                                    <td>
                                        <input type="text"  placeholder="R$ 0.000,00" name="valor_mensalidade" onKeyPress="return(MascaraMoeda1(this, '.', ',', event))" id="valor_mask" required="true" class="input" style="height: 30px; width: 410px;" >
                                    </td>

                                 
                                 </tr>
                            </table>
                                <table width="60%">
                                <tr>
                                      <td width="25%">
                                        <font size="4px;"> Quantidade de mensalidades</font>
                                    </td>
                                    <td ></td>
                                </tr>
                                <tr>
                                     <td>
                                        <select class="input" id="quantidade_mensalidade" name="quantidade_mensalidade"  style="height: 30px; width: 410px;" >
                                            <option  value="5">5</option>
                                                <option  value="1">1</option>
                                                <option  value="2">2</option>
                                                <option  value="3">3</option>
                                                <option  value="4">4</option>
                                                
                                                <option  value="6">6</option>
                                                <option  value="7">7</option>
                                                <option  value="8">8</option>
                                                <option  value="9">9</option>
                                                <option  value="10">10</option>
                                                <option  value="11">11</option>
                                                <option  value="12">12</option>
                                            </select>
                                    </td>  
                                 </tr>
                            </table>
                                
                            </div>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-green" >Confirmar</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.row -->
       


       
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


    </body>

</html>
