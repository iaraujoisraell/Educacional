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
<script type="text/javascript">
/* Máscaras ER */
function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}
function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}
function mcep(v){
    v=v.replace(/\D/g,"")                    //Remove tudo o que não é dígito
    v=v.replace(/^(\d{5})(\d)/,"$1-$2")         //Esse é tão fácil que não merece explicações
    return v
}
function mdata(v){
    v=v.replace(/\D/g,"");                    //Remove tudo o que não é dígito
    v=v.replace(/(\d{2})(\d)/,"$1/$2");       
    v=v.replace(/(\d{2})(\d)/,"$1/$2");       
                                             
    v=v.replace(/(\d{2})(\d{2})$/,"$1$2");
    return v;
}
function mrg(v){
	v=v.replace(/\D/g,'');
	v=v.replace(/^(\d{2})(\d)/g,"$1.$2");
	v=v.replace(/(\d{3})(\d)/g,"$1.$2");
	v=v.replace(/(\d{3})(\d)/g,"$1-$2");
	return v;
}
function mvalor(v){
    v=v.replace(/\D/g,"");//Remove tudo o que não é dígito
    v=v.replace(/(\d)(\d{8})$/,"$1.$2");//coloca o ponto dos milhões
    v=v.replace(/(\d)(\d{5})$/,"$1.$2");//coloca o ponto dos milhares
        
    v=v.replace(/(\d)(\d{2})$/,"$1,$2");//coloca a virgula antes dos 2 últimos dígitos
    return v;
}
function id( el ){
	return document.getElementById( el );
}
function next( el, next )
{
	if( el.value.length >= el.maxLength ) 
		id( next ).focus(); 
}
</script>
    <script>


        //Aqui eu seto uma variável javascript com o base_url do CodeIgniter, para usar nas funções do post.
        var base_url = "<?php base_url() ?>";

        function carregaDadosClienteJSon(id_fornecedor) {
            $.post(base_url + '/financeiro/index.php?/admin/dados_cliente2', {
                id: id_fornecedor
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


        function carregaDadosClienteJSon2(id_fornecedor) {
            $.post(base_url + '/financeiro/index.php?/admin/dados_cliente2', {
                id: id_fornecedor
            }, function (data) {
                 $('#conta_pagar_receber_id').val(data.codigo_cpr);
                $('#fornecedor3').val(data.fornecedor);
                $('#fornecedor_codigo3').val(data.codigo_fornecedor);
                $('#numero_orcamento3').val(data.num_orcamento);
                $('#data_vencimento3').val(data.data_vencimento);
                $('#valor3').val(data.valor);
                $('#num_nf3').val(data.nf);
                $('#historico3').val(data.historico);
                $('#categoria3').val(data.categoria_descricao);
                $('#categoria_codigo3').val(data.categoria);
           
             //aqui eu seto a o input hidden com o id do cliente, para que a edição funcione. Em cada tela aberta, eu seto o id do cliente. 
            }, 'json');
            
            
                     
        }
        
        

        function janelaEditarCliente2(id_fornecedor) {

            //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal
            carregaDadosClienteJSon2(id_fornecedor);


            $('#editar_fornecedor2').modal('show');


        }



        function carregaDadosDespesaJSon(id_despesa) {
            $.post(base_url + '/financeiro/index.php?/admin/dados_cliente2', {
                id: id_despesa
            }, function (data) {
                $('#codigo_despesa').val(data.codigo_cpr);


                //aqui eu seto a o input hidden com o id do cliente, para que a edição funcione. Em cada tela aberta, eu seto o id do cliente. 
            }, 'json');
        }

        function janelaExcluirDespesa(id_despesa) {
            // alert(id_fornecedor);
            //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal
            carregaDadosDespesaJSon(id_despesa);


            $('#excluir_fornecedor').modal('show');

            $('#alerta_mensagem').alert('show');

        }

        function carregaDadosCancelarJSon(id_fornecedor) {
            $.post(base_url + '/financeiro/index.php?/admin/dados_cliente2', {
                id: id_fornecedor
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
        
        
           
      function buscar_fluxo_caixa() {
            var data_de = $('#data_de').val();  //codigo do estado escolhido
            var data_ate = $('#data_ate').val();
          

           
            window.open('index.php?admin/relatorio_fluxo_caixa/'+ data_de + '/' + data_ate, '_blank');
            //  }else{
            //      alert('Selecione um curso e turma');
            //  }
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
                                <h1>Fluxo de Caixa

                                </h1>
                                <ol class="breadcrumb">
                                    <li><i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                                    </li>
                                    <li class="active">Fluxo de Caixa</li>
                                </ol>
                            </div>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                     <?php
         date_default_timezone_set('America/Manaus');    
        $data_hoje = date('Y-m-d');
        $data_pagamento_hoje = date("d/m/Y", strtotime($data_hoje)); 
        ?>
                    <!-- end PAGE TITLE AREA -->
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="portlet portlet-default">
                                <div class="portlet-heading">
                                    <div class="portlet-title">
                                        <h4> </h4> 
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <br style="clear:both">
                                <div class="portlet-body">
                                    <div class="table-responsive">  
                                        <table class="table  table-striped  " width="100%"  cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                

                                                <td width="35%">
                                                    <div class="control-group">
                                                        <label class="control-label"><?php echo get_phrase('Exibir de'); ?></label>
                                                        <div class="controls">
                                                                          <input type="text" onkeypress="mascara(this, mdata);" value="<?php echo $data_pagamento_hoje; ?>" name="data_de" id="data_de" class="input-search" alt="lista-clientes" placeholder="Informe a data" />

                                                        </div>
                                                    </div>
                                                </td>

                                                <td width="35%">
                                                    <div class="control-group">
                                                        <label class="control-label"><?php echo get_phrase('Exibir Até'); ?></label>
                                                        <div class="controls">
                                                                   <input type="text" name="data_ate" onkeypress="mascara(this, mdata);" value="<?php echo $data_pagamento_hoje; ?>" id="data_ate" class="input-search" alt="lista-clientes" placeholder="Informe a data" />

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>

                                            </tr>
                                        </table>
                                        <br>
                                    
                                                 
                                       
                                        <table class="table  table-striped  " width="100%"  cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td>
                                                  
                                                    <input type="button" value="PESQUISAR" class="btn btn-blue btn-small" onclick="buscar_fluxo_caixa()">
                                                </td>
                                                <?php /*
                                                  <td>
                                                  <a  href="index.php?educacional/teste_impressao" 	class="btn btn-gray btn-small">
                                                  <i class="icon-dashboard"></i> <?php echo get_phrase('Impressão'); ?>
                                                  </a>
                                                  INSERT INTO `pagamentos` (`pagamentos_id`, `data_pagamento`, `valor_pagamento`, `pag_tx_cliente`, `forma_pagamento`, `mensalidades_id`, `usu_nb_id`, `referencia`, `desconto`, `juros`, `status_pagamento`, `obs`) VALUES
                                                  </td>
                                                 * 
                                                 */
                                                ?>                        
                                            </tr>
                                        </table>
                                        <br>

                                        <div id="load_paginacao_fc">
                                            <script>
                                              //  buscar_fluxo_caixa();
                                            </script>
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
