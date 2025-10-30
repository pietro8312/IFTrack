let circulo = document.getElementById('circulo');

let nome = circulo.textContent;
let teste1 = nome.split(' ');

if(teste1.length > 1){
    let nome1 = teste1[0];
    let letra1 = nome1[0];
    let nome2 = teste1[teste1.length - 1];
    let letra2 = nome2[0];
    nome = letra1+letra2;
}else{
    nome = nome.split('');
    let letra1 = nome[0];
    let letra2 = nome[1];

    nome = letra1 + letra2;
}

circulo.textContent = nome;