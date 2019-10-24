<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" href="<?= PROYECTO_RECURSOS_IMGS ?>icono-tooink.png"/>
        <title>Agenda</title>
        <!-- Bootstrap Core CSS -->
        <link href="<?= PROYECTO_RECURSOS_CSS ?>bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?= PROYECTO_RECURSOS_CSS ?>globaltooink.css">
        <link href="<?= PROYECTO_RECURSOS_PLUGINS ?>bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
        <link href="<?= PROYECTO_RECURSOS_PLUGINS ?>bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
        <!-- Menu CSS -->
        <link href="<?= PROYECTO_RECURSOS_PLUGINS ?>sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
        <!-- Calendar CSS -->
        <link href='scheduler.css' rel='stylesheet' />
        <link rel='stylesheet' href='<?= PROYECTO_RECURSOS_CSS ?>fullcalendar.css' />
        <link href="<?= PROYECTO_RECURSOS_CSS ?>bootstrap-clockpicker.css" rel="stylesheet" />
        <!-- animation CSS -->
        <link href="<?= PROYECTO_RECURSOS_CSS ?>animate.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?= PROYECTO_RECURSOS_CSS ?>style.css" rel="stylesheet">
        <!-- color CSS -->
        <link href="<?= PROYECTO_RECURSOS_CSS ?>colors/orange.css" id="theme" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    </head>

    <body class="fix-sidebar">
        <!-- Preloader -->
        <div class="preloader">
            <div class="cssload-speeding-wheel"></div>
        </div>
        <div id="wrapper">
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

                        <li> <a href="<?= TATUADOR_AGENDA['url'] ?>" class="waves-effect active"><i class="fa fa-calendar-alt"></i> <span class="hide-menu"> Agenda</span></a>
                        </li>

                        <li> <a href="<?= TATUADOR_PRINCIPAL['url'] ?>" class="waves-effect"><i class="fa fa-address-card"></i> <span class="hide-menu">Información</span></a>
                        </li>

                        <li> <a href="<?= TATUADOR_PORTAFOLIO['url'] ?>" class="waves-effect"><i class="fa fa-picture-o"></i> <span class="hide-menu">Portafolio</span></a>
                        </li>

                        <li> <a href="<?= TATUADOR_RESERVAS['url'] ?>" class="waves-effect"><i class="fa fa-calendar-check-o"></i> <span class="hide-menu">Reservas</span></a>
                        </li>

                        <li> <a href="<?= CAMBIAR_CLAVE_TATUADOR['url'] ?>" class="waves-effect"><i class="fa fa-edit"></i> <span class="hide-menu"> Cambiar Contraseña</span></a>
                        </li>
                </div>
            </div>
            <!-- Page Content -->
            <div id="page-wrapper">
                
                <?php
                    if (isset($_GET["r"])) {
                        $respuesta = $_GET["r"];
                        if ($respuesta == "1") {
                            echo '<br>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Bien hecho!</strong> Cita cancelada correctamente.
                </div>';
                        } else if ($respuesta == "2") {
                            echo '<br>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Lo sentimos!</strong> No fue posible cancelar la cita.
                </div>';
                        } else if ($respuesta == "3") {
                            echo '<br>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Bien hecho!</strong> Cita modificada correctamente.
                </div>';
                        } else if ($respuesta == "4") {
                            echo '<br>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Lo sentimos!</strong> No fue posible modificar la cita.
                </div>';
                        } else if ($respuesta == "5") {
                            echo '<br>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Bien hecho!</strong> Cita agendada correctamente, hemos enviado un mensaje al correo del
                    cliente notificando la misma.
                </div>';
                        } else if ($respuesta == "6") {
                            echo '<br>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Lo sentimos!</strong> No fue posible agendar la cita.
                </div>';
                        } else if ($respuesta == "7") {
                            echo '<br>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Bien hecho!</strong> Disponibilidad creada correctamente.
                </div>';
                        } else if ($respuesta == "8") {
                            echo '<br>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Lo sentimos!</strong> No fue posible crear la disponibilidad.
                </div>';
                        }
                    }
                    ?>
                
                <div class="container-fluid">
                    <div class="row bg-title">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h4 class="page-title">Mi agenda</h4>
                        </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            <ol class="breadcrumb">
                                <li><a href="#">Menu</a></li>
                                <li class="active">Agenda</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="white-box">
                            <div id="calendario">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    <!-- BEGIN MODAL -->
                    <div class="modal fade" id="modalDispo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="<?= TATUADOR_AGENDA_CREAR_DISP['url'] ?>" method="POST">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Crear Disponibilidad</h3>
                                    </div>
                                    <div class="modal-body col-xs-12 col-md-12 col-lg-12">
                                        <p class="text-muted blockquote-reverse">Los campos marcados con <span><em id="requerido">*</em></span> son requeridos.</p>
                                        <div class="container col-xs-12 col-md-12 col-lg-12">
                                            <div class="form-group col-xs-12 col-md-12 col-lg-12"></div>
                                            <div id="SelectHoras" class="form-group col-xs-5 col-md-5 col-lg-5">
                                                <div class="control-label col-xs-12 col-md-12 col-lg-12">
                                                    <label>Fecha Inicio: 
                                                        <span><em id="requerido" title="Campo Obligatorio">*</em></span>
                                                    </label>
                                                </div>
                                                <div class="col-xs-10 col-md-10 col-lg-10">
                                                    <input type="text" id="datepicker-autoclose_2" name="esp_fecha_inicio" class="form-control" required/>
                                                </div>
                                                <div class="col-xs-1 col-md-1 col-lg-1">
                                                    <button type="button" class="btn col-xs-1 col-md-1 col-lg-1" data-toggle="tooltip" data-placement="top"
                                                            title="Selecciona una fecha de inicio donde iniciara tu disponibilidad.">
                                                        <img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/round-help-button.png">
                                                    </button>
                                                </div>
                                            </div>
                                            <div id="SelectHoras" class="col-xs-1 col-md-1 col-lg-1"><span id="spanGuion" >-</span></div>
                                            <div id="SelectHoras" class="form-group col-xs-5 col-md-5 col-lg-5">
                                                <div class="control-label col-xs-12 col-md-12 col-lg-12">
                                                    <label>Fecha Fin: 
                                                        <span><em id="requerido" title="Campo Obligatorio">*</em></span>
                                                    </label>
                                                </div>
                                                <div class="col-xs-10 col-md-10 col-lg-10">
                                                    <input type="text" id="datepicker-autoclose" name="esp_fecha_fin" class="form-control" required/>
                                                </div>
                                                <div class="col-xs-1 col-md-1 col-lg-1">
                                                    <button type="button" class="btn col-xs-1 col-md-1 col-lg-1" data-toggle="tooltip" data-placement="top"
                                                            title="Selecciona una fecha de fin donde terminara tu disponibilidad.">
                                                        <img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/round-help-button.png">
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="form-group col-xs-12 col-md-12 col-lg-12">
                                            </div>
                                            <div id="SelectHoras" class="col-xs-5 col-md-5 col-lg-5 clockpicker form-group" data-autoclose="true">
                                                <div class="control-label col-xs-12 col-md-12 col-lg-12">
                                                    <label>Hora Inicio: 
                                                        <span><em id="requerido" title="Campo Obligatorio">*</em></span>
                                                    </label>
                                                </div>
                                                <div class="col-xs-10 col-md-10 col-lg-10">
                                                    <input type="text" name="esp_hora_inicio" class="form-control" required/>
                                                </div>
                                                <div class="col-xs-1 col-md-1 col-lg-1">
                                                    <button type="button" class="btn col-xs-1 col-md-1 col-lg-1" data-toggle="tooltip" data-placement="top"
                                                            title="Selecciona una hora de inicio donde dara inicio tu disponiblidad.">
                                                        <img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/round-help-button.png">
                                                    </button>
                                                </div>
                                            </div>
                                            <div id="SelectHoras" class="col-xs-1 col-md-1 col-lg-1">
                                                <span id="spanGuion" >-</span>
                                            </div>
                                            <div id="SelectHoras" class="col-xs-5 col-md-5 col-lg-5 clockpicker form-group" data-autoclose="true">
                                                <div class="control-label col-xs-12 col-md-12 col-lg-12">
                                                    <label>Hora Fin: 
                                                        <span><em id="requerido" title="Campo Obligatorio">*</em></span>
                                                    </label>
                                                </div>
                                                <div class="col-xs-10 col-md-10 col-lg-10">
                                                    <input type="text" name="esp_hora_fin" class="form-control" required/>
                                                </div>
                                                <div class="col-xs-1 col-md-1 col-lg-1">
                                                    <button type="button" class="btn col-xs-1 col-md-1 col-lg-1" data-toggle="tooltip" data-placement="top"
                                                            title="Selecciona una hora de fin donde se terminara tu disponiblidad.">
                                                        <img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/round-help-button.png">
                                                    </button>
                                                </div>
                                            </div>
                                            <div id="SelectHoras" class="form-group col-xs-12 col-md-12 col-lg-12">
                                                <div class="control-label col-xs-12 col-md-12 col-lg-12">
                                                    <label>Selecciona el tiempo de intervalos para tus citas: 
                                                        <span><em id="requerido" title="Campo Obligatorio">*</em></span>
                                                    </label>
                                                </div>
                                                <div class="col-xs-11 col-md-11 col-lg-11">
                                                    <select name="esp_rangoTiempo" class="form-control" required>
                                                        <option value="30">30 minutos.</option>
                                                        <option value="60">1 Hora.</option>
                                                    </select>
                                                </div>
                                                <div class="col-xs-1 col-md-1 col-lg-1">
                                                    <button type="button" class="btn col-xs-1 col-md-1 col-lg-1" data-toggle="tooltip" data-placement="top"
                                                            title="Selecciona el tiempo entre cada intervalo para generar así espacios en tu agenda.">
                                                        <img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/round-help-button.png">
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary-tatuador">Crear</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modalEvento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Agendar Cita</h3>
                                </div>
                                <form action="<?= TATUADOR_CITA_AGENDAR['url'] ?>" method="POST" id="modificar">
                                    <div class="modal-body col-xs-12 col-md-12 col-lg-12">
                                        <p class="text-muted blockquote-reverse">Los campos marcados con <span><em id="requerido">*</em></span> son requeridos.</p>
                                        <div class="col-xs-12 col-md-12 col-lg-12">
                                            <input type="hidden" id="id_espacio" name="id_espacio" value=""/>
                                            <fieldset>
                                                <legend>Información Cliente</legend>
                                                <div class="col-xs-12 col-md-12 col-lg-12">
                                                    <div class="col-xs-10 col-md-10 col-lg-10">
                                                        <label for="cedula_cliente" class="sr-only-focusable" title="Cedula Cliente">Cedula:
                                                            <span><em id="requerido" title="Campo Obligatorio">*</em></span>
                                                        </label>
                                                        <input class="form-control" type="text" id="esp_cedula_cliente" name="esp_cedula_cliente" placeholder="1026305966" required/>
                                                    </div>
                                                    <br>
                                                    <button type="button" class="btn col-xs-1 col-md-1 col-lg-1" data-toggle="tooltip" data-placement="top"
                                                            title="Debes ingresar un número de documento para verificar que el cliente se encuentra registrado en el sistema.">
                                                        <img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/round-help-button.png">
                                                    </button>
                                                    <br>
                                                </div>
                                            </fieldset>
                                            <br>
                                        </div>

                                        <div class="container col-xs-12 col-md-12 col-lg-12">
                                            <fieldset>
                                                <legend>Información Cita</legend>
                                                <div class="col-xs-12 col-md-12 col-lg-12">
                                                    <div class="col-xs-10 col-md-10 col-lg-10">
                                                        <label for="contacto_cliente">Titulo:
                                                            <span><em id="requerido" title="Campo Obligatorio">*</em></span>
                                                        </label>
                                                        <input class="form-control" type="text" id="esp_title" name="esp_title" value=""/>
                                                    </div>
                                                    <br>
                                                    <button type="button" class="btn col-xs-1 col-md-1 col-lg-1" data-toggle="tooltip" data-placement="top"
                                                            title="Dale un titulo al evento, este sera el que aparecerá en el calendario.">
                                                        <img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/round-help-button.png">
                                                    </button>
                                                    <br>
                                                </div>
                                                <div class="col-xs-12 col-md-12 col-lg-12">
                                                    <div class="col-xs-10 col-md-10 col-lg-10">
                                                        <label>Fecha:</label>
                                                        <input type="text" id="esp_start" name="esp_start" class="form-control"/>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-md-12 col-lg-12">
                                                    <div class="col-xs-10 col-md-10 col-lg-10">
                                                        <label>Estilo:
                                                            <span><em id="requerido" title="Campo Obligatorio">*</em></span>
                                                        </label>
                                                        <select class="form-control" id="esp_estilo" name="esp_estilo">
                                                            <?php foreach ($listaEstilos as $consulta) { ?>
                                                                <option value="<?php echo $consulta->id_estilo; ?>"><?php echo $consulta->descripcion; ?></option>
                                                            <?php }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <br>
                                                    <button type="button" class="btn col-xs-1 col-md-1 col-lg-1" data-toggle="tooltip" data-placement="top"
                                                            title="Estilo de tatuaje del que se trata la cita.">
                                                        <img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/round-help-button.png">
                                                    </button>
                                                    <br>
                                                </div>
                                                <div class="col-xs-12 col-md-12 col-lg-12">
                                                    <div class="col-xs-10 col-md-10 col-lg-10">
                                                        <label>Descripción:
                                                            <span><em id="requerido" title="Campo Obligatorio">*</em></span>
                                                        </label>
                                                        <textarea class="form-control" rows="3" id="esp_descripcion_cita" name="esp_descripcion_cita"></textarea>
                                                    </div>
                                                    <br>
                                                    <button type="button" class="btn col-xs-1 col-md-1 col-lg-1" data-toggle="tooltip" data-placement="top"
                                                            title="Escribe una breve descripción del evento que vas a agendar.">
                                                        <img src="<?= PROYECTO_RECURSOS_IMGS ?>/iconos/round-help-button.png">
                                                    </button>
                                                    <br>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <br><br>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary" name="btn" value="Cancelar">Cancelar Cita</button>
                                        <button type="submit" class="btn btn-info" name="btn" value="Modificar">Modificar Cita</button>
                                        <button type="submit" class="btn btn-primary-tatuador" name="btn" value="Agendar">Agendar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modalEventoModificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="tituloEvento"></h3>
                                </div>
                                <form action="<?= TATUADOR_CITA_MODIFICAR['url'] ?>" method="POST">
                                    <div class="modal-body col-xs-12 col-md-12 col-lg-12"><div class="col-xs-6 col-md-6 col-lg-6">
                                            <h4>Información Cliente:</h4>
                                            <input type="hidden" id="id_cita" name="id_cita" value=""/>
                                            <div class="col-xs-12 col-md-12 col-lg-12">
                                                <div class="col-xs-10 col-md-10 col-lg-10">
                                                    <label for="cedula_cliente" class="sr-only-focusable" title="Cedula Cliente">Cedula:</label>
                                                    <p id="cedulaCliente"></p>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-md-12 col-lg-12">
                                                <div class="col-xs-10 col-md-10 col-lg-10">
                                                    <label for="nombre_cliente" class="sr-only-focusable" title="Nombre Cliente">Nombre:</label>
                                                    <p id="nombreCliente"></p>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-12 col-lg-12">
                                                <div class="col-xs-10 col-md-10 col-lg-10">
                                                    <label for="contacto_cliente">Contacto:</label>
                                                    <p id="contactoCliente"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="container col-xs-6 col-md-6 col-lg-6">
                                            <h4>Información Cita:</h4>
                                            <div class="col-xs-12 col-md-12 col-lg-12">
                                                <div class="col-xs-10 col-md-10 col-lg-10">
                                                    <label>Fecha:</label>
                                                    <input type="text" id="fechaEvento" name="cit_start" class="form-control" value=""/>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-12 col-lg-12">
                                                <div class="col-xs-10 col-md-10 col-lg-10">
                                                    <label>Descripción:</label>
                                                    <textarea class="form-control" rows="3" id="descripcionEvento" name="cit_descripcion_cita"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <br><br>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary" name="btn" value="Cancelar">Cancelar Cita</button>
                                        <button type="submit" class="btn btn-primary-tatuador" name="btn" value="Modificar">Modificar Cita</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- END MODAL -->
                </div>
                <!-- /.container-fluid -->
                <footer class="footer text-center"> Tooink 2018 &copy; Todos los derechos reservados. </footer>
            </div>
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
        <!-- Calendar JavaScript -->
        <script src='<?= PROYECTO_RECURSOS_JS ?>moment.min.js'></script>
        <script src='<?= PROYECTO_RECURSOS_JS ?>fullcalendar.js'></script>
        <script src='<?= PROYECTO_RECURSOS_JS ?>locale/es.js'></script>
        <script src="<?= PROYECTO_RECURSOS_JS ?>bootstrap-clockpicker.js"></script>
        <script>
            $(document).ready(function () {

                $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next',
                        center: 'title',
                        right: 'agendaDay,agendaWeek,month, MiBoton'
                    },
                    customButtons: {
                        MiBoton: {
                            text: "Crear Disponibilidad",
                            click: function () {
                                $("#modalDispo").modal();
                            }
                        }
                    },
                    defaultDate: new Date(),
                    navLinks: true, // can click day/week names to navigate views
                    editable: true,
                    eventLimit: true, // allow "more" link when too many events
                    events: 'http://localhost:8080/tooink/index.php/tatuador/agenda/espacios',
                    eventClick: function (calEvent, jsEvent, view) {
                        $('#esp_title').val(calEvent.title);
                        $('#esp_cedula_cliente').val(calEvent.cedula_cliente);
                        $('#esp_start').val(calEvent.start);
                        $('#esp_descripcion_cita').html(calEvent.descripcion_cita);
                        $('#id_espacio').val(calEvent.id_espacio);
                        $('#esp_estilo').val(calEvent.id_estilo_cita);
                        $("#modalEvento").modal();
                    }
                }
                );
            });
        </script>
        <script>
            $('.clockpicker').clockpicker();
        </script>
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

        </script>
        <!--Style Switcher -->
        <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>styleswitcher/jQuery.style.switcher.js"></script>
    </body>

</html>