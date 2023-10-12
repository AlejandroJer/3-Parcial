<?php
 namespace controladores;
    require_once("./../../autoload.php");
    use modelos\productos;
    $producto = new productos();

 if(!isset($_POST['search']) && !isset($_POST['submit'])){
   header("location:./../../inventario/search.php");
 } else {
    $keyword = filter_var($_POST['search'], FILTER_SANITIZE_STRING);

    if(!$_POST['search'] || $_POST['search'] == " "){
        header("location:./../../inventario/search.php");
        die();
    }

    $results = $producto->GetProductoByKeyWord($keyword);

    $_SESSION['results'] = $results;
    $_SESSION['keyword'] = $keyword;
    header("location:./../../inventario/search.php");
 }
?>