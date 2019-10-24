<?php
namespace modelo\vo;

use modelo\generico\IEntidad;

class Estilo implements IEntidad {
    
    private $id_estilo;
    private $descripcion;
    
    function getId_estilo() {
        return $this->id_estilo;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setId_estilo($id_estilo) {
        $this->id_estilo = $id_estilo;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

        
    public function getCampos() {
        $lista = get_object_vars($this);
        return $lista;
    }

    public function convertir(array $info, $alias = true) {
        $atributos = get_object_vars($this);
        $lista = array_keys($atributos);
        $sigla = ($alias) ? 'est_' : '';
        foreach ($lista as $campo) {
            if (isset($info[$sigla . $campo])) {
                $this->$campo = $info[$sigla . $campo];
            }
        }
    }
    
}
