<?php
namespace modelo\dao;

use modelo\generico\GenericoDAO;
use PDO;

class Estilo_UsuarioDAO extends GenericoDAO{
    
    public function __construct(&$cnn) {
        parent::__construct($cnn, 'estilo_usuario');
    }
    
    public function insertarEstilo($id_usuario, $id_estilo, $experiencia) {
        $sentencia = $this->cnn->prepare("INSERT INTO estilo_usuario (id_estilo, id_usuario, anos_experiencia)"
                . "VALUES (:id_estilo, :id_usuario, :anos_experiencia)");
        return $sentencia->execute(array('id_estilo' => $id_estilo, 'id_usuario' => $id_usuario, 'anos_experiencia' => $experiencia));
    }
    
    public function consultarEstilo_Usuario($id_usuario) {
        $id_usuario = $_SESSION['usuario']->getId_usuario();
        $sentencia = $this->cnn->prepare("SELECT * FROM estilo_usuario ES INNER JOIN estilo E ON ES.id_estilo = E.id_estilo WHERE id_usuario = :id_usuario");
        $sentencia->execute(array('id_usuario' => $id_usuario));
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }
    
    public function consultarEstiloParaClientes($id_usuario) {
        $sentencia = $this->cnn->prepare("SELECT * FROM estilo_usuario ES INNER JOIN estilo E ON ES.id_estilo = E.id_estilo WHERE id_usuario = :id_usuario");
        $sentencia->execute(array('id_usuario' => $id_usuario));
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }
    
    public function eliminarEstilo($id_estilo_usuario) {
        $sentencia = $this->cnn->prepare("DELETE FROM estilo_usuario WHERE id_estilo_usuario = :id_estilo_usuario");
        return $sentencia->execute(array('id_estilo_usuario' => $id_estilo_usuario));
    }
    
    public function modificarExperiencia($id_estilo_usuario, $anos_experiencia) {
        $sentencia = $this->cnn->prepare("UPDATE estilo_usuario SET anos_experiencia = :anos_expe WHERE id_estilo_usuario = :id_estilo_usu");
        return $sentencia->execute(array('anos_expe' => $anos_experiencia, 'id_estilo_usu' => $id_estilo_usuario));
    }
    
}
