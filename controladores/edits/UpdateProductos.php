<?php
 namespace controladores;
    require_once("./../../autoload.php");
    use modelos\productos;
    $producto = new productos();

 if(isset($_POST['id'])){
    $result = $producto->GetProductoById($_POST['id']);
    $_SESSION['producto'] = $result;
    header("location:./../../inventario/update.php");
 }else{
    if(isset($_POST['submit'])){
        if(!isset($_POST['producto-nombre']) or !isset($_POST['producto-proveedor']) or !isset($_POST['producto-precio-venta']) or !isset($_POST['producto-precio-compra']) or !isset($_POST['categoria']) or !isset($_POST['tipo-material']) or !isset($_POST['peso']) or !isset($_POST['cantidad-disponible']) or !isset($_POST['ubicacion-almacen']) or !isset($_POST['producto-descripcion'])){
            header("location:./../../inventario/add.php");
        } else {
            $id = intval($_POST['id_producto']);
            $precio_compra_float = floatval($_POST['producto-precio-compra']);
            $precio_venta_float = floatval($_POST['producto-precio-venta']);
            $peso_int = intval($_POST['peso']);
            $cantidad_disponible_int = intval($_POST['cantidad-disponible']);
            
            if($_FILES['image']['error'] == 0){
                $name_images= $producto->GetDirImg();
                $dir_img = $producto->InsertarImg($name_images);
                $producto->UpdateProducto($id, $_POST['producto-nombre'], $_POST['producto-descripcion'], $precio_compra_float, $precio_venta_float, $_POST['categoria'],$peso_int, $_POST['tipo-material'], $cantidad_disponible_int, $_POST['ubicacion-almacen'], $_POST['producto-proveedor'], $dir_img);
            }else{
                $producto->UpdateProducto($id, $_POST['producto-nombre'], $_POST['producto-descripcion'], $precio_compra_float, $precio_venta_float, $_POST['categoria'],$peso_int , $_POST['tipo-material'], $cantidad_disponible_int, $_POST['ubicacion-almacen'], $_POST['producto-proveedor']);
            }
            header("location:./../../inventario/read.php");
        }
    } else {
        header("location:./../../inventario/read.php");
    }
 }
?>