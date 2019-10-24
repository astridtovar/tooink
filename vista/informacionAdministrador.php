<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" href="<?= PROYECTO_RECURSOS_IMGS ?>icono-tooink.png"/>
        <title>Información</title>
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="<?= PROYECTO_RECURSOS_CSS ?>bootstrap.min.css">
        <link rel="stylesheet" href="<?= PROYECTO_RECURSOS_CSS ?>globaltooink.css">
        <link href="<?= PROYECTO_RECURSOS_PLUGINS ?>bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
        <link href="<?= PROYECTO_RECURSOS_PLUGINS ?>datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
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

    <body class="fix-sidebar">
        <!-- Preloader -->
        <div class="preloader">
            <div class="cssload-speeding-wheel"></div>
        </div>
        <div id="wrapper">
            <!-- Top Navigation -->
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

                        <li> <a href="<?= ADMINISTRADOR_REGISTRO['url'] ?>" class="waves-effect"><i class="fa fa-user-plus"></i> <span class="hide-menu"> Registrar Usuario</span></a>
                        </li>

                        <li> <a href="<?= ADMINISTRADOR_CONSULTA['url'] ?>" class="waves-effect"><i class="fa fa-search"></i> <span class="hide-menu"> Consultar Usuario</span></a>
                        </li>
                        
                        <li> <a href="<?= ADMINISTRADOR_INFORMACION['url'] ?>" class="waves-effect active"><i class="fa fa-user-edit"></i> <span class="hide-menu"> Información</span></a>
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
                        echo '<br>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Bien hecho!</strong> La contraseña se modifico correctamente.
                </div>';
                    } else if ($respuesta == "2") {
                        echo '<br>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Lo sentimos!</strong> No fue posible cambiar la 
                    contraseña debido a que la contraseña actual ingresada no coincide con registrada en el sistema.
                </div>';
                    } else if ($respuesta == "3") {
                        echo '<br>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Lo sentimos!</strong> No fue posible cambiar la 
                    contraseña debido a que las contraseas nuevas ingresadas no coinciden.
                </div>';
                    } else if ($respuesta == "4") {
                        echo '<br>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Bien hecho!</strong> La información se modifico correctamente.
                </div>';
                    } else if ($respuesta == "5") {
                        echo '<br>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Lo sentimos!</strong> No fue posible modificar la información.
                </div>';
                    } else if ($respuesta == "6") {
                        echo '<br>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Bien hecho!</strong> Contacto eliminado correctamente.
                </div>';
                    } else if ($respuesta == "7") {
                        echo '<br>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Lo sentimos!</strong> No fue posible eliminar el contacto.
                </div>';
                    } else if ($respuesta == "8") {
                        echo '<br>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Bien hecho!</strong> Estilo eliminado correctamente.
                </div>';
                    } else if ($respuesta == "9") {
                        echo '<br>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Lo sentimos!</strong> No fue posible eliminar el estilo.
                </div>';
                    } else if ($respuesta == "10") {
                        echo '<br>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Bien hecho!</strong> Foto de perfil modificada..
                </div>';
                    } else if ($respuesta == "11") {
                        echo '<br>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Lo sentimos!</strong> No fue posible modificar la foto de perfil.
                </div>';
                    } else if ($respuesta == "12") {
                        echo '
                    <br>
                <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    Debes seleccionar un estilo si deseas agregar uno nuevo.
                </div>';
                    } else if ($respuesta == "13") {
                        echo '
                    <br>
                <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    Debes ingresar los años de experiencia en el estilo nuevo a registrar.
                </div>';
                    }
                }
                ?>

                <div class="container-fluid">

                    <div class="row bg-title">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h4 class="page-title">Mi Información</h4>
                        </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            <ol class="breadcrumb">
                                <li><a href="#">Menu</a></li>
                                <li class="active">Información</li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.row -->
                    <!-- .row -->
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="white-box">                  
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home">

                                        <div class="user-bg"> 
                                            <?php
                                            $id_usuario = $_SESSION['usuario']->getId_usuario();
                                            foreach ($lista as $consulta) {
                                                ?>
                                                <div class="overlay-box">
                                                    <div class="user-content">
                                                        <img src="<?php echo PROYECTO_RECURSOS_IMGS_USERS . $consulta->foto_perfil; ?>" class="thumb-lg img-circle" alt="img">
                                                        <h4 class="text-white"><?php echo $consulta->nombre . ' ' . $consulta->apellido; ?></h4>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <br><br>

                                        <form role="form" class="form-horizontal form-material" action="<?= ADMIN_CAMBIAR_F_PERFIL['url'] ?>" method="POST" enctype="multipart/form-data">

                                            <fieldset>
                                                <legend>Seleccionar otra foto de perfil:</legend>
                                                <div class="col-lg-6">
                                                    <input type="file" class="form-control-file" name="nuevaFotoPerfil" accept="image/png/imagen/jpeg"/>
                                                </div>
                                                <div class="col-lg-3">
                                                    <button type="submit" class="btn btn-primary">Cambiar foto</button>
                                                </div>
                                            </fieldset>

                                        </form>

                                        <br>

                                        <form role="form" class="form-horizontal form-material" action="<?= ADMIN_INFORMACION_GUARDAR['url'] ?>" method="POST">

                                            <fieldset>
                                                <legend>Información básica:</legend>

                                                <div class="col-xs-6 col-md-6 col-lg-6">
                                                    <label for="usu_nombre" class="sr-only-focusable">Nombre:</label>
                                                    <input type="text" id="usu_nombre" name="usu_nombre" class="form-control" value="<?php echo $consulta->nombre; ?>" required/>
                                                </div>
                                                <div class="col-xs-6 col-md-6 col-lg-6">
                                                    <label for="usu_apellido" class="sr-only-focusable">Apellido:</label>
                                                    <input type="text" id="usu_apellido" name="usu_apellido" class="form-control" value="<?php echo $consulta->apellido; ?>" required/>
                                                </div>
                                                <div class="col-xs-6 col-md-6 col-lg-6">
                                                    <br>
                                                    <label for="usu_correo" class="sr-only-focusable">Correo:</label>
                                                    <input type="text" id="usu_correo" name="usu_correo" class="form-control" value="<?php echo $consulta->correo; ?>" required/>
                                                </div>
                                                <div class="col-xs-6 col-md-6 col-lg-6">
                                                    <br>
                                                    <label for="usu_contacto" class="sr-only-focusable">Contacto:</label>
                                                    <?php
                                                    $id_usuario = $_SESSION['usuario']->getId_usuario();
                                                    foreach ($listaContacto as $consulta) {
                                                        ?>
                                                        <input type="text" id="con_descripcion_contacto" name="con_descripcion_contacto[]" class="form-control" value="<?php echo $consulta->descripcion_contacto; ?>" required/>
                                                    <?php } ?>
                                                </div>

                                            </fieldset>

                                            <br>

                                            <center>
                                                <div>
                                                    <button class="btn btn-secondary" type="reset">Cancelar</button>
                                                    <button class="btn btn-primary" type="submit">Guardar</button>
                                                </div>
                                            </center>
                                        </form> 
                                    </div>
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
        <!-- jQuery peity -->
        <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>peity/jquery.peity.min.js"></script>
        <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>peity/jquery.peity.init.js"></script>
        <!-- Sparkline chart JavaScript -->
        <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>jquery-sparkline/jquery.charts-sparkline.js"></script>
        <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>datatables/jquery.dataTables.min.js"></script>
        <!-- start - This is for export functionality only -->
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#myTable').DataTable();
                $(document).ready(function () {
                    var table = $('#example').DataTable({
                        "columnDefs": [{
                                "visible": false,
                                "targets": 2
                            }],
                        "order": [
                            [2, 'asc']
                        ],
                        "displayLength": 25,
                        "drawCallback": function (settings) {
                            var api = this.api();
                            var rows = api.rows({
                                page: 'current'
                            }).nodes();
                            var last = null;

                            api.column(2, {
                                page: 'current'
                            }).data().each(function (group, i) {
                                if (last !== group) {
                                    $(rows).eq(i).before(
                                            '<tr class="group"><td colspan="5">' + group + '</td></tr>'
                                            );

                                    last = group;
                                }
                            });
                        }
                    });

                    // Order by the grouping
                    $('#example tbody').on('click', 'tr.group', function () {
                        var currentOrder = table.order()[0];
                        if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                            table.order([2, 'desc']).draw();
                        } else {
                            table.order([2, 'asc']).draw();
                        }
                    });
                });
            });
        </script>
        <!--Style Switcher -->
        <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>styleswitcher/jQuery.style.switcher.js"></script>
    </body>

</html>
