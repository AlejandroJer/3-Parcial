<?php
    namespace controladores;
    require_once("../autoload.php");
    use modelos\usuarios;
    $usuario = new usuarios();
    if(!isset($_POST['usuario-nombre']) or !isset($_POST['usuario-apellido']) or !isset($_POST['usuario-email']) or !isset($_POST['usuario-password']) or !isset($_POST['usuario-rol'])){
        header("location:../empleados/add.php");
    } else {
        $user_name = $_POST['usuario-nombre'];
        $user_lastname = $_POST['usuario-apellido'];
        $user_email = filter_var($_POST['usuario-email'], FILTER_SANITIZE_EMAIL);
        $sex = $_POST['sexo'];
        $hashed_password = password_hash($_POST['usuario-password'], PASSWORD_DEFAULT);

        $usuario->Insertar($user_name, $user_lastname, $user_email, $sex, $hashed_password, $_POST['usuario-rol']);
        header("location:../empleados/read.php");
    }
?>