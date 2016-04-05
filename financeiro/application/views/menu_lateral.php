<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<nav class="navbar-side" role="navigation">
    <div class="navbar-collapse sidebar-collapse collapse">
        <ul id="side" class="nav navbar-nav side-nav">
            <!-- begin SIDE NAV USER PANEL -->
            
            <!-- end SIDE NAV USER PANEL -->
            <!-- begin SIDE NAV SEARCH -->
            
            <!-- end SIDE NAV SEARCH -->
            <!-- begin DASHBOARD LINK -->
           <li>
            <a style="background-color: #E0E7E8;" class="accordion-toggle  " data-toggle="collapse"  rel="tooltip" data-placement="right" >
                    <font style="color: #2C3E50;"> <i  class="fa fa-money"></i></font>
                    <span><font style="color:#2C3E50; ">Movimentos Financeiros</font><i class="icon-caret-down"></i></span>
                    
                </a>
               </li>
            </br>
            <li>
                <a class="active" href="<?php echo base_url(); ?>index.php?admin/receber_pagamento">
                    <i class="fa fa-money"></i> Receber Pag. de Alunos
                </a>
            </li>
           <li>
                <a class="active" href="<?php echo base_url(); ?>index.php?admin/contas_receber_avulso">
                    <i class="fa fa-smile-o"></i> Receber Pag. Avulsos
                </a>
            </li>
            <li>
                <a class="active" href="<?php echo base_url(); ?>index.php?admin/despesas">
                    <i class="fa fa-frown-o"></i> Contas a Pagar 
                </a>
            </li>
            <?php
            /*
            <li>
                <a class="active" href="<?php echo base_url(); ?>index.php?admin/contas_receber">
                    <i class="fa fa-smile-o"></i> Contas a Receber 
                </a>
            </li>
         */  ?>        
            
            <li>
            <a style="background-color: #E0E7E8;" class="accordion-toggle  " data-toggle="collapse"  rel="tooltip" data-placement="right" >
                    <font style="color: #2C3E50;"> <i  class="fa fa-search"></i></font>
                    <span><font style="color:#2C3E50;">Consulta</font><i class="icon-caret-down"></i></span>
                </a>
                 </li>
           
            <li>
                <a class="active" href="<?php echo base_url(); ?>index.php?admin/receber_pagamento">
                    <i class="fa fa-user"></i> Aluno
                </a>

            </li>
            <li>
            <a style="background-color: #E0E7E8;" class="accordion-toggle  " data-toggle="collapse"  rel="tooltip" data-placement="right" >
                    <font style="color: #2C3E50;"> <i  class="fa fa-bookmark-o"></i></font>
                    <span><font style="color:#2C3E50;">Cadastros</font><i class="icon-caret-down"></i></span>
                </a>
            </li>
            
            <li>
                <a class="active" href="<?php echo base_url(); ?>index.php?admin/fornecedor">
                    <i class="fa fa-cogs"></i> Fornecedor
                </a>

            </li>

            
            <li>
                <a class="active" href="<?php echo base_url(); ?>index.php?admin/categoria">
                    <i class="fa fa-filter"></i> Categoria
                </a>
            </li>
            </hr>
            
            <li>
                <a class="active" href="<?php echo base_url(); ?>index.php?admin/produto_pagamento">
                    <i class="fa fa-shopping-cart"></i> Produtos
                </a>
            </li>
            <li>
            <a style="background-color: #E0E7E8;" class="accordion-toggle  " data-toggle="collapse"  rel="tooltip" data-placement="right" >
                    <font style="color: #2C3E50;"> <i  class="fa fa-bar-chart-o"></i></font>
                    <span><font style="color:#2C3E50;">Relatórios</font><i class="icon-caret-down"></i></span>
                </a>
                 </li>
                 <li>
                <a class="active" href="<?php echo base_url(); ?>index.php?admin/fluxo_caixa">
                    <i class="fa fa-arrows-h"></i> Fluxo de Caixa
                </a>
            </li>
            <!-- end DASHBOARD LINK -->

        </ul>
        <!-- /.side-nav -->
    </div>
    <!-- /.navbar-collapse -->
</nav>