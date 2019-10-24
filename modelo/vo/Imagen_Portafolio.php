<?php
namespace modelo\vo;

use modelo\generico\IEntidad;

class Imagen_Portafolio implements IEntidad{
    
    private $id_imagen;
    private $id_usuario;
    private $descripcion_imagen;
    private $numero_votos;
    private $restriccion_edad;
    private $imagen;
    private $id_estado_img;
            
    function getId_imagen() {
        return $this->id_imagen;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }

    function getDescripcion_imagen() {
        return $this->descripcion_imagen;
    }

    function getNumero_votos() {
        return $this->numero_votos;
    }

    function getRestriccion_edad() {
        return $this->restriccion_edad;
    }

    function getImagen() {
        return $this->imagen;
    }

    function getId_estado_img() {
        return $this->id_estado_img;
    }

    function setId_imagen($id_imagen) {
        $this->id_imagen = $id_imagen;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function setDescripcion_imagen($descripcion_imagen) {
        $this->descripcion_imagen = $descripcion_imagen;
    }

    function setNumero_votos($numero_votos) {
        $this->numero_votos = $numero_votos;
    }

    function setRestriccion_edad($restriccion_edad) {
        $this->restriccion_edad = $restriccion_edad;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    function setId_estado_img($id_estado_img) {
        $this->id_estado_img = $id_estado_img;
    }

     public function getCampos() {
        $lista = get_object_vars($this);
        return $lista;
    }

    public function convertir(array $info, $alias = true) {
        $atributos = get_object_vars($this);
        $lista = array_keys($atributos);
        $sigla = ($alias) ? 'ima_' : '';
        foreach ($lista as $campo) {
            if (isset($info[$sigla . $campo])) {
                $this->$campo = $info[$sigla . $campo];
            }
        }
    }
    
}