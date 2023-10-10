<?php
require_once("../autoload.php");
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
                        <a href="./add.php"><li class="target">Agregar Inventario</li></a>
                        <a href="./read.html"><li>Ver Inventario</li></a>
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
                        <a href="../preveedores/add.html"><li>Agregar Proveedor</li></a>
                        <a href="../preveedores/read.html"><li>Ver Proveedores</li></a>
                        <a href="../preveedores/search.html"><li>Buscar en Proveedores</li></a>
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
                        <a href="../empleados/add.html"><li>Agregar Empleado</li></a>
                        <a href="../empleados/read.html"><li>Ver Empleados</li></a>
                        <a href="../empleados/search.html"><li>Buscar en Empleados</li></a>
                    </ul>
                </div>
            </div>
        </nav>
        <section class="main_container">
            <header class="main_header">
                <span id="NavArrow"></span>
                <div class="header_login" data-messages="Iniciar Secion">
                    <a href="../auth/login.html">
                        <iconify-icon class="iconify" icon="clarity:sign-in-solid" width="30" height="30"></iconify-icon>
                    </a>
                </div>
            </header>
            <main class="dashboard_container">
                <form action="../controladores/SetProducto.php" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <input type="hidden" name="id_inv" value="null">
                        <div class="form-group">
                            <label for="producto-nombre">Nombre del producto:</label>
                            <input type="text" class="form-control" name="producto-nombre" id="producto-nombre" placeholder="Nombre del producto" required>
                        </div>
                        <div class="form-group">
                            <label for="producto-proveedor">ID del Proveedor:</label>
                            <input type="number" step="0.01" class="form-control" name="producto-proveedor" id="producto-proveedor" placeholder="ID Proveedor" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="precio-venta">Precio de venta:</label>
                            <input type="number" step="0.01" class="form-control" name="producto-precio-venta" id="precio-venta" placeholder="Precio $" required>
                        </div>
                        <div class="form-group">
                            <label for="precio-compra">Precio de compra:</label>
                            <input type="number" step="0.01" class="form-control" name="producto-precio-compra" id="precio-compra" placeholder="Precio $" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="producto-categoria">Categoría:</label>
                            <select name="categoria" required>
                                <option value="Anillo">Anillos</option>
                                <option value="Collar">Collares y Colgantes</option>
                                <option value="Pulsera">Pulseras</option>
                                <option value="Pulsera">Pendientes</option>
                                <option value="Pulsera">Relojes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tipo-material">Material:</label>
                            <select name="tipo-material" required>
                                <option value="Oro">Oro</option>
                                <option value="Plata">Plata</option>
                                <option value="Platino">Platino</option>
                                <option value="Cobre">Cobre</option>
                            </select>  
                        </div>
                    </div> 
                    <div class="form-row">
                        <div class="form-group">
                            <label for="peso">Peso:</label>
                            <input type="number" class="form-control" name="peso" id="peso" placeholder="Peso" required>
                        </div>
                        <div class="form-group">
                            <label for="producto-cantidad-disponible">Cantidad disponible:</label>
                            <input type="number" class="form-control" name="cantidad-disponible" id="cantidad_disponible" placeholder="Disponible" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="producto-ubicacion-almacen">Ubicación en el almacén:</label>
                        <input type="text" class="form-control" name="ubicacion-almacen" id="ubicacion-almacen" placeholder="Ubicacion en el almacén" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="producto-descripcion">Descripción:</label>
                            <textarea id="producto-descripcion" name="producto-descripcion" rows="4" required></textarea>
                        </div>  
                        <div class="form-group">
                            <label for="imagen">Imagen del Producto:</label>
                            <input type="file" accept=".jpeg, .png, .jpg "  name="image">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </main>
        </section>
    </section>
</body>
<script src="../sources/js/nav.js"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</html>
