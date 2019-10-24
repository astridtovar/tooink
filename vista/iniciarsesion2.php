<!DOCTYPE html>
<html>
    <head>
        <title>Tooink - Iniciar Sesión</title>
        <meta charset="utf-8">
        <link rel="icon" type="image/png" href="<?= PROYECTO_RECURSOS_IMGS ?>icono-tooink.png"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?= PROYECTO_RECURSOS_CSS ?>bootstrap.min.css">
        <link rel="stylesheet" href="<?= PROYECTO_RECURSOS_CSS ?>loginstyle.css">
        <script src="<?= PROYECTO_RECURSOS_JS ?>jquery.min.js"></script>
        <script src="<?= PROYECTO_RECURSOS_JS ?>bootstrap.min.js"></script>
    </head>
    <body>

        <?php
        if (isset($_GET["i"])) {
            $intento = $_GET['i'];
        }
        
        if (isset($_GET["r"])) {
            $respuesta = $_GET["r"];
            if ($respuesta == "4") {
                echo '
                <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Cuidado!</strong> Usuario y/o contraseña incorrectos, si esto se repite tu cuenta sera bloqueada.
                </div>';
            } else if ($respuesta == "5") {
                echo '
                <div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    Su cuenta ha sido bloqueada temporalmente, para desbloquearla por favor comuniquese con el administrador.
                </div>';
            } else if ($respuesta == "6") {
                echo '
                <div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    Su cuenta se encuentra temporalmente bloqueada, para desbloquearla por favor comuniquese con el administrador.
                </div>';
            } else {
                echo '
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    Usuario y/o contraseña incorrectos, por favor intentalo nuevamente.
                </div>';
            }
        }
        ?>

        <div class="contenedor-login">
            <form action="<?= USUARIO_AUTENTICAR['url'] ?>" method="POST" class="form-horizontal" role="form">
                <br>
                <input type="hidden" name="intento" value="<?php echo $intento; ?>" />
                <center>
                    <div>
                        <img src="<?= PROYECTO ?>./vista/imgs/img-tooink/logotipo-descriptivo.png">
                        <br>
                        <h3 class="form-signin-heading">Iniciar sesión</h3>
                    </div>
                </center>
                <center>
                    <div class="correo col-lg-12 col-md-12 col-xs-12">
                        <div class="label-correo">
                            <label for="usu_correo">Correo:</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-xs-10">
                            <input type="email" id="usu_correo" name="usu_correo" class="form-control txt-correo" placeholder="ejemplo@email.com" required>
                        </div>
                    </div>
                    <br><br>
                    <div class="clave col-lg-12 col-md-12 col-xs-12">
                        <div class="label-clave">
                            <label for="usu_clave">Clave:</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-xs-10">
                            <input type="password" id="usu_clave" name="usu_clave" class="form-control txt-clave" placeholder="********" required>
                        </div>
                    </div>
                    <br><br>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="usu_recordarme" name="usu_recordarme" value="Recordarme"> Recordarme 
                        </label>
                    </div>
                    <br>
                    <div>
                        <a href="<?= DIRECTORIO_TATUADORES['url'] ?>">
                            <button class="btn btn-secondary" type="button">Volver al directorio</button>
                        </a>
                        <button class="btn btn-ingresar" type="submit">Ingresar</button>
                    </div>
                    <br>
                    <a class="text-info" href="<?= REESTABLECER_CLAVE_INDEX['url'] ?>">Olvide mi contraseña</a>
                    <br>
                </center>
                <br>
            </form>
        </div>

        <footer id="footer" class="footer">
            <div class="container">
                <p id="footerText" >&COPY; 2018 Tooink. Todos los derechos reservados.</p>
            </div>
        </footer>
    </body>
</html>
