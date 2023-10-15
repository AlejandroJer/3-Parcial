<?php
namespace controladores;
require_once("./../../autoload.php");
use modelos\proveedores;
$proveedores = new proveedores();

$limit = 5;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['submit'])) {
        $index = ceil($proveedores->GetProveedoresIndex() / $limit);
        $results = $proveedores->GetProveedoresLimited(0, $limit);
        $_SESSION['results'] = $results;
        $_SESSION['index'] = $index;
        $_SESSION['pageClicked'] = 0;

        header("location:./../../proveedores/read.php");
    } 
    elseif (isset($_POST['submitPaginated'])) {
        $page = filter_var($_POST['submitPaginated'], FILTER_SANITIZE_NUMBER_INT);
        $index = ceil($proveedores->GetProveedoresIndex() / $limit);
        $results = $proveedores->GetProveedoresLimited($page * $limit, $limit);
        $_SESSION['results'] = $results;
        $_SESSION['index'] = $index;
        $_SESSION['pageClicked'] = $page;

        header("location:./../../proveedores/read.php");
    } 
}
?>
