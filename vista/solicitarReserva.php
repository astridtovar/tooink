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
        <link href="<?= PROYECTO_RECURSOS_CSS ?>colors/pink.css" id="theme" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    </head>

    <body>
        <div class="preloader">
            <div class="cssload-speeding-wheel"></div>
        </div>
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top m-b-0">
                <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
                    <div class="top-left-part"><a class="logo" href="#"><b><!--This is dark logo icon-->
                                <img src="<?= PROYECTO_RECURSOS_IMGS ?>icono-tooink.png" alt="home" class="dark-logo" /><!--This is light logo icon-->
                                <img src="<?= PROYECTO_RECURSOS_IMGS ?>icono-tooink.png" alt="home" class="light-logo" /></b><span class="hidden-xs"><!--This is dark logo text-->
                                <img src="<?= PROYECTO_RECURSOS_IMGS ?>logotipo-tooink-alt.png" alt="home" class="dark-logo" /><!--This is light logo text-->
                                <img src="<?= PROYECTO_RECURSOS_IMGS ?>logotipo-tooink-pequeno.png" alt="home" class="light-logo2" /></span></a></div>
                    <ul class="nav navbar-top-links navbar-left hidden-xs">
                        <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="fa fa-bars"></i></a></li>
                    </ul>
                    <ul class="nav navbar-top-links navbar-right pull-right">
                        <li>
                            <a href="<?= CERRAR_SESION['url'] ?>"><i class="fa fa-power-off"></i><span> Cerrar Sesión</span></a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- Left navbar-header -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                    <div class="user-profile">
                        <div class="dropdown user-pro-body">
                            <?php
                            $id_usuario = $_SESSION['usuario']->getId_usuario();
                            foreach ($lista as $consulta) {
                                ?>
                                <div>
                                    <img src="<?php echo PROYECTO_RECURSOS_IMGS_USERS . $_SESSION['usuario']->getFoto_perfil(); ?>" alt="user-img" class="img-circle">
                                </div>
                                <i class="fa fa-user-circle"></i><span class="hide-menu"> <?php echo $_SESSION['usuario']->getNombre() . $_SESSION['usuario']->getApellido(); ?></span>
                            <?php } ?> 
                        </div>
                    </div>
                    <ul class="nav" id="side-menu">

                        <li class="nav-small-cap m-t-10">-- Menu</li>

                        <li> <a href="<?= CLIENTE_PRINCIPAL['url'] ?>" class="waves-effect active"><i class="fa fa-portrait"></i> <span class="hide-menu"> Directorio Tatuadores</span></a>
                        </li>

                        <li> <a href="<?= CLIENTE_CONSULTAR_CITAS['url'] ?>" class="waves-effect"><i class="fa fa-calendar-alt"></i> <span class="hide-menu">Citas</span></a>
                        </li>

                        <li> <a href="<?= CLIENTE_INFORMACION['url'] ?>" class="waves-effect"><i class="fa fa-user-edit"></i> <span class="hide-menu">Información</span></a>
                        </li>

                        <li> <a href="<?= CAMBIAR_CLAVE_CLIENTE['url'] ?>" class="waves-effect"><i class="fa fa-edit"></i> <span class="hide-menu"> Cambiar Contraseña</span></a>
                        </li>

                </div>
            </div>

            <!-- Left navbar-header end -->
            <!-- Page Content -->
            <div id="page-wrapper">

                <?php
                if (isset($_GET["r"])) {
                    $respuesta = $_GET["r"];
                    if ($respuesta == "1") {
                        echo '<br>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    Reserva solicitada exitosamente.
                </div>';
                    } else if ($respuesta == "0") {
                        echo '<br>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    Por favor inicia sesión para reservar una cita con este tatuador.
                </div>';
                    } else if ($respuesta == "2") {
                        echo '<br>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    No se permite votar por la misma imagen más de una vez.
                </div>';
                    } else if ($respuesta == "3") {
                        echo '<br>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    Por favor inicia sesión para votar por esta imagen.
                </div>';
                    } else if ($respuesta == "4") {
                        echo '<br>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    Voto recibido exitosamente.
                </div>';
                    }
                }


                $id_tatuador = $_GET['id_usuario'];
                ?>

                <div class="container-fluid">
                    <div class="row bg-title">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h4 class="page-title">Directorio de Tatuadores</h4> </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            <ol class="breadcrumb">
                                <li><a href="#">Menu</a></li>
                                <li><a href="<?= CLIENTE_PRINCIPAL['url'] ?>">Directorio Tatuadores</a></li>
                                <li><a href="<?= CLIENTE_PERFIL_TATUADOR['url'] ?>?id_usuario=<?php echo $id_tatuador; ?>">Perfil Tatuador</a></li>
                                <li class="active">Solicitar Reserva</li>
                            </ol>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /row -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="white-box">
                                <form action="<?= CLIENTE_RESERVAR_CITA['url'] ?>" method="POST">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="exampleModalLabel">Solicitar Reservar</h3>
                                    </div>
                                    <div class="modal-body container col-xs-12 col-md-12 col-lg-12">

                                        <div class="container col-xs-12 col-md-12 col-lg-12">
                                            <input type="hidden" name="id_tatuador" value="<?php echo $id_usuario = $_GET['id_usuario']; ?>"/>
                                            <div>
                                                <p>A continuación se muestran las fechas disponibles para reservar la cita con este tatuador.
                                                    Por favor seleccione una opción:</p>
                                            </div>
                                            <div class="col-xs-12 col-md-12 col-lg-12">
                                                <div class="col-xs-11 col-md-11 col-lg-11">
                                                    <label>Fecha:</label>
                                                    <select class="form-control" name="fecha" required>
                                                        <?php foreach ($listaEspacios as $consulta) { ?>
                                                            <option value="<?php echo $consulta->id_espacio; ?>"><?php echo $consulta->start; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <br>
                                                <button type="button" class="btn col-xs-1 col-md-1 col-lg-1" data-toggle="tooltip" data-placement="top"
                                                        title="Selecciona la fecha en la que quieres reservar la cita.">
                                                    <img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/round-help-button.png">
                                                </button>
                                                <br>
                                            </div>
                                            <br>
                                            <div class="col-xs-12 col-md-12 col-lg-12">
                                                <br>
                                                <div class="col-xs-11 col-md-11 col-lg-11">
                                                    <label for="contacto_cliente">Asunto:
                                                        <span><em id="requerido" title="Campo Obligatorio">*</em></span>
                                                    </label>
                                                    <select class="form-control" id="esp_title" name="esp_title" required>
                                                        <option value="Nuevo Tatuaje">Nuevo Tatuaje</option>
                                                        <option value="Cubrir Tatuaje">Cubrir Tatuaje</option>
                                                        <option value="Cubrir Tatuaje">Retocar Tatuaje</option>
                                                    </select>
<!--                                                    <input class="form-control" type="text" id="esp_title" name="esp_title" value="" required/>-->
                                                </div>
                                                <br>
                                                <button type="button" class="btn col-xs-1 col-md-1 col-lg-1" data-toggle="tooltip" data-placement="top"
                                                        title="Selecciona un asunto de la cita, este sera el que vera el tatuador.">
                                                    <img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/round-help-button.png">
                                                </button>
                                                <br>
                                            </div>
                                            <br>
                                            <div class="col-xs-12 col-md-12 col-lg-12">
                                                <br>
                                                <div class="col-xs-11 col-md-11 col-lg-11">
                                                    <label>Descripción:
                                                        <span><em id="requerido" title="Campo Obligatorio">*</em></span>
                                                    </label>
                                                    <textarea class="form-control" rows="2" id="descripcion" name="descripcion" required placeholder="Por favor ingrese una pequeña descripción la cita que solicita."></textarea>
                                                </div>
                                                <br>
                                                <button type="button" class="btn col-xs-1 col-md-1 col-lg-1" data-toggle="tooltip" data-placement="top"
                                                        title="Escribe una breve descripción de la cita que quieres reservar.">
                                                    <img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/round-help-button.png">
                                                </button>
                                                <br>
                                            </div>
                                            <br>
                                            <div class="col-xs-12 col-md-12 col-lg-12 i">
                                                <br>
                                                <div class="col-xs-11 col-md-11 col-lg-11">
                                                    <label>Estilo:
                                                        <span><em id="requerido" title="Campo Obligatorio">*</em></span>
                                                    </label>
                                                    <select class="form-control" id="esp_estilo" name="esp_estilo" required>
                                                        <?php foreach ($listaEstilos as $consulta) { ?>
                                                            <option value="<?php echo $consulta->id_estilo; ?>"><?php echo $consulta->descripcion; ?></option>
                                                        <?php }
                                                        ?>
                                                    </select>
                                                </div>
                                                <br>
                                                <button type="button" class="btn col-xs-1 col-md-1 col-lg-1" data-toggle="tooltip" data-placement="top"
                                                        title="Selecciona el estilo de tatuaje del que se trata la cita.">
                                                    <img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/round-help-button.png">
                                                </button>
                                                <br>
                                            </div>
                                            <div>
                                                <center>
                                                    <i>El tatuador podrá aceptar ó denegar la reserva.</i>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="<?= CLIENTE_PERFIL_TATUADOR['url'] ?>?id_usuario=<?php echo $id_tatuador; ?>"><button type="button" class="btn btn-secondary" data-dismiss="modal">Volver a perfil</button></a>
                                        <button type="submit" class="btn btn-primary-cliente">Solicitar Reserva</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> Tooink 2018 &copy; Todos los derechos reservados.  </footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
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
</body>

</html>