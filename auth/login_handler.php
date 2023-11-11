<?php
 namespace controladores;
 require_once("../autoload.php");
 use modelos\usuarios;
  $usuario = new usuarios();

 // Inicio de sesión
 if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['password'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $user_id = $usuario->IniciarSesion($email, $password);

  if ($user_id) {
    // Iniciar sesión exitosamente, redirigir a la página de inicio o al panel de control
    $_SESSION['logged_usr'] = $user_id;
    header("location: ./../dashboard.php");
    exit;
    // echo "<script>console.log('Inicio de sesión exitoso')</script>";
  } else {
    // Iniciar sesión fallida, redirigir a la página de inicio de sesión con un mensaje de error
    header('Location: ./login.php');
    exit;
    // echo "<script>console.log('Error al iniciar sesión')</script>";
  }
 } else {
   header('Location: ./login.php');
    exit;
    // echo "<script>console.log('Error al entrar al login')</script>";
 }
?>
