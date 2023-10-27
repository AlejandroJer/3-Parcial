<?php
namespace controladores;
 require_once("../autoload.php");
 use modelos\{utilities, productos, proveedores};
  $highlight = new utilities();
   $productos = new productos();
    $proveedores = new proveedores();
  $ubicacionesResult = $productos->GetUbicaciones();
  $categoriasResult = $productos->GetCategorias();
  $materialesResult = $productos->GetMateriales();
  $proveedoresResult = $proveedores->GetNombresProveedores();
  $materialesResultRows = $productos->GetMaterialesCount();
  $categoriasResultRows = $productos->GetCategoriasCount();



 if(isset($_SESSION['results']) && isset($_SESSION['keyword'])){
    $results = $_SESSION['results'];
    $keyword = $_SESSION['keyword'];
    $index = $_SESSION['index'];
    $page = $_SESSION['pageClicked'];
   }

 if(isset($_SESSION['results']) && isset($_SESSION['filters'])){
    $results = $_SESSION['results'];
    $filters = $_SESSION['filters'];
    $index = $_SESSION['index'];
    $page = $_SESSION['pageClicked'];

    $filtersdecode = json_decode($filters, true);
    $filtersdecodeproveedor = $proveedores->GetNombreEmpresaById($filtersdecode['proveedor']);
 }

 if(!isset($_SESSION['keyword']) || !isset($_SESSION['filters'])){
    if(isset($_SESSION['results'])){
        $main = $_SESSION['results'];
        $index = $_SESSION['index'];
        $page = $_SESSION['pageClicked'];
    } else {
        $limit = 3;
        $main = $productos->GetproductosLimited(0, $limit);
        $index = $productos->GetproductosIndex();
        $index = ceil($index/$limit);
        $page = 0;
    }
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JEMAS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../sources/css/root.css">
</head>
<style>
 .focused{
    border-color: #86b7fe !important;
    box-shadow: none !important;
    outline: 0 none !important;
 }
</style>
<body class="container-fluid">
    <section class="index_section row vh-100">
        <!-- MAIN NAV -->
        <nav class="navHome d-flex flex-column flex-shrink-0 bg-light p-0 border-end" style="width: 4.5rem">
            <a href="#" class="d-block p-3 link-secondary text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="right" title="JEMAS">
                <iconify-icon icon="map:jewelry-store" width="40" height="40"></iconify-icon>
            </a>
            <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                <li class="nav-item">
                    <a href="../dashboard.php" class="nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
                        <iconify-icon icon="bxs:dashboard" width="30" height="30"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="../inventario/add.php" class="option_container nav-link active py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Inventario">
                        <iconify-icon class="iconify" icon="ic:baseline-inventory" width="30" height="30"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="../proveedores/add.php" class="option_container nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Proveedores">
                        <iconify-icon class="iconify" icon="fa-solid:users" width="30" height="30"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="../empleados/add.php" class="option_container nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Empleados">
                        <iconify-icon class="iconify" icon="clarity:employee-solid" width="30" height="30"></iconify-icon>
                    </a>
                </li>
            </ul>
            <div class="border-top">
                <a href="../auth/login.php" class="d-flex align-items-center justify-content-center p-3 link-primary text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="right" title="Iniciar Sesion">
                    <iconify-icon class="iconify" icon="clarity:sign-in-solid" width="30" height="30"></iconify-icon>
                </a>
            </div>
        </nav>

        <section class="main_container col-lg-11 ms-3">
            <!-- PRODUCTS NAV -->
            <ul class="nav nav-tabs my-4">
                <li class="nav-item">
                    <a href="./add.php" class="nav-link">Agregar Producto</a>
                </li>
                <li class="nav-item">
                    <a href="./read.php" class="nav-link active" aria-current="page">Ver Productos</a>
                </li>
            </ul>
            <!-- SEARCH BAR AND FILTER BUTTON -->
            <div class="read_header row my-4 align-items-center">
                <!-- SEARCH BAR -->
                <div class="col-lg-11">
                    <form method="POST" action="../controladores/gets/SearchProducto.php" class="search_bar input-group">
                        <button type="submit" name="submit" id="search-button" class="btn border border-end-0" style="background-color: #FFF">
                            <iconify-icon icon="circum:search" width="30" height="30"></iconify-icon>
                        </button>
                        <div class="form-floating flex-grow-1">
                            <input type="text" name="search" id="search" placeholder="Buscar" class="form-control border-start-0">
                        <?php if(!empty($keyword)){?>
                            <label for="search">Resultados para: "<?= $keyword; ?>"</label>
                        <?php } else { ?>
                            <label for="search">Buscar </label>
                        <?php } ?>
                        </div>
                    </form>
                </div>
                <!-- BTN MODAL/FILTER -->
                <div class="col-lg-1">
                    <button type="button" name="filter" id="filter" class="btn btn-outline-secondary border-0" data-bs-toggle="modal" data-bs-target="#modal-filter">
                        <iconify-icon icon="mdi:filter-cog-outline" width="30" height="30"></iconify-icon>
                    </button>
                </div>
                <!-- FILTER MODAL -->
                <form method="POST" action="../controladores/gets/FilterSearchProductos.php" class="search_bar">
                    <div class="modal fade" id="modal-filter"  tabindex="-1">
                        <div class="modal-dialog modal-xl modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3>Filtrar busqueda</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- SEARCH INPUTS -->
                                    <div class="row mb-4">
                                        <div class="col-lg-6">
                                            <h5>Proveedor</h5>
                                            <div class="input-group">
                                                <btn type="btn" class="btn btn-outline-dark border-end-0">
                                                    <iconify-icon icon="fa-solid:search" width="15" height="15"></iconify-icon>
                                                </btn>
                                                <input list="datalist-proveedores" name="filter-search-proov" id="filter-search-proov" placeholder="Buscar Proveedor"
                                                class="form-control border-dark px-2 border-start-0 rounded-end" value="<?= (isset($filtersdecode['proveedor'])) ? $filtersdecodeproveedor : '';?>">
                                                <datalist id="datalist-proveedores">
                                                    <?php foreach($proveedoresResult as $proveedor) { ?>
                                                        <option value="<?= $proveedor['nombre_empresa']; ?>"></option>
                                                    <?php } ?>
                                                </datalist>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <h5>Ubicacion</h5>
                                            <div class="input-group">
                                                <btn type="btn" class="btn btn-outline-dark border-end-0">
                                                    <iconify-icon icon="fa-solid:search" width="15" height="15"></iconify-icon>
                                                </btn>
                                                <input type="text" list="datalist-ubicaciones" name="filter-search-Ubi" id="filter-search-Ubi" placeholder="Buscar Ubicacion"
                                                class="form-control border-dark px-2 border-start-0 rounded-end" value="<?= (isset($filtersdecode['ubicacion'])) ? $filtersdecode['ubicacion'] : '';?>">
                                                <datalist id="datalist-ubicaciones">
                                                    <?php foreach($ubicacionesResult as $ubicacion) { ?>
                                                        <option value="<?= $ubicacion ?>">
                                                    <?php } ?>
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- CHECKS INPUTS  -->
                                    <div class="row mb-4">
                                        <div class="row mb-4">
                                            <h5>Material</h5>
                                            <div class="row">
                                                <?php foreach($materialesResult as $material) { ?>
                                                    <div class="col-auto">
                                                        <input type="checkbox" name="filter-materials[]" value="<?= $material ?>" id="<?= $material ?>"
                                                        class="btn-check materials-check" autocomplete="off" onclick="checkAll('materials-check', 'All-Materials')"
                                                        <?php if(isset($filtersdecode['materiales']) && in_array($material, $filtersdecode['materiales'])) { echo 'checked'; } ?>>
                                                        <label for="<?= $material ?>" class="btn btn-outline-secondary btn-sm"><?= $material ?></label>
                                                    </div>
                                                <?php } ?>
                                                <div class="col-auto">
                                                    <input type="checkbox" name="" id="All-Materials" class="btn-check" autocomplete="off" 
                                                    <?php if(!isset($filtersdecode['materiales']) || count($filtersdecode['materiales']) == $materialesResultRows) { echo 'checked'; } else { ''; } ?> disable>
                                                    <label for="filter-materials" class="btn btn-outline-secondary btn-sm">Todos</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h5>Categorias</h5>
                                            <div class="row">
                                                <?php foreach($categoriasResult as $categoria) { ?>
                                                    <div class="col-auto">
                                                        <input type="checkbox" name="filter-categorias[]" value="<?= $categoria ?>" id="<?= $categoria ?>"
                                                        class="btn-check categories-check" autocomplete="off" onclick="checkAll('categories-check', 'All-Categorias')"
                                                        <?php if(isset($filtersdecode['categorias']) && in_array($categoria, $filtersdecode['categorias'])) { echo 'checked'; } ?>>
                                                        <label for="<?= $categoria ?>" class="btn btn-outline-secondary btn-sm"><?= $categoria ?></label>
                                                    </div>
                                                <?php } ?>
                                                <div class="col-auto">
                                                    <input type="checkbox" name="" id="All-Categorias" class="btn-check" autocomplete="off"
                                                    <?php if(!isset($filtersdecode['categorias']) || count($filtersdecode['categorias']) == $categoriasResultRows) { echo 'checked'; } else { ''; } ?> disable>
                                                    <label for="filter-categorias" class="btn btn-outline-secondary btn-sm">Todos</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- RANGE INPUTS -->
                                    <div>
                                        <!-- WEIGHT -->
                                        <div class="row mb-4">
                                            <div class="row">
                                                <label for="filter-peso" class="h5 form-check-label w-auto">Peso</label>
                                                <div class="form-check form-switch w-auto">
                                                    <input type="checkbox" name="filter-peso" id="filter-peso" value="filter-peso"
                                                            class="form-check-input bg-secondary border-secondary" data-bs-toggle="collapse" data-bs-target="#filter-peso-inputs"
                                                            <?php if(isset($filtersdecode['pesoMenig']) || isset($filtersdecode['pesoMayig'])) { echo 'checked'; } ?>>
                                                </div>
                                            </div>
                                            <div class="row collapse <?php if(isset($filtersdecode['pesoMenig']) || isset($filtersdecode['pesoMayig'])) { echo 'show'; } ?>" id="filter-peso-inputs">
                                                <div class="col-lg-6">
                                                    <div class="input-group col-lg-6">
                                                        <span class="input-group-text">menor a</span>
                                                        <input type="number" min="0" step="0.01"  class="form-control" name="filter-peso-menig" id="filter-peso-menig"
                                                        placeholder="Gramos" oninput="checkInput('filter-peso-mayig',event)" value="<?= (isset($filtersdecode['pesoMenig'])) ? $filtersdecode['pesoMenig'] : '';?>"
                                                        <?= (isset($filtersdecode['pesoMayig'])) ? 'disabled' : '';?>>
                                                        <span class="input-group-text">gr</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-group col-lg-6">
                                                        <span class="input-group-text">mayor a</span>
                                                        <input type="number" min="0" step="0.01"  class="form-control" name="filter-peso-mayig" id="filter-peso-mayig"
                                                        placeholder="Gramos" oninput="checkInput('filter-peso-menig',event)" value="<?= (isset($filtersdecode['pesoMayig'])) ? $filtersdecode['pesoMayig'] : '';?>"
                                                        <?= (isset($filtersdecode['pesoMenig'])) ? 'disabled' : '';?>>
                                                        <span class="input-group-text">gr</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- QUANTITY -->
                                        <div class="row mb-4">
                                            <div class="row">
                                                <label for="filter-cantidad" class="h5 form-check-label w-auto">Cantidad</label>
                                                <div class="form-check form-switch w-auto">
                                                    <input type="checkbox" name="filter-cantidad" id="filter-cantidad" value="filter-cantidad"
                                                            class="form-check-input bg-secondary border-secondary" data-bs-toggle="collapse" data-bs-target="#filter-cantidad-inputs"
                                                            <?php if(isset($filtersdecode['cantidadMenig']) || isset($filtersdecode['cantidadMayig'])) { echo 'checked'; } ?>>
                                                </div>
                                            </div>
                                            <div class="row collapse <?php if(isset($filtersdecode['cantidadMenig']) || isset($filtersdecode['cantidadMayig'])) { echo 'show'; } ?>" id="filter-cantidad-inputs">
                                                <div class="col-lg-6">
                                                    <div class="input-group col-lg-6">
                                                        <span class="input-group-text">menor a</span>
                                                        <input type="number" min="0"  class="form-control" name="filter-cantidad-menig" id="filter-cantidad-menig"
                                                        placeholder="Cantidad" oninput="checkInput('filter-cantidad-mayig',event)" value="<?= (isset($filtersdecode['cantidadMenig'])) ? $filtersdecode['cantidadMenig'] : '';?>"
                                                        <?= (isset($filtersdecode['cantidadMayig'])) ? 'disabled' : '';?>>
                                                        <span class="input-group-text">en existencia</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-group col-lg-6">
                                                        <span class="input-group-text">mayor a</span>
                                                        <input type="number" min="0"  class="form-control" name="filter-cantidad-mayig" id="filter-cantidad-mayig"
                                                        placeholder="Cantidad" oninput="checkInput('filter-cantidad-menig',event)" value="<?= (isset($filtersdecode['cantidadMayig'])) ? $filtersdecode['cantidadMayig'] : '';?>"
                                                        <?= (isset($filtersdecode['cantidadMenig'])) ? 'disabled' : '';?>>
                                                        <span class="input-group-text">en existencia</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- PRICE COST -->
                                        <div class="row mb-4">
                                            <div class="row">
                                                <label for="filter-precioCompra" class="h5 form-check-label w-auto">Precio de Compra</label>
                                                <div class="form-check form-switch w-auto">
                                                    <input type="checkbox" name="filter-precioCompra" id="filter-precioCompra" value="filter-precioCompra"
                                                            class="form-check-input bg-secondary border-secondary" data-bs-toggle="collapse" data-bs-target="#filter-precioCompra-inputs"
                                                            <?php if(isset($filtersdecode['precioCompraMenig']) || isset($filtersdecode['precioCompraMayig'])) { echo 'checked'; } ?>>
                                                </div>
                                            </div>
                                            <div class="row collapse <?php if(isset($filtersdecode['precioCompraMenig']) || isset($filtersdecode['precioCompraMayig'])) { echo 'show'; } ?>" id="filter-precioCompra-inputs">
                                                <div class="col-lg-6">
                                                    <div class="input-group col-lg-6">
                                                        <span class="input-group-text">menor a $</span>
                                                        <input type="number" min="0" step="0.01"  class="form-control" name="filter-precioCompra-menig" id="filter-precioCompra-menig"
                                                        placeholder="mayor que" oninput="checkInput('filter-precioCompra-mayig',event)" value="<?= (isset($filtersdecode['precioCompraMenig'])) ? $filtersdecode['precioCompraMenig'] : '';?>"
                                                        <?= (isset($filtersdecode['precioCompraMayig'])) ? 'disabled' : '';?>>
                                                        <span class="input-group-text">MX</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-group col-lg-6">
                                                        <span class="input-group-text">mayor a $</span>
                                                        <input type="number" min="0" step="0.01"  class="form-control" name="filter-precioCompra-mayig" id="filter-precioCompra-mayig"
                                                        placeholder="pesos" oninput="checkInput('filter-precioCompra-menig',event)" value="<?= (isset($filtersdecode['precioCompraMayig'])) ? $filtersdecode['precioCompraMayig'] : '';?>"
                                                        <?= (isset($filtersdecode['precioCompraMenig'])) ? 'disabled' : '';?>>
                                                        <span class="input-group-text">MX</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- PRICE SALE -->
                                        <div class="row mb-4">
                                            <div class="row">
                                                <label for="filter-precioVenta" class="h5 form-check-label w-auto">Precio de Venta</label>
                                                <div class="form-check form-switch w-auto">
                                                    <input type="checkbox" name="filter-precioVenta" id="filter-precioVenta" value="filter-precioVenta"
                                                            class="form-check-input bg-secondary border-secondary" data-bs-toggle="collapse" data-bs-target="#filter-precioVenta-inputs"
                                                            <?php if(isset($filtersdecode['precioVentaMenig']) || isset($filtersdecode['precioVentaMayig'])) { echo 'checked'; } ?>>
                                                </div>
                                            </div>
                                            <div class="row collapse <?php if(isset($filtersdecode['precioVentaMenig']) || isset($filtersdecode['precioVentaMayig'])) { echo 'show'; } ?>" id="filter-precioVenta-inputs">
                                                <div class="col-lg-6">
                                                    <div class="input-group col-lg-6">
                                                        <span class="input-group-text">menor a $</span>
                                                        <input type="number" min="0" step="0.01"  class="form-control" name="filter-precioVenta-menig" id="filter-precioVenta-menig"
                                                        placeholder="mayor que" oninput="checkInput('filter-precioVenta-mayig',event)" value="<?= (isset($filtersdecode['precioVentaMenig'])) ? $filtersdecode['precioVentaMenig'] : '';?>"
                                                        <?= (isset($filtersdecode['precioVentaMayig'])) ? 'disabled' : '';?>>
                                                        <span class="input-group-text">MX</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-group col-lg-6">
                                                        <span class="input-group-text">mayor a $</span>
                                                        <input type="number" min="0" step="0.01"  class="form-control" name="filter-precioVenta-mayig" id="filter-precioVenta-mayig"
                                                        placeholder="pesos" oninput="checkInput('filter-precioVenta-menig',event)" value="<?= (isset($filtersdecode['precioVentaMayig'])) ? $filtersdecode['precioVentaMayig'] : '';?>"
                                                        <?= (isset($filtersdecode['precioVentaMenig'])) ? 'disabled' : '';?>>
                                                        <span class="input-group-text">MX</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary" name="submit">Aplicar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- MAIN CONTENT -->
            <main class="dashboard_container container">
                <?php if(!empty($results) && empty($filters)){ ?>
                    <!-- COLLAPSE BUTTON -->
                    <div class="row mx-1 my-3">
                        <div class="d-flex">
                            <button type="button" id="Alternar" class="btn btn-outline-secondary btn-sm ms-auto">Expandir</button>
                        </div>
                    </div>
                    <!-- PRODUCTS CARD LOOP -->
                    <?php foreach ($results as $result) { ?>
                        <div class="readObject_Container target card mb-4">
                            <div class="readObject_header card-header">
                                <div class="row">
                                    <form action="../controladores/edits/UpdateProductos.php" method="post" class="form_edit col-auto me-auto d-flex align-items-center">
                                        <input class="" type="hidden" name="id" value=<?php echo $result['id_producto']; ?>>
                                        <button  class="button btn btn-primary"> Editar</button>
                                    </form>
                                    <div class="accordion col-auto">
                                        <div class="row accordion-header">
                                            <button type="button" class="accordion-button collapsed bg-transparent shadow-none"
                                            data-bs-toggle="collapse" data-bs-target="#Accordion<?= $result['id_producto']; ?>">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="principal_data card-body row">
                                <div class="row">
                                    <div class="image_container col-lg-2">
                                        <?php if($result['imagen'] != null) {?>
                                            <img src="<?php echo $result['imagen']; ?>" alt="imagen de producto" class="img-fluid rounded-start">
                                        <?php } ?>
                                    </div>
                                    <div class="data_container col-lg-10">
                                        <div class="row">
                                            <h2><?= $highlight->HighlightKeyword($_SESSION['keyword'],$result['nombre_producto']); ?></h2>
                                            <h4><?= $highlight->HighlightKeyword($_SESSION['keyword'],$result['Descripcion_producto']); ?></h4>
                                        </div>
                                        <div class="row mt-2">
                                            <h6 class="ingreso col-auto me-auto">Precio Venta <br> $<?= $result['precio_venta'];?> pesos</h6>
                                            <h6 class="gasto col-auto me-auto">Precio Compra <br> $<?= $result['precio_compra'];?> pesos</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="data_container hidde card-footer collapse" id="Accordion<?= $result['id_producto']; ?>">
                                <div class="row">
                                    <div class="product_tags col-lg-3">
                                        <h5>TAGS</h5>
                                        <div>
                                            <h6>Categoría: <?php echo $result['categoria'];?></h6>
                                            <h6>Material: <?php echo $result['tipo_material'];?></h6>
                                        </div>
                                    </div>
                                    <div class="product_info col-lg-9">
                                        <h5>Datos del producto</h5>
                                        <h6>Peso: <?= $result['peso'];?> g</h6>
                                        <h6>Cantidad disponible: <?= $result['cantidad_disponible'];?></h6>
                                        <h6>Ubicación Almancen: <?= $result['ubicacion_almacen'];?></h6>
                                        <h6>Proveedor: <?= $proveedores->GetNombreEmpresaById($result['id_proveedor']); ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } elseif(!empty($results) && empty($keyword)){ ?>
                    <!-- COLLAPSE BUTTON -->
                    <div class="row mx-1 my-3">
                        <div class="d-flex">
                            <button type="button" id="Alternar" class="btn btn-outline-secondary btn-sm ms-auto">Expandir</button>
                        </div>
                    </div>
                    <!-- PRODUCTS CARD LOOP -->
                    <?php foreach ($results as $result) { ?>
                        <div class="readObject_Container target card mb-4">
                            <div class="readObject_header card-header">
                                <div class="row">
                                    <form action="../controladores/edits/UpdateProductos.php" method="post" class="form_edit col-auto me-auto d-flex align-items-center">
                                        <input class="" type="hidden" name="id" value=<?php echo $result['id_producto']; ?>>
                                        <button  class="button btn btn-primary"> Editar</button>
                                    </form>
                                    <div class="accordion col-auto">
                                        <div class="row accordion-header">
                                            <button type="button" class="accordion-button collapsed bg-transparent shadow-none"
                                            data-bs-toggle="collapse" data-bs-target="#Accordion<?= $result['id_producto']; ?>">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="principal_data card-body row">
                                <div class="row">
                                    <div class="image_container col-lg-2">
                                        <?php if($result['imagen'] != null) {?>
                                            <img src="<?php echo $result['imagen']; ?>" alt="imagen de producto" class="img-fluid rounded-start">
                                        <?php } ?>
                                    </div>
                                    <div class="data_container col-lg-10">
                                        <div class="row">
                                            <h2><?= $result['nombre_producto']; ?></h2>
                                            <h4><?= $result['Descripcion_producto']; ?></h4>
                                        </div>
                                        <div class="row mt-2">
                                            <h6 class="ingreso col-auto me-auto">Precio Venta <br> $<?= $result['precio_venta'];?> pesos</h6>
                                            <h6 class="gasto col-auto me-auto">Precio Compra <br> $<?= $result['precio_compra'];?> pesos</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="data_container hidde card-footer collapse" id="Accordion<?= $result['id_producto']; ?>">
                                <div class="row">
                                    <div class="product_tags col-lg-3">
                                        <h5>TAGS</h5>
                                        <div>
                                            <h6>Categoría: <?php echo $result['categoria'];?></h6>
                                            <h6>Material: <?php echo $result['tipo_material'];?></h6>
                                        </div>
                                    </div>
                                    <div class="product_info col-lg-9">
                                        <h5>Datos del producto</h5>
                                        <h6>Peso: <?= $result['peso'];?> g</h6>
                                        <h6>Cantidad disponible: <?= $result['cantidad_disponible'];?></h6>
                                        <h6>Ubicación Almancen: <?= $result['ubicacion_almacen'];?></h6>
                                        <h6>Proveedor: <?= $proveedores->GetNombreEmpresaById($result['id_proveedor']); ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } elseif(!empty($_SESSION['keyword']) || !empty($_SESSION['filters'])){ ?>
                    <div class="row mx-1 my-3">
                        <div class="d-flex justify-content-center">
                            <h3>No se encontraron resultados</h3>
                        </div>
                    </div>
                <?php } else {?>
                    <!-- COLLAPSE BUTTON -->
                    <div class="row mx-1 my-3">
                        <div class="d-flex">
                            <button type="button" id="Alternar" class="btn btn-outline-secondary btn-sm ms-auto">Expandir</button>
                        </div>
                    </div>
                    <!-- PRODUCTS CARD LOOP -->
                    <?php foreach ($main as $result) { ?>
                        <div class="readObject_Container target card mb-4">
                            <div class="readObject_header card-header">
                                <div class="row">
                                    <form action="../controladores/edits/UpdateProductos.php" method="post" class="form_edit col-auto me-auto d-flex align-items-center">
                                        <input class="" type="hidden" name="id" value=<?php echo $result['id_producto']; ?>>
                                        <button  class="button btn btn-primary"> Editar</button>
                                    </form>
                                    <div class="accordion col-auto">
                                        <div class="row accordion-header">
                                            <button type="button" class="accordion-button collapsed bg-transparent shadow-none"
                                            data-bs-toggle="collapse" data-bs-target="#Accordion<?= $result['id_producto']; ?>">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="principal_data card-body row">
                                <div class="row">
                                    <div class="image_container col-lg-2">
                                        <?php if($result['imagen'] != null) {?>
                                            <img src="<?php echo $result['imagen']; ?>" alt="imagen de producto" class="img-fluid rounded-start">
                                        <?php } ?>
                                    </div>
                                    <div class="data_container col-lg-10">
                                        <div class="row">
                                            <h2><?= $result['nombre_producto'];?></h2>
                                            <h4><?=$result['Descripcion_producto'];?></h4>
                                        </div>
                                        <div class="row mt-2">
                                            <h6 class="ingreso col-auto me-auto">Precio Venta <br> $<?= $result['precio_venta'];?> pesos</h6>
                                            <h6 class="gasto col-auto me-auto">Precio Compra <br> $<?= $result['precio_compra'];?> pesos</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="data_container hidde card-footer collapse" id="Accordion<?= $result['id_producto']; ?>">
                                <div class="row">
                                    <div class="product_tags col-lg-3">
                                        <h5>TAGS</h5>
                                        <div>
                                            <h6>Categoría: <?php echo $result['categoria'];?></h6>
                                            <h6>Material: <?php echo $result['tipo_material'];?></h6>
                                        </div>
                                    </div>
                                    <div class="product_info col-lg-9">
                                        <h5>Datos del producto</h5>
                                        <h6>Peso: <?= $result['peso'];?> g</h6>
                                        <h6>Cantidad disponible: <?= $result['cantidad_disponible'];?></h6>
                                        <h6>Ubicación Almancen: <?= $result['ubicacion_almacen'];?></h6>
                                        <h6>Proveedor: <?= $proveedores->GetNombreEmpresaById($result['id_proveedor']); ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </main>
            <!-- PAGINATION -->
            <?php if(!empty($index)) {?>
                <nav>
                    <?php if(!empty($keyword)){ ?>
                        <form action="../controladores/gets/SearchProducto.php" method="POST" class="form_pages">
                            <ul class="pagination justify-content-center">
                                <?php for($i = 0; $i < $index; $i++): ?>
                                    <?php if($i == $page){ ?>
                                        <li class="page-item active">
                                            <button type="submit" class="btn_page target page-link" name="submitPaginated" value="<?= $i ?>"><?= $i+1 ?></button>
                                        </li>
                                    <?php } else { ?>
                                        <li class="page-item">
                                            <button type="submit" class="btn_page page-link" name="submitPaginated" value="<?= $i ?>"><?= $i+1 ?></button>
                                        </li>
                                    <?php } ?>
                                <?php endfor; ?>
                            </ul>
                            <input type="hidden" name="searchPaginated" value="<?= $keyword ?>">
                        </form>
                    <?php } elseif(!empty($filters)){ ?>
                        <form action="../controladores/gets/FilterSearchProductos.php" method="POST" class="form_pages">
                            <ul class="pagination justify-content-center">
                                <?php for($i = 0; $i < $index; $i++): ?>
                                    <?php if($i == $page){ ?>
                                        <li class="page-item active">
                                            <button type="submit" class="btn_page target page-link" name="submitFilterPaginated" value="<?= $i ?>"><?= $i+1 ?></button>
                                        </li>
                                    <?php } else { ?>
                                        <li class="page-item">
                                            <button type="submit" class="btn_page page-link" name="submitFilterPaginated" value="<?= $i ?>"><?= $i+1 ?></button>
                                        </li>
                                    <?php } ?>
                                <?php endfor; ?>
                            </ul>
                            <input type="hidden" name="searchFilterPaginated" value="<?= htmlspecialchars($filters) ?>">
                        </form>
                    <?php } else { ?>
                    <form action="../controladores/gets/ReadProductos.php" method="POST" class="form_pages">
                        <ul class="pagination justify-content-center">
                            <?php for($i = 0; $i < $index; $i++): ?>
                                <?php if($i == $page){ ?>
                                    <li class="page-item active">
                                        <button type="submit" class="btn_page target page-link" name="submitPaginated" value="<?= $i ?>"><?= $i+1 ?></button>
                                    </li>
                                <?php } else { ?>
                                    <li class="page-item">
                                        <button type="submit" class="btn_page page-link" name="submitPaginated" value="<?= $i ?>"><?= $i+1 ?></button>
                                    </li>
                                <?php } ?>
                            <?php endfor; ?>
                        </ul>
                    </form>
                    <?php } ?>
                </nav>
            <?php } ?>
        </section>
    </section>
    <!-- DISSBLE THE SESSIONS - to reset the search when fresh the page -->
    <?php unset($_SESSION['results']);
            unset($_SESSION['keyword']); 
              unset($_SESSION['index']);
                 unset($_SESSION['filters']);
              ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script src="../sources/js/app.js"></script>
</html>
