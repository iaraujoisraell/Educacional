function fn_PegarScripts(tx_Conteudo)
{
   //extrai javascripts do texto e executa no documento
   var nb_Inicio = 0;
   // loop enquanto achar um script
   while (nb_Inicio!=-1)
   {
      // procura uma tag de script
      nb_Inicio = tx_Conteudo.indexOf('<script', nb_Inicio);
      if (nb_Inicio >=0)
      {
         nb_Inicio = tx_Conteudo.indexOf('>', nb_Inicio) + 1;
         // procura o final do script
         var nb_Final = tx_Conteudo.indexOf("<\/script>", nb_Inicio);
         tx_Codigo = tx_Conteudo.substring(nb_Inicio,nb_Final);
         // executa o script
         var obj_Script = document.createElement("script")
         obj_Script.text = tx_Codigo;
         document.body.appendChild(obj_Script);
      }
   }
}