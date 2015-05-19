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
                            <img src="<?php echo base_url(); ?>template/images/icons_menu/vestibular.png" />
                            <span>Total <?php echo count($vestibular); ?> Vestibular</span>
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
                                <th width="80"><div><?php echo get_phrase('ano'); ?></div></th>
                                <th><div><?php echo get_phrase('semestre'); ?></div></th>
                                <th><div><?php echo get_phrase('data_realização'); ?></div></th>
                                <th><div><?php echo get_phrase('tipo'); ?></div></th>
                                <th><div><?php echo get_phrase('status'); ?></div></th>
                                <th><div><?php echo get_phrase('options'); ?></div></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($vestibular as $row):
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $row['vest_nb_ano']; ?></td>
                                            <td><?php
                                                if ($row['vest_tx_semestre'] == '1') {
                                                    echo "I Semestre";
                                                } else if ($row['vest_tx_semestre'] == '2') {
                                                    echo "II Semestre";
                                                }
                                                ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($row['vest_dt_realizacao'])); ?></td>
                                            <td><?php
                                                if ($row['vest_nb_tipo'] == 1) {
                                                    echo "Macro";
                                                } else if ($row['vest_nb_tipo'] == '2') {
                                                    echo "Agendado";
                                                }
                                                ?></td>
                                            <td><?php
                                                if ($row['vest_dt_realizacao'] >= date('Y-m-d')) {
                                                    echo "Aberto";
                                                } else {
                                                    echo "Fechado";
                                                }
                                                ?></td>
                                            <td align="center">
                                                <a data-toggle="modal" href="#modal-form" onclick="modal('teacher_profile',<?php echo $row['teacher_id']; ?>)"
                                                   class="btn btn-default btn-small">
                                                    <i class="icon-user"></i> <?php echo get_phrase('profile'); ?>
                                                </a>
                                                <a data-toggle="modal" href="#modal-form" onclick="modal('edit_vestibular',<?php echo $row['vestibular_id']; ?>)"	class="btn btn-gray btn-small">
                                                    <i class="icon-wrench"></i> <?php echo get_phrase('editar'); ?>
                                                </a>
                                                <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url(); ?>index.php?admin/vestibular/delete/<?php echo $row['vestibular_id']; ?>')"
                                                   class="btn btn-red btn-small">
                                                    <i class="icon-trash"></i> <?php echo get_phrase('deletar'); ?>
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
                    <?php echo form_open('admin/teacher/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <form method="post" action="<?php echo base_url(); ?>index.php?admin/teacher/create/" class="form-horizontal validatable" enctype="multipart/form-data">
                        <div class="padded">
                            <table width="100%" border="0" class="responsive">
                                <tbody>
                                    <tr>
                                        <td width="25%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('ano'); ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]" name="name"/>
                                                </div>
                                            </div>

                                        </td>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('semestre'); ?></label>
                                                <div class="controls">
                                                    <select>
                                                        <option value="I">I Semestre</option>
                                                        <option value="II">II Semestre</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td width="25%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('data_vestibular'); ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]" name="data_vestibular"/>
                                                </div>
                                            </div>

                                        </td>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('tipo'); ?></label>
                                                <div class="controls">
                                                    <select>
                                                        <option value="0">Macro</option>
                                                        <option value="1">Agendado</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td width="25%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('hora_inicio_prova'); ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]" name="data_vestibular"/>
                                                </div>
                                            </div>

                                        </td>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('hora_termino_prova'); ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]" name="data_vestibular"/>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td width="25%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('data_abertura_inscrições_vestibular'); ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]" name="data_vestibular"/>
                                                </div>
                                            </div>

                                        </td>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('data_encerramento_incrições_vestibular'); ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]" name="data_vestibular"/>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td width="25%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('data_divulgação_resultado'); ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]" name="data_vestibular"/>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo get_phrase('add_vestibular'); ?></button>
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