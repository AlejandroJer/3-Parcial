<?php
 namespace controladores;
    require_once("./../../autoload.php");
    use modelos\productos;
    $producto = new productos();

 if(isset($_POST['id'])){
  $result = $producto->GetProductoById($_POST['id']);
  $_SESSION['producto'] = $result;
  header("location:./../../inventario/delete.php");
}else{
  if(isset($_POST['submit'])){
    $result = $producto->GetProductoById($_POST['id']);
    if(isset($result['imagen'])){
    $name_images = $producto->GetDirImgRespaldo();
    $dir_img = $producto->BorrarImg($_POST['id'], $name_images);
    $producto->DeleteProducto($_POST['id']);
    $producto->SetRespaldo($result['nombre_producto'], $result['Descripcion_producto'], $result['precio_compra'], $result['precio_venta'], $result['categoria'],$result['peso'], $result['tipo_material'], $result['cantidad_disponible'], $result['ubicacion_almacen'], $result['id_proveedor'], $dir_img);
    }else{
      $producto->DeleteProducto($_POST['id']);
      $producto->SetRespaldo($result['nombre_producto'], $result['Descripcion_producto'], $result['precio_compra'], $result['precio_venta'], $result['categoria'],$result['peso'], $result['tipo_material'], $result['cantidad_disponible'], $result['ubicacion_almacen'], $result['id_proveedor']);
    }
    
    header("location:./../../inventario/read.php");
 } else {
    header("location:./../../inventario/read.php");
 }
}
?>