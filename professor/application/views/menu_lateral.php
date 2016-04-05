<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<nav style=" position:fixed;
  z-index:999; " class="navbar-side" role="navigation">
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
                    <span><font style="color:#2C3E50; ">R. Acadêmico</font><i class="icon-caret-down"></i></span>
                    
                </a>
               </li>
            </br>
            <li>
                <a class="active" href="<?php echo base_url(); ?>index.php?admin/minhas_disciplinas">
                    <i class="fa fa-money"></i> Minhas Disciplinas
                </a>
            </li>
                <li>
                <a class="active" href="<?php echo base_url(); ?>index.php?admin/minhas_disciplinas_plano_ensino">
                    <i class="fa fa-cogs"></i> Plano de Ensino
                </a>

            </li>
                
                <li>
                <a class="active" href="<?php echo base_url(); ?>index.php?admin/minhas_disciplinas_mapa_nota">
                    <i class="fa fa-cogs"></i> Mapa de Notas
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
                <a class="active" href="<?php echo base_url(); ?>index.php?admin/consulta_disciplinas">
                    <i class="fa fa-user"></i> Disciplinas
                </a>

            </li>
           
            <li>
            
            <!-- end DASHBOARD LINK -->

        </ul>
        <!-- /.side-nav -->
    </div>
    <!-- /.navbar-collapse -->
</nav>