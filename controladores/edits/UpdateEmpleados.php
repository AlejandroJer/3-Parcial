<?php
 namespace controladores;
    require_once("./../../autoload.php");
    use modelos\usuarios;
    $empleado = new usuarios();

 if(isset($_POST['id'])){
    $result = $empleado->GetUsuarioById($_POST['id']);
    $_SESSION['empleados'] = $result;
    header("location:./../../empleados/update.php");
 }else{
    if(isset($_POST['submit'])){
        if(!isset($_POST['usuario-rol']) or !isset($_POST['usuario-nombre']) or !isset($_POST['usuario-apellido']) or !isset($_POST['sexo']) or !isset($_POST['usuario-email']) or !isset($_POST['telefono']) or !isset($_POST['usuario-password']) or !isset($_POST['admin-password'])){
            header("location:./../../empleados/add.php");
        } else {
            //in this section just add a variable which need a validation of the data type
            $id = filter_var($_POST['id_usuario'], FILTER_SANITIZE_NUMBER_INT);
            $usr_name = filter_var($_POST['usuario-nombre'], FILTER_SANITIZE_STRING);
            $usr_lastname = filter_var($_POST['usuario-apellido'], FILTER_SANITIZE_STRING);
            $usr_email = filter_var($_POST['usuario-email'], FILTER_SANITIZE_EMAIL);
            $usr_tel = filter_var($_POST['telefono'], FILTER_SANITIZE_NUMBER_INT);
            $usr_sex = filter_var($_POST['sexo'], FILTER_SANITIZE_STRING);
            $usr_perfil = filter_var($_POST['usuario-rol'], FILTER_SANITIZE_STRING);
            // get the usr password from the db
            $result_pass = $empleado->GetUsuarioPassWordById($id);
            $pass_saved_db = $result_pass['contraseña'];
            // get the admin passwords from the db
            $result_admin_pass = $empleado->GetUsuariosPassAdmin();
            $success = false;

            foreach($result_admin_pass as $admin_pass){
                if(password_verify($_POST['admin-password'], $admin_pass['contraseña'])){
                    $success = true;
                    break;
                }
            }

            if($success){
                if ($_POST['usuario-password'] == $pass_saved_db){
                    $pass_saved_db = $_POST['usuario-password'];
                    // echo "iguales";
                } else {
                    $pass_saved_db = password_hash($_POST['usuario-password'], PASSWORD_DEFAULT);
                    // echo "diferentes";
                }
                
                $empleado->SetRespaldo($id);
                $empleado->UpdateUsuario($id, $usr_name, $usr_lastname, $usr_email, $usr_tel, $usr_sex, $pass_saved_db, $usr_perfil);
                // echo "actualizado";
                header("location:./../../empleados/read.php");
            } else {            
                $result = $empleado->GetUsuarioById($id);
                $_SESSION['empleados'] = $result;
                header("location:./../../empleados/update.php");
                // echo "contraseña incorrecta";
                die();
            }
        }
    }
 }
?>