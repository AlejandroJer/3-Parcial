<?php
 namespace controladores;
    require_once("./../../autoload.php");
    use modelos\usuarios;
    $usuario = new usuarios();

    $limit = 5;

    if(!isset($_POST['submit'])){
        header("location:./../../empleados/read.php");
    } else {
        $index = $usuario->GetusuariosIndex();
        $index = ceil($index/$limit);

        $results = $usuario->GetusuariosLimited(0, $limit);
     
        $_SESSION['results'] = $results;
        $_SESSION['index'] = $index;
        $_SESSION['pageClicked'] = 0;
        header("location:./../../empleados/read.php");
    }

    if(!isset($_POST['submitPaginated'])){
        header("location:./../../empleados/read.php");
    } else {
        $page = filter_var($_POST['submitPaginated'], FILTER_SANITIZE_NUMBER_INT);

        $index = $usuario->GetusuariosIndex();
        $index = ceil($index/$limit);

        $results = $usuario->GetusuariosLimited($page*$limit, $limit);
     
        $_SESSION['results'] = $results;
        $_SESSION['index'] = $index;
        $_SESSION['pageClicked'] = $page;
        header("location:./../../empleados/read.php");
    }
?>
