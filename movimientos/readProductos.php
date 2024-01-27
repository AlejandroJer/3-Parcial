<?php
 namespace controladores;
 require_once("../autoload.php");
 use modelos\{movimientos, usuarios, productos, proveedores};
    $empleados = new usuarios();
    $movimientos = new movimientos();
    $productos = new productos();
    $proveedores = new proveedores();

 if (!isset($_SESSION['logged_usr'])) {
    header('Location: ./../auth/login.php');
    exit;
 } else {
    $user_id = $_SESSION['logged_usr'];
    $user = $empleados->GetUsuarioById($user_id);
 }
 $results = $movimientos->GetMovByTable('productos');
 $dictionary = $movimientos->DiccMov();
 $prvrsdict = $proveedores->PrvrsDictionary();
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
                <img src="../sources/imgs/logo.png" alt="" srcset="" style="width: 65px;">
            </a>
            <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                <li class="nav-item">
                    <a href="../dashboard.php" class="nav-link py-3 border-bottom rounded-0 link-dark border-top" data-bs-toggle="tooltip" data-bs-placement="right" title="Home">
                        <iconify-icon icon="ic:round-home" width="40" height="40"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="../inventario/read.php" class="option_container nav-link py-3 border-bottom rounded-0 link-dark" data-bs-toggle="tooltip" data-bs-placement="right" title="Inventario">
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
                <li class="option">
                    <a href="./read.php" class="option_container nav-link active py-3 border-bottom rounded-0 bg-dark" data-bs-toggle="tooltip" data-bs-placement="right" title="Movimientos">
                        <iconify-icon class="iconify" icon="bi:arrow-left-right" width="30" height="30"></iconify-icon>
                    </a>
                </li>
            </ul>
            <div class="border-top dropup">
                <a href="#" class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle"
                    data-bs-toggle="dropdown"  data-bs-offset="10,0">
                    <iconify-icon class="iconify" icon="mingcute:user-4-fill" width="30" height="30"></iconify-icon>
                </a>
                <ul class="dropdown-menu" style="z-index: 9999;">
                    <li><a href="#" class="dropdown-item">Usuario #<?= $user['id_usr'] ?></a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a href="#" class="dropdown-item disabled" tabindex="-1"><?= $user['nombre_usr']. ' ' .$user['apellido_usr']?></a></li>
                    <li><a href="#" class="dropdown-item disabled" tabindex="-1"><?= $user['email_usr']?></a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a href="../logout.php" class="dropdown-item text-danger">Cerrar Sesion</a></li>
                </ul>
            </div>
        </nav>

        <section class="main_container col-lg-11 ms-3">
            <!-- PRODUCTS NAV -->
            <ul class="nav nav-tabs my-4">
                <li class="nav-item">
                    <a href="./readProductos.php" class="nav-link active" aria-current="page">Ver Productos</a>
                </li>
                <li class="nav-item">
                    <a href="./readProveedores.php" class="nav-link">Ver Proveedor</a>
                </li>
                <li class="nav-item">
                    <a href="./readUsuarios.php" class="nav-link">Ver Usuarios</a>
                </li>
            </ul>
            <section class="dashboard_container container" id="mainContainer">
                <h2>Historial de movimientos</h2>
                <!-- Puedes mostrar la información del historial de movimientos aquí -->
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Cambios En:</th>
                            <th>Movimiento</th>
                            <th>Por Usuario:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($results as $index => $result): ?>
                            <tr class="<?= $dictionary[$result['tipo_movimiento']]['class'] ?>">
                                <td><?= $index + 1 ?></td>
                                <td><?= $result['fecha_movimiento'] ?></td>
                                <td>Producto #<?= $result['id_tabla_PK'] ?></td>
                                <td><?= $dictionary[$result['tipo_movimiento']]['kind'] ?></td>
                                <td>
                                    <div class="row">
                                        <div class="col-8">
                                            <a href="#" class="p-3 link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">#<?= $result['id_usr'] ?></a>
                                            <?php $MovByUser = $empleados->GetUsuarioById($result['id_usr']); ?>
                                            <ul class="dropdown-menu">
                                                <li><a href="#" class="dropdown-item disabled"><?= $MovByUser['nombre_usr'] ?></a></li>
                                                <li><a href="#" class="dropdown-item disabled"><?= $MovByUser['apellido_usr'] ?></a></li>
                                                <li><a href="#" class="dropdown-item disabled"><?= $MovByUser['email_usr'] ?></a></li>
                                                <li><a href="#" class="dropdown-item disabled"><?= $MovByUser['tel'] ?></a></li>
                                            </ul>
                                        </div>
                                        <div class="accordion col-2">
                                            <button type="button" class="accordion-button collapsed bg-transparent shadow-none p-1" data-bs-toggle="collapse" data-bs-target="#dropdownTableButton<?= $result['id_movimiento'] ?>"></button>
                                        </div>
                                    </div>
                                </td>
                             <tr>
                                <td colspan="5" class="collapse pt-0" id="dropdownTableButton<?= $result['id_movimiento'] ?>">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre</th>
                                                <th>Descripción</th>
                                                <th>Imagen</th>
                                                <th>Compra</th>
                                                <th>Venta</th>
                                                <th>Categoría</th>
                                                <th>Peso</th>
                                                <th>Material</th>
                                                <th>Cantidad</th>
                                                <th>Ubicación</th>
                                                <th>Proveedor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($result['tipo_movimiento'] == 1){ ?>
                                                <?php $results_backup = $productos->GetRespaldoProducto($result['id_tabla_r_PK']); ?>
                                                <tr class="<?= $dictionary[$result['tipo_movimiento']]['class'] ?>">
                                                    <td><strong>Antes</strong></td>
                                                    <td><?= $results_backup['nombre'][0] ?></td>
                                                    <td><?= $results_backup['Descripcion_producto'][0] ?></td>
                                                    <td><?php if (isset($results_backup['imagen'][0])) { echo '<img src="./../inventario/'.$results_backup['imagen'][0].'" alt="" srcset="" style="width: 65px;">'; } else { echo 'N/A'; } ?></td>
                                                    <td><?= $results_backup['precio_compra'][0] ?></td>
                                                    <td><?= $results_backup['precio_venta'][0] ?></td>
                                                    <td><?= $results_backup['id_categoria'][0] ?></td>
                                                    <td><?= $results_backup['peso'][0] ?></td>
                                                    <td><?= $results_backup['id_material'][0] ?></td>
                                                    <td><?= $results_backup['cantidad_disponible'][0] ?></td>
                                                    <td><?= $results_backup['ubicacion_almacen'][0] ?></td>
                                                    <td><?= $prvrsdict[$results_backup['id_proveedor'][0]] ?></td>
                                                </tr>
                                                <tr class="<?= $dictionary[$result['tipo_movimiento']]['class'] ?>">
                                                    <td><strong>Después</strong></td>
                                                    <td><?= $results_backup['nombre'][1] ?></td>
                                                    <td><?= $results_backup['Descripcion_producto'][1] ?></td>
                                                    <td><?php if (isset($results_backup['imagen'][1])) { echo '<img src="./../inventario/'.$results_backup['imagen'][1].'" alt="" srcset="" style="width: 65px;">'; } else { echo 'N/A'; } ?></td>
                                                    <td><?= $results_backup['precio_compra'][1] ?></td>
                                                    <td><?= $results_backup['precio_venta'][1] ?></td>
                                                    <td><?= $results_backup['id_categoria'][1] ?></td>
                                                    <td><?= $results_backup['peso'][1] ?></td>
                                                    <td><?= $results_backup['id_material'][1] ?></td>
                                                    <td><?= $results_backup['cantidad_disponible'][1] ?></td>
                                                    <td><?= $results_backup['ubicacion_almacen'][1] ?></td>
                                                    <td><?= $prvrsdict[$results_backup['id_proveedor'][1]] ?></td>
                                                </tr>
                                            <?php } elseif ($result['tipo_movimiento'] == 0) { ?>
                                                <?php $results_backup = $productos->GetRespaldoProducto($result['id_tabla_r_PK']); ?>
                                                <tr class="<?= $dictionary[$result['tipo_movimiento']]['class'] ?>">
                                                    <td><strong><?= $results_backup['id_producto'] ?></strong></td>
                                                    <td><?= $results_backup['nombre'][1] ?></td>
                                                    <td><?= $results_backup['Descripcion_producto'][1] ?></td>
                                                    <td><?php if (isset($results_backup['imagen'][1])) { echo '<img src="./../inventario/'.$results_backup['imagen'][1].'" alt="" srcset="" style="width: 65px;">'; } else { echo 'N/A'; } ?></td>
                                                    <td><?= $results_backup['precio_compra'][1] ?></td>
                                                    <td><?= $results_backup['precio_venta'][1] ?></td>
                                                    <td><?= $results_backup['id_categoria'][1] ?></td>
                                                    <td><?= $results_backup['peso'][1] ?></td>
                                                    <td><?= $results_backup['id_material'][1] ?></td>
                                                    <td><?= $results_backup['cantidad_disponible'][1] ?></td>
                                                    <td><?= $results_backup['ubicacion_almacen'][1] ?></td>
                                                    <td><?= $prvrsdict[$results_backup['id_proveedor'][1]] ?></td>
                                                </tr>
                                            <?php } elseif ($result['tipo_movimiento'] == 2) { ?>
                                                <?php $results_backup = $productos->GetProductoById($result['id_tabla_PK']); ?>
                                                <?php if (!empty($results_backup)) { ?>
                                                    <tr class="<?= $dictionary[$result['tipo_movimiento']]['class'] ?>">
                                                        <td><strong><?= $results_backup['id_producto']; ?></strong></td>
                                                        <td><?= $results_backup['nombre_producto']; ?></td>
                                                        <td><?= $results_backup['Descripcion_producto']; ?></td>
                                                        <td><?php if (isset($results_backup['imagen'])) { echo '<img src="./../inventario/'.$results_backup['imagen'].'" alt="" srcset="" style="width: 65px;">'; } else { echo 'N/A'; } ?></td>
                                                        <td><?= $results_backup['precio_compra']; ?></td>
                                                        <td><?= $results_backup['precio_venta']; ?></td>
                                                        <td><?= $results_backup['id_categoria']; ?></td>
                                                        <td><?= $results_backup['peso']; ?></td>
                                                        <td><?= $results_backup['id_material']; ?></td>
                                                        <td><?= $results_backup['cantidad_disponible']; ?></td>
                                                        <td><?= $results_backup['ubicacion_almacen']; ?></td>
                                                        <td><?= $prvrsdict[$results_backup['id_proveedor']]; ?></td>
                                                    </tr>
                                                <?php } else { ?>
                                                    <tr class="<?= $dictionary[$result['tipo_movimiento']]['class'] ?>">
                                                        <td colspan="12" class="justify-content-center"><strong>Este elemento ya ha sido eliminado</strong></td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </td>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script src="../sources/js/app.js"></script>
</html>
