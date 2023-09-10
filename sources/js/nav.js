const index = document.querySelector('.navHome_ol')

for(let i=1; i < index.children.length; i++){
    index.children[i].addEventListener('click', () => {
        if(index.children[i].classList.contains('active')){
            for(let j=1; j < index.children.length; j++){
                index.children[j].classList.remove('active')
                index.children[j].children[0]?.classList.add('hidden')
            }
        }else{
            for(let j=1; j < index.children.length; j++){
                index.children[j].classList.remove('active')
                index.children[j].children[0]?.classList.add('hidden')
            }

            index.children[i].classList.add('active')
            index.children[i].children[0].classList.remove('hidden')
        }
    })
}