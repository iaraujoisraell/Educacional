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

        function buscar_table_disciplinas( mat_id) {
         // var turma = turma;
          var mat_id = mat_id;

            //if ((aluno) || (curso != '0') || (turma != '0')) {
            var url = 'index.php?admin/carrega_table_disciplinas/'  + mat_id;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_disciplinas').html(dataReturn);  //coloco na div o retorno da requisicao
            });
            //  }else{
            //      alert('Selecione um curso e turma');
            //  }
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
         
         
          var base_url = "<?php base_url() ?>";
  
        function carregaDadosPagamentoJSon(id_pagamento) {
            $.post(base_url + '/financeiro/index.php?/admin/dados_mensalidade_mat', {
                id: id_pagamento
            }, function (data) {
               
                $('#periodo_letivo_novo_registro').val(data.pl);
                $('#matricula_aluno_turma_id_situacao').val(data.mat);
                
                //aqui eu seto a o input hidden com o id do cliente, para que a edição funcione. Em cada tela aberta, eu seto o id do cliente. 
            }, 'json');
        }

     

           function janelanovopagamento(id_pagamento) {

            //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal
             carregaDadosPagamentoJSon(id_pagamento);
             
             document.getElementById('matricula_aluno_turma_id_situacao_teste').value = id_pagamento;
             
             buscar_table_disciplinas(id_pagamento);
    
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

                <div  class="page-content">
                    <?php
                    foreach ($turma as $row):
                        $matricula = $row['matricula_aluno_id'];
                        $matricula_aluno_turma_id_pg = $row['matricula_aluno_turma_id'];
                        $cadastro_aluno = $row['cadastro_aluno_id'];
                        $matriz_id = $row['matriz_id'];
                        $periodo_atual = $row['periodo_atual'];
                        $desperiodizado = $row['desperiodizado'];
                        $bolsista = $row['bolsista'];
                        $forma_ingresso = $row['forma_ingresso'];
                        $nome_aluno = $row['nome'];
                        
                        $valor_curso = $row['cur_fl_valor'];
                        $valor_curso2 = number_format($valor_curso, 2, ',', '.');
                        
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
                                    <h1>Pagamento Referente a Matrícula

                                    </h1>
                                    <ol class="breadcrumb">
                                        <li><i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                                        </li>
                                        <li class="active">Pagamento Matrícula</li>
                                            <li class="fa fa-backward"> <a  href="index.php?admin/situacao_financeiro_aluno/<?php echo $matricula; ?>">Voltar para Situação Financeira do Aluno</a></li>
                                 
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
                                                <div  style="margin-left: 15px; "  class="tab-pane fade in active">                            
                                                    <table style="background-color: #2f4254;" class="table  table-striped  " width="100%"  cellpadding="0" cellspacing="0" border="0" >
                                            
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
                                                    
                                                   
                                                      
                                                       <table class="table  table-striped  " width="100%"  cellpadding="0" cellspacing="0" border="0" >
                                                            


                                                            <?php
                                                            $query2 = "SELECT *, b.descricao as bolsa FROM bolsa_aluno ba
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
                                                    where ba.matricula_aluno_turma_id = $matricula_aluno_turma_id_pg order by bolsa_aluno_id desc";
                                                            // ECHO  $query2;
                                                            $MatrizArrayt2 = $this->db->query($query2)->result_array();
                                                            $soma_bolsa = 0;
                                                            foreach ($MatrizArrayt2 as $row_turma2):
                                                                $bolsa = $row_turma2['bolsa'];
                                                                $porcentagem_bolsa = $row_turma2['porcentagem_bolsa'];
                                                                $soma_bolsa += $porcentagem_bolsa;
                                                                //echo $soma_bolsa;
                                                               // $periodo_letivo = $row_turma2['periodo_letivo'];
                                                               // $periodo_letivo_id = $row_turma2['periodo_letivo_id'];
                                                                //$bolsa_periodo_id = $row_turma2['bolsa_periodo_id'];
                                                                
                                                                ?>

                                                                <tr>
                                                                    <td >      
                                                                        <font style="height: 30px; width: 400px; text-transform:uppercase;"><?php echo $bolsa; ?> <?php ' ' ?> <?php echo $row_turma2['porcentagem_bolsa']; ?>%</font>

                                                                    </td>
                                                                </tr>

                                                                <?php
                                                            endforeach;
                                                            ?>
                                                        </table>
                                                </div>
                                                <div id="load_disciplinas">
                                                    <script>
                                                         buscar_table_disciplinas(<?php echo $matricula_aluno_turma_id_pg ?>);
                                                    </script>
                                                </div>
                                                
                                            </div>
                                            
                                          <br>
                                        </div>
                                        
                                        <?php
                                                        $sql_mt213 = "SELECT * FROM periodo_letivo where atual =  1 ";
                                                                $uf_mt213 = $this->db->query($sql_mt213)->result_array();
                                                                foreach ($uf_mt213 as $row_mt223):
                                                                    $periodo_letivo22 = $row_mt223['periodo_letivo'];
                                                                endforeach;
        
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
           var valor_pagar_curso = <?php echo $valor_curso; ?>;
           var multa =  parseFloat(document.getElementById('multa2').value);
           var bolsa =  document.getElementById('bolsa2').value;
           var financiamento =  document.getElementById('financiamento2').value;
           
           var total_pagar = valor_pagar_curso + (document.getElementById('juros2').value - document.getElementById('desconto2').value);
           
         //  var total_com_multa =  total_pagar + multa;
          // var total_com_multa_arr = (Math.floor(total_com_multa * Math.pow(10,2))/Math.pow(10,2));
           
           var valor_apagar = (total_pagar - bolsa) + multa - financiamento ;
           
           document.getElementById('valor_pago2').value = Math.floor(valor_apagar * Math.pow(10,2))/Math.pow(10,2);// (Math.floor(valor_apagar * Math.pow(10,2))/Math.pow(10,2)) ;
           
         //var valorsubtotal = document.getElementById('valor_pago2').value;
         //  alert(valorsubtotal);
          
           //return valor_apagar;
       }
       
       
        </script>
        <?php 
        $meses_atrasados = "<script>document.write(meses_atrasados)</script>";
        ?>
            <script>
            window.onload = function(){
              atualizar_valor_pagar();
            }
            </script>

       
            
        <div style="width: 100%; background-color: #E0E7E8">
              <div style="margin:auto;  width: 450px;  "  >
                  
                                            <table class="table lista-clientes table-striped table-bordered table-hover table-green " width="100%" style="border: 5px;" cellpadding="0" cellspacing="0" border="0" >
                                                    <?php echo form_open('admin/situacao_financeiro_aluno/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                                                    <input type="hidden" value="<?php echo $matricula; ?>" name="matricula_aluno_id" id="matricula_aluno_id">
                                                    <input type="hidden" value="<?php echo $matricula_aluno_turma_id_pg; ?>"  name="matricula_aluno_turma_id_situacao" id="matricula_aluno_turma_id_situacao">
                                                    <input type="hidden" value="<?php echo $row2['periodo_letivo']; ?>" name="periodo_letivo" id="periodo_letivo">
                                                    
       
                                                        <table >
                                                            <tr>

                                                                <td >
                                                                    <font size="4px;">    Data do Pagamento </font><font style="color: red"> * </font>
                                                                </td>
                                                                <td >
                                                                    <font size="4px;">    Data do Vencimento  </font><font style="color: red">  </font>
                                                                </td>
                                                            </tr>
                                                            <tr>

                                                                <td>
                                                                    <input type="text" onkeypress="mascara(this, mdata);" value="<?php echo $data_pagamento_hoje; ?>" maxlength="10" minlength="10" placeholder="99/99/9999" id="calendario3" name="pagamento" id="pagamento" required="true" class="input" style="height: 30px; width: 200px;" >
                                                                </td>
                                                                <td>
                                                                    <input type="text" onkeypress="mascara(this, mdata);" value="<?php echo $data_vencimento_pgto; ?>" maxlength="10" minlength="10" placeholder="99/99/9999" id="calendario3" name="pagamento2" id="pagamento2" required="true" class="input" style="height: 30px; width: 200px; " >

                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table>
                                                            <tr>
                                                                <td >
                                                                    <font size="4px;">    Forma de Pagamento </font><font style="color: red"> * </font>
                                                                </td>
                                                                <td align="right">
                                                                    <font size="4px;">    Valor do Curso R$ </font><font style="color: red">  </font>
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
                                                                    <font style="text-align: right" >   <input type="text" placeholder="R$ 0.000,00" readonly="true" value="<?php echo $valor_curso2; ?>" name="valor_curso" onKeyPress="return(MascaraMoeda1(this, '.', ',', event))" id="valor_curso" required="true" class="input" style="height: 30px; width: 200px;text-align: right; background-color: #CCC" ></font>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table >
                                                            <tr>
                                                                <td >
                                                                    <font size="4px;">    Desconto (%)</font><font style="color: red">  </font>
                                                                </td>
                                                                <td align="right">
                                                                    <font size="4px;">   (-) Valor do Desconto R$  </font><font style="color: red">  </font>
                                                                </td>
                                                                
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <input type="text" onkeypress="return SomenteNumero(event);" onkeyup="document.getElementById('desconto2').value = ((this.value / 100) * <?php echo $valor_curso; ?>); atualizar_valor_pagar();"  maxlength="3" minlength="1" placeholder="% de desconto" id="calendario3" id="desconto" name="desconto"  class="input" style="height: 30px; width: 200px;" >
                                                                </td>
                                                                <td align="right">
                                                                    <input type="text" readonly="true" value="0" onkeypress="return SomenteNumero(event);"   maxlength="3" minlength="1"  id="desconto2" name="desconto2"  class="input" style="height: 30px; width: 200px; text-align: right; background-color: #CCC" >
                                                                     
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table >
                                                            <tr>
                                                                <td >
                                                                    <font size="4px;">   Juros (%)</font><font style="color: red">  </font>
                                                                </td>
                                                                <td align="right" >
                                                                    <font size="4px;">  (+) Valor do Juros R$  </font><font style="color: red">  </font>
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
                                                                    <input type="text" readonly="true" value="0" onkeypress="return SomenteNumero(event);"   maxlength="3" minlength="1"  id="juros2" name="juros2"  class="input" style="height: 30px; width: 200px; text-align: right; background-color: #CCC" >
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table >
                                                            <tr>
                                                                <td >
                                                                    <font size="4px;">   Multa (%)</font><font style="color: red">  </font>
                                                                </td>
                                                                <td align="right" >
                                                                    <font size="4px;">  (+) Valor da Multa R$  </font><font style="color: red">  </font>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <input type="text" onkeypress="return SomenteNumero(event);" 
                                                                           onkeyup="document.getElementById('multa2').value = ((this.value / 100) * <?php echo $valor_curso; ?>); atualizar_valor_pagar();"
                                                                           maxlength="3" minlength="1" placeholder="% da multa" id="multa" name="multa"  class="input" style="height: 30px; width: 200px; " >
                                                                </td>
                                                                <td align="right">
                                                                    <input type="text" readonly="true" value="0" onkeypress="return SomenteNumero(event);"   maxlength="3" minlength="1"  id="multa2" name="multa2"  class="input" style="height: 30px; width: 200px; text-align: right; background-color: #CCC" >
                                                                </td>
                                                            </tr>
                                                        </table>
                                                         <?php
                                                            $query21 = "SELECT *, b.descricao as bolsa FROM bolsa_aluno ba
                                    inner join bolsa_periodo bp on bp.bolsa_periodo_id = ba.bolsa_periodo_id
                                    inner join bolsas b on b.bolsas_id = bp.bolsas_id
                                    inner join periodo_letivo pl on pl.periodo_letivo_id = bp.periodo_letivo_id
                                    
                                                         where ba.matricula_aluno_turma_id = $matricula_aluno_turma_id_pg and b.tipo = 1 order by bolsa_aluno_id desc";
                                                            // ECHO  $query2;
                                                            $MatrizArrayt21 = $this->db->query($query21)->result_array();
                                                            $soma_bolsa2 = 0;
                                                            foreach ($MatrizArrayt21 as $row_turma21):
                                                                $bolsa = $row_turma21['bolsa'];
                                                                $porcentagem_bolsa2 = $row_turma21['porcentagem_bolsa'];
                                                                $soma_bolsa2 += $porcentagem_bolsa2;
                                                                //echo $soma_bolsa;
                                                               // $periodo_letivo = $row_turma2['periodo_letivo'];
                                                               // $periodo_letivo_id = $row_turma2['periodo_letivo_id'];
                                                                //$bolsa_periodo_id = $row_turma2['bolsa_periodo_id'];
                                                                
                                                               
                                                            endforeach;
                                                             $valor_bolsa2 = ($soma_bolsa2/ 100) *  $valor_curso;
                                                            ?>
                                                        <table >
                                                            <tr>
                                                                <td >
                                                                    <font size="4px;">   Bolsa (%)</font><font style="color: red">  </font>
                                                                </td>
                                                                <td align="right" >
                                                                    <font size="4px;">  (-) Valor da Bolsa R$  </font><font style="color: red">  </font>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                           
                                                            ?>

                                                            <tr>
                                                                <td>
                                                                    <input type="text" value="<?php echo $soma_bolsa2; ?>" onkeypress="return SomenteNumero(event);" 
                                                                           onkeyup="document.getElementById('bolsa2').value = ((this.value / 100) * <?php echo $valor_curso; ?>); atualizar_valor_pagar();"
                                                                           maxlength="3" minlength="1" placeholder="% da bolsa" id="bolsa" name="bolsa"  class="input" style="height: 30px; width: 200px;" >
                                                                </td>
                                                                <td align="right">
                                                                    <input type="text" readonly="true" value="<?php echo $valor_bolsa2; ?>" onkeypress="return SomenteNumero(event);"   maxlength="3" minlength="1"  id="bolsa2" name="bolsa2"  class="input" style="height: 30px; width: 200px; text-align: right; background-color: #CCC" >
                                                                </td>
                                                            </tr>
                                                        </table>
                                                     <?php
                                                            $query22 = "SELECT *, b.descricao as bolsa FROM bolsa_aluno ba
                                    inner join bolsa_periodo bp on bp.bolsa_periodo_id = ba.bolsa_periodo_id
                                    inner join bolsas b on b.bolsas_id = bp.bolsas_id
                                    inner join periodo_letivo pl on pl.periodo_letivo_id = bp.periodo_letivo_id
                                    
                                                         where ba.matricula_aluno_turma_id = $matricula_aluno_turma_id_pg and b.tipo = 2 order by bolsa_aluno_id desc";
                                                            // ECHO  $query2;
                                                            $MatrizArrayt22 = $this->db->query($query22)->result_array();
                                                            $soma_bolsa22 = 0;
                                                            foreach ($MatrizArrayt22 as $row_turma22):
                                                                $bolsa = $row_turma22['bolsa'];
                                                                $porcentagem_bolsa22 = $row_turma22['porcentagem_bolsa'];
                                                                $soma_bolsa22 += $porcentagem_bolsa22;
                                                                //echo $soma_bolsa;
                                                               // $periodo_letivo = $row_turma2['periodo_letivo'];
                                                               // $periodo_letivo_id = $row_turma2['periodo_letivo_id'];
                                                                //$bolsa_periodo_id = $row_turma2['bolsa_periodo_id'];
                                                                
                                                               
                                                            endforeach;
                                                            $novo_valorcurso = $valor_curso - $valor_bolsa2;
                                                            $valor_bolsa22 = ($soma_bolsa22/ 100) * $novo_valorcurso;
                                                            // echo 'valor_financiamento :'.$valor_bolsa22;
                                                            ?>
                                                        <table >
                                                            <tr>
                                                                <td >
                                                                    <font size="4px;">   Financiamento (%)</font><font style="color: red">  </font>
                                                                </td>
                                                                <td align="right" >
                                                                    <font size="4px;">  (-) Vl Financiamento R$  </font><font style="color: red">  </font>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                           
                                                            ?>

                                                            <tr>
                                                                <td>
                                                                    <input type="text" value="<?php echo $soma_bolsa22; ?>" onkeypress="return SomenteNumero(event);" 
                                                                           onkeyup="document.getElementById('financiamento2').value = ((this.value / 100) * <?php echo $novo_valorcurso; ?>); atualizar_valor_pagar();"
                                                                           maxlength="3" minlength="1" placeholder="% da bolsa" id="financiamento" name="financiamento"  class="input" style="height: 30px; width: 200px;" >
                                                                </td>
                                                                <td align="right">
                                                                    <input type="text" readonly="true" value="<?php echo $valor_bolsa22; ?>" onkeypress="return SomenteNumero(event);"   maxlength="3" minlength="1"  id="financiamento2" name="financiamento2"  class="input" style="height: 30px; width: 200px; text-align: right; background-color: #CCC" >
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table>
                                                            <tr>
                                                                <td align="right">
                                                                    <font size="4px;">   Valor a Pagar R$</font><font style="color: red">  </font>
                                                                </td>
                                                                <td align="right">
                                                                    <font size="4px;">   Valor Pago R$</font><font style="color: red">  </font>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <input  type="text" readonly="true" name="valor_pago2"  id="valor_pago2" value="<?php echo $valor_curso2; ?>"   onKeyPress="return(MascaraMoeda1(this, '.', ',', event))"   class="input" style=" height: 30px; width: 200px; text-align: right; background-color: #CCC" >

                                                                </td>
                                                                <td>
                                                                    <input  type="text" required="true" value="0" name="valor_pago"  id="valor_pago"  onKeyPress="return(MascaraMoeda1(this, '.', ',', event))"   class="input" style="height: 30px; width: 200px; text-align: right;" >
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <font size="4px;">Mensagem para o comprovante de pagamento</font>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td> <div id='historico'>
                                                                        <textarea class="input" name="historico" style="height: 50px; width: 400px;">

                                                                        </textarea></div>
                                                                </td>
                                                            </tr>

                                                        </table>
                                                        <br>
                                                        <div >
                                                            <table>
                                                                <tr>
                                                                    <td width="20%">
                                                                        <font size="4px;">Deseja Gerar Mensalidades para o aluno?</font>
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
                                                                        <input type="text" onkeypress="mascara(this, mdata);" maxlength="10" minlength="10" placeholder="99/99/9999" id="calendario3" name="vencimento_mensalidade"  class="input" style="height: 30px; width: 410px;" >
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
                                                                        <input type="text"  placeholder="R$ 0.000,00" value="<?php echo $valor_curso2; ?>" name="valor_mensalidade" onKeyPress="return(MascaraMoeda1(this, '.', ',', event))" id="valor_mask"  class="input" style="height: 30px; width: 410px;" >
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
                                                   


                                                    <div class="modal-footer">
                                                         <a  href="index.php?admin/situacao_financeiro_aluno/<?php echo $matricula; ?>">
                                                        <input type="button" value="Cancelar" class="btn btn-default btn-small" >
                                                        
                                                    </a>
                                                        <button type="submit" class="btn btn-green" >Confirmar</button>
                                                    </div>
                                                    </form>
                                                </table>                  
                                              </div>    
        </div>
                                    </div>
                                </div>
                                <!-- /.portlet -->
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
