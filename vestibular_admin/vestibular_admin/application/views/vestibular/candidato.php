<div class="box">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo get_phrase('lista_candidato'); ?>
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
                            <img src="<?php echo base_url(); ?>template/images/icons_menu/candidato.png" />
                            <span>Total <?php echo count($candidato); ?> Candidatos</span>
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
                                <th><div><?php echo get_phrase('nome'); ?></div></th>                                
                                <th><div><?php echo get_phrase('CPF'); ?></div></th>
                                <th><div><?php echo get_phrase('telefone'); ?></div></th>
                                <th><div><?php echo get_phrase('Op 1'); ?></div></th>
                                <th><div><?php echo get_phrase('vestibular'); ?></div></th>
                                <th><div><?php echo get_phrase('chamada'); ?></div></th>
                                <th><div><?php echo get_phrase('situação'); ?></div></th>
                                <th><div><?php echo get_phrase('options'); ?></div></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($candidato as $row):
                                        $resposta = $row['cv_nb_resposta'];
                                        //  echo 'resposta'.$resposta;
                                        if ($resposta == '0') {
                                            $chamada = 'Presente';
                                        } else if ($resposta == '1') {
                                            $chamada = 'Ausente';
                                        } else if ($resposta == null) {
                                            $chamada = '';
                                        }

                                        $situacao = $row['cv_nb_aprovado'];

                                        if ($situacao == '1') {
                                            $status = 'Aprovado';
                                        } else if ($situacao == '0') {
                                            $status = 'Reprovado';
                                        } else if ($situacao == null) {
                                            $status = '';
                                        }

                                        $opcao1 = $row['can_tx_op01'];
                                        if ($opcao1 == 1) {
                                            $txopcao1 = 'CT';
                                        } else if ($opcao1 == 2) {
                                            $txopcao1 = 'PED';
                                        } else if ($opcao1 == 3) {
                                            $txopcao1 = 'ADM';
                                        } else if ($opcao1 == 4) {
                                            $txopcao1 = 'JOR';
                                        } else if ($opcao1 == 5) {
                                            $txopcao1 = 'PP';
                                        }
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $row['nome']; ?></td>                                         
                                            <td><?php echo $row['can_tx_cpf']; ?></td>
                                            <td><?php echo $row['can_tx_celular']; ?></td>
                                            <td><?php echo  $txopcao1; ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($row['vest_dt_realizacao'])); ?></td>
                                            <td><?php echo $chamada; ?></td>
                                            <td><?php echo $status; ?></td>

                                            <td align="center">
                                                <a data-toggle="modal" href="#modal-form" onclick="modal('candidato_profile',<?php echo $row['candidato_id']; ?>)"
                                                   class="btn btn-default btn-small">
                                                    <i class="icon-user"></i> <?php echo get_phrase('profile'); ?>
                                                </a>
                                                <a data-toggle="modal" href="#modal-form" onclick="modal('candidato_editar',<?php echo $row['candidato_id']; ?>)"class="btn btn-gray btn-small">
                                                    <i class="icon-wrench"></i> <?php echo get_phrase('editar'); ?>
                                                </a>
                                                <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url(); ?>index.php?admin/candidato/delete/<?php echo $row['candidato_id']; ?>')"
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