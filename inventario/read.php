<?php
namespace controladores;
require_once("../autoload.php");
 use modelos\productos;
    $productos = new productos();

  if(isset($_SESSION['results'])){
    $results = $_SESSION['results'];
    $index = $_SESSION['index'];
    $page = $_SESSION['pageClicked'];
  } else {
    $limit = 3;
    $results = $productos->GetproductosLimited(0, $limit);
    $index = $productos->GetproductosIndex();
    $index = ceil($index/$limit);
    $page = 0;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JEMAS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../sources/css/root.css">
</head>
<body class="container-fluid bg-light">
    <section class="index_section row vh-100">
        <nav class="navHome d-flex flex-column flex-shrink-0 bg-light p-0 border-end" style="width: 4.5rem">
            <a href="#" class="d-block p-3 link-dark text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="right" title="JEMAS">
                <iconify-icon icon="map:jewelry-store" width="40" height="40"></iconify-icon>
            </a>
            <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                <li class="nav-item">
                    <a href="../dashboard.php" class="nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
                        <iconify-icon icon="bxs:dashboard" width="30" height="30"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="../inventario/add.php" class="option_container nav-link active py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Inventario">
                        <iconify-icon class="iconify" icon="ic:baseline-inventory" width="30" height="30"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="../proveedores/add.php" class="option_container nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Proveedores">
                        <iconify-icon class="iconify" icon="fa-solid:users" width="30" height="30"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="../empleados/add.php" class="option_container nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Empleados">
                        <iconify-icon class="iconify" icon="clarity:employee-solid" width="30" height="30"></iconify-icon>
                    </a>
                </li>
            </ul>
            <div class="border-top">
                <a href="./auth/login.php" class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="right" title="Iniciar Sesion">
                    <iconify-icon class="iconify" icon="clarity:sign-in-solid" width="30" height="30"></iconify-icon>
                </a>
            </div>
        </nav>

        <section class="main_container col-lg-11 bg-light">
            <ul class="nav nav-tabs my-4">
                <li class="nav-item">
                    <a href="./add.php" class="nav-link">Agregar Producto</a>
                </li>
                <li class="nav-item">
                    <a href="./read.php" class="nav-link active" aria-current="page">Ver todos los Productos</a>
                </li>
                <li class="nav-item">
                    <a href="./search.php" class="nav-link">Buscar Productos</a>
                </li>
            </ul>
            <main class="dashboard_container container">
                <?php if(!empty($results)): ?>
                    <?php foreach ($results as $result) { ?>
                        <div class="readObject_Container target card mb-4">
                            <div class="readObject_header card-header">
                                <div class="row">
                                    <form action="../controladores/edits/UpdateProductos.php" method="post" class="form_edit col-auto me-auto d-flex align-items-center">
                                        <input class="" type="hidden" name="id" value=<?php echo $result['id_producto']; ?>>
                                        <button  class="button btn btn-primary"> Editar</button>
                                    </form>
                                    <form action="../controladores/deletes/DeleteProducto.php" method="post" class="">
                                        <input class="" type="hidden" name="id" value=<?php echo $result['id_producto']; ?>>
                                        <button  class=""> Borrar</button>
                                    </form>
                                    <div class="accordion col-auto">
                                        <div class="row accordion-header">
                                            <button type="button" class="accordion-button collapsed bg-transparent shadow-none"
                                            data-bs-toggle="collapse" data-bs-target="#Accordion<?= $result['id_producto']; ?>">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="principal_data card-body row">
                                <div class="row">
                                    <div class="image_container col-lg-2">
                                        <?php if($result['imagen'] != null) {?>
                                            <img src="<?php echo $result['imagen']; ?>" alt="imagen de producto" class="img-fluid rounded-start">
                                        <?php } ?>
                                    </div>
                                    <div class="data_container col-lg-10">
                                        <div class="row">
                                            <h2><?= $result['nombre_producto'];?></h2>
                                            <h4><?=$result['Descripcion_producto'];?></h4>
                                        </div>
                                        <div class="row mt-2">
                                            <h6 class="ingreso col-auto me-auto">Precio Venta <br> $<?= $result['precio_venta'];?> pesos</h6>
                                            <h6 class="gasto col-auto me-auto">Precio Compra <br> $<?= $result['precio_compra'];?> pesos</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="data_container hidde card-footer collapse" id="Accordion<?= $result['id_producto']; ?>">
                                <div class="row">
                                    <div class="product_tags col-lg-3">
                                        <h5>TAGS</h5>
                                        <div>
                                            <h6>Categoría: <?php echo $result['categoria'];?></h6>
                                            <h6>Material: <?php echo $result['tipo_material'];?></h6>
                                        </div>
                                    </div>
                                    <div class="product_info col-lg-9">
                                        <h5>Datos del producto</h5>
                                        <h6>Peso: <?= $result['peso'];?> g</h6>
                                        <h6>Cantidad disponible: <?= $result['cantidad_disponible'];?></h6>
                                        <h6>Ubicación Almancen: <?= $result['ubicacion_almacen'];?></h6>
                                        <h6>Proveedor: <?= $productos->GetProveedorByProductoId($result['id_producto']); ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php endif; ?>
            </main>
            <?php if(!empty($index)) {?>
                <nav>
                    <form action="../controladores/gets/ReadProductos.php" method="POST" class="form_pages">
                        <ul class="pagination justify-content-center">
                            <?php for($i = 0; $i < $index; $i++): ?>
                                <?php if($i == $page){ ?>
                                    <li class="page-item active">
                                        <button type="submit" class="btn_page target page-link" name="submitPaginated" value="<?= $i ?>"><?= $i+1 ?></button>
                                    </li>
                                <?php } else { ?>
                                    <li class="page-item">
                                        <button type="submit" class="btn_page page-link" name="submitPaginated" value="<?= $i ?>"><?= $i+1 ?></button>
                                    </li>
                                <?php } ?>
                            <?php endfor; ?>
                        </ul>
                    </form>
                </nav>
            <?php } ?>
        </section>
    </section>
    <?php unset($_SESSION['results']);
              unset($_SESSION['index']); ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script src="../sources/js/app.js"></script>
</html>
