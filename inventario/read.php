<?php
 namespace controladores;
 require_once("../autoload.php");
 use modelos\{productos, proveedores, usuarios};
   $productos = new productos();
    $proveedores = new proveedores();
    $empleados = new usuarios();

  //Filters Methods
  $ubicacionesResult = $productos->GetUbicaciones();
  $categoriasResult = $productos->GetCategorias();
  $materialesResult = $productos->GetMateriales();
  $proveedoresResult = $proveedores->GetNombresProveedores();
  if (!isset($_SESSION['logged_usr'])) {
    header('Location: ./../auth/login.php');
      exit;
  } else {
      $user_id = $_SESSION['logged_usr'];
      $user = $empleados->GetUsuarioById($user_id);
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
 .focused.search{
    border-color: #86b7fe !important;
    box-shadow: none !important;
    outline: 0 none !important;
 }

 .focused.filter{
    border-color: rgb(33,37,41) !important;
    box-shadow: none !important;
    outline: 0 none !important;
 }
</style>
<body class="container-fluid">
    <section class="index_section row">
        <!-- MAIN NAV -->
        <nav class="navHome d-flex flex-column flex-shrink-0 bg-light p-0 border-end" style="width: 4.5rem; position: sticky; height: 100vh; top: 0;">
            <a href="#" class="d-block py-3 text-decoration-none mx-auto" data-bs-toggle="tooltip" data-bs-placement="right" title="JEMAS">
                <img src="../sources/imgs/logo.png" alt="" srcset="" style="width: 45px;">
            </a>
            <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                <li class="nav-item">
                    <a href="../dashboard.php" class="nav-link py-3 border-bottom rounded-0 link-dark border-top" data-bs-toggle="tooltip" data-bs-placement="right" title="Home">
                        <iconify-icon icon="ic:round-home" width="40" height="40"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="./read.php" class="option_container nav-link active py-3 border-bottom rounded-0 bg-dark" data-bs-toggle="tooltip" data-bs-placement="right" title="Inventario">
                        <iconify-icon class="iconify" icon="ic:baseline-inventory" width="30" height="30"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="../proveedores/read.php" class="option_container nav-link py-3 border-bottom rounded-0 link-dark" data-bs-toggle="tooltip" data-bs-placement="right" title="Proveedores">
                        <iconify-icon class="iconify" icon="fa-solid:users" width="30" height="30"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="../empleados/read.php" class="option_container nav-link py-3 border-bottom rounded-0 link-dark" data-bs-toggle="tooltip" data-bs-placement="right" title="Empleados">
                        <iconify-icon class="iconify" icon="clarity:employee-solid" width="30" height="30"></iconify-icon>
                    </a>
                </li>
            </ul>
            <div class="border-top dropup">
                <a href="#" class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle"
                    data-bs-toggle="dropdown"  data-bs-offset="10,0">
                    <iconify-icon class="iconify" icon="mingcute:user-4-fill" width="30" height="30"></iconify-icon>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#" class="dropdown-item">Mensages</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a href="#" class="dropdown-item disabled" tabindex="-1"><?= $user['nombre_usr']. ' ' .$user['apellido_usr']?></a></li>
                </ul>
            </div>
        </nav>
        <!-- MAIN CONTAINER -->
        <section class="main_container col-lg-11 ms-3">
            <!-- PRODUCTS NAV -->
            <ul class="nav nav-tabs my-4">
                <li class="nav-item">
                    <a href="./read.php" class="nav-link active" aria-current="page">Ver Productos</a>
                </li>
                <li class="nav-item">
                    <a href="./add.php" class="nav-link">Agregar Producto</a>
                </li>
                <li class="nav-item">
                    <a href="./extras/add.php" class="nav-link" aria-current="page">Agregar Tags</a>
                </li>
            </ul>
            <!-- SEARCH BAR AND FILTER BUTTON -->
            <div class="read_header row my-4 align-items-center">
                <!-- SEARCH BAR -->
                <div class="col-lg-11">
                    <div class="search_bar input-group">
                        <button type="button" name="submit" id="search-button" class="btn border border-end-0 search" style="background-color: #FFF">
                            <iconify-icon icon="circum:search" width="30" height="30"></iconify-icon>
                        </button>
                        <div class="form-floating flex-grow-1">
                            <input type="text" name="search" id="search" placeholder="Buscar" class="form-control border-start-0 search">
                            <label for="search" id="keyword">Buscar</label>
                        </div>
                    </div>
                </div>
                <!-- BTN MODAL/FILTER -->
                <div class="col-lg-1 d-flex justify-content-end" >
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-filter">
                        <button type="button" name="filter" id="filter" class="btn btn-outline-secondary border-0 " data-bs-toggle="tooltip" data-bs-placement="bottom" title="Filtros">
                            <iconify-icon icon="mdi:filter-cog-outline" width="30" height="30"></iconify-icon>
                        </button>
                    </a>
                <!-- FILTER MODAL -->
                <form class="search_bar" id="AplicarFiltros">
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
                                                <btn type="btn" class="btn border border-end-0 filter" id="proveedor-button">
                                                    <iconify-icon icon="circum:search" width="20" height="20"></iconify-icon>
                                                </btn>
                                                <input list="datalist-proveedores" name="proveedor" id="proveedor" placeholder="Buscar Proveedor"
                                                class="form-control border-start-0 rounded-end filter">
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
                                                <btn type="btn" class="btn border border-end-0 filter" id="ubicacion-button">
                                                    <iconify-icon icon="circum:search" width="20" height="20"></iconify-icon>
                                                </btn>
                                                <input type="text" list="datalist-ubicaciones" name="ubicacion" id="ubicacion" placeholder="Buscar Ubicacion"
                                                class="form-control border-start-0 rounded-end filter">
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
                                                        <input type="checkbox" name="materiales[]" value="<?= $material['id'] ?>" id="<?= $material['material'] ?>"
                                                        class="btn-check materials-check" autocomplete="off" onclick="checkAll('materials-check', 'All-Materials')">
                                                        <label for="<?= $material['material'] ?>" class="btn btn-outline-secondary btn-sm"><?= $material['material'] ?></label>
                                                    </div>
                                                <?php } ?>
                                                <div class="col-auto">
                                                    <input type="checkbox" name="" id="All-Materials" class="btn-check" autocomplete="off" checked disable>
                                                    <label for="All-Materials" class="btn btn-outline-secondary btn-sm">Todos</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h5>Categorias</h5>
                                            <div class="row">
                                                <?php foreach($categoriasResult as $categoria) { ?>
                                                    <div class="col-auto">
                                                        <input type="checkbox" name="categorias[]" value="<?= $categoria['id'] ?>" id="<?= $categoria['categoria'] ?>"
                                                        class="btn-check categories-check" autocomplete="off" onclick="checkAll('categories-check', 'All-Categorias')">
                                                        <label for="<?= $categoria['categoria'] ?>" class="btn btn-outline-secondary btn-sm"><?= $categoria['categoria'] ?></label>
                                                    </div>
                                                <?php } ?>
                                                <div class="col-auto">
                                                    <input type="checkbox" name="" id="All-Categorias" class="btn-check" autocomplete="off" checked disable>
                                                    <label for="All-Categorias" class="btn btn-outline-secondary btn-sm">Todos</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- RANGE INPUTS -->
                                    <div>
                                        <!-- WEIGHT -->
                                        <div class="row mb-4">
                                            <div class="row">
                                                <label for="peso" class="h5 form-check-label w-auto">Peso</label>
                                                <div class="form-check form-switch w-auto">
                                                    <input type="checkbox" name="peso" id="peso"
                                                        class="form-check-input bg-secondary border-secondary" data-bs-toggle="collapse" data-bs-target="#peso-inputs">
                                                </div>
                                            </div>
                                            <div class="row collapse" id="peso-inputs">
                                                <div class="col-lg-6">
                                                    <div class="input-group col-lg-6">
                                                        <span class="input-group-text">menor a</span>
                                                        <input type="number" min="0" step="0.01"  class="form-control" name="peso-menor-a" id="peso-menor-a"
                                                        placeholder="Gramos" oninput="checkInput('peso-mayor-a',event)" value="">
                                                        <span class="input-group-text">gr</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-group col-lg-6">
                                                        <span class="input-group-text">mayor a</span>
                                                        <input type="number" min="0" step="0.01"  class="form-control" name="peso-mayor-a" id="peso-mayor-a"
                                                        placeholder="Gramos" oninput="checkInput('peso-menor-a',event)" value="">
                                                        <span class="input-group-text">gr</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- QUANTITY -->
                                        <div class="row mb-4">
                                            <div class="row">
                                                <label for="cantidad" class="h5 form-check-label w-auto">Cantidad</label>
                                                <div class="form-check form-switch w-auto">
                                                    <input type="checkbox" name="cantidad" id="cantidad" value="cantidad"
                                                        class="form-check-input bg-secondary border-secondary" data-bs-toggle="collapse" data-bs-target="#cantidad-inputs">
                                                </div>
                                            </div>
                                            <div class="row collapse" id="cantidad-inputs">
                                                <div class="col-lg-6">
                                                    <div class="input-group col-lg-6">
                                                        <span class="input-group-text">menor a</span>
                                                        <input type="number" min="0"  class="form-control" name="cantidad-menor-a" id="cantidad-menor-a"
                                                        placeholder="Cantidad" oninput="checkInput('cantidad-mayor-a',event)" value="">
                                                        <span class="input-group-text">en existencia</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-group col-lg-6">
                                                        <span class="input-group-text">mayor a</span>
                                                        <input type="number" min="0"  class="form-control" name="cantidad-mayor-a" id="cantidad-mayor-a"
                                                        placeholder="Cantidad" oninput="checkInput('cantidad-menor-a',event)" value="">
                                                        <span class="input-group-text">en existencia</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- PRICE COST -->
                                        <div class="row mb-4">
                                            <div class="row">
                                                <label for="precio-de-compra" class="h5 form-check-label w-auto">Precio de Compra</label>
                                                <div class="form-check form-switch w-auto">
                                                    <input type="checkbox" name="precio-de-compra" id="precio-de-compra" value="precio-de-compra"
                                                        class="form-check-input bg-secondary border-secondary" data-bs-toggle="collapse" data-bs-target="#precio-de-compra-inputs">
                                                </div>
                                            </div>
                                            <div class="row collapse" id="precio-de-compra-inputs">
                                                <div class="col-lg-6">
                                                    <div class="input-group col-lg-6">
                                                        <span class="input-group-text">menor a $</span>
                                                        <input type="number" min="0" step="0.01"  class="form-control" name="precio-de-compra-menor-a" id="precio-de-compra-menor-a"
                                                        placeholder="mayor que" oninput="checkInput('precio-de-compra-mayor-a',event)" value="">
                                                        <span class="input-group-text">MX</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-group col-lg-6">
                                                        <span class="input-group-text">mayor a $</span>
                                                        <input type="number" min="0" step="0.01"  class="form-control" name="precio-de-compra-mayor-a" id="precio-de-compra-mayor-a"
                                                        placeholder="pesos" oninput="checkInput('precio-de-compra-menor-a',event)" value="">
                                                        <span class="input-group-text">MX</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- PRICE SALE -->
                                        <div class="row mb-4">
                                            <div class="row">
                                                <label for="precio-de-venta" class="h5 form-check-label w-auto">Precio de Venta</label>
                                                <div class="form-check form-switch w-auto">
                                                    <input type="checkbox" name="precio-de-venta" id="precio-de-venta" value="precio-de-venta"
                                                        class="form-check-input bg-secondary border-secondary" data-bs-toggle="collapse" data-bs-target="#precio-de-venta-inputs">
                                                </div>
                                            </div>
                                            <div class="row collapse" id="precio-de-venta-inputs">
                                                <div class="col-lg-6">
                                                    <div class="input-group col-lg-6">
                                                        <span class="input-group-text">menor a $</span>
                                                        <input type="number" min="0" step="0.01"  class="form-control" name="precio-de-venta-menor-a" id="precio-de-venta-menor-a"
                                                        placeholder="mayor que" oninput="checkInput('precio-de-venta-mayor-a',event)" value="">
                                                        <span class="input-group-text">MX</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-group col-lg-6">
                                                        <span class="input-group-text">mayor a $</span>
                                                        <input type="number" min="0" step="0.01"  class="form-control" name="precio-de-venta-mayor-a" id="precio-de-venta-mayor-a"
                                                        placeholder="pesos" oninput="checkInput('precio-de-venta-menor-a',event)" value="">
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
            <!-- PRODUCTS RESULT -->
            <section class="dashboard_container container" id="mainContainer">
                <!-- COLLAPSE BUTTON -->
                <div class="row mx-1 my-3">
                    <div class="d-flex">
                        <button type="button" id="Alternar" class="btn btn-outline-secondary btn-sm ms-auto">Expandir</button>
                        <button type="button" id="flex" class="btn btn-outline-secondary btn-sm ms-2">Todo</button>
                    </div>
                </div>

                <main class="dashboard_container container" id="main">

                </main>
                <nav>
                    <ul class="pagination justify-content-center" id="index">

                    </ul>
                </nav>
            </section>
        </section>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script src="../sources/js/app.js"></script>
<script src="../sources/js/readInventario.js"></script>
</html>
