<?php
 require_once("./autoload.php");
 use modelos\{proveedores, usuarios, productos};
  $proveedores = new proveedores();
  $empleados = new usuarios();
  $productos = new productos();
    if (!isset($_SESSION['logged_usr'])) {
        header('Location: ./auth/login.php');
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
    <link rel="stylesheet" href="./sources/css/root.css">
</head>
<style>
    #logo{
        background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBzdGFuZGFsb25lPSJubyI/Pgo8IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDIwMDEwOTA0Ly9FTiIKICJodHRwOi8vd3d3LnczLm9yZy9UUi8yMDAxL1JFQy1TVkctMjAwMTA5MDQvRFREL3N2ZzEwLmR0ZCI+CjxzdmcgdmVyc2lvbj0iMS4wIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciCiB3aWR0aD0iMTAyNC4wMDAwMDBwdCIgaGVpZ2h0PSIxMDI0LjAwMDAwMHB0IiB2aWV3Qm94PSIwIDAgMTAyNC4wMDAwMDAgMTAyNC4wMDAwMDAiCiBwcmVzZXJ2ZUFzcGVjdFJhdGlvPSJ4TWlkWU1pZCBtZWV0Ij4KCjxnIHRyYW5zZm9ybT0idHJhbnNsYXRlKDAuMDAwMDAwLDEwMjQuMDAwMDAwKSBzY2FsZSgwLjEwMDAwMCwtMC4xMDAwMDApIgpmaWxsPSIjMDAwMDAwIiBzdHJva2U9Im5vbmUiPgo8cGF0aCBkPSJNNjM4OCAyOTIzIGM3IC0zIDE2IC0yIDE5IDEgNCAzIC0yIDYgLTEzIDUgLTExIDAgLTE0IC0zIC02IC02eiIvPgo8cGF0aCBkPSJNMzcxOCAyNDgzIGM3IC0zIDE2IC0yIDE5IDEgNCAzIC0yIDYgLTEzIDUgLTExIDAgLTE0IC0zIC02IC02eiIvPgo8cGF0aCBkPSJNNjYxOCAyNDgzIGMxMiAtMiAzMiAtMiA0NSAwIDEyIDIgMiA0IC0yMyA0IC0yNSAwIC0zNSAtMiAtMjIgLTR6Ii8+CjwvZz4KPC9zdmc+Cg==");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
</style>
<body class="container-fluid bg-light">
    <section class="index_section row">
        <nav class="navHome d-flex flex-column flex-shrink-0 bg-light p-0 border-end" style="width: 4.5rem; position: sticky; height: 100vh; top: 0;">
            <a href="#" class="d-block p-3 link-dark text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="right" title="JEMAS">
                <!-- <iconify-icon icon="map:jewelry-store" width="40" height="40"></iconify-icon> -->
                <span id="logo"></span>
            </a>
            <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                <li class="nav-item">
                    <a href="./dashboard.php" class="nav-link active py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Home">
                        <iconify-icon icon="ic:round-home" width="40" height="40"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="./inventario/read.php" class="option_container nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Inventario">
                        <iconify-icon class="iconify" icon="ic:baseline-inventory" width="30" height="30"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="./proveedores/read.php" class="option_container nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Proveedores">
                        <iconify-icon class="iconify" icon="fa-solid:users" width="30" height="30"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="./empleados/read.php" class="option_container nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Empleados">
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

        <section class="main_container col-lg-11 bg-light">
            <main class="dashboard_main container m-5">
                <h2 class="row h1">Home</h2>
                <h4 class="row h2 mb-5">
                    Bienvenido al sistema de inventario JEMAS, en esta sección podras ver las opciones que tienes disponibles para administrar.
                </h4>
                <section class="row">
                    <a href="./inventario/read.php" class="col link-dark text-decoration-none">
                        <div class="dashboard_options option_container card">
                            <h3 class="h2 card-header accordion-header" >Inventario</h3>
                            <div class="card-body">
                                <div class="card-body d-flex justify-content-center">
                                    <iconify-icon class="iconify " icon="ic:baseline-inventory" width="100" height="100"></iconify-icon>
                                </div>
                                <h4 class="card-title"><?= $productos->GetproductosIndex(); ?> Productos</h4>
                            </div>
                        </div>
                    </a>
                    <a href="./proveedores/read.php" class="col link-dark text-decoration-none">
                        <div class="dashboard_options option_container card">
                            <h3 class="h2 card-header">Proveedores</h3>
                            <div class="card-body">
                                <div class="card-body d-flex justify-content-center">
                                    <iconify-icon class="iconify" icon="fa-solid:users" width="100" height="100"></iconify-icon>
                                </div>
                                <h4 class="card-title"><?= $proveedores->GetproveedoresIndex(); ?> Proveedores</h4>
                            </div>
                        </div>
                    </a>
                    <a href="./empleados/read.php" class="col link-dark text-decoration-none">
                        <div class="dashboard_options option_container">
                            <div class="dashboard_options option_container card">
                                <h3 class="h2 card-header">Empleados</h3>
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
