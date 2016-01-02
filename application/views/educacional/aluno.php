<script language="JavaScript" type="text/javascript">
    function mascara(t, mask) {
        var i = t.value.length;
        var saida = mask.substring(1, 0);
        var texto = mask.substring(i)
        if (texto.substring(0, 1) != saida) {
            t.value += texto.substring(0, 1);
        }
    }
</script>
<div class="box">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo get_phrase('lista_aluno(s)'); ?>
                </a></li>
            <li>
                <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                    <?php echo get_phrase('novo_aluno(a)'); ?>
                </a></li>

        </ul>
        <!------CONTROL TABS END------->

    </div>
    <div class="box-content padded">
        <div class="tab-content">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane  active" id="list">
                <table>
                    <tr>
                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Curso'); ?></label>
                                <div class="controls">
                                    <select name="curso_busca" id="curso_busca" onchange="buscar_periodo_letivo()">
                                        <option value="0">Selecione o curso</option>
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
                                <label class="control-label"><?php echo get_phrase('Período Letivo'); ?></label>
                                <div class="controls">
                                    <div  id="load_periodo_letivo">
                                        <select name="periodo_letivo_busca" id="periodo_letivo_busca">
                                            <option value="0">Selecione um Curso</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Turma'); ?></label>
                                <div class="controls">
                                    <div  id="load_turma">
                                        <select name="turma_busca" id="turma_busca">
                                            <option value="0">Selecione um Período Letívo</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                    <div  id="load_dados_turma">

                    </div>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('nome'); ?></label>
                                <div class="controls">
                                    <input type="text"  name="aluno_busca" id="aluno_busca"     />

                                </div>
                            </div>
                        </td>
                    </tr>
                </table>



                <table>
                    <tr>
                        <td>
                            <input type="button" value="PESQUISAR" class="btn btn-blue btn-small" onclick="buscar_paginacao();">
                        </td>
  <?php  /*
                        <td>
                            <a  href="index.php?educacional/teste_impressao" 	class="btn btn-gray btn-small">
                                <i class="icon-dashboard"></i> <?php echo get_phrase('Impressão'); ?>
                            </a>

                        </td>
   * 
   */
?>                        
                    </tr>
                </table>
                <br>

                <div id="load_paginacao">
                </div>

            </div>
            <!----TABLE LISTING ENDS--->

            <!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('educacional/matricula/create', array('class' => 'form-vertical validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <div class="padded">
                        <table width="100%" class="responsive">
                            <tbody>
                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('curso'); ?></label>
                                            <div class="controls">
                                                <select name="curso" id="curso" onchange="buscar_turma_matricula()">
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
                                            <label class="control-label"><?php echo get_phrase('Turma'); ?></label>
                                            <div class="controls">
                                                <div  id="load_turma_matricula">
                                                    <select name="turma" id="turma">
                                                        <option>Selecione um Curso</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                            <div  id="load_dados_turma">

                            </div>
                            </tr>

                            <tr>
                            <div  id="load_disciplina">

                            </div>
                            </tr>

                            </tbody>
                        </table>

                        </br>
                        <b><font style="color: #0044cc">DADOS PESSOAIS</font></b>
                        <hr/>
                        <table width="100%" class="responsive">
                            <tbody>

                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('nome'); ?></label>
                                            <div class="controls">
                                                <input type="text" class="validate[required]" minlength="8" onkeypress="this.value.toUpperCase();" name="nome"/>
                                            </div>
                                        </div>
                                    </td>


                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('data_nascimento'); ?></label>
                                            <div class="controls">
                                                <input type="text" class="validate[required]" minlength="10" onkeypress="mascara(this, '##/##/####')" maxlength="10" id="data_nascimento"  name="data_nascimento"/>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('pais_origem'); ?></label>

                                            <div class="controls">
                                                <select name="pais_origem">
                                                    <option value="BRA">Brasil </option>
                                                    <?php
                                                    foreach ($pais as $row_pais):
                                                        ?>
                                                        <option value="<?php echo $row_pais['codigo']; ?>"><?php echo $row_pais['nome']; ?></option>
                                                        <?php
                                                    endforeach;
                                                    ?> 
                                                </select>

                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('UF_nascimento'); ?></label>

                                            <div class="controls">
                                                <select name="uf_nascimento" id="uf_nascimento" onchange="buscar_municipio()">
                                                    <option value="0">Selecione o UF</option>
                                                    <?php
                                                    foreach ($uf as $row_uf):
                                                        ?>
                                                        <option value="<?php echo $row_uf['codigo']; ?>"><?php echo $row_uf['nome']; ?></option>
                                                        <?php
                                                    endforeach;
                                                    ?> 
                                                </select>

                                            </div>

                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('cidade_origem'); ?></label>

                                            <div class="controls">
                                                <div  id="load_muncipio">
                                                    <select>
                                                        <option>Selecione a UF</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('sexo'); ?></label>

                                            <div class="controls">


                                                <select name="sexo">

                                                    <option>Selecione o Sexo</option>
                                                    <option value="0">Masculino</option>
                                                    <option value="1">Feminino</option>

                                                </select>


                                            </div>
                                        </div>
                                    </td>

                                </tr>



                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('estado_civil'); ?></label>

                                            <div class="controls">
                                                <select name="estado_civil">

                                                    <option value="1">Solteiro(a)</option>
                                                    <option value="2">Casado(a)</option>
                                                    <option value="3">Divorciado(a)</option>
                                                    <option value="4">Viuvo(a)</option>
                                                    <option value="5">Outro</option>
                                                </select>

                                            </div>

                                        </div>
                                    </td>



                            </tbody>
                        </table>

                        </br>
                        <b><font style="color: #468847">DOCUMENTOS</font></b>
                        <hr/>
                        <table width="100%" class="responsive">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('cpf'); ?></label>
                                            <div class="controls">
                                                <input type="text" class="validate[required]" minlength="12" onkeypress="mascara(this, '#########-##')" maxlength="12" id="cpf" name="cpf"/>

                                            </div>
                                        </div>
                                    </td>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('RG'); ?></label>
                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="rg"/>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>


                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('RG_UF'); ?></label>

                                            <div class="controls" id="load_matriz">

                                                <select name="rg_uf" id="rg_uf" >
                                                    <option value="0">Selecione o UF</option>
                                                    <?php
                                                    foreach ($uf as $row_uf):
                                                        ?>
                                                        <option value="<?php echo $row_uf['codigo']; ?>"><?php echo $row_uf['nome']; ?></option>
                                                        <?php
                                                    endforeach;
                                                    ?> 
                                                </select>
                                            </div>

                                        </div>
                                    </td>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('RG_orgão_expeditor'); ?></label>
                                            <div class="controls">
                                                <input type="text" class="validate[required]" name="rg_orgao_expeditor"/>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('titulo'); ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <input type="text"  name="titulo"/>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('uf_titulo'); ?></label>

                                            <div class="controls">
                                                <select name="uf_titulo" id="uf_titulo" >
                                                    <option value="0">Selecione o UF</option>
                                                    <?php
                                                    foreach ($uf as $row_uf):
                                                        ?>
                                                        <option value="<?php echo $row_uf['codigo']; ?>"><?php echo $row_uf['nome']; ?></option>
                                                        <?php
                                                    endforeach;
                                                    ?> 
                                                </select>

                                            </div>

                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <td >
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
                                <TR>
                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('uf_certidão_reservista'); ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <select name="uf_certidao" id="uf_certidao" >
                                                        <option value="0">Selecione o UF</option>
                                                        <?php
                                                        foreach ($uf as $row_uf):
                                                            ?>
                                                            <option value="<?php echo $row_uf['codigo']; ?>"><?php echo $row_uf['nome']; ?></option>
                                                            <?php
                                                        endforeach;
                                                        ?> 
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </TR>
                            </tbody>
                        </table>

                        </br>
                        <b><font style="color: #F09900">INFORMAÇÕES SOCIOECONOMICO</font></b>
                        <hr/>

                        <table width="100%" class="responsive">
                            <tbody>
                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('Quantos_irmãos_você_tem? '); ?></label>
                                            <div class="controls">
                                                <div class="controls">
                                                    <SELECT   NAME="SE_txIrmaos">
                                                        <OPTION value="0" >ESCOLHA UMA OP&Ccedil;&Atilde;O</OPTION>
                                                        <OPTION value="1" >Nenhum</OPTION>
                                                        <OPTION value="2">Um</OPTION>
                                                        <OPTION value="3">Dois</OPTION>
                                                        <OPTION value="4">Tr&ecirc;s</OPTION>
                                                        <OPTION value="5">Quatro ou Mais</OPTION>
                                                    </SELECT>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('Quantos filhos voc&ecirc; tem?'); ?></label>

                                            <div class="controls">
                                                <div class="controls">
                                                    <div class="controls">
                                                        <SELECT   NAME="SE_txFilhos">
                                                            <OPTION value="0" >ESCOLHA UMA OP&Ccedil;&Atilde;O</OPTION>
                                                            <OPTION value="1" >Nenhum</OPTION>
                                                            <OPTION value="2">Um</OPTION>
                                                            <OPTION value="3">Dois</OPTION>
                                                            <OPTION value="4">Tr&ecirc;s</OPTION>
                                                            <OPTION value="5">Quatro ou Mais</OPTION>
                                                        </SELECT>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('voc&ecirc; mora com quem?'); ?></label>
                                            <div class="controls">
                                                <div class="controls">
                                                    <SELECT   NAME="SE_txReside">
                                                        <OPTION value="0" >ESCOLHA UMA OP&Ccedil;&Atilde;O</OPTION>
                                                        <OPTION value="1" >Com pais e(ou) parentes</OPTION>
                                                        <OPTION value="2">Esposo(a) e(ou) com os filho(s)</OPTION>
                                                        <OPTION value="3">Com amigos(compartilhando despesas ou de favor)</OPTION>
                                                        <OPTION value="4">Com colegas, em alojamento universit&aacute;rio</OPTION>
                                                        <OPTION value="5">Sozinho(a)</OPTION>
                                                    </SELECT>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('Faixa de renda mensal? '); ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <SELECT   NAME="SE_txRenda">
                                                        <OPTION value="0" >ESCOLHA UMA OP&Ccedil;&Atilde;O</OPTION>
                                                        <OPTION value="1" >At&eacute; 3 sal&aacute;rios m&iacute;nimos</OPTION>
                                                        <OPTION value="2">Mais de 3 At&eacute; 10 sal&aacute;rios m&iacute;nimos</OPTION>
                                                        <OPTION value="3">Mais de 10 At&eacute; 20 sal&aacute;rios m&iacute;nimos</OPTION>
                                                        <OPTION value="4">Mais de 20 At&eacute; 30 sal&aacute;rios m&iacute;nimos</OPTION>
                                                        <OPTION value="5">Mais de 30 sal&aacute;rios m&iacute;nimos</OPTION>
                                                    </SELECT>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('Quantas pessoas moram com voc&ecirc;?'); ?></label>
                                            <div class="controls">
                                                <div class="controls">
                                                    <SELECT   NAME="SE_txMembros">
                                                        <OPTION value="0" >ESCOLHA UMA OP&Ccedil;&Atilde;O</OPTION>
                                                        <OPTION value="1" >Nenhuma</OPTION>
                                                        <OPTION value="2">Um ou dois</OPTION>
                                                        <OPTION value="3">Tr&ecirc;s ou quatro</OPTION>
                                                        <OPTION value="4">Cinco ou seis</OPTION>
                                                        <OPTION value="5">Mais de seis</OPTION>
                                                    </SELECT>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('Qual situa&ccedil;&atilde;o descreve seu caso?'); ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <SELECT  NAME="SE_txTrabalho">
                                                        <OPTION value="0" >ESCOLHA UMA OP&Ccedil;&Atilde;O</OPTION>
                                                        <OPTION value="1" >N&atilde;o trabalho e meus gastos s&atilde;o financiados pela fam&iacute;lia</OPTION>
                                                        <OPTION value="2">Trabalho e recebo ajuda da fam&iacute;lia</OPTION>
                                                        <OPTION value="3">Trabalho e me sustento</OPTION>
                                                        <OPTION value="4">Trabalho e contribuo com o sustento da fam&iacute;lia</OPTION>
                                                        <OPTION value="5">Trabalho e sou o principal respons&aacute;vel pelo sustento da fam&iacute;lia</OPTION>
                                                    </SELECT>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('Você tem bolsa ou financiamento estudantil?'); ?></label>
                                            <div class="controls">
                                                <div class="controls">
                                                    <SELECT   NAME="SE_txBolsa">
                                                        <OPTION value="0" >ESCOLHA UMA OP&Ccedil;&Atilde;O</OPTION>
                                                        <OPTION value="1" >Financiamento Estudantil</OPTION>
                                                        <OPTION value="2">Prouni integral</OPTION>
                                                        <OPTION value="3">Prouni parcial</OPTION>
                                                        <OPTION value="4">Bolsa integral ou pacial oferecida pela propria institui&ccedil;&atilde;o</OPTION>
                                                        <OPTION value="5">Bolsa integral ou parcial oferecida porentidadesexternas</OPTION>
                                                        <OPTION value="6">Outro(s)</OPTION>
                                                        <OPTION value="7">Nenhum</OPTION>
                                                    </SELECT>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('Se trabalha, qual a C.H. ?'); ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <SELECT   NAME="SE_txCH">
                                                        <OPTION value="0" >ESCOLHA UMA OP&Ccedil;&Atilde;O</OPTION>
                                                        <OPTION value="1" >N&atilde;o trabalho/ nunca exerci atividade remunerada.</OPTION>
                                                        <OPTION value="2">Trabalho/ trabalhei eventualmente</OPTION>
                                                        <OPTION value="3">Trabalho/ trabalhei at&eacute; 20 horas semanais</OPTION>
                                                        <OPTION value="4">Trabalho/ trabalhei mais de 20 horas semanais e menos de 40 horas semanais</OPTION>
                                                        <OPTION value="5">Trabalho/ trabalhei em tempo integral - 40 horas semanais ou mais</OPTION>
                                                    </SELECT>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>


                            </tbody>
                        </table>

                        </br>
                        <b><font style="color: #cb2027">ENDEREÇO</font></b>
                        <hr/>

                        <table width="100%" class="responsive">
                            <tbody>

                            <td>
                                <div class="control-group">
                                    <label class="control-label"><?php echo get_phrase('cep'); ?></label>
                                    <div class="controls">
                                        <input type="text" class="validate[required]" minlength="9" onkeypress="mascara(this, '#####-###')" maxlength="9" id="cep" name="cep"/>
                                    </div>
                                </div>
                            </td>
                            <td >
                                <div class="control-group">
                                    <label class="control-label"><?php echo get_phrase('endereco'); ?></label>

                                    <div class="controls">
                                        <input type="text" class="validate[required]" minlength="8" onkeypress="this.value.toUpperCase();" name="endereco"/>
                                    </div>

                                </div>
                            </td>

                            </tr>



                            <tr>


                                <td>
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('bairro'); ?></label>

                                        <div class="controls">

                                            <input type="text" class="validate[required]" minlength="5" onkeypress="this.value.toUpperCase();" name="bairro"/>

                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('UF'); ?></label>

                                        <div class="controls">

                                            <div class="controls">
                                                <select name="uf" id="uf" onchange="buscar_cidade()">
                                                    <option value="0">Selecione o UF</option>
                                                    <?php
                                                    foreach ($uf as $row_uf):
                                                        ?>
                                                        <option value="<?php echo $row_uf['codigo']; ?>"><?php echo $row_uf['nome']; ?></option>
                                                        <?php
                                                    endforeach;
                                                    ?> 
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                </td>


                            </tr>

                            <tr>
                                <td >
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('cidade'); ?></label>

                                        <div class="controls">
                                            <div  id="load_cidade">
                                                <select>
                                                    <option>Selecione a UF</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </td>
                                <td >
                                    <div class="control-group">
                                        <label class="control-label"><?php echo get_phrase('complemento'); ?></label>

                                        <div class="controls">
                                            <input type="text"  onkeypress="this.value.toUpperCase();" name="complemento"/>
                                        </div>

                                    </div>
                                </td>



                            </tr>

                            </tbody>
                        </table>


                        </br>
                        <b><font style="color: cadetblue">CONTATOS</font></b>
                        <hr/>

                        <table width="100%" class="responsive">
                            <tbody>

                                <tr>


                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('fone'); ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <input type="text" onkeypress="mascara(this, '#####-####')" maxlength="10"  id="fone" name="fone"/>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('celular'); ?></label>

                                            <div class="controls">
                                                <input type="text" onkeypress="mascara(this, '#####-####')" maxlength="10"  id="celular" name="celular"/>
                                            </div>

                                        </div>
                                    </td>

                                </tr>




                                <tr>
                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('email'); ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <input type="email" minlength="10" name="email"/>
                                                </div>
                                            </div>
                                        </div>
                                    </td>



                                </tr>

                            </tbody>
                        </table>


                        </br>
                        <b><font style="color: maroon">INFORMAÇÕES</font></b>
                        <hr />

                        <table width="100%" class="responsive">
                            <tbody>

                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('nacionalidade'); ?></label>

                                            <div class="controls">
                                                <select name="nacionalidade">

                                                    <option value="1">Brasileiro(a)</option>
                                                    <option value="2">Brasileiro(a) nascido no exterior ou naturalizado</option>
                                                    <option value="3">Extrangeiro</option>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('cor/raça'); ?></label>

                                            <div class="controls">
                                                <div class="controls">
                                                    <select class="validate[required]" name="cor">
                                                        <option value="99">Selecione uma cor/raça</option>
                                                        <option value="1">Branca</option>
                                                        <option value="2">Preta</option>
                                                        <option value="3">Parda</option>
                                                        <option value="4">Amarela</option>
                                                        <option value="5">Indígena</option>
                                                        <option value="0">Não quis declarar</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>



                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('mae'); ?></label>

                                            <div class="controls">
                                                <input type="text" class="validate[required]" minlength="8" onkeypress="this.value.toUpperCase();" name="mae"/>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('pai'); ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <input type="text"  onkeypress="this.value.toUpperCase();" name="pai"/>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('conjuge'); ?></label>
                                            <div class="controls">
                                                <input type="text"   style="text-transform:uppercase;" name="conjuge"/>
                                            </div>
                                        </div>
                                    </td>

                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('Tem Alguma Deficiência?'); ?></label>

                                            <div class="controls">
                                                <select name="deficiencia" id="deficiencia" onchange="buscar_deficiencia()">
                                                    <option value="0">NÃO</option>
                                                    <option value="1">SIM</option>
                                                    <option value="2">NÃO INFORMADO</option>
                                                </select>

                                            </div>

                                        </div>
                                    </td>


                                </tr>

                                <tr>
                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('Tipo de escola que concluiu o Ens. Médio'); ?></label>

                                            <div class="controls">
                                                <select name="tipo_escola" id="tipo_escola" >
                                                    <option value="0">PRIVADO</option>
                                                    <option value="1">PUBLICO</option>
                                                    <option value="2">NÃO DISPÕE DA INFORMAÇÃO</option>
                                                </select>

                                            </div>

                                        </div>
                                    </td>

                                    <td >
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('Forma de Ingresso'); ?></label>

                                            <div class="controls">
                                                <select name="forma_ingresso" id="forma_ingresso" >
                                                    <option value="1">VESTIBULAR</option>
                                                    <option value="2">ENEM</option>
                                                    <option value="3">AVALIAÇÃO SERIADA</option>
                                                    <option value="4">SELEÇÃO SIMPLIFICADA</option>
                                                    <option value="5">TRANSFERÊNCIA</option>
                                                    <option value="6">DECISÃO JUDICIAL</option>
                                                    <option value="7">VAGAS REMANESCENTE</option>
                                                    <option value="8">PROGRAMAS ESPECIAIS</option>

                                                </select>

                                            </div>

                                        </div>
                                    </td>

                                </tr>

                            </tbody>
                        </table>



                        <div  id="load_doencas">

                        </div>


                        </br>
                        <b><font style="color: teal">INFORMAÇÕES DO RESPONSÁVEL</font></b>
                        <hr/>



                        <table width="100%" class="responsive">
                            <tbody>


                                <tr>
                                    <td >
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
                                    <td >
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
                                    <td >
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
                        <b><font style="color: darkgreen">OBSERVAÇÕES GERAIS</font></b>
                        <hr/>

                        <table width="100%" class="responsive">
                            <tbody>

                                <tr>
                                    <td>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_phrase('OBSERVAÇÕES'); ?></label>

                                            <div class="controls">

                                                <div class="controls">
                                                    <textarea name="obs_documento" style="width: 62%; height: 120px;"></textarea>
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

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    function buscar_municipio() {
        var uf = $('#uf_nascimento').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (uf) {
            var url = 'index.php?educacional/carrega_municipio/' + uf;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_muncipio').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }

    function buscar_cidade() {
        var uf2 = $('#uf').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (uf2) {
            var url = 'index.php?educacional/carrega_cidade/' + uf2;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_cidade').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }

    function buscar_deficiencia() {
        var deficiencia = $('#deficiencia').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (deficiencia) {
            var url = 'index.php?educacional/carrega_doencas/' + deficiencia;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_doencas').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }
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


    function buscar_turma_matricula() {
        var curso = $('#curso').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (curso) {
            var url = 'index.php?educacional/carrega_turma_matricula/' + curso;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_turma_matricula').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }
        function buscar_periodo_letivo() {
        var curso = $('#curso_busca').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (curso) {
            var url = 'index.php?educacional/carrega_periodo_letivo/' + curso;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_periodo_letivo').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }

    function buscar_turma() {
        var curso = $('#curso_busca').val();  //codigo do estado escolhido
        var periodo_letivo = $('#periodo_letivo_busca').val();
      
        //se encontrou o estado
        if (curso) {
            var url = 'index.php?educacional/carrega_turma/' + curso + '/' + periodo_letivo;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_turma').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }

    function buscar_paginacao() {
        var aluno = $('#aluno_busca').val();  //codigo do estado escolhido
        var curso = $('#curso_busca').val();
        var turma = $('#turma_busca').val();
        //se encontrou o estado
        if ((aluno) || (curso != '0') || (turma != '0')) {
            var url = 'index.php?educacional/carrega_table_paginacao/' + curso + '/' + turma + '/' + aluno;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_paginacao').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }else{
            alert('Selecione um curso e turma');
        }
    }

    function buscar_deficiencia2() {
        var deficiencia2 = $('#deficiencia2').val();  //codigo do estado escolhido
        //se encontrou o estado
        if (deficiencia2) {
            var url = 'index.php?educacional/carrega_doencas2/' + deficiencia2;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function (dataReturn) {
                $('#load_doencas2').html(dataReturn);  //coloco na div o retorno da requisicao
            });
        }
    }
</script>
