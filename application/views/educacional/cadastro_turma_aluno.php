<div class="box">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">

            <li>
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo get_phrase('lista_aluno'); ?>
                </a>
            </li>

            <li class="active">
                <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                    <?php echo get_phrase('novo_aluno'); ?>
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
                            <img src="<?php echo base_url(); ?>template/images/icons_menu/vestibular.png" />
                            <span>Total <?php echo count($aluno); ?> Alunos</span>
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
                                <th><div><?php echo get_phrase('data_nascimento'); ?></div></th>
                                <th><div><?php echo get_phrase('sexo'); ?></div></th>
                                <th><div><?php echo get_phrase('RG'); ?></div></th>
                                <th><div><?php echo get_phrase('opções'); ?></div></th>

                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($aluno as $row):
                                        $periodo = $row['periodo_id'];
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $row['nome']; ?></td>
                                            <td><?php echo $row['cpf']; ?></td>
                                            <td><?php echo $row['data_nascimento']; ?></td>
                                            <td>

                                                <?php
                                                if ($row['sexo'] == 0) {

                                                    echo "Feminino";
                                                } else if ($row['sexo'] == 1) {

                                                    echo "Masculino";
                                                }
                                                ?>
                                            </td>                                          
                                            <td><?php echo $row['rg']; ?> </td>

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


                    <?php echo form_open('educacional/aluno/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <div class="padded">
                        <table width="100%" class="responsive">
                            <tbody>

                                <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('curso'); ?></label>
                                            <div class="controls">
                                                <select name="curso">
                                                    <option>Selecione o curso</option>
                                                    <?php
                                                    foreach ($cursos as $row):
                                                        ?>
                                                        <option value="<?php echo $row['cursos_id']; ?>"><?php echo $row['cur_tx_descricao']; ?></option>
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
                                            <div class="controls">
                                                <select name="matriz">
                                                    <option>Selecione a Matriz</option>
                                                    <?php
                                                    foreach ($matriz as $row_matriz):
                                                        ?>
                                                        <option value="<?php echo $row_matriz['matriz_id']; ?>"><?php echo $row_matriz['mat_tx_ano']; ?></option>
                                                        <?php
                                                    endforeach;
                                                    ?> 
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                        </br>
                        <b>DADOS PESSOAIS KAROLINEHUASDHAUDH</b>
                        <hr/>

                        <table width="100%" class="responsive">
                            <tbody>

                                <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('nome'); ?></label>
                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="nome"/>
                                            </div>
                                        </div>
                                    </td>


                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('cpf'); ?></label>
                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="cpf"/>

                                            </div>
                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('RG'); ?></label>
                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="rg"/>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('RG_UF'); ?></label>

                                            <div class="controls" id="load_matriz">
                                                <input type="text" class="validate[required]" name="rg_uf"/>
                                            </div>

                                        </div>
                                    </td>

                                </tr>

                                <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('RG_orgão_expeditor'); ?></label>
                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="rg_orgao_expeditor"/>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('data_nascimento'); ?></label>
                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="data_nascimento"/>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('pais_origem'); ?></label>

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="pais_origem"/>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('UF_nascimento'); ?></label>

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="uf_nascimento"/>
                                            </div>

                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('cidade_origem'); ?></label>

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="cidade_origem"/>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('sexo'); ?></label>

                                            <div class="controls">
                                                <select name="sexo">
                                                    <option>Selecione o Sexo</option>
                                                    <option value="0">Feminino</option>
                                                    <option value="1">Masculino</option>
                                                </select>
                                            </div>
                                        </div>
                                    </td>

                                </tr>



                                <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('estado_civil'); ?></label>

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="estado_civil"/>
                                            </div>

                                        </div>
                                    </td>



                            </tbody>
                        </table>

                        </br>
                        </b>ENDEREÇO</b>
                        <hr/>

                        <table width="100%" class="responsive">
                            <tbody>

                            <td>
                                <div class="control-group">
                                    <label class="control-label"><?php echo get_phrase('cep'); ?></label>

                                    <div class="controls">


                                        <input type="text" class="validate[required]" name="cep"/>


                                    </div>
                                </div>
                            </td>

                            </tr>



                            <tr>
                                <td width="40%">
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('endereco'); ?></label>

                                        <div class="controls">
                                            <input type="text" class="validate[required]" name="endereco"/>
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('bairro'); ?></label>

                                        <div class="controls">

                                            <input type="text" class="validate[required]" name="bairro"/>

                                        </div>
                                    </div>
                                </td>

                            </tr>

                            <tr>
                                <td width="40%">
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('complemento'); ?></label>

                                        <div class="controls">
                                            <input type="text" class="validate[required]" name="complemento"/>
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('UF'); ?></label>

                                        <div class="controls">

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="uf"/>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>


                            <tr>
                                <td width="40%">
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('cidade'); ?></label>

                                        <div class="controls">
                                            <input type="text" class="validate[required]" name="cidade"/>
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('titulo'); ?></label>

                                        <div class="controls">

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="titulo"/>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>



                            <tr>
                                <td width="40%">
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('uf_titulo'); ?></label>

                                        <div class="controls">
                                            <input type="text" class="validate[required]" name="uf_titulo"/>
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('fone'); ?></label>

                                        <div class="controls">

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="fone"/>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>




                            <tr>
                                <td width="40%">
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('celular'); ?></label>

                                        <div class="controls">
                                            <input type="text" class="validate[required]" name="celular"/>
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('email'); ?></label>

                                        <div class="controls">

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="email"/>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>


                            <tr>
                                <td width="40%">
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('nacionalidade'); ?></label>

                                        <div class="controls">
                                            <input type="text" class="validate[required]" name="nacionalidade"/>
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('cor'); ?></label>

                                        <div class="controls">

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="cor"/>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>



                            <tr>
                                <td width="40%">
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('mae'); ?></label>

                                        <div class="controls">
                                            <input type="text" class="validate[required]" name="mae"/>
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('pai'); ?></label>

                                        <div class="controls">

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="pai"/>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td width="40%">
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('conjuge'); ?></label>

                                        <div class="controls">
                                            <input type="text" class="validate[required]" name="conjuge"/>
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('uf_certidão_reservista'); ?></label>

                                        <div class="controls">

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="uf_certidao"/>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td width="40%">
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('documento_estrangeiro'); ?></label>

                                        <div class="controls">
                                            <input type="text" name="documento_estrangeiro"/>
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('certidão_reservista'); ?></label>

                                        <div class="controls">

                                            <div class="controls">
                                                <input type="text"  name="certidao_reservista"/>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            </tbody>
                        </table>



                        </br>
                        <b>DADOS DO RESPONSÁVEL</b>
                        <hr/>

                        <table width="100%" class="responsive">
                            <tbody>


                                <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('responsavel'); ?></label>

                                            <div class="controls">
                                                <input type="text" name="responsavel"/>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('fone_responsavel'); ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <input type="text" name="fone_responsavel"/>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('RG_responsavel'); ?></label>

                                            <div class="controls">
                                                <input type="text" name="rg_responsavel"/>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('CPF_responsável'); ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <input type="text" name="cpf_responsavel"/>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('celular_responsável'); ?></label>

                                            <div class="controls">
                                                <input type="text" name="celular_responsavel"/>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        </br>
                        <b>DOCUMENTOS</b>
                        <hr/>

                        <table width="100%" class="responsive">
                            <tbody>

                                <tr>
                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('OBS_documento'); ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <textarea style="width: 62%; height: 120px;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-gray"><?php echo get_phrase('avançar'); ?></button>
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

                                                            reader.onload = function(e) {
                                                                $('#blah').attr('src', e.target.result);
                                                            }

                                                            reader.readAsDataURL(input.files[0]);
                                                        }
                                                    }

                                                    $("#imgInp").change(function() {
                                                        readURL(this);
                                                    });

                                                    function buscar_matriz() {
                                                        var curso = $('#curso').val();  //codigo do estado escolhido
                                                        //se encontrou o estado
                                                        if (curso) {
                                                            var url = 'index.php?educacional/carrega_matriz/' + curso;  //caminho do arquivo php que irá buscar as cidades no BD
                                                            $.get(url, function(dataReturn) {
                                                                $('#load_matriz').html(dataReturn);  //coloco na div o retorno da requisicao
                                                            });
                                                        }
                                                    }

</script>