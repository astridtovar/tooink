<?php

namespace modelo\dao;

use modelo\generico\GenericoDAO;

class AgendaTatuadorDAO extends GenericoDAO{
    
    public function __construct(&$cnn) {
        parent::__construct($cnn, 'agenda_tatuador');
    }
    
    public function consultarAgenda($id_usuario) {
        $sentencia = $this->cnn->prepare("SELECT * FROM agenda_tatuador WHERE id_usuario = :id_usuario");
        $sentencia->execute(array('id_usuario' => $id_usuario));
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return json_encode($consulta);
    }
    
}
