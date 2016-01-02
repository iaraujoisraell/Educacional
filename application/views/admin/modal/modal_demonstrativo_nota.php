<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach ($edit_data as $row): 
            /*$disciplina = $row['disc_tx_descricao'];
            $n1 = $row['dan_fl_nota_1bim'];
            $n2 = $row['dan_fl_nota_2bim'];
            $n3 = $row['dan_fl_nota_3bim'];
            $pf = $row['dan_fl_nota_pf'];
            $md = $row['dan_fl_media_final'];
            
            $n1 = $row['dan_nb_falta_1bim'];
            $n2 = $row['dan_nb_falta_2bim'];
            $n3 = $row['dan_nb_falta_3bim'];
            $n3 = $row['dan_nb_total_falta'];
            
            $situacao = $row['dan_nb_situacao_final'];*/
            ?>
            <?php echo form_open('educacional/turma/do_update/' . $row['turma_id'], array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
            <div class="padded">
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Descrição'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" value="<?php echo $row['tur_tx_descricao']; ?>" id="descricao" name="descricao"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('Periodo_letivo'); ?></label>
                    <div class="controls">
                        <?php $periodo_turma = $this->crud_model->get_periodo_turma(); ?>
                        <select name="periodo_letivo" id="periodo_letivo">
                            <option value="<?php echo $row['periodo_letivo_id']; ?>"><?php echo $periodo_letivo; ?></option>
                            <?php foreach ($periodo_turma as $row):
                                ?>
                                <option value="<?php echo $row['periodo_letivo_id'] ?>"><?php echo $row['periodo_letivo']; ?> </option>
                                <?php
                            endforeach;
                            ?>
                        </select>  
                    </div>
                </div>

           
           
        <?php endforeach; ?>
<table  class="table table-normal">
        <tr>
            <td><b>Nº</b></td>
            <td><b>Disciplina</b></td>
            <td><b>N1</b></td>
            <td><b>N2</b></td>
            <td><b>N3</b></td>
        </tr>

        <?php
        $candidato = $this->crud_model->get_demonstrativo_nota($current_matricula_aluno_turma_id);
         $cont2 = 1;
        
        foreach ($candidato as $row_candidato):
              ?>
            <tr>
                <td><?php echo $cont2++; ?></td>
                <td><?php echo $row_candidato['disc_tx_descricao']; ?></td>
                <td><?php echo $row_candidato['dan_fl_nota_1bim']; ?></td>
                <td><?php echo $row_candidato['dan_fl_nota_2bim']; ?></td>
                <td><?php echo $row_candidato['dan_fl_nota_3bim']; ?></td>

            </tr>
                 <?php
        endforeach;
        ?>
      </table>
               

 



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