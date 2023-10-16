<?php
 namespace controladores;
    require_once("./../../autoload.php");
    use modelos\usuarios;
    $usuario = new usuarios();

    $limit = 2;
 if(!isset($_POST['search']) && !isset($_POST['submit'])){
   header("location:./../../empleados/search.php");
 } else {
    $keyword = filter_var($_POST['search'], FILTER_SANITIZE_STRING);

    if(!$_POST['search'] || $_POST['search'] == " "){
        header("location:./../../empleados/search.php");
        die();
    }

    $index = $usuario->GetUsuarioByKeywordIndex($keyword);
    $index = ceil($index/$limit);
    $results = $usuario->GetUsuarioByKeywordLimited($keyword, 0, $limit);

    $_SESSION['results'] = $results;
    $_SESSION['keyword'] = $keyword;
    $_SESSION['index'] = $index;
    $_SESSION['pageClicked'] = 0;
    header("location:./../../empleados/search.php");
}

if (!isset($_POST['submitPaginated'])) {
    header("location:./../../empleados/search.php");
} else {
    $keyword = filter_var($_POST['searchPaginated'], FILTER_SANITIZE_STRING);
    $page = filter_var($_POST['submitPaginated'], FILTER_SANITIZE_NUMBER_INT);

    $index = $usuario->GetUsuarioByKeywordIndex($keyword);
    $index = ceil($index / $limit);
    $results = $usuario->GetUsuarioByKeywordLimited($keyword, $page * $limit, $limit);

    $_SESSION['results'] = $results;
    $_SESSION['keyword'] = $keyword;
    $_SESSION['index'] = $index;
    $_SESSION['pageClicked'] = $page;
    header("location:./../../empleados/search.php");
}
 ?>