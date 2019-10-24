<?php

namespace modelo\dao;

use modelo\generico\GenericoDAO;
use PDO;

class CitaDAO extends GenericoDAO{
    
    public function __construct(&$cnn) {
        parent::__construct($cnn, 'cita');
    }
    
    public function consultarEventos($id_usuario) {
        $sentencia = $this->cnn->prepare("SELECT * FROM cita C INNER JOIN espacio_agenda E ON C.id_espacio = E.id_espacio WHERE id_usuario = :id_usuario");
        $sentencia->execute(array('id_usuario' => $id_usuario));
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return json_encode($consulta);
    }
    
    public function modificarEvento($start, $descripcion, $id_cita) {
        $sentencia = $this->cnn->prepare("UPDATE cita SET start = :start, descripcion_cita = :descripcion_cita WHERE id_cita = :id_cita");
        return $sentencia->execute(array('start' => $start, 'descripcion_cita' => $descripcion, 'id_cita' => $id_cita));
    }
    
    public function cancelarEvento($id_cita) {
        $sentencia = $this->cnn->prepare("UPDATE cita SET id_estado = 6 WHERE id_cita = :id_cita");
        return $sentencia->execute(array('id_cita' => $id_cita));
    }
}
