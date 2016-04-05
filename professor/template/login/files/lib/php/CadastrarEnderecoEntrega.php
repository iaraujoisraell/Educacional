<?php

include '../../../connections/conexao.php';

    $cep = $_POST['cep'];
    $Numero = $_POST['Numero'];
    $comp = $_POST['comp'];
    $bairro = $_POST['bairro'];
    $rua = $_POST['rua'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $IdCliente = $_POST['IdCliente'];


    if ($cep == '') {
        echo "<script>alert('DIGITE SEU CEP')</script>";
        echo"<script>window.location.href = 'cadastro.php'</script>";
    } else
    if ($Numero == '') {

        echo "<script>alert('DIGITE O SEU NÚMERO)</script>";
        echo"<script>window.location.href = 'cadastro.php'</script>";
    } else

    if ($bairro == "") {
        echo "<script>alert('DIGITE SEU BAIRRO')</script>";
        echo"<script>window.location.href = 'cadastro.php'</script>";
    } else

    if ($rua == "") {

        echo "<script>alert('DIGITE SUA DATA DE RUA')</script>";
        echo"<script>window.location.href = 'cadastro.php'</script>";
    } else
    if ($cidade == "") {

        echo "<script>alert('DIGITE SUA CIDADE')</script>";
        echo"<script>window.location.href = 'cadastro.php'</script>";
    } else
    if ($estado == "") {

        echo "<script>alert('DIGITE SEU ESTADO')</script>";
        echo"<script>window.location.href = 'cadastro.php'</script>";
    } else {

    $sqlInsertEnderecoEntrega = "INSERT INTO endereco(rua,bairro,numero,cep,complemento,cidade,uf,tipo)
                        VALUES ('" . $rua . "','" . $bairro . "','" . $Numero . "','" . $cep . "','" . $comp . "','" . $cidade . "','" . $estado . "','2')";
    $sqlInsertEndereco = mysql_query($sqlInsertEnderecoEntrega) or die(mysql_error());


    $sqlEndereco1 = "SELECT MAX(id_endereco) AS ULTIMO_ID_END FROM endereco";
    $sqlEndereco = mysql_query($sqlEndereco1) or die(mysql_error());

    $rstEnd = mysql_fetch_array($sqlEndereco);

    $ultimoIdEnderecoInserido = $rstEnd['ULTIMO_ID_END'];


    $sqlInsertEnderecoCliente = "INSERT INTO cliente_endereco(id_cliente,id_endereco)
    VALUES (" . $IdCliente . "," . $ultimoIdEnderecoInserido . ")";

    $InsertEnderecoCliente = mysql_query($sqlInsertEnderecoCliente) or die(mysql_error());

    if ($sqlInsertEndereco) {
        echo"<script>window.location.href = '../../../confirmacaoCadastro.php'</script>";
    }
}
?>
