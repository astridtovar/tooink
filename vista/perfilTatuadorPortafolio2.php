<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" href="<?= PROYECTO_RECURSOS_IMGS ?>icono-tooink.png"/>
        <title>Portafolio</title>
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
        <link href="<?= PROYECTO_RECURSOS_CSS ?>colors/orange.css" id="theme" rel="stylesheet">
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
                                    <img src="<?php echo PROYECTO_RECURSOS_IMGS_USERS . $consulta->foto_perfil; ?>" alt="user-img" class="img-circle">
                                </div>
                            <i class="fa fa-paint-brush"></i><span class="hide-menu"> <?php echo $consulta->nombre, ' ', $consulta->apellido; ?></span>
                            <?php } ?> 
                        </div>
                    </div>
                    <ul class="nav" id="side-menu">

                        <li class="nav-small-cap m-t-10">-- Menu</li>

                        <li> <a href="<?= TATUADOR_AGENDA['url'] ?>" class="waves-effect"><i class="fa fa-calendar-alt"></i> <span class="hide-menu"> Agenda</span></a>
                        </li>

                        <li> <a href="<?= TATUADOR_PRINCIPAL['url'] ?>" class="waves-effect"><i class="fa fa-address-card"></i> <span class="hide-menu">Información</span></a>
                        </li>

                        <li> <a href="<?= TATUADOR_PORTAFOLIO['url'] ?>" class="waves-effect active"><i class="fa fa-picture-o"></i> <span class="hide-menu">Portafolio</span></a>
                        </li>

                        <li> <a href="<?= TATUADOR_RESERVAS['url'] ?>" class="waves-effect"><i class="fa fa-calendar-check-o"></i> <span class="hide-menu">Reservas</span></a>
                        </li>

                        <li> <a href="<?= CAMBIAR_CLAVE_TATUADOR['url'] ?>" class="waves-effect"><i class="fa fa-edit"></i> <span class="hide-menu"> Cambiar Contraseña</span></a>
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
                    <strong>¡Bien hecho!</strong> Imagen agregada correctamente.
                </div>';
                    } else if ($respuesta == "2") {
                        echo '<br>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Lo sentimos!</strong> No fue posible agregar la imagen.
                </div>';
                    } else if ($respuesta == "3") {
                        echo '<br>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Bien hecho!</strong> Imagen eliminada correctamente.
                </div>';
                    } else if ($respuesta == "4") {
                        echo '<br>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Lo sentimos!</strong> No fue posible eliminar la imagen.
                </div>';
                    }
                }
                ?>

                <div class="container-fluid">
                    <div class="row bg-title">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h4 class="page-title">Mi Portafolio</h4>
                        </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            <ol class="breadcrumb">
                                <li><a href="#">Menu</a></li>
                                <li class="active">Portafolio</li>
                            </ol>
                        </div>
                    </div>

                    <div class="row">
                        <div class="white-box">
                            <div class="btn-rigth">
                                <a href="<?= TATUADOR_PORTAFOLIO_AGREGAR['url'] ?>"> 
                                    <img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/round-add-button.png" width="30px" title="Agregar imagen">
                                </a>
                            </div>
                            <br>
                            <div class="container">

                                <div class="trabajoTatuadorRanking col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <center>
                                        <h3 class="box-title m-b-0">¡Tu trabajo con mas votos!</h3>
                                    </center>
                                    <div class="product-img">
                                        <?php foreach ($imagenRanking as $value) { ?>
                                            <img src="<?php echo PROYECTO_RECURSOS_IMGS_USERS . $value->imagen; ?>">
                                        <?php } ?>
                                    </div>
                                </div>

                                <?php
                                $id_usuario = $_SESSION['usuario']->getId_usuario();
                                foreach ($listaTrabajos as $consulta) {
                                    ?>
                                    <div class="trabajoTatuador col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <div class="product-img">
                                            <input type="hidden" id="id_imagen" name="id_imagen" value="<?= $consulta->id_imagen; ?>"/>
                                            <img src="<?php echo PROYECTO_RECURSOS_IMGS_USERS . $consulta->imagen; ?>" />
                                            <div class="pro-img-overlay"> <a href="<?= TATUADOR_PORTAFOLIO_ELIMINAR['url'] ?>?ima_id_imagen=<?= $consulta->id_imagen; ?>" class="bg-danger"><i class="fa fa-trash"></i></a></div>
                                        </div>
                                        <center>
                                            <div class="product-text">
                                                <h3 class="box-title m-b-0">
                                                    <?php
                                                    if (!empty($consulta->descripcion_imagen)) {
                                                        echo $consulta->descripcion_imagen;
                                                    } else {
                                                        echo ' ';
                                                    }
                                                    ?>
                                                </h3>
                                            </div>
                                        </center>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.row -->
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