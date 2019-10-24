<?php

namespace control;

use control\generico\GenericoControl;
use modelo\dao\CitaDAO;
use modelo\vo\Cita;

class CitaControl extends GenericoControl {

    private $citaDAO;

    public function __construct(&$cnn) {
        parent::__construct($cnn);
        parent::validarSesion();
        $this->citaDAO = new CitaDAO($cnn);
    }
    
    public function consultarEventos() {
        $cita = new Cita();
        $cita->getCampos($_POST);
        $lista = $this->citaDAO->consultarEventos();
        include_once RUTA_PRINCIPAL . 'vista/perfilTatuadorAgenda.php';
    }

}
