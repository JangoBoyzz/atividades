function salvardados(){
    var nome= document.getElementById('nome').value;
    var senha= document.getElementById('senha').value;
    let nomeC = 'jango';
    let senhaC = '123';

    if ((nome === nomeC) && (senha === senhaC)){
        window.location.href  = "outra.html";
    }else{
        alert ("O usuario ou senha está incorreta!");
    }

    
}
