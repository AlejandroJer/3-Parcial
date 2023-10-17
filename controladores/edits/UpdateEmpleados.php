<?php
 namespace controladores;
    require_once("./../../autoload.php");
    use modelos\usuarios;
    $empleado = new usuarios();

 if(isset($_POST['id'])){
    $result = $empleado->GetUsuarioById($_POST['id']);
    $_SESSION['empleados'] = $result;
    header("location:./../../empleados/add.php");
 }else{
    if(isset($_POST['submit'])){
        if(!isset($_POST['usuario-rol']) or !isset($_POST['usuario-nombre']) or !isset($_POST['usuario-apellido']) or !isset($_POST['sexo']) or !isset($_POST['usuario-password'])){
            header("location:./../../empleados/add.php");
        } else {
            //in this section just add a variable which need a validation of the data type
            $id_str = $_POST['id_usr'];
            $id = intval($id_str);

            $usr_perfil_str = $_POST['usuario-rol'];
            $usr_perfil = intval($usr_perfil_str);

            $usr_current_password_requested = $empleado->GetUsuarioPassWordById($id);
            $usr_current_password = $usr_current_password_requested['contraseña'];
            $usr_password = $_POST['usuario-password'];
            $usr_password_hashed = password_hash($usr_password, PASSWORD_DEFAULT);

            if(password_verify($usr_password, $usr_current_password)){
                $usr_current_password = $usr_password;

                $empleado->UpdateUsuario($id, $_POST['usuario-nombre'], $_POST['usuario-apellido'], $_POST['usuario-email'], $_POST['sexo'], $usr_current_password, $usr_perfil);
            } else {            
                $result = $empleado->GetUsuarioById($id);
                $_SESSION['empleados'] = $result;
                header("location:./../../empleados/add.php");
                // echo $usr_password_hashed . '<br>';
                // echo $usr_current_password;
                die();
            }
            
            header("location:./../../empleados/read.php");
            // echo "Usuario actualizado";
        }
    }
 }
?>