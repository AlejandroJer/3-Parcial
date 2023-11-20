<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión </title>
  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../sources/css/login.css">
</head>
<body class="bg-secondary">
    <div class="container bg-light" id="container">
        <form action="./login_handler.php" method="POST">
            <div class="form-container sign-in-container">
                <div id="form">
                    <h1>Iniciar Sesión</h1>
                    <span> Usa la contraseña proporcionada por el administrador</span>
                    <div class="infield">
                        <input type="email" placeholder="Email" name="email" required>
                        <label class="label"></label>
                    </div>
                    <div class="infield">
                        <input type="password" placeholder="Contraseña" name="password" required>
                        <label class="label"></label>
                    </div>
                    <button type="submit" name="submit" id="submit">Iniciar Sesión</button>
                </div>
            </div>
            <div class="overlay-container" id="overlayCon">
                <div class="overlay bg-primary">
                    <div class="overlay-panel overlay-left">
                        <h1>¡Bienvenid@!</h1>
                        <p>Inicia sesión con tus datos personales</p>
                        <button>Iniciar Sesión</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>¡Hola!</h1>
                        <p>
                            Te sugerimos leer los
                            <a href="..\TerminosDeServicioJEMAS.pdf" target="_blank">Términos de Servicio</a>, así como la
                            <a href="..\PrivacidadYCondicionesJEMAS.pdf" target="_blank">Política de Privacidad y Condiciones de uso</a>
                            con atencion para que estes enterado de como se manejan tus datos personales.
                        </p>
                        <div class="d-flex">
                            <input class="form-check-input p-0" type="checkbox" name="" id="" required>
                            <label class="form-check-label my-0 ms-1">Acepto los términos y condiciones</label>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
