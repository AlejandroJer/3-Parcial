<?php
    namespace controladores;
    require_once("../autoload.php");
    use modelos\productos;
    $producto = new productos();
    if(!isset($_POST['producto-nombre']) or !isset($_POST['producto-proveedor']) or !isset($_POST['producto-precio-venta']) or !isset($_POST['producto-precio-compra']) or !isset($_POST['categoria']) or !isset($_POST['tipo-material']) or !isset($_POST['peso']) or !isset($_POST['cantidad-disponible']) or !isset($_POST['ubicacion-almacen']) or !isset($_POST['producto-descripcion'])){
        header("location:../inventario/add.php");
    } else {
        $nombre = filter_var($_POST['producto-nombre'], FILTER_SANITIZE_STRING);
        $descripcion = filter_var($_POST['producto-descripcion'], FILTER_SANITIZE_STRING);
        $precio_compra_float = floatval($_POST['producto-precio-compra']);
        $precio_venta_float = floatval($_POST['producto-precio-venta']);
        $categoria = filter_var($_POST['categoria'], FILTER_SANITIZE_NUMBER_INT);
        $peso_int = floatval($_POST['peso']);
        $tipo_material = filter_var($_POST['tipo-material'], FILTER_SANITIZE_NUMBER_INT);
        $cantidad_disponible_int = intval($_POST['cantidad-disponible']);
        $ubicacion_almacen = filter_var($_POST['ubicacion-almacen'], FILTER_SANITIZE_NUMBER_INT);
        $proveedor = filter_var($_POST['producto-proveedor'], FILTER_SANITIZE_NUMBER_INT);
        
        if($_FILES['image']['error'] == 0){
            $name_images= $producto->GetDirImg();
            $dir_img = $producto->InsertarImg($name_images, $nombre);
            $producto->Insertar($nombre, $descripcion, $precio_compra_float, $precio_venta_float, $categoria, $peso_int, $tipo_material, $cantidad_disponible_int, $ubicacion_almacen, $proveedor, $dir_img);
            header("location:../inventario/read.php");
        }else{
            $producto->Insertar($nombre, $descripcion, $precio_compra_float, $precio_venta_float, $categoria, $peso_int, $tipo_material, $cantidad_disponible_int, $ubicacion_almacen, $proveedor);
            header("location:../inventario/read.php");
        }
    }
?>