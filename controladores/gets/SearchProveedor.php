<?php
 namespace controladores;
 require_once("./../../autoload.php");
 use modelos\proveedores; 
  $proveedor = new proveedores();

 if (!isset($_POST['search']) && !isset($_POST['submit'])) {
  header("location:./../../proveedores/search.php");
 } else {
   $keyword = filter_var($_POST['search'], FILTER_SANITIZE_STRING);
   if (isset($_POST['limit'])){
     $limit = filter_var($_POST['limit'], FILTER_SANITIZE_NUMBER_INT);
    } else {
     $limit = 7;
   }
   
  if (isset($_POST['submitPaginated'])){
     $page = filter_var($_POST['submitPaginated'], FILTER_SANITIZE_NUMBER_INT);
    } else {
     $page = 0;
  }

  $index = $proveedor->GetProveedorByKeywordIndex($keyword); 
  $index = ceil($index / $limit);
  $results = $proveedor->GetProveedorByKeywordLimited($keyword, $page*$limit, $limit);

  $array = array(
        "results" => $results,
        "index" => $index,
        "pageClicked" => $page
    );

  echo json_encode($array);
 }
?>
