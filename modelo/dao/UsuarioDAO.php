<?php

namespace modelo\dao;

use modelo\generico\GenericoDAO;
use modelo\vo\Usuario;
use PDO;

class UsuarioDAO extends GenericoDAO {

    public function __construct(&$cnn) {
        parent::__construct($cnn, 'usuario');
    }

    /**
     * 
     * @param type $correo
     * @param type $clave
     * @return Usuario
     */
    public function autenticar($correo, $clave) {
        $sentencia = $this->cnn->prepare('SELECT * FROM usuario WHERE correo = :correo AND clave = :clave');
        $sentencia->execute(array('correo' => $correo, 'clave' => $clave));
        $resultado = $sentencia->fetchAll();
        if (empty($resultado)) {
            return null;
        }
        $registro = $resultado[0];
        $usuario = new Usuario();
        $usuario->convertir($registro, false);
        return $usuario;
    }

    public function consultarCuenta($correo) {
        $sentencia = $this->cnn->prepare("SELECT * FROM usuario WHERE correo = :correo");
        $sentencia->execute(array('correo' => $correo));
        $resultado = $sentencia->fetchAll();
        if (empty($resultado)) {
            return null;
        }
        return $resultado;
    }
    
    public function consultarCuentaDocumento($documento) {
        $sentencia = $this->cnn->prepare("SELECT * FROM usuario WHERE numero_doc = :numero_doc");
        $sentencia->execute(array('numero_doc' => $documento));
        $resultado = $sentencia->fetchAll();
        if (empty($resultado)) {
            return null;
        }
        return $resultado;
    }

    public function consultarTatuador() {
        $sentencia = $this->cnn->prepare("SELECT * FROM usuario WHERE id_rol = 2 ORDER BY nombre");
        $sentencia->execute();
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }
    
    public function consultarCliente() {
        $sentencia = $this->cnn->prepare("SELECT * FROM usuario WHERE id_rol = 3");
        $sentencia->execute();
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }

    public function consultarEstilo($id_usuario) {
        $sentencia = $this->cnn->prepare("SELECT * FROM estilo E INNER JOIN estilo_usuario EU ON EU.id_estilo = E.id_estilo WHERE id_usuario = :idUsuario");
        $sentencia->execute(array('idUsuario' => $id_usuario));
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }

    public function consultarTatuadorId($id_usuario) {
        $id_usuario = $_GET['id_usuario'];
        $sentencia = $this->cnn->prepare("SELECT * FROM usuario WHERE id_usuario = :id_usuario");
        $sentencia->execute(array('id_usuario' => $id_usuario));
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }

    public function consultarPor($busqueda, $palabraBusqueda) {
        $busqueda = $_POST['busqueda'];
        $palabraBusqueda = $_POST['palabraBusqueda'];
        if ($busqueda == 'nombre_artista') {
            $nombre = $palabraBusqueda;
            $sentencia = $this->cnn->prepare("SELECT * FROM usuario WHERE id_rol = 2 AND UPPER (nombre) LIKE UPPER ('%$nombre%') AND id_estado = 1 OR id_rol = 2 AND UPPER (apellido) LIKE UPPER ('%$nombre%') AND id_estado = 1");
            $sentencia->execute();
            $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
            return $consulta;
        }
        $descripcion = $palabraBusqueda;
        $sentencia = $this->cnn->prepare("SELECT * FROM usuario U INNER JOIN estilo_usuario E ON U.id_usuario = E.id_usuario INNER JOIN estilo ES ON E.id_estilo = ES.id_estilo WHERE UPPER (descripcion) LIKE UPPER ('%$descripcion%') AND id_estado = 1");
        $sentencia->execute();
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }

    public function consultarIdPerfil($id_usuario) {
        $id_usuario = $_SESSION['usuario']->getId_usuario();
        $sentencia = $this->cnn->prepare("SELECT * FROM usuario WHERE id_usuario = $id_usuario");
        $sentencia->execute();
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }

    public function modificarInformacionTatuador($nombre, $apellido, $correo, $nombre_artistico, $id_usuario) {
        $sentencia = $this->cnn->prepare('UPDATE usuario SET nombre = :nombre, apellido = :apellido, correo = :correo,'
                . 'nombre_artistico = :nombre_artistico WHERE id_usuario = :id_usuario');
        return $sentencia->execute(array('nombre' => $nombre, 'apellido' => $apellido, 'correo' => $correo, 'nombre_artistico' => $nombre_artistico, 'id_usuario' => $id_usuario));
    }
    
    public function modificarFotoPerfil($id_usuario, $foto_perfil) {
        $sentencia = $this->cnn->prepare("UPDATE usuario SET foto_perfil = :foto_perfil WHERE id_usuario = :id_usuario");
        return $sentencia->execute(array('foto_perfil' => $foto_perfil, 'id_usuario' => $id_usuario));
    }
    
    public function consultarTiposDoc() {
        $sentencia = $this->cnn->prepare('SELECT * FROM tipo_doc');
        $sentencia->execute();
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }
    
    public function consultarRoles() {
        $sentencia = $this->cnn->prepare('SELECT * FROM rol');
        $sentencia->execute();
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }
    
    public function buscarCliente($numeroDoc){
        $sentencia = $this->cnn->prepare("SELECT * FROM usuario WHERE numero_doc = :numero_doc");
        $sentencia->execute(array('numero_doc' => $numeroDoc));
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }
    
    public function consultarUsuarios() {
        $sentencia = $this->cnn->prepare("SELECT * FROM rol R INNER JOIN  usuario U ON R.id_rol = U.id_rol INNER JOIN estado E ON U.id_estado = E.id_estado");
        $sentencia->execute();
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }
    
    public function consultarCitas($cedula, $dateA) {
        $sentencia = $this->cnn->prepare("SELECT * FROM espacio_agenda C INNER JOIN usuario U ON C.cedula_cliente = U.numero_doc INNER JOIN estado E ON U.id_estado = E.id_estado WHERE numero_doc = :cedula AND C.id_estado != 6 AND C.id_estado != 8 AND start > :start");
        $sentencia->execute(array('cedula' => $cedula, 'start' => $dateA));
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }
    
    public function consultarReservas($id_usuario, $dateA) {
        $sentencia = $this->cnn->prepare("SELECT * FROM espacio_agenda INNER JOIN estilo ON espacio_agenda.id_estilo_cita = estilo.id_estilo WHERE id_usuario = :id_usuario AND id_estado = 8 AND start > :start");
        $sentencia->execute(array('id_usuario' => $id_usuario, 'start' => $dateA));
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }
    
    public function consultarReservaID($id_espacio) {
        $sentencia = $this->cnn->prepare("SELECT * FROM espacio_agenda WHERE id_espacio = :id_espacio");
        $sentencia->execute(array('id_espacio' => $id_espacio));
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }
    
    public function cambiarContrasena($id_usuario, $clave) {
        $sentencia = $this->cnn->prepare("UPDATE usuario SET clave = :clave WHERE id_usuario = :id_usuario");
        return $sentencia->execute(array('clave' => $clave, 'id_usuario' => $id_usuario));
    }
    
    public function buscarCorreo($correo) {
        $sentencia = $this->cnn->prepare("SELECT * FROM usuario WHERE correo = :correo");
        $sentencia->execute(array('correo' => $correo));
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }
    
    public function buscarCorreoId($id_usuario) {
        $sentencia = $this->cnn->prepare("SELECT correo FROM usuario WHERE id_usuario = :id_usuario");
        $sentencia->execute(array('id_usuario' => $id_usuario));
        $consulta = $sentencia->fetchAll();
        return $consulta;
    }
    
    public function reestablecerContrasena($correo, $clave) {
        $sentencia = $this->cnn->prepare("UPDATE usuario SET clave = :clave WHERE correo = :correo");
        return $sentencia->execute(array('clave' => $clave, 'correo' => $correo));
    }
    
    public function buscarCorreoPorCedula($numero_doc) {
        $sentencia = $this->cnn->prepare("SELECT * FROM usuario WHERE numero_doc = :numero_doc");
        $sentencia->execute(array('numero_doc' => $numero_doc));
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }
    
    public function bloquearCuenta($correo) {
        $sentencia = $this->cnn->prepare("UPDATE usuario SET id_estado = 9 WHERE correo = :correo");
        return $sentencia->execute(array('correo' => $correo));
    }
    
    public function activarCuenta($correo) {
        $sentencia = $this->cnn->prepare("UPDATE usuario SET id_estado = 1 WHERE correo = :correo");
        return $sentencia->execute(array('correo' => $correo));
    }
}
