


<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="template/jquery.quick.search.js"></script>

<html lang="en">

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

    <script>


        //Aqui eu seto uma variável javascript com o base_url do CodeIgniter, para usar nas funções do post.
        var base_url = "<?php base_url() ?>";

        /*
         *	Esta função serve para preencher os campos do cliente na janela flutuante
         * usando jSon.  
         */
        function carregaDadosGrupoJSon(id_fornecedor) {
            $.post(base_url + '/financeiro_nasser/index.php?/admin/dados_gp', {
                grupo_produto_id: id_fornecedor
            }, function (data) {
                $('#grupo_produto_id').val(data.grupo_produto_id);
                $('#descricao').val(data.descricao);
                //aqui eu seto a o input hidden com o id do cliente, para que a edição funcione. Em cada tela aberta, eu seto o id do cliente. 
            }, 'json');
        }

         function carregaDadosGrupoExcluiJSon(id_fornecedor) {
            $.post(base_url + '/financeiro_nasser/index.php?/admin/dados_gp', {
                grupo_produto_id: id_fornecedor
            }, function (data) {
                $('#grupo_produto_exclui_id').val(data.grupo_produto_id);
                 //aqui eu seto a o input hidden com o id do cliente, para que a edição funcione. Em cada tela aberta, eu seto o id do cliente. 
            }, 'json');
        }
        
        
        function janelaExcluirGrupo(id_fornecedor) {

            //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal
            carregaDadosGrupoExcluiJSon(id_fornecedor);

            $('#excluir_fornecedor').modal('show');



        }

        function janelaEditarGrupo(id_fornecedor) {

            //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal
            carregaDadosGrupoJSon(id_fornecedor);


            $('#editar_fornecedor').modal('show');


        }

        function carregaDadosFornecedorJSon(id_fornecedor) {
            $.post(base_url + '/financeiro_web/index.php?/admin/dados_cliente', {
                codigo_fornecedor: id_fornecedor
            }, function (data) {
                $('#codigo_fornecedor_excluir').val(data.codigo_fornecedor);


                //aqui eu seto a o input hidden com o id do cliente, para que a edição funcione. Em cada tela aberta, eu seto o id do cliente. 
            }, 'json');
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

        <div id="wrapper">

            <!-- begin TOP NAVIGATION -->
            <?php include 'application/views/top.php'; ?>
            <!-- /.navbar-top -->
            <!-- end TOP NAVIGATION -->

            <!-- begin SIDE NAVIGATION -->
            <?php include 'application/views/menu_lateral.php'; ?>
            <!-- /.navbar-side -->
            <!-- end SIDE NAVIGATION -->

            <div id="page-wrapper">

                <div class="page-content">

                    <!-- begin PAGE TITLE AREA -->
                    <!-- Use this section for each page's title and breadcrumb layout. In this example a date range picker is included within the breadcrumb. -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-title">
                                <h1>Grupo de Produtos

                                </h1>
                                <ol class="breadcrumb">
                                    <li><i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                                    </li>
                                    <li class="active">Grupo de Produtos</li>
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
                                        <h4> <button href="javascript:;" class="btn btn-primary" data-target="#flexModal" onclick="janelanovoFornecedor()()">Novo Grupo</button></h4> 
                                    </div>
                                    <div class="clearfix"></div>
                                </div>



                                <input type="text" class="input-search" alt="lista-clientes" placeholder="Procurar Fornecedor" />

                                <br style="clear:both">

                                <div class="portlet-body">
                                    <div class="table-responsive">

                                        <table id="example-table" class="table lista-clientes table-striped table-bordered table-hover table-green " >
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Grupo</th>                                                                                                    

                                                    <th>Ações</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $count = 1;
                                                foreach ($grupo_produto as $row):
                                                    ?>
                                                    <tr>
                                                        <td><a href="javascript:;"  data-target="#editar_fornecedor" ><?php echo $count++; ?></a></td>
                                                        <td><a href="javascript:;"  data-target="#editar_fornecedor" ><?php echo ucfirst($row['gp_tx_descricao']); ?></font></a></td>                                               
                                                        <td width="150px;" class="center"> 
                                                            <a href="javascript:;" class="btn btn-orange" data-target="#editar_fornecedor" onclick="janelaEditarGrupo(<?php echo $row['grupo_produto_id']; ?>)"> Editar</a>
                                                            <a href="javascript:;" class="btn btn-danger  "  data-target="#excluir_fornecedor"  onclick="janelaExcluirGrupo(<?php echo $row['grupo_produto_id']; ?>)" >Excluir</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
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
        <div class="modal modal-flex fade" id="flexModal" tabindex="-1" role="dialog" aria-labelledby="flexModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="flexModalLabel">Novo Grupo</h4>

                    </div>

                    <?php echo form_open('admin/grupo_produto/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <form method="post" action="<?php echo base_url(); ?>index.php?admin/grupo_produto/create/" class="form-horizontal validatable" enctype="multipart/form-data">


                        <div style="margin-left: 20px;" class="modal-body">


                            <!--Razão Social - Fantasia-->
                            <table width="400">            
                                <tr>
                                    <!--Razão Social-->
                                    <td>
                                        <font style="color: #696969;" size="2">  Descrição  </font><font color="#ff0000">* </font>
                                    </td>

                                </tr>
                                <tr>
                                    <!--Razão Social-->
                                    <td>
                                        <input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 515px; height: 20px;" type="text" required="true" onkeyup="this.value = this.value.toUpperCase()" name="gp_tx_descricao" id="gp_tx_descricao"  maxlength="250" />
                                    </td>

                                </tr>           
                            </table>
                            <!--Telefone - Celular - E-mail-->

                            <!--<br />--> 




                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-green" >Criar Grupo</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <!-- /.row -->
        <!-- ************************************* MODAL EDITAR ***************************************** -->

        <div class="modal modal-flex fade" id="editar_fornecedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="flexModalLabel">Editar Grupo</h4>
                    </div>



                    <?php echo form_open('admin/alterar_gp/', array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>


                    <div style="margin-left: 20px;" class="modal-body">
                        <table>
                            <tr>
                                <td>

                                    <input name="grupo_produto_id"  id='grupo_produto_id' type="hidden" >
                                </td>                                                                                           
                            </tr>


                        </table>
                        <!--Razão Social - Fantasia-->
                        <table width="400">            
                            <tr>
                                <!--Razão Social-->
                                <td>
                                    <font style="color: #696969;" size="2">  Descrição  </font><font color="#ff0000">* </font>
                                </td>
                                <!--Fantasia-->

                            </tr>
                            <tr>
                                <!--Razão Social-->
                                <td>

                                    <input  style=" height: 30px;" 
                                            type="text" required="true"  onkeyup="this.value = this.value.toUpperCase()"
                                            id="descricao" name="descricao"
                                            size="40" maxlength="50" />
                                </td>

                            </tr>           
                        </table>
                        <!--Telefone - Celular - E-mail-->

                        <!--<br />--> 




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-green" >Salvar Alterações</button>
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
                        <h4 class="modal-title" id="flexModalLabel">Excluir Grupo </h4>
                    </div>



                    <?php echo form_open('admin/grupo_produto/delete/', array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>


                    <div class="modal-body">
                        <table>
                            <tr>
                                <td>

                                    <input name="grupo_produto_exclui_id"  id='grupo_produto_exclui_id' type="hidden" >
                                </td>                                                                                           
                            </tr>


                        </table>
                        <!--Razão Social - Fantasia-->
                        <table width="400">            
                            <tr>
                                <!--Razão Social-->
                                <td>
                                    <h3>
                                        <i class="fa fa-eraser text-red"></i> Deseja excluir este Grupo?
                                    </h3>
                                </td>
                                <!--Fantasia-->

                            </tr>

                        </table>





                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default"  data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger " > Confirmar</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>
        <!-- Logout Notification Box -->

        <!-- /#logout -->

        <!-- Logout Notification Box -->


        <div id="logout">
            <div class="logout-message">
                <img class="img-circle img-logout" src="img/profile-pic.jpg" alt="">
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


    </body>

</html>
