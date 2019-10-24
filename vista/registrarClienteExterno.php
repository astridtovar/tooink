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

        <!-- Preloader -->
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

        <div class="container-fluid">
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
                    <strong>¡Cuidado!</strong> Esta cuenta de correo ya se encuentra registrada, por favor intentalo nuevamente.
                </div>';
                            }else if ($respuesta == "4") {
                                echo '
                <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Cuidado!</strong> Ya exite una cuenta registrada con esta cedula, por favor intentalo nuevamente.
                </div>';
                            } else {
                                echo '
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Lo sentimos!</strong> Hubo un error con el reCAPTCHA, por favor intentalo nuevamente.
                </div>';
                            }
                        }
                        ?>

                        <h2 class="box-title m-b-0">Formulario de Registro</h2>
                        <br>
                        <p class="text-muted blockquote-reverse">Los campos marcados con <span><em id="requerido">*</em></span> son requeridos.</p>

                        <form name="form" role="form" action="<?= CLIENTE_REGISTRO_GUARDAR['url'] ?>" method="POST" onsubmit="validacionCliente()">
                            <input type="hidden" id="usu_id_rol" name="usu_id_rol" value="3"/>
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
                            <center>
                                <fieldset class="col-xs-12 col-md-12 col-lg-12">
                                    <br><br>
                                    <div class="g-recaptcha center-block" data-sitekey="6Lc2i14UAAAAAN4T-bVlpRLPykYQdMsyerwSOkYx"></div> 
                                    <br>
                                </fieldset>
                            </center>
                            <center>
                                <div class="form-group">
                                    <a href="<?= DIRECTORIO_TATUADORES['url'] ?>"><button class="btn btn-secondary" type="button" title="Cancelar">Volver al directorio</button>
                                    <button id="btnRegistrar" class="btn btn-primary" type="submit" title="Enviar">Registrar</button>
                                </div>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <footer id="footer-color"><p id="footerText" > &COPY; 2018 Tooink. Todos los derechos reservados. </p></footer>

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
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script src="<?= PROYECTO_RECURSOS_JS ?>validacionesRegistroCliente.js"></script>
    </body>

</html>