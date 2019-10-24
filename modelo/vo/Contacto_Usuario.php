<?php
namespace modelo\vo;

use modelo\generico\IEntidad;

class Contacto_Usuario implements IEntidad {
    
    private $id_contacto;
    private $id_usuario;
    private $descripcion_contacto;
    
    function getId_contacto() {
        return $this->id_contacto;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }

    function getDescripcion_contacto() {
        return $this->descripcion_contacto;
    }

    function setId_contacto($id_contacto) {
        $this->id_contacto = $id_contacto;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function setDescripcion_contacto($descripcion_contacto) {
        $this->descripcion_contacto = $descripcion_contacto;
    }

    public function getCampos() {
        $lista = get_object_vars($this);
        return $lista;
    }

    public function convertir(array $info, $alias = true) {
        $atributos = get_object_vars($this);
        $lista = array_keys($atributos);
        $sigla = ($alias) ? 'con_' : '';
        foreach ($lista as $campo) {
            if (isset($info[$sigla . $campo])) {
                $this->$campo = $info[$sigla . $campo];
            }
        }
    }
    
}
