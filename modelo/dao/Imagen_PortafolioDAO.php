<?php

namespace modelo\dao;

use modelo\generico\GenericoDAO;
use PDO;

class Imagen_PortafolioDAO extends GenericoDAO{
    
    public function __construct(&$cnn) {
        parent::__construct($cnn, 'imagen_portafolio');
    }
    
    public function consultarTrabajos($id_usuario) {
        $id_usuario = $_SESSION['usuario']->getId_usuario();
        $sentencia = $this->cnn->prepare("SELECT * FROM imagen_portafolio WHERE id_usuario = :id_usuario AND id_estado_img = 1");
        $sentencia->execute(array('id_usuario' => $id_usuario));
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }
    
    public function eliminarTrabajoPortafolio($id_imagen) {
        $sentencia = $this->cnn->prepare("UPDATE imagen_portafolio SET id_estado_img = 2 WHERE id_imagen = :id_imagen");
        return $sentencia->execute(array('id_imagen' => $id_imagen));
    }
    
    public function consultarTrabajosParaClientes($id_usuario) {
        $sentencia = $this->cnn->prepare("SELECT * FROM imagen_portafolio WHERE id_usuario = :id_usuario AND restriccion_edad = 'No' AND id_estado_img = 1");
        $sentencia->execute(array('id_usuario' => $id_usuario));
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }
    
}
