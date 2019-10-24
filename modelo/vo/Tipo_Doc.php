<?php

namespace modelo\vo;

use modelo\generico\IEntidad;

class Tipo_Doc implements IEntidad{

    private $id_tipo_doc;
    private $descripcion;
    private $listaTiposDoc = array();
    
    function getId_tipo_doc() {
        return $this->id_tipo_doc;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getListaTiposDoc() {
        return $this->listaTiposDoc;
    }

    function setId_tipo_doc($id_tipo_doc) {
        $this->id_tipo_doc = $id_tipo_doc;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setListaTiposDoc($listaTiposDoc) {
        $this->listaTiposDoc = $listaTiposDoc;
    }

    public function getCampos() {
        $lista = get_object_vars($this);
        unset($lista['listaTiposDoc'], $lista['listaTiposDoc']);
        return $lista;
    }

    public function convertir(array $info, $alias = true) {
        $atributos = get_object_vars($this);
        $lista = array_keys($atributos);
        $sigla = ($alias) ? 'tip_' : '';
        foreach ($lista as $campo) {
            if (isset($info[$sigla . $campo])) {
                $this->$campo = $info[$sigla . $campo];
            }
        }
    }
    
}
