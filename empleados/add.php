<?php
 namespace controladores;
 require_once("../autoload.php");
 use modelos\usuarios;
    $empleados = new usuarios();

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
<body class="container-fluid">
    <section class="index_section row vh-100">
        <nav class="navHome d-flex flex-column flex-shrink-0 bg-light p-0 border-end" style="width: 4.5rem">
            <a href="#" class="d-block py-3 text-decoration-none mx-auto" data-bs-toggle="tooltip" data-bs-placement="right" title="JEMAS">
                <img src="../sources/imgs/logo.png" alt="" srcset="" style="width: 45px;">
            </a>
            <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                <li class="nav-item">
                    <a href="../dashboard.php" class="nav-link py-3 border-bottom rounded-0 link-dark border-top" data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
                        <iconify-icon icon="ic:round-home" width="40" height="40"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="../inventario/read.php" class="option_container nav-link py-3 border-bottom rounded-0 link-dark" data-bs-toggle="tooltip" data-bs-placement="right" title="Inventario">
                        <iconify-icon class="iconify" icon="ic:baseline-inventory" width="30" height="30"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="./add.php" class="option_container nav-link active py-3 border-bottom rounded-0 bg-dark" data-bs-toggle="tooltip" data-bs-placement="right" title="Proveedores">
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

        <section class="main_container col-lg-11">
            <ul class="nav nav-tabs mt-4">
                <li class="nav-item">
                    <a href="./read.php" class="nav-link" aria-current="page">Ver Proveedores</a>
                </li>
                <li class="nav-item">
                    <a href="./add.php" class="nav-link active">Agregar Proveedor</a>
                </li>
            </ul>
            <main class="dashboard_container container">
                <form action="../controladores/SetUsuario.php" method="POST" class="my-4 needs-validation" novalidate>
                    <div class="row my-3">
                        <div class="col-lg-2">
                            <label for="nombre" class="d-flex justify-content-end col-form-label fs-4">Nombre:</label>
                        </div>
                        <div class="col-lg-10 ">
                            <input type="text" class="form-control" name="usuario-nombre" id="nombre" placeholder="Nombre" value="" required>
                            <div class="invalid-feedback">
                                Ingrese el nombre del usuario
                            </div>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-lg-2">
                            <label for="apellido" class="d-flex justify-content-end col-form-label fs-4">Apellidos:</label>
                        </div>
                        <div class="col-lg-10 ">
                            <input type="text" class="form-control" name="usuario-apellido" id="apellido" placeholder="Apellido" value="" required>
                            <div class="invalid-feedback">
                                Ingrese el apellido del usuario
                            </div>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-lg-2">
                            <label for="email" class="d-flex justify-content-end col-form-label fs-4">Email:</label>
                        </div>
                        <div class="col-lg-10 ">
                            <input type="email" class="form-control" name="usuario-email" id="email" placeholder="Email" value="" required>
                            <div class="invalid-feedback">
                                Ingrese el email del usuario
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label for="telefono" class="d-flex justify-content-end col-form-label fs-4">Teléfono:</label>
                        </div>
                        <div class="col-lg-10">
                            <input type="tel" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" value="" required>
                            <div class="invalid-feedback">
                                Ingrese el Teléfono del usuario
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label for="sexo" class="d-flex justify-content-end col-form-label fs-4">Sexo:</label>
                        </div>
                        <div class="col-lg-10 ">
                            <select name="sexo" id="sexo" class="form-select" required>
                                <option value="" selected>Sexo del usuario</option>
                                <option value="f">Femenino</option>
                                <option value="m">Masculino</option>
                            </select>
                            <div class="invalid-feedback">
                                Ingrese el sexo del usuario
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label for="rol" class="d-flex justify-content-end col-form-label fs-4">Rol:</label>
                        </div>
                        <div class="col-lg-10 ">
                            <select name="usuario-rol" id="rol" class="form-select" required>
                                <option value="" selected>Rol del usuario</option>
                                <option value="0">Empleado</option>
                                <option value="1">Administrador</option>
                            </select>
                            <div class="invalid-feedback">
                                Ingrese el rol del usuario
                            </div>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-lg-2">
                            <label for="password" class="d-flex justify-content-end col-form-label fs-4">Contraseña:</label>
                        </div>
                        <div class="col-lg-10 ">
                            <input type="password" class="form-control" name="usuario-password" id="password" placeholder="Contraseña" value="" required>
                            <div class="invalid-feedback">
                                Ingrese el apellido del usuario
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary col-auto me-3" name="submit" id="submit" >Guardar</button>
                    <div>
                </form>
            </main>
        </section>
    </section>
    <?php
    if(isset($_SESSION['empleados'])){
        unset($_SESSION['empleados']);
    } ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script src="../sources/js/app.js"></script>
</html>
