<?php
/*
  $codigo_usuario = $_SESSION["usuario_id"];

  $sql22 = "SELECT * FROM usuario u
  inner join usuario_perfil up on up.usu_nb_codigo = u.usu_nb_codigo
  inner join perfil p on p.per_nb_codigo = up.per_nb_codigo
  inner join empresa e on e.emp_nb_codigo = p.emp_nb_codigo
  where u.usu_nb_codigo = $codigo_usuario group by p.per_nb_codigo";
  //echo $sql2;
  $pesq22 = mysql_query($sql22);

  $linha22 = mysql_fetch_array($pesq22);
  $codigo_empresa = $linha22['emp_nb_codigo'];
  $logo_empresa = $linha22['emp_tx_url_logo'];
  $nome_empresa = $linha22['emp_tx_nome_empresa'];
  $perfil_codigo = $linha22["per_nb_codigo"];




 * 
 */
?>
<!DOCTYPE html>
<html lang="en">

    <?php include 'application/views/header.php'; ?>
    <!-- PAGE LEVEL PLUGIN STYLES -->
    <link href="<?php echo base_url(); ?>template/dashboard/css/plugins/morris/morris.css" rel="stylesheet">




    <body>

        <div  id="wrapper">

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

                    <!-- begin PAGE TITLE ROW -->
                   
                    <!-- /.row -->
                    <!-- end PAGE TITLE ROW -->

                    <div class="row">

                      
                        <!-- /.col-lg-12 -->

                       
                        <!-- /.col-lg-12 -->

                        <div class="col-lg-12">
                            <div class="portlet portlet-blue">
                                <div class="portlet-heading">
                                    <div class="portlet-title">
                                        <h4>Balanço Mensal</h4>
                                    </div>
                                    <div class="portlet-widgets">
                                        <a href="javascript:;"><i class="fa fa-refresh"></i></a>
                                        <span class="divider"></span>
                                        <a data-toggle="collapse" data-parent="#accordion" href="#barChart"><i class="fa fa-chevron-down"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="barChart" class="panel-collapse collapse in">
                                    <div class="portlet-body">
                                        <div id="morris-chart-bar"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Bar Chart Example -->
                        <div class="col-lg-12">
                            <div class="portlet portlet-blue">
                                <div class="portlet-heading">
                                    <div class="portlet-title">
                                        <h4>Contas a Receber</h4>
                                    </div>
                                    <div class="portlet-widgets">
                                        <a href="javascript:;"><i class="fa fa-refresh"></i></a>
                                        <span class="divider"></span>
                                        <a data-toggle="collapse" data-parent="#accordion" href="#barChart"><i class="fa fa-chevron-down"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="barChart" class="panel-collapse collapse in">
                                    <div class="portlet-body">
                                        <div id="morris-chart-bar-receber"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="portlet portlet-blue">
                                <div class="portlet-heading">
                                    <div class="portlet-title">
                                        <h4>Contas a Pagar</h4>
                                    </div>
                                    <div class="portlet-widgets">
                                        <a href="javascript:;"><i class="fa fa-refresh"></i></a>
                                        <span class="divider"></span>
                                        <a data-toggle="collapse" data-parent="#accordion" href="#barChart"><i class="fa fa-chevron-down"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="barChart" class="panel-collapse collapse in">
                                    <div class="portlet-body">
                                        <div id="morris-chart-bar-pagar"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-lg-6 -->

                        <!-- Donut Chart Example -->
                        
                        <!-- /.col-lg-6 -->

                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.page-content -->

            </div>
            <!-- /#page-wrapper -->
            <!-- end MAIN PAGE CONTENT -->

        </div>
        <!-- /#wrapper -->

        <!-- GLOBAL SCRIPTS -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/bootstrap/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/popupoverlay/jquery.popupoverlay.js"></script>
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/popupoverlay/defaults.js"></script>
        <!-- Logout Notification Box -->
        <div id="logout">
            <div class="logout-message">
                <br><br>
                 <ul class="list-inline">
                    <li>
                        <a href="<?php echo base_url(); ?>index.php?login/logout" class="btn btn-green">
                            <strong>Sair</strong>
                        </a>
                    </li>
                    <li>
                        <button class="logout_close btn btn-green">Cancelar</button>
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

        <!-- /#logout -->
        <!-- Logout Notification jQuery -->

        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/popupoverlay/logout.js"></script>
        <!-- HISRC Retina Images -->
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/hisrc/hisrc.js"></script>

        <!-- PAGE LEVEL PLUGIN SCRIPTS -->
        <!-- Morris Charts -->
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/morris/raphael-2.1.0.min.js"></script>
        <script src="<?php echo base_url(); ?>template/dashboard/js/plugins/morris/morris.js"></script>
        <!-- Morris Demo/Dummy Data -->

        <script type="text/javascript">
                   
                 
                    //Morris Line Chart
                   
                    //Morris Bar Chart

                    //Morris Bar Chart
                    Morris.Bar({
                    element: 'morris-chart-bar',
                            data: [
<?php
$total_nr = 0;
foreach ($numrows as $nrow):
    $total_nr = $nrow['mes'];
endforeach;
$count = 1;
foreach ($barchart as $row):

    $mes_bd = $row['mes'];
    $ano = $row['ano'];

    if ($mes_bd == '1') {
        $mes = 'JAN';
        $dt_inicial = $ano . '0101';
        $dt_final = $ano . '0131';
    } else if ($mes_bd == '2') {
        $mes = 'FEV';
        $dt_inicial = $ano . '0201';
        $dt_final = $ano . '0229';
    } else if ($mes_bd == '3') {
        $mes = 'MAR';
        $dt_inicial = $ano . '0301';
        $dt_final = $ano . '0331';
    } else if ($mes_bd == '4') {
        $mes = 'ABR';
        $dt_inicial = $ano . '0401';
        $dt_final = $ano . '0430';
    } else if ($mes_bd == '5') {
        $mes = 'MAI';
        $dt_inicial = $ano . '0501';
        $dt_final = $ano . '0531';
    } else if ($mes_bd == '6') {
        $mes = 'JUN';
        $dt_inicial = $ano . '0601';
        $dt_final = $ano . '0630';
    } else if ($mes_bd == '7') {
        $mes = 'JUL';
        $dt_inicial = $ano . '0701';
        $dt_final = $ano . '0731';
    } else if ($mes_bd == '8') {
        $mes = 'AGO';
        $dt_inicial = $ano . '0801';
        $dt_final = $ano . '0831';
    } else if ($mes_bd == '9') {
        $mes = 'SET';
        $dt_inicial = $ano . '0901';
        $dt_final = $ano . '0930';
    } else if ($mes_bd == '10') {
        $mes = 'OUT';
        $dt_inicial = $ano . '1001';
        $dt_final = $ano . '1031';
    } else if ($mes_bd == '11') {
        $mes = 'NOV';
        $dt_inicial = $ano . '1101';
        $dt_final = $ano . '1130';
    } else if ($mes_bd == '12') {
        $mes = 'DEZ';
        $dt_inicial = $ano . '1201';
        $dt_final = $ano . '1231';
    }
    $empresa = $this->session->userdata('empresa');
    $valor_entrada_saida = $this->db->query('select (select sum(mf_db_valor) from siga_financeiro.conta_pagar_receber cpr
 join siga_financeiro.movimento_financeiro mf on mf.cpr_nb_codigo = cpr.conta_pagar_receber_id where cpr_nb_tipo = 1 and cpr_dt_vencimento between ' . $dt_inicial . ' and ' . $dt_final . ') as entrada,
               (select sum(mf_db_valor) from siga_financeiro.conta_pagar_receber cpr
inner join siga_financeiro.movimento_financeiro mf on mf.cpr_nb_codigo = cpr.conta_pagar_receber_id where cpr_nb_tipo = 2 and cpr_dt_vencimento between ' . $dt_inicial . ' and ' . $dt_final . ') as saida
        from siga_financeiro.conta_pagar_receber cpr
inner join siga_financeiro.movimento_financeiro mf on mf.cpr_nb_codigo = cpr.conta_pagar_receber_id
where cpr_dt_vencimento between ' . $dt_inicial . ' and ' . $dt_final . ' group by entrada')->result_array();

    foreach ($valor_entrada_saida as $nrow1):
        $entrada = $nrow1['entrada'];
        if($entrada == null){
            $entrada = 0;
        }
     
        $saida = $nrow1['saida'];
       if($saida == null){
            $saida = 0;
        }
        $saldo = $entrada - $saida;
        if($saldo == null){
            $saldo = 0;
        }
        // echo 'entrada : '.$entrada;
        // echo 'Saída : '.$saida;
        ?>
                                    {y: '<?php echo $mes; ?>/<?php echo $ano; ?>', a: <?php echo $entrada; ?>, b:<?php echo $saida; ?>, c: '<?php echo $saldo; ?>'},
        <?php
    endforeach;
    $count++;
endforeach;
?>
                                                ],
                                                xkey: 'y',
                                                ykeys: ['a', 'b', 'c'],
                                                labels: ['Entrada', 'Saída', 'Saldo'],
                                                barColors: ['#398439', '#e74c3c', '#005580'],
                                                resize: true
                                        });
                                        /*
                                         * CONTAS A RECEBER
                                         * 
                                         */
                                        //Morris Bar Chart
                                        Morris.Bar({
                                        element: 'morris-chart-bar-receber',
                                                data: [
<?php
$total_nr = 0;
foreach ($numrows as $nrow):
    $total_nr = $nrow['mes'];
endforeach;
$count = 1;
foreach ($barchart as $row):

    $mes_bd = $row['mes'];
    $ano = $row['ano'];

    if ($mes_bd == '1') {
        $mes = 'JAN';
        $dt_inicial = $ano . '0101';
        $dt_final = $ano . '0131';
    } else if ($mes_bd == '2') {
        $mes = 'FEV';
        $dt_inicial = $ano . '0201';
        $dt_final = $ano . '0229';
    } else if ($mes_bd == '3') {
        $mes = 'MAR';
        $dt_inicial = $ano . '0301';
        $dt_final = $ano . '0331';
    } else if ($mes_bd == '4') {
        $mes = 'ABR';
        $dt_inicial = $ano . '0401';
        $dt_final = $ano . '0430';
    } else if ($mes_bd == '5') {
        $mes = 'MAI';
        $dt_inicial = $ano . '0501';
        $dt_final = $ano . '0531';
    } else if ($mes_bd == '6') {
        $mes = 'JUN';
        $dt_inicial = $ano . '0601';
        $dt_final = $ano . '0630';
    } else if ($mes_bd == '7') {
        $mes = 'JUL';
        $dt_inicial = $ano . '0701';
        $dt_final = $ano . '0731';
    } else if ($mes_bd == '8') {
        $mes = 'AGO';
        $dt_inicial = $ano . '0801';
        $dt_final = $ano . '0831';
    } else if ($mes_bd == '9') {
        $mes = 'SET';
        $dt_inicial = $ano . '0901';
        $dt_final = $ano . '0930';
    } else if ($mes_bd == '10') {
        $mes = 'OUT';
        $dt_inicial = $ano . '1001';
        $dt_final = $ano . '1031';
    } else if ($mes_bd == '11') {
        $mes = 'NOV';
        $dt_inicial = $ano . '1101';
        $dt_final = $ano . '1130';
    } else if ($mes_bd == '12') {
        $mes = 'DEZ';
        $dt_inicial = $ano . '1201';
        $dt_final = $ano . '1231';
    }
    
   $valor_entrada_entrada = $this->db->query('select (select sum(cpr_db_valor) from siga_financeiro.conta_pagar_receber '
           . 'where cpr_nb_tipo = 1 and cpr_dt_vencimento between ' . $dt_inicial . ' and ' . $dt_final . ') as entrada,
               (select sum(mf_db_valor) from siga_financeiro.movimento_financeiro mf 
              inner join siga_financeiro.conta_pagar_receber cpr on cpr.conta_pagar_receber_id = mf.cpr_nb_codigo
                where cpr_nb_tipo = 1 and cpr_dt_vencimento between ' . $dt_inicial . ' and ' . $dt_final . ') as recebido
        from siga_financeiro.conta_pagar_receber cpr
        inner join siga_financeiro.movimento_financeiro mf on mf.cpr_nb_codigo = cpr.conta_pagar_receber_id
where cpr_dt_vencimento between ' . $dt_inicial . ' and ' . $dt_final . '  group by entrada')->result_array();

    foreach ($valor_entrada_entrada as $nrowentrada):
        $ventrada = $nrowentrada['entrada'];
        if ($ventrada == null) {
            $ventrada = 0;
        }
        $vsaida = $nrowentrada['recebido'];

        if ($vsaida == null) {
            $vsaida = 0;
        }

        // echo 'entrada : '.$ventrada;
        //echo 'Saída : '.$vsaida;
        ?>
                                                        {y: '<?php echo $mes; ?>/<?php echo $ano; ?>', a: <?php echo $ventrada; ?>, b:<?php echo $vsaida; ?>},
        <?php
    endforeach;
    $count++;
endforeach;
?>
                                                                    ],
                                                                    xkey: 'y',
                                                                    ykeys: ['a', 'b'],
                                                                    labels: ['A Receber', 'Recebido'],
                                                                    barColors: ['#005580', '#398439'],
                                                                    resize: true
                                                            });
                                                            
                                                            
/*
* A PAGAR
 */      
  Morris.Bar({
                                        element: 'morris-chart-bar-pagar',
                                                data: [
 <?php
$total_nr = 0;
foreach ($numrows as $nrow):
    $total_nr = $nrow['mes'];
endforeach;
$count = 1;
foreach ($barchart as $row):

    $mes_bd = $row['mes'];
    $ano = $row['ano'];

    if ($mes_bd == '1') {
        $mes = 'JAN';
        $dt_inicial = $ano . '0101';
        $dt_final = $ano . '0131';
    } else if ($mes_bd == '2') {
        $mes = 'FEV';
        $dt_inicial = $ano . '0201';
        $dt_final = $ano . '0229';
    } else if ($mes_bd == '3') {
        $mes = 'MAR';
        $dt_inicial = $ano . '0301';
        $dt_final = $ano . '0331';
    } else if ($mes_bd == '4') {
        $mes = 'ABR';
        $dt_inicial = $ano . '0401';
        $dt_final = $ano . '0430';
    } else if ($mes_bd == '5') {
        $mes = 'MAI';
        $dt_inicial = $ano . '0501';
        $dt_final = $ano . '0531';
    } else if ($mes_bd == '6') {
        $mes = 'JUN';
        $dt_inicial = $ano . '0601';
        $dt_final = $ano . '0630';
    } else if ($mes_bd == '7') {
        $mes = 'JUL';
        $dt_inicial = $ano . '0701';
        $dt_final = $ano . '0731';
    } else if ($mes_bd == '8') {
        $mes = 'AGO';
        $dt_inicial = $ano . '0801';
        $dt_final = $ano . '0831';
    } else if ($mes_bd == '9') {
        $mes = 'SET';
        $dt_inicial = $ano . '0901';
        $dt_final = $ano . '0930';
    } else if ($mes_bd == '10') {
        $mes = 'OUT';
        $dt_inicial = $ano . '1001';
        $dt_final = $ano . '1031';
    } else if ($mes_bd == '11') {
        $mes = 'NOV';
        $dt_inicial = $ano . '1101';
        $dt_final = $ano . '1130';
    } else if ($mes_bd == '12') {
        $mes = 'DEZ';
        $dt_inicial = $ano . '1201';
        $dt_final = $ano . '1231';
    }

    $valor_entrada_entrada = $this->db->query('select (select sum(cpr_db_valor) from siga_financeiro.conta_pagar_receber '
            . 'where cpr_nb_tipo = 2 and cpr_dt_vencimento between ' . $dt_inicial . ' and ' . $dt_final . ') as entrada,
               (select sum(mf_db_valor) from siga_financeiro.movimento_financeiro mf 
               join siga_financeiro.conta_pagar_receber cpr on cpr.conta_pagar_receber_id = mf.cpr_nb_codigo
                where cpr_nb_tipo = 2 and cpr_dt_vencimento '
            . 'between ' . $dt_inicial . ' and ' . $dt_final . ') as recebido
        from siga_financeiro.conta_pagar_receber cpr
        inner join siga_financeiro.movimento_financeiro mf on mf.cpr_nb_codigo = cpr.conta_pagar_receber_id
where cpr_dt_vencimento between ' . $dt_inicial . ' and ' . $dt_final . '  group by entrada')->result_array();

    foreach ($valor_entrada_entrada as $nrowentrada):
        $ventrada = $nrowentrada['entrada'];
        if ($ventrada == null) {
            $ventrada = 0;
        }
        $vsaida = $nrowentrada['recebido'];

        if ($vsaida == null) {
            $vsaida = 0;
        }

        // echo 'entrada : '.$ventrada;
        //echo 'Saída : '.$vsaida;
        ?>
                                                        {y: '<?php echo $mes; ?>/<?php echo $ano; ?>', a: <?php echo $ventrada; ?>, b:<?php echo $vsaida; ?>},
        <?php
    endforeach;
    $count++;
endforeach;
?>
                                                                    ],
                                                                    xkey: 'y',
                                                                    ykeys: ['a', 'b'],
                                                                    labels: ['A Pagar', 'Pago'],
                                                                    barColors: ['#EC6459', '#398439'],
                                                                    resize: true
                                                            });
        </script>
        
        
    </body>
    <div style="color: #EC6459">

    </div>
</html>
