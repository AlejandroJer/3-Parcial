<?php
    namespace controladores;
    require_once("../autoload.php");
    use modelos\usuarios;
    $usuario = new usuarios();
    if(!isset($_POST['usuario-nombre']) or !isset($_POST['usuario-apellido']) or !isset($_POST['usuario-email']) or !isset($_POST['telefono']) or !isset($_POST['usuario-password']) or !isset($_POST['usuario-rol'])){
        header("location:../empleados/add.php");
    } else {
        $user_name = filter_var($_POST['usuario-nombre'], FILTER_SANITIZE_STRING);
        $user_lastname = filter_var($_POST['usuario-apellido'], FILTER_SANITIZE_STRING);
        $user_email = filter_var($_POST['usuario-email'], FILTER_SANITIZE_EMAIL);
        $user_tel = filter_var($_POST['telefono'], FILTER_SANITIZE_NUMBER_INT);
        $sex = filter_var($_POST['sexo'], FILTER_SANITIZE_STRING);
        $hashed_password = password_hash($_POST['usuario-password'], PASSWORD_DEFAULT);
        $rol = filter_var($_POST['usuario-rol'], FILTER_SANITIZE_STRING);

        $usuario->Insertar($user_name, $user_lastname, $user_email, $user_tel, $sex, $hashed_password, $rol);
        header("location:../empleados/read.php");
    }
?>