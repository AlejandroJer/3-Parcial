const index = document.querySelectorAll('.option')

index.forEach((item) => {
    item.children[0].addEventListener('click', () => {
        if(item.classList.contains('target')){
            item.classList.remove('target')
            item.children[1].classList.add('hidden')
        }else{
            for(let i = 0; i < index.length; i++){
                index[i].classList.remove('target')
                index[i].children[1].classList.add('hidden')
            }
            item.classList.add('target')
            item.children[1].classList.remove('hidden')
        }
    })
})

const nav = document.querySelector('.navHome')
const navButton = document.querySelector('#NavArrow')

navButton.addEventListener('click', () => {
    if(nav.classList.contains('hidden') && navButton.classList.contains('target')){
        nav.classList.remove('hidden')
        navButton.classList.remove('target')
    }else{
        nav.classList.add('hidden')
        navButton.classList.add('target')
    }
})