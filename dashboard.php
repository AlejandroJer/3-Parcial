<?php
 require_once("./autoload.php");
 use modelos\{proveedores, usuarios, productos};
  $proveedores = new proveedores();
  $empleados = new usuarios();
  $productos = new productos();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JEMAS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./sources/css/root.css">
</head>
<body class="container-fluid bg-light">
    <section class="index_section row vh-100">
        <nav class="navHome d-flex flex-column flex-shrink-0 bg-light p-0 border-end" style="width: 4.5rem">
            <a href="#" class="d-block p-3 link-dark text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="right" title="JEMAS">
                <iconify-icon icon="map:jewelry-store" width="40" height="40"></iconify-icon>
            </a>
            <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                <li class="nav-item">
                    <a href="./dashboard.php" class="nav-link active py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
                        <iconify-icon icon="bxs:dashboard" width="30" height="30"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="./inventario/add.php" class="option_container nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Inventario">
                        <iconify-icon class="iconify" icon="ic:baseline-inventory" width="30" height="30"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="./proveedores/add.php" class="option_container nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Proveedores">
                        <iconify-icon class="iconify" icon="fa-solid:users" width="30" height="30"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="./empleados/add.php" class="option_container nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Empleados">
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
            <main class="dashboard_main container m-5">
                <h2 class="row display-1">Dashboard</h2>
                <h4 class="row display-6 mb-5">
                    Bienvenido al sistema de inventario JEMAS, en esta sección podras ver las opciones que tienes disponibles para administrar.
                </h4>
                <section class="row">
                    <a href="./inventario/add.php" class="col link-dark text-decoration-none">
                        <div class="dashboard_options option_container card">
                            <h3 class="display-6 card-header accordion-header" >Inventario</h3>
                            <div class="card-body">
                                <div class="card-body d-flex justify-content-center">
                                    <iconify-icon class="iconify " icon="ic:baseline-inventory" width="100" height="100"></iconify-icon>
                                </div>
                                <h4 class="card-title"><?= $productos->GetproductosIndex(); ?> Productos</h4>
                            </div>
                        </div>
                    </a>
                    <a href="./proveedores/add.php" class="col link-dark text-decoration-none">
                        <div class="dashboard_options option_container card">
                            <h3 class="display-6 card-header">Proveedores</h3>
                            <div class="card-body">
                                <div class="card-body d-flex justify-content-center">
                                    <iconify-icon class="iconify" icon="fa-solid:users" width="100" height="100"></iconify-icon>
                                </div>
                                <h4 class="card-title"><?= $proveedores->GetproveedoresIndex(); ?> Proveedores</h4>
                            </div>
                        </div>
                    </a>
                    <a href="./empleados/add.php" class="col link-dark text-decoration-none">
                        <div class="dashboard_options option_container">
                            <div class="dashboard_options option_container card">
                                <h3 class="display-6 card-header">Empleados</h3>
                                <div class="card-body">
                                    <div class="card-body d-flex justify-content-center">
                                        <iconify-icon class="iconify" icon="clarity:employee-solid" width="100" height="100"></iconify-icon>
                                    </div>
                                    <h4 class="card-title"><?= $empleados->GetusuariosIndex(); ?> Empleados</h4>
                                </div>
                            </div>
                        </div>
                    </a>
                </section>
            </main>
        </section>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script src="./sources/js/app.js"></script>
</html>
