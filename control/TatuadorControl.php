<?php

namespace control;

use control\generico\GenericoControl;
use DateInterval;
use DatePeriod;
use DateTime;
use Exception;
use modelo\dao\CitaDAO;
use modelo\dao\Contacto_UsuarioDAO;
use modelo\dao\Espacio_AgendaDAO;
use modelo\dao\Estilo_UsuarioDAO;
use modelo\dao\EstiloDAO;
use modelo\dao\Imagen_PortafolioDAO;
use modelo\dao\UsuarioDAO;
use modelo\dao\VotosDAO;
use modelo\vo\Contacto_Usuario;
use modelo\vo\Espacio_Agenda;
use modelo\vo\Estilo;
use modelo\vo\Estilo_Usuario;
use modelo\vo\Imagen_Portafolio;
use modelo\vo\Usuario;
use const RUTA_PRINCIPAL;

class TatuadorControl extends GenericoControl {

    private $usuarioDAO;
    private $estiloDAO;
    private $estilo_usuarioDAO;
    private $contacto_usuarioDAO;
    private $imagen_portafolioDAO;
    private $citaDAO;
    private $espacio_agendaDAO;
    private $votosDAO;

    public function __construct(&$cnn) {
        parent::__construct($cnn);
        parent::validarSesion();
        $this->usuarioDAO = new UsuarioDAO($cnn);
        $this->estiloDAO = new EstiloDAO($cnn);
        $this->estilo_usuarioDAO = new Estilo_UsuarioDAO($cnn);
        $this->contacto_usuarioDAO = new Contacto_UsuarioDAO($cnn);
        $this->imagen_portafolioDAO = new Imagen_PortafolioDAO($cnn);
        $this->citaDAO = new CitaDAO($cnn);
        $this->espacio_agendaDAO = new Espacio_AgendaDAO($cnn);
        $this->votosDAO = new VotosDAO($cnn);
    }

    public function index() {
        $id_usuario = $_SESSION['usuario']->getId_usuario();
        $usuario = new Usuario();
        $usuario->getCampos($_POST);
        $usuario->getListaEstilos();
        $estilo = new Estilo();
        $estilo->getCampos($_POST);
        $estilo_usuario = new Estilo_Usuario();
        $estilo_usuario->getCampos($_POST);
        $contacto_usuario = new Contacto_Usuario();
        $contacto_usuario->getCampos($_POST);
        $lista = $this->usuarioDAO->consultarIdPerfil($id_usuario);
        $listaEstilos = $this->estiloDAO->consultarEstilos();
        $lista_est_usuario = $this->estilo_usuarioDAO->consultarEstilo_Usuario($id_usuario);
        $listaContacto = $this->contacto_usuarioDAO->consultarContactos($id_usuario);
        include RUTA_PRINCIPAL . './vista/perfilTatuadorInformacion.php';
    }

    public function guardarInformacion() {
        $id_usuario = $_SESSION['usuario']->getId_usuario();
        try {
            $this->cnn->beginTransaction();

            // MODIFICAR INFORMACIÓN BASICA
            $nombre = $_POST['usu_nombre'];
            $apellido = $_POST['usu_apellido'];
            $correo = $_POST['usu_correo'];
            $nombre_artistico = $_POST['usu_nombre_artistico'];
            $usuario = new Usuario();
            $usuario->setId_usuario($id_usuario);
            $usuario->setNombre($nombre);
            $usuario->setApellido($apellido);
            $usuario->setCorreo($correo);
            $usuario->setNombre_artistico($nombre_artistico);
            $this->usuarioDAO->modificarInformacionTatuador($nombre, $apellido, $correo, $nombre_artistico, $id_usuario);

            // INSERTAR CONTACTO
            if (!empty($_POST['con_descripcion_contacto_nue'])) {
                $contacto_nuevo = $_POST['con_descripcion_contacto_nue'];
                $this->contacto_usuarioDAO->insertarContacto($id_usuario, $contacto_nuevo);
            }

            // MODIFICAR CONTACTO
            $listaContactos = $_POST['con_descripcion_contacto'];
            for ($i = 0; $i < count($listaContactos); $i++) {
                $id_contacto_e = $_POST['con_id_contacto'][$i];
                $contacto_editar = $_POST['con_descripcion_contacto'][$i];
                $contacto_usuario = new Contacto_Usuario();
                $contacto_usuario->setDescripcion_contacto($contacto_editar);
                $this->contacto_usuarioDAO->modificarContacto($id_contacto_e, $contacto_editar);
            }

            // INSERTAR ESTILO
            $id_estilo_nuevo = $_POST['est_id_estilo_nue'];
            if (!empty($_POST['est_nue_experiencia'])) {
                $expe_estilo_nuevo = $_POST['est_nue_experiencia'];
                if ($id_estilo_nuevo != 0) {
                    if (!empty($expe_estilo_nuevo)) {
                        $this->estilo_usuarioDAO->insertarEstilo($id_usuario, $id_estilo_nuevo, $expe_estilo_nuevo);
                    } else {
                        header('Location: ' . TATUADOR_PRINCIPAL['url'] . "?r=13");
                    }
                } else {
                    header('Location: ' . TATUADOR_PRINCIPAL['url'] . "?r=12");
                }
            }

            // MODIFICAR EXPERIENCIA ESTILO
            $listaEstilos = $_POST['id_estilo_usu'];
            for ($i = 0; $i < count($listaEstilos); $i++) {
                $id_estilo_e = $_POST['id_estilo_usu'][$i];
                $expe_editar = $_POST['est_anos_experiencia'][$i];
                $estilo_usuario = new Estilo_Usuario();
                $estilo_usuario->setAnos_experiencia($expe_editar);
                $this->estilo_usuarioDAO->modificarExperiencia($id_estilo_e, $expe_editar);
            }

            $this->cnn->commit();
            header('Location: ' . TATUADOR_PRINCIPAL['url'] . "?r=4");
        } catch (Exception $e) {
            $this->cnn->rollBack();
            header('Location: ' . TATUADOR_PRINCIPAL['url'] . "?r=5");
        }
    }

    public function eliminarContacto() {
        $id_contacto = $_GET['id_contacto'];
        $contactoUsuarioDAO = new Contacto_UsuarioDAO($this->cnn);
        if ($this->contacto_usuarioDAO->eliminarContacto($id_contacto)) {
            header('Location: ' . TATUADOR_PRINCIPAL['url'] . "?r=6");
        } else {
            header('Location: ' . TATUADOR_PRINCIPAL['url'] . "?r=7");
        }
    }

    public function eliminarEstilo() {
        $id_estilo_usuario = $_GET['id_estilo_usu'];
        $estiloUsuarioDAO = new Estilo_UsuarioDAO($this->cnn);
        if ($this->estilo_usuarioDAO->eliminarEstilo($id_estilo_usuario)) {
            header('Location: ' . TATUADOR_PRINCIPAL['url'] . "?r=8");
        } else {
            header('Location: ' . TATUADOR_PRINCIPAL['url'] . "?r=9");
        }
    }

    public function cambiarFotoPerfil() {
        $id_usuario = $_SESSION['usuario']->getId_usuario();
        include RUTA_PRINCIPAL . './vista/cambiarFotoPerfil.php';
    }

    public function guardarFotoPerfil() {
        $id_usuario = $_SESSION['usuario']->getId_usuario();
        $archivo = $_FILES['nuevaFotoPerfil'];
        $foto_perfil = $archivo['tmp_name'];
        if (!empty($archivo['tmp_name'])) {
            $foto_perfil = $id_usuario . '_' . $archivo['name'];
            move_uploaded_file($archivo['tmp_name'], RUTA_PRINCIPAL . '/vista/imgs/imgs-users/' . $foto_perfil);
            $usuario = new Usuario();
            $usuario->setFoto_perfil($foto_perfil);
            $this->usuarioDAO->modificarFotoPerfil($id_usuario, $foto_perfil);
            header('Location: ' . TATUADOR_PRINCIPAL['url'] . "?r=10");
        } else {
            header('Location: ' . TATUADOR_PRINCIPAL['url'] . "?r=11");
        }
    }

    public function portafolio() {
        $id_usuario = $_SESSION['usuario']->getId_usuario();
        $usuario = new Usuario();
        $usuario->getCampos($_POST);
        $lista = $this->usuarioDAO->consultarIdPerfil($id_usuario);
        $listaTrabajos = $this->imagen_portafolioDAO->consultarTrabajos($id_usuario);
        $ranking = $this->votosDAO->consultarParaRanking($id_usuario);
        $id_foto = $ranking['id_foto'];
        $imagenRanking = $this->votosDAO->buscarRanking($id_foto);
        include RUTA_PRINCIPAL . './vista/perfilTatuadorPortafolio2.php';
    }

    public function agregarTrabajo() {
        $id_usuario = $_SESSION['usuario']->getId_usuario();
        $usuario = new Usuario();
        $usuario->getCampos($_POST);
        $estilo = new Estilo();
        $estilo->getCampos($_POST);
        $lista = $this->usuarioDAO->consultarIdPerfil($id_usuario);
        $listaEstilos = $this->estiloDAO->consultarEstilos();
        include RUTA_PRINCIPAL . './vista/portafolioAgregarTrabajo2.php';
    }

    public function guardarTrabajo() {
        $id_usuario = $_SESSION['usuario']->getId_usuario();

        // Exportar imagen recortada de la vista previa.
        $src = RUTA_PRINCIPAL . '/vista/imgs/imgs-users/' . $_POST['img_recortada'];
        list($ancho, $alto) = getimagesize(RUTA_PRINCIPAL . '/vista/imgs/imgs-users/' . $_POST['img_recortada']);
        $img_crearOrigen = imagecreatefrompng($src);
        $img_crearDestino = imagecreatetruecolor(250, 300);
        imagecopyresampled($img_crearDestino, $img_crearOrigen, 0, 0, $_POST['x'], $_POST['y'], 250, 300, $_POST['w'], $_POST['h']);
        $foto = $_POST['img_recortada'];
        $img_export = imagejpeg($img_crearDestino, RUTA_PRINCIPAL . '/vista/imgs/imgs-users/' . $foto, 90);

        // Guardar img en la BD

        if (!empty($img_export)) {
            $descripcion_imagen = $_POST['img_descripcion_imagen'];
            $restriccion_edad = $_POST['restriccion_edad'];
            $imagenPortafolioDAO = new Imagen_PortafolioDAO($this->cnn);
            $imagenPortafolio = new Imagen_Portafolio();
            $imagenPortafolio->setDescripcion_imagen($descripcion_imagen);
            $imagenPortafolio->setRestriccion_edad($restriccion_edad);
            $imagenPortafolio->setId_usuario($id_usuario);
            $imagenPortafolio->setImagen($foto);
            $imagenPortafolio->setId_estado_img(1);
            $this->imagen_portafolioDAO->insertar($imagenPortafolio);
            header('Location: ' . TATUADOR_PORTAFOLIO['url'] . "?r=1");
        } else {
            header('Location: ' . TATUADOR_PORTAFOLIO['url'] . "?r=2");
            //echo 'No se pudo guardar';
        }
    }

    public function eliminarTrabajo() {
        $id_imagen = $_GET['ima_id_imagen'];
        if ($this->imagen_portafolioDAO->eliminarTrabajoPortafolio($id_imagen)) {
            header('Location: ' . TATUADOR_PORTAFOLIO['url'] . "?r=3");
        } else {
            header('Location: ' . TATUADOR_PORTAFOLIO['url'] . "?r=4");
        }
    }

    public function agenda() {
        $id_usuario = $_SESSION['usuario']->getId_usuario();
        $usuario = new Usuario();
        $usuario->getCampos($_POST);
        $lista = $this->usuarioDAO->consultarIdPerfil($id_usuario);
        $listaTrabajos = $this->imagen_portafolioDAO->consultarTrabajos($id_usuario);
        $listaEstilos = $this->estiloDAO->consultarEstilos();
        include RUTA_PRINCIPAL . './vista/perfilTatuadorAgenda2.php';
    }

    public function consultarEspacios() {
        $id_usuario = $_SESSION['usuario']->getId_usuario();
        $consulta = $this->espacio_agendaDAO->consultarEventos($id_usuario);
        echo $consulta;
    }

    public function buscarCliente() {
        $numero_doc = $_POST['cedula_cliente'];
        $cliente = $this->usuarioDAO->buscarCliente($numeroDoc);
        include RUTA_PRINCIPAL . './vista/perfilTatuadorAgenda2.php';
    }

    public function agendarCita() {
        $id_usuario = $_SESSION['usuario']->getId_usuario();
        $nombre = $_SESSION['usuario']->getNombre();
        $apellido = $_SESSION['usuario']->getApellido();
        $usuario = new Usuario();
        $usuario->getCampos($_POST);
        $lista = $this->usuarioDAO->consultarIdPerfil($id_usuario);

        $opcion = $_POST['btn'];
        $id_espacio = $_POST['id_espacio'];
        $descripcion_cita = $_POST['esp_descripcion_cita'];
        $cedula_cliente = $_POST['esp_cedula_cliente'];
        $title = $_POST['esp_title'];
        $id_estilo = $_POST['esp_estilo'];
        $start = $_POST['esp_start'];

        $espacio = new Espacio_Agenda();
        $espacio->setCedula_cliente($cedula_cliente);
        $espacio->setTitle($title);
        $espacio->setId_estilo_cita($id_estilo);
        $espacio->setDescripcion_cita($descripcion_cita);

        if ($opcion == 'Cancelar') {
            $descripcion = null;
            $title = null;
            $estilo = null;
            $cedula = null;
            $espacio = new Espacio_Agenda();
            $espacio->getCampos($_POST);
            $espacio->setDescripcion_cita($descripcion);
            $espacio->setCedula_cliente($cedula);
            $espacio->setId_espacio($id_espacio);
            $espacio->setTitle($title);
            $espacio->setId_estilo_cita($estilo);
            if ($this->espacio_agendaDAO->denegarReserva($descripcion, $cedula, $title, $estilo, $id_espacio)) {
                $buscar = $this->usuarioDAO->buscarCorreoPorCedula($cedula_cliente);
                $datosReserva = $this->usuarioDAO->consultarReservaID($id_espacio);
                foreach ($buscar as $consulta) {
                    foreach ($datosReserva as $reserva) {
                        $destinatario = $consulta->correo;
                        $asunto = "TOOINK - Su cita a sido cancelada.";
                        $cuerpo = '<body style="margin:0px; background: #f8f8f8; ">
                            <div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
                                <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
                                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px">
                                        <tbody>
                                            <tr>
                                                <td style="vertical-align: top; padding-bottom:30px;" align="center">
                                                <a href="http://localhost:8080/tooink/index.php/directoriotatuadores" target="_blank">
                                                    <h1> TOOINK - Agenda de Tatuadores </h1>
                                                </a> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                        <tbody>
                                            <tr>
                                                <td style="background:#fb9678; padding:20px; color:#fff; text-align:center;"> Su cita ha sido cancelada. </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div style="padding: 40px; background: #fff;">
                                        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                            <tbody>
                                                <tr>
                                                    <td>Se le informa que la cita del día ' . $reserva->start . ' con el tatuador ' . $nombre . $apellido . ' ha sido cancelada.<br></br>
                                                        <br><b>- Servicio de notificación Tooink.</b><br></br>
                                                        <p>Por favor no dar respuesta a este mensaje. Cualquier solicitud ó duda comunicarse directamente con su tatuador.</p></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px">
                                        <p> Enviado por Tooink </p>
                                    </div>
                                </div>
                            </div>
                        </body>';

                        $headers = 'MIME-Version: 1.0' . "\r\n";
                        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
                        $headers .= "From: Tooink <tooinksoftware@gmail.com>\r\n";
                        mail($destinatario, $asunto, $cuerpo, $headers);
                    }
                }
                header('Location: ' . TATUADOR_AGENDA['url'] . "?r=1");
            } else {
                header('Location: ' . TATUADOR_AGENDA['url'] . "?r=2");
            }
        } else if ($opcion == 'Modificar') {
            if ($this->espacio_agendaDAO->modificarEvento($start, $descripcion_cita, $id_espacio, $id_estilo, $title)) {
                header('Location: ' . TATUADOR_AGENDA['url'] . "?r=3");
            } else {
                header('Location: ' . TATUADOR_AGENDA['url'] . "?r=4");
            }
        } else {
            if ($this->espacio_agendaDAO->insertarEvento($id_espacio, $cedula_cliente, $title, $id_estilo, $descripcion_cita)) {
                $buscar = $this->usuarioDAO->buscarCorreoPorCedula($cedula_cliente);
                foreach ($buscar as $consulta) {
                    $destinatario = $consulta->correo;
                    $asunto = "TOOINK - Se ha agendado una nueva cita.";
                    $cuerpo = '
                        <body style="margin:0px; background: #f8f8f8; ">
                            <div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
                                <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
                                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px">
                                        <tbody>
                                            <tr>
                                                <td style="vertical-align: top; padding-bottom:30px;" align="center">
                                                <a href="http://localhost:8080/tooink/index.php/directoriotatuadores" target="_blank">
                                                    <h1> TOOINK - Agenda de Tatuadores </h1>
                                                </a> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                        <tbody>
                                            <tr>
                                                <td style="background:#fb9678; padding:20px; color:#fff; text-align:center;"> Se ha agendado una nueva cita. </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div style="padding: 40px; background: #fff;">
                                        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                            <tbody>
                                                <tr>
                                                    <td><b>Información de la cita:</b></p><br></br>
                                                        <b>Fecha:</b><p>' . $start . '</p>
                                                        <b>Tatuador:</b><p>' . $nombre . ' ' . $apellido . '</p>
                                                        <b>Descripción:</b><p>' . $descripcion_cita . '</p><br></br>
                                                        <b>- Servicio de notificación Tooink.</b><br></br>
                                                        <p>Por favor no dar respuesta a este mensaje. Cualquier solicitud ó duda comunicarse directamente con su tatuador.</p></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px">
                                        <p> Enviado por Tooink </p>
                                    </div>
                                </div>
                            </div>
                        </body>';

                    $headers = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
                    $headers .= "From: Tooink <tooinksoftware@gmail.com>\r\n";
                    if (mail($destinatario, $asunto, $cuerpo, $headers)) {
                        header('Location: ' . TATUADOR_AGENDA['url'] . "?r=5");
                    }
                }
            } else {
                header('Location: ' . TATUADOR_AGENDA['url'] . "?r=6");
            }
        }
    }

    public function confiCancelarEvento() {
        include RUTA_PRINCIPAL . './vista/modalConfirmacionCancelarE.php';
    }

    public function generarRegistrosAgenda() {
        $id_usuario = $_SESSION['usuario']->getId_usuario();
        $fechaInicio = $_POST['esp_fecha_inicio'];
        $fechaFin = $_POST['esp_fecha_fin'];
        $horaInicio = $_POST['esp_hora_inicio'];
        $horaFin = $_POST['esp_hora_fin'];
        $intervaloT = $_POST['esp_rangoTiempo'];
        $inicial = new DateTime($fechaInicio . ' ' . $horaInicio);
        $inicialHFin = new DateTime($fechaInicio . ' ' . $horaFin);
        $finalHInicio = new DateTime($fechaFin . ' ' . $horaInicio);
        $final = new DateTime($fechaFin . ' ' . $horaFin);
        $espacioAgenda = new Espacio_Agenda();

        switch ($intervaloT) {
            case 30:
                if ($fechaInicio == $fechaFin) {
                    $intervalo = new DateInterval('PT30M');
                    $periodo = new DatePeriod($inicial, $intervalo, $final);
                    foreach ($periodo as $registro) {
                        $string = $registro->format('Y-m-d H:i:s');
                        $espacioAgenda->setId_usuario($id_usuario);
                        $espacioAgenda->setStart($string);
                        if ($this->espacio_agendaDAO->insertar($espacioAgenda)) {
                            header('Location: ' . TATUADOR_AGENDA['url'] . "?r=7");
                        } else {
                            header('Location: ' . TATUADOR_AGENDA['url'] . "?r=8");
                        }
                    }
                } else {
                    $intervalo = new DateInterval('PT30M');
                    $periodo = new DatePeriod($inicial, $intervalo, $inicialHFin);
                    $periodo2 = new DatePeriod($finalHInicio, $intervalo, $final);
                    foreach ($periodo as $registro) {
                        $string = $registro->format('Y-m-d H:i:s');
                        $espacioAgenda->setId_usuario($id_usuario);
                        $espacioAgenda->setStart($string);
                        $this->espacio_agendaDAO->insertar($espacioAgenda);
                    }
                    foreach ($periodo2 as $registro) {
                        $string = $registro->format('Y-m-d H:i:s');
                        $espacioAgenda->setId_usuario($id_usuario);
                        $espacioAgenda->setStart($string);
                        if ($this->espacio_agendaDAO->insertar($espacioAgenda)) {
                            header('Location: ' . TATUADOR_AGENDA['url'] . "?r=7");
                        } else {
                            header('Location: ' . TATUADOR_AGENDA['url'] . "?r=8");
                        }
                    }
                }
                break;

            case 60:
                if ($fechaInicio == $fechaFin) {
                    $intervalo = new DateInterval('PT1H');
                    $periodo = new DatePeriod($inicial, $intervalo, $final);
                    foreach ($periodo as $registro) {
                        $string = $registro->format('Y-m-d H:i:s');
                        $espacioAgenda->setId_usuario($id_usuario);
                        $espacioAgenda->setStart($string);
                        if ($this->espacio_agendaDAO->insertar($espacioAgenda)) {
                            header('Location: ' . TATUADOR_AGENDA['url'] . "?r=7");
                        } else {
                            header('Location: ' . TATUADOR_AGENDA['url'] . "?r=8");
                        }
                    }
                } else {
                    $intervalo = new DateInterval('PT1H');
                    $periodo = new DatePeriod($inicial, $intervalo, $inicialHFin);
                    $periodo2 = new DatePeriod($finalHInicio, $intervalo, $final);
                    foreach ($periodo as $registro) {
                        $string = $registro->format('Y-m-d H:i:s');
                        $fechaHora = $espacioAgenda->setId_usuario($id_usuario);
                        $espacioAgenda->setStart($string);
                        $this->espacio_agendaDAO->insertar($espacioAgenda);
                    }
                    foreach ($periodo2 as $registro) {
                        $string = $registro->format('Y-m-d H:i:s');
                        $espacioAgenda->setId_usuario($id_usuario);
                        $espacioAgenda->setStart($string);
                        if ($this->espacio_agendaDAO->insertar($espacioAgenda)) {
                            header('Location: ' . TATUADOR_AGENDA['url'] . "?r=7");
                        } else {
                            header('Location: ' . TATUADOR_AGENDA['url'] . "?r=8");
                        }
                    }
                }
                break;
        }
        $espacioAgenda->setId_usuario($id_usuario);
        $registro = $final->format('Y-m-d H:i:s');
        $espacioAgenda->setStart($registro);
        if ($this->espacio_agendaDAO->insertar($espacioAgenda)) {
            header('Location: ' . TATUADOR_AGENDA['url'] . "?r=7");
        } else {
            header('Location: ' . TATUADOR_AGENDA['url'] . "?r=8");
        }
    }

    public function consultarReservas() {
        $id_usuario = $_SESSION['usuario']->getId_usuario();
        $usuario = new Usuario();
        $usuario->getCampos($_POST);
        $espacioAgenda = new Espacio_Agenda();
        $espacioAgenda->getCampos($_POST);
        $date = date('Y-m-d', time() - 84600);
        $lista = $this->usuarioDAO->consultarIdPerfil($id_usuario);
        $listaReservas = $this->usuarioDAO->consultarReservas($id_usuario, $date);
        include RUTA_PRINCIPAL . './vista/tatuadorConsultarReservas2.php';
    }

    public function aceptarReserva() {
        $nombre = $_SESSION['usuario']->getNombre();
        $apellido = $_SESSION['usuario']->getApellido();
        $id_espacio = $_GET['id_espacio'];
        $cedula_cliente = $_GET['numero_doc'];
        $buscar = $this->usuarioDAO->buscarCorreoPorCedula($cedula_cliente);
        $datosReserva = $this->usuarioDAO->consultarReservaID($id_espacio);
        foreach ($buscar as $consulta) {
            foreach ($datosReserva as $reserva) {
                $destinatario = $consulta->correo;
                $asunto = "TOOINK - Su reserva de cita a sido aceptada.";
                $cuerpo = '<body style="margin:0px; background: #f8f8f8; ">
                            <div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
                                <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
                                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px">
                                        <tbody>
                                            <tr>
                                                <td style="vertical-align: top; padding-bottom:30px;" align="center">
                                                <a href="http://localhost:8080/tooink/index.php/directoriotatuadores" target="_blank">
                                                    <h1> TOOINK - Agenda de Tatuadores </h1>
                                                </a> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                        <tbody>
                                            <tr>
                                                <td style="background:#fb9678; padding:20px; color:#fff; text-align:center;"> Su solicitud de reserva fue aceptada. </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div style="padding: 40px; background: #fff;">
                                        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                            <tbody>
                                                <tr>
                                                    <td>Se le informa que la cita del día ' . $reserva->start . ' con el tatuador ' . $nombre . $apellido . ' ha sido aceptada.<br></br>
                                                        <br><b>- Servicio de notificación Tooink.</b><br></br>
                                                        <p>Por favor no dar respuesta a este mensaje. Cualquier solicitud ó duda comunicarse directamente con su tatuador.</p></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px">
                                        <p> Enviado por Tooink </p>
                                    </div>
                                </div>
                            </div>
                        </body>';

                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
                $headers .= "From: Tooink <tooinksoftware@gmail.com>\r\n";
                mail($destinatario, $asunto, $cuerpo, $headers);
            }
        }
        if ($this->espacio_agendaDAO->aceptarReserva($id_espacio)) {
            header('Location: ' . TATUADOR_RESERVAS['url'] . "?r=1");
        } else {
            header('Location: ' . TATUADOR_RESERVAS['url'] . "?r=2");
        }
    }

    public function denegarReserva() {
        $nombre = $_SESSION['usuario']->getNombre();
        $apellido = $_SESSION['usuario']->getApellido();
        $cedula_cliente = $_GET['numero_doc'];
        $id_espacio = $_GET['id_espacio'];
        $buscar = $this->usuarioDAO->buscarCorreoPorCedula($cedula_cliente);
        $datosReserva = $this->usuarioDAO->consultarReservaID($id_espacio);
        foreach ($buscar as $consulta) {
            foreach ($datosReserva as $reserva) {
                $destinatario = $consulta->correo;
                $asunto = "TOOINK - Su reserva de cita a sido denegada.";
                $cuerpo = '<body style="margin:0px; background: #f8f8f8; ">
                            <div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
                                <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
                                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px">
                                        <tbody>
                                            <tr>
                                                <td style="vertical-align: top; padding-bottom:30px;" align="center">
                                                <a href="http://localhost:8080/tooink/index.php/directoriotatuadores" target="_blank">
                                                    <h1> TOOINK - Agenda de Tatuadores </h1>
                                                </a> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                        <tbody>
                                            <tr>
                                                <td style="background:#fb9678; padding:20px; color:#fff; text-align:center;"> Su solicitud de reserva fue rechazada. </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div style="padding: 40px; background: #fff;">
                                        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                            <tbody>
                                                <tr>
                                                    <td>Se le informa que la cita del día ' . $reserva->start . ' con el tatuador ' . $nombre . $apellido . ' ha sido rechazada.<br></br>
                                                        <br><b>- Servicio de notificación Tooink.</b><br></br>
                                                        <p>Por favor no dar respuesta a este mensaje. Cualquier solicitud ó duda comunicarse directamente con su tatuador.</p></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px">
                                        <p> Enviado por Tooink </p>
                                    </div>
                                </div>
                            </div>
                        </body>';

                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
                $headers .= "From: Tooink <tooinksoftware@gmail.com>\r\n";
                mail($destinatario, $asunto, $cuerpo, $headers);
            }
        }
        $descripcion = null;
        $title = null;
        $estilo = null;
        $cedula = null;
        $espacio = new Espacio_Agenda();
        $espacio->getCampos($_POST);
        $espacio->setDescripcion_cita($descripcion);
        $espacio->setCedula_cliente($cedula);
        $espacio->setId_espacio($id_espacio);
        $espacio->setTitle($title);
        $espacio->setId_estilo_cita($estilo);
        if ($this->espacio_agendaDAO->denegarReserva($descripcion, $cedula, $title, $estilo, $id_espacio)) {
            header('Location: ' . TATUADOR_RESERVAS['url'] . "?r=3");
        } else {
            header('Location: ' . TATUADOR_RESERVAS['url'] . "?r=4");
        }
    }

//    public function recordarCita() {
//        $dia_manana = date('y-m-d', time() + 84600);
//        $busqueda = $this->espacio_agendaDAO->consultarCitasProximas($dia_manana);
//        if ($busqueda != null || !empty($busqueda)) {
//            foreach ($busqueda as $cita) {
//                $cedula = $cita->cedula_cliente;
//                $buscar = $this->usuarioDAO->buscarCorreoPorCedula($cedula);
//                $tatuador = $this->usuarioDAO->consultarTatuadorId($cita->id_usuario);
//                foreach ($buscar as $consulta) {
//                    foreach ($tatuador as $value) {
//                        $destinatario = $consulta->correo;
//                        $asunto = "TOOINK - Recuerde su cita de mañana.";
//                        $cuerpo = "Este es el sistema de notificación del Software Tooink.\n"
//                                . ""
//                                . "Recuerde su cita el día $dia_manana con el tatuador $value->nombre $value->apellido. \n"
//                                . ""
//                                . "Información de la cita: \n"
//                                . "Fecha y hora: $cita->start\n"
//                                . "Descripción: $cita->descripcion"
//                                . ""
//                                . "Este es el servicio de notificación de Tooink, por favor no dar respuesta a este mensaje. Cualquier solicitud"
//                                . " ó duda por favor comunicarse directamente con su tatuador.";
//                        $headers = "From: Tooink <tooinksoftware@gmail.com>\r\n";
//                        mail($destinatario, $asunto, $cuerpo, $headers);
//                    }
//                }
//            }
//        }
//    }

}
