// ENABLE BOOTSTRAP TOOLTIPS
 var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
 var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
 })
// ENABLE BOOTSTRAP VALIDATION
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
// UTILS FOR MODAL CHECKBOXES AND INPUTS FOR READ FILTERS
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
// UTILS FOR VISUAL EFFECTS IN INPUTS WITH BUTTONS
 function InputFocused(btn, inp){
  btn.classList.add('focused');
  inp.classList.add('focused');
 }

 function InputBlur(btn, inp){
  btn.classList.remove('focused');
  inp.classList.remove('focused');
 }

 var Searchinput = document.getElementById('search');
 var Searchbutton = document.getElementById('search-button');
 if(Searchinput){
  Searchinput.addEventListener('focus', () => {InputFocused(Searchbutton, Searchinput)});
  Searchinput.addEventListener('blur', () => {InputBlur(Searchbutton, Searchinput)});
 }
 var Provinput = document.getElementById('proveedor');
 var Provbutton = document.getElementById('proveedor-button');
  if(Provinput){
    Provinput.addEventListener('focus', () => {InputFocused(Provbutton, Provinput)});
    Provinput.addEventListener('blur', () => {InputBlur(Provbutton, Provinput)});
  }
 var Ubicinput = document.getElementById('ubicacion');
 var Ubicbutton = document.getElementById('ubicacion-button');
  if(Ubicinput){
    Ubicinput.addEventListener('focus', () => {InputFocused(Ubicbutton, Ubicinput)});
    Ubicinput.addEventListener('blur', () => {InputBlur(Ubicbutton, Ubicinput)});
  }
// UTILS FOR SHOW IMAGE WITH AN INPUT FILE HIDEN
function updateImage(event){
  event.preventDefault();

  var image = document.getElementById('img-image');
  var imageInput = document.getElementById('image');

  imageInput.click();

  imageInput.addEventListener('change', function(){
    var reader = new FileReader();
    reader.onload = function(event){
      image.src = event.target.result;
    }
    reader.readAsDataURL(imageInput.files[0]);
  });
}
// UTILS FOR GET THE VALUE ON A DATA ATTRIBUTE IN A BOTTON WHEN CLICK AND SET IT IN A INPUT
function passValue(event, inputName, inputId){
  var target = event.target;
  var valueName = target.dataset.valuename;
  var valueId = target.dataset.valueid;

  document.getElementById(inputName).value = valueName;
  document.getElementById(inputId).value = valueId;
}
