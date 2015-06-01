<div class="box">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo get_phrase('lista_turma'); ?>
                </a></li>
            <li>
                <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                    <?php echo get_phrase('nova_turma'); ?>
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
                            <span>Total <?php echo count($turma); ?> Turmas</span>
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
                                <th><div><?php echo get_phrase('descrição'); ?></div></th>
                                <th><div><?php echo get_phrase('periodo_letivo'); ?></div></th>
                                <th><div><?php echo get_phrase('status'); ?></div></th>
                                <th><div><?php echo get_phrase('periodo'); ?></div></th>
                                <th><div><?php echo get_phrase('matriz'); ?></div></th>
                                <th><div><?php echo get_phrase('options'); ?></div></th>

                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($turma as $row):
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $row['tur_tx_descricao']; ?></td>
                                            <td><?php echo $row['tur_tx_descricao']; ?></td>
                                            <td><?php echo $row['tur_tx_descricao']; ?></td>
                                            <td><?php echo $row['tur_nb_periodo']; ?> </td>
                                            <td><?php echo $row['porcentagem_maxima']; ?> </td>

                                            <td align="center">
                                                <a data-toggle="modal" href="#modal-form" onclick="modal('edit_vestibular',<?php echo $row['bolsas_id']; ?>)"	class="btn btn-gray btn-small">
                                                    <i class="icon-wrench"></i> <?php echo get_phrase('editar'); ?>
                                                </a>
                                                <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url(); ?>index.php?educacional/bolsas/delete/<?php echo $row['bolsas_id']; ?>')"
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
                    <?php echo form_open('educacional/bolsas/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <form method="post" action="<?php echo base_url(); ?>index.php?admin/teacher/create/" class="form-horizontal validatable" enctype="multipart/form-data">
                        <div class="padded">
                            <table width="100%" class="responsive">
                                <tbody>
                                    <tr>
                                        <td width="40%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('descrição'); ?></label>
                                                <div class="controls">
                                                    <input type="text" class="validate[required]" name="descricao"/>
                                                </div>
                                            </div>
                                        </td>


                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('perido_letivo'); ?></label>
                                                <div class="controls">
                                                    <?php $periodo_turma = $this->crud_model->get_periodo_turma(); ?>
                                                    <select>
                                                        <?php foreach ($periodo_turma as $row):
                                                            ?>
                                                            <option value="<?php echo $row['periodo_letivo_id'] ?>"><?php echo $row['periodo_letivo']; ?> </option>
                                                            <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td width="40%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('curso'); ?></label>
                                                <div class="controls">
                                                    <?php $curso_turma = $this->crud_model->get_curso_turma(); ?>
                                                    <select id="curso" name="curso" onchange="buscar_matriz()">
                                                        <?php foreach ($curso_turma as $row):
                                                            ?>
                                                            <option value="<?php echo $row['cursos_id'] ?>"><?php echo $row['cur_tx_descricao']; ?> </option>
                                                            <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('matriz'); ?></label>

                                                <div class="controls" id="load_matriz">
                                                    <select name="matriz" id="matriz">
                                                        <option value="">Selecione a matriz</option>
                                                    </select>
                                                </div>

                                            </div>
                                        </td>

                                    </tr>

                                </tbody>
                            </table>
                        </div>



                        <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo get_phrase('add_bolsa'); ?></button>
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

    function buscar_matriz() {
        var curso = $('#curso').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (curso) {
            var url = 'index.php?educacional/carrega_matriz/' + curso;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_matriz').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }

</script>