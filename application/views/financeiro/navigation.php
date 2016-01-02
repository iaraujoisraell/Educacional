<div class="sidebar-background">
    <div class="primary-sidebar-background">
    </div>
</div>
<div class="primary-sidebar">
    <!-- Main nav -->
    <br />
    <div style="text-align:center;">
        <a href="<?php echo base_url(); ?>">
            <img src="<?php echo base_url(); ?>uploads/logo.png"  style="max-height:100px; max-width:100px;"/>
        </a>
    </div>
    <br />
    <ul class="nav nav-collapse collapse nav-collapse-primary">


        <!------dashboard----->
        <li class="<?php if ($page_name == 'dashboard') echo 'dark-nav active'; ?>">
            <span class="glow"></span>
            <a href="<?php echo base_url(); ?>index.php?admin/dashboard" rel="tooltip" data-placement="right" 
               data-original-title="<?php echo get_phrase('dashboard_help'); ?>">
                               <!--<i class="icon-desktop icon-1x"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/home.png" />
                <span><?php echo get_phrase('painel_administrativo'); ?></span>
            </a>
        </li>

        <?php
        foreach ($modulos as $row):
            ?>
            <li class="<?php if ($page_name == $row['nome']) echo 'dark-nav active'; ?>">
                <span class="glow"></span>
                <a href="<?php echo base_url(); ?><?php echo $row['men_tx_url'] ?>" rel="tooltip" data-placement="right" 
                   data-original-title="<?php echo get_phrase('teacher_help'); ?>">
                                   <!--<i class="icon-user icon-1x"></i>-->
                    <img src="<?php echo base_url(); ?><?php echo $row['mod_tx_url_imagem']; ?>"/>
                    <span><?php echo get_phrase($row['nome']); ?></span>
                </a>
            </li>       

            <?php
        endforeach;
        ?>      
    </ul>
</div>