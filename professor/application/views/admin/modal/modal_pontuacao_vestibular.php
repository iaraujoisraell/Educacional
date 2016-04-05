<?php
$vestibularPontuacao_info = $this->crud_model->get_vestibular_chamada_info($current_pontuacao_vestibular_id);

foreach ($vestibularPontuacao_info as $row):
    ?>
    <div class="box">
        <div class="">
            <div class="title">
                <div style="float:left;width:370px;height:147px;text-align:left;position:relative; margin-bottom:20px;">
                    <div  style="position:absolute; bottom:10px;left:150px;">
                        <h3 style=" color:#666;font-weight:100;"><?php echo $row['name']; ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <br />

        <?php echo form_open('admin/vestibularChamada/do_update/' . $row['vestibular_id'], array('class' => 'form-vertical validatable', 'target' => '_top')); ?>
        <table  class="table table-normal">
            <?php echo "Tipo do Vestibular: " ?><?php
            if ($row['vest_nb_tipo']) {
                echo "Macro";
            } else {
                echo "Agendado";
            }
            ?>
            <br>
            <?php echo "Ano do Vestibular: " . $row['vest_nb_ano'] . "/" . $row['vest_tx_semestre'] ?><br>
            <?php echo "Data: " . date('d/m/Y', strtotime($row['vest_dt_realizacao'])); ?>
        <?php endforeach; ?>

        <table  class="table table-normal responsive">
            <tr>
                <td><b>Nº</b></td>
                <td><b>Candidato</b></td>
                <td><b>Prova</b></td>
                <td><b>Redação</b></td>
                <td><b>Aprovado</b></td>
                <td><b>Reprovado</b></td>
            </tr>


            <?php
            $cont2 = 1;
            $cont = 1;
            $candidato = $this->crud_model->get_candidato_pontuacao_info($current_pontuacao_vestibular_id);
            foreach ($candidato as $row_candidato):
                ?>
                <tr>
                    <td><?php echo $cont2++; ?></td>
                    <td><?php echo $row_candidato['nome']; ?></td>
                    <td><input id="inp_pont" type="text" name="prova"/></td>
                    <td><input id="inp_pont" type="text" name="redacao"/></td>
                    <td><input type="radio" name="aprovado<?php echo $cont++; ?>"/></td>
                   
                   
                </tr>

                <?php
            endforeach;
            ?>
        </table>


        <div class="form-actions">
            <button type="submit" class="btn btn-gray"><?php echo get_phrase('salvar_chamada'); ?></button>
        </div>
        </form>
</div>
