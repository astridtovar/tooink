<?php

namespace modelo\vo;

use modelo\generico\IEntidad;

class Cita implements IEntidad {

    private $id_cita;
    private $id_espacio;
    private $descripcion_cita;
    private $id_estado;
    private $cedula_cliente;
    private $title;
    private $start;
    private $end;

    function getId_cita() {
        return $this->id_cita;
    }

    function getId_espacio() {
        return $this->id_espacio;
    }

    function getDescripcion_cita() {
        return $this->descripcion_cita;
    }

    function getId_estado() {
        return $this->id_estado;
    }

    function getCedula_cliente() {
        return $this->cedula_cliente;
    }

    function getTitle() {
        return $this->title;
    }

    function getStart() {
        return $this->start;
    }

    function getEnd() {
        return $this->end;
    }

    function setId_cita($id_cita) {
        $this->id_cita = $id_cita;
    }

    function setId_espacio($id_espacio) {
        $this->id_espacio = $id_espacio;
    }

    function setDescripcion_cita($descripcion_cita) {
        $this->descripcion_cita = $descripcion_cita;
    }

    function setId_estado($id_estado) {
        $this->id_estado = $id_estado;
    }

    function setCedula_cliente($cedula_cliente) {
        $this->cedula_cliente = $cedula_cliente;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setStart($start) {
        $this->start = $start;
    }

    function setEnd($end) {
        $this->end = $end;
    }
  
    public function getCampos() {
        $lista = get_object_vars($this);
        return $lista;
    }

    public function convertir(array $info, $alias = true) {
        $atributos = get_object_vars($this);
        $lista = array_keys($atributos);
        $sigla = ($alias) ? 'cit_' : '';
        foreach ($lista as $campo) {
            if (isset($info[$sigla . $campo])) {
                $this->$campo = $info[$sigla . $campo];
            }
        }
    }
    
}
