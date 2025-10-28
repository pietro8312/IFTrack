const perfil = document.querySelector('#login');
if(perfil){
    const list = document.querySelector('ul#list-perfil');

    perfil.addEventListener('click', () => {
        if(list.style.display === 'flex'){
            list.style.display = 'none';
        }else{
            list.style.display = 'flex';
        }
    })
}

