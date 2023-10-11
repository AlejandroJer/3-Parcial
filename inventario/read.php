
<?php
  require_once("../autoload.php");
	use modelos\productos;
  $productos = new productos();
	$posts = $productos->Getproductos();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JEMAS</title>
    <link rel="stylesheet" href="../sources/css/root.css">
    <link rel="stylesheet" href="../sources/css/nav.css">
    <link rel="stylesheet" href="../sources/css/read.css">
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
                        <a href="./read.php"><li class="target">Ver Inventario</li></a>
                        <a href="./search.php"><li>Buscar en Inventario</li></a>
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
            <main class="read_container">
                <div class="read_header">
                    <button type="button" class="btn_read">Ver Inventario</button>
                </div>
                <div class="read_main">
                <?php foreach ($posts as $post) { ?>
                    <div class="readObject_Container">
                        <div class="readObject_header">
                            <span class="arrow"></span>
                        </div>
                        <div>
                            <div class="image_container">
                            <?php if($post['imagen'] != null) {?>
                                <img src="<?php echo $post['imagen']; ?>" alt="imagen de producto" class="">
                                <h4 class="ingreso">Precio Venta <br> $<?= $post['precio_venta'];?> pesos</h4>
                                <h4 class="gasto">Precio Compra <br> $<?= $post['precio_compra'];?> pesos</h4>


                            <?php } ?>
                            </div>
                            <div class="data_container">
                                <h2><?= $post['nombre_producto'];?></h2>
                                <h4><?=$post['Descripcion_producto'];?></h4>
                            </div>
                        </div>
                        <div class="data_container">
                            <div class="product_tags">
                               
                                <h5>Categoría: <?php echo $post['categoria'];?></h5>
                                <h5>Material: <?php echo $post['tipo_material'];?></h5>
                            </div>
                            <div class="product_info">
                                <h5>Peso: <?= $post['peso'];?></h5>
                                <h5>Cantidad disponible: <?= $post['cantidad_disponible'];?></h5>
                                <h5>Ubicación Almancen: <?= $post['ubicacion_almacen'];?></h5>
                                <h5>ID Proveedor: <?php echo $post['id_proveedor'];?></h5>
                            </div>
                            
                            <div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- <div class="readObject_Container">
                        <div>
                            <div class="image_container">
                            
                            </div>
                        </div>
                    </div> -->
                <?php } ?>
                </div>
            </main>
        </section>
    </section>
</body>
<script src="../sources/js/nav.js"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</html>



