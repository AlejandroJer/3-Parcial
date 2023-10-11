<?php
require_once("../autoload.php");
 use modelos\productos;
$productObj = new productos();
$productos = "";
$flag = "";
if(isset($_GET['search'])){
    $KeyWord = filter_var($_GET['search'], FILTER_SANITIZE_STRING);
    $productos = $productObj->GetProductoByKeyWord($KeyWord);
    $flag = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JEMAS</title>
    <link rel="stylesheet" href="../sources/css/root.css">
    <link rel="stylesheet" href="../sources/css/nav.css">
</head>
<body>
<section class="index_section">
        <nav class="navHome">
            <header class="navHome_header">
                <h1>JEMAS</h1>
            </header>

            <div class="navHome_ol">
                <a href="../dashboard.php">
                    <div  class="option_container">
                        <h3>Dashboard</h3>
                    </div>
                </a>
                <div class="option target">
                    <div class="option_container">
                        <div>
                            <iconify-icon class="iconify" icon="ic:baseline-inventory" width="20" height="20"></iconify-icon>
                            <h3>Inventario</h3>
                        </div>
                        <span class="arrow"></span>
                    </div>
                    <ul class="navHome_ul">
                        <a href="./add.php"><li>Agregar Inventario</li></a>
                        <a href="./read.php"><li>Ver Inventario</li></a>
                        <a href="./search.php"><li class="target">Buscar en Inventario</li></a>
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
                        <a href="../proveedores/add.php"><li>Agregar Proveedor</li></a>
                        <a href="../proveedores/read.php"><li>Ver Proveedores</li></a>
                        <a href="../proveedores/search.php"><li>Buscar en Proveedores</li></a>
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
                        <a href="../empleados/add.php"><li>Agregar Empleado</li></a>
                        <a href="../empleados/read.php"><li>Ver Empleados</li></a>
                        <a href="../empleados/search.php"><li>Buscar en Empleados</li></a>
                    </ul>
                </div>
            </div>
        </nav>

        <section class="main_container">
            <header class="main_header">
                <span id="NavArrow"></span>
                <div class="header_login" data-messages="Iniciar Secion">
                    <a href="../auth/login.php">
                        <iconify-icon class="iconify" icon="clarity:sign-in-solid" width="30" height="30"></iconify-icon>
                    </a>
                </div>
            </header>
            <main class="search_bar">
                <form method="GET" action="<?= $_SERVER['PHP_SELF']; ?>">
                    <input type="text" name="search" placeholder="Buscar">
                    <button type="submit" name="submit">
                        <iconify-icon class="iconify" icon="fa-solid:search" width="20" height="20"></iconify-icon>
                    </button>
                </form>
                <div class="search_results">
                    <?php if(empty($productos)){ ?>
                        <h1>BUSQUE ALGO PARA EMPEZAR</h1>
                    <?php } else { 
                        foreach ($productos as $producto) { ?>
                            <div>
                                <div class="search_result_header">
                                    <span class="arrow"></span>
                                </div>
                                <div class="search_result_main">
                                    <div class="search_result_main_img">
                                        <img src="../inventario/<?= $producto['imagen']; ?>" alt="">
                                    </div>
                                    <div class="search_result_main_info">
                                        <h3><?= $producto[1]; ?></h3>
                                        <p><?= $producto['descripcion_producto']; ?></p>
                                        <p><?= $producto['precio_venta']; ?></p>
                                        <p><?= $producto['cantidad_disponible']; ?></p>
                                        <p><?= $producto['ubicacion_almacen']; ?></p>
                                        <p><?= $producto['nombre_proveedor']; ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </main>
        </section>
    </section>
</body>
<script src="../sources/js/nav.js"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</html>
