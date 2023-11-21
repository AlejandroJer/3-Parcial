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
            $id = filter_var($_POST['id_producto'], FILTER_SANITIZE_NUMBER_INT);
            $nombre = filter_var($_POST['producto-nombre'], FILTER_SANITIZE_STRING);
            $descripcion = filter_var($_POST['producto-descripcion'], FILTER_SANITIZE_STRING);
            $precio_compra_float = floatval($_POST['producto-precio-compra']);
            $precio_venta_float = floatval($_POST['producto-precio-venta']);
            $categoria = filter_var($_POST['categoria'], FILTER_SANITIZE_NUMBER_INT);
            $peso_int = filter_var($_POST['peso'], FILTER_SANITIZE_NUMBER_INT);
            $tipo_material = filter_var($_POST['tipo-material'], FILTER_SANITIZE_NUMBER_INT);
            $cantidad_disponible_int = filter_var($_POST['cantidad-disponible'], FILTER_SANITIZE_NUMBER_INT);
            $ubicacion_almacen = filter_var($_POST['ubicacion-almacen'], FILTER_SANITIZE_STRING);
            $proveedor = filter_var($_POST['producto-proveedor'], FILTER_SANITIZE_NUMBER_INT);
            
            if($_FILES['image']['error'] == 0){
                $name_images= $producto->GetDirImg();
                die($name_images);
                $dir_img = $producto->InsertarImg($name_images);
                $producto->SetRespaldo($id, $nombre , $descripcion, $precio_compra_float, $precio_venta_float, $categoria, $peso_int, $tipo_material, $cantidad_disponible_int, $ubicacion_almacen, $proveedor, 1, $dir_img);
                $producto->UpdateProducto($id, $nombre , $descripcion, $precio_compra_float, $precio_venta_float, $categoria, $peso_int, $tipo_material, $cantidad_disponible_int, $ubicacion_almacen, $proveedor, $dir_img);
            }else{
                $producto->SetRespaldo($id, $nombre , $descripcion, $precio_compra_float, $precio_venta_float, $categoria, $peso_int, $tipo_material, $cantidad_disponible_int, $ubicacion_almacen, $proveedor, 1);
                $producto->UpdateProducto($id, $nombre , $descripcion, $precio_compra_float, $precio_venta_float, $categoria, $peso_int, $tipo_material, $cantidad_disponible_int, $ubicacion_almacen, $proveedor);
            }
            header("location:./../../inventario/read.php");
        }
    } else {
        header("location:./../../inventario/read.php");
    }
 }
?>