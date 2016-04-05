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
    <?php

    function exibirData($data) {
        $rData = explode("-", $data);
        $rData = $rData[2] . '/' . $rData[1] . '/' . $rData[0];
        return $rData;
    }
    ?>
    <script>


        //Aqui eu seto uma variável javascript com o base_url do CodeIgniter, para usar nas funções do post.
        var base_url = "<?php base_url() ?>";

        function carregaDadosClienteJSon(id_fornecedor) {
            $.post(base_url + '/nasser/index.php?/admin/dados_cliente2', {
                codigo_fornecedor: id_fornecedor
            }, function (data) {
                $('#fornecedor_pg').val(data.fornecedor);
                $('#data_vencimento').val(data.data_vencimento);
                $('#data_pagamento').val(data.data_pagamento);
                $('#codigo_cpr').val(data.codigo_cpr);
                $('#valor').val(data.valor);
                $('#valor_sem_imposto').val(data.valor_sem_imposto);


                //aqui eu seto a o input hidden com o id do cliente, para que a edição funcione. Em cada tela aberta, eu seto o id do cliente. 
            }, 'json');
        }

        function janelaEditarCliente(id_fornecedor) {

            //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal
            carregaDadosClienteJSon(id_fornecedor);


            $('#editar_fornecedor').modal('show');


        }




        // EDITAR PAGAMENTO ****************************************************


        function carregaDadosProdutoJSon2(id_produto) {
            $.post(base_url + '/nasser/index.php?/admin/dados_produto', {
                produto_id: id_produto
            }, function (data) {
                $('#produto_id').val(data.produto_id);
                $('#referencia').val(data.referencia);
                $('#descricao').val(data.descricao);
                $('#detalhes').val(data.detalhes);
                $('#marca').val(data.marca);
                $('#um1').val(data.um1);
                $('#um2').val(data.um2);
                $('#fornecedor').val(data.fornecedor);
                $('#grupo').val(data.grupo);
                //aqui eu seto a o input hidden com o id do cliente, para que a edição funcione. Em cada tela aberta, eu seto o id do cliente. 
            }, 'json');
        }

        function janelaEditarProduto(id_fornecedor) {

            //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal
            carregaDadosProdutoJSon2(id_fornecedor);


            $('#editar_produto').modal('show');


        }



        function carregaDadosFornecedorJSon(id_produto) {
           $.post(base_url + '/nasser/index.php?/admin/dados_produto', {
                produto_id: id_produto
            }, function (data) {
                $('#produto_exclui_id').val(data.produto_id);


                //aqui eu seto a o input hidden com o id do cliente, para que a edição funcione. Em cada tela aberta, eu seto o id do cliente. 
            }, 'json');
        }

        function janelaExcluirFornecedor(id_fornecedor) {

            //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal
            carregaDadosFornecedorJSon(id_fornecedor);


            $('#excluir_produto').modal('show');

            $('#alerta_mensagem').alert('show');

        }

        function carregaDadosCancelarJSon(id_fornecedor) {
            $.post(base_url + '/nasser/index.php?/admin/dados_cliente2', {
                codigo_fornecedor: id_fornecedor
            }, function (data) {
                $('#codigo_fornecedor_excluir2').val(data.codigo_cpr);


                //aqui eu seto a o input hidden com o id do cliente, para que a edição funcione. Em cada tela aberta, eu seto o id do cliente. 
            }, 'json');
        }

        function janelaCancelarPagamento(id_fornecedor) {

            //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal
            carregaDadosCancelarJSon(id_fornecedor);


            $('#cancelar_pagamento').modal('show');

            $('#alerta_mensagem').alert('show');

        }


        function janelanovoFornecedor() {

            //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal


            $('#flexModal').modal('show');


        }


        $(function () {
            $(".input-search").keyup(function () {
                //pega o css da tabela 
                var tabela = $(this).attr('alt');
                if ($(this).val() != "") {
                    $("." + tabela + " tbody>tr").hide();
                    $("." + tabela + " td:contains-ci('" + $(this).val() + "')").parent("tr").show();
                } else {
                    $("." + tabela + " tbody>tr").show();
                }
            });
        });
        $.extend($.expr[":"], {
            "contains-ci": function (elem, i, match, array) {
                return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
            }
        });
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
                                <h1>Controle de Produtos

                                </h1>
                                <ol class="breadcrumb">
                                    <li><i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                                    </li>
                                    <li class="active">Produtos</li>
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
                                    <div class="portlet-title">
                                        <h4> <button href="javascript:;" class="btn btn-primary" data-target="#flexModal" onclick="janelanovoFornecedor()()">Novo Produto</button></h4> 
                                    </div>
                                    <div class="clearfix"></div>
                                </div>



                                <input type="text" class="input-search" alt="lista-clientes" placeholder="Procurar Produto" />


                                <br style="clear:both">

                                <div class="portlet-body">
                                    <div class="table-responsive">

                                        <table id="example-table" class="table lista-clientes table-striped table-bordered table-hover table-green " >
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Descrição</th>
                                                    <th>Marca </th>
                                                    <th>Grupo</th>                                                    
                                                    <th>Fornecedor</th>

                                                    <th>Ações</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $count = 1;
                                                $soma_valor = 0;
                                                $soma_sem_imposto = 0;
                                                foreach ($produtos as $row):

                                                    $codigo_produto = $row['codigo'];
                                                    $descricao = $row['descricao'];
                                                    $referencia = $row['referencia'];
                                                    $desc_geral = $row['largura'];
                                                    $marca = $row['marca'];
                                                    $cor = $row['cor'];
                                                    $grupo = $row['gp_descricao'];
                                                    $fornecedor = $row['fornecedor'];
                                                    $cont2++;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $count++; ?></td>
                                                        <td><?php echo $referencia; ?> - <?php echo $descricao; ?>(<?php echo $desc_geral; ?>)</td>
                                                        <td><?php echo $marca; ?></td>                                                      
                                                        <td><?php echo $grupo; ?></td>
                                                        <td><?php echo $fornecedor; ?></td>
                                                        <td width="150px;" class="center"> 
                                                            <a href="javascript:;" class="fa fa-edit" data-target="#editar_produto" title="Editar" onclick="janelaEditarProduto(<?php echo $codigo_produto; ?>)"> </a>
                                                            <a href="javascript:;" class="fa fa-trash-o  "  data-target="#excluir_produto"  title="Excluir" onclick="janelaExcluirFornecedor(<?php echo $codigo_produto; ?>)" ></a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                endforeach;
                                                ?>
                                            </tbody>
                                        </table>
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

        </div>
        <!-- /#wrapper -->
        <!-- Flex Modal -->
        <!-- *********************** NOVO REGISTRO ******************************  -->

        <div class="modal modal-flex fade"  id="flexModal" tabindex="-1" role="dialog" aria-labelledby="flexModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="flexModalLabel">Novo Produto</h4>

                    </div>

                    <?php echo form_open('admin/produto/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <form method="post" action="<?php echo base_url(); ?>index.php?admin/produto/create/" class="form-horizontal validatable" enctype="multipart/form-data">


                        <div style="margin-left: 20px; height: 300px;" class="modal-body">


                            <table>
                                <tr>
                                    <td>
                                        <font size="4px;">   Cód. Referência </font>
                                    </td>
                                    <td>
                                        <font size="4px;">   Descrição </font>
                                    </td>

                                </tr>
                                <tr>
                                    <td >
                                        <input type="text" required="true" name="referencia" class="input" style="height: 30px; width: 110px;">
                                    </td>
                                    <td >
                                        <input type="text" required="true" name="descricao" class="input" style="height: 30px; width: 300px;">
                                    </td>

                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <td>
                                        <font size="4px;">  Detalhes/Tamanho </font>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text"  name="detalhes" class="input" style="height: 30px; width: 420px;">
                                    </td>
                                </tr>
                            </table>

                            <table>
                                <tr>
                                    <td width="55%">
                                        <font size="4px;">    Marca</font>
                                    </td>
                                    <td >
                                        <font size="4px;">  Saldo Inicial </font>
                                    </td>
                                </tr>
                                <tr>
                                    <td >
                                        <input type="text" name="marca" class="input" style="height: 30px; width: 150px;">
                                    </td>
                                    <td >
                                        <input type="text" name="saldo" required="true" class="input" style="height: 30px; width: 150px;">
                                    </td>

                                </tr>
                            </table>

                            <table>
                                <tr>
                                    <td width="55%">
                                        <font size="4px;">    Un. Med. 1 (Entrada)</font>
                                    </td>

                                    <td >
                                        <font size="4px;">   Un. Med 2 (saída)</font>
                                    </td>


                                </tr>
                                <tr>
                                    <td>
                                        <select class="input" name="um1" style="height: 30px; width: 150px;">
                                            <?php
                                            $sql_curso2 = "SELECT * FROM unidade_medida order by um_tx_descricao asc";
                                            $exe_curso2 = mysql_query($sql_curso2) OR DIE('linha 106 ' . mysqli_error($conexao));

                                            while ($linha_curso2 = mysql_fetch_array($exe_curso2)) {
                                                ?>
                                                <option  value="<?php echo $linha_curso2['unidade_medida_id']; ?> " ><?php echo $linha_curso2['um_tx_descricao']; ?> </option>
                                            <?php } ?>
                                        </select>

                                    </td>

                                    <td>
                                        <select class="input" name="um2" style="height: 30px; width: 150px;">
                                            <?php
                                            $sql_curso2 = "SELECT * FROM unidade_medida order by um_tx_descricao asc";
                                            $exe_curso2 = mysql_query($sql_curso2) OR DIE('linha 106 ' . mysqli_error($conexao));

                                            while ($linha_curso2 = mysql_fetch_array($exe_curso2)) {
                                                ?>
                                                <option  value="<?php echo $linha_curso2['unidade_medida_id']; ?> " ><?php echo $linha_curso2['um_tx_descricao']; ?> </option>
                                            <?php } ?>
                                        </select>

                                    </td>

                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <td width="55%">
                                        <font size="4px;">    Fornecedor</font>
                                    </td>
                                    <td >
                                        <font size="4px;">    Grupo</font>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <select class="input" name="fornecedor" style="height: 30px; width: 150px;">
                                            <?php
                                            $sql_curso2 = "SELECT * FROM fornecedor order by for_tx_razao_social asc";
                                            $exe_curso2 = mysql_query($sql_curso2) OR DIE('linha 106 ' . mysqli_error($conexao));

                                            while ($linha_curso2 = mysql_fetch_array($exe_curso2)) {
                                                ?>
                                                <option  value="<?php echo $linha_curso2['fornecedor_id']; ?> " ><?php echo $linha_curso2['for_tx_razao_social']; ?> </option>
                                            <?php } ?>
                                        </select>

                                    </td>
                                    <td>
                                        <select class="input" name="grupo" style="height: 30px; width: 150px;">
                                            <?php
                                            $sql_curso2 = "SELECT * FROM grupo_produto order by gp_tx_descricao asc";
                                            $exe_curso2 = mysql_query($sql_curso2) OR DIE('linha 106 ' . mysqli_error($conexao));

                                            while ($linha_curso2 = mysql_fetch_array($exe_curso2)) {
                                                ?>
                                                <option  value="<?php echo $linha_curso2['grupo_produto_id']; ?> " ><?php echo $linha_curso2['gp_tx_descricao']; ?> </option>
                                            <?php } ?>
                                        </select>

                                    </td>
                                </tr>
                            </table>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-green" >Criar Produto</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <!-- /.row -->

   
        <!-- *********************** EDITAR PAGAMENTO ******************************  -->

        <div class="modal modal-flex fade" id="editar_produto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="flexModalLabel">Editar Produto </h4>
                    </div>



                    <?php echo form_open('admin/alterar_produto/', array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <input  name="produto_id"  id="produto_id" type="hidden" >


                    <div style="margin-left: 20px;" class="modal-body">
                  <table>
                                <tr>
                                    <td>
                                        <font size="4px;">   Cód. Referência </font>
                                    </td>
                                    <td>
                                        <font size="4px;">   Descrição </font>
                                    </td>

                                </tr>
                                <tr>
                                    <td >
                                        <input type="text" required="true" id="referencia" name="referencia" class="input" style="height: 30px; width: 110px;">
                                    </td>
                                    <td >
                                        <input type="text" required="true" id="descricao" name="descricao" class="input" style="height: 30px; width: 300px;">
                                    </td>

                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <td>
                                        <font size="4px;">  Detalhes/Tamanho </font>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" id="detalhes" name="detalhes" class="input" style="height: 30px; width: 420px;">
                                    </td>
                                </tr>
                            </table>

                            <table>
                                <tr>
                                    <td width="55%">
                                        <font size="4px;">    Marca</font>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td >
                                        <input type="text" id="marca" name="marca" class="input" style="height: 30px; width: 150px;">
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

        <div class="modal modal-flex fade" id="excluir_produto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="flexModalLabel">Excluir Produto </h4>
                    </div>



                    <?php echo form_open('admin/produto/delete/', array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>


                    <div class="modal-body">
                        <table>
                            <tr>
                                <td>

                                    <input name="produto_exclui_id"  id='produto_exclui_id' type="hidden" >
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



                    <?php echo form_open('admin/despesas/cancelar/', array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>


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
