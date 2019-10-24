<?php

namespace control\generico;

use PDO;

abstract class GenericoControl {

    /**
     *
     * @var PDO
     */
    protected $cnn;

    public function __construct(&$cnn) {
        $this->cnn = $cnn;
        session_start();
    }

    public function validarSesion() {
        if (!isset($_SESSION['usuario'])) {
            header('Location:' . DIRECTORIO_TATUADORES['url']);
        }
    }

}
