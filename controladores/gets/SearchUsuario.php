<?php
 namespace controladores;
    require_once("./../../autoload.php");
    use modelos\usuarios;
    $usuario = new usuarios();

 if(!isset($_POST['search']) && !isset($_POST['submit'])){
   header("location:./../../empleados/search.php");
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

    $index = $usuario->GetUsuarioByKeywordIndex($keyword);
    $index = ceil($index/$limit);
    $results = $usuario->GetUsuarioByKeywordLimited($keyword, $page*$limit, $limit);

    $_SESSION['results'] = $results;
    $_SESSION['keyword'] = $keyword;
    $_SESSION['index'] = $index;
    $_SESSION['pageClicked'] = 0;

    $array = array(
        "results" => $results,
        "index" => $index,
        "pageClicked" => $page
    );

    echo json_encode($array);
}
 ?>