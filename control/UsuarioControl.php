<?php

namespace control;

use control\generico\GenericoControl;
use modelo\dao\Contacto_UsuarioDAO;
use modelo\dao\Estilo_UsuarioDAO;
use modelo\dao\Imagen_PortafolioDAO;
use modelo\dao\UsuarioDAO;
use modelo\dao\VotosDAO;
use modelo\vo\Contacto_Usuario;
use modelo\vo\Estilo;
use modelo\vo\Estilo_Usuario;
use modelo\vo\Imagen_Portafolio;
use modelo\vo\Usuario;
use const RUTA_PRINCIPAL;
use const URL_PRINCIPAL;

class UsuarioControl extends GenericoControl {

    private $usuarioDAO;
    private $contacto_usuarioDAO;
    private $estilo_usuarioDAO;
    private $imagen_portafolioDAO;
    private $votosDAO;

    public function __construct(&$cnn) {
        parent::__construct($cnn);
        $this->usuarioDAO = new UsuarioDAO($cnn);
        $this->contacto_usuarioDAO = new Contacto_UsuarioDAO($cnn);
        $this->estilo_usuarioDAO = new Estilo_UsuarioDAO($cnn);
        $this->imagen_portafolioDAO = new Imagen_PortafolioDAO($cnn);
        $this->votosDAO = new VotosDAO($cnn);
    }

    public function iniciarSesion() {
        include RUTA_PRINCIPAL . './vista/iniciarsesion2.php';
    }

    public function autenticar() {
        if (isset($_POST['intento'])) {
            $intento = $_POST['intento'];
        } else {
            $intento = 1;
        }
        $correo = $_POST['usu_correo'];
        $clave = $_POST['usu_clave'];
        $claveEncrip = md5($clave);
        $usuario = $this->usuarioDAO->autenticar($correo, $claveEncrip);
        if (is_null($usuario)) {
            if ($intento == 2) {
                $intento++;
                session_destroy();
                header('Location:' . INICIAR_SESION['url'] . "?r=4&i=" . $intento);
            } else if ($intento > 2) {
                session_destroy();
                $this->usuarioDAO->bloquearCuenta($correo);
                $destinatario = $correo;
                $asunto = "TOOINK - Su cuenta ha sido bloqueada.";
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
                                                <td style="background:#fb9678; padding:20px; color:#fff; text-align:center;"> Su cuenta ha sido bloqueada. </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div style="padding: 40px; background: #fff;">
                                        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                            <tbody>
                                                <tr>
                                                    <td>Se le informa que su cuenta ha sido temporalmente bloqueda ya que se supero el número de intentos erroneos al momento de iniciar sesión. 
                                                    Para activar de nuevo su cuenta por favor comuniquese directamente con el administrador.<br></br>
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
                if (mail($destinatario, $asunto, $cuerpo, $headers)) {
                    header('Location:' . INICIAR_SESION['url'] . "?r=5&i=" . 1);
                }
            } else {
                $intento++;
                session_destroy();
                header('Location:' . INICIAR_SESION['url'] . "?r=0&i=" . $intento);
            }
        } else if ($usuario->getId_estado() == 9) {
            header('Location:' . INICIAR_SESION['url'] . "?r=6&i=" . $intento);
            return;
        }
        if (isset($_POST['usu_recordarme'])) {
            $json = json_encode($usuario->getCampos());
            setcookie('usuario', $json, time() + (60 * 60 * 24 * 365), URL_PRINCIPAL);
        }
        $_SESSION['usuario'] = $usuario;
        if ($_SESSION['usuario']->getId_rol() == 1) {
            header('Location:' . ADMINISTRADOR_PRINCIPAL['url']);
            return;
        }
        if ($_SESSION['usuario']->getId_rol() == 2) {
            header('Location:' . TATUADOR_PRINCIPAL['url']);
            return;
        }
        if ($_SESSION['usuario']->getId_rol() == 3) {
            header('Location:' . CLIENTE_PRINCIPAL['url']);
            return;
        }
    }

    public function cambiarClaveModal() {
        $id_usuario = $_SESSION['usuario']->getId_usuario();
        $usuario = new Usuario();
        $usuario->getCampos($_POST);
        $lista = $this->usuarioDAO->consultarIdPerfil($id_usuario);
        include RUTA_PRINCIPAL . './vista/cambiarcontrasena2.php';
    }

    public function cambiarClaveTatuador() {
        $id_usuario = $_SESSION['usuario']->getId_usuario();
        $usuario = new Usuario();
        $usuario->getCampos($_POST);
        $lista = $this->usuarioDAO->consultarIdPerfil($id_usuario);
        include RUTA_PRINCIPAL . './vista/cambiarContrasenaTatuador.php';
    }

    public function cambiarClaveCliente() {
        $id_usuario = $_SESSION['usuario']->getId_usuario();
        $usuario = new Usuario();
        $usuario->getCampos($_POST);
        $lista = $this->usuarioDAO->consultarIdPerfil($id_usuario);
        include RUTA_PRINCIPAL . './vista/cambiarContrasenaCliente.php';
    }

    public function cambiarClave() {
        $id_usuario = $_SESSION['usuario']->getId_usuario();
        $clave_ant = $_POST['clave_ant'];
        $clave_ing = md5($_POST['clave_ing']);
        $clave_nue = $_POST['clave_nueva'];
        $clave_conf = $_POST['clave_conf'];
        if ($clave_ant == $clave_ing) {
            if ($clave_nue == $clave_conf) {
                $usuario = new Usuario();
                $clave = md5($clave_nue);
                $usuario->setClave($clave);
                $this->usuarioDAO->cambiarContrasena($id_usuario, $clave);
                if ($_SESSION['usuario']->getId_rol() == 1) {
                    header('Location:' . CAMBIAR_CLAVE_MODAL['url'] . "?r=1");
                    return;
                }
                if ($_SESSION['usuario']->getId_rol() == 2) {
                    header('Location:' . CAMBIAR_CLAVE_TATUADOR['url'] . "?r=1");
                    return;
                }
                if ($_SESSION['usuario']->getId_rol() == 3) {
                    header('Location:' . CAMBIAR_CLAVE_CLIENTE['url'] . "?r=1");
                    return;
                }
            } else {
                if ($_SESSION['usuario']->getId_rol() == 1) {
                    header('Location:' . CAMBIAR_CLAVE_MODAL['url'] . "?r=3");
                    return;
                }
                if ($_SESSION['usuario']->getId_rol() == 2) {
                    header('Location:' . CAMBIAR_CLAVE_TATUADOR['url'] . "?r=3");
                    return;
                }
                if ($_SESSION['usuario']->getId_rol() == 3) {
                    header('Location:' . CAMBIAR_CLAVE_CLIENTE['url'] . "?r=3");
                    return;
                }
            }
        } else {
            if ($_SESSION['usuario']->getId_rol() == 1) {
                header('Location:' . CAMBIAR_CLAVE_MODAL['url'] . "?r=2");
                return;
            }
            if ($_SESSION['usuario']->getId_rol() == 2) {
                header('Location:' . CAMBIAR_CLAVE_TATUADOR['url'] . "?r=2");
                return;
            }
            if ($_SESSION['usuario']->getId_rol() == 3) {
                header('Location:' . CAMBIAR_CLAVE_CLIENTE['url'] . "?r=2");
                return;
            }
        }
    }

    public function reestablecerClaveIndex() {
        include RUTA_PRINCIPAL . './vista/reestablecerClave2.php';
    }

    function generarPass($length = 8) {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

    public function reestablecerClave() {
        $correo = $_POST['correo'];
        $consulta = $this->usuarioDAO->buscarCorreo($correo);
        if ($consulta != null || !empty($consulta)) {
            $claveNueva = $this->generarPass();
            $claveNuevaEncrip = md5($claveNueva);
            $this->usuarioDAO->reestablecerContrasena($correo, $claveNuevaEncrip);
            $destinatario = $correo;
            $asunto = "Reestablecimiento de Contraseña Cuenta Tooink.";
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
                                                <td style="background:#fb9678; padding:20px; color:#fff; text-align:center;"> Su contraseña se ha reestablecido. </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div style="padding: 40px; background: #fff;">
                                        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                            <tbody>
                                                <tr>
                                                    <td>Recientemente has solicitado el reestablecimiento de tu contraseña, hemos generado una aleatoria para ti.
                                                    Esta es tu nueva contraseña: ' . $claveNueva . ' No olvides que debes cambiarla nuevamente al iniciar sesión.<br></br>
                                                        <br><b>- Servicio de notificación Tooink.</b><br></br>
                                                        <p>Por favor no dar respuesta a este mensaje. En caso de que no haya solicitado el reestablecimiento de su contraseña haga caso omiso a este mensaje.</p></td>
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
            header('Location:' . REESTABLECER_CLAVE_INDEX['url'] . "?r=1");
        } else {
            header('Location:' . REESTABLECER_CLAVE_INDEX['url'] . "?r=0");
        }
    }

    public function directorioTatuadores() {
        if (empty($_POST['busqueda']) || empty($_POST['busqueda'])) {
            $usuario = new Usuario();
            $usuario->getCampos($_POST);
            $idUsuario = $usuario->getId_usuario();
            $estilo = new Estilo();
            $estilo->getCampos($_POST);
            $listaEstilo = $this->usuarioDAO->consultarEstilo($idUsuario);
            $lista = $this->usuarioDAO->consultarTatuador();
            include RUTA_PRINCIPAL . './vista/directoriotatuadores.php';
        } else {
            $busqueda = $_POST['busqueda'];
            $palabraBusqueda = $_POST['palabraBusqueda'];
            $usuario = new Usuario();
            $usuario->getCampos($_POST);
            $idUsuario = $usuario->getId_usuario();
            $estilo = new Estilo();
            $estilo->getCampos($_POST);
            $listaEstilo = $this->usuarioDAO->consultarEstilo($idUsuario);
            $lista = $this->usuarioDAO->consultarPor($busqueda, $palabraBusqueda);
            include RUTA_PRINCIPAL . './vista/directoriotatuadores.php';
        }
    }

    public function desvio() {
        include RUTA_PRINCIPAL . './vista/desvio2.php';
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
        $ranking = $this->votosDAO->consultarParaRanking($id_usuario);
        $id_foto = $ranking['id_foto'];
        $imagenRanking = $this->votosDAO->buscarRanking($id_foto);
        include RUTA_PRINCIPAL . './vista/perfilTatuadorCliente2.php';
    }

    public function cerrarSesion() {
        setcookie('usuario', NULL, -1, INICIAR_SESION['url']);
        session_destroy();
        header('Location:' . INICIAR_SESION['url']);
    }

}
