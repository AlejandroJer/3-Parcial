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
    $result = $empleado->GetUsuarioById($_POST['id_usuario']);
    $empleado->DeleteUsuario($_POST['id_usuario']);
    $empleado->SetRespaldo($result['nombre_usr'], $result['apellido_usr'], $result['email_usr'], $result['tel'], $result['sexo'], $result['contraseña'], $result['id_perfil']);
    
    header("location:./../../empleados/read.php");
 } else {
    header("location:./../../empleados/read.php");
 }
}
?>