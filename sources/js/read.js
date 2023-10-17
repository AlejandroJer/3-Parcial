const readObjContainer = document.querySelectorAll('.readObject_Container');
const readObjArrow = document.querySelectorAll('.readObject_header .arrow');
const readObjArrowData = document.querySelectorAll('.readObject_Container > .data_container');

readObjArrow.forEach((item, index) => {
    item.addEventListener('click', () => {
        if(readObjContainer[index].classList.contains('target')){
            readObjArrowData[index].classList.remove('hidden');
            readObjContainer[index].classList.remove('target');
        }else{
            readObjArrowData[index].classList.add('hidden');
            readObjContainer[index].classList.add('target');
        }
    })
})