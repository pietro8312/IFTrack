// seleciona a mensagem de erro
const msg = document.querySelector('.msg');

if (msg) {
    msg.style.display = 'flex'
    // depois de 3 segundos, some a mensagem
    setTimeout(() => {
        msg.style.animation = 'remover .5s forwards'
        setTimeout(() => msg.remove, 500);
    }, 4000); // 3000ms = 3s
}