<?php

namespace modelo\vo;

use modelo\generico\IEntidad;

class Ayuda implements IEntidad{
    
    private  $id_ayuda;
    private $id_admin;
    private $descripcion;
    
    function getId_ayuda() {
        return $this->id_ayuda;
    }

    function getId_admin() {
        return $this->id_admin;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setId_ayuda($id_ayuda) {
        $this->id_ayuda = $id_ayuda;
    }

    function setId_admin($id_admin) {
        $this->id_admin = $id_admin;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getCampos() {
        $lista = get_object_vars($this);
        unset($lista['listaEstilos'], $lista['listaEstilos']);
        return $lista;
    }
    
    public function convertir(array $info, $alias = true) {
        $atributos = get_object_vars($this);
        $lista = array_keys($atributos);
        $sigla = ($alias) ? 'ayu_' : '';
        foreach ($lista as $campo) {
            if (isset($info[$sigla . $campo])) {
                $this->$campo = $info[$sigla . $campo];
            }
        }
    }
    
}
