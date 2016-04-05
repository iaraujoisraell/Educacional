<?php

include '../../../connections/conexao.php';

$idLogado = $_POST['idLogado'];
$idUsuario = $_POST['idUsuario'];

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$nascimento = $_POST['nascimento'];
$sexo = $_POST['divselect'];
$fone = $_POST['telefone'];

$senha = $_POST['senha'];
$confSenha = $_POST['confirmarsenha'];

$nascimento = explode("/", $nascimento);
$nascimento = $nascimento[2] . "-" . $nascimento[1] . "-" . $nascimento[0];
    
if ($senha <> $confSenha) {

    echo "<script>alert('SENHAS DIFERENTES, POR FAVOR DIGITE SUA SENHA NOVAMENTE')</script>";
    echo"<script>window.location.href = '../../../AlterarCadastroCliente.php'</script>";
    
} else {
    
    $senhacodificada = sha1($senha);
    
    $sqlUpdateUsuario = "UPDATE usuarios SET email = '" . $email . "',
                                             senha = '" . $senhacodificada . "' 
                         where id_usuario=" . $idLogado;
    
    $sqlUpdateUsuarios = mysql_query($sqlUpdateUsuario) or die(mysql_error());


    $sqlUpdateCliente = "UPDATE cliente SET nome       = '" . $nome . "',
                                                telefone   = '" . $fone . "',
                                                email      = '" . $email . "',
                                                cpf        = '" . $cpf . "',
                                                data       = '" . $nascimento . "',
                                                sexo       = '" . $sexo . "' WHERE id_cliente=" . $idUsuario;

    mysql_query($sqlUpdateCliente) or die(mysql_error());
    ?>
    <script>
        window.location.href = '../../../AlterarCadastroCliente.php?statusSucessoAlt=erro';
    </script>        
    <?php

}
?>
