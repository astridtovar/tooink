<?php

namespace modelo\dao;

use modelo\generico\GenericoDAO;
use PDO;

class TipoDocDAO extends GenericoDAO{
    
    public function __construct(&$cnn) {
        parent::__construct($cnn, 'tipo_doc');
    }
    
    public function consultarTiposDoc() {
        $sentencia = $this->cnn->prepare("SELECT * FROM tipo_doc");
        $sentencia->execute();
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }
    
}
