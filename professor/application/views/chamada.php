<html >
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="template/jquery.quick.search.js"></script>
    <?php include 'application/views/header.php'; ?>
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


        function buscar_municipio() {
            var uf = $('#uf_nascimento').val();  //codigo do estado escolhido
            //se encontrou o estado
            if (uf) {
                var url = 'index.php?admin/carrega_municipio/' + uf;  //caminho do arquivo php que irá buscar as cidades no BD
                $.get(url, function (dataReturn) {
                    $('#load_muncipio').html(dataReturn);  //coloco na div o retorno da requisicao
                });
            }
        }

        function buscar_cidade() {
            var uf2 = $('#uf').val();  //codigo do estado escolhido
            //se encontrou o estado
            if (uf2) {
                var url = 'index.php?admin/carrega_cidade/' + uf2;  //caminho do arquivo php que irá buscar as cidades no BD
                $.get(url, function (dataReturn) {
                    $('#load_cidade').html(dataReturn);  //coloco na div o retorno da requisicao
                });
            }
        }

        function buscar_deficiencia() {
            var deficiencia = $('#deficiencia').val();  //codigo do estado escolhido
            //se encontrou o estado
            if (deficiencia) {
                var url = 'index.php?admin/carrega_doencas/' + deficiencia;  //caminho do arquivo php que irá buscar as cidades no BD
                $.get(url, function (dataReturn) {
                    $('#load_doencas').html(dataReturn);  //coloco na div o retorno da requisicao
                });
            }
        }
        function buscar_matriz() {
            var curso = $('#curso').val();  //codigo do estado escolhido
            //se encontrou o estado
            if (curso) {
                var url = 'index.php?admin/carrega_matriz/' + curso;  //caminho do arquivo php que irá buscar as cidades no BD
                $.get(url, function (dataReturn) {
                    $('#load_matriz').html(dataReturn);  //coloco na div o retorno da requisicao
                });
            }
        }


        function buscar_turma_matricula() {
            var curso = $('#curso').val();  //codigo do estado escolhido
            //se encontrou o estado
            if (curso) {
                var url = 'index.php?admin/carrega_turma_matricula/' + curso;  //caminho do arquivo php que irá buscar as cidades no BD
                $.get(url, function (dataReturn) {
                    $('#load_turma_matricula').html(dataReturn);  //coloco na div o retorno da requisicao
                });
            }
        }
        function buscar_periodo_letivo() {
            var curso = $('#curso_busca').val();  //codigo do estado escolhido
            //se encontrou o estado
            if (curso) {
                var url = 'index.php?admin/carrega_periodo_letivo/' + curso;  //caminho do arquivo php que irá buscar as cidades no BD
                $.get(url, function (dataReturn) {
                    $('#load_periodo_letivo').html(dataReturn);  //coloco na div o retorno da requisicao
                });
            }
        }

        function buscar_turma() {
            var curso = $('#curso_busca').val();  //codigo do estado escolhido
            var periodo_letivo = $('#periodo_letivo_busca').val();

            //se encontrou o estado
            if (curso) {
                var url = 'index.php?admin/carrega_turma/' + curso + '/' + periodo_letivo;  //caminho do arquivo php que irá buscar as cidades no BD
                $.get(url, function (dataReturn) {
                    $('#load_turma').html(dataReturn);  //coloco na div o retorno da requisicao
                });
            }
        }

        function buscar_paginacao_receber_pagamento(pdt_id) {
          var pdt_id = pdt_id;
          var codigo_aula = $('#codigo_aula').val();
          var disciplina_id = $('#disciplina_id').val();
          var turma_id = $('#turma_id').val();
            //se encontrou o estado
                var url = 'index.php?admin/carrega_table_chamada/'+ disciplina_id + '/' + codigo_aula + '/' + turma_id;  //caminho do arquivo php que irá buscar as cidades no BD
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
                                <h1>Realizar Chamada</h1>
                                <ol class="breadcrumb">
                                    <li><i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                                    </li>
                                    <li class="active">Realizar Chamada</li>
                                </ol>
                            </div>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <?php
                     foreach ($turma as $row):
                        $pdt_id = $row['pdt_id'];
                        $turma = $row['turma'];
                        $turma_id = $row['turma_id'];
                        $disciplina = $row['disciplina'];
                        $professor_nome = $row['professor'];
                        $disciplina_id = $row['disciplina_id'];
                      endforeach;
                      
                          foreach ($aula as $row2):
                        $aula_id = $row2['aul_nb_codigo'];
                        $dt_aula = $row2['aul_dt_aula'];
                        $dt_aula = date("d/m/Y", strtotime($dt_aula)); 
                        
                      endforeach;
                      
                      $sql = "SELECT registro_academico, nome, md.disciplina_id, da.disciplina_aluno_id as da_codigo
                        FROM matricula_aluno_turma mat
                        inner join matricula_aluno ma on ma.matricula_aluno_id = mat.matricula_aluno_id
                        inner join cadastro_aluno ca on ca.cadastro_aluno_id = ma.cadastro_aluno_id
                        inner join disciplina_aluno da on da.matricula_aluno_turma_id = mat.matricula_aluno_turma_id
                        inner join matriz_disciplina md on md.matriz_disciplina_id = da.matriz_disciplina_id
                        where mat.turma_id = $turma_id and md.disciplina_id = $disciplina_id order by nome asc";
                        $MatrizArray = $this->db->query($sql)->result_array();
                        foreach ($MatrizArray as $row):
                            $matricula = $row['registro_academico'];
                            $nome = $row['nome'];
                            $da_codigo = $row['da_codigo'];

                            $query_cadastro = "SELECT * FROM chamada where aul_nb_codigo = '$aula_id ' and da_nb_codigo = '$da_codigo' "; // where mod_nb_codigo = '$id_modulo' ";
                            $linha_cadastro = $this->db->query($query_cadastro)->result_array();
                            $count_ch = 0;
                            foreach ($linha_cadastro as $row3):
                                $cod_chamada = $row3['cham_nb_codigo'];
                                $chamada_status = $row3['cham_nb_status'];
                                // echo $cod_chamada;
                                if ($cod_chamada) {
                                    $count_ch = 1;
                                }

                            endforeach;

                            if ($count_ch == 0) {
                                $data1['aul_nb_codigo'] = $aula_id;
                                $data1['da_nb_codigo'] = $da_codigo;
                                $data1['cham_nb_status'] = 1;
                                $this->db->insert('chamada', $data1);
                                $chamada_codigo = mysql_insert_id();
                            }
                        endforeach;
                        ?>
                    <div class="row">
                            <?php echo form_open('admin/minhas_disciplinas_chamada/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                                            
                        <input type="hidden" id="codigo_aula" name="codigo_aula" value="<?php echo $aula_id; ?>">
                        <input type="hidden" id="disciplina_id" name="disciplina_id" value="<?php echo $disciplina_id; ?>">
                        <input type="hidden" id="turma_id" name="turma_id" value="<?php echo $turma_id; ?>"> 
                        <input type="hidden" id="pdt_id" name="pdt_id" value="<?php echo $pdt_id; ?>"> 
                         
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
                                                                <label style="font-weight: bold " class="control-label"><?php echo get_phrase('DATA AULA : '); ?><?php echo $dt_aula; ?></label>

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
                        
                                    <button type="submit" class="btn btn-blue" >Registrar Chamada</button>
                                    
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
