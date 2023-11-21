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
    $usr_making_change = $_SESSION['logged_usr'];
    $empleado->SetRespaldo($result['id_usr'], $result['nombre_usr'], $result['contraseña'], $result['apellido_usr'], $result['email_usr'], $result['tel'], $result['sexo'], $result['id_perfil'], 0, $usr_making_change);
    $empleado->DeleteUsuario($result['id_usr']);
    
    header("location:./../../empleados/read.php");
 } else {
    header("location:./../../empleados/read.php");
 }
}
?>