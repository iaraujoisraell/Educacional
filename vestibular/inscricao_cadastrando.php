<?php
require_once("conexao.php");
$hoje = date("Y-m-d");
$hora = date("H:i:s");

function datasql($databr) {
    if (!empty($databr)) {
        $p_dt = explode('/', $databr);
        $data_sql = $p_dt[2] . '-' . $p_dt[1] . '-' . $p_dt[0];
        return $data_sql;
    }
}

//$cod_vestibular = 496;//$_GET['CodVestibular'];

$ano = date("Y");

/*
 * DADOS PESSOAIS
 */

$nome = ltrim($_POST['txNome']);
$cpf = ltrim($_POST['txCPF']);
$dtnasc = ltrim($_POST['txNascimento']);
$estcivil = ltrim($_POST['txEstCiv']);
$sexo = ltrim($_POST['txSexo']);
$profissao = ltrim($_POST['txProfissao']);


/*
 * SOCIOECONOMICO
 */
$irmaos = ltrim($_POST['SE_txIrmaos']);
$filhos = ltrim($_POST['SE_txFilhos']);
$etnia = ltrim($_POST['SE_txEtnia']);
$moradia = ltrim($_POST['SE_txReside']);
$renda = ltrim($_POST['SE_txRenda']);
$membros = ltrim($_POST['SE_txMembros']);
$trabalho = ltrim($_POST['SE_txTrabalho']);
//$uf_ef = ltrim($_POST['SE_txUFef']);
$bolsa = ltrim($_POST['SE_txBolsa']);
//$uf_em = ltrim($_POST['SE_txUFem']);
$ch_trabalho = ltrim($_POST['SE_txCH']);


/*
 * CONTATOS
 */
$residencial = ltrim($_POST['txFone']);
$celular = ltrim($_POST['txCelular']);
$email = ltrim($_POST['txEmail']);
$outros = ltrim($_POST['txOutros']);


/*
 * ENDEREÃ‡O
 */
$end = ltrim(utf8_decode($_POST['txEnd']));
$complemento = ltrim(utf8_decode($_POST['txComplemento']));
$bairro = ltrim(utf8_decode($_POST['txBairro']));
$cidade = ltrim(utf8_decode($_POST['txCidade']));
$uf = ltrim($_POST['txUF']);
$cep = ltrim($_POST['txCEP']);








/*
 * DADOS DO VESTIBULAR
 */
$cod_vestibular = ltrim($_POST['vestibular']);

$referencia = ltrim($_POST['txCiente']);

$op01 = ltrim(utf8_decode($_POST['txOp01']));
$Turno_op01 = ltrim(utf8_decode($_POST['txturOp01']));
$op02 = ltrim($_POST['txOp02']);
$Turno_op02 = ltrim(utf8_decode($_POST['txturOp02']));
$mao = ltrim($_POST['txMao']);
$necessidade = ltrim($_POST['txNecessidade']);



if ($nome == '') {
    echo "<font color='#FF0000' size='5' face='verdana'>Informe seu nome completo.</font>";
} else if ($cpf == '') {
    echo "<font color='#FF0000' size='5' face='verdana'>Informe seu CPF</font>";
}  else if ($op01 == '0') {
    echo "<font color='#FF0000' size='5' face='verdana'>Selecione sua 1a. Op&ccedil;&atilde;o de curso</font>";
} else if ($Turno_op01 == '0') {
    echo "<font color='#FF0000' size='5' face='verdana'>Selecione o Turno</font>";
} else if ($op02 == '0') {
    echo "<font color='#FF0000' size='5' face='verdana'>Selecione sua 2a. Op&ccedil;&atilde;o de curso</font>";
} else if ($Turno_op02 == '0') {
    echo "<font color='#FF0000' size='5' face='verdana'>Selecione o Turno</font>";
} else if ($mao == '0') {
    echo "<font color='#FF0000' size='5' face='verdana'>Informe o lado que usará para fazer a prova</font>";
} else {


    $query_cadastro = "SELECT * FROM candidato can where (nome = '$nome' or can_tx_cpf = '$cpf') and vest_nb_codigo ='$cod_vestibular'"; // where mod_nb_codigo = '$id_modulo' ";
    $resultado_cadastro = mysql_query($query_cadastro) OR DIE(mysql_error($conexao));
    $linha_cadastro = mysql_num_rows($resultado_cadastro);

    if ($linha_cadastro > 0) {
        echo "<font color='#FF0000' size='4' face='verdana'>J&aacute; Existe um Cadastro com este nome ou cpf.</font>";
    } else {

        $insert = "INSERT INTO candidato (
        nome,
        can_dt_dtNasc,
        can_ch_estvic,
        can_ch_sexo,
        
        can_tx_profissao,
        
        can_tx_se_irmaos,
        can_tx_se_filhos,
        can_tx_se_etnia,
        can_tx_se_moradia,
        can_tx_se_renda,
        can_tx_se_membros,
        can_tx_se_trabalhando,
        can_tx_se_bolsa,
        can_tx_se_ch,


        can_tx_telefone,
        can_tx_celular,
        can_tx_email,
        can_tx_outros_contatos,
        
        can_tx_cpf,
        can_tx_endereco,
        can_tx_complemento,
        can_tx_bairro,
        can_tx_cidade,
        can_ch_uf,
        can_tx_cep,
        
        can_tx_op01,
        can_tx_turno01,
        can_tx_op02,
        can_tx_turno02,
        can_tx_mao,
        can_tx_necessidade,
        

        
        can_tx_data,
        can_tx_hora,
        can_nb_referencia,
        vest_nb_codigo
        
        )
        VALUES 
        ('$nome',
       '$dtnasc',
        '$estcivil',
        '$sexo',
        '$profissao',
        
        '$irmaos',
        '$filhos',
        '$etnia',
        '$moradia',
        '$renda',
        '$membros',
        '$trabalho',
        '$bolsa',
        '$ch_trabalho',
        
        '$residencial',
        '$celular',
        '$email',
        '$outros',
        
        '$cpf',       
        '$end',
        '$complemento',
        '$bairro',
        '$cidade',
        '$uf',
        '$cep',
        
        
        
        '$op01',
        '$Turno_op01',
        '$op02',
        '$Turno_op02',
        '$mao',
        '$necessidade',

        '$hoje',
        '$hora',
        '$referencia',
        '$cod_vestibular')";

        $exe = mysql_query( $insert) OR DIE('cadastro_aluno Cadastrando linha 146' . mysql_error($conexao));
        $ultimo_ca = mysql_insert_id($conexao);
        
          
        ?>


        <script>
       window.location.href = 'ficha_inscricao.php?codigo=<?php echo $ultimo_ca; ?>';
           
        </script>
        <?php
    }
}

function verificar_email($email) {
    $mail_correcto = 0;
    //verifico umas coisas
    if ((strlen($email) >= 6) && (substr_count($email, "@") == 1) && (substr($email, 0, 1) != "@") && (substr($email, strlen($email) - 1, 1) != "@")) {
        if ((!strstr($email, "'")) && (!strstr($email, "\"")) && (!strstr($email, "\\")) && (!strstr($email, "\$")) && (!strstr($email, " "))) {
            //vejo se tem caracter .
            if (substr_count($email, ".") >= 1) {
                //obtenho a termina��o do dominio
                $term_dom = substr(strrchr($email, '.'), 1);
                //verifico que a termina��o do dominio seja correcta
                if (strlen($term_dom) > 1 && strlen($term_dom) < 5 && (!strstr($term_dom, "@"))) {
                    //verifico que o de antes do dominio seja correcto
                    $antes_dom = substr($email, 0, strlen($email) - strlen($term_dom) - 1);
                    $caracter_ult = substr($antes_dom, strlen($antes_dom) - 1, 1);
                    if ($caracter_ult != "@" && $caracter_ult != ".") {
                        $mail_correcto = 1;
                    }
                }
            }
        }
    }
    if ($mail_correcto) {
        return 1;
    } else {
        return 0;
    }
}
?>