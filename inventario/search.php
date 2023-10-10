<?php
require_once("../autoload.php");
use modelos\productos;

if(isset($_POST['search'])) {
    $searchTerm = $_POST['search'];
    $productos = new productos();
    $posts = $productos->BuscarProductosPorPalabraClave($searchTerm);
} else {
    $posts = array();
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
                <a href="../dashboard.html">
                    <div  class="option_container">
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
                        <a href="../inventario/add.php"><li>Agregar Inventario</li></a>
                        <a href="../inventario/read.php"><li>Ver Inventario</li></a>
                        <a href="../inventario/search.html"><li>Buscar en Inventario</li></a>
                    </ul>
                </div>
                <div class="option target">
                    <div class="option_container">
                        <div>
                            <iconify-icon class="iconify" icon="fa-solid:users" width="20" height="20"></iconify-icon>
                            <h3>Proveedores</h3>
                        </div>
                        <span class="arrow"></span>
                    </div>
                    <ul class="navHome_ul">
                        <a href="./add.html"><li>Agregar Proveedor</li></a>
                        <a href="./read.html"><li>Ver Proveedores</li></a>
                        <a href="./search.html"><li class="target">Buscar en Proveedores</li></a>
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
                        <a href="../empleados/read.html"><li>Ver Empleados</li></a>
                        <a href="../empleados/search.html"><li>Buscar en Empleados</li></a>
                    </ul>
                </div>
            </div>
        </nav>

        <section class="main_container">
            <header class="main_header">
                <span id="NavArrow"></span>
                <div class="search-bar">
                    <form method="POST" action="">
                        <input type="text" name="search" placeholder="Buscar">
                        <button type="submit">
                            <iconify-icon class="iconify" icon="fa-solid:search" width="20" height="20"></iconify-icon>
                        </button>
                    </form>
                </div>
            </header>

            <!-- Resultados de la búsqueda -->
            <div class="search_results">
                <?php if (!empty($posts)) { ?>
                    <h2>Resultados de la búsqueda:</h2>
                    <div class="">
                        <?php foreach ($posts as $post) { ?>
                            <div class="">
                                <h4><?php echo $post['nombre_producto'];?></h4>
                                <h5><?php echo $post['id_proveedor'];?></h5>
                                <h5><?php echo $post['precio_venta'];?></h5>
                                <h5><?php echo $post['precio_compra'];?></h5>
                                <h5><?php echo $post['categoria'];?></h5>
                                <?php if($post['imagen'] != null) {?>
                                    <img src="<?php echo $post['imagen']; ?>" alt="imagen de producto" class=""><br>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <p>No se encontraron resultados para la búsqueda.</p>
                <?php } ?>
            </div>
        </section>
    </section>
</body>
<script src="../sources/js/nav.js"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</html>
