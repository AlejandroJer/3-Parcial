<?php
 namespace controladores;
    require_once("./../../autoload.php");
    use modelos\productos;
    $producto = new productos();

    $limit = 5;
 if(!isset($_POST['submit'])){
      header("location:./../../inventario/read.php");
   } else {
      $index = $producto->GetproductosIndex();
      $index = ceil($index/$limit);

      $results = $producto->GetproductosLimited(0, $limit);
   
      $_SESSION['results'] = $results;
      $_SESSION['index'] = $index;
      $_SESSION['pageClicked'] = 0;
      header("location:./../../inventario/read.php");
 }

 if(!isset($_POST['submitPaginated'])){
    header("location:./../../inventario/read.php");
 } else {
    $page = filter_var($_POST['submitPaginated'], FILTER_SANITIZE_NUMBER_INT);

    $index = $producto->GetproductosIndex();
    $index = ceil($index/$limit);

    $results = $producto->GetproductosLimited($page*$limit, $limit);
 
    $_SESSION['results'] = $results;
    $_SESSION['index'] = $index;
    $_SESSION['pageClicked'] = $page;
    header("location:./../../inventario/read.php");
 }
?>