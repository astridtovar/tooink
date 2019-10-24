<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" href="<?= PROYECTO_RECURSOS_IMGS ?>icono-tooink.png"/>
        <title>Registrar Usuario</title>
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="<?= PROYECTO_RECURSOS_CSS ?>bootstrap.min.css">
        <link rel="stylesheet" href="<?= PROYECTO_RECURSOS_CSS ?>globaltooink.css">
        <link href="<?= PROYECTO_RECURSOS_PLUGINS ?>bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
        <link href="<?= PROYECTO_RECURSOS_PLUGINS ?>bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
        <!-- Menu CSS -->
        <link href="<?= PROYECTO_RECURSOS_PLUGINS ?>sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
        <!-- animation CSS -->
        <link href="<?= PROYECTO_RECURSOS_CSS ?>animate.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?= PROYECTO_RECURSOS_CSS ?>style.css" rel="stylesheet">
        <!-- color CSS -->
        <link href="<?= PROYECTO_RECURSOS_CSS ?>colors/purple.css" id="theme" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    </head>

    <body>
        <!-- Preloader -->
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
            <!-- End Top Navigation -->
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
                                <i class="fa fa-eye"> </i><span class="hide-menu"> <?php echo $consulta->nombre, ' ', $consulta->apellido; ?></span>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <ul class="nav" id="side-menu">

                        <li class="nav-small-cap m-t-10">--- Menu</li>

                        <li> <a href="<?= ADMINISTRADOR_REGISTRO['url'] ?>" class="waves-effect active"><i class="fa fa-user-plus"></i> <span class="hide-menu"> Registrar Usuario</span></a>
                        </li>

                        <li> <a href="<?= ADMINISTRADOR_CONSULTA['url'] ?>" class="waves-effect"><i class="fa fa-search"></i> <span class="hide-menu"> Consultar Usuario</span></a>
                        </li>

                        <li> <a href="<?= ADMINISTRADOR_INFORMACION['url'] ?>" class="waves-effect"><i class="fa fa-user-edit"></i> <span class="hide-menu"> Información</span></a>
                        </li>

                        <li> <a href="<?= CAMBIAR_CLAVE_MODAL['url'] ?>" class="waves-effect"><i class="fa fa-edit"></i> <span class="hide-menu"> Cambiar Contraseña</span></a>
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
                        echo '
                            <br>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Bien hecho!</strong> La contraseña se modifico correctamente.
                </div>';
                    } else if ($respuesta == "2") {
                        echo '
                            <br>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Lo sentimos!</strong> No fue posible cambiar la 
                    contraseña debido a que la contraseña actual ingresada no coincide con registrada en el sistema.
                </div>';
                    } else if ($respuesta == "3") {
                        echo '
                            <br>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Lo sentimos!</strong> No fue posible cambiar la 
                    contraseña debido a que las contraseas nuevas ingresadas no coinciden.
                </div>';
                    } else if ($respuesta == "4") {
                        echo '
                            <br>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Bien hecho!</strong> Usuario registrado exitosamente.
                </div>';
                    } else {
                        echo '
                            <br>
                <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Cuidado!</strong> Esta cuenta de correo ya se encuentra registrada, por favor intentalo nuevamente.
                </div>';
                    }
                }
                ?>

                <div class="container-fluid">
                    <div class="row bg-title">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h4 class="page-title">Registrar Usuario</h4>
                        </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            <ol class="breadcrumb">
                                <li><a href="#">Menu</a></li>
                                <li class="active">Registrar Usuario</li>
                            </ol>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- .row -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="white-box">
                                <h2 class="box-title m-b-0">Formulario de Registro</h2>
                                <br>
                                <p class="text-muted blockquote-reverse">Los campos marcados con <span><em id="requerido">*</em></span> son requeridos.</p>

                                <form name="form" role="form" action="<?= ADMINISTRADOR_GUARDAR_USUARIO['url'] ?>" method="POST" onsubmit="validacion()">
                                    <fieldset>
                                        <legend>Seleccione un Rol <span><em id="requerido" title="Campo Obligatorio">*</em></span></legend>
                                        <div class="col-xs-3 col-md-3 col-lg-3"></div>
                                        <div class="col-xs-5 col-md-5 col-lg-5">
                                            <select id="usu_id_rol" name="usu_id_rol" class="form-control" title="Selecciona un rol" required>
                                                <option value="">Selecciona una opción</option>
                                                <?php foreach ($listaRoles as $consulta) { ?>
                                                    <option value="<?php echo $consulta->id_rol; ?>" title="<?php echo $consulta->nombre_rol; ?>"><?php echo $consulta->nombre_rol; ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <button type="button" class="btn col-xs-1 col-md-1 col-lg-1" data-toggle="tooltip" data-placement="top"
                                                title="Debes seleccionar un rol de usuario para que el sistema pueda ofrecerte los servicios necesarios de acuerdo al mismo.">
                                            <img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/round-help-button.png">
                                        </button>
                                    </fieldset>
                                    <br>
                                    <fieldset>
                                        <legend>Diligencie el siguiente formulario</legend>
                                        <div class="col-xs-12 col-md-12 col-lg-12">
                                            <div class="col-xs-2 col-md-2 col-lg-2"></div>
                                            <label for="usu_tipo_doc" class="sr-only-focusable col-xs-2 col-md-2 col-lg-2" title="Tipo Documento">Tipo Documento: 
                                                <span><em id="requerido" title="Campo Obligatorio">*</em></span>
                                            </label>
                                            <div class="col-xs-4 col-md-4 col-lg-4">
                                                <select name="usu_id_tipo_doc" class="form-control" title="Seleccione un tipo de documento" required>
                                                    <option value="">Selecciona una opción</option>
                                                    <?php foreach ($listaDoc as $consulta) { ?>
                                                        <option value="<?php echo $consulta->id_tipo_doc; ?>" title="<?php echo $consulta->descripcion; ?>"><?php echo $consulta->descripcion; ?></option>
                                                    <?php }
                                                    ?>
                                                </select>
                                                <br>
                                            </div>
                                            <br><br>
                                        </div>
                                        <div class="col-xs-6 col-md-6 col-lg-6">
                                            <div class="col-xs-11 col-md-11 col-lg-11">
                                                <label for="usu_numero_doc" class="sr-only-focusable" title="Número Documento">Número Documento: 
                                                    <span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                                                <input required type="text" id="usu_numero_doc" name="usu_numero_doc" class="form-control" placeholder="1026305999"/>
                                            </div>
                                            <br>
                                            <button type="button" class="btn col-xs-1 col-md-1 col-lg-1" data-toggle="tooltip" data-placement="top"
                                                    title="Debes ingresar un número de documento para validar que eres mayor de edad.">
                                                <img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/round-help-button.png">
                                            </button>
                                        </div>
                                        <div class="col-xs-6 col-md-6 col-lg-6">
                                            <div class="col-xs-11 col-md-11 col-lg-11">
                                                <label for="usu_fecha_exp_doc"class="sr-only-focusable" title="Fecha Expedicion Documento">Fecha Expedición Documento: 
                                                    <span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                                                <input type="text" id="datepicker-autoclose" name="usu_fecha_exp_doc" class="form-control" placeholder="mm/dd/aaaa" required/>
                                                <!--<input type="date" id="usu_fecha_exp_doc" name="usu_fecha_exp_doc" class="form-control" placeholder="01/01/2018" required/>-->
                                            </div>
                                            <br>
                                            <button type="button" class="btn col-xs-1 col-md-1 col-lg-1" data-toggle="tooltip" data-placement="top"
                                                    title="Debes ingresar la fecha de expedición que aparece en la parte posterior de tu cedula.">
                                                <img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/round-help-button.png">
                                            </button>
                                        </div>
                                        <div class="col-xs-6 col-md-6 col-lg-6">
                                            <div class="col-xs-11 col-md-11 col-lg-11">
                                                <label for="usu_fecha_nac" class="sr-only-focusable" title="Fecha de Nacimiento">Fecha de Nacimiento: 
                                                    <span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                                                <input type="text" name="usu_fecha_nac" id="datepicker-autoclose_2" class="form-control" placeholder="mm/dd/yyyy" required>

                                                <!--                                                <label for="usu_fecha_nac" class="sr-only-focusable" title="Fecha de Nacimiento">Fecha de Nacimiento: 
                                                                                                    <span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                                                                                                <input type="text" id="datepicker2" name="usu_fecha_nac" class="form-control" placeholder="mm/dd/aaaa" required/>-->
                                            </div>
                                            <br>
                                            <button type="button" class="btn col-xs-1 col-md-1 col-lg-1" data-toggle="tooltip" data-placement="top"
                                                    title="Debes ingresar tu fecha de nacimiento para validar que tienes más de 18 años.">
                                                <img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/round-help-button.png">
                                            </button>
                                        </div>
                                        <div class="col-xs-6 col-md-6 col-lg-6">
                                            <div class="col-xs-11 col-md-11 col-lg-11">
                                                <label for="con_descripcion_contacto" class="sr-only-focusable" title="Contacto">Contacto: 
                                                    <span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                                                <input type="text" id="con_descripcion_contacto" name="con_descripcion_contacto" class="form-control" placeholder="3057231909" required/>
                                            </div>
                                            <br>
                                            <button type="button" class="btn col-xs-1 col-md-1 col-lg-1" data-toggle="tooltip" data-placement="top"
                                                    title="Ingresa un numero telefonico o red social de contacto, este sera publico y visible en tu perfil.">
                                                <img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/round-help-button.png">
                                            </button>
                                        </div>
                                        <div class="col-xs-6 col-md-6 col-lg-6">
                                            <div class="col-xs-11 col-md-11 col-lg-11">
                                                <label for="usu_nombre" class="sr-only-focusable" title="Nombre">Nombre: 
                                                    <span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                                                <input type="text" id="usu_nombre" name="usu_nombre" class="form-control" placeholder="Nombre" required/>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-md-6 col-lg-6">
                                            <div class="col-xs-11 col-md-11 col-lg-11">
                                                <label for="usu_apellido" class="sr-only-focusable" title="Apellido">Apellido: 
                                                    <span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                                                <input type="text" id="usu_apellido" name="usu_apellido" class="form-control" placeholder="Apellido" required/>
                                            </div>
                                            <br>
                                        </div>
                                        <div class="col-xs-6 col-md-6 col-lg-6">
                                            <div class="col-xs-11 col-md-11 col-lg-11">
                                                <label for="usu_correo" class="sr-only-focusable" title="Correo">Correo: 
                                                    <span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                                                <input type="email" id="usu_correo" name="usu_correo" class="form-control" placeholder="ejemplo@mail.com" required/>
                                            </div>
                                            <br>
                                            <button type="button" class="btn col-xs-1 col-md-1 col-lg-1" data-toggle="tooltip" data-placement="top"
                                                    title="Por favor ingresa un correo valido, este sera tu usuario de ingreso al sistema.">
                                                <img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/round-help-button.png">
                                            </button>
                                        </div>
                                        <div class="col-xs-6 col-md-6 col-lg-6">
                                            <div class="col-xs-11 col-md-11 col-lg-11">
                                                <label for="usu_confirmar_correo" class="sr-only-focusable" title="Confirmar Correo">Confirmar Correo: 
                                                    <span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                                                <input type="email" id="usu_confirmar_correo" name="usu_confirmar_correo" class="form-control" placeholder="ejemplo@mail.com" required/>
                                            </div>
                                            <br>
                                            <button type="button" class="btn col-xs-1 col-md-1 col-lg-1" data-toggle="tooltip" data-placement="top"
                                                    title="Esto es necesario para evitar errores al momento de ingresar al sistema.">
                                                <img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/round-help-button.png">
                                            </button>
                                        </div>
                                        <div class="col-xs-6 col-md-6 col-lg-6">
                                            <div class="col-xs-11 col-md-11 col-lg-11">
                                                <label for="usu_clave" class="sr-only-focusable" title="Contraseña">Contraseña: 
                                                    <span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                                                <input type="password" id="usu_clave" name="usu_clave" class="form-control" placeholder="minimo 8 caracteres alfanumericos" required/>
                                            </div>
                                            <br>
                                            <button type="button" class="btn col-xs-1 col-md-1 col-lg-1" data-toggle="tooltip" data-placement="top"
                                                    title="Esta debe tener entre 8 y 15 caracteres entre ellos, al menos 1 letra mayuscula, minuscula, digito y caracter especial.">
                                                <img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/round-help-button.png">
                                            </button>
                                        </div>
                                        <div class="col-xs-6 col-md-6 col-lg-6">
                                            <div class="col-xs-11 col-md-11 col-lg-11">
                                                <label for="usu_confirmar_clave" class="sr-only-focusable" title="Confirmar Contraseña">Confirmar Contraseña: 
                                                    <span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                                                <input type="password" id="usu_confirmar_clave" name="usu_confirmar_clave" class="form-control" placeholder="minimo 8 caracteres alfanumericos" required/>
                                            </div>
                                            <br>
                                            <button type="button" class="btn col-xs-1 col-md-1 col-lg-1" data-toggle="tooltip" data-placement="top"
                                                    title="Esto es necesario para evitar errores al momento de ingresar al sistema.">
                                                <img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/round-help-button.png">
                                            </button>
                                            <br>
                                        </div>
                                        <br><br>
                                    </fieldset>
                                    <br>
                                    <center>
                                        <div class="form-group">
                                            <button class="btn btn-default" type="reset" title="Cancelar">Cancelar</button>
                                            <button id="btnRegistrar" class="btn btn-primary" type="submit" title="Enviar">Registrar</button>
                                        </div>
                                    </center>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
                <footer class="footer text-center">Tooink 2018 &copy; Todos los derechos reservados. </footer>
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
        <!--Counter js -->
        <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>waypoints/lib/jquery.waypoints.js"></script>
        <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>counterup/jquery.counterup.min.js"></script>
        <!--Morris JavaScript -->
        <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>raphael/raphael-min.js"></script>
        <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>morrisjs/morris.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="<?= PROYECTO_RECURSOS_JS ?>custom.min.js"></script>
        <!-- Sparkline chart JavaScript -->
        <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>jquery-sparkline/jquery.charts-sparkline.js"></script>
        <script src="<?= PROYECTO_RECURSOS_JS ?>dashboard1.js"></script>
        <!-- Sparkline chart JavaScript -->
        <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <script>
                                    // Date Picker
                                    jQuery('.mydatepicker, #datepicker').datepicker();
                                    jQuery('#datepicker-autoclose').datepicker({
                                        autoclose: true,
                                        todayHighlight: true
                                    });

                                    jQuery('#datepicker-autoclose_2').datepicker({
                                        autoclose: true,
                                        todayHighlight: true
                                    });

                                    jQuery('#date-range').datepicker({
                                        toggleActive: true
                                    });
                                    jQuery('#datepicker-inline').datepicker({

                                        todayHighlight: true
                                    });

        </script>
        <!--Style Switcher -->
        <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>styleswitcher/jQuery.style.switcher.js"></script>
        <script src="<?= PROYECTO_RECURSOS_JS ?>validaciones.js"></script>
        <script type="text/javascript">
                                    $(document).ready(function () {
                                        //Disable cut copy paste
                                        $('body').bind('cut copy paste', function (e) {
                                            e.preventDefault();
                                        });

                                        //Disable mouse right click
                                        $("body").on("contextmenu", function (e) {
                                            return false;
                                        });
                                    });
        </script>
    </body>

</html>