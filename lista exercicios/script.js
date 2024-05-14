function salvardados(){
    var operacao= document.getElementById('operacao').value;
    var primeirovalor= parseInt(document.getElementById('1stnumber').value);
    var segundovalor=  parseInt(document.getElementById('2stnumber').value);
    let resultado = 0;
    
    switch (operacao){
        case "mostra":
            resultado = primeirovalor - segundovalor
            if (primeirovalor > segundovalor ){
                document.getElementById('maior').textContent = primeirovalor;
                document.getElementById('menor').textContent = segundovalor;
                console.log("O maior número é o Primeiro " + primeirovalor);
                console.log("O menor número é o Segundo " + segundovalor);
            }else {
                document.getElementById('menor').textContent = primeirovalor;
                document.getElementById('maior').textContent = segundovalor;
                console.log("O maior número é o Segundo " + segundovalor);
                console.log("O menor número é o Primeiro " + primeirovalor);
            }
        break;
        break;

        case "dobro":
            resultado = (primeirovalor * 2) + (3 * segundovalor)
            if (primeirovalor > segundovalor ){
                document.getElementById('maior').textContent = primeirovalor;
                document.getElementById('menor').textContent = segundovalor;
                console.log("O maior número é o Primeiro " + primeirovalor);
                console.log("O menor número é o Segundo " + segundovalor);
            }else {
                document.getElementById('menor').textContent = primeirovalor;
                document.getElementById('maior').textContent = segundovalor;
                console.log("O maior número é o Segundo " + segundovalor);
                console.log("O menor número é o Primeiro " + primeirovalor);
            }
        break;
        break;

        case "multiplicacao":
            resultado = primeirovalor * segundovalor
            if (primeirovalor > segundovalor ){
                document.getElementById('maior').textContent = primeirovalor;
                document.getElementById('menor').textContent = segundovalor;
                console.log("O maior número é o Primeiro " + primeirovalor);
                console.log("O menor número é o Segundo " + segundovalor);
            }else {
                document.getElementById('menor').textContent = primeirovalor;
                document.getElementById('maior').textContent = segundovalor;
                console.log("O maior número é o Segundo " + segundovalor);
                console.log("O menor número é o Primeiro " + primeirovalor);
            }
            break;
            break;
    }
    console.log("Seu resultado é igual à: " + resultado)
    document.getElementById('mostraresultado').textContent = resultado;
}

function salvardadosINSS(){
    var nome= document.getElementById('nome').value;
    var salario=  parseInt(document.getElementById('salario').value);
    let liq = 0;
    let inss = 0
    
    inss = salario * 0.08
    liq = salario - inss
        
    console.log("Seu salário líquido é igual à: " + liq)
    document.getElementById('mostraresultadoINSS').textContent = liq;
    document.getElementById('bruto').textContent = salario;
    document.getElementById('inss').textContent = inss;
    document.getElementById('nomef').textContent = nome;
}

function salvardadosDESC(){
    var salario2=  parseFloat(document.getElementById('salario2').value);
    let porc = 0;
    let vDesc = 0;
    let desc = 0;
    let desconto = 0;


    
    if((salario2 > 1000.01) && (salario2 < 1500)){
        desc = 0.085;
        desconto = salario2 * desc
        vDesc = salario2 - desconto;
        porc= "8,5%";
    }else if (salario2 => 1500){
        desc = 0.09;
        desconto = salario2 * desc
        vDesc = salario2 - desconto;
        porc= "9%";
    }else{
        desc = 0.08;
        desconto = salario2 * desc
        vDesc = salario2 - desconto;
        porc= "8%";
    }
    
    console.log("Seu salário líquido é igual à: " + vDesc)
    document.getElementById('porc').textContent = porc;
    document.getElementById('vDesc').textContent = vDesc;
    document.getElementById('bruto2').textContent = salario2;
    document.getElementById('desconto').textContent = desconto;
}