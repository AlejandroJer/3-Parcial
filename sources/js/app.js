var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})

document.addEventListener('DOMContentLoaded', function () {
  var forms = document.getElementsByClassName('needs-validation');
  Array.prototype.filter.call(forms, function (form) {
    form.addEventListener('submit', function (event) {
      
      var fileInput = document.getElementById('image');
      if (fileInput && fileInput.files.length === 0) {
        fileInput.classList.add('is-invalid');
      } else if (fileInput) {
        fileInput.classList.remove('is-invalid');
      }

      if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
      console.log(fileInput);
    }, false);
  });
}, false);

var collapsebtn = document.getElementById('Alternar');
var elementaccordion = document.querySelectorAll('.accordion-button');
var elementcollapsable = document.querySelectorAll('.card-footer.collapse');

function checkExpanded() {
  for (var i = 0; i < elementaccordion.length; i++) {
    if (elementaccordion[i].classList.contains('collapsed')) {
      if (collapsebtn.textContent == 'Expandir') {
        return false;
      } else {
        return true;
      }
    }
  }
  return true;
}

function collapse() {
  var allexpanded = checkExpanded()

  for (var i = 0; i < elementaccordion.length; i++) {
    if (allexpanded){
      elementaccordion[i].classList.add('collapsed');
      elementaccordion[i].setAttribute('aria-expanded', 'false');
      elementcollapsable[i].classList.remove('show');
    } else{
      elementaccordion[i].classList.remove('collapsed');
      elementaccordion[i].setAttribute('aria-expanded', 'true');
      elementcollapsable[i].classList.add('show');
    }

    if (collapsebtn){
      collapsebtn.textContent = allexpanded ? 'Expandir' : 'Colapsar';
    }
  }
}

collapsebtn ? collapsebtn.addEventListener('click', collapse) : null;

function checkAll(elementBoxes, elementAll){
  var boxes = document.querySelectorAll("." + elementBoxes);
  var all = document.getElementById(elementAll);
  var allChecked = true;
  var noneChecked = true;

  for (var i = 0; i < boxes.length; i++) {
    if (boxes[i].checked) {
      noneChecked = false;
    } else {
      allChecked = false;
    }
  }

  if(allChecked || noneChecked){
    all.checked = true;
  } else {
    all.checked = false;
  }
}

function checkInput(id, event){
  var input = document.getElementById(id);
  var event = document.getElementById(event.target.id);

  if(event.value != ""){
    input.disabled = true;
  } else {
    input.disabled = false;
  }
}

var input = document.getElementById('search');
var button = document.getElementById('search-button');

function SearchInputFocused(){
  button.classList.add('focused');
  input.classList.add('focused');
}

function SearchInputBlur(){
  button.classList.remove('focused');
  input.classList.remove('focused');
}

if(input){
  input.addEventListener('focus', SearchInputFocused);
  input.addEventListener('blur', SearchInputBlur);
}