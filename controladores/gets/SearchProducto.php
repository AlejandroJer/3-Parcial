<?php
 namespace controladores;
    require_once("./../../autoload.php");
    use modelos\{productos, proveedores};
    $producto = new productos();
      $proveedores = new proveedores();

    $limit = 7;

 // SEARCH BY KEYWORD
 if(!isset($_POST['search']) && !isset($_POST['submit'])){
   header("location:./../../inventario/read.php");
 } else {
      $keyword = filter_var($_POST['search'], FILTER_SANITIZE_STRING);
      if (isset($_POST['submitPaginated'])){
        $page = filter_var($_POST['submitPaginated'], FILTER_SANITIZE_NUMBER_INT);
       } else {
        $page = 0;
      }

      $index = $producto->GetProductoByKeyWordIndex($keyword);
      $index = ceil($index/$limit);
      $results = $producto->GetProductoByKeyWordLimited($keyword, $page*$limit, $limit);

      foreach ($results as &$result){
        $result['id_proveedor'] = $proveedores->GetNombreEmpresaById($result['id_proveedor']);
      }
      unset($result);

      $array = array(
            "results" => $results,
            "index" => $index,
            "pageClicked" => $page
         );

      echo json_encode($array);
 }
?>