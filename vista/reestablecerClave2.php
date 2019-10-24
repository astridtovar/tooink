<!DOCTYPE html>
<html>
    <head>
        <title>Reestablecer Clave</title>
        <meta charset="utf-8">
        <link rel="icon" type="image/png" href="<?= PROYECTO_RECURSOS_IMGS ?>icono-tooink.png"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?= PROYECTO_RECURSOS_CSS ?>bootstrap.min.css">
        <link rel="stylesheet" href="<?= PROYECTO_RECURSOS_CSS ?>loginstyle.css">
        <script src="<?= PROYECTO_RECURSOS_JS ?>jquery.min.js"></script>
        <script src="<?= PROYECTO_RECURSOS_JS ?>popper.min.js"></script>
        <script src="<?= PROYECTO_RECURSOS_JS ?>bootstrap.min.js"></script>
        <script src="<?= PROYECTO_RECURSOS_JS ?>bootstrap.js"></script>
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
    </head>
    <body>
        
        <?php
        if (isset($_GET["r"])) {
            $respuesta = $_GET["r"];
            if ($respuesta == "1") {
                echo '
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Bien hecho!</strong> Hemos enviado un mensaje al correo electronico ingresado con una nueva
                    contraseña la cual debes cambiar al iniciar sesión nuevamente..
                </div>';
            } else {
                echo '
                <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Cuidado!</strong> El correo  ingresado no se encuentra registrado en el sistema.
                </div>';
            }
        }
        ?>

        <div class="contenedor-login">
            <form action="<?= REESTABLECER_CLAVE['url'] ?>" method="POST" class="form-horizontal" role="form">
                <center>
                    <div>
                        <img src="<?= PROYECTO ?>./vista/imgs/img-tooink/logotipo-descriptivo.png">
                        <br>
                        <h3 class="form-signin-heading">Reestablecer Contraseña</h3>
                    </div>
                    <br>
                    <h5>Por favor ingresa el correo electronico con el que estas registrado en el sistema.</h5>
                    <div class="form-restablecer col-lg-12 col-md-12 col-xs-12">
                        <div class="col-lg-10 col-md-10 col-xs-10">
                            <input type="email" id="correo" name="correo" class="form-control txt-correo" required placeholder="correo@ejemplo.com"/>
                        </div>
                        <div class="col-lg-2 col-md-2 col-xs-2">
                            <button type="button" class="btn" data-toggle="tooltip" data-placement="top"
                                    title="Validaremos que el correo ingresado este registrado en el sistema y enviaremos una nueva contraseña de ingreso.">
                                <img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/round-help-button.png"/>
                            </button>
                        </div>
                    </div>
                    <br>
                    <h5>Te enviaremos una contraseña nueva la cual debes cambiar nuevamente cuando ingreses al sistema.</h5>
                    <div>
                        <a href="<?= DIRECTORIO_TATUADORES['url'] ?>">
                            <button class="btn btn-secondary" type="button" title="Cancelar">Volver al directorio</button>
                        </a>
                        <button id="btnCambiarClave" class="btn btn-ingresar" type="submit" title="Enviar">Enviar</button>
                    </div>
                    <br>
                    <a class="text-info" href="<?= INICIAR_SESION['url'] ?>">Volver a iniciar sesión</a>
                    <br>
                </center>
            </form>
        </div>

        <footer id="footer" class="footer">
            <div class="container">
                <p id="footerText" >&COPY; 2018 Tooink. Todos los derechos reservados.</p>
            </div>
        </footer>

    </body>
</html>