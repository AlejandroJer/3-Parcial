<?php
 namespace controladores;
    require_once("./../../autoload.php");
    use modelos\usuarios;
    $empleado = new usuarios();

 if(isset($_POST['id'])){
  $result = $empleado->GetUsuarioById($_POST['id']);
  $_SESSION['empleados'] = $result;
  header("location:./../../empleados/delete.php");
}else{
  if(isset($_POST['submit'])){
    $id = filter_var($_POST['id_usuario'], FILTER_SANITIZE_NUMBER_INT);
    $result = $empleado->GetUsuarioById($id);
    $empleado->SetRespaldo($result['id_usr']);
    $empleado->DeleteUsuario($result['id_usr']);
    
    header("location:./../../empleados/read.php");
 } else {
    header("location:./../../empleados/read.php");
 }
}
?>