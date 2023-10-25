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
  console.log(allexpanded);

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
    all.disabled = false;
    all.checked = true;
  } else {
    all.disabled = true;
    all.checked = false;
  }
}

function checkInput(id, event){
  var input1 = document.getElementById(id);
  var input2 = document.getElementById(event.target.id);

  if(input2.value != ""){
    input1.disabled = true;
  } else {
    input1.disabled = false;
  }
}

