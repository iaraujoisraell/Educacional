<div class="container-fluid padded">
    <div class="row-fluid">
        <div class="span30">
            <!-- find me in partials/action_nav_normal -->
            <!--big normal buttons-->
            <div class="action-nav-normal">
                <div class="row-fluid">
                    <?php
                    if ($nome_modulo == "") {
                        foreach ($modulos as $row):
                            ?>
                            <div class="span2 action-nav-button">
                                <a href="<?php echo base_url(); ?><?php echo $row['mod_tx_url'] ?>">
                                    <img src="<?php echo base_url(); ?><?php echo $row['mod_tx_url_imagem']; ?>" />
                                    <span><?php echo get_phrase($row['nome']); ?></span>
                                </a>
                            </div>
                            <?php
                        endforeach;
                    }else {

                        $usuarios_id = $this->session->userdata('login');
                        $menusArray = $this->db->query("select menus.nome as nome, men_tx_url, men_tx_url_image, men_tx_tabela from usuarios
                                        INNER JOIN perfis  ON usuarios.perfis_id = perfis.perfis_id
                                        INNER JOIN acessos ON perfis.perfis_id = acessos.perfis_id
                                        INNER JOIN menus   ON acessos.menus_id = menus.menus_id
                                        INNER JOIN modulos ON menus.modulos_id = modulos.modulos_id
                                        WHERE usuarios_id = $usuarios_id AND modulos.nome = '$nome_modulo' ORDER BY nome")->result_array();


                        foreach ($menusArray as $rowMenus):
                            ?>
                            <div class="span2 action-nav-button">
                                <a href="<?php echo base_url(); ?><?php echo $rowMenus['men_tx_url'] ?>">
                                    <img src="<?php echo base_url(); ?><?php echo $rowMenus['men_tx_url_image']; ?>" />
                                    <span><?php echo get_phrase($rowMenus['nome']); ?></span>
                                    <span class="label label-blue"><?php echo $this->db->count_all_results($rowMenus['men_tx_tabela']); ?></span>
                                </a>
                            </div>
                            <?php
                        endforeach;
                    }
                    ?>


                  

                </div>
            </div>
            <!---DASHBOARD MENU BAR ENDS HERE-->
        </div>

        
        
        <?php
      // if ($nome_modulo == "Educacional") {
            include 'application/views/graficos/graficos_educacional.php';
        //}
        ?>    



    </div>


  