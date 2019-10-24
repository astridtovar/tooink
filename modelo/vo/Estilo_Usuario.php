<?php
namespace modelo\vo;

use modelo\generico\IEntidad;

class Estilo_Usuario implements IEntidad{
    
    private $id_estilo_usuario;
    private $id_estilo;
    private $id_usuario;
    private $anos_experiencia;
    
    function getId_estilo_usuario() {
        return $this->id_estilo_usuario;
    }

    function getId_estilo() {
        return $this->id_estilo;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }

    function getAnos_experiencia() {
        return $this->anos_experiencia;
    }

    function setId_estilo_usuario($id_estilo_usuario) {
        $this->id_estilo_usuario = $id_estilo_usuario;
    }

    function setId_estilo($id_estilo) {
        $this->id_estilo = $id_estilo;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function setAnos_experiencia($anos_experiencia) {
        $this->anos_experiencia = $anos_experiencia;
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
