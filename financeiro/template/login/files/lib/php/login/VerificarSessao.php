<?php

session_start();
//session_destroy();

//Verifica se há dados ativos na sessão

if(!isset($_SESSION['dados_login'])){
    //Caso não exista dados registrados, exige login
 ?>   
<!--    <SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
        //alert("Efetue o Login!");
        //window.self.location.href = "../../../index.php";
    </SCRIPT>-->
 <?php
}

?>