<?php

namespace control;

use control\generico\GenericoControl;
use modelo\dao\AgendaTatuadorDAO;
use modelo\dao\Espacio_AgendaDAO;
use modelo\vo\AgendaTatuador;
use modelo\vo\Espacio_Agenda;

class AgendaControl extends GenericoControl{
    
    private $espacio_agendaDAO;
    private $agenda_tatuadorDAO;


    public function __construct(&$cnn) {
        parent::__construct($cnn);
        parent::validarSesion();
        $this->espacio_agendaDAO = new Espacio_AgendaDAO($cnn);
        $this->agenda_tatuadorDAO = new AgendaTatuadorDAO($cnn);
    }
    
    public function consultarAgenda() {
        $id_usuario = $_SESSION['usuario']->getId_usuario();
        $agendaTatuador = new AgendaTatuador();
        $agendaTatuador->getCampos($_POST);
        $this->agenda_tatuadorDAO->consultarAgenda($id_usuario);
    }
    
    public function consultarEspaciosAgenda() {
        $espacio_agenda = new Espacio_Agenda();
        $espacio_agenda->getCampos($_POST);
        $this->espacio_agendaDAO->consultarEspacios();
    }
    
    public function consultarEventos(){
        $id_usuario = $_SESSION['usuario']->getId_usuario();
        return $consulta = $this->espacio_agendaDAO->consultarEventos($id_usuario);
    }
    
}
