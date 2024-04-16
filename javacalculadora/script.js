function salvardados(){
    var operacao= document.getElementById('operacao').value;
    var primeirovalor= parseInt(document.getElementById('1stnumber').value);
    var segundovalor=  parseInt(document.getElementById('2stnumber').value);
    let resultado = 0;

    switch (operacao){
        case "Soma":
            resultado = primeirovalor + segundovalor
        break;

        case "Subtracao":
            resultado = primeirovalor - segundovalor
        break;

        case "Multiplicacao":
            resultado = primeirovalor * segundovalor
        break;

        case "Divisao":
            if (segundovalor === 0 ){
                alert ("Impossivel dividir por 0")
            }else {
                resultado = primeirovalor / segundovalor
            }
        break;
    }
    console.log("Seu resultado é igual à: " + resultado)
    document.getElementById('mostraresultado').textContent = resultado;
}