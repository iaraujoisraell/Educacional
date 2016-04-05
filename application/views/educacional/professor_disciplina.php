<div class="box">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">



            <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo get_phrase('Professor/Disciplina'); ?>
                </a>
            </li>

            <li>
                <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                    <?php echo get_phrase('nova_disciplina'); ?>
                </a>
            </li>
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
                            <?php
                            $count = 1;
                            $professor_id = '';
                            foreach ($professor as $row1):
                                $professor_id = $row1['teacher_id'];
                                ?>
                                <h3><?php echo $row1['name']; ?> </h3>
                            <?php endforeach; ?>
                            <?php foreach ($disciplina as $row): ?>
                            <?php endforeach; ?>
                            <span>Total <?php echo count($disciplina); ?> Disciplina(s)</span>

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
                                <th><div><?php echo get_phrase('Periodo_letivo'); ?></div></th>
                                <th><div><?php echo get_phrase('Curso'); ?></div></th>   
                                <th><div><?php echo get_phrase('Turma'); ?></div></th>
                  
                                <th><div><?php echo get_phrase('Período.'); ?></div></th>
                                <th><div><?php echo get_phrase('Disciplina'); ?></div></th>

                                <th><div><?php echo get_phrase('Opções'); ?></div></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($disciplina as $row):
                                        $periodo = $row['periodo'];

                                        if ($periodo == '1') {
                                            $periodo2 = 'I';
                                        } else if ($periodo == '2') {
                                            $periodo2 = 'II';
                                        } else if ($periodo == '3') {
                                            $periodo2 = 'III';
                                        } else if ($periodo == '4') {
                                            $periodo2 = 'IV';
                                        } else if ($periodo == '5') {
                                            $periodo2 = 'V';
                                        } else if ($periodo == '6') {
                                            $periodo2 = 'VI';
                                        } else if ($periodo == '7') {
                                            $periodo2 = 'VII';
                                        } else if ($periodo == '8') {
                                            $periodo2 = 'VIII';
                                        }
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td ><?php echo $row['periodo_letivo']; ?></td>
                                            <td><?php echo $row['cur_tx_abreviatura']; ?></td>
                                            <td><?php echo $row['tur_tx_descricao']; ?> - <?php echo $row['descricao']; ?></td> 
                                            
                                            <td><?php echo $periodo2; ?></td>
                                            <td><?php echo $row['disc_tx_descricao']; ?></td>
                                            <td align="center">
                                                <a data-toggle="modal" href="#modal-form" onclick="modal('editar_disciplina',<?php echo $row['matriz_disciplina_id']; ?>)"	class="btn btn-black btn-small">
                                                    <i class="icon-print"></i> <?php echo get_phrase('p._ensino'); ?>
                                                </a>
                                                <a data-toggle="modal" href="#modal-form" onclick="modal('editar_disciplina',<?php echo $row['matriz_disciplina_id']; ?>)"	class="btn btn-info btn-small">
                                                    <i class="icon-print"></i> <?php echo get_phrase('m._nota'); ?>
                                                </a>
                                                <a data-toggle="modal" href="#modal-form" onclick="modal('editar_disciplina_professor',<?php echo $row['professor_turma_id']; ?>,<?php echo $row['cursos_id']; ?>,<?php echo $row['periodo']; ?>)"	class="btn btn-gray btn-small">
                                                    <i class="icon-wrench"></i> <?php echo get_phrase('editar'); ?>
                                                </a>
                                                <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url(); ?>index.php?educacional/matriz_disciplina/delete/<?php echo $row['matriz_disciplina_id']; ?>/<?php echo $row['disciplina_id']; ?>/<?php echo $row['matriz_id']; ?>')"
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
                    <?php echo form_open('educacional/professor_disciplina/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <form method="post" action="<?php echo base_url(); ?>index.php?educacional/professor_disciplina/create/" class="form-horizontal validatable" enctype="multipart/form-data">
                        <input type="hidden" class="validate[required]"  name="cod_professor" value="<?php echo $professor_id; ?>"/>

                        <div class="padded">
                            <table width="100%" border="0" class="responsive">
                                <tbody>                                    
                                    <tr>
                                        <td width="25%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('curso'); ?></label>
                                                <div class="controls">
                                                    <?php $curso_turma = $this->crud_model->get_curso_turma(); ?>
                                                    <select id="curso" name="curso" onchange="buscar_turma();">
                                                        <option value="0">Selecione um curso</option>
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

                                    </tr>


                                    <tr>
                                        <td>
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('turma'); ?></label>

                                                <div class="controls" id="load_turma">
                                                    <select name="turma" id="turma" >
                                                        <option value="">Selecione a turma</option>
                                                    </select>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>




                                    <tr>
                                        <td width="25%">
                                            <div class="control-group">
                                                <label class="control-label"><?php echo get_phrase('disciplina'); ?></label>
                                                <div class="controls" id="load_disciplina">
                                                    <select name="disciplina" id="disciplina" >
                                                        <option value="">Selecione a disciplina</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>


                                    </tr>



                                </tbody>
                            </table>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo get_phrase('cadastrar_disciplina_para_o_professor'); ?></button>
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


    function buscar_turma() {
        var curso = $('#curso').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (curso) {
            var url = 'index.php?educacional/carrega_turma/' + curso;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_turma').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }

    function buscar_disciplina() {

        var turma = $('#turma').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (turma) {

            var url = 'index.php?educacional/carrega_disciplina/' + turma;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_disciplina').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }

</script>