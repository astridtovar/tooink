<?php

namespace control;

use control\generico\GenericoControl;
use modelo\dao\Contacto_UsuarioDAO;
use modelo\dao\TipoDocDAO;
use modelo\dao\UsuarioDAO;
use modelo\vo\Contacto_Usuario;
use modelo\vo\Tipo_Doc;
use modelo\vo\Usuario;
use const RUTA_PRINCIPAL;

class AdminControl extends GenericoControl {

    private $usuarioDAO;
    private $tipoDocDAO;
    private $contacto_usuarioDAO;

    public function __construct(&$cnn) {
        parent::__construct($cnn);
        parent::validarSesion();
        $this->usuarioDAO = new UsuarioDAO($cnn);
        $this->tipoDocDAO = new TipoDocDAO($cnn);
        $this->contacto_usuarioDAO = new Contacto_UsuarioDAO($cnn);
    }

    public function index() {
        $id_usuario = $_SESSION['usuario']->getId_usuario();
        $usuario = new Usuario();
        $usuario->getCampos($_POST);
        $lista = $this->usuarioDAO->consultarIdPerfil($id_usuario);
        $listaRoles = $this->usuarioDAO->consultarRoles();
        $listaDoc = $this->usuarioDAO->consultarTiposDoc();
        include RUTA_PRINCIPAL . './vista/registrarusuario2.php';
    }

    public function registrarUsuario() {
        $id_usuario = $_SESSION['usuario']->getId_usuario();
        $usuario = new Usuario();
        $usuario->getCampos($_POST);
        $lista = $this->usuarioDAO->consultarIdPerfil($id_usuario);
        $listaRoles = $this->usuarioDAO->consultarRoles();
        $listaDoc = $this->usuarioDAO->consultarTiposDoc();
        include RUTA_PRINCIPAL . './vista/registrarusuario2.php';
    }

    public function consultarUsuario() {
        $id_usuario = $_SESSION['usuario']->getId_usuario();
        $usuario = new Usuario();
        $usuario->getCampos($_POST);
        $lista = $this->usuarioDAO->consultarIdPerfil($id_usuario);
        include RUTA_PRINCIPAL . './vista/consultarusuarios2.php';
    }

    public function guardarUsuario() {
        $correo = $_POST['usu_correo'];
        $contacto = $_POST['con_descripcion_contacto'];
        $consultaCorreo = $this->usuarioDAO->consultarCuenta($correo);
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
                    header('Location:' . ADMINISTRADOR_PRINCIPAL['url'] . "?r=4");
                }
            }
        } else {
            header('Location:' . ADMINISTRADOR_PRINCIPAL['url'] . "?r=5");
        }
    }

    public function ConsultarUsuarios() {
        $id_usuario = $_SESSION['usuario']->getId_usuario();
        $usuario = new Usuario();
        $usuario->getCampos($_POST);
        $tipoDoc = new Tipo_Doc();
        $tipoDoc->getCampos($_POST);
        $lista = $this->usuarioDAO->consultarIdPerfil($id_usuario);
        $listaUsuarios = $this->usuarioDAO->consultarUsuarios();
        include RUTA_PRINCIPAL . './vista/consultarusuarios2.php';
    }

    public function activarUsuario() {
        $correo = $_GET['correo'];
        if ($this->usuarioDAO->activarCuenta($correo)) {
            $destinatario = $correo;
            $asunto = "TOOINK - Su cuenta ha sido desbloqueada.";
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
                                                <td style="background:#fb9678; padding:20px; color:#fff; text-align:center;"> Han desbloqueado tu cuenta. </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div style="padding: 40px; background: #fff;">
                                        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                            <tbody>
                                                <tr>
                                                    <td>Tu cuenta para ingresar ha nuestro sistema ha sido desbloqueada. Ahora puedes iniciar sesión nuevamente.<br></br>
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
            header('Location:' . ADMINISTRADOR_CONSULTA['url'] . "?r=1");
        } else {
            header('Location:' . ADMINISTRADOR_CONSULTA['url'] . "?r=2");
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
        include RUTA_PRINCIPAL . './vista/informacionAdministrador.php';
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
            header('Location: ' . ADMINISTRADOR_INFORMACION['url'] . "?r=4");
        } catch (Exception $e) {
            $this->cnn->rollBack();
            header('Location: ' . ADMINISTRADOR_INFORMACION['url'] . "?r=5");
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
            header('Location: ' . ADMINISTRADOR_INFORMACION['url'] . "?r=10");
        } else {
            header('Location: ' . ADMINISTRADOR_INFORMACION['url'] . "?r=11");
        }
    }
}
