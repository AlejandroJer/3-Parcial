<?php
 namespace controladores;
 require_once("../autoload.php");
 use modelos\usuarios;
    $empleados = new usuarios();

    // catch the id of the product to update
    $result = $_SESSION['empleados'];

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
                <li class="option">
                    <a href="../movimientos/readProductos.php" class="option_container nav-link py-3 border-bottom rounded-0 link-dark link-dark" data-bs-toggle="tooltip" data-bs-placement="right" title="Movimientos">
                        <iconify-icon class="iconify" icon="bi:arrow-left-right" width="30" height="30"></iconify-icon>
                    </a>
                </li>
            </ul>
            <div class="border-top dropup">
                <a href="#" class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle"
                    data-bs-toggle="dropdown"  data-bs-offset="10,0">
                    <iconify-icon class="iconify" icon="mingcute:user-4-fill" width="30" height="30"></iconify-icon>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#" class="dropdown-item">Usuario #<?= $user['id_usr'] ?></a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a href="#" class="dropdown-item disabled" tabindex="-1"><?= $user['nombre_usr']. ' ' .$user['apellido_usr']?></a></li>
                    <li><a href="#" class="dropdown-item disabled" tabindex="-1"><?= $user['email_usr']?></a></li>
                </ul>
            </div>
        </nav>

        <section class="main_container col-lg-11">
            <ul class="nav nav-tabs mt-4">
                <li class="nav-item">
                    <a href="./read.php" class="nav-link" aria-current="page">Ver Usuarios</a>
                </li>
                <li class="nav-item">
                    <a href="./add.php" class="nav-link active">Editar Usuario</a>
                </li>
            </ul>
            <main class="dashboard_container container">
                <form action="../controladores/edits/UpdateEmpleados.php" method="POST" enctype="multipart/form-data" class="my-4 needs-validation was-validated" novalidate>
                <input type="file" accept=".jpeg, .png, .jpg" id="image"  name="image" class="form-control border-warning inputfile-warning visually-hidden">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="row my-3">
                            <div class="col-lg-2">
                                <label for="nombre" class="d-flex justify-content-end col-form-label fs-4">Nombre:</label>
                            </div>
                            <div class="col-lg-10 ">
                                <input type="text" class="form-control" name="usuario-nombre" id="nombre" placeholder="Nombre" value="<?= $result['nombre_usr']; ?>" required>
                                <div class="invalid-feedback">
                                    Ingrese el nombre del empleado
                                </div>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-lg-2">
                                <label for="apellido" class="d-flex justify-content-end col-form-label fs-4">Apellidos:</label>
                            </div>
                            <div class="col-lg-10 ">
                                <input type="text" class="form-control" name="usuario-apellido" id="apellido" placeholder="Apellido" value="<?= $result['apellido_usr']; ?>" required>
                                <div class="invalid-feedback">
                                    Ingrese el apellido del empleado
                                </div>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-lg-2">
                                <label for="email" class="d-flex justify-content-end col-form-label fs-4">Email:</label>
                            </div>
                            <div class="col-lg-10 ">
                                <input type="email" class="form-control" name="usuario-email" id="email" placeholder="Email" value="<?= $result['email_usr']; ?>" required>
                                <div class="invalid-feedback">
                                    Ingrese el email del empleado
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-2">
                                <label for="telefono" class="d-flex justify-content-end col-form-label fs-4">Teléfono:</label>
                            </div>
                            <div class="col-lg-10">
                                <input type="tel" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" value="<?= $result['tel']; ?>" required>
                                <div class="invalid-feedback">
                                    Ingrese el Teléfono del empleado
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- IMAGEN -->
                    <div class="col-lg-2">
                            <div class="card col-lg-12">
                                <button type="button" class="card-body btn border-0 p-0" id="update-image" onclick="updateImage(event);">
                                <img src="<?= empty($result['imagen']) ? '../sources/imgs/defaultImg.jpg' : './' . $result['imagen'] ?>" alt="imagen actual del usuario" class="card-img-top" id="img-image">
                            </button>
                            <label for="update-image" class="col-form-label text-center">Agregar</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-2">
                        <label for="sexo" class="d-flex justify-content-end col-form-label fs-4">Sexo:</label>
                    </div>
                    <div class="col-lg-10 ">
                        <select name="sexo" id="sexo" class="form-select" required>
                            <option value="" selected>Sexo del empleado</option>
                            <option value="f" <?php if($result['sexo'] == 'f') { echo 'selected'; } ?>>Femenino</option>
                            <option value="m" <?php if($result['sexo'] == 'm') { echo 'selected'; } ?>>Masculino</option>
                        </select>
                        <div class="invalid-feedback">
                            Ingrese el sexo del empleado
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
                            <option value="0" <?php if($result['id_perfil'] == 0) { echo 'selected'; } ?>>Empleado</option>
                            <option value="1" <?php if($result['id_perfil'] == 1) { echo 'selected'; } ?>>Administrador</option>
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
                        <input type="password" class="form-control" name="usuario-password" id="password" placeholder="Contraseña" value="<?= $result['contraseña']; ?>" required>
                        <div class="invalid-feedback">
                            Ingrese la contraseña del usuario
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-lg-2">
                        <label for="admin-password" class="d-flex justify-content-end col-form-label fs-4">Contraseña:</label>
                    </div>
                    <div class="col-lg-10 ">
                        <input type="password" class="form-control" name="admin-password" id="admin-password" placeholder="Contraseña Administrador" value="" required>
                        <div class="invalid-feedback">
                            Ingrese la contraseña de algun Administrador para confirmar los cambios
                        </div>
                    </div>
                </div>
                <!-- FORMS BTNS -->
                <div class="row mb-3 d-flex justify-content-end">
                    <input type="hidden" name="id_usuario" value="<?= $result['id_usr'] ?>">
                    <button type="button" class="btn btn-secondary col-auto me-3" data-bs-toggle="modal" data-bs-target="#modal-submit">Actualizar</button>
                </div>
                        <!-- MODAL TO UPDATE THE PRODUCT -->
                        <div class="modal fade" id="modal-submit"  tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3>Actualizar Usuario</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>¿Estas seguro de actualizar este usuario?</h5>
                                        <p>Al actualizar este usuario se reemplazará la información actual por la nueva, siendo una accion irreversible</p>
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
