// It display the subtions for each option in the nav bar when the user clicks on it
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


// Hide the nav bar when the user clicks on the arrow and save the state in the local storage
// to keep the state when the user refresh the page
const nav = document.querySelector('.navHome')
const navButton = document.querySelector('#NavArrow')

if(localStorage.getItem('navHidden') === 'true'){
    nav.classList.add('hidden')
    navButton.classList.add('target')
} else {
    nav.classList.remove('hidden')
    navButton.classList.remove('target')
}

navButton.addEventListener('click', () => {
    if(nav.classList.contains('hidden') && navButton.classList.contains('target')){
        nav.classList.remove('hidden')
        navButton.classList.remove('target')
    }else{
        nav.classList.add('hidden')
        navButton.classList.add('target')
    }

    localStorage.setItem('navHidden', nav.classList.contains('hidden'))
})
    