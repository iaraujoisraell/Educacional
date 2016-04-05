<?php
    
    
    $sqlVerificar= "SELECT * FROM cliente WHERE cpf ='".$cpf."'";
    $sql = mysql_query($sqlVerificar) or die(mysql_error());

    $count = mysql_num_rows($sql);

    
    //Funcao para validar CPF
    $cpfValidar = CPF($cpf);
    
    if($cpfValidar==false){
        
        ?>
        <script>
            window.location.href = 'cadastro.php?status=erro';
        </script>        
        <?php
    }
    //Fim Validacao do CPF
    
    //Validacao do E-mail
    
    if(isMail($email)==false){
        ?>
        <script>
            window.location.href = 'cadastro.php?statusEmail=erro';
        </script>        
        <?php
    }
      
    // VERIFICAÇOES PARA SABER SE OS CAMPOS DIGITADOS ESTÃO VAZIOS.
    if ($nome == '') {

        echo "<script>alert('DIGITE SEU NOME')</script>";
        echo"<script>window.location.href = 'cadastro.php'</script>";
    } else

    if ($cpf == '') {
        echo "<script>alert('DIGITE O SEU CPF')</script>";
        echo"<script>window.location.href = 'cadastro.php'</script>";
    } else

    if ($email == "") {
        echo "<script>alert('DIGITE SEU E-mail')</script>";
        echo"<script>window.location.href = 'cadastro.php'</script>";
    } else

    if ($nascimento == "") {

        echo "<script>alert('DIGITE SUA DATA DE NASCIMENTO')</script>";
        echo"<script>window.location.href = 'cadastro.php'</script>";
    } else

    if ($sexo == "") {

        echo "<script>alert('DIGITE SEU SEXO')</script>";
        echo"<script>window.location.href = 'cadastro.php'</script>";
    } else
    if ($senha == "") {

        echo "<script>alert('DIGITE SUA SENHA')</script>";
        echo"<script>window.location.href = 'cadastro.php'</script>";
    } else

    if ($senha <> $confSenha) {

        echo "<script>alert('SENHAS DIFERENTES, POR FAVOR DIGITE SUA SENHA NOVAMENTE')</script>";
        echo"<script>window.location.href = 'cadastro.php'</script>";
    } else
    if($count!= 0){
          //  echo "<script>alert('JA EXISTE UM USUARIO CADASTRADO COM ESSE CPF!')</script>";
        ?>
        <script>
            window.location.href = 'cadastro.php?statusUsuarioCpf=erro';
        </script>        
        <?php
    }

            
?>
