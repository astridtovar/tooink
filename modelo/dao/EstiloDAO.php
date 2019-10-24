<?php

namespace modelo\dao;

use modelo\generico\GenericoDAO;
use PDO;

class EstiloDAO extends GenericoDAO {

    public function __construct(&$cnn) {
        parent::__construct($cnn, 'estilo');
    }

    public function consultarEstilos() {
        $sentencia = $this->cnn->prepare("SELECT * FROM estilo");
        $sentencia->execute();
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }

}
