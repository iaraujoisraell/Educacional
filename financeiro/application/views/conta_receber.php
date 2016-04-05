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
                $('#load_paginacao_receitas').html(dataReturn);  //coloco na div o retorno da requisicao
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
        var base_url = "<?php base_url() ?>/educacional";

        function carregaDadosClienteJSon(id_fornecedor) {
            $.post(base_url + '/financeiro/index.php?/admin/dados_receitas', {
                id: id_fornecedor
            }, function (data) {
                $('#fornecedor_pg').val(data.fornecedor);
                $('#data_vencimento').val(data.data_vencimento);
                $('#data_pagamento').val(data.data_pagamento);
                $('#codigo_cpr').val(data.codigo_cpr);
                $('#valor').val(data.valor);
               

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
            $.post(base_url + '/financeiro/index.php?/admin/dados_receitas', {
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
            $.post(base_url + '/financeiro/index.php?/admin/dados_receitas', {
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

        function carregaDadosCancelarJSon_avulso(id_fornecedor) {
            $.post(base_url + '/financeiro/index.php?/admin/dados_receitas', {
                id: id_fornecedor
            }, function (data) {
                $('#codigo_fornecedor_excluir2_avulso').val(data.codigo_cpr);
                //aqui eu seto a o input hidden com o id do cliente, para que a edição funcione. Em cada tela aberta, eu seto o id do cliente. 
            }, 'json');
        }

        function janelaCancelarPagamento_avulso(id_fornecedor) {

            //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal
            carregaDadosCancelarJSon_avulso(id_fornecedor);


            $('#cancelar_pagamento_avulso').modal('show');

            $('#alerta_mensagem').alert('show');
            //alert(id_fornecedor);
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
                                <h1>Controle de Recebimentos Avulsos

                                </h1>
                                <ol class="breadcrumb">
                                    <li><i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                                    </li>
                                    <li class="active">Receitas</li>
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
                                        <h4> <button href="javascript:;" class="btn btn-primary" data-target="#flexModal" onclick="janelanovoFornecedor();">Nova Receita</button></h4> 
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <br style="clear:both">
                                <div class="portlet-body">
                                    <div class="table-responsive">  
                                        <table width="100%">
                                            <tr>
                                                <td width="30%">
                                                    <div class="control-group">
                                                        <label class="control-label"><?php echo get_phrase('Status'); ?></label>
                                                        <div class="controls">
                                                            <select style="width: 200px;" class="input-search" name="status" id="status" onchange="buscar_periodo_letivo()">
                                                                <option value="0">Selecione um opção</option>
                                                                <option value="1">Vencendo Hoje</option>
                                                                <option value="2">Em aberto</option>
                                                                <option value="3">Em atraso</option>
                                                                <option value="4">Pago</option>
                                                            </select>

                                                        </div>
                                                    </div>
                                                </td>

                                                <td width="35%">
                                                    <div class="control-group">
                                                        <label class="control-label"><?php echo get_phrase('Exibir de'); ?></label>
                                                        <div class="controls">
                                                            <div  id="load_periodo_letivo">
                                                                <?php
                                                                $ano_atual = date('Y');
                                                                $sql_mes_de = "SELECT month (cpr_dt_vencimento) as mes
                                                                                 from siga_financeiro.conta_pagar_receber 
                                                                            where year (cpr_dt_vencimento) <= $ano_atual and cpr_nb_tipo = 1
                                                                            group by mes
                                                                            order by mes";
                                                                $mesdeArray = $this->db->query($sql_mes_de)->result_array();
                                                                $mes_atual = date('M');
                                                                $mes_atual_valor = date('m');
                                                                ?>
                                                                <select style="width: 120px;" class="input-search" name="mes_de" id="mes_de">
                                                                    <option value="0">TODOS</option>

<?php
foreach ($mesdeArray as $rowmesde):
    $mes = $rowmesde['mes'];

    if ($mes == 1) {
        $mes_tx = 'JAN';
    } else if ($mes == 2) {
        $mes_tx = 'FEV';
    } else if ($mes == 3) {
        $mes_tx = 'MAR';
    } else if ($mes == 4) {
        $mes_tx = 'ABR';
    } else if ($mes == 5) {
        $mes_tx = 'MAI';
    } else if ($mes == 6) {
        $mes_tx = 'JUN';
    } else if ($mes == 7) {
        $mes_tx = 'JUL';
    } else if ($mes == 8) {
        $mes_tx = 'AGO';
    } else if ($mes == 9) {
        $mes_tx = 'SET';
    } else if ($mes == 10) {
        $mes_tx = 'OUT';
    } else if ($mes == 11) {
        $mes_tx = 'NOV';
    } else if ($mes == 12) {
        $mes_tx = 'DEZ';
    }
    ?>
                                                                        <option value="<?php echo $rowmesde['mes']; ?>"><?php echo $mes_tx; ?></option>
                                                                    <?php endforeach; ?>

                                                                </select>
                                                                <?php
                                                                $ano_atual = date('Y');
                                                                $sql_ano_de = "SELECT year (cpr_dt_vencimento) as ano
                                                                                     from siga_financeiro.conta_pagar_receber 
                                                                                where year (cpr_dt_vencimento) <= $ano_atual and cpr_nb_tipo = 1
                                                                                group by ano order by ano desc";
                                                                $anodeArray = $this->db->query($sql_ano_de)->result_array();
                                                                ?>
                                                                <select style="width: 120px;" class="input-search" name="ano_de" id="ano_de">
                                                                    <?php foreach ($anodeArray as $rowanode): ?>
                                                                        <option value="<?php echo $rowanode['ano']; ?>"><?php echo $rowanode['ano']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td width="35%">
                                                    <div class="control-group">
                                                        <label class="control-label"><?php echo get_phrase('Exibir Até'); ?></label>
                                                        <div class="controls">
                                                            <div  id="load_turma">
                                                                <?php
                                                                $ano_atual = date('Y');
                                                                $sql_mes_de2 = "SELECT month (cpr_dt_vencimento) as mes
                                                                                 from siga_financeiro.conta_pagar_receber
                                                                            where year (cpr_dt_vencimento) <= $ano_atual and cpr_nb_tipo = 1
                                                                            group by mes
                                                                            order by mes";
                                                                $mesdeArray2 = $this->db->query($sql_mes_de2)->result_array();

                                                                $mes_atual = date('M');
                                                                $mes_atual_valor = date('m');
                                                                ?>
                                                                <select style="width: 120px;" class="input-search" name="mes_ate" id="mes_ate">
                                                                    <option value="0">TODOS</option>

                                                                    <?php
                                                                    foreach ($mesdeArray2 as $rowmesde2):
                                                                        $mes2 = $rowmesde2['mes'];

                                                                        if ($mes2 == 1) {
                                                                            $mes_tx2 = 'JAN';
                                                                        } else if ($mes2 == 2) {
                                                                            $mes_tx2 = 'FEV';
                                                                        } else if ($mes2 == 3) {
                                                                            $mes_tx2 = 'MAR';
                                                                        } else if ($mes2 == 4) {
                                                                            $mes_tx2 = 'ABR';
                                                                        } else if ($mes2 == 5) {
                                                                            $mes_tx2 = 'MAI';
                                                                        } else if ($mes2 == 6) {
                                                                            $mes_tx2 = 'JUN';
                                                                        } else if ($mes2 == 7) {
                                                                            $mes_tx2 = 'JUL';
                                                                        } else if ($mes2 == 8) {
                                                                            $mes_tx2 = 'AGO';
                                                                        } else if ($mes2 == 9) {
                                                                            $mes_tx2 = 'SET';
                                                                        } else if ($mes2 == 10) {
                                                                            $mes_tx2 = 'OUT';
                                                                        } else if ($mes2 == 11) {
                                                                            $mes_tx2 = 'NOV';
                                                                        } else if ($mes2 == 12) {
                                                                            $mes_tx2 = 'DEZ';
                                                                        }
                                                                        ?>
                                                                        <option value="<?php echo $rowmesde2['mes']; ?>"><?php echo $mes_tx2; ?></option>
                                                                    <?php endforeach; ?>

                                                                </select>
                                                                <?php
                                                                $ano_atual = date('Y');
                                                                $sql_ano_ate = "SELECT year (cpr_dt_vencimento) as ano
                                                                                     from siga_financeiro.conta_pagar_receber
                                                                                where year (cpr_dt_vencimento) >= $ano_atual and cpr_nb_tipo = 1
                                                                                group by ano order by ano asc";
                                                                $anoateArray = $this->db->query($sql_ano_ate)->result_array();
                                                                ?>
                                                                <select style="width: 120px;" class="input-search" name="ano_ate" id="ano_ate">
                                                                    <?php foreach ($anoateArray as $rowanoate): ?>
                                                                        <option value="<?php echo $rowanoate['ano']; ?>"><?php echo $rowanoate['ano']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>

                                            </tr>
                                        </table>
                                        <br>
                                        <table >
                                            <tr>
                                                <td  width="20%">
                                                    <div class="control-group">
                                                        <label class="control-label"><?php echo get_phrase('Cliente'); ?></label>
                                                        <div class="controls">
                                                            <input type="text" name="busca" id="busca" class="input-search" alt="lista-clientes" placeholder="Procurar Cliente" />


                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <table>
                                            <tr>
                                                <td>
                                                    <input type="button" value="PESQUISAR" class="btn btn-blue btn-small" onclick="buscar_paginacao_despesas();">
                                                </td>
                                                <?php /*
                                                  <td>
                                                  <a  href="index.php?educacional/teste_impressao" 	class="btn btn-gray btn-small">
                                                  <i class="icon-dashboard"></i> <?php echo get_phrase('Impressão'); ?>
                                                  </a>

                                                  </td>
                                                 * 
                                                 */
                                                ?>                        
                                            </tr>
                                        </table>
                                        <br>

                                        <div id="load_paginacao_receitas">
                                            <script>
                                                buscar_paginacao_despesas();
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
        <!-- /#wrapper -->
        <!-- Flex Modal -->
        <?php
         date_default_timezone_set('America/Manaus');    
        $data_hoje = date('Y-m-d');
        $data_pagamento_hoje = date("d/m/Y", strtotime($data_hoje)); 
        ?>
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
                                        <font size="4px;">   Cliente </font>
                                    </td>
                                </tr>
                                <tr>
                                    <td >
                                        <input type="text" name="cliente" class="input" style="height: 30px; width: 410px; text-transform: uppercase;">
                                    </td>
                                </tr>
                            </table> 
                            <table width="61%">
                                <tr>
                                    <td width="20%">
                                        <font size="4px;">    Dt Pagamento </font><font style="color: red"> * </font>
                                    </td>
                                    <td width="21%">
                                        <font size="4px;">    Valor </font><font style="color: red"> * </font>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" onkeypress="mascara(this, mdata);" maxlength="10" value="<?php echo $data_pagamento_hoje; ?>" minlength="10" placeholder="99/99/9999" id="calendario3" name="vencimento" required="true" class="input" style="height: 30px; width: 205px;" >
                                    </td>
                                    <td>
                                        <input type="text" placeholder="R$ 0.000,00"  name="valor" onkeypress="mascara(this, mvalor);"  id="valor_mask" required="true" class="input" style="height: 30px; width: 205px;" >
                                    </td>
                                </tr>
                            </table>
                           
                            <table>
                                <tr>
                                    <td>
                                        <font size="4px;">    Referente à:</font>
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
                                    <td >
                                        <font size="4px;">     Categoria</font>
                                    </td>

                                   <td >
                                        <font size="4px;">     Forma de Pagamento</font>
                                    </td>
                                   
                                </tr>
                                <tr>
                                    <td>
                                        <select class="input" name="categoria" style="height: 30px; width: 205px;">
                                            <?php
                                            $sql_curso2 = "SELECT * FROM siga_financeiro.categoria order by cat_tx_descricao asc";
                                            $exe_curso2 = mysql_query($sql_curso2) OR DIE('linha 106 ' . mysqli_error($conexao));

                                            while ($linha_curso2 = mysql_fetch_array($exe_curso2)) {
                                                ?>
                                                <option  value="<?php echo $linha_curso2['categoria_id']; ?> " ><?php echo $linha_curso2['cat_tx_descricao']; ?> </option>
                                            <?php } ?>
                                        </select>

                                    </td>

                                    <td>
                                                                    <select class="input" id="forma_pagamento" name="forma_pagamento"  style="height: 30px; width: 205px;" >
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
                                      <a href="javascript:;" class="fa fa-minus-square"  title="Ocultar" onclick="ShowHideDIV('fornecedor_novo', 0);ShowHideDIV('fornecedor_editar', 1);"> </a>
                          
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
                                        <a href="javascript:;" class="fa fa-minus-square"  title="Ocultar" onclick="ShowHideDIV('categoria_novo', 0);ShowHideDIV('categoria', 1);"> </a>
                          
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

        <div class="modal modal-flex fade" id="cancelar_pagamento_avulso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

                                    <input name="codigo_fornecedor_excluir2_avulso"  id='codigo_fornecedor_excluir2_avulso' type="text" >
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
