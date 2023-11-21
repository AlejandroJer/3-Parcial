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
    $id = filter_var($_POST['id_producto'], FILTER_SANITIZE_NUMBER_INT);
    $result = $producto->GetProductoById($id);
    if(isset($result['imagen'])){
      $name_images = $producto->GetDirImgRespaldo();
      $dir_img = $producto->BorrarImg($id, $name_images);
      $producto->SetRespaldo($result['id_producto'], $result['nombre_producto'], $result['Descripcion_producto'], $result['precio_compra'], $result['precio_venta'], $result['id_categoria'],$result['peso'], $result['id_material'], $result['cantidad_disponible'], $result['ubicacion_almacen'], $result['id_proveedor'], 0, $dir_img);
      $producto->DeleteProducto($id);
    }else{
      $producto->SetRespaldo($result['id_producto'], $result['nombre_producto'], $result['Descripcion_producto'], $result['precio_compra'], $result['precio_venta'], $result['id_categoria'],$result['peso'], $result['id_material'], $result['cantidad_disponible'], $result['ubicacion_almacen'], $result['id_proveedor'], 0);
      $producto->DeleteProducto($id);
    }
    
    header("location:./../../inventario/read.php");
 } else {
    header("location:./../../inventario/read.php");
 }
}
?>