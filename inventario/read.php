
<?php
  require_once("../autoload.php");
	use modelos\productos;
  $productos = new productos();
	$posts = $productos->Getproductos();
?><!DOCTYPE html>
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
                        <a href="./search.html"><li>Buscar en Inventario</li></a>
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
                        <a href="../proveedores/add.html"><li>Agregar Proveedor</li></a>
                        <a href="../proveedores/read.html"><li>Ver Proveedores</li></a>
                        <a href="../proveedores/search.html"><li>Buscar en Proveedores</li></a>
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
                <button class="ver-button">Ver Inventario</button>
            </header>
        </section>
    </section>
    <!-- PHP: Productos -->
    <section class="">
		<div class="">
			<?php foreach ($posts as $post) { ?>
			<div class="">
				<h4><?php echo $post['nombre_producto'];?></h4>
				<h5><?php echo $post['id_proveedor'];?></h5>
                <h5><?php echo $post['precio_venta'];?></h5>
                <h5><?php echo $post['precio_compra'];?></h5>
                <h5><?php echo $post['categoria'];?></h5>
                <h5><?php echo $post['tipo_material'];?></h5>
                <h5><?php echo $post['peso'];?></h5>
                <h5><?php echo $post['cantidad_disponible'];?></h5>
                <h5><?php echo $post['ubicacion_almacen'];?></h5>
                <h5><?php echo $post['descripcion_producto'];?></h5>
				<?php if($post['imagen'] != null) {?>
					<img src="<?php echo $post['imagen']; ?>" alt="imagen de producto" class=""><br>
				<?php } ?>
				
			</div>
			<?php } ?>
		</div>
	</section>
</body>
<script src="../sources/js/nav.js"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</html>
