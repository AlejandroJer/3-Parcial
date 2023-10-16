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
                <a href="../dashboard.php">
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
                        <a href="../inventario/search.php"><li>Buscar en Inventario</li></a>
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
                <div class="option target">
                    <div class="option_container">
                        <div>
                            <iconify-icon class="iconify" icon="clarity:employee-solid" width="20" height="20"></iconify-icon>
                            <h3>Empleados</h3>
                        </div>
                        <span class="arrow"></span>
                    </div>
                    <ul class="navHome_ul">
                        <a href="./add.php"><li class="target">Agregar Empleado</li></a>
                        <a href="./read.php"><li>Ver Empleados</li></a>
                        <a href="./search.php"><li>Buscar en Empleados</li></a>
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
                <form action="../controladores/SetUsuario.php" method="post">
                    <div class="form_row">
                        <input type="hidden" name="usuario-rol" value="0">
                        <div class="form-group col-md-6">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="usuario-nombre" class="form-control" id="nombre" placeholder="Nombre">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="apellido">Apellidos:</label>
                            <input type="text" name="usuario-apellido" class="form-control" id="apellido" placeholder="Apellido">
                        </div>
                    </div>
                    <div class="form_row">
                        <div class="form-group col-md-6">
                            <label for="email">Email:</label>
                            <input type="email" name="usuario-email" class="form-control" id="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="sexo">Sexo:</label>
                            <select name="sexo" required>
                                <option value="f">Femenino</option>
                                <option value="m">Masculino</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password">Contraseña:</label>
                            <input type="password" name="usuario-password" class="form-control" id="Password" placeholder="Contraseña">
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
