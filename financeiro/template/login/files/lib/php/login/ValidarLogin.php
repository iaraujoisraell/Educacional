<?php
session_start();
include '../../../../connections/conexao.php';

// $tipoPg = $_POST['tipo'];//Tipo de Pagina - 1- delivery, 2 - reservas
// $reservaPedido = $_POST['reservaPedido'];
// $adicionarPedido = $_POST['adicionarPedido'];

$login = $_POST['login'];
$senha = $_POST['senha'];

$hoje = date("Y-m-d");
$hora = date("H:i:s");
$datetime = date("Y-m-d H:i:s");
//$senhacod = sha1($senha);

$ip = $_SERVER["REMOTE_ADDR"];


$sql = "SELECT * FROM usuario u 
                inner join empresa e on e.emp_nb_codigo = u.emp_nb_codigo
                inner join perfil p on p.per_nb_codigo = u.per_nb_codigo
                WHERE u.usu_tx_login ='" . $login . "' AND u.usu_tx_senha = '" . $senha . "'";

$rs = mysql_query($sql) or die(mysql_error());

$num = mysql_num_rows($rs);

//Verificamos se alguma linha foi afetada. Caso sim, retornamos suas informações
if ($num > 0) {

    $rst = mysql_fetch_array($rs);

    $usuario_codigo = $rst["usu_nb_codigo"];
    $usuario_nome = $rst["usu_tx_nome"];
    $usuario_login = $rst["usu_tx_login"];
    $usuario_senha = $rst["usu_tx_senha"];
    $usuario_foto = $rst["usu_tx_url_foto"];
    $empresa_nome = $rst["emp_tx_nome_empresa"];
    $perfil_descricao = $rst["per_tx_descricao"];
    $perfil_codigo = $rst["per_nb_codigo"];
    //Inicia a sessão

    $insert = "INSERT INTO login (login_dt_login,usu_nb_codigo,login_nb_status, login_tx_ip) VALUES 
                        ('$datetime','$usuario_codigo','1','$ip')";
    $exe = mysql_query($insert) OR DIE('Curso Cadastrando linusuarioha 20' . mysqli_error($conexao));
    $ultimo_login = mysql_insert_id($conexao);

    $_SESSION['usuario_id'] = $usuario_codigo;
    $_SESSION['usuario_login'] = $usuario_login;
    $_SESSION['usuario_senha'] = $usuario_senha;
    $_SESSION['usuario_nome'] = $usuario_nome;
    $_SESSION['usuario_perfil'] = $perfil_codigo;
    $_SESSION['foto_usuario'] = $usuario_foto;
    $_SESSION['perfil_descricao'] = $perfil_descricao;
    $_SESSION['ultimo_login'] = $ultimo_login;
    //Encerra a conexão com o Banco
    mysql_close($conexao);

    header('Location:../../../../index.php');
    //Redireciona para o pagina principal . md5('2')
    //  header('Location:../../../../delivery_pedidos.php');
} else {
    //Encerra a conexão com o Banco
    mysql_close($conexao);

    //Caso nenhuma linha seja retornada, emite o alerta e retorna
  
    ?>
<script type="text/javascript">
        alert('USU\u00c1RIO OU SENHA INV\u00c1LIDA')
        window.location.href = '../../../../../index.php';
    </script>        
    <?php

}
?>