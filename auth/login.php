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
        <!-- <div class="form-container sign-up-container">
            <form action="#">
                <h1>Crear tu cuenta</h1>

                <span>o usa tu email para registrarte</span>
                <div class="infield">
                    <input type="text" placeholder="Nombre" />
                    <label></label>
                </div>

                <div class="infield">
                    <input type="text" placeholder="Apellido" />
                    <label></label>

                </div>
                <div class="infield">
                    <input type="email" placeholder="Email" name="email"/>
                    <label></label>
                </div>
                <div class="infield">
                    <input type="password" placeholder="Contraseña" />
                    <label></label>
                </div>
                <div class="infield">
                    <input type="sexo" placeholder="Sexo" />
                    <label></label>
                </div>
                <button>Registrarse</button>
            </form>
        </div> -->
        <div class="form-container sign-in-container">
            <form action="./login_handler.php" method="POST">
                <h1>Iniciar Sesión</h1>
                <!-- <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div> -->
                <span> Usa la contraseña proporcionada por el administrador</span>
                <div class="infield">
                    <input type="email" placeholder="Email" name="email"/>
                    <label></label>
                </div>
                <div class="infield">
                    <input type="password" placeholder="Contraseña" name="password" />
                    <label></label>
                </div>
                <!-- <a href="#" class="forgot">¿Olvistaste tu contraseña?</a> -->
                <button type="submit" name="submit" id="submit">Iniciar Sesión</button>
            </form>
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
                    <p>Al continuar, aceptas nuestros <a href="..\TerminosDeServicioJEMAS.pdf" download="TerminosDeServicioJEMAS.pdf">Términos de Servicio</a>, Política de <a href="..\PrivacidadYCondicionesJEMAS.pdf" download="PrivacidadYCondicionesJEMAS.pdf">Privacidad y Condiciones</a> de Uso. Te invitamos a leerlos detenidamente antes de proceder</p>
                    <!-- <button>Registrarse</button> -->
                </div>
            </div>
            <!-- <button id="overlayBtn"></button> -->
        </div>
    </div>

  
    
    <!-- JS -->
    <!-- <script>
       const container = document.getElementById('container');
       const overlayCon = document.getElementById('overlayCon');
       const overlayBtn = document.getElementById('overlayBtn');

        overlayBtn.addEventListener('click', ()=> {
            container.classList.toggle('right-panel-active');

            overlayBtn.classList.remove('btnScaled');
            window.requestAnimationFrame(()=> {
                overlayBtn.classList.add('btnScaled');
            })
        });
    </script> -->

</body>
</html>
