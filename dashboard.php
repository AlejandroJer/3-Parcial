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
    <link rel="stylesheet" href="./sources/css/root.css">
    <link rel="stylesheet" href="./sources/css/nav.css">
    <link rel="stylesheet" href="./sources/css/dashboard.css">
</head>
<body>
    <section class="index_section">
        <nav class="navHome">
            <header class="navHome_header">
                <h1>JEMAS</h1>
            </header>
            <div class="navHome_ol">
                <a href="./dashboard.php">
                    <div  class="active option_container target">
                        <h3>Dashboard</h3>
                    </div>
                </a>
                <div class="option">
                    <div class="option_container">
                        <div>
                            <iconify-icon class="iconify" icon="ic:baseline-inventory" width="20" height="20"></iconify-icon>
                            <h3>Inventario</h3>
                        </div>
                        <span class="arrow"></span>
                    </div>
                    <ul class="navHome_ul hidden">
                        <a href="./inventario/add.php"><li>Agregar Inventario</li></a>
                        <a href="./inventario/read.php"><li>Ver Inventario</li></a>
                        <a href="./inventario/search.php"><li>Buscar en Inventario</li></a>
                    </ul>
                </div>
                <div class="option">
                    <div class="option_container">
                        <div>
                            <iconify-icon class="iconify" icon="fa-solid:users" width="20" height="20"></iconify-icon>
                            <h3>Proveedores</h3>
                        </div>
                        <span class="arrow"></span>
                    </div>
                    <ul class="navHome_ul hidden">
                        <a href="./proveedores/add.php"><li>Agregar Proveedor</li></a>
                        <a href="./proveedores/read.php"><li>Ver Proveedores</li></a>
                        <a href="./proveedores/search.php"><li>Buscar en Proveedores</li></a>
                    </ul>
                </div>
                <div class="option">
                    <div class="option_container">
                        <div>
                            <iconify-icon class="iconify" icon="clarity:employee-solid" width="20" height="20"></iconify-icon>
                            <h3>Empleados</h3>
                        </div>
                        <span class="arrow"></span>
                    </div>
                    <ul class="navHome_ul hidden">
                        <a href="./empleados/add.php"><li>Agregar Empleado</li></a>
                        <a href="./empleados/read.php"><li>Ver Empleados</li></a>
                        <a href="./empleados/search.php"><li>Buscar en Empleados</li></a>
                    </ul>
                </div>
            </div>
        </nav>

        <section class="main_container">
            <header class="main_header">
                <span id="NavArrow"></span>
                <div class="header_login" data-messages="Iniciar Secion">
                    <h3 id="dataScreen"></h3>
                    <a href="./auth/login.php">
                        <iconify-icon class="iconify" icon="clarity:sign-in-solid" width="30" height="30"></iconify-icon>
                    </a>
                </div>
            </header>
            <main class="dashboard_main">
                <h2>Dashboard</h2>
                <h4>
                    Bienvenido al sistema de inventario JEMAS, en esta sección podras ver las opciones que tienes disponibles para administrar.
                </h4>
                <section>
                    <a href="./inventario/add.php">
                        <div class="dashboard_options option_container">
                            <div>
                                <h3>Inventario</h3>
                            </div>
                            <div>
                                <iconify-icon class="iconify" icon="ic:baseline-inventory" width="40" height="40"></iconify-icon>
                                <h4><?= $productos->GetproductosIndex(); ?> Productos</h4>
                            </div>
                        </div>
                    </a>
                    <a href="./proveedores/add.php">
                        <div class="dashboard_options option_container">
                            <div>
                                <h3>Proveedores</h3>
                            </div>
                            <div>
                                <iconify-icon class="iconify" icon="fa-solid:users" width="40" height="40"></iconify-icon>
                                <h4>No. Proveedores</h4>
                            </div>
                        </div>
                    </a>
                    <a href="./empleados/add.php">
                        <div class="dashboard_options option_container">
                            <div>
                                <h3>Empleados</h3>
                            </div>
                            <div>
                                <iconify-icon class="iconify" icon="clarity:employee-solid" width="40" height="40"></iconify-icon>
                                <h4><?= $empleados->GetusuariosIndex(); ?> Empleados</h4>
                            </div>
                        </div>
                    </a>
                </section>
            </main>
        </section>
    </section>
</body>
<script src="./sources/js/nav.js"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</html>
