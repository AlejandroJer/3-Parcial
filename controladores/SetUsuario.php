<?php
    namespace controladores;
    require_once("../autoload.php");
    use modelos\{usuarios, movimientos};
    $usuario = new usuarios();
    $movimiento = new movimientos();

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
        
        $usr_making_change = $_SESSION['logged_usr'];

        if($_FILES['image']['error'] == 0){
            $name_images_usr= $usuario->GetDirImg_usr();
            $img_usr = $usuario->InsertarImg_usr($name_images_usr, $user_name);
            $id = $usuario->Insertar($user_name, $user_lastname, $user_email,$user_tel, $sex, $hashed_password, $rol,$img_usr);
            $movimiento->SetMov('usuarios', $id, 0, 2, $usr_making_change);
            header("location:../empleados/read.php");
        }else{
            $id = $usuario->Insertar($user_name, $user_lastname, $user_email,$user_tel, $sex, $hashed_password, $rol);
            $movimiento->SetMov('usuarios', $id, 0, 2, $usr_making_change);
            header("location:../empleados/read.php");
        }

    }
?>