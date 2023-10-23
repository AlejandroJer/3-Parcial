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

