<?php
 namespace controladores;
    require_once("./../../autoload.php");
    use modelos\productos;
    $producto = new productos();
 if(!isset($_POST['search']) && !isset($_POST['submit'])){
   header("location:./../../inventario/search.php");
 } else {
    $keyword = filter_var($_POST['search'], FILTER_SANITIZE_STRING);
    $results = $producto->GetProductoByKeyWord($keyword);

    $_SESSION['results'] = $results;
    header("location:./../../inventario/search.php");
 }

//  header("location:./../../dashboard.php");
?>