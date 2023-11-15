<?php
 namespace controladores;
 require_once("../autoload.php");
 use modelos\{proveedores, usuarios};
    $proveedores = new proveedores();
    $empleados = new usuarios();
    $proveedoresResults = $proveedores->GetNombresProveedores();
    if (!isset($_SESSION['logged_usr'])) {
        header('Location: ./../auth/login.php');
        exit;
    } else {
        $user_id = $_SESSION['logged_usr'];
        $user = $empleados->GetUsuarioById($user_id);
    }

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
                    <a href="../inventario/read.php" class="option_container nav-link active py-3 border-bottom rounded-0 bg-dark" data-bs-toggle="tooltip" data-bs-placement="right" title="Inventario">
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
        <section class="main_container col-lg-11 ms-3">
            <!-- PRODUCTS NAV -->
            <ul class="nav nav-tabs mt-4">
                <li class="nav-item">
                    <a href="./read.php" class="nav-link">Ver Productos</a>
                </li>
                <li class="nav-item">
                    <a href="./add.php" class="nav-link active" aria-current="page">Borrar Inventario</a>
                </li>
            </ul>
            <!-- MAIN CONTENT -->
            <main class="dashboard_container container">
                <!-- FORM - to delete products -->
                <form action="../controladores/deletes/DeleteProducto.php" method="post" enctype="multipart/form-data" class="my-4 needs-validation" novalidate>
                    <input type="hidden" name="id_inv" value="null">
                    <div class="row">
                        <div class="col-lg-10">
                            <!-- NOMBRE -->
                            <div class="row my-3">
                                <div class="col-lg-2">
                                    <label for="producto-nombre" class="d-flex justify-content-end col-form-label fs-4">Nombre:</label>
                                </div>
                                <div class="col-lg-10 ">
                                    <input type="text" class="form-control" name="producto-nombre" id="producto-nombre" placeholder="Nombre del producto" value="<?= $result['nombre_producto']; ?>" disabled>
                                </div>
                            </div>
                            <!-- PROVEEDOR -->
                            <div class="row mb-3">
                                <div class="col-lg-2">
                                    <label for="producto-proveedor" class="d-flex justify-content-end col-form-label fs-4">Proveedor:</label>
                                </div>
                                <div class="col-lg-10 ">
                                    <select name="producto-proveedor" id="producto-proveedor" class="form-select" disabled>
                                        <option value="" selected>Proveedor del producto</option>
                                        <?php if(!empty($proveedoresResults)) ?>
                                            <?php foreach ($proveedoresResults as $proveedoresResult) { ?>
                                                <option value="<?= $proveedoresResult['id_proveedor']; ?>" <?php if($result['id_proveedor'] == $proveedoresResult['id_proveedor']) { echo 'selected'; } ?>><?= $proveedoresResult['nombre_empresa'];?></option>
                                            <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <!-- CATEGORIA -->
                            <div class="row mb-3">
                                <div class="col-lg-2">
                                    <label for="producto-categoria" class="d-flex justify-content-end col-form-label fs-4">Categoría:</label>
                                </div>
                                <div class="col-lg-10 ">
                                    <select name="categoria" id="producto-categoria" class="form-select" disabled>
                                        <option value="" selected>Categoria del producto</option>
                                        <option value="Anillo" <?php if($result['categoria'] == 'Anillo') { echo 'selected'; } ?>>Anillos</option>
                                        <option value="Collar" <?php if($result['categoria'] == 'Collar') { echo 'selected'; } ?>>Collares y Colgantes</option>
                                        <option value="Pulsera" <?php if($result['categoria'] == 'Pulsera') { echo 'selected'; } ?>>Pulseras</option>
                                        <option value="Pendiente" <?php if($result['categoria'] == 'Pendiente') { echo 'selected'; } ?>>Pendientes</option>
                                        <option value="Reloj" <?php if($result['categoria'] == 'Reloj') { echo 'selected'; } ?>>Relojes</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <img src="<?='./' . $result['imagen']?>" alt="imagen-actual-del-producto" class="col-lg-12 rounded m-auto d-block">
                        </div>
                    </div>
                    <!-- MATERIAL -->
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label for="tipo-material" class="d-flex justify-content-end col-form-label fs-4">Material:</label>
                        </div>
                        <div class="col-lg-10 ">
                            <select name="tipo-material" id="tipo-material" class="form-select" disabled>
                                <option value="" selected>Material del producto</option>
                                <option value="Oro" <?php if($result['tipo_material'] == 'Oro') { echo 'selected'; } ?>>Oro</option>
                                <option value="Plata" <?php if($result['tipo_material'] == 'Plata') { echo 'selected'; } ?>>Plata</option>
                                <option value="Platino" <?php if($result['tipo_material'] == 'Platino') { echo 'selected'; } ?>>Platino</option>    
                            </select>
                        </div>
                    </div>
                    <!-- PRECIO DE VENTA -->
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label for="precio-venta" class="d-flex justify-content-end col-form-label fs-4">Venta:</label>
                        </div>
                        <div class="col-lg-10 ">
                            <input type="number" min="0" step="0.01" class="form-control" name="producto-precio-venta" id="precio-venta" placeholder="Precio MXN venta" value="<?= $result['precio_venta']; ?>" disabled>
                        </div>
                    </div>
                    <!-- PRECIO DE COMPRA -->
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label for="precio-compra" class="d-flex justify-content-end col-form-label fs-4">Compra:</label>
                        </div>
                        <div class="col-lg-10 ">
                            <input type="number" min="0" step="0.01" class="form-control" name="producto-precio-compra" id="precio-compra" placeholder="Precio MXN compra" value="<?= $result['precio_venta']; ?>" disabled>
                        </div>
                    </div>
                    <!-- PESO -->
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label for="peso" class="d-flex justify-content-end col-form-label fs-4">Peso:</label>
                        </div>
                        <div class="col-lg-10 ">
                            <input type="number" min="0" step="0.01"  class="form-control" name="peso" id="peso" placeholder="Gramos" value="<?= $result['peso']; ?>" disabled>
                        </div>
                    </div>
                    <!-- CANTIDAD -->
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label for="cantidad-disponible" class="d-flex justify-content-end col-form-label fs-4">Cantidad:</label>
                        </div>
                        <div class="col-lg-10 ">
                            <input type="number" min="0" class="form-control" name="cantidad-disponible" id="cantidad-disponible" placeholder="Cantidad Disponible" value="<?= $result['cantidad_disponible']; ?>" disabled>
                        </div>
                    </div>
                    <!-- UBICACION -->
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label for="ubicacion-almacen" class="d-flex justify-content-end col-form-label fs-4">Ubicación:</label>
                        </div>
                        <div class="col-lg-10 ">
                            <input type="text" class="form-control" name="ubicacion-almacen" id="ubicacion-almacen" placeholder="Ubicacion en el almacén" value="<?= $result['ubicacion_almacen']; ?>" disabled>
                        </div>
                    </div>
                    <!-- DESCRIPCION -->
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="form-floating">
                                <textarea id="producto-descripcion" class="form-control pt-5" name="producto-descripcion" placeholder="Descripción" style="height: 150px" disabled><?= $result['Descripcion_producto']; ?></textarea>
                                <label for="producto-descripcion" class="fs-4">Descripción:</label>
                            </div>
                        </div>
                    </div>
                    <!-- FORMS BTNS -->
                    <div class="row mb-3 d-flex justify-content-end">
                        <input type="hidden" name="id_producto" value="<?= $result['id_producto'] ?>">
                        <button type="button" class="btn btn-danger col-auto me-3" data-bs-toggle="modal" data-bs-target="#modal-submit">Borrar</button>
                    </div>
                        <!-- MODAL TO UPDATE THE PRODUCT -->
                        <div class="modal fade" id="modal-submit"  tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3>Borrar Producto</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>¿Estás seguro de borrar este producto?</h5>
                                        <p>Esta acción no se puede deshacer.</p>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-between">
                                        <!-- SUBMIT/CANCEL BTN - to submit/cancel the update -->
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-danger" name="submit" id="submit">Borrar</button>
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
