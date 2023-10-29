<?php
 namespace controladores;
 require_once("../autoload.php");
 use modelos\proveedores;
    $proveedores = new proveedores();
    $proveedoresResults = $proveedores->GetNombresProveedores();

    // catch the id of the product to update
    $result = $_SESSION['producto'];
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
    .inputfile-warning {
        background-image: url('data:image/svg+xml,%3Csvg xmlns="http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg" width="20" height="20" viewBox="0 0 24 24"%3E%3Cg fill="none"%3E%3Cpath d="M24 0v24H0V0h24ZM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018Zm.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022Zm-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01l-.184-.092Z"%2F%3E%3Cpath fill="%23ffc107" d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2Zm0 2a8 8 0 1 0 0 16a8 8 0 0 0 0-16Zm0 11a1 1 0 1 1 0 2a1 1 0 0 1 0-2Zm0-9a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0V7a1 1 0 0 1 1-1Z"%2F%3E%3C%2Fg%3E%3C%2Fsvg%3E') !important;
    }
</style>
<body class="container-fluid">
    <section class="index_section row vh-100">
        <!-- MAIN NAV -->
        <nav class="navHome d-flex flex-column flex-shrink-0 bg-light p-0 border-end" style="width: 4.5rem">
            <a href="#" class="d-block p-3 link-dark text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="right" title="JEMAS">
                <iconify-icon icon="map:jewelry-store" width="40" height="40"></iconify-icon>
            </a>
            <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                <li class="nav-item">
                    <a href="../dashboard.php" class="nav-link py-3 rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
                        <iconify-icon icon="bxs:dashboard" width="30" height="30"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="../inventario/add.php" class="option_container active nav-link py-3 rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Inventario">
                        <iconify-icon class="iconify" icon="ic:baseline-inventory" width="30" height="30"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="../proveedores/add.php" class="option_container nav-link py-3 rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Proveedores">
                        <iconify-icon class="iconify" icon="fa-solid:users" width="30" height="30"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="../empleados/add.php" class="option_container nav-link py-3 rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Empleados">
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
            <ul class="nav nav-tabs mt-4">
                <li class="nav-item">
                    <a href="./add.php" class="nav-link active" aria-current="page">Actualizar Inventario</a>
                </li>
                <li class="nav-item">
                    <a href="./read.php" class="nav-link">Ver Productos</a>
                </li>
            </ul>
            <!-- MAIN CONTENT -->
            <main class="dashboard_container container">
                <!-- FORM - to add products -->
                <form action="../controladores/edits/UpdateProductos.php" method="post" enctype="multipart/form-data" class="my-4 needs-validation was-validated" novalidate>
                    <input type="hidden" name="id_inv" value="null">
                    <!-- NOMBRE -->
                    <div class="row my-3">
                        <div class="col-lg-2">
                            <label for="producto-nombre" class="d-flex justify-content-end col-form-label fs-4">Nombre:</label>
                        </div>
                        <div class="col-lg-10 ">
                            <input type="text" class="form-control" name="producto-nombre" id="producto-nombre" placeholder="Nombre del producto" value="<?= $result['nombre_producto']; ?>" required>
                            <div class="invalid-feedback">
                                Ingresa un nombre para el producto
                            </div>
                        </div>
                    </div>
                    <!-- PROVEEDOR -->
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label for="producto-proveedor" class="d-flex justify-content-end col-form-label fs-4">Proveedor:</label>
                        </div>
                        <div class="col-lg-10 ">
                            <select name="producto-proveedor" id="producto-proveedor" class="form-select" required>
                                <option value="" selected>Proveedor del producto</option>
                                <?php if(!empty($proveedoresResults)) ?>
                                    <?php foreach ($proveedoresResults as $proveedoresResult) { ?>
                                        <option value="<?= $proveedoresResult['id_proveedor']; ?>" <?php if($result['id_proveedor'] == $proveedoresResult['id_proveedor']) { echo 'selected'; } ?>><?= $proveedoresResult['nombre_empresa'];?></option>
                                    <?php } ?>
                            </select>
                            <div class="invalid-feedback">
                                Selecciona el proveedor del producto
                            </div>
                        </div>
                    </div>
                    <!-- PRECIO DE VENTA -->
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label for="precio-venta" class="d-flex justify-content-end col-form-label fs-4">Venta:</label>
                        </div>
                        <div class="col-lg-10 ">
                            <input type="number" min="0" step="0.01" class="form-control" name="producto-precio-venta" id="precio-venta" placeholder="Precio MXN venta" value="<?= $result['precio_venta']; ?>" required>
                            <div class="invalid-feedback">
                                Ingresa el precio de venta del producto
                            </div>
                        </div>
                    </div>
                    <!-- PRECIO DE COMPRA -->
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label for="precio-compra" class="d-flex justify-content-end col-form-label fs-4">Compra:</label>
                        </div>
                        <div class="col-lg-10 ">
                            <input type="number" min="0" step="0.01" class="form-control" name="producto-precio-compra" id="precio-compra" placeholder="Precio MXN compra" value="<?= $result['precio_venta']; ?>" required>
                            <div class="invalid-feedback">
                                Ingresa el precio de compra del producto
                            </div>
                        </div>
                    </div>
                    <!-- CATEGORIA -->
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label for="producto-categoria" class="d-flex justify-content-end col-form-label fs-4">Categoría:</label>
                        </div>
                        <div class="col-lg-10 ">
                            <select name="categoria" id="producto-categoria" class="form-select" required>
                                <option value="" selected>Categoria del producto</option>
                                <option value="Anillo" <?php if($result['categoria'] == 'Anillo') { echo 'selected'; } ?>>Anillos</option>
                                <option value="Collar" <?php if($result['categoria'] == 'Collar') { echo 'selected'; } ?>>Collares y Colgantes</option>
                                <option value="Pulsera" <?php if($result['categoria'] == 'Pulsera') { echo 'selected'; } ?>>Pulseras</option>
                                <option value="Pendiente" <?php if($result['categoria'] == 'Pendiente') { echo 'selected'; } ?>>Pendientes</option>
                                <option value="Reloj" <?php if($result['categoria'] == 'Reloj') { echo 'selected'; } ?>>Relojes</option>
                            </select>
                            <div class="invalid-feedback">
                                Selecciona la categoria del producto
                            </div>
                        </div>
                    </div>
                    <!-- MATERIAL -->
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label for="tipo-material" class="d-flex justify-content-end col-form-label fs-4">Material:</label>
                        </div>
                        <div class="col-lg-10 ">
                            <select name="tipo-material" id="tipo-material" class="form-select" required>
                                <option value="" selected>Material del producto</option>
                                <option value="Oro" <?php if($result['tipo_material'] == 'Oro') { echo 'selected'; } ?>>Oro</option>
                                <option value="Plata" <?php if($result['tipo_material'] == 'Plata') { echo 'selected'; } ?>>Plata</option>
                                <option value="Platino" <?php if($result['tipo_material'] == 'Platino') { echo 'selected'; } ?>>Platino</option>    
                            </select>
                            <div class="invalid-feedback">
                                Selecciona el material del producto
                            </div>
                        </div>
                    </div>
                    <!-- PESO -->
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label for="peso" class="d-flex justify-content-end col-form-label fs-4">Peso:</label>
                        </div>
                        <div class="col-lg-10 ">
                            <input type="number" min="0" step="0.01"  class="form-control" name="peso" id="peso" placeholder="Gramos" value="<?= $result['peso']; ?>" required>
                            <div class="invalid-feedback">
                                Ingresa el peso en gramos del producto
                            </div>
                        </div>
                    </div>
                    <!-- CANTIDAD -->
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label for="cantidad-disponible" class="d-flex justify-content-end col-form-label fs-4">Cantidad:</label>
                        </div>
                        <div class="col-lg-10 ">
                            <input type="number" min="0" class="form-control" name="cantidad-disponible" id="cantidad-disponible" placeholder="Cantidad Disponible" value="<?= $result['cantidad_disponible']; ?>" required>
                            <div class="invalid-feedback">
                                Ingresa la cantidad disponible del producto
                            </div>
                        </div>
                    </div>
                    <!-- UBICACION -->
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label for="ubicacion-almacen" class="d-flex justify-content-end col-form-label fs-4">Ubicación:</label>
                        </div>
                        <div class="col-lg-10 ">
                            <input type="text" class="form-control" name="ubicacion-almacen" id="ubicacion-almacen" placeholder="Ubicacion en el almacén" value="<?= $result['ubicacion_almacen']; ?>" required>
                            <div class="invalid-feedback">
                                Ingresa la ubicación del producto en el almacén
                            </div>
                        </div>
                    </div>
                    <!-- DESCRIPCION -->
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="form-floating">
                                <textarea id="producto-descripcion" class="form-control pt-5" name="producto-descripcion" placeholder="Descripción" style="height: 150px" required><?= $result['Descripcion_producto']; ?></textarea>
                                <label for="producto-descripcion" class="fs-4">Descripción:</label>
                                <div class="invalid-feedback">
                                    Ingresa una descripción para el producto
                                </div>
                            </div>
                        </div>
                    </div> 
                    <!-- IMAGEN EDIT -->
                    <div class="row mb-5"> 
                        <div class="col-lg-2">
                            <label for="image" class="d-flex justify-content-end col-form-label fs-4">Imagen:</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="file" accept=".jpeg, .png, .jpg "id="image"  name="image" class="form-control border-warning inputfile-warning">
                            <div class="valid-feedback text-warning">
                                Al Seleccionar una imagen nueva se reemplazará la anterior
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card accordion">
                                <div class="card-body accordion-header p-0">
                                    <button type="button" class="accordion-button collapsed bg-transparent shadow-none p-2" data-bs-toggle="collapse" data-bs-target="#db-image">
                                        Imagen Actual
                                    </button>
                                </div>
                                <div class="card-footer collapse" id="db-image">
                                    <img src="<?='./' . $result['imagen']?>" alt="imagen-actual-del-producto" class="img-fluid rounded w-100">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FORMS BTNS -->
                    <div class="row mb-3 d-flex justify-content-end">
                        <input type="hidden" name="id_producto" value="<?= $result['id_producto'] ?>">
                        <button type="button" class="btn btn-secondary col-auto me-3" data-bs-toggle="modal" data-bs-target="#modal-submit">Actualizar</button>
                    </div>
                        <!-- MODAL TO UPDATE THE PRODUCT -->
                        <div class="modal fade" id="modal-submit"  tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3>Actualizar Producto</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>¿Estas seguro de actualizar este producto?</h5>
                                        <p>Al actualizar este producto se reemplazará la información actual por la nueva, siendo una accion irreversible</p>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-between">
                                        <!-- SUBMIT/CANCEL BTN - to submit/cancel the update -->
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-warning" name="submit" id="submit">Actualizar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>
            </main>
        </section>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script src="../sources/js/app.js"></script>
</html>
