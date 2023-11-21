<?php
 namespace controladores;
 require_once("../../autoload.php");
 use modelos\{usuarios, productos};
    $empleados = new usuarios();
    $producto = new productos();
    $resultsMateriales = $producto->GetMateriales();
    $resultscategoria = $producto->GetCategorias();
    if (!isset($_SESSION['logged_usr'])) {
        header('Location: ./../../auth/login.php');
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
    <link rel="stylesheet" href="../../sources/css/root.css">
</head>
<body class="container-fluid">
    <section class="index_section row">
        <!-- MAIN NAV -->
        <nav class="navHome d-flex flex-column flex-shrink-0 bg-light p-0 border-end" style="width: 4.5rem; position: sticky; height: 100vh; top: 0;">
            <a href="#" class="d-block py-3 text-decoration-none mx-auto" data-bs-toggle="tooltip" data-bs-placement="right" title="JEMAS">
                <img src="../../sources/imgs/logo.png" alt="" srcset="" style="width: 45px;">
            </a>
            <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                <li class="nav-item">
                    <a href="./../../dashboard.php" class="nav-link py-3 border-bottom rounded-0 link-dark border-top" data-bs-toggle="tooltip" data-bs-placement="right" title="Home">
                        <iconify-icon icon="ic:round-home" width="40" height="40"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="./../add.php" class="option_container active nav-link py-3 border-bottom rounded-0 bg-dark" data-bs-toggle="tooltip" data-bs-placement="right" title="Inventario">
                        <iconify-icon class="iconify" icon="ic:baseline-inventory" width="30" height="30"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="../../proveedores/read.php" class="option_container nav-link py-3 border-bottom rounded-0 link-dark" data-bs-toggle="tooltip" data-bs-placement="right" title="Proveedores">
                        <iconify-icon class="iconify" icon="fa-solid:users" width="30" height="30"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="../../empleados/read.php" class="option_container nav-link py-3 border-bottom rounded-0 link-dark" data-bs-toggle="tooltip" data-bs-placement="right" title="Empleados">
                        <iconify-icon class="iconify" icon="clarity:employee-solid" width="30" height="30"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="../../movimientos/read.php" class="option_container nav-link py-3 border-bottom rounded-0 link-dark link-dark" data-bs-toggle="tooltip" data-bs-placement="right" title="Movimientos">
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
        <section class="main_container col-lg-11 ms-3">
            <!-- PRODUCTS NAV -->
            <ul class="nav nav-tabs mt-4">
                <li class="nav-item">
                    <a href="./../read.php" class="nav-link">Ver Productos</a>
                </li>
                <li class="nav-item">
                    <a href="./../add.php" class="nav-link" aria-current="page">Agregar Inventario</a>
                </li>
                <li class="nav-item">
                    <a href="./add.php" class="nav-link active" aria-current="page">Agregar tags</a>
                </li>
            </ul>
            <!-- MAIN CONTENT -->
            <main class="dashboard_container container">
                <div class="row">
                    <!-- FORM - to add a categorie -->
                    <div class="col-lg-6 my-3 border-end">
                        <h1>Material</h1>
                        <form action="../../controladores/SetMaterial.php" method="post" class="my-4 needs-validation" novalidate>
                            <!-- NOMBRE -->
                            <div class="row my-3">
                                <div class="col-lg-2">
                                    <label for="material-nombre" class="col-form-label fs-4">Agregar:</label>
                                </div>
                                <div class="col-lg-9 ms-3">
                                    <input type="text" class="form-control" name="material-nombre" id="material-nombre" placeholder="Material del producto" value="" required>
                                    <div class="invalid-feedback">
                                        Ingrese un nombre valido
                                    </div>
                                </div>
                            </div>
                            <!-- FORMS BTNS -->
                            <div class="row mb-3">
                                <div class="d-flex justify-content-end col-lg-11 p-0">
                                    <button type="submit" class="btn btn-primary" name="submit" id="submit">Guardar</button>
                                </div>
                            </div>
                        </form>
                        <h3 class="my-3 text-secondary">Tabla de materiales</h3>
                        <!-- TABLE - to show all materials -->
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Material</th>
                                    <th>Editar</th>
                                    <th>Borrar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($resultsMateriales as $index => $material): ?>
                                    <tr>
                                        <td><?= $index + 1?></td>
                                        <td><?= $material['material'] ?></td>
                                        <td>
                                            <button type="button" id="" class="button btn btn-secondary btn-sm"
                                                    data-valuename="<?= $material['material'] ?>" data-valueid="<?= $material['id'] ?>"
                                                    data-bs-toggle="modal" data-bs-target="#modal-material-edit"
                                                    onclick="passValue(event, 'material-nombre-edit', 'material-id-edit')">Editar</button>
                                        </td>
                                        <td>
                                            <button type="button" id="" class="button btn btn-danger btn-sm"
                                                    data-valuename="<?= $material['material'] ?>" data-valueid="<?= $material['id'] ?>"
                                                    data-bs-toggle="modal" data-bs-target="#modal-material-delete"
                                                    onclick="passValue(event, 'material-nombre-delete', 'material-id-delete')">Borrar</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <!-- MODAL TO UPDATE A MATERIAL -->
                        <div class="modal fade" id="modal-material-edit"  tabindex="-1">
                            <form action="./../../controladores/edits/UpdateMateriales.php" method="post" class="needs-validation was-validated" novalidate>
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3>Editar material</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h5>¿Estás seguro de editar este material?</h5>
                                            <p>Esta acción no se puede deshacer.</p>
                                            <h5 class="mt-3">Producto a editar</h5>
                                            <div class="row">
                                                <div class="col-lg-10">
                                                    <input type="hidden" name="id" id="material-id-edit" value="">
                                                    <input type="text" class="form-control" name="material-nombre-edit" id="material-nombre-edit" value="" required>
                                                    <div class="invalid-feedback">
                                                        Ingrese un nombre valido
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-between">
                                            <!-- SUBMIT/CANCEL BTN - to submit/cancel the update -->
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-warning" name="submit" id="submit">Editar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- MODAL TO DELETE A MATERIAL -->
                        <div class="modal fade" id="modal-material-delete"  tabindex="-1">
                            <form action="./../../controladores/deletes/DeleteMateriales.php" method="POST">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3>Borrar material</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h5>¿Estás seguro de borrar este material?</h5>
                                            <p>Esta acción no se puede deshacer.</p>
                                            <h5 class="mt-3">Producto a borrar</h5>
                                            <div class="row">
                                                <div class="col-lg-10">
                                                    <input type="hidden" name="id" id="material-id-delete" value="">
                                                    <input type="text" class="form-control" name="material-nombre-delete" id="material-nombre-delete" value="" disabled required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-between">
                                            <!-- SUBMIT/CANCEL BTN - to submit/cancel the update -->
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-danger" name="submit" id="submit">Borrar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>                    
                    <!-- FORM - to add a material -->
                    <div class="col-lg-6 my-3">
                        <h1>Categoria</h1>
                        <form action="../../controladores/SetCategoria.php" method="post" class="my-4 needs-validation" novalidate>
                            <!-- NOMBRE -->
                            <div class="row my-3">
                                <div class="col-lg-2">
                                    <label for="categoria-nombre" class="col-form-label fs-4">Agregar:</label>
                                </div>
                                <div class="col-lg-9 ms-3">
                                    <input type="text" class="form-control" name="categoria-nombre" id="categoria-nombre" placeholder="Categoria del producto" value="" required>
                                    <div class="invalid-feedback">
                                        Ingresa un nombre valido
                                    </div>
                                </div>
                            </div>
                            <!-- FORMS BTNS -->
                            <div class="row mb-3">
                                <div class="d-flex justify-content-end col-lg-11 p-0">
                                    <button type="submit" class="btn btn-primary" name="submit" id="submit">Guardar</button>
                                </div>
                            </div>
                        </form>
                        <h3 class="my-3 text-secondary">Tabla de categorias</h3>
                        <!-- TABLE - to show all material -->
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>categoria</th>
                                    <th>Editar</th>
                                    <th>Borrar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($resultscategoria as $index => $categoria): ?>
                                    <tr>
                                        <td><?= $index + 1?></td>
                                        <td><?= $categoria['categoria'] ?></td>
                                        <td>
                                            <button type="button" id="" class="button btn btn-secondary btn-sm"
                                                    data-valuename="<?= $categoria['categoria'] ?>" data-valueid="<?= $categoria['id'] ?>"
                                                    data-bs-toggle="modal" data-bs-target="#modal-categoria-edit"
                                                    onclick="passValue(event, 'categoria-nombre-edit', 'categoria-id-edit')">Editar</button>
                                        </td>
                                        <td>
                                            <button type="button" id="" class="button btn btn-danger btn-sm"
                                                    data-valuename="<?= $categoria['categoria'] ?>" data-valueid="<?= $categoria['id'] ?>"
                                                    data-bs-toggle="modal" data-bs-target="#modal-categoria-delete"
                                                    onclick="passValue(event, 'categoria-nombre-delete', 'categoria-id-delete')">Borrar</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        
                        <!-- MODAL TO UPDATE A CATEGORIE -->
                        <div class="modal fade" id="modal-categoria-edit"  tabindex="-1">
                            <form action="./../../controladores/edits/UpdateCategorias.php" method="post" class="needs-validation was-validated" novalidate>
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3>Editar categoria</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h5>¿Estás seguro de editar esta categoria?</h5>
                                            <p>Esta acción no se puede deshacer.</p>
                                            <h5 class="mt-3">Categoria a editar</h5>
                                            <div class="row">
                                                <div class="col-lg-10">
                                                    <input type="hidden" name="id" id="categoria-id-edit" value="">
                                                    <input type="text" class="form-control" name="categoria-nombre-edit" id="categoria-nombre-edit" value="" required>
                                                    <div class="invalid-feedback">
                                                        Ingrese un nombre valido
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-between">
                                            <!-- SUBMIT/CANCEL BTN - to submit/cancel the update -->
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-warning" name="submit" id="submit">Editar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- MODAL TO DELETE A CATEGORIE -->
                        <div class="modal fade" id="modal-categoria-delete"  tabindex="-1">
                            <form action="./../../controladores/deletes/DeleteCategorias.php" method="POST">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3>Borrar categoria</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h5>¿Estás seguro de borrar esta categoria?</h5>
                                            <p>Esta acción no se puede deshacer.</p>
                                            <h5 class="mt-3">Categoria a borrar</h5>
                                            <div class="row">
                                                <div class="col-lg-10">
                                                    <input type="hidden" name="id" id="categoria-id-delete" value="">
                                                    <input type="text" class="form-control" name="categoria-nombre-delete" id="categoria-nombre-delete" value="" disabled required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-between">
                                            <!-- SUBMIT/CANCEL BTN - to submit/cancel the update -->
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-danger" name="submit" id="submit">Borrar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </section>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script src="../../sources/js/app.js"></script>
</html>
