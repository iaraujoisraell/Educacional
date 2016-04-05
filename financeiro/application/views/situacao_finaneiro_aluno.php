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
        
         var base_url = "<?php base_url() ?>/educacional";
  
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
                                                <div style="margin-left: 15px; "  class="tab-pane fade in active">                            
                                                     <table class="table  table-striped  " width="100%"  cellpadding="0" cellspacing="0" border="0" >
                                            
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
                                                                    $periodo_letivo2 = $row_mt22['periodo_letivo'];
                                                                endforeach;
                                                                $ano_igresso = $periodo_letivo2;
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
                                                                        <?php echo $periodo_atual2; ?> º

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
                                                    <table class="table  table-striped   " width="100%" cellpadding="0" cellspacing="0" border="0" >
                                                    <?php  if ($bolsista == 1) { 
                                                            $sql_mt2 = "SELECT *, b.descricao as bolsa
                                                                        FROM bolsa_aluno ba
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
                                                                        where m.matricula_aluno_id = $matricula and pl.atual = 1 order by bolsa_aluno_id desc";
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
                                                            <i class="icon-wrench"></i> <?php echo get_phrase('Ficha_aluno'); ?>
                                                        </a>
                                                        <a  href="index.php?admin/historico_financeiro_aluno/<?php echo $matricula; ?>"  class="btn btn-blue btn-small">
                                                            <i class="icon-money"></i> <?php echo get_phrase('gerenciar_pagamentos'); ?>
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
                                            <div id="situacao_financeira_table">
                                            <table class="table lista-clientes table-striped table-bordered table-hover table-green " width="100%" style="border: 5px;" cellpadding="0" cellspacing="0" border="0" >
                                                <thead >
                                                    <tr>
                                                         <td style="background-color: #2C3E50; color: #ffffff"><div>ID</div></td>
                                                        <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Período_letivo'); ?></div></td>
                                                       
                                                        <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Turma'); ?></div></td>
                                                        <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('Período'); ?></div></td>
                                                        <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('turno'); ?></div></td>
                                                        <td style="background-color: #2C3E50; color: #ffffff" align="left"><div><?php echo get_phrase('situação'); ?></div></td>
                                                        <td style="background-color: #2C3E50; color: #ffffff"><div><?php echo get_phrase('opções'); ?></div></td>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql = "SELECT mat.matricula_aluno_turma_id as matricula_aluno_turma_id, t.turma_id, t.ano as ano, t.semestre as semestre,
                                                        mat.periodo as periodo_mat, t.periodo_letivo_id,tur_tx_descricao,tu.turno_id, mat.dependencia as dependencia,
                                                        tu.descricao as turno, p.periodo_id, p.periodo as periodo, 
                                                        pl.periodo_letivo as periodo_letivo_pl,
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
                                                        $periodo_letivo = $row2['periodo_letivo_pl'];
                                                        
                                                        if ($periodo_letivo) {
                                                            $periodo_letivo = $row2['periodo_letivo_pl'];
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
                                                        $turma_desc = $row2['tur_tx_descricao'];
                                                        //$sql.=" order by nome asc ";
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $count++; ?></td>
                                                            <td align="left"><?php echo $periodo_letivo; ?></td>
                                                            <td align="left"><?php echo $row2['tur_tx_descricao']; ?></td>
                                                            <td align="left"><?php echo $periodo; ?></td>
                                                            <td align="left"><?php echo $row2['turno']; ?> </td>
                                                            <td align="left"><?php echo $situacao2; ?><font style="font-size: 9px; color: #DD1144;"><?php echo $dependencia_tx; ?></font></td>
                                                            <td align="center">
                                                                <?php if($situacao == '1' ){ ?>
                                                                <a  href="index.php?admin/situacao_financeiro_aluno_pagamento/<?php echo $matricula; ?>/<?php echo $matricula_aluno_turma_id; ?>">
                                                        <input type="button" value="Realizar Pagamento" class="btn btn-blue btn-small" >
                                                        
                                                    </a>
                                                                 <?php }else if($situacao == '2' ){ ?> 
                                                              <a  href="index.php?admin/carne_impressao/<?php echo $matricula; ?>/<?php echo $matricula_aluno_turma_id; ?>" target="_blank" class="btn btn-gray btn-small">
                                                                 <button href="javascript:;" class="btn btn-primary"  ><i class="fa fa-print"> </i> Carnê</button></a>
                                                             <?php }?> 
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
           var valor_pagar = <?php echo $valor_curso; ?>;
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
        <?php 
        $meses_atrasados = "<script>document.write(meses_atrasados)</script>";
       //  echo "$meses_atrasados";
        ?>
    
        <!-- *********************** NOVO REGISTRO ******************************  -->
         <div class="modal modal-flex fade" id="flexModal" tabindex="-1" role="dialog" aria-labelledby="flexModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="flexModalLabel">Pagamento Referente a Matrícula</h4>
                    </div>

                    <?php echo form_open('admin/situacao_financeiro_aluno/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                        <input type="hidden" value="<?php echo $matricula; ?>" name="matricula_aluno_id" id="matricula_aluno_id">
                        <input type="hidden"  name="matricula_aluno_turma_id_situacao" id="matricula_aluno_turma_id_situacao">
                        <input type="hidden" value="<?php echo $row2['periodo_letivo']; ?>" name="periodo_letivo" id="periodo_letivo">
                        <input type="hidden"  name="matricula_aluno_turma_id_situacao_teste" id="matricula_aluno_turma_id_situacao_teste">
                 
                        <div style="margin:auto; width: 450px;" class="modal-body">
                            

                            <table>
                                <tr>
                                    <td>
                                        <font size="4px;">   Aluno </font>
                                    </td>
                                    <td>
                                        <font size="4px;">  Período Letívo </font>
                                    </td>
                                </tr>
                                <tr>
                                    <td >
                                        <input type="text" disabled="true" value="<?php echo $row['registro_academico']; ?> - <?php echo $nome_aluno; ?>" name="nome" class="input" style="height: 30px; width: 310px;">
                                    </td>
                                    <td>
                                        <input type="text" disabled  id="periodo_letivo_novo_registro" name="periodo_letivo_novo_registro"  class="input" style="height: 30px; width: 100px;">
                                    </td>
                                </tr>
                            </table>
                            
                            <table  >
                                <tr>
                                    <td>
                                        <font size="4px;">  Bolsa(s) e Financiamento(s) </font>
                                    </td>
                                </tr>
                                <script> 
                                    var mat_id =  document.getElementById('matricula_aluno_turma_id_situacao_teste').value; 
                                    
                                </script> 
                                <a href="#" onclick="alert(document.getElementById('matricula_aluno_turma_id_situacao_teste').value);" >valor</a>
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
                                                    where ba.matricula_aluno_turma_id = $matricula_aluno_turma_id order by bolsa_aluno_id desc";
                                    // ECHO  $query2;
                                 $MatrizArrayt2 = $this->db->query($query2)->result_array();
                                 $soma_bolsa = 0;
                                  foreach ($MatrizArrayt2 as $row_turma2):
                                 $bolsa = $row_turma2['bolsa'];
                                 $porcentagem_bolsa = $row_turma2['porcentagem_bolsa']; 
                                 $soma_bolsa += $porcentagem_bolsa;
                                  echo $soma_bolsa;
                                        $periodo_letivo = $row_turma2['periodo_letivo'];
                                        $periodo_letivo_id = $row_turma2['periodo_letivo_id'];
                                        $bolsa_periodo_id = $row_turma2['bolsa_periodo_id'];
                                        $periodo = $row_turma2['periodo'];
                                        if ($periodo) {
                                            $periodo2 = $row_turma2['periodo'];
                                        } else {
                                            $periodo = $row_turma2['periodo_mat'];
                                        }

                                        if ($periodo2 == 1) {
                                            $periodo = 'I';
                                        } else if ($periodo2 == 2) {
                                            $periodo = 'II';
                                        } else if ($periodo2 == 3) {
                                            $periodo = 'III';
                                        } else if ($periodo2 == 4) {
                                            $periodo = 'IV';
                                        } else if ($periodo2 == 5) {
                                            $periodo = 'V';
                                        } else if ($periodo2 == 6) {
                                            $periodo = 'VI';
                                        } else if ($periodo2 == 7) {
                                            $periodo = 'VII';
                                        } else if ($periodo2 == 8) {
                                            $periodo = 'VIII';
                                        } else if ($periodo2 == 9) {
                                            $periodo = 'IX';
                                        } else if ($periodo2 == 10) {
                                            $periodo = 'X';
                                        }
                                        ?>
                            
                                <tr>
                                    <td >      
                                    <input type="text"  disabled="true" value="<?php echo $bolsa; ?> <?php ' ' ?> <?php echo $row_turma2['porcentagem_bolsa']; ?>%" name="nome" class="input" style="height: 30px; width: 410px; text-transform:uppercase;">
                                
                                    </td>
                                </tr>
                            
                                <?php
                                endforeach;
                                ?>
                          </table>

                            
                            <div id="load_disciplinas"></div>
                                
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
                                        <input type="text" onkeypress="mascara(this, mdata);" value="<?php echo $data_pagamento_hoje; ?>" maxlength="10" minlength="10" placeholder="99/99/9999" id="calendario3" name="pagamento" id="pagamento" required="true" class="input" style="height: 30px; width: 200px;" >
                                    </td>
                                    <td>
                                        <input type="text" onkeypress="mascara(this, mdata);" value="<?php echo $data_vencimento_pgto; ?>" maxlength="10" minlength="10" placeholder="99/99/9999" id="calendario3" name="pagamento2" id="pagamento2" required="true" class="input" style="height: 30px; width: 200px;" >
                                 
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
                                        <font style="text-align: right" >   <input type="text" placeholder="R$ 0.000,00" disabled="true" value="<?php echo $valor_curso2; ?>" name="valor_curso" onKeyPress="return(MascaraMoeda1(this, '.', ',', event))" id="valor_curso" required="true" class="input" style="height: 30px; width: 200px;text-align: right; " ></font>
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
                                        <input type="text" onkeypress="return SomenteNumero(event);" onkeyup="document.getElementById('desconto2').value = ((this.value / 100) * <?php echo $valor_curso; ?>); atualizar_valor_pagar();"  maxlength="3" minlength="1" placeholder="% de desconto" id="calendario3" id="desconto" name="desconto"  class="input" style="height: 30px; width: 200px;" >
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
                            <table >
                                <tr>
                                    <td >
                                        <font size="4px;">   Bolsa (%)</font><font style="color: red">  </font>
                                    </td>
                                    <td align="right" >
                                        <font size="4px;">   Valor da Bolsa R$  </font><font style="color: red">  </font>
                                    </td>
                                </tr>
                                
                                
                                <tr>
                                    <td>
                                        <input type="text" value="<?php echo $soma_bolsa; ?>" onkeypress="return SomenteNumero(event);" 
                                               onkeyup="document.getElementById('multa2').value = ((this.value / 100) * <?php echo $valor_curso; ?>); atualizar_valor_pagar();"
                                                           maxlength="3" minlength="1" placeholder="% da bolsa" id="multa" name="multa"  class="input" style="height: 30px; width: 200px;" >
                                    </td>
                                    <td align="right">
                                        <input type="text" readonly="true" onkeypress="return SomenteNumero(event);"   maxlength="3" minlength="1"  id="multa2" name="multa2"  class="input" style="height: 30px; width: 200px; text-align: right;" >
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
                                                 <input  type="text" readonly="true" name="valor_pago2"  id="valor_pago2" value="<?php echo $valor_curso2; ?>"   onKeyPress="return(MascaraMoeda1(this, '.', ',', event))"   class="input" style=" height: 30px; width: 200px; text-align: right;" >
                                
                                      </td>
                                    <td>
                                        <input  type="text" required="true" name="valor_pago"  id="valor_pago"  onKeyPress="return(MascaraMoeda1(this, '.', ',', event))"   class="input" style="height: 30px; width: 200px; text-align: right;" >
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
                                        <input type="text" onkeypress="mascara(this, '##/##/####')" maxlength="10" minlength="10" placeholder="99/99/9999" id="calendario3" name="vencimento_mensalidade"  class="input" style="height: 30px; width: 410px;" >
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
                                        <input type="text"  placeholder="R$ 0.000,00" name="valor_mensalidade" onKeyPress="return(MascaraMoeda1(this, '.', ',', event))" id="valor_mask"  class="input" style="height: 30px; width: 410px;" >
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
