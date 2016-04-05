<?php
include '../../../connections/conexao.php';
    $idLogado     = $_POST['idLogado'];
    $idUsuario    = $_POST['idUsuario'];
    
    $cep          = $_POST['cep'];
    $Numero       = $_POST['Numero'];
    $comp         = $_POST['comp'];
    $bairro       = $_POST['bairro'];
    $rua          = $_POST['rua'];
    $cidade       = $_POST['cidade'];
    $estado       = $_POST['estado'];   
    
        //Select vai pegar o chave primaria do endereco de cadastro do cliente tipo = 1-Endereco de Cadastro , tipo=2 - Endereco de Entrega

        $sqlPegarIdEnd = "SELECT ed.id_endereco as IdEndereco FROM cliente_endereco ce INNER JOIN endereco ed ON ed.id_endereco = ce.id_endereco where ed.tipo=2 and ce.id_cliente=".$idUsuario;
        $sqlIdEnd = mysql_query($sqlPegarIdEnd);
        $IdEnd = mysql_fetch_array($sqlIdEnd);
        
        $idEndereco = $IdEnd['IdEndereco'];
        
        $sqlUpdateEnderecoEntrega = "UPDATE endereco SET rua         = '".$rua."',
                                                     bairro      = '".$bairro."',
                                                     numero      = '".$Numero."',
                                                     cep         = '".$cep."',
                                                     complemento = '".$comp."',
                                                     cidade      = '".$cidade."',
                                                     uf          = '".$estado."' WHERE id_endereco =".$idEndereco;
       mysql_query($sqlUpdateEnderecoEntrega) or die(mysql_error()); 
       
       
        ?>
        <script>
            window.location.href = '../../../AlterarEnderecoEntrega.php?statusSucessoAlt=erro';
        </script>        
        