<?php
namespace controladores;
require_once("../autoload.php");
 use modelos\proveedores;
    $proveedores = new proveedores();
    $proveedoresResults = $proveedores->GetNombresProveedores();
if(isset($_SESSION['producto'])){
    $result = $_SESSION['producto'];
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
    .inputfile-warning {
        background-image: url('data:image/svg+xml,%3Csvg xmlns="http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg" width="20" height="20" viewBox="0 0 24 24"%3E%3Cg fill="none"%3E%3Cpath d="M24 0v24H0V0h24ZM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018Zm.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022Zm-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01l-.184-.092Z"%2F%3E%3Cpath fill="%23ffc107" d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2Zm0 2a8 8 0 1 0 0 16a8 8 0 0 0 0-16Zm0 11a1 1 0 1 1 0 2a1 1 0 0 1 0-2Zm0-9a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0V7a1 1 0 0 1 1-1Z"%2F%3E%3C%2Fg%3E%3C%2Fsvg%3E') !important;
    }
</style>
<body class="container-fluid bg-light">
    <section class="index_section row vh-100">
        <nav class="navHome d-flex flex-column flex-shrink-0 bg-light p-0 border-end" style="width: 4.5rem">
            <a href="#" class="d-block p-3 link-dark text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="right" title="JEMAS">
                <iconify-icon icon="map:jewelry-store" width="40" height="40"></iconify-icon>
            </a>
            <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                <li class="nav-item">
                    <a href="../dashboard.php" class="nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
                        <iconify-icon icon="bxs:dashboard" width="30" height="30"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="../inventario/add.php" class="option_container active nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Inventario">
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
                <a href="./auth/login.php" class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="right" title="Iniciar Sesion">
                    <iconify-icon class="iconify" icon="clarity:sign-in-solid" width="30" height="30"></iconify-icon>
                </a>
            </div>
        </nav>

        <section class="main_container col-lg-11 bg-light">
            <ul class="nav nav-tabs mt-4">
                <li class="nav-item">
                    <a href="./add.php" class="nav-link active" aria-current="page"><?php echo (isset($result['id_producto'])) ? 'Actualizar Inventario' : 'Agregar Inventario'; ?></a>
                </li>
                <li class="nav-item">
                    <a href="./read.php" class="nav-link">Ver todos los Productos</a>
                </li>
                <li class="nav-item">
                    <a href="./search.php" class="nav-link">Buscar Productos</a>
                </li>
            </ul>
            <main class="dashboard_container container">
                <form action="<?php echo (!empty($result)) ? '../controladores/edits/UpdateProductos.php' : '../controladores/SetProducto.php'; ?>" method="post" enctype="multipart/form-data" class="my-4 needs-validation <?= (!empty($result)) ? 'was-validated' : '' ?>" novalidate>
                    <input type="hidden" name="id_inv" value="null">
                    <div class="row my-3">
                        <label for="producto-nombre" class="col-lg-2 col-form-label">Nombre:</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="producto-nombre" id="producto-nombre" placeholder="Nombre del producto" value="<?php echo (isset($result['nombre_producto'])) ? $result['nombre_producto'] : ''; ?>" required>
                            <div class="invalid-feedback">
                                Ingresa un nombre para el producto
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="producto-proveedor" class="col-lg-2 col-form-label">Proveedor:</label>
                        <div class="col-lg-10">
                            <select name="producto-proveedor" class="form-select" required>
                                <option value="" selected>Proveedor del producto</option>
                                <?php if(!empty($proveedoresResults)) ?>
                                    <?php foreach ($proveedoresResults as $proveedoresResult) { ?>
                                        <option value="<?= $proveedoresResult['id_proveedor']; ?>" <?php if(isset($result['id_proveedor']) && $result['id_proveedor'] == $proveedoresResult['id_proveedor']) { echo 'selected'; } ?>><?= $proveedoresResult['nombre_empresa'];?></option>
                                    <?php } ?>
                            </select>
                            <div class="invalid-feedback">
                                Selecciona el proveedor del producto
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="precio-venta" class="col-lg-2 col-form-label">Precio de venta:</label>
                        <div class="col-lg-10">
                            <input type="number" min="0" step="0.01" class="form-control" name="producto-precio-venta" id="precio-venta" placeholder="Precio MXN venta" value="<?php echo (isset($result['precio_venta'])) ? $result['precio_venta'] : ''; ?>" required>
                            <div class="invalid-feedback">
                                Ingresa el precio de venta del producto
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="precio-compra" class="col-lg-2 col-form-label">Precio de compra:</label>
                        <div class="col-lg-10">
                            <input type="number" min="0" step="0.01" class="form-control" name="producto-precio-compra" id="precio-compra" placeholder="Precio MXN compra" value="<?php echo (isset($result['precio_compra'])) ? $result['precio_venta'] : ''; ?>" required>
                            <div class="invalid-feedback">
                                Ingresa el precio de compra del producto
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="producto-categoria" class="col-lg-2 col-form-label">Categoría:</label>
                        <div class="col-lg-10">
                            <select name="categoria" class="form-select" required>
                                <option value="" selected>Categoria del producto</option>
                                <option value="Anillo" <?php if(isset($result['categoria']) && $result['categoria'] == 'Anillo') { echo 'selected'; } ?>>Anillos</option>
                                <option value="Collar" <?php if(isset($result['categoria']) && $result['categoria'] == 'Collar') { echo 'selected'; } ?>>Collares y Colgantes</option>
                                <option value="Pulsera" <?php if(isset($result['categoria']) && $result['categoria'] == 'Pulsera') { echo 'selected'; } ?>>Pulseras</option>
                                <option value="Pendiente" <?php if(isset($result['categoria']) && $result['categoria'] == 'Pendiente') { echo 'selected'; } ?>>Pendientes</option>
                                <option value="Reloj" <?php if(isset($result['categoria']) && $result['categoria'] == 'Reloj') { echo 'selected'; } ?>>Relojes</option>
                            </select>
                            <div class="invalid-feedback">
                                Selecciona la categoria del producto
                            </div>
                        </div>
                    </div> 
                    <div class="row mb-3">
                        <label for="tipo-material" class="col-lg-2 col-form-label">Material:</label>
                        <div class="col-lg-10">
                            <select name="tipo-material" class="form-select" required>
                                <option value="" selected>Material del producto</option>
                                <option value="Oro" <?php if(isset($result['tipo_material']) && $result['tipo_material'] == 'Oro') { echo 'selected'; } ?>>Oro</option>
                                <option value="Plata" <?php if(isset($result['tipo_material']) && $result['tipo_material'] == 'Plata') { echo 'selected'; } ?>>Plata</option>
                                <option value="Platino" <?php if(isset($result['tipo_material']) && $result['tipo_material'] == 'Platino') { echo 'selected'; } ?>>Platino</option>    
                            </select>
                            <div class="invalid-feedback">
                                Selecciona el material del producto
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="peso" class="col-lg-2 col-form-label">Peso:</label>
                        <div class="col-lg-10">
                            <input type="number" min="0" step="0.01"  class="form-control" name="peso" id="peso" placeholder="Gramos" value="<?php echo (isset($result['peso'])) ? $result['peso'] : ''; ?>" required>
                            <div class="invalid-feedback">
                                Ingresa el peso en gramos del producto
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="producto-cantidad-disponible" class="col-lg-2 col-form-label">Cantidad:</label>
                        <div class="col-lg-10">
                            <input type="number" min="0" class="form-control" name="cantidad-disponible" id="cantidad_disponible" placeholder="Cantidad Disponible" value="<?php echo (isset($result['cantidad_disponible'])) ? $result['cantidad_disponible'] : ''; ?>" required>
                            <div class="invalid-feedback">
                                Ingresa la cantidad disponible del producto
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="producto-ubicacion-almacen" class="col-lg-2 col-form-label">Ubicación:</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="ubicacion-almacen" id="ubicacion-almacen" placeholder="Ubicacion en el almacén" value="<?php echo (isset($result['ubicacion_almacen'])) ? $result['ubicacion_almacen'] : ''; ?>" required>
                            <div class="invalid-feedback">
                                Ingresa la ubicación del producto en el almacén
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="producto-descripcion" class="col-lg-2 col-form-label">Descripción:</label>
                        <textarea id="producto-descripcion" class="form-control" name="producto-descripcion" rows="4" required><?php echo (isset($result['Descripcion_producto'])) ? $result['Descripcion_producto'] : ''; ?></textarea>
                        <div class="invalid-feedback">
                            Ingresa una descripción para el producto
                        </div>
                    </div> 
                    <?php if (empty($result['imagen'])) { ?>
                        <div class="row mb-3"> 
                            <label for="image" class="col-lg-2 col-form-label">Agregar Imagen:</label>
                            <div class="col-10">
                                <input type="file" accept=".jpeg, .png, .jpg "id="image"  name="image" class="form-control">
                                <div class="invalid-feedback text-success">
                                    Ingresar una imagen del producto es opcional pero se recomienda
                                </div>
                            </div>
                        </div>
                     <?php } else { ?>
                        <div class="row mb-3"> 
                            <div class="col-lg-9">
                                <div class="row">
                                    <label for="image" class="col-lg-2 col-form-label">Cambiar Imagen:</label>
                                    <div class="col-lg-10">
                                        <input type="file" accept=".jpeg, .png, .jpg "id="image"  name="image" class="form-control border-warning inputfile-warning">
                                        <div class="valid-feedback text-warning">
                                            Al Seleccionar una imagen nueva se reemplazará la anterior
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card col-lg-3 p-0 accordion">
                                <div class="card-header accordion-header p-0">
                                    <button type="button" class="accordion-button collapsed bg-transparent shadow-none p-2" data-bs-toggle="collapse" data-bs-target="#db-image">
                                        Imagen Actual
                                    </button>
                                </div>
                                <div class="card-body show" id="db-image">
                                    <img src="<?='./' . $result['imagen']?>" alt="imagen-actual-del-producto" class="img-fluid rounded w-100">
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if(isset($result['id_producto'])){ ?>
                        <input type="hidden" name="id_producto" value="<?= $result['id_producto'] ?>">
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal-submit">Actualizar</button>
                    <?php } else { ?>
                        <button type="submit" class="btn btn-primary" name="submit" id="submit">Guardar</button>
                    <?php } ?>
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
                                    <button type="submit" class="btn btn-warning" name="submit" id="submit">Actualizar</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </main>
        </section>
    </section>
    <?php
    if(isset($_SESSION['producto'])){
      unset($_SESSION['producto']);
   } ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script src="../sources/js/app.js"></script>
</html>
