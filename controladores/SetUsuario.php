<?php
    namespace controladores;
    require_once("../autoload.php");
    use modelos\usuarios;
    $usuario = new usuarios();
    if(!isset($_POST['usuario-nombre']) or !isset($_POST['usuario-apellido']) or !isset($_POST['usuario-email']) or !isset($_POST['usuario-password']) or !isset($_POST['usuario-rol'])){
        header("location:../empleados/add.php");
    } else {
        $user_name = filter_var($_POST['usuario-nombre'], FILTER_SANITIZE_STRING);
        $user_lastname = filter_var($_POST['usuario-apellido'], FILTER_SANITIZE_STRING);
        $user_email = filter_var($_POST['usuario-email'], FILTER_SANITIZE_EMAIL);
        $user_password = filter_var($_POST['usuario-password'], FILTER_SANITIZE_STRING);
        $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

        $usuario->Insertar($user_name, $user_lastname, $user_email, $hashed_password, $_POST['usuario-rol']);
        header("location:../empleados/read.html");
    }
?>