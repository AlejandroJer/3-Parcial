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