<?php

namespace controladores;
require_once("../autoload.php");


// Registro de usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registro'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $sexo = $_POST['sexo'];
    $password = $_POST['password'];
    $id_rol = 1; //rol 

    $usuario = new modelos\usuarios();
    $usuario->RegistrarUsuario($nombre, $apellido, $email, $sexo, $password, $id_rol);

    
    header('Location: login.php');
    exit;
}

// Inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $usuario = new modelos\usuarios();
    $user_id = $usuario->IniciarSesion($email, $password);

    if ($user_id) {
        // Iniciar sesión exitosamente, redirigir a la página de inicio o al panel de control
        session_start();
        $_SESSION['user_id'] = $user_id;
        header('Location: dashboard.php');
        exit;
    } else {
       
        echo 'Credenciales inválidas. Inténtalo de nuevo.';
    }
}
?>
