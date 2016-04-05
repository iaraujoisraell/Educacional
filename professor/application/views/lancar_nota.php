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
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }



        function buscar_paginacao_receber_pagamento(pdt_id) {
          var pdt_id = pdt_id;
          var disciplina_id = $('#disciplina_id').val();
          var turma_id = $('#turma_id').val();
          var bimestre = $('#bimestre').val();
            //se encontrou o estado
                var url = 'index.php?admin/carrega_table_lancar_nota/'+ disciplina_id + '/' + turma_id + '/' + bimestre;  //caminho do arquivo php que irá buscar as cidades no BD
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

                    
                    <!-- begin PAGE TITLE AREA -->
                    <!-- Use this section for each page's title and breadcrumb layout. In this example a date range picker is included within the breadcrumb. -->
                    <div  class="row">
                        <div class="col-lg-12">
                            <div class="page-title">
                                <h1>Lançar Nota</h1>
                                <ol class="breadcrumb">
                                    <li><i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                                    </li>
                                    <li class="active">Lançar Nota</li>
                                </ol>
                            </div>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <?php
                    
                    
                     foreach ($turma as $row):
                        $pdt_id = $row['pdt_id'];
                        $turma = $row['turma'];
                        $periodo_letivo = $row['periodo_letivo'];
                        $turma_id = $row['turma_id'];
                        $disciplina = $row['disciplina'];
                        $professor_nome = $row['professor'];
                        $disciplina_id = $row['disciplina_id'];
                         $ch = $row['carga_horaria'];
                      endforeach;
                      
                         
                     
                        ?>
                    <div class="row">
                            <?php echo form_open('admin/lancar_nota/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                                            
                      
                        <input type="hidden" id="disciplina_id" name="disciplina_id" value="<?php echo $disciplina_id; ?>">
                        <input type="hidden" id="turma_id" name="turma_id" value="<?php echo $turma_id; ?>"> 
                        <input type="hidden" id="pdt_id" name="pdt_id" value="<?php echo $pdt_id; ?>"> 
                        <input type="hidden" id="bimestre" name="bimestre" value="<?php echo $bimestre; ?>"> 
                        <input type="hidden" id="ch" name="ch" value="<?php echo $ch; ?>"> 
                        
                         <table class="table  table-striped   " width="100%" cellpadding="0" cellspacing="0" border="0" >
                                                    <tr>
                                                        <td width="40%" >
                                                            <div class="control-group">
                                                                <label style="font-weight: bold " class="control-label"><?php echo get_phrase('TURMA : '); ?><?php echo $turma; ?></label>

                                                            </div>
                                                        </td>

                                                        <td width="40%">
                                                            <div class="control-group">
                                                                <label style="font-weight: bold " class="control-label"><?php echo get_phrase('DISCIPLINA : '); ?><?php echo $disciplina; ?></label>

                                                            </div>
                                                        </td>

                                                        
                                                    </tr>
                                                </table>
                                                <table class="table  table-striped   " width="100%" cellpadding="0" cellspacing="0" border="0" >

                                                    <tr>

                                                        <td width="40%">
                                                            <div class="control-group">
                                                                <label style="font-weight: bold " class="control-label"><?php echo get_phrase('PROFESSOR : '); ?><?php echo $professor_nome; ?></label>

                                                            </div>
                                                        </td>
                                                        <td width="40%">
                                                            <div class="control-group">
                                                                <label style="font-weight: bold " class="control-label"><?php echo $bimestre; ?><?php echo get_phrase(' BIMESTRE '); ?> - <?php echo $periodo_letivo; if($bimestre == 'III'){ ?> (Obs: Não lançar a nota com peso 2 calculado. o Sistema irá calcular.) <?php } ?></label>

                                                            </div>
                                                        </td>

                                                    </tr>
                                                </table>
                         <div class="row">
                        <div class="col-lg-12">

                            <div class="portlet portlet-default">
                                <div class="portlet-heading">

                                    <div class="clearfix"></div>
                                </div>
                                
                                <div class="portlet-body">
                                    <div class="table-responsive">  
                                       
                                        <br>

                                        <div id="load_paginacao_rp">
                                            <script>
                                            buscar_paginacao_receber_pagamento(<?php echo $pdt_id; ?>);
                                            </script>
                                        </div>
                                    </div>
                                     <div class="modal-footer">
                        
                                    <button type="submit" class="btn btn-blue" >Registrar Lançamento de Notas</button>
                                    
                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.portlet -->
                    </div>
                        </form>
                    </div>
                    <!-- /.row -->
                    <!-- end PAGE TITLE AREA -->
                   
                </div>
            </div>
        </div>
        <!-- /#page-wrapper -->
        <!-- end MAIN PAGE CONTENT -->
  
  



    <style>
        .container {
            margin-top: 50px;
        }
    </style>

    
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
