<?php

namespace modelo\dao;

use modelo\generico\GenericoDAO;
use PDO;

class Contacto_UsuarioDAO extends GenericoDAO {

    public function __construct(&$cnn) {
        parent::__construct($cnn, 'contacto_usuario');
    }

    public function insertarContacto($id_usuario, $descripcion_contacto) {
        $sentencia = $this->cnn->prepare("INSERT INTO contacto_usuario (id_usuario, descripcion_contacto) VALUES (:id_usuario, :descripcion_contacto)");
        return $sentencia->execute(array('id_usuario' => $id_usuario, 'descripcion_contacto' => $descripcion_contacto));
    }

    public function consultarContactos($id_usuario) {
        $id_usuario = $_SESSION['usuario']->getId_usuario();
        $sentencia = $this->cnn->prepare("SELECT * FROM contacto_usuario WHERE id_usuario = :id_usuario");
        $sentencia->execute(array('id_usuario' => $id_usuario));
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }
    
    public function modificarContacto($id_contacto, $descripcion_cont) {
        $sentencia = $this->cnn->prepare("UPDATE contacto_usuario SET descripcion_contacto = :descripcion_contacto WHERE id_contacto = :id_contacto");
        return $sentencia->execute(array('descripcion_contacto' => $descripcion_cont, 'id_contacto' => $id_contacto));
    }

    public function contactosTatuador($id_cont, $id_usuario, $descripcion_cont) {
        $sentencia = $this->cnn->prepare("SELECT AdministrarCont(:id_contacto, :id_usuario, :descripcion_cont)");
        return $sentencia->execute(array('id_contacto' => $id_cont, 'id_usuario' => $id_usuario, 'descripcion_cont' => $descripcion_cont));
    }

    public function eliminarContacto($id_contacto) {
        $sentencia = $this->cnn->prepare("DELETE FROM contacto_usuario WHERE id_contacto = :id_contacto");
        return $sentencia->execute(array('id_contacto' => $id_contacto));
    }

    public function consultarContactosParaCliente($id_usuario) {
        $sentencia = $this->cnn->prepare("SELECT * FROM contacto_usuario WHERE id_usuario = :id_usuario");
        $sentencia->execute(array('id_usuario' => $id_usuario));
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }

}
