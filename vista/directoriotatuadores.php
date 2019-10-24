<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" href="<?= PROYECTO_RECURSOS_IMGS ?>icono-tooink.png"/>
        <title>Directorio Tatuadores</title>
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="<?= PROYECTO_RECURSOS_CSS ?>bootstrap.min.css">
        <link rel="stylesheet" href="<?= PROYECTO_RECURSOS_CSS ?>estilosTooink.css">

        <link rel="stylesheet" href="<?= PROYECTO_RECURSOS_CSS ?>globaltooink.css">
        <link href="<?= PROYECTO_RECURSOS_PLUGINS ?>bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
        <link href="<?= PROYECTO_RECURSOS_PLUGINS ?>sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
        <!-- animation CSS -->
        <link href="<?= PROYECTO_RECURSOS_CSS ?>animate.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?= PROYECTO_RECURSOS_CSS ?>style.css" rel="stylesheet">
        <!-- color CSS -->
        <link href="<?= PROYECTO_RECURSOS_CSS ?>colors/purple.css" id="theme" rel="stylesheet">
        <link rel="stylesheet" href="<?= PROYECTO_RECURSOS_CSS ?>directorio.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    </head>

    <body>

        <?php
        if (isset($_GET['i'])) {
            $intento = $_GET['i'];
        } else {
            $intento = 1;
        }
        ?>

        <div class="preloader">
            <div class="cssload-speeding-wheel"></div>
        </div>
        <!-- Navigation -->
        <nav id="header-cliente" class="navbar fixed-top col-xs-12 col-md-12 col-lg-12">
            <div> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
                <div class="navbar-brand">
                    <img class="logo-alt" src="<?= PROYECTO_RECURSOS_IMGS ?>img-tooink/logotipo-tooink-pos.png" alt="logo">
                </div>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li>
                        <a href="<?= CLIENTE_REGISTRO['url'] ?>">
                            <img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/text-documents.png">
                            <font class="font-nav">Registrarme</font>
                        </a>
                    </li>
                    <li>
                        <a href="<?= INICIAR_SESION['url'] ?>?i=<?php echo $intento; ?>">
                            <img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/user-negro.png">
                            <font class="font-nav">Iniciar Sesión</font>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container-fluid container-directorio">
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">

                        <?php
                        if (isset($_GET["r"])) {
                            $respuesta = $_GET["r"];
                            if ($respuesta == "1") {
                                echo '
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Bien hecho!</strong> Usuario registrado exitosamente.
                </div>';
                            } else if ($respuesta == "2") {
                                echo '
                <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Cuidado!</strong> Esta cuenta de correo ya esta registrada.
                </div>';
                            } else if ($respuesta == "3") {
                                echo '
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Lo sentimos!</strong> Hubo un error con el reCAPTCHA, por favor intentalo nuevamente.
                </div>';
                            } else if ($respuesta == "4") {
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

                        <div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div id="modalPrincipal">
                                        El contenido de esta pagina es para mayores de 18 años.
                                        <br><br>
                                        ¿Estas seguro de querer ver el contenido de la pagina?
                                    </div>

                                    <div class="modal-footer">
                                        <a href="<?= DESVIO['url'] ?>">
                                            <button type="button" class="btn btn-secondary">No quiero ver el contenido</button>
                                        </a>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Acepto</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form role="form" class="form-horizontal" action="<?= DIRECTORIO_TATUADORES['url'] ?>" method="POST">
                            <h3 class="box-title m-b-0">Buscar por:</h3>
                            <!--                                    <h3 id="h3" class="col-lg-2">Buscar por:</h3>-->
                            <center>
                                <div>
                                    <input type="radio" id="busquedaArtista" name="busqueda" value="nombre_artista">Artista 
                                    <label class="lb-busqueda"></label>
                                    <input type="radio" id="busquedaEstilo" name="busqueda" value="estilo_artista"> Estilo  
                                    <label class="lb-busqueda"></label>
                                    <input type="text" id="palabraBusqueda" name="palabraBusqueda" placeholder="Palabra Clave"/>
                                    <button id="btnBuscar" class="btn btn-primary" >Buscar</button>
                                </div>
                            </center>
                        </form>
                        <br>
                        <div class="container">
                            <center>
                                <div class="contenidoTatuadores">
                                    <?php
                                    if (!empty($lista)) {
                                        foreach ($lista as $consulta) {
                                            ?>
                                            <div class="tatuador">
                                                <a href="<?= PERFIL_TATUADOR['url'] ?>?id_usuario=<?php echo $consulta->id_usuario; ?>">
                                                    <div class="fotoPerfil">
                                                        <img src="<?php echo PROYECTO_RECURSOS_IMGS_USERS . $consulta->foto_perfil; ?>">
                                                    </div>
                                                    <div class="info-tatuador">
                                                        <center>
                                                            <h3> <?php echo $consulta->nombre . ' ' . $consulta->apellido; ?></h3>
                                                            <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $consulta->id_usuario; ?>"/>
                                                        </center>
                                                    </div>
                                                </a>
                                            </div>                                               
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="alert alert-warning alert-dismissable">
                                            No se encontrarón resultados por los criterios de busqueda.
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer id="footer"><p id="footerText" > &COPY; 2018 Tooink. Todos los derechos reservados. </p></footer>
        <!-- jQuery -->
        <script src="<?= PROYECTO_RECURSOS_JS ?>jquery.min.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="<?= PROYECTO_RECURSOS_JS ?>tether.min.js"></script>
        <script src="<?= PROYECTO_RECURSOS_JS ?>bootstrap.min.js"></script>
        <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>bootstrap-extension/js/bootstrap-extension.min.js"></script>
        <!-- Menu Plugin JavaScript -->
        <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>sidebar-nav/dist/sidebar-nav.min.js"></script>
        <!--slimscroll JavaScript -->
        <script src="<?= PROYECTO_RECURSOS_JS ?>jquery.slimscroll.js"></script>
        <!--Wave Effects -->
        <script src="<?= PROYECTO_RECURSOS_JS ?>waves.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="<?= PROYECTO_RECURSOS_JS ?>custom.min.js"></script>
        <!-- Sparkline chart JavaScript -->
        <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>jquery-sparkline/jquery.charts-sparkline.js"></script>
        <!--Style Switcher -->
        <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>styleswitcher/jQuery.style.switcher.js"></script>
        <script>
            $(document).ready(function () {

                $('#myModal').modal('show');
            });
        </script>
    </body>

</html>