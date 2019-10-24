<?php

namespace modelo\generico;

use PDO;

abstract class GenericoDAO {

    /**
     *
     * @var \PDO
     */
    protected $cnn;
    protected $tabla;

    public function __construct(&$cnn, $tabla) {
        $this->cnn = $cnn;
        $this->tabla = $tabla;
    }

    public function insertar(IEntidad $obj) {
        $arrayCampos = $obj->getCampos();
        $arrayValores = array();
        $camposTabla = "";
        $valoresCampo = "";
        foreach ($arrayCampos as $nombreCampo => $valor) {
            if (is_null($valor)) {
                continue;
            }
            $camposTabla .=',' . $nombreCampo;
            $valoresCampo .= ', :' . $nombreCampo;
            $arrayValores[$nombreCampo] = $valor;
        }
        $sql = 'INSERT INTO ' . $this->tabla . ' (' . trim($camposTabla, ',') . ') VALUES (' . trim($valoresCampo, ',') . ')';
        $sentencia = $this->cnn->prepare($sql);
        $sentencia->execute($arrayValores);
        return $this->cnn->lastInsertId();
    }

    public function modificar(IEntidad $obj, $condicion) {
        $arrayCampos = $obj->getCampos();
        return $this->modificarArray($arrayCampos, $condicion);
    }

    public function modificarArray(array $arrayCampos, $condicion) {
        $camposTabla = "";
        foreach ($arrayCampos as $nombreCampo => $valor) {
            $camposTabla .=',' . $nombreCampo . '= :' . $nombreCampo;
        }
        $sql = 'UPDATE ' . $this->tabla . ' SET ' . trim($camposTabla, ',') . ' WHERE ' . $condicion;
        $sentencia = $this->cnn->prepare($sql);
        return $sentencia->execute($arrayCampos);
    }

    public function eliminar($id) {
        $sql = 'DELETE FROM ' . $this->tabla . ' WHERE id_' . $this->tabla . '= :id ';
        $sentencia = $this->cnn->prepare($sql);
        return $sentencia->execute(array('id' => $id));
    }

}
