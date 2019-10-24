<?php

namespace modelo\vo;

use modelo\generico\IEntidad;

class Estado implements IEntidad{
    
    private $id_estado;
    private $descripcion_estado;
    
    function getId_estado() {
        return $this->id_estado;
    }

    function getDescripcion_estado() {
        return $this->descripcion_estado;
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
