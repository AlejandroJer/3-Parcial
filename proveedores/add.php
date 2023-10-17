<?php
require_once("../autoload.php");
if(isset($_SESSION['proveedores'])){
    $result = $_SESSION['proveedores'];
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
                <div class="option target">
                    <div class="option_container">
                        <div>
                            <iconify-icon class="iconify" icon="fa-solid:users" width="20" height="20"></iconify-icon>
                            <h3>Proveedores</h3>
                        </div>
                        <span class="arrow"></span>
                    </div>
                    <ul class="navHome_ul">
                        <a href="./add.php"><li class="target"><?php echo (isset($result['id_proveedor'])) ? 'Actualizar Proveedor' : 'Agregar Proveedor'; ?></li></a>
                        <a href="./read.php"><li>Ver Proveedores</li></a>
                        <a href="./search.php"><li>Buscar en Proveedores</li></a>
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
                <form action="<?php echo (!empty($result)) ? '../controladores/edits/UpdateProveedores.php' : '../controladores/SetProveedor.php'; ?>" method="POST">
                    <div class="form_row">
                        <div class="form-group">
                            <label for="nombre-empresa">Nombre de la Empresa:</label>
                            <input type="text" class="form-control" name="nombre-empresa" id="nombre-empresa" placeholder="Empresa" value="<?php echo (isset($result['nombre_empresa'])) ? $result['nombre_empresa'] : ''; ?>" required>
                        </div>
                    </div>
                    <div class="form_row">
                        <div class="form-group">
                            <label for="direccion-proveedor">Dirección:</label>
                            <input type="text" class="form-control" name="direccion-proveedor" id="direccion-proveedor" placeholder="Dirección del proveedor" value="<?php echo (isset($result['direccion'])) ? $result['direccion'] : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="persona-contacto">Persona de contacto:</label>
                            <input type="text" class="form-control" name="persona-contacto" id="persona-contacto" placeholder="Persona de contacto" value="<?php echo (isset($result['persona_contacto'])) ? $result['persona_contacto'] : ''; ?>" required>
                        </div>
                    </div>    
                    <div class="form_row">
                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input type="tel" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" value="<?php echo (isset($result['num_telefono'])) ? $result['num_telefono'] : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="correo-proveedor">Correo electrónico:</label>
                            <input type="email" class="form-control" name="correo-proveedor" id="correo-proveedor" value="<?php echo (isset($result['email_proveedor'])) ? $result['email_proveedor'] : ''; ?>" placeholder="Correo electrónico" required>
                        </div>
                    </div>
                    <?php
                    if(isset($result['id_proveedor'])){
                        echo '<input type="hidden" name="id_proveedor" value="' . $result['id_proveedor'] . '">';
                    }
                    ?>
                    <button type="submit" class="btn btn-primary" name="submit"><?php echo (isset($result['id_proveedor'])) ? 'Actualizar' : 'Guardar'; ?></button>
                </form>
            </main>
        </section>
    </section>
    <?php
    if(isset($_SESSION['proveedores'])){
        unset($_SESSION['proveedores']);
    } ?>
</body>
<script src="../sources/js/nav.js"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</html>