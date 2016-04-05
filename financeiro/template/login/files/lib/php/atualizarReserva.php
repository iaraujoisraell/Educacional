<?php
    include '../../../connections/conexao.php';
        
    function validarData($dat){
            $data = explode("/","$dat"); // fatia a string $dat em pedados, usando / como referência

            $d = $data[0];
            $m = $data[1];
            $y = $data[2];

        // verifica se a data é válida!
        // 1 = true (válida)
        // 0 = false (inválida)

            $res = checkdate($m,$d,$y);

            if ($res == 1){
                return true;
            } else {
                return false;
            }
        }
    

    $idProduto       = $_POST['idProduto'];
    $IdUsuario       = $_POST['IdUsuario'];
    $sessao          = $_POST['sessao'];
    $ValorTotalGeral = $_POST['ValorTotalGeral'];
    $frete           = $_POST['frete'];
    
    $dataReserva     = $_POST['dataReserva'];
    $dataReservaEmail= $_POST['dataReserva'];
    $horaReserva     = $_POST['horaReserva'];
    
    //$totalGeral1 = number_format($totalGeral, 2, '.', ' ');
    $validarData = validarData($dataReserva); 
    
    
    $dataReserva    = explode("/", $dataReserva);
    $dataReserva = $dataReserva[2]. "-" . $dataReserva[1] . "-" . $dataReserva[0];
    

     
     if($validarData == false){
        ?>
        <script>
            window.location.href = '../../../reservarHora.php?statusData=erro';
        </script>        
        <?php         
     }else if ($dataReserva == "") {
         
        echo "<script>alert('DIGITE A DATA DE RESERVA!')</script>";
        echo"<script>window.location.href = 'reservarHora.php'</script>";
        
    }else if ($horaReserva == "") {
        
        echo "<script>alert('DIGITE A HORA DE RESERVA!')</script>";
        echo"<script>window.location.href = 'reservarHora.php'</script>";
        
    }else{
   
        $sql_modifica = "UPDATE reservas SET 
                             ValorTotal      = '$ValorTotalGeral',
                             frete           = '$frete',
                             dataReserva     = '$dataReserva',
                             horaReserva     = '$horaReserva'
         WHERE  sessao = '$sessao' and id_cliente= '$IdUsuario' ";
        
        $rs_modifica = mysql_query($sql_modifica) or die(mysql_error());

        
      if($rs_modifica){
          
//        $sql = "SELECT * FROM vw_emailreserva WHERE sessao = '".$sessao."'"; 
//             
//         $sqlEmail = mysql_query($sql) or die(mysql_error());  
//         $sql1 = mysql_fetch_array($sqlEmail);
         
         
        $sqlPegarEmail = "SELECT * FROM cliente WHERE id_usuario =".$IdUsuario; 
        $sqlusuario = mysql_query($sqlPegarEmail) or die(mysql_error());  
        $sqlusuario1 = mysql_fetch_array($sqlusuario);
        
        $destinatario = "".$sqlusuario1['email']."";

        $assunto = "RESERVA DE PRODUTOS";
        $corpo = '
        <html>
            <head>
                <title>Reservas</title>
            </head>
        <body>
        <div> 
        <div>Cliente: ' . $sqlusuario1['nome'] . '</div>       
        <div>Telefone: ' .$sqlusuario1['telefone'] . '</div>       
        <div>email*: ' .$sqlusuario1['email'] . '</div>       
        <div>Valor da Reserva de Produtos: ' .$ValorTotalGeral. '</div>
        <div>Data da Reserva: ' .$dataReservaEmail. '</div>
        <div>Hora da Reserva: ' .$horaReserva. '</div>
        <div>Data que a reserva foi efetuada: ' .date("d/m/Y"). ' às ' .date("H:i:s").'</div></br> </br> </br> 
        <div>Visualize seu comprovante no site: http://www.napadaria.com.br </div></br> 
        </div>
        </body>
        </html>
        ';
           //para o envio em formato HTML
           $headers = "MIME-Version: 1.0\r\n";
           $headers .= "Content-type: text/html;
           charset=utf-8\r\n";

           // Additional headers
           $headers .= 'From:'.$sqlusuario1['nome'].'<'.$destinatario.'>' . "\r\n";
           $headers .= 'Bcc: web3@lbrazil.com.br' . "\r\n";


           //endereços que receberão uma copia $headers .= "Cc: manel@desarrolloweb.com\r\n"; 
           //endereços que receberão uma copia oculta
           //$headers .= "Bcc: suporte@lbrazil.com.br\r\n";

           mail($destinatario, $assunto, $corpo, $headers);         
        ?>
            <script>
                
                window.location.href = '../../../confirmacaoReserva.php';
                
            </script>        
        <?php
            
      }  
        
    }
    
?>
