<?php

        include '../../../connections/conexao.php';
        include '../../../files/lib/php/funcaoGeral/funcaoValidarCpf.php';
        
    //Dados do Usuário
    $idLogado     = $_POST['idLogado'];
    $idUsuario    = $_POST['idUsuario'];
    $tipoCadastro = $_POST['tipoCadastro'];
    
    $nome       = $_POST['nome'];
    $cpf        = $_POST['cpf'];
    $email      = $_POST['email'];
    $nascimento = $_POST['nascimento'];
    $sexo       = $_POST['divselect'];
    $fone       = $_POST['telefone'];
    $senha      = $_POST['senha'];
    $confSenha  = $_POST['confirmarsenha'];
    
    //Endereco do Cadastro
       
    $cep          = $_POST['cep'];
    $Numero       = $_POST['Numero'];
    $comp         = $_POST['comp'];
    $bairro       = $_POST['bairro'];
    $rua          = $_POST['rua'];
    $cidade       = $_POST['cidade'];
    $estado       = $_POST['estado'];   

    
    $nascimento    = explode("/", $nascimento);
    $nascimento = $nascimento[2]. "-" . $nascimento[1] . "-" . $nascimento[0];
    
    $senhacodificada = sha1($senha);

            
     
        //VARIAVEL RECEBE A QUERY.
        $sqlInserUsuario = "INSERT INTO usuarios(email,senha)
                 VALUES ('".$email."','".$senhacodificada."')";
        $sqlInserUsuarios = mysql_query($sqlInserUsuario) or die(mysql_error());

        /************************************************************************************************
         *                              Select para ver qual ultimo usuario inserido
         ************************************************************************************************/

        $sqlUsuarios1 = "SELECT MAX(id_usuario) AS ULTIMO_ID_USU FROM usuarios";
        $sqlUsuarios = mysql_query($sqlUsuarios1) or die(mysql_error());         

        $rst = mysql_fetch_array($sqlUsuarios);

        $ultimoIdUsuarioInserido = $rst['ULTIMO_ID_USU'];

        /**************************************************************************************************
         * Inser do Usuario
         */

        $sqlInsertCliente = "INSERT INTO cliente(nome,telefone,email,cpf,data,id_usuario,sexo)
                             VALUES ('".$nome."','".$fone."','".$email."','".$cpf."','".$nascimento."',".$ultimoIdUsuarioInserido.",'".$sexo."')";
        $sqlInserCliente  = mysql_query($sqlInsertCliente) or die(mysql_error());

        $sqlUltIdCliente = "SELECT MAX(id_cliente) AS ULTIMO_ID FROM cliente";
        $sqlIdCli = mysql_query($sqlUltIdCliente) or die(mysql_error());         

        $rstCliente = mysql_fetch_array($sqlIdCli);

        $ultimoIdInseridoCli = $rstCliente['ULTIMO_ID'];

        $idCriptoCliente = md5($ultimoIdInseridoCli);

        /********************************************************************************************************/
        $sqlUpdate = "UPDATE cliente SET  id_clienteCript  = '$idCriptoCliente'
        WHERE id_cliente = '$ultimoIdInseridoCli'";
        mysql_query($sqlUpdate);
        
         /***************************************************************************************************
         * Endereco de Entrega
         ***************************************************************************************************/

        $sqlInsertEnderecoEntrega = "INSERT INTO endereco(rua,bairro,numero,cep,complemento,cidade,uf,tipo)
                            VALUES ('".$rua."','".$bairro."','".$Numero."','".$cep."','".$comp."','".$cidade."','".$estado."','1')";
        $sqlInserEnderecoEntrega  = mysql_query($sqlInsertEnderecoEntrega) or die(mysql_error());       

        /***************************************************************************************************
        *Pegar o id cliente e endereco
        ***************************************************************************************************/

        $sqlCliente = "SELECT MAX(id_cliente) AS ULTIMO_ID_CLIENTE FROM cliente";
        $sqlCliente = mysql_query($sqlCliente) or die(mysql_error());         

        $rstCliente = mysql_fetch_array($sqlCliente);

        $ultimoIdClienteInserido = $rstCliente['ULTIMO_ID_CLIENTE'];


        $sqlEndereco = "SELECT MAX(id_endereco) AS ULTIMO_ID_END FROM endereco";
        $sqlEndereco = mysql_query($sqlEndereco) or die(mysql_error());         

        $rstEnd = mysql_fetch_array($sqlEndereco);

        $ultimoIdEnderecoInserido = $rstEnd['ULTIMO_ID_END'];

        /***************************************************************************************************
        * Inserir o na tabela cliente_endereco
        ***************************************************************************************************/

        $sqlInsertEnderecoEntrega = "INSERT INTO cliente_endereco(id_cliente,id_endereco)
                VALUES (".$ultimoIdClienteInserido.",".$ultimoIdEnderecoInserido.")";
        $sqlInserEnderecoEntrega  = mysql_query($sqlInsertEnderecoEntrega) or die(mysql_error());  

    if($sqlInserEnderecoEntrega){
        
        $destinatario = $email;

        $assunto = "Cadastro - Na Padaria - Salgados & Doces";
        $corpo = '
                <html>
                <head>
                <title> Cadastro - Na Padaria - Salgados & Doces</title>
                </head>
                <body>
                <div> 
                <div>Olá '.$nome.', seu Cadastro foi efetuado com sucesso!</div> <br>
                <div>Agradecemos pela sua Preferência!</div> 
                </div>
                </body>
                </html>
                ';
        //para o envio em formato HTML
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html;
                   charset=utf-8\r\n";

        // Additional headers
        $headers .= 'From:' . $nome . '<' . $destinatario . '>' . "\r\n";

        mail($destinatario, $assunto, $corpo, $headers);
            ?>
            <script>
                window.location.href = 'cadastro.php?statusSucesso=erro';
            </script>        
            <?php
       }   
    ?>
