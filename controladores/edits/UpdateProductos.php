<?php
 namespace controladores;
    require_once("./../../autoload.php");
    use modelos\productos;
    $producto = new productos();

 if(isset($_POST['id'])){
    $result = $producto->GetProductoById($_POST['id']);
    $_SESSION['producto'] = $result;
    header("location:./../../inventario/add.php");
 }else{
    if(isset($_POST['submit'])){
        if(!isset($_POST['producto-nombre']) or !isset($_POST['producto-proveedor']) or !isset($_POST['producto-precio-venta']) or !isset($_POST['producto-precio-compra']) or !isset($_POST['categoria']) or !isset($_POST['tipo-material']) or !isset($_POST['peso']) or !isset($_POST['cantidad-disponible']) or !isset($_POST['ubicacion-almacen']) or !isset($_POST['producto-descripcion'])){
            header("location:./../../inventario/add.php");
        } else {
            $id_str = $_POST['id_producto'];
            $id = intval($id_str);
            $precio_compra_str = $_POST['producto-precio-compra'];
            $precio_compra_float = floatval($precio_compra_str);
            $precio_venta_str = $_POST['producto-precio-venta'];
            $precio_venta_float = floatval($precio_venta_str);
            $peso_str = $_POST['peso'];
            $peso_int = intval($peso_str);
            $cantidad_disponible_str = $_POST['cantidad-disponible'];
            $cantidad_disponible_int = intval($cantidad_disponible_str);
            
            if($_FILES['image']['error'] == 0){
                $name_images= $producto->GetDirImg();
                $dir_img = $producto->InsertarImg($name_images);
                $producto->UpdateProducto($id, $_POST['producto-nombre'], $_POST['producto-descripcion'], $precio_compra_float, $precio_venta_float, $_POST['categoria'],$peso_int, $_POST['tipo-material'], $cantidad_disponible_int, $_POST['ubicacion-almacen'], $_POST['producto-proveedor'], $dir_img);
            }else{
                $producto->UpdateProducto($id, $_POST['producto-nombre'], $_POST['producto-descripcion'], $precio_compra_float, $precio_venta_float, $_POST['categoria'],$peso_int , $_POST['tipo-material'], $cantidad_disponible_int, $_POST['ubicacion-almacen'], $_POST['producto-proveedor']);
            }
            header("location:./../../inventario/read.php");
        }
    }
 }
?>