<html >
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="template/jquery.quick.search.js"></script>
    <?php include 'application/views/header.php'; ?>
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
                var url = 'index.php?admin/carrega_municipio/' + uf;  //caminho do arquivo php que irá buscar as cidades no BD
                $.get(url, function (dataReturn) {
                    $('#load_muncipio').html(dataReturn);  //coloco na div o retorno da requisicao
                });
            }
        }

        function buscar_cidade() {
            var uf2 = $('#uf').val();  //codigo do estado escolhido
            //se encontrou o estado
            if (uf2) {
                var url = 'index.php?admin/carrega_cidade/' + uf2;  //caminho do arquivo php que irá buscar as cidades no BD
                $.get(url, function (dataReturn) {
                    $('#load_cidade').html(dataReturn);  //coloco na div o retorno da requisicao
                });
            }
        }

        function buscar_deficiencia() {
            var deficiencia = $('#deficiencia').val();  //codigo do estado escolhido
            //se encontrou o estado
            if (deficiencia) {
                var url = 'index.php?admin/carrega_doencas/' + deficiencia;  //caminho do arquivo php que irá buscar as cidades no BD
                $.get(url, function (dataReturn) {
                    $('#load_doencas').html(dataReturn);  //coloco na div o retorno da requisicao
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


        function buscar_turma_matricula() {
            var curso = $('#curso').val();  //codigo do estado escolhido
            //se encontrou o estado
            if (curso) {
                var url = 'index.php?admin/carrega_turma_matricula/' + curso;  //caminho do arquivo php que irá buscar as cidades no BD
                $.get(url, function (dataReturn) {
                    $('#load_turma_matricula').html(dataReturn);  //coloco na div o retorno da requisicao
                });
            }
        }
        function buscar_periodo_letivo() {
            var curso = $('#curso_busca').val();  //codigo do estado escolhido
            //se encontrou o estado
            if (curso) {
                var url = 'index.php?admin/carrega_periodo_letivo/' + curso;  //caminho do arquivo php que irá buscar as cidades no BD
                $.get(url, function (dataReturn) {
                    $('#load_periodo_letivo').html(dataReturn);  //coloco na div o retorno da requisicao
                });
            }
        }

        function buscar_turma() {
            var curso = $('#curso_busca').val();  //codigo do estado escolhido
            var periodo_letivo = $('#periodo_letivo_busca').val();

            //se encontrou o estado
            if (curso) {
                var url = 'index.php?admin/carrega_turma/' + curso + '/' + periodo_letivo;  //caminho do arquivo php que irá buscar as cidades no BD
                $.get(url, function (dataReturn) {
                    $('#load_turma').html(dataReturn);  //coloco na div o retorno da requisicao
                });
            }
        }

        function buscar_paginacao_receber_pagamento() {
          
            //se encontrou o estado
                var url = 'index.php?admin/carrega_table_minhas_disciplinas_plano_ensino/';  //caminho do arquivo php que irá buscar as cidades no BD
                $.get(url, function (dataReturn) {
                    $('#load_paginacao_rp').html(dataReturn);  //coloco na div o retorno da requisicao
                });
            
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


                    <!-- begin PAGE TITLE AREA -->
                    <!-- Use this section for each page's title and breadcrumb layout. In this example a date range picker is included within the breadcrumb. -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-title">
                                <h1>Plano de Ensino</h1>
                                <ol class="breadcrumb">
                                    <li><i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                                    </li>
                                    <li class="active">Plano de Ensino</li>
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
                                        <table class="table  table-striped  " width="100%"  cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td>
                                                    <div class="control-group">
                                                        <label class="control-label"><?php echo get_phrase('Filtro de Busca'); ?></label>
                                                        <div class="controls">
                                                              <input type="text" class="input-search" alt="lista-clientes" placeholder="Procurar " />
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>



                                        
                                        <br>

                                        <div id="load_paginacao_rp">
                                            <script>
                                            buscar_paginacao_receber_pagamento();
                                            </script>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- /.portlet -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-wrapper -->
        <!-- end MAIN PAGE CONTENT -->
  
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
    <!-- *********************** EDITAR PAGAMENTO ******************************  -->
    <div class="modal modal-flex fade" id="editar_fornecedor2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="flexModalLabel">Editar Conta a Receber </h4>
                </div>



                <?php echo form_open('admin/alterar_receita/', array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                <input type="hidden" name="conta_pagar_receber_id"  id="conta_pagar_receber_id"  >
                <input type="hidden" id="fornecedor_codigo3" name="fornecedor_codigo3" >
                <input type="hidden" id="categoria_codigo3" name="categoria_codigo3" >

                <div  style="width: 450px; margin: auto;" class="modal-body">

                    <table>
                        <tr>
                            <td>
                                <font size="4px;">   Fornecedor </font>
                            </td>
                        </tr>
                        <tr>
                            <td >
                                <div id="fornecedor_editar" style="display: block">
                                    <input type="text" name="fornecedor3" readonly="true" id="fornecedor3" class="input" style="height: 30px; width: 390px;">
                                    <a href="javascript:;" class="fa fa-edit"  title="Editar Fornecedor" onclick="ShowHideDIV('fornecedor_novo', 1);"> </a>
                                </div>
                            </td>
                        </tr>
                    </table>

                    <table>
                        <tr>
                            <td>
                                <div id="fornecedor_novo" style="display: none">
                                    <select class="input" name="novo_fornecedor_edit" id="novo_fornecedor_edit" onchange="ShowHideDIV('fornecedor_editar', 0);" style="height: 30px; width: 390px;">
                                        <option value="0">Selecione uma opção se deseja mudar o fornecedor</option>
                                        <?php
                                        $sql_curso22 = "SELECT * FROM fornecedor where cliente = 1 order by for_tx_razao_social";
                                        $exe_curso22 = mysql_query($sql_curso22) OR DIE('linha 106 ' . mysqli_error($conexao));

                                        while ($linha_curso22 = mysql_fetch_array($exe_curso22)) {
                                            ?>
                                            <option  value="<?php echo $linha_curso22['fornecedor_id']; ?> " ><?php echo $linha_curso22['for_tx_razao_social']; ?> </option>
                                        <?php } ?>
                                    </select>
                                    <a href="javascript:;" class="fa fa-minus-square"  title="Ocultar" onclick="ShowHideDIV('fornecedor_novo', 0);
                                            ShowHideDIV('fornecedor_editar', 1);"> </a>

                                </div>
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
                                <input type="text" id="numero_orcamento3" name="numero_orcamento3" class="input" style="height: 30px; width: 410px;">
                            </td>
                        </tr>
                    </table> 
                    <table >
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
                                <input type="text"  id="data_vencimento3" name="data_vencimento3" required="true" class="input" style="height: 30px; width: 200px;" >
                            </td>
                            <td style="margin-left: 5px;">
                                <input type="text"  name="valor3"  id="valor3" required="true" class="input" style="height: 30px; width: 205px;" >
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
                                <input type="text" name="num_nf3" id="num_nf3" class="input" style="height: 30px; width: 410px;">
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
                                    <textarea class="input" name="historico3" id="historico3" style="height: 50px; width: 410px;">

                                    </textarea></div>
                            </td>
                        </tr>

                    </table>


                    <table >
                        <tr>
                            <td >
                                <font size="4px;">     Categoria</font>
                            </td>


                        </tr>
                        <tr>
                            <td>
                                <div id="categoria" style="display: block">
                                    <input type="text" readonly="true" readonly="true" name="categoria3" id="categoria3" class="input" style="height: 30px; width: 390px;"> 
                                    <a href="javascript:;" class="fa fa-edit"  title="Editar Categoria" onclick="ShowHideDIV('categoria_novo', 1);"> </a>

                                </div>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <div id="categoria_novo" style="display: none">
                                    <select class="input" name="categoria" onchange="ShowHideDIV('categoria', 0);" style="height: 30px; width: 390px;">
                                        <option value="0">Selecione uma opção se deseja mudar a categoria</option>
                                        <?php
                                        $sql_curso2 = "SELECT * FROM categoria order by cat_tx_descricao asc";
                                        $exe_curso2 = mysql_query($sql_curso2) OR DIE('linha 106 ' . mysqli_error($conexao));

                                        while ($linha_curso2 = mysql_fetch_array($exe_curso2)) {
                                            ?>
                                            <option  value="<?php echo $linha_curso2['categoria_id']; ?> " ><?php echo $linha_curso2['cat_tx_descricao']; ?> </option>
<?php } ?>
                                    </select>
                                    <a href="javascript:;" class="fa fa-minus-square"  title="Ocultar" onclick="ShowHideDIV('categoria_novo', 0);
                                            ShowHideDIV('categoria', 1);"> </a>

                                </div>
                            </td>
                        </tr>
                    </table>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-green" >Confirmar</button>
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
