<?php

namespace modelo\vo;

use modelo\generico\IEntidad;

class AgendaTatuador implements IEntidad{
    
    private $id_agenda;
    private $id_usuario;
    private $start;
    private $end;
    private $id_estado;
    
    function getId_agenda() {
        return $this->id_agenda;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }

    function getStart() {
        return $this->start;
    }

    function getEnd() {
        return $this->end;
    }

    function getId_estado() {
        return $this->id_estado;
    }

    function setId_agenda($id_agenda) {
        $this->id_agenda = $id_agenda;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function setStart($start) {
        $this->start = $start;
    }

    function setEnd($end) {
        $this->end = $end;
    }

    function setId_estado($id_estado) {
        $this->id_estado = $id_estado;
    }

    public function getCampos() {
        $lista = get_object_vars($this);
        return $lista;
    }

    public function convertir(array $info, $alias = true) {
        $atributos = get_object_vars($this);
        $lista = array_keys($atributos);
        $sigla = ($alias) ? 'age_' : '';
        foreach ($lista as $campo) {
            if (isset($info[$sigla . $campo])) {
                $this->$campo = $info[$sigla . $campo];
            }
        }
    }
    
}
