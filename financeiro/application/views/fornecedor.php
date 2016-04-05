


<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="template/jquery.quick.search.js"></script>

<html xmlns="http://www.w3.org/1999/xhtml" >

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
            $.post(base_url + '/financeiro/index.php?/admin/dados_cliente_f', {
                codigo_fornecedor: id_fornecedor
            }, function (data) {
                $('#razaococial').val(data.razaococial);
                $('#fantazia').val(data.fantazia);
                $('#codigo_fornecedor').val(data.codigo_fornecedor);

                $('#telefone').val(data.telefone);
                $('#celular').val(data.celular);
                $('#email2').val(data.email2);
                $('#endereco').val(data.endereco);
                $('#numero').val(data.numero);
                $('#complemento').val(data.complemento);
                $('#bairro').val(data.bairro);
                $('#uf').val(data.uf);
                $('#cep').val(data.cep);
                $('#cidade').val(data.cidade);
                $('#pais').val(data.pais);
                $('#tipopessoa').val(data.tipopessoa);
                $('#cnpjcpf').val(data.cnpjcpf);
                $('#inscestadualrg').val(data.inscestadualrg);
                $('#inscmunicipal').val(data.inscmunicipal);
                $('#seguimento').val(data.seguimento);
                //aqui eu seto a o input hidden com o id do cliente, para que a edição funcione. Em cada tela aberta, eu seto o id do cliente. 
            }, 'json');
        }

        function janelaEditarCliente(id_fornecedor) {
            //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal
            carregaDadosClienteJSon(id_fornecedor);
            $('#editar_fornecedor').modal('show');
        }

       function carregaDadosFornecedorJSon(id_fornecedor) {
            $.post(base_url + '/financeiro/index.php?/admin/dados_cliente_f', {
                codigo_fornecedor: id_fornecedor
            }, function (data) {
                 $('#codigo_fornecedor_excluir').val(data.codigo_fornecedor);

                
                //aqui eu seto a o input hidden com o id do cliente, para que a edição funcione. Em cada tela aberta, eu seto o id do cliente. 
            }, 'json');
        }
        function janelaExcluirFornecedor(id_fornecedor) {

            //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal
             carregaDadosFornecedorJSon(id_fornecedor);


            $('#excluir_fornecedor').modal('show');
            
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
                                <h1>Cadastro de Fornecedor

                                </h1>
                                <ol class="breadcrumb">
                                    <li><i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                                    </li>
                                    <li class="active">Fornecedores</li>
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
                                        <h4> <button href="javascript:;" class="btn btn-primary" data-target="#flexModal" onclick="janelanovoFornecedor()()">Novo Fornecedor</button></h4> 
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
                                                    <th style="background-color: #2C3E50; color: #ffffff">ID</th>
                                                    <th style="background-color: #2C3E50; color: #ffffff">Razão Social</th>
                                                    <th style="background-color: #2C3E50; color: #ffffff">Nome Fantazia</th>                                                    
                                                    <th style="background-color: #2C3E50; color: #ffffff">CNPJ</th>
                                                    <th style="background-color: #2C3E50; color: #ffffff">Telefone</th>
                                                    <th style="background-color: #2C3E50; color: #ffffff">Ações</th>
                                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $count = 1;
                                                foreach ($fornecedor as $row):
                                                    ?>
                                                    <tr>
                                                        <td><a href="javascript:;"  ><?php echo $count++; ?></a></td>
                                                        <td><a href="javascript:;"  ><?php echo htmlentities($row['for_tx_razao_social']); ?></font></a></td>
                                                        <td><a href="javascript:;"  ><?php echo ucfirst($row['for_tx_fantazia']); ?></font></a></td>
                                                        <td><a href="javascript:;"  ><?php echo ucfirst($row['for_tx_cnpj']); ?></font></a></td>
                                                        <td><a href="javascript:;"  ><?php echo ucfirst($row['for_tx_fone']); ?></font></a></td>

                                                        <td width="150px;" class="center"> 
                                                            <a href="javascript:;" class="btn btn-orange" data-target="#editar_fornecedor" onclick="janelaEditarCliente(<?php echo $row['fornecedor_id']; ?>)"> Editar</a>
                                                       <a href="javascript:;" class="btn btn-danger  "  data-target="#excluir_fornecedor"  onclick="janelaExcluirFornecedor(<?php echo $row['fornecedor_id']; ?>)" >Excluir</a>
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
                        <h4 class="modal-title" id="flexModalLabel">Novo Fornecedor</h4>

                    </div>

                    <?php echo form_open('admin/fornecedor/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <form method="post" action="<?php echo base_url(); ?>index.php?admin/fornecedor/create/" class="form-horizontal validatable" enctype="multipart/form-data">


                        <div style="margin-left: 20px;" class="modal-body">


                            <!--Razão Social - Fantasia-->
                            <table width="400">            
                                <tr>
                                    <!--Razão Social-->
                                    <td>
                                        <font style="color: #696969;" size="2">  Razão Social  </font><font color="#ff0000">* </font>
                                    </td>
                                    <!--Fantasia-->
                                    <td >
                                        <div style="padding: 0 14px;">   <font style="color: #696969;" size="2">  Nome Fantasia  </font><font color="#ff0000">* </font></div>
                                    </td>
                                </tr>
                                <tr>
                                    <!--Razão Social-->
                                    <td>
                                        <input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 300px; height: 20px;" type="text" required="true" onkeyup="this.value = this.value.toUpperCase()" name="txrazaosocial" id="txrazaosocial"  maxlength="250" />
                                    </td>
                                    <!--Fantasia-->
                                    <td>
                                        <div style="padding: 0 14px;">    <input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 208px; height: 20px" required="true" type="text"  onkeyup="this.value = this.value.toUpperCase()" name="txfantazia" id="txfantazia"  maxlength="230" /></div>
                                    </td>
                                </tr>           
                            </table>
                            <!--Telefone - Celular - E-mail-->
                            <table  width="400">            
                                <tr>
                                    <!--Telefone-->
                                    <td>
                                        <font style="color: #696969;" size="2">  Telefone  </font><font color="#ff0000">* </font>
                                    </td>
                                    <!--Celular-->
                                    <td >
                                        <div style="padding: 0 14px;"> <font style="color: #696969;" size="2">  Celular  </font><font color="#ff0000"> </font></div>
                                    </td>
                                    <!--E-mail-->
                                    <td >
                                        <font style="color: #696969;" size="2">  E-mail  </font><font color="#ff0000"> </font>
                                    </td>
                                </tr>
                                <tr>
                                    <!--Telefone-->
                                    <td>
                                        <input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 100px; height: 20px"  type="text" required="true" onkeyup="this.value = this.value.toUpperCase()" name="txtelefone" id="txtelefone"  maxlength="15" />
                                    </td>
                                    <!--Celular-->
                                    <td>
                                        <div style="padding: 0 14px;"> <input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 100px; height: 20px" type="text"  onkeyup="this.value = this.value.toUpperCase()" name="txcelular" id="txcelular"  maxlength="15" /></div>
                                    </td>
                                    <!--E-mail-->
                                    <td>
                                        <input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 290px; height: 20px"  type="email"  onkeyup="this.value = this.value.toUpperCase()" name="txemail" id="txemail"  maxlength="140" />
                                    </td>

                                </tr>  
                            </table>
                            <!--Endereço - Número - Complemento-->
                            <table  width="400">            
                                <tr>
                                    <!--Endereço-->
                                    <td >
                                        <font style="color: #696969;" size="2">  Endereço  </font><font color="#ff0000"> </font>
                                    </td>
                                    <!--Número-->
                                    <td >
                                        <div style="padding: 0 14px;"> <font style="color: #696969;" size="2">  Número  </font><font color="#ff0000"> </font></div>
                                    </td>
                                    <!--Complemento-->
                                    <td >
                                        <font style="color: #696969;" size="2">  Complemento  </font><font color="#ff0000"> </font>
                                    </td>
                                </tr>
                                <tr>
                                    <!--Endereço-->
                                    <td>
                                        <input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 250px; height: 20px"  type="text"  onkeyup="this.value = this.value.toUpperCase()" name="txendereco" id="txendereco"  maxlength="240" />
                                    </td>
                                    <!--Número-->
                                    <td>
                                        <div style="padding: 0 14px;"> <input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 70px; height: 20px"  type="text"  onkeyup="this.value = this.value.toUpperCase()" name="txnumero" id="txnumero"  maxlength="10" /></div> 
                                    </td>
                                    <!--Complemento-->
                                    <td>
                                        <input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 170px; height: 20px"  type="text" onkeyup="this.value = this.value.toUpperCase()" name="txcomplemento" id="txcomplemento"  maxlength="130" />
                                    </td>
                                </tr>

                            </table>
                            <!--Bairro - UF - Cep-->
                            <table  width="400">            
                                <tr>
                                    <!--Bairro-->
                                    <td >
                                        <font style="color: #696969;" size="2">  Bairro  </font><font color="#ff0000"> </font>
                                    </td>
                                    <!--UF-->
                                    <td >
                                        <div style="padding: 0 14px;"><font style="color: #696969;" size="2">  UF  </font><font color="#ff0000"> </font></div>
                                    </td>
                                    <!--Cep-->
                                    <td >
                                        <font style="color: #696969;" size="2">  Cep  </font><font color="#ff0000"> </font>
                                    </td>
                                </tr>
                                <tr>
                                    <!--Bairro-->
                                    <td>
                                        <input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 380px; height: 20px"  type="text" onkeyup="this.value = this.value.toUpperCase()" name="txbairro" id="txbairro" size="40" maxlength="130" />
                                    </td>
                                    <!--UF-->
                                    <td>
                                        <div style="padding: 0 14px;"> <input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 30px; height: 20px"  type="text" onkeyup="this.value = this.value.toUpperCase()" name="txuf" id="txuf"  maxlength="10" /></div>
                                    </td>
                                    <!--Cep-->
                                    <td>
                                        <input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 80px; height: 20px"  type="text" onkeyup="this.value = this.value.toUpperCase()" name="txcep" id="txcep"  maxlength="10" />
                                    </td>
                                </tr>           
                            </table>
                            <!--Cidade - País-->
                            <table>
                                <tr>
                                    <!--Cidade-->
                                    <td >
                                        <font style="color: #696969;" size="2">  Cidade  </font><font color="#ff0000"> </font>
                                    </td>
                                    <!--País-->
                                    <td >
                                        <div style="padding: 0 14px;"><font style="color: #696969;" size="2">  País  </font><font color="#ff0000"> </font></div>
                                    </td>
                                </tr>
                                <tr>
                                    <!--Cidade-->
                                    <td>
                                        <input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 300px; height: 20px"  type="text" onkeyup="this.value = this.value.toUpperCase()" name="txcidade" id="txcidade"  maxlength="30" />
                                    </td>
                                    <!--País-->                    
                                    <td>
                                        <div style="padding: 0 14px;"><input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 208px; height: 20px"  type="text" onkeyup="this.value = this.value.toUpperCase()" name="txpais" id="txpais"  maxlength="30" /></div>
                                    </td>
                                </tr>
                            </table>
                            <!--Tipo Pessoa (dropdown) - CNPJ/CPF - Insc. Estadual-->
                            <table width="400">            
                                <tr>
                                    <!--Tipo Pessoa Dropdown-->
                                    <td >
                                        <font style="color: #696969;" size="2">  Tipo Pessoa  </font><font color="#ff0000">* </font>

                                    </td>
                                    <!--CNPJ/CPF-->
                                    <td >
                                        <div style="padding: 0 14px;"><font style="color: #696969;" size="2">  CNPJ/CPF  </font><font color="#ff0000"> </font></div>
                                    </td>
                                    <!--Insc. Estadual/RG-->
                                    <td >
                                        <font style="color: #696969;" size="2">  Insc. Estadual/RG  </font><font color="#ff0000"> </font>
                                    </td>
                                </tr>
                                <tr> 
                                    <!--Tipo Pessoa - Dropdown-->
                                    <td>           
                                        <select name="txtipopessoa"  id="txtipopessoa"  style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 163px; height: 20px; border: 1px solid #696969; color: #696969;">                      
                                            <option value="Fisica">Física</option>
                                            <option value="Juridica">Jurídica</option>
                                        </select>
                                    </td>
                                    <!--CNPJ/CPF-->
                                    <td>
                                        <div style="padding: 0 14px;"><input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 163px; height: 20px"  type="text" onkeyup="this.value = this.value.toUpperCase()" name="txcnpjcpf" id="txcnpjcpf"  maxlength="20" /></div>
                                    </td>
                                    <!--Insc. Estadual-->
                                    <td>
                                        <input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 166px; height: 20px"  type="text" onkeyup="this.value = this.value.toUpperCase()" name="txinscestadualrg" id="txinscestadualrg"  maxlength="20" />
                                    </td>
                                </tr>           
                            </table>

                            <!--Insc. Municipal - Seguimento-->
                            <table  width="400">            
                                <tr>
                                    <!--Insc. Municipal-->
                                    <td >
                                        <font style="color: #696969;" size="2">  Insc. Municipal  </font><font color="#ff0000"> </font>
                                    </td>
                                    <!--Seguimento-->
                                    <td >
                                        <div style="padding: 0 14px;"><font style="color: #696969;" size="2">  Seguimento  </font><font color="#ff0000"> </font></div>
                                    </td>
                                </tr>
                                <tr>
                                    <!--Insc. Municipal-->
                                    <td>
                                        <input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 121px; height: 20px"  type="text" onkeyup="this.value = this.value.toUpperCase()" name="txinscmunicipal" id="txinscmunicipal"  maxlength="20" />
                                    </td>
                                    <!--Seguimento-->
                                    <td>
                                        <div style="padding: 0 14px;"><input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 386px; height: 20px"  type="text" onkeyup="this.value = this.value.toUpperCase()" name="txseguimento" id="txseguimento"  maxlength="50" /></div>
                                    </td>
                                </tr>           
                            </table>
                            <!--<br />--> 




                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-green" >Criar Fornecedor</button>
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
                        <h4 class="modal-title" id="flexModalLabel">Editar Fornecedor </h4>
                    </div>



                    <?php echo form_open('admin/alterar_fornecedor/', array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>


                    <div style="margin-left: 20px;" class="modal-body">
                        <table>
                            <tr>
                                <td>

                                    <input name="codigo_fornecedor"  id='codigo_fornecedor' type="hidden" >
                                </td>                                                                                           
                            </tr>


                        </table>
                        <!--Razão Social - Fantasia-->
                        <table width="400">            
                            <tr>
                                <!--Razão Social-->
                                <td>
                                    <font style="color: #696969;" size="2">  Razão Social  </font><font color="#ff0000">* </font>
                                </td>
                                <!--Fantasia-->
                                <td >
                                    <div style="padding: 0 14px;">   <font style="color: #696969;" size="2">  Nome Fantasia  </font><font color="#ff0000">* </font></div>
                                </td>
                            </tr>
                            <tr>
                                <!--Razão Social-->
                                <td>

                                    <input  style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 300px; height: 20px;" 
                                            type="text" required="true"  onkeyup="this.value = this.value.toUpperCase()"
                                            id="razaococial" name="razaococial"
                                            size="40" maxlength="50" />
                                </td>
                                <!--Fantasia-->
                                <td>
                                    <div style="padding: 0 14px;">

                                        <input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 208px; height: 20px" 
                                               required="true" type="text"  onkeyup="this.value = this.value.toUpperCase()" 
                                               id="fantazia" name="fantazia" size="40" maxlength="30" /></div>
                                </td>
                            </tr>           
                        </table>
                        <!--Telefone - Celular - E-mail-->
                        <table  width="400">            
                            <tr>
                                <!--Telefone-->
                                <td>
                                    <font style="color: #696969;" size="2">  Telefone  </font><font color="#ff0000">* </font>
                                </td>
                                <!--Celular-->
                                <td >
                                    <div style="padding: 0 14px;"> <font style="color: #696969;" size="2">  Celular  </font><font color="#ff0000"> </font></div>
                                </td>
                                <!--E-mail-->
                                <td >
                                    <font style="color: #696969;" size="2">  E-mail  </font><font color="#ff0000"> </font>
                                </td>
                            </tr>
                            <tr>
                                <!--Telefone-->
                                <td>
                                    <input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 100px; height: 20px" 
                                           type="text" required="true" onkeyup="this.value = this.value.toUpperCase()"
                                           id="telefone" name="telefone"  size="40" maxlength="15" />
                                </td>
                                <!--Celular-->
                                <td>
                                    <div style="padding: 0 14px;"> <input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 100px; height: 20px"
                                                                          type="text"  onkeyup="this.value = this.value.toUpperCase()"
                                                                          name="celular" id="celular" size="40" maxlength="15" /></div>
                                </td>
                                <!--E-mail-->
                                <td>
                                    <input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 290px; height: 20px" 
                                           type="email"  onkeyup="this.value = this.value.toUpperCase()" name="email2" id="email2"  maxlength="140" />
                                </td>

                            </tr>  
                        </table>
                        <!--Endereço - Número - Complemento-->
                        <table  width="400">            
                            <tr>
                                <!--Endereço-->
                                <td >
                                    <font style="color: #696969;" size="2">  Endereço  </font><font color="#ff0000"> </font>
                                </td>
                                <!--Número-->
                                <td >
                                    <div style="padding: 0 14px;"> <font style="color: #696969;" size="2">  Número  </font><font color="#ff0000"> </font></div>
                                </td>
                                <!--Complemento-->
                                <td >
                                    <font style="color: #696969;" size="2">  Complemento  </font><font color="#ff0000"> </font>
                                </td>
                            </tr>
                            <tr>
                                <!--Endereço-->
                                <td>
                                    <input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 250px; height: 20px"  
                                           type="text"  onkeyup="this.value = this.value.toUpperCase()" name="endereco" id="endereco" size="40" maxlength="40" />
                                </td>
                                <!--Número-->
                                <td>
                                    <div style="padding: 0 14px;"> <input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 70px; height: 20px"  
                                                                          type="text"  onkeyup="this.value = this.value.toUpperCase()" name="numero" id="numero" size="40" maxlength="10" /></div> 
                                </td>
                                <!--Complemento-->
                                <td>
                                    <input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 170px; height: 20px"  
                                           type="text" onkeyup="this.value = this.value.toUpperCase()" name="complemento" id="complemento" size="40" maxlength="30" />
                                </td>
                            </tr>

                        </table>
                        <!--Bairro - UF - Cep-->
                        <table  width="400">            
                            <tr>
                                <!--Bairro-->
                                <td >
                                    <font style="color: #696969;" size="2">  Bairro  </font><font color="#ff0000"> </font>
                                </td>
                                <!--UF-->
                                <td >
                                    <div style="padding: 0 14px;"><font style="color: #696969;" size="2">  UF  </font><font color="#ff0000"> </font></div>
                                </td>
                                <!--Cep-->
                                <td >
                                    <font style="color: #696969;" size="2">  Cep  </font><font color="#ff0000"> </font>
                                </td>
                            </tr>
                            <tr>
                                <!--Bairro-->
                                <td>
                                    <input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 380px; height: 20px"
                                           type="text" onkeyup="this.value = this.value.toUpperCase()" name="bairro" id="bairro" size="40" maxlength="30" />
                                </td>
                                <!--UF-->
                                <td>
                                    <div style="padding: 0 14px;"> <input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 30px; height: 20px" 
                                                                          type="text" onkeyup="this.value = this.value.toUpperCase()" name="uf" id="uf" size="40" maxlength="10" /></div>
                                </td>
                                <!--Cep-->
                                <td>
                                    <input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 80px; height: 20px" 
                                           type="text" onkeyup="this.value = this.value.toUpperCase()" name="cep" id="cep" size="40" maxlength="10" />
                                </td>
                            </tr>           
                        </table>
                        <!--Cidade - País-->
                        <table>
                            <tr>
                                <!--Cidade-->
                                <td >
                                    <font style="color: #696969;" size="2">  Cidade  </font><font color="#ff0000"> </font>
                                </td>
                                <!--País-->
                                <td >
                                    <div style="padding: 0 14px;"><font style="color: #696969;" size="2">  País  </font><font color="#ff0000"> </font></div>
                                </td>
                            </tr>
                            <tr>
                                <!--Cidade-->
                                <td>
                                    <input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 300px; height: 20px" 
                                           type="text" onkeyup="this.value = this.value.toUpperCase()" name="cidade" id="cidade"  maxlength="30" />
                                </td>
                                <!--País-->                    
                                <td>
                                    <div style="padding: 0 14px;"><input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 208px; height: 20px"  
                                                                         type="text" onkeyup="this.value = this.value.toUpperCase()" name="pais" id="pais" size="40" maxlength="30" /></div>
                                </td>
                            </tr>
                        </table>
                        <!--Tipo Pessoa (dropdown) - CNPJ/CPF - Insc. Estadual-->
                        <table width="400">            
                            <tr>
                                <!--Tipo Pessoa Dropdown-->
                                <td >
                                    <font style="color: #696969;" size="2">  Tipo Pessoa  </font><font color="#ff0000">* </font>

                                </td>
                                <!--CNPJ/CPF-->
                                <td >
                                    <div style="padding: 0 14px;"><font style="color: #696969;" size="2">  CNPJ/CPF  </font><font color="#ff0000"> </font></div>
                                </td>
                                <!--Insc. Estadual/RG-->
                                <td >
                                    <font style="color: #696969;" size="2">  Insc. Estadual/RG  </font><font color="#ff0000"> </font>
                                </td>
                            </tr>
                            <tr> 
                                <!--Tipo Pessoa - Dropdown-->
                                <td>           
                                    <div style="padding: 0 0px;"><input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 163px; height: 20px" 
                                                                        type="text" onkeyup="this.value = this.value.toUpperCase()" name="tipopessoa" id="tipopessoa" size="40" maxlength="15" /></div>

                                </td>
                                <!--CNPJ/CPF-->
                                <td>
                                    <div style="padding: 0 14px;"><input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 163px; height: 20px" 
                                                                         type="text" onkeyup="this.value = this.value.toUpperCase()" name="cnpjcpf" id="cnpjcpf" size="40" maxlength="15" /></div>
                                </td>
                                <!--Insc. Estadual-->
                                <td>
                                    <input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 166px; height: 20px" 
                                           type="text" onkeyup="this.value = this.value.toUpperCase()" name="inscestadualrg" id="inscestadualrg" size="40" maxlength="15" />
                                </td>
                            </tr>           
                        </table>

                        <!--Insc. Municipal - Seguimento-->
                        <table  width="400">            
                            <tr>
                                <!--Insc. Municipal-->
                                <td >
                                    <font style="color: #696969;" size="2">  Insc. Municipal  </font><font color="#ff0000"> </font>
                                </td>
                                <!--Seguimento-->
                                <td >
                                    <div style="padding: 0 14px;"><font style="color: #696969;" size="2">  Seguimento  </font><font color="#ff0000"> </font></div>
                                </td>
                            </tr>
                            <tr>
                                <!--Insc. Municipal-->
                                <td>
                                    <input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 121px; height: 20px"  
                                           type="text" onkeyup="this.value = this.value.toUpperCase()" name="inscmunicipal" id="inscmunicipal" size="40" maxlength="15" />
                                </td>
                                <!--Seguimento-->
                                <td>
                                    <div style="padding: 0 14px;"><input style=" border: 1px solid #696969; border-radius: 3px 3px 3px 3px; width: 386px; height: 20px"  
                                                                         type="text" onkeyup="this.value = this.value.toUpperCase()" name="seguimento" id="seguimento" size="40" maxlength="50" /></div>
                                </td>
                            </tr>           
                        </table>
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
                        <h4 class="modal-title" id="flexModalLabel">Excluir Fornecedor </h4>
                    </div>



                    <?php echo form_open('admin/excluir_fornecedor/', array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>


                    <div class="modal-body">
                        <table>
                            <tr>
                                <td>

                                    <input name="codigo_fornecedor_excluir"  id='codigo_fornecedor_excluir' type="hidden" >
                                </td>                                                                                           
                            </tr>


                        </table>
                        <!--Razão Social - Fantasia-->
                        <table width="400">            
                            <tr>
                                <!--Razão Social-->
                                <td>
                                    <h3>
                                        <i class="fa fa-eraser text-red"></i> Deseja excluir este fornecedor?
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
        <!-- Logout Notification Box -->

        <!-- /#logout -->

        <!-- Logout Notification Box -->
       

        


    </body>

</html>
