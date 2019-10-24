<?php

namespace control;

use control\generico\GenericoControl;
use Exception;
use modelo\dao\Contacto_UsuarioDAO;
use modelo\dao\Espacio_AgendaDAO;
use modelo\dao\Estilo_UsuarioDAO;
use modelo\dao\EstiloDAO;
use modelo\dao\Imagen_PortafolioDAO;
use modelo\dao\UsuarioDAO;
use modelo\dao\VotosDAO;
use modelo\vo\Contacto_Usuario;
use modelo\vo\Espacio_Agenda;
use modelo\vo\Estado;
use modelo\vo\Estilo;
use modelo\vo\Estilo_Usuario;
use modelo\vo\Imagen_Portafolio;
use modelo\vo\Usuario;
use const RUTA_PRINCIPAL;

class ClienteControl extends GenericoControl {

    private $usuarioDAO;
    private $contacto_usuarioDAO;
    private $estilo_usuarioDAO;
    private $imagen_portafolioDAO;
    private $espacio_agendaDAO;
    private $estiloDAO;
    private $votosDAO;

    public function __construct(&$cnn) {
        parent::__construct($cnn);
        //parent::validarSesion();
        $this->usuarioDAO = new UsuarioDAO($cnn);
        $this->contacto_usuarioDAO = new Contacto_UsuarioDAO($cnn);
        $this->estilo_usuarioDAO = new Estilo_UsuarioDAO($cnn);
        $this->imagen_portafolioDAO = new Imagen_PortafolioDAO($cnn);
        $this->espacio_agendaDAO = new Espacio_AgendaDAO($cnn);
        $this->estiloDAO = new EstiloDAO($cnn);
        $this->votosDAO = new VotosDAO($cnn);
    }

    public function index() {
        $id_usuario = $_SESSION['usuario']->getId_usuario();
        if (empty($_POST['busqueda']) || empty($_POST['busqueda'])) {
            $usuario = new Usuario();
            $usuario->getCampos($_POST);
            $id_usuario = $usuario->getId_usuario();
            $estilo = new Estilo();
            $estilo->getCampos($_POST);
            $lista = $this->usuarioDAO->consultarIdPerfil($id_usuario);
            $listaEstilo = $this->usuarioDAO->consultarEstilo($id_usuario);
            $listaTatuadores = $this->usuarioDAO->consultarTatuador();
            include RUTA_PRINCIPAL . './vista/principalCliente2.php';
        } else {
            $busqueda = $_POST['busqueda'];
            $palabraBusqueda = $_POST['palabraBusqueda'];
            $usuario = new Usuario();
            $usuario->getCampos($_POST);
            $id_usuario = $usuario->getId_usuario();
            $estilo = new Estilo();
            $estilo->getCampos($_POST);
            $lista = $this->usuarioDAO->consultarIdPerfil($id_usuario);
            $listaEstilo = $this->usuarioDAO->consultarEstilo($id_usuario);
            $listaTatuadores = $this->usuarioDAO->consultarPor($busqueda, $palabraBusqueda);
            include RUTA_PRINCIPAL . './vista/principalCliente2.php';
        }
    }

    public function registroCliente() {
        $listaRoles = $this->usuarioDAO->consultarRoles();
        $listaDoc = $this->usuarioDAO->consultarTiposDoc();
        include RUTA_PRINCIPAL . './vista/registrarClienteExterno.php';
    }

    public function guardarRegistro() {
        if (isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response']) {
            $secret = "6Lc2i14UAAAAAGRI01vr7bOtKYnx24IJDhtBlTvE";
            $ip = $_SERVER['REMOTE_ADDR'];
            $captcha = $_POST['g-recaptcha-response'];
            $result = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
            $array = json_decode($result, TRUE);
            if ($array['success']) {
                $documento = $_POST['usu_numero_doc'];
                $consultarDoc = $this->usuarioDAO->consultarCuentaDocumento($documento);
                $correo = $_POST['usu_correo'];
                $contacto = $_POST['con_descripcion_contacto'];
                $consultaCorreo = $this->usuarioDAO->consultarCuenta($correo);
                if (is_null($consultarDoc)) {
                    if (is_null($consultaCorreo)) {
                        $correo = $_POST['usu_correo'];
                        $correoConf = $_POST['usu_confirmar_correo'];
                        $clave = $_POST['usu_clave'];
                        $claveConf = $_POST['usu_confirmar_clave'];
                        if ($clave === $claveConf && $correo === $correoConf) {
                            $claveEncrip = md5($clave);
                            $usuario = new Usuario();
                            $usuario->convertir($_POST);
                            $usuario->setClave($claveEncrip);
                            if ($this->usuarioDAO->insertar($usuario)) {
                                $ultimoID = $this->cnn->lastInsertId();
                                $this->contacto_usuarioDAO->insertarContacto($ultimoID, $contacto);
                                header('Location:' . DIRECTORIO_TATUADORES['url'] . "?r=1");
                            }
                        }
                    } else {
                        header('Location:' . CLIENTE_REGISTRO['url'] . "?r=2");
                    }
                } else {
                    header('Location:' . CLIENTE_REGISTRO['url'] . "?r=4");
                }
            } else {
                header('Location:' . CLIENTE_REGISTRO['url'] . "?r=3");
            }
        } else {
            header('Location:' . CLIENTE_REGISTRO['url'] . "?r=3");
        }
    }

    public function perfilTatuador() {
        $id_usuario = $_GET['id_usuario'];
        $usuario = new Usuario();
        $usuario->getCampos($_POST);
        $contacto_usuario = new Contacto_Usuario();
        $contacto_usuario->getCampos($_POST);
        $estilo_usuario = new Estilo_Usuario();
        $estilo_usuario->getCampos();
        $imagen_portafolio = new Imagen_Portafolio();
        $imagen_portafolio->getCampos();
        $lista = $this->usuarioDAO->consultarTatuadorId($id_usuario);
        $listaContacto = $this->contacto_usuarioDAO->consultarContactosParaCliente($id_usuario);
        $listaEstilo = $this->estilo_usuarioDAO->consultarEstiloParaClientes($id_usuario);
        $listaTrabajo = $this->imagen_portafolioDAO->consultarTrabajosParaClientes($id_usuario);
        $listaEstilos = $this->estiloDAO->consultarEstilos();
        $listaIconos = $this->votosDAO->consultarIcono();
        $ranking = $this->votosDAO->consultarParaRanking($id_usuario);
        $id_foto = $ranking['id_foto'];
        $imagenRanking = $this->votosDAO->buscarRanking($id_foto);
        include RUTA_PRINCIPAL . './vista/perfilTatuadorClienteLogueado2.php';
    }

    public function consultarMisCitas() {
        $id_usuario = $_SESSION['usuario']->getId_usuario();
        $cedula = $_SESSION['usuario']->getNumero_doc();
        $usuario = new Usuario();
        $usuario->getCampos($_POST);
        $cita = new Espacio_Agenda();
        $cita->getCampos($_POST);
        $estado = new Estado();
        $estado->getCampos($_POST);
        $dateA = date('Y-m-d', time() - 84600);
        $lista = $this->usuarioDAO->consultarIdPerfil($id_usuario);
        $listaCitas = $this->usuarioDAO->consultarCitas($cedula, $dateA);
        include RUTA_PRINCIPAL . './vista/consultarCitas2.php';
    }

    public function indexReservarCita() {
        $id_usuario = $_GET['id_usuario'];
        $usuario = new Usuario();
        $usuario->getCampos($_POST);
        $estilo_usuario = new Estilo_Usuario();
        $estilo_usuario->getCampos();
        $espacio = new Espacio_Agenda();
        $espacio->getCampos($_POST);
        $date = date('Y-m-d H:i:s');
        $lista = $this->usuarioDAO->consultarTatuadorId($id_usuario);
        $listaEstilo = $this->estilo_usuarioDAO->consultarEstiloParaClientes($id_usuario);
        $listaEspacios = $this->espacio_agendaDAO->consultarEspaciosLibres($id_usuario, $date);
        $listaEstilos = $this->estiloDAO->consultarEstilos();
        include RUTA_PRINCIPAL . './vista/solicitarReserva.php';
    }

    public function reservarCita() {
        $id_tatuador2 = $_GET['id_tatuador'];
        if ($_SESSION != null || !empty($_SESSION)) {
            $usuario = new Usuario();
            $usuario->getCampos($_POST);
            $id_espacio = $_POST['fecha'];
            $descripcion = $_POST['descripcion'];
            $title = $_POST['esp_title'];
            $estilo = $_POST['esp_estilo'];
            $cedula = $_SESSION['usuario']->getNumero_doc();
            $espacio = new Espacio_Agenda();
            $espacio->getCampos($_POST);
            $espacio->setDescripcion_cita($descripcion);
            $espacio->setCedula_cliente($cedula);
            $espacio->setId_espacio($id_espacio);
            $espacio->setTitle($title);
            $espacio->setId_estilo_cita($estilo);
            $id_tatuador = $_POST['id_tatuador'];
            $correoTatuador = $this->usuarioDAO->buscarCorreoId($id_tatuador);
            if ($this->espacio_agendaDAO->insertarSolicitudReserva($descripcion, $cedula, $title, $estilo, $id_espacio)) {
                $datosReserva = $this->usuarioDAO->consultarReservaID($id_espacio);
                if (!empty($datosReserva)) {
                    foreach ($datosReserva as $reserva) {
                        $destinatario = $correoTatuador['0']['correo'];
                        $asunto = "TOOINK - Ha recibido una nueva solicitud de reserva.";
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
                                                <td style="background:#fb9678; padding:20px; color:#fff; text-align:center;"> Tienes una nueva reserva pendiente. </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div style="padding: 40px; background: #fff;">
                                        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                            <tbody>
                                                <tr>
                                                    <td>Tienes una reserva para el dia y hora ' . $reserva->start . ', te recordamos ingresar al sistema para aceptarla o denegarla..<br></br>
                                                        <br><b>- Servicio de notificación Tooink.</b><br></br>
                                                        <p>Por favor no dar respuesta a este mensaje.</p></td>
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
                    header('Location: ' . CLIENTE_PERFIL_TATUADOR['url'] . "?id_usuario=$id_tatuador&r=1");
                }
            }
        } else {
            header('Location: ' . PERFIL_TATUADOR['url'] . "?id_usuario=$id_tatuador2&r=0");
        }
    }

    public function votarImagen() {
        $id_tatuador = $_GET['id_tatuador'];
        if ($_SESSION != null || !empty($_SESSION)) {
            $id_usuario = $_SESSION['usuario']->getId_usuario();
            $id_foto = $_GET['id_foto'];
            $consultaVotos = $this->votosDAO->consultarVoto($id_foto, $id_usuario);
            if ($consultaVotos == null || empty($consultaVotos)) {
                $usuario = new Usuario();
                $usuario->getCampos($_POST);
                $this->votosDAO->insertarVoto($id_foto, $id_usuario);
                header('Location: ' . CLIENTE_PERFIL_TATUADOR['url'] . "?id_usuario=$id_tatuador&r=4");
            } else {
                header('Location: ' . CLIENTE_PERFIL_TATUADOR['url'] . "?id_usuario=$id_tatuador&r=2");
            }
        } else {
            header('Location: ' . PERFIL_TATUADOR['url'] . "?id_usuario=$id_tatuador&r=3");
        }
    }

    public function indexInformacion() {
        $id_usuario = $_SESSION['usuario']->getId_usuario();
        $usuario = new Usuario();
        $usuario->getCampos($_POST);
        $contacto_usuario = new Contacto_Usuario();
        $contacto_usuario->getCampos($_POST);
        $lista = $this->usuarioDAO->consultarIdPerfil($id_usuario);
        $listaContacto = $this->contacto_usuarioDAO->consultarContactos($id_usuario);
        include RUTA_PRINCIPAL . './vista/informacionCliente.php';
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

            // MODIFICAR CONTACTO
            $listaContactos = $_POST['con_descripcion_contacto'];
            for ($i = 0; $i < count($listaContactos); $i++) {
                $id_contacto_e = $_POST['con_id_contacto'][$i];
                $contacto_editar = $_POST['con_descripcion_contacto'][$i];
                $contacto_usuario = new Contacto_Usuario();
                $contacto_usuario->setDescripcion_contacto($contacto_editar);
                $this->contacto_usuarioDAO->modificarContacto($id_contacto_e, $contacto_editar);
            }

            $this->cnn->commit();
            header('Location: ' . CLIENTE_INFORMACION['url'] . "?r=4");
        } catch (Exception $e) {
            $this->cnn->rollBack();
            header('Location: ' . CLIENTE_INFORMACION['url'] . "?r=5");
        }
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
            header('Location: ' . CLIENTE_INFORMACION['url'] . "?r=10");
        } else {
            header('Location: ' . CLIENTE_INFORMACION['url'] . "?r=11");
        }
    }

}
