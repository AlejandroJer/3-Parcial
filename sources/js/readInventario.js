
// UTILITIES
 function highlightKeyword(keyword, string) {
    var trimmedKeyword = keyword.trim();

    // Normalize string and keyword
    var normalizedString = string.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
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
 function result(results, keyword){
    var main = document.getElementById('main');
    main.classList.remove('d-flex', 'flex-wrap', 'justify-content-center');
    var cards = "";
    results.forEach(result => {
        cards += `
                <div class="readObject_Container target card mb-4">
                    <div class="readObject_header card-header">
                        <div class="row">
                            <form action="../controladores/edits/UpdateProductos.php" method="post" class="form_edit col-auto d-flex align-items-center">
                                <input class="" type="hidden" name="id" value="${result.id_producto}">
                                <button class="button btn btn-primary"> Editar</button>
                            </form>
                            <form action="../controladores/deletes/DeleteProducto.php" method="post" class="form_edit col-auto me-auto d-flex align-items-center">
                                <input class="" type="hidden" name="id" value="${result.id_producto}">
                                <button class="button btn btn-danger"> Borrar</button>
                            </form>
                            <div class="accordion col-auto">
                                <div class="row accordion-header">
                                    <button type="button" class="accordion-button collapsed bg-transparent shadow-none"
                                    data-bs-toggle="collapse" data-bs-target="#Accordion${result.id_producto}">
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="principal_data card-body row">
                        <div class="row">
                            <div class="image_container col-lg-2">
                                    <img src="${result.imagen}" alt="imagen de producto" class="img-fluid rounded-start">
                            </div>
                            <div class="data_container col-lg-10">
                                <div class="row">
                                    <h2>${highlightKeyword(keyword, result.nombre_producto)}</h2>
                                    <h4>${highlightKeyword(keyword, result.Descripcion_producto)}</h4>
                                </div>
                                <div class="row mt-2">
                                    <h6 class="ingreso col-auto me-auto">Precio Venta <br> ${result.precio_venta} pesos</h6>
                                    <h6 class="gasto col-auto me-auto">Precio Compra <br> ${result.precio_compra} pesos</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="data_container hidde card-footer collapse" id="Accordion${result.id_producto}">
                        <div class="row">
                            <div class="product_tags col-lg-3">
                                <h5>TAGS</h5>
                                <div>
                                    <h6>Categoría: ${result.id_categoria}</h6>
                                    <h6>Material: ${result.id_material}</h6>
                                </div>
                            </div>
                            <div class="product_info col-lg-9">
                                <h5>Datos del producto</h5>
                                <h6>Peso: ${result.peso} g</h6>
                                <h6>Cantidad disponible: ${result.cantidad_disponible}</h6>
                                <h6>Ubicación Almancen: ${result.ubicacion_almacen}</h6>
                                <h6>Proveedor: ${result.id_proveedor}</h6>
                            </div>
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
        cards += `
                <div class="readObject_Container target card mb-4 me-2 col-2 p-0">
                    <div class="readObject_header card-header">
                        <div class="row justify-content-between">
                            <form action="../controladores/edits/UpdateProductos.php" method="post" class="form_edit col-auto d-flex align-items-center pe-0">
                                <input class="" type="hidden" name="id" value="${result.id_producto}">
                                <button class="button btn btn-primary px-1"> Editar</button>
                            </form>
                            <form action="../controladores/deletes/DeleteProducto.php" method="post" class="form_edit col-auto d-flex align-items-center pe-0">
                                <input class="" type="hidden" name="id" value="${result.id_producto}">
                                <button class="button btn btn-danger px-1"> Borrar</button>
                            </form>
                            <div class="accordion col-auto pe-0">
                                <div class="row accordion-header">
                                    <button type="button" class="accordion-button collapsed bg-transparent shadow-none"
                                    data-bs-toggle="collapse" data-bs-target="#Accordion${result.id_producto}">
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="principal_data card-body row justify-content-center" style="flex: none;">
                        <img src="${result.imagen}" alt="imagen de producto" class="img-fluid rounded-start col-10">
                        <div class="row mt-2">
                            <h6 class="ingreso col-6 pe-0"><small>Venta</small></h6>
                            <h6 class="gasto col-6 pe-0"><small>Compra</small></h6>
                        </div>
                        <div class="row">
                            <h6 class="ingreso col-6 pe-0"><small>$${result.precio_venta}</small></h6>
                            <h6 class="gasto col-6 pe-0"><small>$${result.precio_compra}</small></h6>
                        </div>
                    </div>
                    <div class="data_container hidde card-footer collapse" id="Accordion${result.id_producto}">
                        <div class="row">
                            <div class="product_info col-lg-9">
                                <h5>Datos</h5>
                                <h6><small>Peso: ${result.peso} g</small></h6>
                                <h6><small>Cantidad: ${result.cantidad_disponible}</small></h6>
                                <h6 class="text-truncate"><small>Ubicación: ${result.ubicacion_almacen}</small></h6>
                                <h6 class="text-truncate"><small>Proveedor: ${result.id_proveedor}</small></h6>
                            </div>
                        </div>
                    </div>
                </div>
        `;
    });

    return cards;
 } // create the cards with the results
 function resultindex(index, pageClicked, data, datastatus=true){
    var buttons = "";

    for (var i = 0; i < index; i++){
        if (i == pageClicked){
            if (datastatus){
                buttons += `
                    <li class="page-item active">
                        <button class="page-link submitPaginatedSearch" type="button" data-hidden="${data}" value="${i}">${i + 1}</button>
                    </li>
                `;
            } else {
                buttons += `
                    <li class="page-item active">
                        <button class="page-link submitPaginatedFilter" type="button" data-hidden="${data}" value="${i}">${i + 1}</button>
                    </li>
                `;
            }
        } else {
            if (datastatus){
                buttons += `
                    <li class="page-item">
                        <button class="page-link submitPaginatedSearch" type="button" data-hidden="${data}" value="${i}">${i + 1}</button>
                    </li>
                `;
            } else {
                buttons += `
                    <li class="page-item">
                        <button class="page-link submitPaginatedFilter" type="button" data-hidden="${data}" value="${i}">${i + 1}</button>
                    </li>
                `;
            }
        }
    };

    return buttons;
 } // create the buttons for pagination

// AJAX CALLS
 function search(){
    var search = $(this).val();

    if ($('#index').children().first().children().first().hasClass('submitPaginatedFilter')){
        $('#AplicarFiltros').submit();
    } else {    
        $.ajax({
            url: '../controladores/gets/SearchProducto.php',
            type: 'POST',
            data: {search: search, submit: 'submit'},
            success: function(data){
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
            }
        });
    }
 }; // search for a product
 function searchPage(){
    var pageClicked = $(this).val();
    var keyword = $(this).data('hidden');

    $.ajax({
        url: '../controladores/gets/SearchProducto.php',
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
        }
    });
 }; // search for a product in a specific page // read all the products in a specific page
 function filter(e){
    e.preventDefault();
    var formInputs = $(this).serializeArray();
    var dataInputs = {};

    dataInputs['search'] = $('#search').val();
    $.each(formInputs, function(key, input){
        if(input.value){
            var name = input.name;
            if(name.endsWith('[]')){
                name = name.slice(0, -2);
                if(!dataInputs[name]){
                    dataInputs[name] = [];
                }
                dataInputs[name].push(input.value);
            } else {
                dataInputs[name] = input.value;
            }
        }
    });
    dataInputs['submit'] = 'submit';
    dataInputs['filter'] = 'filter';

    $.ajax({
        url: '../controladores/gets/FilterSearchProductos.php',
        type: 'POST',
        data: dataInputs,
        success: function(data){
            data = JSON.parse(data);

            if (dataInputs['search'] == ""){
                $('#keyword').html('Buscar');
            } else {
                $('#keyword').html('Buscar: "' + dataInputs['search'] + '"');
            }
            $('#main').html(result(data.results, dataInputs['search']));
            $('#index').html(resultindex(data.index, data.pageClicked, dataInputs['search'], false));

            var event = new CustomEvent('contentLoaded');
            document.dispatchEvent(event);

            // Check localStorage and call collapse if necessary
            if (localStorage.getItem('collapse') == 'true') {
                collapseRefresh();
            }
        }
    });
 }; // filter the products
 function filterPage(){
    var formInputs = $('#AplicarFiltros').serializeArray();
    var dataInputs = {};

    dataInputs['submitPaginated'] = $(this).val();
    dataInputs['search'] = $(this).data('hidden');
    $.each(formInputs, function(key, input){
        if(input.value){
            var name = input.name;
            if(name.endsWith('[]')){
                name = name.slice(0, -2);
                if(!dataInputs[name]){
                    dataInputs[name] = [];
                }
                dataInputs[name].push(input.value);
            } else {
                dataInputs[name] = input.value;
            }
        }
    });
    dataInputs['submit'] = 'submit';
    dataInputs['filter'] = 'filter';

    $.ajax({
        url: '../controladores/gets/FilterSearchProductos.php',
        type: 'POST',
        data: dataInputs,
        success: function(data){
            data = JSON.parse(data);

            if (dataInputs['search'] == ""){
                $('#keyword').html('Buscar');
            } else {
                $('#keyword').html('Buscar: "' + dataInputs['search'] + '"');
            }
            $('#main').html(result(data.results, dataInputs['search']));
            $('#index').html(resultindex(data.index, data.pageClicked, dataInputs['search'], false));

            var event = new CustomEvent('contentLoaded');
            document.dispatchEvent(event);

            // Check localStorage and call collapse if necessary
            if (localStorage.getItem('collapse') == 'true') {
                collapseRefresh();
            }
        }
    });
 }; // filter the products in a specific page
 function searchFlex(){
    var search = $(this).val();

    if ($('#index').children().first().children().first().hasClass('submitPaginatedFilter')){
        $('#AplicarFiltros').submit();
    } else {
        $.ajax({
            url: '../controladores/gets/SearchProducto.php',
            type: 'POST',
            data: {search: search, submit: 'submit', limit : 100},
            success: function(data){
                data = JSON.parse(data);

                if (search == ""){
                    $('#keyword').html('Buscar');
                } else {
                    $('#keyword').html('Buscar: "' + search + '"');
                }

                $('#main').html(resultFlex(data.results, search, 'flex'));
                $('#index').html(resultindex(data.index, data.pageClicked, search));

                var event = new CustomEvent('contentLoaded');
                document.dispatchEvent(event);
            }
        });
    }
 }; // search for a product in flex
 

// EVENT LISTENERS
$(document).ready(search);
$('#search').on('input', search);
$('#index').on('click', '.submitPaginatedSearch', searchPage);
$('#AplicarFiltros').on('submit', filter);
$('#index').on('click', '.submitPaginatedFilter', filterPage);
$('#flex').on('click', searchFlex);

document.addEventListener('contentLoaded', () => {
 var collapsebtn = document.getElementById('Alternar');

 collapsebtn ? collapsebtn.addEventListener('click', collapse) : null;
});


