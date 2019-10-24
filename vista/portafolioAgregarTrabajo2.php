<?php
$id_usuario = $_SESSION['usuario']->getId_usuario();
if (!empty($_POST["cargar"])) {
    $temp = $_FILES['img_imagen']['tmp_name'];
    if (is_uploaded_file($_FILES['img_imagen']['tmp_name'])) {
        $foto = $id_usuario . '_' . rand(0, 200000) . '_' . $_FILES['img_imagen']['name'];
        $targetPath = RUTA_PRINCIPAL . '/vista/imgs/imgs-users/' . $foto;
        if (move_uploaded_file($_FILES['img_imagen']['tmp_name'], $targetPath)) {
            $uploadedImagePath = $foto;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" href="<?= PROYECTO_RECURSOS_IMGS ?>icono-tooink.png"/>
        <title>Agregar Trabajo</title>
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
        <link rel="stylesheet" href="<?= PROYECTO_RECURSOS_CSS ?>demos.css" type="text/css" />
        <link rel="stylesheet" href="<?= PROYECTO_RECURSOS_CSS ?>jquery.Jcrop.css" type="text/css" />
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
                $imagePath = "preview.png";
                if (!empty($uploadedImagePath)) {
                    $imagePath = $uploadedImagePath;
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
                            <p class="text-muted blockquote-reverse">Los campos marcados con <span><em id="requerido">*</em></span> son requeridos.</p>

                            <form role="form" action="" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                <div>
                                    <div>
                                        <center>
                                            <i>Por favor seleccione una imagen. Recuerde que Tooink solo admite imagenes en formato PNG.</i>
                                        </center>
                                        <br>
                                    </div>
                                    <div class="form-group col-xs-9 col-md-9 col-lg-9">
                                        <div class="col-xs-3 col-md-3 col-lg-3"></div>
                                        <label class="col-xs-2 col-md-2 col-lg-2 control-label" for="img_imagen">Imagen: <span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                                        <input type="file" class="col-xs-7 col-md-7 col-lg-7 form-control-file" id="img_imagen" name="img_imagen" accept="image/png"/>
                                    </div>
                                    <div class="form-group col-xs-2 col-md-2 col-lg-2">
                                        <input class="btn btn-primary-tatuador col-xs-11 col-md-11 col-lg-11" name="cargar" id="cargar" type="submit" value="Cargar Imagen"/>
                                    </div>
                                    <button type="button" class="btn col-xs-1 col-md-1 col-lg-1" data-toggle="tooltip" data-placement="top"
                                            title="Seleccione la imagen en formato PNG y el botón cargar para obtener una vista previa de esta.">
                                        <img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/round-help-button.png">
                                    </button>
                                </div>
                            </form>

                            <br>

                            <form role="form" action="<?= TATUADOR_PORTAFOLIO_GUARDAR['url'] ?>" method="POST">

                                <div class="container col-lg-12">
                                    <input type="hidden" id="x" name="x" />
                                    <input type="hidden" id="y" name="y" />
                                    <input type="hidden" id="w" name="w" />
                                    <input type="hidden" id="h" name="h" />
                                    <div class="col-xs-2 col-md-2 col-lg-2"></div>
                                    <div class="form-group col-xs-4 col-md-4 col-lg-4">
                                        <i>Por favor recorte la imagen para que que cumpla con el tamaño aceptado.</i>
                                        <br>
                                        <input type="hidden" name="temp" value="<?php echo $temp; ?>"/>
                                        <input type="hidden" name="img_recortada" value="<?php echo $imagePath; ?>"/>
                                        <img src="<?php echo PROYECTO_RECURSOS_IMGS_USERS . $imagePath; ?>" id="img_recortar" class="img"/>
                                    </div>
                                    <br>
                                    <div class="form-group col-xs-5 col-md-5 col-lg-5">
                                        <div class="col-xs-12 col-md-12 col-lg-12">
                                            <label for="img_estilo" class="control-label">Estilo: <span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                                        </div>
                                        <div class="col-xs-11 col-md-11 col-lg-11">
                                            <select class="form-control">
                                                <?php foreach ($listaEstilos as $consulta) { ?>
                                                    <option value="<?php echo $consulta->id_estilo; ?>"><?php echo $consulta->descripcion; ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-xs-1 col-md-1 col-lg-1">
                                            <button type="button" class="btn" data-toggle="tooltip" data-placement="top"
                                                    title="Seleccione el estilo al que pertenece el tatuaje de la imagen.">
                                                <img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/round-help-button.png">
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-5 col-md-5 col-lg-5">
                                        <div class="col-xs-12 col-md-12 col-lg-12">
                                            <label class="control-label" for="img_descripcion_imagen" class="control-label">Descripción:</label>
                                        </div>
                                        <div class="col-xs-11 col-md-11 col-lg-11">
                                            <textarea class="form-control" id="img_descripcion_imagen" name="img_descripcion_imagen" rows="2"></textarea>
                                        </div>
                                        <div class="col-xs-1 col-md-1 col-lg-1">
                                            <button type="button" class="btn" data-toggle="tooltip" data-placement="top"
                                                    title="Agrega una breve descripción de la imagen, esta es opcional.">
                                                <img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/round-help-button.png">
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-xs-5 col-md-5 col-lg-5">
                                        <div class="col-xs-3 col-md-3 col-lg-3"></div>
                                        <div class="checkbox checkbox-purple col-xs-6 col-md-6 col-lg-6">
                                            <br>
                                            <input type="checkbox" name="restriccion_edad" value="Si" />
                                            <label>Restricción de Edad <span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                                        </div>
                                    </div>
                                </div>
                                <center>
                                    <div>
                                        <a href="<?= TATUADOR_PORTAFOLIO['url'] ?>">
                                            <button class="btn btn-secondary" type="button" title="Cancelar">Cancelar</button>
                                        </a>
                                        <button id="btn" class="btn btn-primary-tatuador" type="submit">Guardar</button>
                                    </div>
                                </center>
                            </form>
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
    <script src="<?= PROYECTO_RECURSOS_JS ?>validarImagen.js"></script>
    <script src="<?= PROYECTO_RECURSOS_JS ?>jquery.min.js"></script>
    <script src="<?= PROYECTO_RECURSOS_JS ?>jquery.Jcrop.js"></script>
    <script src="<?= PROYECTO_RECURSOS_JS ?>jquery.color.js"></script>
    <script type="text/javascript">
        jQuery(function ($) {
            $('#img_recortar').Jcrop({
                bgOpacity: 0.2,
                bgColor: 'black',
                minSize: [250, 300],
                maxSize: [250, 300],
                boxWidth: 250,
                boxHeight: 300,
                addClass: 'jcrop-light',
                onSelect: showCoords
            });
        });

        function showCoords(c)
        {
            jQuery('#x').val(c.x);
            jQuery('#y').val(c.y);
            jQuery('#w').val(c.w);
            jQuery('#h').val(c.h);
        }
        ;
    </script>
    <!--Style Switcher -->
    <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>