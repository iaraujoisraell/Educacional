<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<nav style=" position:fixed;
  z-index:999; " class="navbar-top" role="navigation">

            <!-- begin BRAND HEADING -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle pull-right" data-toggle="collapse" data-target=".sidebar-collapse">
                    <i class="fa fa-bars"></i> Menu
                </button>
                <div class="navbar-brand">
                    <a href="index.php">
                        <img style="width: 240px; height: 60px; margin-top: -18px;" src="<?php echo base_url();?>uploads/logo_login.png" data-1x="<?php echo base_url();?>uploads/logo_login.png" data-2x="<?php echo base_url();?>uploads/logo_login.png" class="hisrc img-responsive" alt="">
                    </a>
                </div>
            </div>
            <!-- end BRAND HEADING -->

            <div class="nav-top">

                <!-- begin LEFT SIDE WIDGETS -->
                <ul class="nav navbar-left">
                    <li class="tooltip-sidebar-toggle">
                        <a href="#" id="sidebar-toggle" data-toggle="tooltip" data-placement="right" title="Tela Cheia">
                            <i class="fa fa-bars"></i>
                        </a>
                    </li>
                    <li style="margin-top: 10px; margin-left: 15px;">
                       <font style="color: #FFFEEF;  font-size: 20px;">   Portal do Professor - Fbnovas </font>
                    </li>
                    <!-- You may add more widgets here using <li> -->
                </ul>
                <!-- end LEFT SIDE WIDGETS -->

                <!-- begin MESSAGES/ALERTS/TASKS/USER ACTIONS DROPDOWNS -->
                <ul class="nav navbar-right">

                    <!-- begin MESSAGES DROPDOWN -->
                   
                    <!-- /.dropdown -->
                    <!-- end MESSAGES DROPDOWN -->

                    <!-- begin ALERTS DROPDOWN -->
                   
                    <!-- /.dropdown -->
                    <!-- end ALERTS DROPDOWN -->

                    <!-- begin TASKS DROPDOWN -->
                   <!-- /.dropdown -->
                    <!-- end TASKS DROPDOWN -->

                    <!-- begin USER ACTIONS DROPDOWN -->
                    <li style="margin-top: 10px;">
                       <font style="color: #FFFEEF;  font-size: 20px;">   <?php echo $this->session->userdata('nome'); ?> </font>
                    </li>
                    <li class="dropdown">
                    
                        <li>
                        <a href="<?php echo base_url(); ?>index.php?login/logout" class="btn btn-blue">
                            <strong>Sair</strong>
                        </a>
                    </li>
                        <!-- /.dropdown-menu -->
                    </li>
                    <div id="logout">
            
        </div>
                    <!-- /.dropdown -->
                    <!-- end USER ACTIONS DROPDOWN -->

                </ul>
                <!-- /.nav -->
                <!-- end MESSAGES/ALERTS/TASKS/USER ACTIONS DROPDOWNS -->

            </div>
            <!-- /.nav-top -->
        </nav>