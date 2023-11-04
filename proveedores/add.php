<?php
require_once("../autoload.php");
if(isset($_SESSION['proveedores'])){
    $result = $_SESSION['proveedores'];
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
                    <a href="./add.php" class="nav-link active" aria-current="page"><?php echo (isset($result['id_proovedor'])) ? 'Actualizar Proveedor' : 'Agregar Proveedor'; ?></a>
                </li>
                <li class="nav-item">
                    <a href="./read.php" class="nav-link">Ver Proveedores</a>
                </li>
            </ul>
            <main class="dashboard_container">

                <form action="<?php echo (!empty($result)) ? '../controladores/edits/UpdateProveedores.php' : '../controladores/SetProveedor.php'; ?>" method="POST" enctype="multipart/form-data" class="my-4 needs-validation <?= (!empty($result)) ? 'was-validated' : '' ?>" novalidate>
                  
                <div class="row my-3">
                        <div class="col-lg-2">
                            <label for="nombre-empresa" class="d-flex justify-content-end col-form-label fs-4">Empresa:</label>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="nombre-empresa" id="nombre-empresa" placeholder="Nombre de la Empresa" value="<?php echo (isset($result['nombre_empresa'])) ? $result['nombre_empresa'] : ''; ?>" required>
                        </div>
                        <div class="invalid-feedback">
                            Ingrese el nombre de la Empresa
                        </div>
                     
                        <div class="row my-3">
                        <div class="col-lg-2">
                            <label for="direccion-proveedor" class="d-flex justify-content-end col-form-label fs-4">Dirección:</label>
                        </div>
                            <div class="col-lg-10">
                            <input type="text" class="form-control" name="direccion-proveedor" id="direccion-proveedor" placeholder="Dirección del proveedor" value="<?php echo (isset($result['direccion'])) ? $result['direccion'] : ''; ?>" required>
                        </div>
                        <div class="invalid-feedback">
                            Ingrese la direccion del Proveedor
                        </div>
                        
                        <div class="row my-3">
                            <div class="col-lg-2">
                                <label for="persona-contacto" class="d-flex justify-content-end col-form-label fs-4">Contacto:</label>
                            </div> 
                            <div class="col-lg-10">
                            <input type="text" class="form-control" name="persona-contacto" id="persona-contacto" placeholder="Persona de contacto" value="<?php echo (isset($result['persona_contacto'])) ? $result['persona_contacto'] : ''; ?>" required>
                        </div>
                        <div class="invalid-feedback">
                            Ingrese el nombre de la Persona de contacto
                        </div>

                    <div class="row my-3">
                        <div class="col-lg-2">
                            <label for="telefono" class="d-flex justify-content-end col-form-label fs-4">Teléfono:</label>
                        </div>
                        <div class="col-lg-10">
                            <input type="tel" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" value="<?php echo (isset($result['num_telefono'])) ? $result['num_telefono'] : ''; ?>" required>
                        </div>
                        <div class="invalid-feedback">
                            Ingrese el Teléfono 
                        </div>
                        
                        <div class="row my-3">
                            <div class="col-lg-2">
                                <label for="correo-proveedor" class="d-flex justify-content-end col-form-label fs-4">Correo:</label>
                            </div>
                            <div class="col-lg-10">
                                <input type="email" class="form-control" name="correo-proveedor" id="correo-proveedor" value="<?php echo (isset($result['email_proveedor'])) ? $result['email_proveedor'] : ''; ?>" placeholder="Correo electrónico" required>
                            </div>
                            <div class="invalid-feedback">
                            Ingrese el Teléfono 
                        </div>
                    </div>

                    <?php
                    if(isset($result['id_proveedor'])){
                        echo '<input type="hidden" name="id_proveedor" value="' . $result['id_proveedor'] . '">';
                    }
                    ?>
                    <div class="row mb-3 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary col-auto me-3" name="submit" id="submit" ><?php echo (isset($result['id_proveedor'])) ? 'Actualizar' : 'Guardar'; ?></button>
                </form>
            </main>
        </section>
    </section>
    <?php
    if(isset($_SESSION['proveedores'])){
        unset($_SESSION['proveedores']);
    } ?>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script src="../sources/js/nav.js"></script>
</html>