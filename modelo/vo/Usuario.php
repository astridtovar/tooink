<?php
namespace modelo\vo;

use modelo\generico\IEntidad;

class Usuario implements IEntidad{
    
    private $id_usuario;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    private $numero_doc;
    private $fecha_nac;
    private $fecha_exp_doc;
    private $nombre_artistico;
    private $foto_perfil;
    private $id_rol;
    private $id_tipo_doc;
    private $id_estado;
    private $listaEstilos = array();
    
    function getListaEstilos() {
        return $this->listaEstilos;
    }

    function setListaEstilos($listaEstilos) {
        $this->listaEstilos = $listaEstilos;
    }

        function getId_usuario() {
        return $this->id_usuario;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getCorreo() {
        return $this->correo;
    }

    function getClave() {
        return $this->clave;
    }

    function getNumero_doc() {
        return $this->numero_doc;
    }

    function getFecha_nac() {
        return $this->fecha_nac;
    }

    function getFecha_exp_doc() {
        return $this->fecha_exp_doc;
    }

    function getNombre_artistico() {
        return $this->nombre_artistico;
    }

    function getFoto_perfil() {
        return $this->foto_perfil;
    }

    function getId_rol() {
        return $this->id_rol;
    }

    function getId_tipo_doc() {
        return $this->id_tipo_doc;
    }

    function getId_estado() {
        return $this->id_estado;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

    function setNumero_doc($numero_doc) {
        $this->numero_doc = $numero_doc;
    }

    function setFecha_nac($fecha_nac) {
        $this->fecha_nac = $fecha_nac;
    }

    function setFecha_exp_doc($fecha_exp_doc) {
        $this->fecha_exp_doc = $fecha_exp_doc;
    }

    function setNombre_artistico($nombre_artistico) {
        $this->nombre_artistico = $nombre_artistico;
    }

    function setFoto_perfil($foto_perfil) {
        $this->foto_perfil = $foto_perfil;
    }

    function setId_rol($id_rol) {
        $this->id_rol = $id_rol;
    }

    function setId_tipo_doc($id_tipo_doc) {
        $this->id_tipo_doc = $id_tipo_doc;
    }

    function setId_estado($id_estado) {
        $this->id_estado = $id_estado;
    }

        
    public function getCampos() {
        $lista = get_object_vars($this);
        unset($lista['listaEstilos'], $lista['listaEstilos']);
        return $lista;
    }

    public function convertir(array $info, $alias = true) {
        $atributos = get_object_vars($this);
        $lista = array_keys($atributos);
        $sigla = ($alias) ? 'usu_' : '';
        foreach ($lista as $campo) {
            if (isset($info[$sigla . $campo])) {
                $this->$campo = $info[$sigla . $campo];
            }
        }
    }
    
}
