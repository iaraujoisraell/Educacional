

$(document).ready(function() {

    $("select[name=categoria]").change(function() {
        $("select[name=produto]").html('<option value="">Carregando...</option>');

        $.post("files/lib/php/pesquisarCategoria.php",
                {categoria: $(this).val()},
        function(valor) {
            $("select[name=produto]").html(valor);
        }
        )

    });
});



$(document).ready(function() {

    $("select[name=produto]").change(function() {
        $("select[name=valorProduto]").html('<option value="0">Carregando...</option>');

        $.post("files/lib/php/funcao_geral.php",
                {produto: $(this).val()},
        function(valor) {
            //$("select[name=valorProduto]").html(valor);
            $("select[name=valorProduto]").html(valor);
        }
        )

    });
});

function AcrescentarQuantidade() {

    var qtdProduto = parseInt($("#qtdProduto").val());
    var valorUnitario = parseFloat($("#valorProduto").val());

    qtdProduto = parseInt(qtdProduto) + parseInt(1);

    if (qtdProduto <= 15) {
        $("#qtdProduto").val(parseInt(qtdProduto));

    } else {

        alert("Ultrapassou a quantidade de Pedido!");
    }

    $("#total").val("");
    $("#totalGeral").val("");
}

function gerarValor() {
    var qtdProduto = parseInt($("#qtdProduto").val());
    var valorUnitario = parseFloat($("#valorProduto").val());

    var total = parseInt(qtdProduto) * parseFloat(valorUnitario);

    var totalgeral = parseInt(qtdProduto) * parseFloat(valorUnitario);

    var totalReserva = $("#total").val('R$ ' + (totalgeral.toFixed(2)));
    var totalReserva2 = document.getElementById("total").value.replace(".", ",");

    if (!isNaN(valorUnitario)) {

        $("#total").val(totalReserva2);
        $("#totalGeral").val(parseFloat(total));
    } else {
        $("#total").val('');
        $("#totalGeral").val('');
    }


}
function DiminuirQuantidade() {

    var qtdProduto = parseInt($("#qtdProduto").val());
    var valorUnitario = parseFloat($("#valorProduto").val());

    qtdProduto = parseInt(qtdProduto) - parseInt(1);

    if (qtdProduto >= 1) {
        $("#qtdProduto").val(parseInt(qtdProduto));
    }

    $("#total").val("");
    $("#totalGeral").val("");
}

function limpar() {
    $("#total").val("");
    $("#totalGeral").val("");
}

//funcao qu vai calcular o subTotal com o valor do Frete

function fn_calcularFrete(subTotal, frete) {
    var total = parseFloat(subTotal) + parseFloat(frete);


    if (!isNaN(total)) {

        $("#totalGeral").val(total.toFixed(2));

        var pedido2 = document.getElementById("totalGeral").value.replace(".", ",");

        $("#totalGeral").val('R$ ' + pedido2);


        $("#totalGeralSalvar").val(total.toFixed(2));

    } else {
        $('#totalGeral').val();
    }

}


function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e) {
    var sep = 0;
    var key = "";
    var i = j = 0;
    var len = len2 = 0;
    var strCheck = '0123456789';
    var aux = aux2 = '';
    var whichCode = (window.Event) ? e.which : e.keyCode;
    if (whichCode == 13)
        return true;
    key = String.fromCharCode(whichCode); // Valor para o código da Chave
    if (strCheck.indexOf(key) == -1)
        return false; // Chave inválida
    len = objTextBox.value.length;
    for (i = 0; i < len; i++)
        if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal))
            break;
    aux = '';
    for (; i < len; i++)
        if (strCheck.indexOf(objTextBox.value.charAt(i)) != -1)
            aux += objTextBox.value.charAt(i);
    aux += key;
    len = aux.length;
    if (len == 0)
        objTextBox.value = "";
    if (len == 1)
        objTextBox.value = "0" + SeparadorDecimal + "0" + aux;
    if (len == 2)
        objTextBox.value = "0" + SeparadorDecimal + aux;
    if (len > 2) {
        aux2 = "";
        for (j = 0, i = len - 3; i >= 0; i--) {
            if (j == 3) {
                aux2 += SeparadorMilesimo;
                j = 0;
            }
            aux2 += aux.charAt(i);
            j++;
        }
        objTextBox.value = "";
        len2 = aux2.length;
        for (i = len2 - 1; i >= 0; i--)
            objTextBox.value += aux2.charAt(i);
        objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
    }
    return false;
}


/****************************************************************************
 *  Calcular valor Unitario 
 * 
 */

function  fn_calcularValorCombo1(valorCalc) {

    var qtd = parseInt($("#quantidadeCombo1").val());

    var total = valorCalc * qtd;


    $("#qtdAddCombo1").val('');

    $("#qtdAddCombo1").val(total);

    var totalgeral = document.getElementById("qtdAddCombo1").value.replace(",", ".");

    $("#qtdAddCombo1").val('R$ ' + totalgeral);
}

/****************************************************************************
 *  Calcular valor Unitario 
 * 
 */

function  fn_calcularValorCombo2(valorCalc) {

    var qtd = parseInt($("#quantidadeCombo2").val());

    var total = valorCalc * qtd;


    $("#qtdAddCombo2").val('');

    $("#qtdAddCombo2").val(total);

    var totalgeral = document.getElementById("qtdAddCombo2").value.replace(",", ".");

    $("#qtdAddCombo2").val('R$ ' + totalgeral + ',00');
}
/****************************************************************************
 *  Calcular valor Unitario 
 * 
 */

function  fn_calcularValorCombo3(valorCalc) {

    var qtd = parseInt($("#quantidadeCombo3").val());

    var total = valorCalc * qtd;


    $("#qtdAddCombo3").val('');

    $("#qtdAddCombo3").val(total);

    var totalgeral = document.getElementById("qtdAddCombo3").value.replace(",", ".");

    $("#qtdAddCombo3").val('R$ ' + totalgeral);
}
/****************************************************************************
 *  Calcular valor Unitario 
 * 
 */

function  fn_calcularValorCombo4(valorCalc) {

    var qtd = parseInt($("#quantidadeCombo4").val());

    var total = valorCalc * qtd;


    $("#qtdAddCombo4").val('');

    $("#qtdAddCombo4").val(total);

    var totalgeral = document.getElementById("qtdAddCombo4").value.replace(",", ".");

    $("#qtdAddCombo4").val('R$ ' + totalgeral);
}
/****************************************************************************
 *  Calcular valor Unitario 
 * 
 */

function  fn_calcularValorCombo5(valorCalc) {

    var qtd = parseInt($("#quantidadeCombo5").val());

    var total = valorCalc * qtd;


    $("#qtdAddCombo5").val('');

    $("#qtdAddCombo5").val(total);

    var totalgeral = document.getElementById("qtdAddCombo5").value.replace(",", ".");

    $("#qtdAddCombo5").val('R$ ' + totalgeral);
}
/****************************************************************************
 *  Calcular valor Unitario 
 * 
 */

function  fn_calcularValorCombo6(valorCalc) {

    var qtd = parseInt($("#quantidadeCombo6").val());

    var total = valorCalc * qtd;


    $("#qtdAddCombo6").val('');

    $("#qtdAddCombo6").val(total);

    var totalgeral = document.getElementById("qtdAddCombo6").value.replace(",", ".");

    $("#qtdAddCombo6").val('R$ ' + totalgeral);
}

function  fn_calcularPedidos(valorCalc) {
    
    
    var qtd = parseInt($("#quantidade").val());

    var total = valorCalc * qtd;
    
    $("#qtdAdd").val('');

    $("#qtdAdd").val(total);

    var totalgeral = document.getElementById("qtdAdd").value.replace(",", ".");

    $("#qtdAdd").val('R$ ' + totalgeral);
}

/*******************************************************************************
 * 
 */

function MascaraMoeda1(objTextBox, SeparadorMilesimo, SeparadorDecimal, e) {
    var sep = 0;
    var key = '';
    var i = j = 0;
    var len = len2 = 0;
    var strCheck = '0123456789';
    var aux = aux2 = '';
    var whichCode = (window.Event) ? e.which : e.keyCode;
    if (whichCode == 13 || whichCode == 8)
        return true;
    key = String.fromCharCode(whichCode); // Valor para o código da Chave    
    if (strCheck.indexOf(key) == -1)
        return false; // Chave inválida    
    len = objTextBox.value.length;
    for (i = 0; i < len; i++)
        if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal))
            break;
    aux = '';
    for (; i < len; i++)
        if (strCheck.indexOf(objTextBox.value.charAt(i)) != -1)
            aux += objTextBox.value.charAt(i);
    aux += key;
    len = aux.length;
    if (len == 0)
        objTextBox.value = '';
    if (len == 1)
        objTextBox.value = '0' + SeparadorDecimal + '0' + aux;
    if (len == 2)
        objTextBox.value = '0' + SeparadorDecimal + aux;
    if (len > 2) {
        aux2 = '';
        for (j = 0, i = len - 3; i >= 0; i--) {
            if (j == 3) {
                aux2 += SeparadorMilesimo;
                j = 0;
            }
            aux2 += aux.charAt(i);
            j++;
        }
        objTextBox.value = '';
        len2 = aux2.length;
        for (i = len2 - 1; i >= 0; i--)
            objTextBox.value += aux2.charAt(i);
        objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
    }
    return false;
}

/******************************************************************************
 * 
 */

function verificarQtdPedido(qtd, categoria) {

    if (qtd < 25 && (categoria == 1 || categoria == 2)) {
        alert('Atenção, você pode pedir no minimo 25 por centro');
    }

}
