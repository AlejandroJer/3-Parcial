<?php
require_once("../autoload.php");
if(isset($_SESSION['producto'])){
    $result = $_SESSION['producto'];
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
    <link rel="stylesheet" href="../sources/css/addforms.css">
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
                        <a href="./add.php"><li class="target">Agregar Inventario</li></a>
                        <a href="./read.php"><li>Ver Inventario</li></a>
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
            <main class="dashboard_container">
                <form action="<?php echo (!empty($result)) ? '../controladores/edits/UpdateProductos.php' : '../controladores/SetProducto.php'; ?>" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <input type="hidden" name="id_inv" value="null">
                        <div class="form-group">
                            <label for="producto-nombre">Nombre del producto:</label>
                            <input type="text" class="form-control" name="producto-nombre" id="producto-nombre" placeholder="Nombre del producto" value="<?php echo (isset($result['nombre_producto'])) ? $result['nombre_producto'] : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="producto-proveedor">ID del Proveedor:</label>
                            <input type="number" min="0" class="form-control" name="producto-proveedor" id="producto-proveedor" placeholder="ID Proveedor" value="<?php echo (isset($result['id_proveedor'])) ? $result['id_proveedor'] : ''; ?>" required>
                        </div>
                    </div>
                    <div class="form_row">
                        <div class="form-group">
                            <label for="precio-venta">Precio de venta:</label>
                            <input type="number" min="0" step="0.01" class="form-control" name="producto-precio-venta" id="precio-venta" placeholder="Precio $" value="<?php echo (isset($result['precio_venta'])) ? $result['precio_venta'] : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="precio-compra">Precio de compra:</label>
                            <input type="number" min="0" step="0.01" class="form-control" name="producto-precio-compra" id="precio-compra" placeholder="Precio $" value="<?php echo (isset($result['precio_compra'])) ? $result['precio_venta'] : ''; ?>" required>
                        </div>
                    </div>
                    <div class="form_row">
                        <div class="form-group">
                            <label for="producto-categoria">Categoría:</label>
                            <select name="categoria" required>
                                <option value="Anillo" <?php if(isset($result['categoria']) && $result['categoria'] == 'Anillo') { echo 'selected'; } ?>>Anillos</option>
                                <option value="Collar" <?php if(isset($result['categoria']) && $result['categoria'] == 'Collar') { echo 'selected'; } ?>>Collares y Colgantes</option>
                                <option value="Pulsera" <?php if(isset($result['categoria']) && $result['categoria'] == 'Pulsera') { echo 'selected'; } ?>>Pulseras</option>
                                <option value="Pendiente" <?php if(isset($result['categoria']) && $result['categoria'] == 'Pendiente') { echo 'selected'; } ?>>Pendientes</option>
                                <option value="Reloj" <?php if(isset($result['categoria']) && $result['categoria'] == 'Reloj') { echo 'selected'; } ?>>Relojes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tipo-material">Material:</label>
                            <select name="tipo-material" required>
                                <option value="Oro" <?php if(isset($result['tipo_material']) && $result['tipo_material'] == 'Oro') { echo 'selected'; } ?>>Oro</option>
                                <option value="Plata" <?php if(isset($result['tipo_material']) && $result['tipo_material'] == 'Plata') { echo 'selected'; } ?>>Plata</option>
                                <option value="Platino" <?php if(isset($result['tipo_material']) && $result['tipo_material'] == 'Platino') { echo 'selected'; } ?>>Platino</option>    
                            </select>  
                        </div>
                    </div> 
                    <div class="form_row">
                        <div class="form-group">
                            <label for="peso">Peso:</label>
                            <input type="number" min="0" step="0.01"  class="form-control" name="peso" id="peso" placeholder="Onzas" value="<?php echo (isset($result['peso'])) ? $result['peso'] : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="producto-cantidad-disponible">Cantidad disponible:</label>
                            <input type="number" min="0" class="form-control" name="cantidad-disponible" id="cantidad_disponible" placeholder="Disponible" value="<?php echo (isset($result['cantidad_disponible'])) ? $result['cantidad_disponible'] : ''; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="producto-ubicacion-almacen">Ubicación en el almacén:</label>
                        <input type="text" class="form-control" name="ubicacion-almacen" id="ubicacion-almacen" placeholder="Ubicacion en el almacén" value="<?php echo (isset($result['ubicacion_almacen'])) ? $result['ubicacion_almacen'] : ''; ?>" required>
                    </div>
                    <div class="form_row">
                        <div class="form-group">
                            <label for="producto-descripcion">Descripción:</label>
                            <textarea id="producto-descripcion" name="producto-descripcion" rows="4" required><?php echo (isset($result['Descripcion_producto'])) ? $result['Descripcion_producto'] : ''; ?></textarea>
                        </div>  
                        <div class="form-group">
                            <label for="imagen">Imagen del Producto: </label>
                            <input type="file" accept=".jpeg, .png, .jpg "id="imagen"  name="image" hidden>
                            <span class="file-status"><td><?php if (empty($result['imagen'])) { echo "Sin imagen "; } else { ?><a href='<?php echo $result['imagen']; ?>' target=“_blank”><?php echo explode("/", $result['imagen'])[1]; ?></a><?php } ?></td></span>
                        </div>
                    </div>
                    <?php
                    if(isset($result['id_producto'])){
                        echo '<input type="hidden" name="id_producto" value="' . $result['id_producto'] . '">';
                    }
                    ?>
                    <button type="submit" class="btn btn-primary" name="submit">Guardar</button>
                </form>
            </main>
        </section>
    </section>
    <?php
    if(isset($_SESSION['producto'])){
        unset($_SESSION['producto']);
    } ?>
</body>
<script src="../sources/js/nav.js"></script>
<script src="../sources/js/app.js"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</html>
