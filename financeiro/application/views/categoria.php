


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
        var base_url = "<?php base_url() ?>/educacional";

        /*
         *	Esta função serve para preencher os campos do cliente na janela flutuante
         * usando jSon.  
         */
        function carregaDadosClienteJSon(id_fornecedor) {
            $.post(base_url + '/financeiro/index.php?/admin/dados_categoria', {
                codigo_fornecedor: id_fornecedor
            }, function (data) {
                $('#categoria_id').val(data.categoria_id);
                $('#descricao').val(data.descricao);

                
                //aqui eu seto a o input hidden com o id do cliente, para que a edição funcione. Em cada tela aberta, eu seto o id do cliente. 
            }, 'json');
        }

        function janelaEditarCliente(id_fornecedor) {

            //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal
            carregaDadosClienteJSon(id_fornecedor);


            $('#editar_fornecedor').modal('show');


        }

 function carregaDadosFornecedorJSon(id_fornecedor) {
             $.post(base_url + '/financeiro/index.php?/admin/dados_categoria', {
                codigo_fornecedor: id_fornecedor
            }, function (data) {
                $('#categoria_id2').val(data.categoria_id);
                $('#descricao').val(data.descricao);
                
                //aqui eu seto a o input hidden com o id do cliente, para que a edição funcione. Em cada tela aberta, eu seto o id do cliente. 
            }, 'json');
        }
        
        function janelaExcluirFornecedor(id_fornecedor) {

            //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal
             carregaDadosFornecedorJSon(id_fornecedor);


            $('#excluir_fornecedor').modal('show');
            
            

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
                                <h1>Cadastro de Categoria 

                                </h1>
                                <ol class="breadcrumb">
                                    <li><i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                                    </li>
                                    <li class="active">Categorias</li>
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
                                        <h4> <button href="javascript:;" class="btn btn-primary" data-target="#flexModal" onclick="janelanovoFornecedor()()">Nova Categoria</button></h4> 
                                    </div>
                                    <div class="clearfix"></div>
                                </div>



                                <input type="text" class="input-search" alt="lista-clientes" placeholder="Procurar Categoria" />

                                <br style="clear:both">

                                <div class="portlet-body">
                                    <div class="table-responsive">

                                        <table id="example-table" class="table lista-clientes table-striped table-bordered table-hover table-green " >
                                            <thead>
                                                <tr>
                                                    <th style="background-color: #2C3E50; color: #ffffff">ID</th>
                                                    <th style="background-color: #2C3E50; color: #ffffff">Categoria</th>                                                                                                    
                                                    
                                                    <th style="background-color: #2C3E50; color: #ffffff">Ações</th>
                                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $count = 1;
                                                foreach ($categoria as $row):
                                                    ?>
                                                    <tr>
                                                        <td><a href="javascript:;"  data-target="#editar_fornecedor" onclick="janelaEditarCliente(<?php echo $row['categoria_id']; ?>)"><?php echo $count++; ?></a></td>
                                                         <td><a href="javascript:;"  data-target="#editar_fornecedor" onclick="janelaEditarCliente(<?php echo $row['categoria_id']; ?>)"><?php echo ucfirst($row['cat_tx_descricao']); ?></font></a></td>                                               
                                                      <td width="150px;" class="center"> 
                                                            <a href="javascript:;" class="btn btn-orange" data-target="#editar_fornecedor" onclick="janelaEditarCliente(<?php echo $row['categoria_id']; ?>)"> Editar</a>
                                                       <a href="javascript:;" class="btn btn-danger  "  data-target="#excluir_fornecedor"  onclick="janelaExcluirFornecedor(<?php echo $row['categoria_id']; ?>)" >Excluir</a>
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
                        <h4 class="modal-title" id="flexModalLabel">Nova Categoria</h4>

                    </div>

                    <?php echo form_open('admin/categoria/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <form method="post" action="<?php echo base_url(); ?>index.php?admin/categoria/create/" class="form-horizontal validatable" enctype="multipart/form-data">


                        <div style="margin-left: 20px;" class="modal-body">


                            <!--Razão Social - Fantasia-->
                            <table width="400">            
                                <tr>
                                    <!--Razão Social-->
                                    <td>
                                        <font style="color: #696969;" size="2">  Categoria  </font><font color="#ff0000">* </font>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <!--Razão Social-->
                                    <td>
                                        <input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 515px; height: 20px;" type="text" required="true" onkeyup="this.value = this.value.toUpperCase()" name="txcategoria" id="txcategoria"  maxlength="250" />
                                    </td>
                                    
                                </tr>           
                            </table>
                           




                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-green" >Criar Categoria</button>
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
                        <h4 class="modal-title" id="flexModalLabel">Editar Categoria </h4>
                    </div>



                    <?php echo form_open('admin/alterar_categoria/', array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>


                    <div style="margin-left: 20px;" class="modal-body">
                        <table>
                            <tr>
                                <td>
                                    <input name="categoria_id"  id='categoria_id' type="hidden" >
                                </td>                                                                                           
                            </tr>
                        </table>
                        <!--Razão Social - Fantasia-->
                        <table width="400">            
                            <tr>
                                <!--Razão Social-->
                                <td>
                                    <font style="color: #696969;" size="2">  Categoria  </font><font color="#ff0000">* </font>
                                </td>
                                <!--Fantasia-->
                               
                            </tr>
                            <tr>
                                <!--Razão Social-->
                                <td>

                                    <input  style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 515px; height: 20px;" 
                                            type="text" required="true"  onkeyup="this.value = this.value.toUpperCase()"
                                            id="descricao" name="descricao"
                                            size="40" maxlength="50" />
                                </td>
                             
                            </tr>           
                        </table>
                       


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
                        <h4 class="modal-title" id="flexModalLabel">Excluir Cliente </h4>
                    </div>



                    <?php echo form_open('admin/excluir_categoria/', array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>


                    <div class="modal-body">
                        <table>
                            <tr>
                                <td>

                                    <input name="categoria_id2"  id='categoria_id2' type="hidden" >
                                </td>                                                                                           
                            </tr>


                        </table>
                        <!--Razão Social - Fantasia-->
                        <table width="400">            
                            <tr>
                                <!--Razão Social-->
                                <td>
                                    <h3>
                                        <i class="fa fa-eraser text-red"></i> Deseja excluir esta Categoria?
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
       

        


    </body>

</html>
