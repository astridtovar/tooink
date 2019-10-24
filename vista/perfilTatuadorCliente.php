<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Tooink - Agenda de Tatuadores</title>
        <meta charset="utf-8">
        <link rel="icon" type="image/png" href="<?= PROYECTO_RECURSOS_IMGS ?>icono-tooink.png"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?= PROYECTO_RECURSOS_CSS ?>bootstrap.min.css">
        <link rel="stylesheet" href="<?= PROYECTO_RECURSOS_CSS ?>estilosTooink.css">
        <script src="<?= PROYECTO_RECURSOS_JS ?>jquery.min.js"></script>
        <script src="<?= PROYECTO_RECURSOS_JS ?>bootstrap.min.js"></script>
        <script>
            $(document).ready(function () {

                $('#myModal').modal('show')
            });
        </script>

    </head>
    <body>

        <nav id="headerCliente" class="navbar navbar-default">
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li id="logotipo" class="col-xs-4 col-md-4 col-lg-4"><img src="<?= PROYECTO_RECURSOS_IMGS ?>tooink-logo-marca.png" width="30%" height="auto"></li>
                    <li class="col-xs-4 col-md-4 col-lg-4"></li>
                    <li id="text-nav" class="col-xs-2 col-md-2 col-lg-2" class="active"><a href="<?= DIRECTORIO_TATUADORES['url'] ?>"><img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/home-button-1.png" width="20%" height="auto"><font color="black"> Inicio</font></a></li>
                    <li id="text-nav" class="col-xs-2 col-md-2 col-lg-2" class="active"><a href="<?= INICIAR_SESION['url'] ?>" data-toggle="modal" data-target="#miModal"><img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/user-negro.png" width="20%" height="auto"><font color="black"> Iniciar Sesión</font></a></li>
                </ul>
            </div>
        </nav>

        <?php
        if (isset($_GET["r"])) {
            $respuesta = $_GET["r"];
            if ($respuesta == "1") {
                echo '
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    Reserva solicitada exitosamente.
                </div>';
            } else if ($respuesta == "0") {
                echo '
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    Por favor inicia sesión para reservar una cita con este tatuador.
                </div>';
            } else if ($respuesta == "2") {
                echo '
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    No se permite votar por la misma imagen más de una vez.
                </div>';
            } else if ($respuesta == "3") {
                echo '
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    Por favor inicia sesión para votar por esta imagen.
                </div>';
            }
        }
        ?>

        <div class="container">
            <?php
            $id_usuario = $_GET['id_usuario'];
            foreach ($lista as $consulta) {
                ?>

                <div id="fotoPerfil" class="container col-xs-2 col-md-2 col-lg-2">
                    <img src="<?php echo PROYECTO_RECURSOS_IMGS_USERS . $consulta->foto_perfil; ?>" width="80%" height="auto">
                </div>

                <div id="nombre-apellido" class="container col-xs-3 col-md-3 col-lg-3">
                    <h3><?php echo $consulta->nombre . ' ' . $consulta->apellido . ' / ' . $consulta->nombre_artistico; ?></h3>
                </div>
                <?php
            }
            ?>

            <div id="contacto" class="container col-xs-3 col-md-3 col-lg-3">

                <h4>Contáctalo:
                    <?php
                    $id_usuario = $_GET['id_usuario'];
                    foreach ($listaContacto as $consulta) {
                        ?>
                        <h5><?php echo $consulta->descripcion_contacto; ?></h5>
                    <?php } ?>
                </h4>
                <br>
            </div>

            <div id="estilo" class="container col-xs-3 col-md-3 col-lg-3">
                <h4>Estilos y experiencia:
                    <?php
                    $id_usuario = $_GET['id_usuario'];
                    foreach ($listaEstilo as $consulta) {
                        ?>
                        <h5><?php echo $consulta->descripcion; ?>: <?php echo $consulta->anos_experiencia; ?> años</h5>
                    <?php } ?>
                </h4>
            </div>

            <div id="btnReservar" class="container col-xs-1 col-md-1 col-lg-1">
                <a href="<?= CLIENTE_RESERVAR_CITA['url'] ?> ?id_tatuador=<?= $id_usuario; ?>">
                    <input type="button" id="btnResevarCita" name="btnResevarCita" value="Reservar cita"/>
                </a>
            </div>

            <div id="trabajosArtista" class="container col-xs-12 col-md-12 col-lg-12">
                <h4>Trabajos del artista</h4>
            </div>

            <div class="container col-xs-9 col-md-9 col-lg-9">

                <?php
                $id_usuario = $_GET['id_usuario'];
                foreach ($listaTrabajo as $consulta) {
                    ?>
                    <div class="trabajoTatuador col-xs-3 col-md-3 col-lg-3">
                        <input type="hidden" id="id_imagen" name="id_imagen" value="<?= $consulta->id_imagen; ?>"/>
                        <img class="imgTrabajoTatuador" src="<?php echo PROYECTO_RECURSOS_IMGS_USERS . $consulta->imagen; ?>">
                        <br><br>
                        <center>
                            <a href="<?= CLIENTE_VOTAR_IMG['url'] ?>?id_tatuador=<?= $id_usuario; ?>">
                                <span class="col-xs-3 col-md-3 col-lg-3"><img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/heart-outline-s.png"></span>
                            </a>
                            <p class="col-xs-8 col-md-8 col-lg-8"><?php echo $consulta->descripcion_imagen; ?></p>
                        </center>
                    </div>

                    <?php
                }
                ?>
            </div>

            <div class="container col-xs-3 col-md-3 col-lg-3">
                <br>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Ranking N° 1</h3>
                    </div>
                    <div class="panel-body">
                        <?php foreach ($imagenRanking as $value) { ?>
                            <img src="<?php echo PROYECTO_RECURSOS_IMGS_USERS . $value->imagen; ?>" width="100%" height="auto">
                        <?php } ?>
                    </div>
                </div> 

            </div>

        </div>

        <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Iniciar sesión</h4>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>


        <br><br><br>
        <footer id="footerCliente" class="footer">
            <div class="container">
                <p id="footerText" >&COPY; 2018 Tooink. Todos los derechos reservados.</p>
            </div>
        </footer>

    </body>

    <script language="Javascript">
        document.oncontextmenu = function () {
            return false;
        };
    </script>
</html>