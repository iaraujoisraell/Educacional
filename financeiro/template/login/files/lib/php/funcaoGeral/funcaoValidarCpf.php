<?php  
function CPF($cpf){  
  $caracteres = array('.','-');  
  $CPF = str_replace($caracteres, "", $cpf);  
  /*ENCONTRA PRIMEIRO DIGITO*/  
  $soma = 0;  
  for($i=0;$i<=8;$i++){  
    $soma += substr($CPF, $i, 1)*(10-$i);  
  }  
  $soma = $soma-((substr(($soma/11), 0,2))*11);  
  if ($soma<=1) $div1 = 0; else $div1 = 11-$soma;  
  /*ENCONTRA SEGUNDO DIGITO*/  
  $soma = 0;  
  for($i=0;$i<=8;$i++){  
    $soma += substr($CPF, $i, 1)*(11-$i);  
  }  
  $soma += ($div1*2);  
  $soma = $soma-((substr(($soma/11), 0,2))*11);  
  if ($soma<=1) $div2 = 0; else $div2 = 11-$soma;  
  /*RESULTADO*/   
  $result = $div1.$div2;  
  $final = substr($CPF, 9,2);  
  if ( $result == $final )  
    return TRUE;  
  else  
    return FALSE;  
}  
///echo CPF("012.098.765-15");  
?>  