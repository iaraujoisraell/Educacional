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
<script language='JavaScript'>
function SomenteNumero(e){
    var tecla=(window.event)?event.keyCode:e.which;   
    if((tecla>47 && tecla<58)) return true;
    else{
    	if (tecla==8 || tecla==0) return true;
	else  return false;
    }
}
</script>

    <script>


        //Aqui eu seto uma variável javascript com o base_url do CodeIgniter, para usar nas funções do post.
        var base_url = "<?php base_url() ?>";

        function carregaDadosPagamentoJSon(id_pagamento) {
            $.post(base_url + '/financeiro/index.php?/admin/dados_mensalidade', {
                id: id_pagamento
            }, function (data) {
               
                $('#pagamento2').val(data.data_vencimento);
                $('#data_pagamento').val(data.data_pagamento);
                $('#mensalidade_id').val(data.mensalidade_id);
                $('#valor_curso').val(data.valor);
                $('#nome').val(data.nome);
                $('#matricula_aluno_id_pagamento').val(data.ma);
      
                //aqui eu seto a o input hidden com o id do cliente, para que a edição funcione. Em cada tela aberta, eu seto o id do cliente. 
            }, 'json');
        }

        function janelaRealizarPagamento(id_pagamento) {

            //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal
            carregaDadosPagamentoJSon(id_pagamento);


            $('#realizar_pagamento').modal('show');


        }


        // EDITAR PAGAMENTO ****************************************************


        function carregaDadosClienteJSon2(id_fornecedor) {
            $.post(base_url + '/financeiro/index.php?/admin/dados_mensalidade', {
                id: id_fornecedor
            }, function (data) {
             
                $('#data_vencimento2').val(data.data_vencimento);
                $('#data_pagamento2').val(data.data_pagamento);
                $('#mensalidade_id2').val(data.mensalidade_id);
                $('#valor2').val(data.valor);
                $('#nome2').val(data.nome);
                $('#matricula_aluno_id_editar').val(data.ma);
           
             //aqui eu seto a o input hidden com o id do cliente, para que a edição funcione. Em cada tela aberta, eu seto o id do cliente. 
            }, 'json');
            
            
                     
        }
        
        function janelaEditarPagamento(id_fornecedor) {

            //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal
            carregaDadosClienteJSon2(id_fornecedor);
            $('#editar_fornecedor2').modal('show');


        }

        function carregaDadosDespesaJSon(id_despesa) {
             $.post(base_url + '/financeiro/index.php?/admin/dados_mensalidade', {
                id: id_despesa
            }, function (data) {
             
                $('#data_vencimento2').val(data.data_vencimento);
                $('#data_pagamento2').val(data.data_pagamento);
                $('#mensalidade_id3').val(data.mensalidade_id);
                $('#valor2').val(data.valor);
                $('#nome2').val(data.nome);
                $('#matricula_aluno_id_delete').val(data.ma);
           
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

        function carregaDadosCancelarJSon(id_despesa) {
             $.post(base_url + '/financeiro/index.php?/admin/dados_mensalidade', {
                id: id_despesa
            }, function (data) {
             
                $('#data_vencimento2').val(data.data_vencimento);
                $('#data_pagamento2').val(data.data_pagamento);
                $('#mensalidade_id4').val(data.mensalidade_id);
                $('#valor2').val(data.valor);
                $('#nome2').val(data.nome);
                $('#matricula_aluno_id_cancelar').val(data.ma);
           
             //aqui eu seto a o input hidden com o id do cliente, para que a edição funcione. Em cada tela aberta, eu seto o id do cliente. 
            }, 'json');
        }

        function janelaCancelarPagamento(id_fornecedor) {

            //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal
            carregaDadosCancelarJSon(id_fornecedor);


            $('#cancelar_pagamento').modal('show');

            $('#alerta_mensagem').alert('show');

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

                <div class="page-content" >
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
                        
                                            $situacao = $row['situacao'];
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
                        ?>

                        <!-- begin PAGE TITLE AREA -->
                        <!-- Use this section for each page's title and breadcrumb layout. In this example a date range picker is included within the breadcrumb. -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="page-title">
                                    <h1>Gerenciar Pagamentos do Aluno

                                    </h1>
                                    <ol class="breadcrumb">
                                        <li><i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                                        </li>
                                        <li class="active">Histórico Financeiro do Aluno</li>
                                        <li class="fa fa-backward"> <a  href="index.php?admin/situacao_financeiro_aluno/<?php echo $matricula; ?>">Voltar para Situação do Aluno</a></li>
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
                                                     <table class="table  table-striped  " width="100%"  cellpadding="0" cellspacing="0" border="0" >
                                            
                                                        <tr>
                                                            <td width="10%">
                                                                <div class="control-group">
                                                                    <label style="font-weight: bold " class="control-label"><?php echo get_phrase('reg. Acadêmico '); ?></label>
                                                                    <div class="controls">
                                                                        <?php echo $row['registro_academico']; ?>  
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td  width="35%">
                                                                <div class="control-group">
                                                                    <label style="font-weight: bold " class="control-label"><?php echo get_phrase('Nome'); ?></label>
                                                                    <div class="controls">
                                                                        <?php echo $row['nome']; ?>

                                                                    </div>
                                                                </div>
                                                            </td>


                                                            <td width="35%">
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
                                                      <?php  if ($bolsista == 1) { 
                                                          ?>
                                                      <table class="table  table-striped   " width="100%" cellpadding="0" cellspacing="0" border="0" >
                                                
                                                    <?php
                                                            $sql_mt2 = "SELECT *, b.descricao as bolsa FROM bolsa_aluno ba
                                    inner join bolsa_periodo bp on bp.bolsa_periodo_id = ba.bolsa_periodo_id
                                    inner join bolsas b on b.bolsas_id = bp.bolsas_id
                                    inner join periodo_letivo pl on pl.periodo_letivo_id = bp.periodo_letivo_id
                                     inner join matricula_aluno_turma mat on mat.matricula_aluno_turma_id = ba.matricula_aluno_turma_id
                                                    inner join matricula_aluno m on m.matricula_aluno_id = mat.matricula_aluno_id
                                                    inner join cadastro_aluno ca on ca.cadastro_aluno_id = m.cadastro_aluno_id
                                                    inner join turma t on t.turma_id = mat.turma_id
                                                    inner join cursos c on c.cursos_id = m.curso_id
                                                    inner join turno tu on tu.turno_id = t.turno_id
                                                    left join periodo p on p.periodo_id = t.periodo_id
                                                    where m.matricula_aluno_id = $matricula and pl.atual = 1
                                    order by bolsa_aluno_id desc";
                                                            $uf_mt2 = $this->db->query($sql_mt2)->result_array();
                                                            foreach ($uf_mt2 as $row_mt2):
                                                                $bolsa = $row_mt2['bolsa'];
                                                                $porcentagem = $row_mt2['porcentagem_bolsa'];
                                                                ?>
                                                             <tr>
                                                            <td><?php echo $bolsa;  ?> - <?php echo $porcentagem;  ?>%</td>
                                                        </tr>   
                                                        <?php
                                                            endforeach;
                                                        ?>
                                                    
                                                        
                                                    </table>
                                                    <?php  } ?>
                                                </div>
                                            </div>
                                            <br>
                                            <table>
                                                <tr>
                                                    <td align="center">
                                                        <a  href="index.php?admin/ficha_aluno/<?php echo $matricula; ?>"  class="btn btn-blue btn-small" >
                                                            <i class="icon-wrench"></i> <?php echo get_phrase('Ficha_do_aluno'); ?>
                                                        </a>
                                                        <button href="javascript:;" class="btn btn-primary" data-target="#flexModal" onclick="janelanovopagamento();">Novo Pagamento</button>
                                                           
                                                       
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
                        <h3>Histórico Financeiro do Aluno</h3>
                         <table class="table lista-clientes table-striped table-bordered table-hover table-green " width="100%" style="border: 5px;" cellpadding="0" cellspacing="0" border="0" >
                                            
                            <tr>
                                <td>
                                    <i class="fa fa-check">PAGO</i>
                                </td>
                                <td>
                                    <i class="fa fa-circle-o">ABERTO</i>
                                </td>
                                <td>
                                    <i class="fa fa-warning">PGTO PARCIAL</i>
                                </td>
                            </tr>
                        </table>
                         <div class="box-content padded">
                    <div class="tab-content">
                        <div class="tab-pane  active" id="list">
                            <div class="action-nav-normal">
                                <div class="box">
                                    <div class="box-content">
                                        <div id="dataTables">
                                            <div id="situacao_financeira_table">
                                            <table class="table lista-clientes table-striped table-bordered table-hover table-green " width="100%" style="border: 5px;" cellpadding="0" cellspacing="0" border="0" >
                                                <thead >
                                                        <tr>
                                                            <td style="background-color: #2C3E50; color: #ffffff"><div>ID</div></td>
                                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('P._letivo'); ?></div></td>
                                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Parc.'); ?></div></td>
                                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Dt_vcto'); ?></div></td>
                                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Dt_Pgto'); ?></div></td>
                                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('(-)Desc'); ?></div></td>
                                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('(+)Juros'); ?></div></td>
                                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('(+)Multas'); ?></div></td>
                                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('(-)Bolsas'); ?></div></td>
                                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('(-)FIES'); ?></div></td>
                                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('V._Pagar'); ?></div></td>
                                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('V_pago'); ?></div></td>
                                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('V._pendente'); ?></div></td>
                                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Referente'); ?></div></td>
                                                            <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('sit.'); ?></div></td>
                                                            <td style="background-color: #2C3E50; color: #ffffff"><div><?php echo get_phrase('opções'); ?></div></td>
                                                        </tr>
                                                    </thead>
                                                <tbody>
                                                    <?php
                                                    $hoje = date("Y-m-d");
                                                     $sql_mt22 = " select max(matricula_aluno_turma_id) as matricula_aluno_turma_id  FROM matricula_aluno_turma mat where matricula_aluno_id = $matricula ";
                                        $uf_mt22 = $this->db->query($sql_mt22)->result_array();
                                        foreach ($uf_mt22 as $row_mt22):
                                            $matricula_aluno_turma_id_maximo = $row_mt22['matricula_aluno_turma_id'];
                                         endforeach;
                                                    $sql = "SELECT mat.matricula_aluno_turma_id as matricula_aluno_turma_id, mensalidade_id, t.turma_id, t.ano as ano, t.semestre as semestre,
                                                             mat.periodo as periodo_mat,  mat.dependencia as dependencia,
                                                             mat.situacao_aluno_turma as situacao_aluno_turma,mensalidade_id,men_dt_vencto,mf_dt_pgto,men_nb_numero_parcela,total_parcela,
                                                             men_nb_status as status_mensalidade, men_fl_valor,men_tx_mes, men_tx_obs, p.produto_id as produto_id, p.descricao as produto, referencia, 
                                                             mf_nb_forma_pagamento, men.periodo_letivo_id,  CONCAT(t.ano,'/',t.semestre) AS periodo_letivo_turma, obs,mf_db_valor,mf_db_desconto,
                                                             mf_db_juros,multa,bolsa,valor_total,mf_nb_codigo,financiamento
                                                             
                                                             FROM matricula_aluno_turma mat
                                                             inner join siga_financeiro.mensalidade men on men.matricula_aluno_turma_id = mat.matricula_aluno_turma_id
                                                             left join siga_financeiro.movimento_financeiro mf on mf.mensalidades_id = men.mensalidade_id
                                                             left join siga_financeiro.produto p on p.produto_id = men.produto_id
                                                             inner join turma t on t.turma_id = mat.turma_id 
                                                    where  mat.matricula_aluno_id = '$matricula' order by periodo_letivo_id desc, men_nb_numero_parcela, total_parcela asc,mensalidade_id desc  ";
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
                                            $total_parcela = $row2['total_parcela'];
                                            $mensalidade = $row2['mensalidade_id'];
                                            
                                            $movimento_financeiro_id = $row2['mf_nb_codigo'];
                                            
                                            $data_vencimento2 = $row2['men_dt_vencto'];
                                            $data_vencimento = date("d/m/Y", strtotime($data_vencimento2));
                                            
                                            $data_pagamento2 = $row2['mf_dt_pgto'];
                                            
                                            if($data_pagamento2 ){
                                                $data_pagamento = date("d/m/Y", strtotime($data_pagamento2));
                                            }else{
                                                $data_pagamento = '-';
                                            }
                                            
                                             $situacao_pgto = $row2['status_mensalidade'];
                                           
                                            $valor = $row2['men_fl_valor'];
                                            $valor2 = number_format($valor, 2, ',', '.');
                                            
                                            //$valor_total = $row2['valor_total'];
                                            //$valor_total2 = number_format($valor_total, 2, ',', '.');
                                            
                                            $valor_mf = $row2['mf_db_valor'];
                                            $valor_mf2 = number_format($valor_mf, 2, ',', '.');
                                            
                                            $valor_juros = $row2['mf_db_juros'];
                                            $valor_juros2 = number_format($valor_juros, 2, ',', '.');
                                            
                                            $valor_desconto = $row2['mf_db_desconto'];
                                            $valor_desconto2 = number_format($valor_desconto, 2, ',', '.');
                                            
                                            $valor_multa = $row2['multa'];
                                            $valor_multa2 = number_format($valor_multa, 2, ',', '.');
                                            
                                            $valor_bolsa = $row2['bolsa'];
                                            $valor_bolsa2 = number_format($valor_bolsa, 2, ',', '.');
                                            
                                            $valor_financiamento = $row2['financiamento'];
                                            $valor_financiamento2 = number_format($valor_financiamento, 2, ',', '.');
                                           
                                            $valor_real = $valor + $valor_juros + $valor_multa - $valor_desconto - $valor_bolsa;
                                            $valor_real2 = number_format($valor_real, 2, ',', '.');
                                            
                                            $valor_total = $row2['valor_total'];
                                            $valor_total2 = number_format($valor_total, 2, ',', '.');
                                            
                                            $produto_id = $row2['produto_id'];
                                            $periodo_letivo_mensalidade = $row2['periodo_letivo_id'];
                                            $periodo_letivo_m = $row2['periodo_letivo_id'];
                                            $produto_ref = $row2['referencia'];
                                            if($periodo_letivo_m){
                                                $periodo_letivo_m = $row2['periodo_letivo_id'];
                                            }else{
                                                $periodo_letivo_m = $row2['periodo_letivo_turma'];
                                            }
                                            if ($produto_id) {
                                                $produto = $row2['produto'];
                                            } else  {
                                                 $produto_ref = $row2['referencia'];
                                                 
                                               
                                               if($produto_ref > 0){
                                                    /******PESQUISA O PRODUTO PELO CÓDIGO DA REFERÊNCIA****/
                                                $sql_mt223 = " select * FROM siga_financeiro.produto where produto_id = $produto_ref ";
                                                $uf_mt223 = $this->db->query($sql_mt223)->result_array();
                                                foreach ($uf_mt223 as $row_mt223):
                                                    $produto = $row_mt223['descricao'];
                                                endforeach;
                                               
                                               }else{
                                                    $produto = $row2['referencia'];
                                               }
                                            }
                                            $matricula_aluno_turma_id = $row2['matricula_aluno_turma_id'];

                                           
                                            if ($situacao_pgto == '1') {
                                                $situacao2 = 'Pago';
                                                $icon = 'fa-check';
                                                 $valor_pendente = "";
                                            } else if ($situacao_pgto == '0') {
                                                $situacao2 = 'Aberto';
                                                 $icon = 'fa-circle-o';
                                                 $valor_pendente = "";
                                            }else if ($situacao_pgto == '3') {
                                                $situacao2 = 'Parcial';
                                                 $icon = 'fa-warning';
                                                 
                                                  $valor_pendente = $valor_total - $valor_mf;
                                                  
                                                 
                                            }
                                                        //$sql.=" order by nome asc ";
                                                        ?>

                                                    <tr > 
                                                <td><?php echo $count++; ?></td>
                                                <td align="left"><?php echo $periodo_letivo_m; ?></td>
                                                <td align="left"><?php echo $parcela;  ?><?php if($total_parcela){ ?>/<?php } echo $total_parcela; ?></td>
                                                <td align="left"><?php echo $data_vencimento; ?></td>
                                                <td align="left"><?php echo $data_pagamento; ?></td>
                                                
                                                <td align="left"><?php echo $valor_desconto2; ?> </td>
                                                <td align="left"><?php echo $valor_juros2; ?> </td>
                                                <td align="left"><?php echo $valor_multa2; ?> </td>
                                                <td align="left"><?php echo $valor_bolsa2; ?> </td>
                                                <td align="left"><?php echo $valor_financiamento2; ?> </td>
                                                <?php  if ($valor_total) { ?>
                                                <td align="left"><?php echo $valor_total2; ?> </td>
                                                <?php }else if ($valor >= '1') { ?>
                                                <td align="left"><?php echo $valor2; ?> </td>
                                                <?php } ?>
                                                <td align="left"><?php echo $valor_mf2; ?> </td>
                                                <td align="left"><?php echo number_format($valor_pendente, 2, ',', '.'); ?> </td>
                                                <td align="left"><?php echo $produto; ?> </td>
                                                <td align="left"><i title="<?php echo $situacao2; ?>" class="fa <?php echo $icon; ?>"> </i></td>
                                                        <td width="70px;" class="center"> 
                                                            <?php if ($situacao_pgto == 1) { ?>
                                                                <a href="javascript:;" class="fa fa-rotate-left " title="Cancelar Pagamento" data-target="#cancelar_pagamento" onclick="janelaCancelarPagamento(<?php echo $mensalidade; ?>)"> </a>
                                                                 <a  href="index.php?admin/recibo_impressao/<?php echo $matricula; ?>/<?php echo $matricula_aluno_turma_id; ?>/<?php echo $mensalidade; ?>/<?php echo $movimento_financeiro_id; ?>" class="fa fa-print" title="Imprimir Comprovante de pagamento" target="_blank" class="btn btn-gray btn-small"></a>
                                                                 
                                                            <?php } else if ($situacao_pgto == 3) { ?>
                                                                   <a href="index.php?admin/situacao_financeiro_aluno_novo_pagamento/<?php echo $matricula; ?>/<?php echo $matricula_aluno_turma_id; ?>/<?php echo $mensalidade; ?>" class="fa fa-credit-card" title="Registrar Pagamento"  > </a>
                                                                 <a href="javascript:;" class="fa fa-rotate-left " title="Cancelar Pagamento" data-target="#cancelar_pagamento" onclick="janelaCancelarPagamento(<?php echo $mensalidade; ?>)"> </a>
                                                                 <a  href="index.php?admin/recibo_impressao/<?php echo $matricula; ?>/<?php echo $matricula_aluno_turma_id; ?>/<?php echo $mensalidade; ?>/<?php echo $movimento_financeiro_id; ?>" class="fa fa-print" title="Imprimir Comprovante de pagamento" target="_blank" class="btn btn-gray btn-small"></a>
                                                                 
                                                                  <?php } else {  ?>
                                                               <a href="index.php?admin/situacao_financeiro_aluno_novo_pagamento/<?php echo $matricula; ?>/<?php echo $matricula_aluno_turma_id; ?>/<?php echo $mensalidade; ?>" class="fa fa-credit-card" title="Registrar Pagamento"  > </a>
                                                                <?php } ?>
                                                            <?php if ($situacao_pgto == 0) { ?>
                                                                <a href="javascript:;" class="fa fa-edit" data-target="#editar_fornecedor2" title="Editar" onclick="janelaEditarPagamento(<?php echo $mensalidade; ?>)"> </a>
                                                                <a href="javascript:;" class="fa fa-trash-o  "  data-target="#excluir_fornecedor"  title="Excluir" onclick="janelaExcluirDespesa(<?php echo $mensalidade; ?>)" ></a>
                                                            <?php } ?>
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
                        <h4 class="modal-title" id="flexModalLabel">Novo Pagamento</h4>

                    </div>

                    <?php echo form_open('admin/historico_financeiro_aluno/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <form method="post" action="<?php echo base_url(); ?>index.php?admin/historico_financeiro_aluno/create/" class="form-horizontal validatable" enctype="multipart/form-data">
                        <input type="hidden" value="<?php echo $matricula; ?>" name="matricula_aluno_id" id="matricula_aluno_id">
                        <input type="hidden" value="<?php echo $matricula_aluno_turma_id_maximo; ?>" name="matricula_aluno_turma_id" id="matricula_aluno_turma_id">
                        
                        
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
                            <?php
                            $sql2 = "SELECT distinct men.periodo_letivo_id,  CONCAT(t.ano,'/',t.semestre) AS periodo_letivo_turma
                                                             
                                                             FROM matricula_aluno_turma mat
                                                             inner join siga_financeiro.mensalidade men on men.matricula_aluno_turma_id = mat.matricula_aluno_turma_id
                                                             left join siga_financeiro.movimento_financeiro mf on mf.mensalidades_id = men.mensalidade_id
                                                             left join siga_financeiro.produto p on p.produto_id = men.produto_id
                                                             inner join turma t on t.turma_id = mat.turma_id 
                                                    where  mat.matricula_aluno_id = '$matricula' order by periodo_letivo_id desc, men_nb_numero_parcela, total_parcela asc,mensalidade_id desc  ";
                                                    //echo  $sql;
                                                    $MatrizArray2 = $this->db->query($sql2)->result_array();
                                                    $count = 1;
                                                    ?>
                           
                            <table>
                                <tr>
                                    <td>
                                        <font size="4px;">  Referente ao Período Letívo </font>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <select class="input" id="periodo_letivo" name="periodo_letivo"  style="height: 30px; width: 410px;" >
                                             <?php
                                                    foreach ($MatrizArray2 as $row22):
                                                       $periodo_letivo_m = $row22['periodo_letivo_id'];
                                                        $produto_ref = $row22['referencia'];
                                                        if($periodo_letivo_m){
                                                            $periodo_letivo_m = $row22['periodo_letivo_id'];
                                                        }else{
                                                            $periodo_letivo_m = $row22['periodo_letivo_turma'];
                                                        }
                                                  ?>
                                            <option value="<?php echo $periodo_letivo_m; ?>"><?php echo $periodo_letivo_m; ?></option>
                                            <?php
                                                        
                                                   endforeach;
                                                  ?>
                                        </select>
                                         </td>
                                </tr>
                            </table>
                            
                            
                            <table>
                                <tr>
                                    <td width="20%">
                                        <font size="4px;">    Produto </font><font style="color: red"> * </font>
                                    </td>
                                </tr>
                                <tr>
                                     <td>
                                        <select class="input" id="produto" name="produto"  style="height: 30px; width: 410px;" >
                                    
                                <?php
                                                    $hoje = date("Y-m-d");
                                $sql_mt22 = "select * FROM siga_financeiro.produto order by descricao asc ";
                                $uf_mt22 = $this->db->query($sql_mt22)->result_array();
                                foreach ($uf_mt22 as $row_mt22):
                                    $produto_id = $row_mt22['produto_id'];
                                    $descricao = $row_mt22['descricao'];
                                ?>    
                                <option value="<?php echo $produto_id; ?>"><?php echo $descricao; ?></option>
                                <?php            
                                endforeach;
                                ?>
                                            
                                                
                                            </select>
                                    </td>  
                                 </tr>
                            </table>
                            
                            
                            <br>
                            
                           
                            
                            <table width="60%">
                                <tr>
                                    <td width="20%">
                                        <font size="4px;">Dt Vencimento </font>
                                    </td>

                                    
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" onkeypress="mascara(this, mdata);" maxlength="10" minlength="10" placeholder="99/99/9999" id="calendario3" name="vencimento_mensalidade" required="true" class="input" style="height: 30px; width: 410px;" >
                                    </td>

                                 
                                 </tr>
                            </table>
                                <table width="60%">
                                <tr>
                                    <td width="20%">
                                        <font size="4px;">Valor</font>
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
                                        <font size="4px;"> Quantidade parcelas</font>
                                    </td>
                                    <td ></td>
                                </tr>
                                <tr>
                                     <td>
                                        <select class="input" id="quantidade_parcela" name="quantidade_parcela"  style="height: 30px; width: 410px;" >
                                            
                                                <option  value="1">1</option>
                                                <option  value="2">2</option>
                                                <option  value="3">3</option>
                                                <option  value="4">4</option>
                                                <option  value="5">5</option>
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
        <!-- /.row -->
        <!-- *********************** EFETUAR PAGAMENTO ******************************  -->
        <div class="modal modal-flex fade" id="realizar_pagamento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="flexModalLabel">Confirmar Pagamento </h4>
                    </div>
<?php
 $data_vencimento = '2016-01-07';                                                        
        date_default_timezone_set('America/Manaus');        
        $data_hoje = date('Y-m-d');
        $data_pagamento_hoje = date("d/m/Y", strtotime($data_hoje));           
        
        $data_vencimento_pgto = '07/01/2016';
        ?>
        <input type="hidden" value="<?php echo $data_hoje; ?>" id="data_hoje">
        <input type="hidden" value="<?php echo $data_vencimento; ?>" id="data_vencimento">
        
        <script>
        function arred(d,casas) { 
        var aux = Math.pow(10,casas)
        return Math.floor(d * aux)/aux
    }


       // var total = (((Date.parse(document.getElementById('data_hoje').value)) - (Date.parse(document.getElementById('data_vencimento').value))) / (24 * 60 * 60 * 1000));
        
        var dataInicio = new Date(document.getElementById('data_vencimento').value);
        var dataFim = new Date(document.getElementById('data_hoje').value);
        var diffMilissegundos = dataFim - dataInicio;
        var diffSegundos = diffMilissegundos / 1000;
        var diffMinutos = diffSegundos / 60;
        var diffHoras = diffMinutos / 60;
        var diffDias = diffHoras / 24;
        var diffMeses = diffDias / 30;
        
        var meses_atrasados = arred(diffMeses,0);
        
    
       
       
    function atualizar_valor_pagar() { 
           var valor_pagar = document.getElementById('valor_curso').value;
           var total_pagar = valor_pagar + (document.getElementById('juros2').value  - document.getElementById('desconto2').value) ;
           var multa = + document.getElementById('multa2').value;
           var total_com_multa =  total_pagar + multa;
           var total_com_multa_arr = (Math.floor(total_com_multa * Math.pow(10,2))/Math.pow(10,2))
           document.getElementById('valor_pago2').value = total_com_multa_arr;
           
          //document.getElementById('valor_pago2').value = total_pagar;
          // alert(total_com_multa_arr);
           return total_com_multa_arr;
       }
       
       
        </script>

               <?php echo form_open('admin/historico_financeiro_aluno/efetuar_pagamento/', array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <input  name="mensalidade_id"  id="mensalidade_id" type="hidden" >
                    <input  name="matricula_aluno_id_pagamento"  id="matricula_aluno_id_pagamento" type="hidden" >
                    <div style="margin:auto; width: 450px;" class="modal-body">

                        <table width="100%">
                            <tr>
                                <td width="10%">
                                    <font style="color: #696969;" size="2">  Aluno   </font><font color="#ff0000"> </font>
                                </td>

                            </tr>
                            <tr>

                                <td width="70%">
                                    <input type="text" disabled="true" id='nome' name="nome" class="input" style="height: 30px; width: 410px;">

                                </td>                                                                                           
                            </tr>
                        </table>
                        <br>
                        <?php
                        if ($bolsista == 1) {
                            $sql_mt2 = "SELECT * FROM bolsa_aluno ba
                                                            inner join bolsa_periodo bp on bp.bolsa_periodo_id = ba.bolsa_periodo_id
                                                            inner join bolsas b on b.bolsas_id = bp.bolsas_id WHERE matricula_aluno_turma_id = 17980";
                            $uf_mt2 = $this->db->query($sql_mt2)->result_array();
                            foreach ($uf_mt2 as $row_mt2):
                                $bolsa = $row_mt2['descricao'];
                                $porcentagem = $row_mt2['percentagem'];
                            endforeach;
                            ?>
                            <table class="table  table-striped   " width="100%" cellpadding="0" cellspacing="0" border="0" >
                                <tr>
                                    <td><?php echo $bolsa; ?> - <?php echo $porcentagem; ?>%</td>
                                </tr>
                            </table>
<?php } ?>
                        <table width="61%">
                            <tr>

                                <td >
                                    <font size="4px;">    Data do Pagamento </font><font style="color: red"> * </font>
                                </td>
                                <td width="20%">
                                    <font size="4px;">    Data do Vencimento  </font><font style="color: red">  </font>
                                </td>
                            </tr>
                            <tr>

                                <td>
                                    <input type="text" onkeypress="mascara(this, mdata);" value="<?php echo $data_pagamento_hoje; ?>" maxlength="10" minlength="10" placeholder="99/99/9999" name="pagamento" id="pagamento" required="true" class="input" style="height: 30px; width: 200px;" >
                                </td>
                                <td>
                                    <input type="text" onkeypress="mascara(this, mdata);" readonly="true"  maxlength="10" minlength="10" placeholder="99/99/9999"  name="pagamento2" id="pagamento2" required="true" class="input" style="height: 30px; width: 200px;" >

                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <td >
                                    <font size="4px;">    Forma de Pagamento </font><font style="color: red"> * </font>
                                </td>
                                <td align="right">
                                    <font size="4px;">    Valor R$ </font><font style="color: red">  </font>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <select class="input" id="forma_pagamento" name="forma_pagamento"  style="height: 30px; width: 200px;" >
                                        <option value="1">À Vista</option>
                                        <option value="2">C. Crédito</option>
                                        <option value="3">C. Débito</option>
                                        <option value="4">Cheque</option>
                                        <option value="5">Boleto</option>
                                        <option value="6">Tranferência Bancária</option>
                                    </select>
                                </td> 
                                <td align="right">
                                    <font style="text-align: right" >   <input type="text" placeholder="R$ 0.000,00" disabled="true"  name="valor_curso" id="valor_curso" onKeyPress="return(MascaraMoeda1(this, '.', ',', event))"  required="true" class="input" style="height: 30px; width: 200px;text-align: right; " ></font>
                                </td>
                            </tr>
                        </table>
                        <table >
                            <tr>
                                <td >
                                    <font size="4px;">    Desconto (%)</font><font style="color: red">  </font>
                                </td>
                                <td align="right">
                                    <font size="4px;">    Valor do Desconto R$  </font><font style="color: red">  </font>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" onkeypress="return SomenteNumero(event);" onkeyup="document.getElementById('desconto2').value = ((this.value / 100) * document.getElementById('valor_curso').value); "  maxlength="3" minlength="1" placeholder="% de desconto" id="calendario3" id="desconto" name="desconto"  class="input" style="height: 30px; width: 200px;" >
                                </td>
                                <td align="right">
                                    <input type="text" readonly="true" onkeypress="return SomenteNumero(event);"   maxlength="3" minlength="1"  id="desconto2" name="desconto2"  class="input" style="height: 30px; width: 200px; text-align: right;" >
                                </td>
                            </tr>
                        </table>
                        <table >
                            <tr>
                                <td >
                                    <font size="4px;">   Juros (%)</font><font style="color: red">  </font>
                                </td>
                                <td align="right" >
                                    <font size="4px;">   Valor do Juros R$  </font><font style="color: red">  </font>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" onkeypress="return SomenteNumero(event);" 
                                           onkeyup="    var valor_com_juros = 0;
                                                            for (i = 0; i < meses_atrasados; i++) { 
                                                              var valor_somado =  <?php echo $valor_curso; ?> + valor_com_juros;
                                                              valor_com_juros += (this.value / 100) * valor_somado;
                                                            }
                                                            var resultado_juros = arred(valor_com_juros,2);
                                                           
                                                   document.getElementById('juros2').value =  resultado_juros; atualizar_valor_pagar();"

                                           maxlength="3" minlength="1" placeholder="% de juros" id="calendario3" id="juros" name="juros"  class="input" style="height: 30px; width: 200px;" >
                                </td>
                                <td align="right">
                                    <input type="text" readonly="true" onkeypress="return SomenteNumero(event);"   maxlength="3" minlength="1"  id="juros2" name="juros2"  class="input" style="height: 30px; width: 200px; text-align: right;" >
                                </td>
                            </tr>
                        </table>
                        <table >
                            <tr>
                                <td >
                                    <font size="4px;">   Multa (%)</font><font style="color: red">  </font>
                                </td>
                                <td align="right" >
                                    <font size="4px;">   Valor da Multa R$  </font><font style="color: red">  </font>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" onkeypress="return SomenteNumero(event);" 
                                           onkeyup="document.getElementById('multa2').value = ((this.value / 100) * <?php echo $valor_curso; ?>); atualizar_valor_pagar();"
                                           maxlength="3" minlength="1" placeholder="% da multa" id="multa" name="multa"  class="input" style="height: 30px; width: 200px;" >
                                </td>
                                <td align="right">
                                    <input type="text" readonly="true" onkeypress="return SomenteNumero(event);"   maxlength="3" minlength="1"  id="multa2" name="multa2"  class="input" style="height: 30px; width: 200px; text-align: right;" >
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <td align="right">
                                    <font size="4px;">   Valor Pago R$</font><font style="color: red">  </font>
                                </td>
                                <td align="right">
                                    <font size="4px;">   Valor a Pagar R$</font><font style="color: red">  </font>
                                </td>
                                
                            </tr>
                            <tr>
                                <td>
                                    <input  type="text" required="true" name="valor_pago"  id="valor_pago"  onKeyPress="return(MascaraMoeda1(this, '.', ',', event))"   class="input" style="height: 30px; width: 200px; text-align: right;" >
                                </td>
                                <td>
                                    <input  type="text" readonly="true" name="valor_pago2"  id="valor_pago2" value="<?php echo $valor_curso2; ?>"   onKeyPress="return(MascaraMoeda1(this, '.', ',', event))"   class="input" style=" height: 30px; width: 200px; text-align: right;" >

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




                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-green" >Confirmar Pagamento</button>
                        </div>
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
                        <h4 class="modal-title" id="flexModalLabel">Editar Pagamento </h4>
                    </div>



                    <?php echo form_open('admin/alterar_mensalidade/', array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <input type="hidden" name="matricula_aluno_id_editar"  id="matricula_aluno_id_editar"  >
                    <input  name="mensalidade_id2"  id="mensalidade_id2" type="hidden" >
                      <div  style="width: 450px; margin: auto;" class="modal-body">
                        <table>
                            <tr>
                                <td>
                                    <font size="4px;">   Aluno </font>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    <div  >
                                        <input type="text" name="nome2" readonly="true" id="nome2" disabled="true" class="input" style="height: 30px; width: 410px;">
                                   </div>
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
                                    <input type="text"  id="data_vencimento2" name="data_vencimento2" required="true" class="input" style="height: 30px; width: 200px;" >
                                </td>
                                <td style="margin-left: 5px;">
                                    <input type="text"  name="valor2"  id="valor2" required="true" class="input" style="height: 30px; width: 205px;" >
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



                <?php echo form_open('admin/historico_financeiro_aluno/delete/', array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <input  name="matricula_aluno_id_delete"  id="matricula_aluno_id_delete" type="hidden" >

                    <div class="modal-body">
                        <table>
                            <tr>
                                <td>
                                    <input name="mensalidade_id3"  id='mensalidade_id3' type="hidden" >
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
            <?php echo form_open('admin/historico_financeiro_aluno/cancelar/', array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <input  name="matricula_aluno_id_cancelar"  id="matricula_aluno_id_cancelar" type="hidden" >
                    
                   

                    <div class="modal-body">
                        <table>
                            <tr>
                                <td>
                                    <input name="mensalidade_id4"  id='mensalidade_id4' type="hidden" >
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
