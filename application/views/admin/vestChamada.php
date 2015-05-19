<div class="box">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo get_phrase('lista_vestibular'); ?>
                </a></li>
            <li>
                <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                    <?php echo get_phrase('add_vestibular'); ?>
                </a></li>
        </ul>
        <!------CONTROL TABS END------->

    </div>
    <div class="box-content padded">
        <div class="tab-content">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane  active" id="list">
                <div class="action-nav-normal">
                    <div class=" action-nav-button" style="width:300px;">
                        <a href="#" title="Users">
                            <img src="<?php echo base_url(); ?>template/images/icons_menu/chamada.png" />
                            <span>Total <?php echo count($chamadaVest); ?> Vestibular</span>
                        </a>
                    </div>
                </div>
                <div class="box">
                    <div class="box-content">
                        <div id="dataTables">
                            <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                                <thead>
                                    <tr>
                                        <th><div>ID</div></th>
                                <th><div><?php echo get_phrase('ano'); ?></div></th>
                                <th width="17%"><div><?php echo get_phrase('data_realização'); ?></div></th>
                                <th><div><?php echo get_phrase('tipo'); ?></div></th>
                                <th><div><?php echo get_phrase('status'); ?></div></th>
                                <th width="15%"><div><?php echo get_phrase('Qtd_Inscritos'); ?></div></th>
                                <th><div><?php echo get_phrase('options'); ?></div></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($chamadaVest as $row):
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $row['anoS']; ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($row['vest_dt_realizacao'])); ?></td>
                                            <td><?php echo $row['tipo_vestibular']; ?></td>
                                            <td><?php
                                                if ($row['vest_dt_realizacao'] >= date('Y-m-d')) {
                                                    echo "Aberto";
                                                } else {
                                                    echo "Fechado";
                                                }
                                                ?></td>
                                            <td>
                                                <?php
                                                $data = $row['vest_dt_realizacao'];
                                                $qtd_inscritos = $this->db->query("SELECT COUNT(*) as qtd from vestibular INNER JOIN candidato ON vestibular.vestibular_id = candidato.vest_nb_codigo WHERE vest_dt_realizacao = '$data'")->result_array();
                                                foreach ($qtd_inscritos as $rowInsc):

                                                    echo $rowInsc['qtd'];

                                                endforeach;
                                                ?>
                                            </td>
                                            <td align="center">
                                                <a data-toggle="modal" href="#modal-form" onclick="modal('chamada_vestibular',<?php echo $row['vestibular_id']; ?>)"
                                                   class="btn btn-default btn-small">
                                                    <i class="icon-star"></i> <?php echo get_phrase('chamada'); ?>
                                                </a>

                                                <a data-toggle="modal" href="#modal-form" onclick="modal('pontuacao_vestibular',<?php echo $row['vestibular_id']; ?>)"
                                                   class="btn btn-default btn-small">
                                                    <i class="icon-pencil"></i> <?php echo get_phrase('pontuação'); ?>
                                                </a>

                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!----TABLE LISTING ENDS--->

            <!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('admin/teacher/create', array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <form method="post" action="<?php echo base_url(); ?>index.php?admin/teacher/create/" class="form-horizontal validatable" enctype="multipart/form-data">
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('name'); ?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="name"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('birthday'); ?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up" name="birthday"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('sex'); ?></label>
                                <div class="controls">
                                    <select name="sex" class="uniform" style="width:100%;">
                                        <option value="male"><?php echo get_phrase('male'); ?></option>
                                        <option value="female"><?php echo get_phrase('female'); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('address'); ?></label>
                                <div class="controls">
                                    <input type="text" class="" name="address"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('phone'); ?></label>
                                <div class="controls">
                                    <input type="text" class="" name="phone"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('email'); ?></label>
                                <div class="controls">
                                    <input type="text" class="" name="email"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('password'); ?></label>
                                <div class="controls">
                                    <input type="text" class="" name="password"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('photo'); ?></label>
                                <div class="controls" style="width:210px;">
                                    <input type="file" class="" name="userfile" id="imgInp" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"></label>
                                <div class="controls" style="width:210px;">
                                    <img id="blah" src="<?php echo base_url(); ?>uploads/user.jpg" alt="your image" height="100" />
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo get_phrase('add_teacher'); ?></button>
                        </div>
                    </form>                
                </div>                
            </div>
            <!----CREATION FORM ENDS--->

        </div>
    </div>
</div>
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

    $("#imgInp").change(function () {
        readURL(this);
    });
</script>