<?php
 namespace controladores;
    require_once("./../../autoload.php");
    use modelos\productos;
    $producto = new productos();

    $limit = 2;

// SEARCH BY KEYWORD
 if(!isset($_POST['search']) && !isset($_POST['submit'])){
   header("location:./../../inventario/search.php");
 } else {
    $keyword = filter_var($_POST['search'], FILTER_SANITIZE_STRING);

    if(!$_POST['search'] || $_POST['search'] == " "){
        header("location:./../../inventario/search.php");
        die();
    }

    $index = $producto->GetProductoByKeyWordIndex($keyword);
    $index = ceil($index/$limit);
    $results = $producto->GetProductoByKeyWordLimited($keyword, 0, $limit);

    $_SESSION['results'] = $results;
    $_SESSION['keyword'] = $keyword;
    $_SESSION['index'] = $index;
    $_SESSION['pageClicked'] = 0;
    header("location:./../../inventario/search.php");
 }

// MOVE THROUGHT PAGES IN THE SEARCH BY KEYWORD
 if(!isset($_POST['submitPaginated'])){
      header("location:./../../inventario/search.php");
   } else {
      $keyword = filter_var($_POST['searchPaginated'], FILTER_SANITIZE_STRING);
      $page = filter_var($_POST['submitPaginated'], FILTER_SANITIZE_NUMBER_INT);
   
      $index = $producto->GetProductoByKeyWordIndex($keyword);
      $index = ceil($index/$limit);
      $results = $producto->GetProductoByKeyWordLimited($keyword, $page*$limit, $limit);
   
      $_SESSION['results'] = $results;
      $_SESSION['keyword'] = $keyword;
      $_SESSION['index'] = $index;
      $_SESSION['pageClicked'] = $page;
      header("location:./../../inventario/search.php");
 }
?>