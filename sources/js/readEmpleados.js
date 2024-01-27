
// UTILITIES
 function highlightKeyword(keyword, string) {
    var trimmedKeyword = keyword.trim();

    // Normalize string and keyword
    var normalizedString = String(string).normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
    var normalizedKeyword = trimmedKeyword.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();

    var startPos = normalizedString.indexOf(normalizedKeyword);

    if (startPos !== -1) {
        // Create a regular expression from the keyword
        var pattern = new RegExp(trimmedKeyword, 'gi');

        // Replace matches in string with marked matches
        var newString = string.replace(pattern, function(matched) {
            return '<mark class="p-0">' + matched + '</mark>';
        });
    } else {
        var newString = string;
    }

    return newString;

 } // highlight the keywords in the string
 function checkExpanded() {
  let collapsebtn = document.getElementById('Alternar');
  let elementaccordion = document.querySelectorAll('.accordion-button');
  for (var i = 0; i < elementaccordion.length; i++) {
    if (elementaccordion[i].classList.contains('collapsed')) {
      if (collapsebtn.textContent == 'Expandir') {
        return true;
      } else {
        return false;
      }
    }
  }
    return false;
 } // check if all accordions are expanded or collapsed
 function collapse() {
  let collapsebtn = document.getElementById('Alternar');
  let elementaccordion = document.querySelectorAll('.accordion-button');
  let elementcollapsable = document.querySelectorAll('.card-footer.collapse');

  var allexpanded = checkExpanded()

  for (var i = 0; i < elementaccordion.length; i++) {
    if (allexpanded){
      elementaccordion[i].classList.remove('collapsed');
      elementaccordion[i].setAttribute('aria-expanded', 'true');
      elementcollapsable[i].classList.add('show');
    } else{
      elementaccordion[i].classList.add('collapsed');
      elementaccordion[i].setAttribute('aria-expanded', 'false');
      elementcollapsable[i].classList.remove('show');
    }

    if (collapsebtn){
      collapsebtn.textContent = allexpanded ? 'Colapsar' : 'Expandir';
      localStorage.setItem('collapse', allexpanded);
    }
  }
 } // collapse or expand all accordions
 function collapseRefresh() {
    let collapsebtn = document.getElementById('Alternar');
    let elementaccordion = document.querySelectorAll('.accordion-button');
    let elementcollapsable = document.querySelectorAll('.card-footer.collapse');
  
    for (var i = 0; i < elementaccordion.length; i++) {
        elementaccordion[i].classList.remove('collapsed');
        elementaccordion[i].setAttribute('aria-expanded', 'true');
        elementcollapsable[i].classList.add('show');
  
      if (collapsebtn){
        collapsebtn.textContent = 'Colapsar';
      }
    }
 } // collapse all accordions when page refreshes
 function checkFlex(event = null) {
    // console.log('checkFlex');
    var flex = event.target;

    if (event.type == 'click' || localStorage.getItem('flex')) {
        // console.log('click');
        if (localStorage.getItem('flex') !== null) {
            // console.log('localStorage exist');
            if (localStorage.getItem('flex') == 'false') {
                localStorage.setItem('flex', true);
                flex.textContent = 'Limitar'
                return true;
            } else {
                localStorage.setItem('flex', false);
                flex.textContent = 'Todo'
                return false;
            }
        } else {
            // console.log('localStorage not exist');
            localStorage.setItem('flex', true);
            flex.textContent = 'Limitar'
            return true;
        }
    }
 } // check if the flex is active or not
 function result(results, keyword){
    var main = document.getElementById('main');
    main.classList.remove('d-flex', 'flex-wrap', 'justify-content-center');
    var cards = "";
    results.forEach(result => {
        var imagenSrc = result.imagen ? result.imagen : '../sources/imgs/defaultImg.jpg';
        cards += `
        <div class="readObject_Container target card mb-4">
            <div class="readObject_header card-header">
                <div class="row">
                    <form action="../controladores/edits/UpdateEmpleados.php" method="post" class="form_edit col-auto d-flex align-items-center">
                        <input type="hidden" name="id" value="${result.id_usr}">
                        <button class="button btn btn-primary"> Editar</button>
                    </form>
                    <form action="../controladores/deletes/DeleteEmpleado.php" method="post" class="form_edit col-auto me-auto d-flex align-items-center">
                        <input type="hidden" name="id" value="${result.id_usr}">
                        <button class="button btn btn-danger"> Borrar</button>
                    </form>
                    <div class="accordion col-auto">
                        <div class="row accordion-header">
                            <button type="button" class="accordion-button collapsed bg-transparent shadow-none"
                            data-bs-toggle="collapse" data-bs-target="#Accordion${result.id_usr}">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="principal_data card-body row">
                <div class="row">
                    <div class="image_container col-lg-2">
                        <img src="${imagenSrc}" alt="imagen del usuario" class="img-fluid rounded-start">
                    </div>
                    <div class="data_container col-lg-10">
                        <div class="row">
                            <h2>${highlightKeyword(keyword, result.nombre_usr)} ${highlightKeyword(keyword, result.apellido_usr)}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="data_container hidde card-footer collapse" id="Accordion${result.id_usr}">
                <div class="product_tags row">
                    <h5>Datos del Usuario</h5>
                    <h6>Email: ${highlightKeyword(keyword, result.email_usr)}</h6>
                    <h6>Teléfono: ${highlightKeyword(keyword, result.tel.toString())}</h6>
                </div>
            </div>
        </div>
        `;
    });

    return cards;
 } // create the cards with the results
 function resultFlex(results){
    var main = document.getElementById('main');
    main.classList.add('d-flex', 'flex-wrap', 'justify-content-center');
    var cards = "";
    results.forEach(result => {
        var imagenSrc = result.imagen ? result.imagen : '../sources/imgs/defaultImg.jpg';
        cards += `
                <div class="readObject_Container target card mb-4 me-2 col-2 p-0">
                    <div class="readObject_header card-header">
                        <div class="row justify-content-between">
                            <form action="../controladores/edits/UpdateEmpleados.php" method="post" class="form_edit col-auto d-flex align-items-center pe-0">
                                <input class="" type="hidden" name="id" value="${result.id_usr}">
                                <button class="button btn btn-primary btn-sm px-1"> Editar</button>
                            </form>
                            <form action="../controladores/deletes/DeleteEmpleado.php" method="post" class="form_edit col-auto d-flex align-items-center pe-0">
                                <input class="" type="hidden" name="id" value="${result.id_usr}">
                                <button class="button btn btn-danger btn-sm px-1"> Borrar</button>
                            </form>
                            <div class="accordion col-auto pe-0">
                                <div class="row accordion-header">
                                    <button type="button" class="accordion-button collapsed bg-transparent shadow-none"
                                    data-bs-toggle="collapse" data-bs-target="#Accordion${result.id_usr}">
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="principal_data card-body justify-content-center" style="flex: none;">
                        <img src="${imagenSrc}" alt="imagen del usuario" class="img-fluid rounded-start">
                        <div class="row mt-2">
                            <h4 class="pe-0">${result.apellido_usr}</h4>
                            <h6 class="pe-0">${result.nombre_usr}</h6>
                        </div>
                    </div>
                    <div class="data_container hidde card-footer collapse" id="Accordion${result.id_usr}">
                        <div class="row">
                            <div class="product_info col-lg-12">
                                <h5>Datos</h5>
                                <h6><small>Teléfono: ${result.tel}</small></h6>
                                <h6 class="text-truncate"><small>Correo: ${result.email_usr}</small></h6>
                            </div>
                        </div>
                    </div>
                </div>
        `;
    });

    return cards;
 } // create the cards with the results
 function resultindex(index, pageClicked, data){
   var buttons = "";

   for (var i = 0; i < index; i++){
       if (i == pageClicked){
           buttons += `
               <li class="page-item active">
                   <button class="page-link submitPaginatedSearch" type="button" data-hidden="${data}" value="${i}">${i + 1}</button>
               </li>
           `;
       } else {
           buttons += `
               <li class="page-item">
                   <button class="page-link submitPaginatedSearch" type="button" data-hidden="${data}" value="${i}">${i + 1}</button>
               </li>
           `;
       }
   };

   return buttons;
 } // create the buttons for pagination

// AJAX CALLS
 function search(){
    var search = $('#search').val();

    $.ajax({
        url: '../controladores/gets/SearchUsuario.php',
        type: 'POST',
        data: {search: search, submit: 'submit'},
        success: function(data){
            // console.log(data);
            data = JSON.parse(data);

            if (search == ""){
                $('#keyword').html('Buscar');
            } else {
                $('#keyword').html('Buscar: "' + search + '"');
            }
            $('#main').html(result(data.results, search));
            $('#index').html(resultindex(data.index, data.pageClicked, search));

            var event = new CustomEvent('contentLoaded');
            document.dispatchEvent(event);

            // Check localStorage and call collapse if necessary
            if (localStorage.getItem('collapse') == 'true') {
                collapseRefresh();
            }

            // Check localStorage and call flex if necessary
            if (localStorage.getItem('flex') == 'true') {
                checkFlex({target: flex});
            }
        }
    });
 }; // search for a product
 function searchPage(){
    var pageClicked = $(this).val();
    var keyword = $(this).data('hidden');

    $.ajax({
        url: '../controladores/gets/SearchUsuario.php',
        type: 'POST',
        data: {search: keyword, keyword: 'submit', submitPaginated: pageClicked},
        success: function(data){
            data = JSON.parse(data);

            if (keyword == ""){
                $('#keyword').html('Buscar');
            } else {
                $('#keyword').html('Buscar: "' + keyword + '"');
            }
            $('#main').html(result(data.results, keyword));
            $('#index').html(resultindex(data.index, data.pageClicked, keyword));

            var event = new CustomEvent('contentLoaded');
            document.dispatchEvent(event);

            // Check localStorage and call collapse if necessary
            if (localStorage.getItem('collapse') == 'true') {
                collapseRefresh();
            }

            // Check localStorage and call flex if necessary
            if (localStorage.getItem('flex') == 'true') {
                checkFlex({target: flex});
            }
        }
    });
}; // search for a product in a specific page // read all the products in a specific page
function searchFlex(){
    var search = '';

   $.ajax({
       url: '../controladores/gets/SearchUsuario.php',
       type: 'POST',
       data: {search: search, submit: 'submit', limit : 1000},
       success: function(data){
           // console.log(data);
           data = JSON.parse(data);

           if (search == ""){
               $('#keyword').html('Buscar');
           } else {
               $('#keyword').html('Buscar: "' + search + '"');
           }
           $('#main').html(resultFlex(data.results, search));
           $('#index').html(resultindex(data.index, data.pageClicked, search));

           var event = new CustomEvent('contentLoaded');
           document.dispatchEvent(event);

           // Check localStorage and call collapse if necessary
           if (localStorage.getItem('collapse') == 'true') {
               collapseRefresh();
           }
       }
   });
}; // search for a product

// EVENT LISTENERS
$(document).ready(search);
$('#search').on('input', search);
$('#index').on('click', '.submitPaginatedSearch', searchPage);
$('#flex').on('click', () => {
    if (localStorage.getItem('flex') !== null) {
        if (localStorage.getItem('flex') == 'false') {
            search();
        } else {
            searchFlex();
        }
    } else {
        searchFlex();
    }
});

document.addEventListener('contentLoaded', () => {
 var collapsebtn = document.getElementById('Alternar');

 collapsebtn ? collapsebtn.addEventListener('click', collapse) : null;
});


