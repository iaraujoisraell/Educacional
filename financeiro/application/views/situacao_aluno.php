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

                        <!-- begin PAGE TITLE AREA -->
                        <!-- Use this section for each page's title and breadcrumb layout. In this example a date range picker is included within the breadcrumb. -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="page-title">
                                    <h1>Situação do Aluno

                                    </h1>
                                    <ol class="breadcrumb">
                                        <li><i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                                        </li>
                                        <li class="active">Situação do Aluno</li>
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

                                            <br>
                                            <table>
                                                <tr>
                                                    <td align="center">
                                                        <a  href="index.php?admin/ficha_aluno/<?php echo $matricula; ?>"  class="btn btn-info btn-small" >
                                                            <i class="icon-wrench"></i> <?php echo get_phrase('Ficha_aluno'); ?>
                                                        </a>
                                                        <a  href="#" onclick="alert('Em Breve')"  class="btn btn-info btn-small">
                                                            <i class="icon-money"></i> <?php echo get_phrase('situação_financeira'); ?>
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
                         <div class="box-content padded">
                    <div class="tab-content">
                        <div class="tab-pane  active" id="list">
                            <div class="action-nav-normal">
                                <div class="box">
                                    <div class="box-content">
                                        <div id="dataTables">
                                            <table class="table lista-clientes table-striped table-bordered table-hover table-green " width="100%" style="border: 5px;" cellpadding="0" cellspacing="0" border="0" >
                                                <thead >
                                                    <tr>
                                                        <td><div>ID</div></td>
                                                        <td align="left"><div><?php echo get_phrase('Turma'); ?></div></td>
                                                        <td align="left"><div><?php echo get_phrase('Período_letivo'); ?></div></td>
                                                        <td align="left"><div><?php echo get_phrase('Período'); ?></div></td>
                                                        <td align="left"><div><?php echo get_phrase('turno'); ?></div></td>
                                                        <td align="left"><div><?php echo get_phrase('situação'); ?></div></td>
                                                        

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql = "SELECT mat.matricula_aluno_turma_id as matricula_aluno_turma_id, t.turma_id, t.ano as ano, t.semestre as semestre,
                                                        mat.periodo as periodo_mat, t.periodo_letivo_id,tur_tx_descricao,tu.turno_id, mat.dependencia as dependencia,
                                                        tu.descricao as turno, p.periodo_id, p.periodo as periodo, 
                                                        pl.periodo_letivo as periodo_letivo,
                                                        mat.situacao_aluno_turma as situacao_aluno_turma
                                                        FROM matricula_aluno_turma mat
                                                    inner join matricula_aluno m on m.matricula_aluno_id = mat.matricula_aluno_id
                                                    inner join cadastro_aluno ca on ca.cadastro_aluno_id = m.cadastro_aluno_id
                                                    inner join turma t on t.turma_id = mat.turma_id
                                                    inner join cursos c on c.cursos_id = m.curso_id
                                                    inner join turno tu on tu.turno_id = t.turno_id
                                                    left join periodo p on p.periodo_id = t.periodo_id
                                                    left join periodo_letivo pl on pl.periodo_letivo_id = mat.periodo_letivo_id
                                                    where  m.matricula_aluno_id = '$matricula' and (mat.status != '11' or mat.status is null) order by matricula_aluno_turma_id desc ";
                                                    //echo  $sql;
                                                    $MatrizArray = $this->db->query($sql)->result_array();
                                                    $count = 1;
                                                    foreach ($MatrizArray as $row2):
                                                        $periodo_letivo = $row2['periodo_letivo'];
                                                        if ($periodo_letivo) {
                                                            $periodo_letivo = $row2['periodo_letivo'];
                                                        } else {
                                                            $periodo_letivo = $row2['ano'] . '/' . $row2['semestre'];
                                                        }
                                                        $periodo = $row2['periodo'];
                                                        if ($periodo) {
                                                            $periodo2 = $row2['periodo'];
                                                        } else {
                                                            $periodo = $row2['periodo_mat'];
                                                        }
                                                        $matricula_aluno_turma_id = $row2['matricula_aluno_turma_id'];
                                                        if($periodo2 == 1){
                                                            $periodo = 'I';
                                                        }else if($periodo2 == 2){
                                                            $periodo = 'II';
                                                        }else if($periodo2 == 3){
                                                            $periodo = 'III';
                                                        }else if($periodo2 == 4){
                                                            $periodo = 'IV';
                                                        }else if($periodo2 == 5){
                                                            $periodo = 'V';
                                                        }else if($periodo2 == 6){
                                                            $periodo = 'VI';
                                                        }else if($periodo2 == 7){
                                                            $periodo = 'VII';
                                                        }else if($periodo2 == 8){
                                                            $periodo = 'VIII';
                                                        }else if($periodo2 == 9){
                                                            $periodo = 'IX';
                                                        }else if($periodo2 == 10){
                                                            $periodo = 'X';
                                                        }
                                                        
                                                        $situacao = $row2['situacao_aluno_turma'];
                                                        if ($situacao == '1') {
                                                            $situacao2 = 'Pré-Matriculado';
                                                        } else if ($situacao == '2') {
                                                            $situacao2 = 'Matriculado';
                                                        }else if ($situacao == '3') {
                                                            $situacao2 = 'Matricula Trancada';
                                                        }else if ($situacao == '4') {
                                                            $situacao2 = 'Desvinculado do curso';
                                                        }else if ($situacao == '5') {
                                                            $situacao2 = 'Transferido';
                                                        }else if ($situacao == '6') {
                                                            $situacao2 = 'Formado';
                                                        }else if ($situacao == '0') {
                                                            $situacao2 = 'período concluído';
                                                        }else if ($situacao == '7') {
                                                            $situacao2 = 'Falecido';
                                                        }
                                                        $dependencia = $row2['dependencia'];
                                                        if($dependencia == 1){
                                                            $dependencia_tx = '( Dependência )';
                                                        }else if(($dependencia == null)||($dependencia == "")){
                                                            $dependencia_tx = '';
                                                        }
                                                        //$sql.=" order by nome asc ";
                                                        ?>

                                                        <tr >
                                                            <td><?php echo $count++; ?></td>
                                                            <td align="left"><?php echo $row2['tur_tx_descricao']; ?></td>
                                                            <td align="left"><?php echo $periodo_letivo; ?></td>
                                                            <td align="left"><?php echo $periodo; ?></td>
                                                            <td align="left"><?php echo $row2['turno']; ?> </td>
                                                            <td align="left"><?php echo $situacao2; ?><font style="font-size: 9px; color: #DD1144;"><?php echo $dependencia_tx; ?></font></td>
                                                            
                                                        </tr>
                                                        <?php
                                                    endforeach;
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
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
                        <h4 class="modal-title" id="flexModalLabel">Nova Conta a Receber</h4>

                    </div>

                    <?php echo form_open('admin/contas_receber/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <form method="post" action="<?php echo base_url(); ?>index.php?admin/contas_receber/create/" class="form-horizontal validatable" enctype="multipart/form-data">


                        <div style="margin-left: 20px;" class="modal-body">


                            <table>
                                <tr>
                                    <td>
                                        <font size="4px;">   Fornecedor </font>
                                    </td>
                                </tr>
                                <tr>
                                    <td >

                                        <select class="input" name="fornecedor" style="height: 30px; width: 410px;">
                                            <?php
                                            $sql_curso2 = "SELECT * FROM fornecedor where cliente = 1 order by for_tx_razao_social";
                                            $exe_curso2 = mysql_query($sql_curso2) OR DIE('linha 106 ' . mysqli_error($conexao));

                                            while ($linha_curso2 = mysql_fetch_array($exe_curso2)) {
                                                ?>
                                                <option  value="<?php echo $linha_curso2['fornecedor_id']; ?> " ><?php echo $linha_curso2['for_tx_razao_social']; ?> </option>
                                            <?php } ?>
                                        </select>

                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <td>
                                        <font size="4px;">   Número do Orçamento </font>
                                    </td>
                                </tr>
                                <tr>
                                    <td >
                                        <input type="text" name="numero_orcamento" class="input" style="height: 30px; width: 410px;">
                                    </td>
                                </tr>
                            </table> 
                            <table width="61%">
                                <tr>
                                    <td width="20%">
                                        <font size="4px;">    Vencimento </font><font style="color: red"> * </font>
                                    </td>
                                    <td width="21%">
                                        <font size="4px;">    Valor </font><font style="color: red"> * </font>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" onkeypress="mascara(this, '##/##/####')" maxlength="10" minlength="10" placeholder="99/99/9999" id="calendario3" name="vencimento" required="true" class="input" style="height: 30px; width: 200px;" >
                                    </td>
                                    <td>
                                        <input type="text" placeholder="R$ 0.000,00" name="valor" onKeyPress="return(MascaraMoeda1(this, '.', ',', event))" id="valor_mask" required="true" class="input" style="height: 30px; width: 200px;" >
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <td>
                                        <font size="4px;">  Número Nota Fiscal </font>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="numero_documento" class="input" style="height: 30px; width: 410px;">
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <td>
                                        <font size="4px;">    histórico</font>
                                    </td>
                                </tr>

                                <tr>
                                    <td> <div id='historico'>
                                            <textarea class="input" name="historico" style="height: 50px; width: 410px;">

                                            </textarea></div>
                                    </td>
                                </tr>

                            </table>


                            <table width="60%">
                                <tr>
                                    <td width="20%">
                                        <font size="4px;">     Categoria</font>
                                    </td>

                                    <td width="25%">
                                        <font size="4px;">   Ocorrência</font>
                                    </td>
                                    <td ></td>
                                </tr>
                                <tr>
                                    <td>
                                        <select class="input" name="categoria" style="height: 30px; width: 150px;">
                                            <?php
                                            $sql_curso2 = "SELECT * FROM categoria order by cat_tx_descricao asc";
                                            $exe_curso2 = mysql_query($sql_curso2) OR DIE('linha 106 ' . mysqli_error($conexao));

                                            while ($linha_curso2 = mysql_fetch_array($exe_curso2)) {
                                                ?>
                                                <option  value="<?php echo $linha_curso2['categoria_id']; ?> " ><?php echo $linha_curso2['cat_tx_descricao']; ?> </option>
                                            <?php } ?>
                                        </select>

                                    </td>

                                    <td>
                                        <select class="input" id="ocorrencia" name="ocorrencia" onchange="if (document.getElementById('ocorrencia').value == 3) {
                                                    ShowHideDIV('quantidade', 1);
                                                    ShowHideDIV('pago', 0);
                                                } else {
                                                    ShowHideDIV('quantidade', 0);
                                                    ShowHideDIV('pago', 1);
                                                }" onclick="if (document.getElementById('ocorrencia').value == 3) {
                                                            ShowHideDIV('quantidade', 1);
                                                            ShowHideDIV('pago', 0);
                                                        } else {
                                                            ShowHideDIV('quantidade', 0);
                                                            ShowHideDIV('pago', 1);
                                                        }" style="height: 30px; width: 150px;">
                                            <option  value="1">ÚNICA</option>
                                            <option   value="3">PARCELADA</option>
                                        </select>

                                    </td>


                                    <td> <div id="quantidade" style="display: none">  <input type="text" placeholder="Qtde" name="quantidade" class="input" style="height: 30px; width: 100px;"> </div> </td>             


                                </tr>
                            </table>
                            <div id="pago" style="display: block">
                                <table>
                                    <tr>
                                        <td width="20%">
                                            <font size="4px;">Já foi pago?</font>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>

                                            <select class="input" id="ocorrencia" name="pago"  style="height: 30px; width: 150px;">
                                                <option  value="0">NÃO</option>
                                                <option   value="1">SIM</option>
                                            </select>

                                        </td>
                                    </tr>
                                </table>
                            </div>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-green" >Criar Receita</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.row -->
        <!-- *********************** EFETUAR PAGAMENTO ******************************  -->
        <div class="modal modal-flex fade" id="editar_fornecedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="flexModalLabel">Confirmar Pagamento </h4>
                    </div>



                    <?php echo form_open('admin/contas_receber/efetuar_pagamento/', array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <input  name="codigo_cpr"  id="codigo_cpr" type="hidden" >


                    <div style="margin-left: 20px;" class="modal-body">
                        <table width="100%">
                            <tr>
                                <td width="30%">
                                    <font style="color: #696969;" size="2">  Cliente   </font><font color="#ff0000"> </font>
                                </td>
                                <td width="70%">
                                    <input style="border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 250px; height: 20px" required="true" name="fornecedor_pg"  id="fornecedor_pg" type="text" >

                                </td>                                                                                           
                            </tr>

                        </table>
                        <!--Razão Social - Fantasia-->
                        <table width="100%">            
                            <tr>
                                <!--Razão Social-->
                                <td width="30%">
                                    <font style="color: #696969;" size="2">  Valor do pagamento  R$</font>
                                </td>
                                <!--Fantasia-->
                                <td width="70%">

                                    <input  style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 100px; height: 20px;" 
                                            type="text" required="true"  onkeyup="this.value = this.value.toUpperCase()"
                                            id="valor" name="valor"
                                            size="40" maxlength="50" />
                                </td>

                            </tr>

                            <tr>
                                <!--Razão Social-->
                                <td width="30%">
                                    <div >   <font style="color: #696969;" size="2">  Data Vencimento  </font></div>
                                </td>
                                <!--Fantasia-->
                                <td width="70%">
                                    <div >

                                        <input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 100px; height: 20px" 
                                               required="true" type="text"  onkeyup="this.value = this.value.toUpperCase()" 
                                               id="data_vencimento" required="true" name="data_vencimento" size="40" maxlength="30" /></div>
                                </td>
                            </tr>   
                            <tr>
                                <!--Razão Social-->
                                <td width="30%">
                                    <div >   <font style="color: #696969;" size="2">  Data Pagamento  </font></div>
                                </td>
                                <!--Fantasia-->
                                <td width="70%">
                                    <div >

                                        <input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 100px; height: 20px" 
                                               required="true" type="text"  onkeyup="this.value = this.value.toUpperCase()" 
                                               id="data_pagamento"  required="true" onkeypress="mascara(this, '##/##/####')" maxlength="10" minlength="10"  name="data_pagamento" size="40" maxlength="30" /></div>
                                </td>
                            </tr>           



                            <tr>
                                <!--Telefone-->
                                <td width="30%">
                                    <font style="color: #696969;" size="2">  Forma de Pagamento  </font>
                                </td>
                                <td width="70%">
                                    <select class="input" name="forma_pagamento" style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 200px; height: 20px" >
                                        <option value="1">ESPÉCIE</option>
                                        <option value="2">CARTÃO DE CRÉDITO</option>
                                        <option value="3">CARTÃO DE DÉBITO</option>
                                        <option value="4">CHEQUE</option>
                                        <option value="5">BOLETO</option>
                                        <option value="6">TRANSF. BANCARIA</option>
                                        <option value="7">OUTRO</option>
                                    </select>
                                </td>
                                <!--Celular-->
                            </tr>


                        </table>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-green" >Confirmar Pagamento</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>
    


        <style>
            .container {
                margin-top: 50px;
            }
        </style>
        <!-- ************************************* MODAL Ecluir ***************************************** -->

        <div class="modal modal-flex fade" id="excluir_fornecedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="flexModalLabel">Excluir Receita</h4>
                    </div>



<?php echo form_open('admin/contas_receber/delete/', array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>


                    <div class="modal-body">
                        <table>
                            <tr>
                                <td>

                                    <input name="codigo_despesa"  id='codigo_despesa' type="hidden" >
                                </td>                                                                                           
                            </tr>


                        </table>
                        <!--Razão Social - Fantasia-->
                        <table width="400">            
                            <tr>
                                <!--Razão Social-->
                                <td>
                                    <h3>
                                        <i class="fa fa-eraser text-red"></i> Deseja excluir este Registro?
                                    </h3>
                                </td>
                                <!--Fantasia-->

                            </tr>

                        </table>





                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default"  data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger " > Excluir</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>


        <!-- ************************************* MODAL CANCELAR ***************************************** -->

        <div class="modal modal-flex fade" id="cancelar_pagamento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="flexModalLabel">Cancelar Pagamento </h4>
                    </div>



<?php echo form_open('admin/contas_receber/cancelar/', array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>


                    <div class="modal-body">
                        <table>
                            <tr>
                                <td>

                                    <input name="codigo_fornecedor_excluir2"  id='codigo_fornecedor_excluir2' type="hidden" >
                                </td>                                                                                           
                            </tr>


                        </table>
                        <!--Razão Social - Fantasia-->
                        <table width="400">            
                            <tr>
                                <!--Razão Social-->
                                <td>
                                    <h3>
                                        <i class="fa fa-eraser text-red"></i> Deseja Cancelar este Pagamento?
                                    </h3>
                                </td>
                                <!--Fantasia-->

                            </tr>

                        </table>





                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default"  data-dismiss="modal">Voltar</button>
                        <button type="submit" class="btn btn-danger " > Confirmar</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>
        <!-- Logout Notification Box -->
        <!-- GLOBAL SCRIPTS -->
        <!-- Logout Notification Box -->
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
