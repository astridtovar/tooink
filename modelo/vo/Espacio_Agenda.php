<?php

namespace modelo\vo;

use modelo\generico\IEntidad;

class Espacio_Agenda implements IEntidad{
    
    private $id_espacio;
    private $id_usuario;
    private $start;
    private $id_estado;
    private $cedula_cliente;
    private $title;
    private $id_estilo_cita;
    private $descripcion_cita;
            
    function getId_espacio() {
        return $this->id_espacio;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }

    function getStart() {
        return $this->start;
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

    function getId_estilo_cita() {
        return $this->id_estilo_cita;
    }

    function getDescripcion_cita() {
        return $this->descripcion_cita;
    }

    function setId_espacio($id_espacio) {
        $this->id_espacio = $id_espacio;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function setStart($start) {
        $this->start = $start;
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

    function setId_estilo_cita($id_estilo_cita) {
        $this->id_estilo_cita = $id_estilo_cita;
    }

    function setDescripcion_cita($descripcion_cita) {
        $this->descripcion_cita = $descripcion_cita;
    }

    public function getCampos() {
        $lista = get_object_vars($this);
        return $lista;
    }

    public function convertir(array $info, $alias = true) {
        $atributos = get_object_vars($this);
        $lista = array_keys($atributos);
        $sigla = ($alias) ? 'esp_' : '';
        foreach ($lista as $campo) {
            if (isset($info[$sigla . $campo])) {
                $this->$campo = $info[$sigla . $campo];
            }
        }
    }
    
}
