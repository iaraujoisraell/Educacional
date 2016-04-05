<div class="box">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo get_phrase('lista_mensalidades'); ?>
                </a>
            </li>
            <li>
                <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                    <?php echo get_phrase('novo_pagamento'); ?>
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
                        <a  title="Users">
                            <?php
                            $hoje = date("Y-m-d");
                            $count = 1;
                            $codigo_cadastro_aluno = '';
                            $codigo_matricula_aluno_turma = '';
                            foreach ($aluno as $row1):
                                $codigo_matriz = $row1['matriz_id'];
                                ?>
                                <h3><?php echo $row1['nome']; ?> - <?php echo $row1['cur_tx_abreviatura']; ?></h3>
                            <?php endforeach; ?>
                            <?php foreach ($disciplina as $row): ?>
                            <?php endforeach; ?>                         
                            <span>Total <?php echo count($turma); ?> Pagamentos</span>
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
                                <th><div><?php echo get_phrase('Descrição'); ?></div></th>
                                <th><div><?php echo get_phrase('dt_vcto'); ?></div></th>
                                <th><div><?php echo get_phrase('dt_pgto'); ?></div></th>
                                <th><div><?php echo get_phrase('Valor'); ?></div></th>  
                                 <th><div><?php echo get_phrase('forma_pgto'); ?></div></th>  
                                <th><div><?php echo get_phrase('Situação'); ?></div></th>
                                <th><div><?php echo get_phrase('opções'); ?></div></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($mensalidade as $row):
                                        $situacao = $row['status_mensalidades'];
                                        $dt_vcto = $row['data_vencimento'];
                                        $forma_pgto = $row['forma_pagamento'];
                                        
                                        
                                        if($forma_pgto == 1){
                                            $fp = 'À VISTA';
                                        }else if($forma_pgto == 2){
                                            $fp = 'C. CRÉDITO';
                                        }else if($forma_pgto == 3){
                                            $fp = 'C. DÉBITO';
                                        }else if($forma_pgto == 4){
                                            $fp = 'CHEQUE';
                                        }else{
                                            $fp = '';
                                        }
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>

                                            <td align="center"><?php echo $row['parcela']; ?>/6 - <?php echo $row['referente']; ?> - <?php echo $row['periodo_letivo']; ?></td>
                                            <td align="center"><?php echo date("d/m/Y", strtotime($row['data_vencimento'])); ?></td>       
                                            <td align="center"><?php echo $row['data_pagamento']; ?></td>   
                                            <td align="center"><?php echo 'R$ ' . number_format($row['valor'], 2, ',', ''); ?></td>
                                            <td align="center"><?php echo $fp; ?></td>
                                            <?php if ($situacao == '0') { ?>

                                                <?php if ($dt_vcto < $hoje) { ?>
                                                    <td align="center"><div id="status_mensalidade_ematraso"></div>Em Atraso</td>
                                                <?php } else if ($dt_vcto > $hoje) { ?>
                                                    <td align="center"><div id="status_mensalidade_emaberto"></div>Aberto</td>
                                                <?php } else if ($dt_vcto == $hoje) { ?>
                                                    <td align="center"><div id="status_mensalidade_vencendohoje"></div>Vence Hoje</td>
                                                <?php } ?>

                                            <?php } else if ($situacao == '1') { ?>
                                                <td align="center"><div id="status_mensalidade_pago"></div>Pago</td>
                                            <?php } ?>

                                            <td align="center">
                                                <a data-toggle="modal" href="#modal-form" onclick="modal('pagar_mensalidade',<?php echo $row['mensalidades_id']; ?>)"	class="btn btn-gray btn-small">
                                                    <i class="icon-wrench"></i> <?php echo get_phrase('pagar'); ?>
                                                </a>
                                                 <a data-toggle="modal" href="#modal-form" onclick="modal('edit_vestibular',<?php echo $row['bolsas_id']; ?>)"	class="btn btn-gray btn-small">
                                                    <i class="icon-wrench"></i> <?php echo get_phrase('imprimir'); ?>
                                                </a>
                                                <a data-toggle="modal" href="#modal-form" onclick="modal('editar_mensalidade',<?php echo $row['mensalidades_id']; ?>)"	class="btn btn-gray btn-small">
                                                    <i class="icon-wrench"></i> <?php echo get_phrase('editar'); ?>
                                                </a>
                                                <a data-toggle="modal" href="#modal-form" onclick="modal('cancelar_pagamento',<?php echo $row['mensalidades_id']; ?>)"	class="btn btn-gray btn-small">
                                                    <i class="icon-wrench"></i> <?php echo get_phrase('cancelar'); ?>
                                                </a>
                                                <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url(); ?>index.php?financeiro/mensalidades/delete/<?php echo $row['mensalidades_id']; ?>')"
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
                    <?php echo form_open('educacional/turma/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <div class="padded">
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
                                                <input type="text" class="validate[required]" name="rg"/>
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
                                                <input type="text" class="validate[required]" name="UF_nascimento"/>
                                            </div>

                                        </div>
                                    </td>



                                </tr>



                                <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('cidade'); ?></label>

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="pais_origem"/>
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
                                                <input type="text" class="validate[required]" name="cidade"/>
                                            </div>

                                        </div>
                                    </td>

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

                                                <input type="text" class="validate[required]" name="endereco"/>

                                            </div>
                                        </div>
                                    </td>

                                </tr>




                                <tr>
                                    <td width="40%">
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('cidade'); ?></label>

                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="pais_origem"/>
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



                            </tbody>
                        </table>
                    </div>



                    <div class="form-actions">
                        <button type="submit" class="btn btn-gray"><?php echo get_phrase('add_turma'); ?></button>
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