<?php

namespace modelo\dao;

use modelo\generico\GenericoDAO;
use PDO;

class Espacio_AgendaDAO extends GenericoDAO {

    public function __construct(&$cnn) {
        parent::__construct($cnn, 'espacio_agenda');
    }

    public function insertarEvento($id_espacio, $cedula_cliente, $title, $id_estilo, $descripcion) {
        $sentencia = $this->cnn->prepare("UPDATE espacio_agenda SET cedula_cliente = :cedula_cliente, title = :title, id_estilo_cita = :id_estilo_cita,"
                . "descripcion_cita = :descripcion_cita, id_estado = 1, color = 'STEELBLUE' WHERE id_espacio = :id_espacio");
        return $sentencia->execute(array('cedula_cliente' => $cedula_cliente, 'title' => $title, 'id_estilo_cita' => $id_estilo,
                    'descripcion_cita' => $descripcion, 'id_espacio' => $id_espacio));
    }

    public function modificarEvento($start, $descripcion, $id_espacio, $id_estilo, $title) {
        $sentencia = $this->cnn->prepare("UPDATE espacio_agenda SET start = :start, descripcion_cita = :descripcion_cita, id_estilo_cita = :id_estilo_cita,"
                . "title = :title WHERE id_espacio = :id_espacio");
        return $sentencia->execute(array('start' => $start, 'descripcion_cita' => $descripcion, 'id_espacio' => $id_espacio,
                    'title' => $title, 'id_estilo_cita' => $id_estilo));
    }

    public function cancelarEvento($id_espacio) {
        $sentencia = $this->cnn->prepare("UPDATE espacio_agenda SET id_estado = 6 WHERE id_espacio = :id_espacio");
        return $sentencia->execute(array('id_espacio' => $id_espacio));
    }

    public function consultarCitas($cedula) {
        $sentencia = $this->cnn->prepare("SELECT * FROM espacio_agenda WHERE cedula_cliente = :cedula_cliente");
        return $sentencia->execute(array('cedula_cliente' => $cedula));
    }

    public function consultarEspaciosLibres($id_usuario, $date) {
        $sentencia = $this->cnn->prepare("SELECT * FROM espacio_agenda WHERE id_estado = 7 AND start >= '$date' AND id_usuario = :id_usuario ORDER BY start");
        $sentencia->execute(array('id_usuario' => $id_usuario));
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }

    public function insertarSolicitudReserva($descripcion, $cedula, $title, $estilo, $id_espacio) {
        $sentencia = $this->cnn->prepare("UPDATE espacio_agenda SET descripcion_cita = :descripcion_cita, cedula_cliente = :cedula_cliente"
                . ", title = :title, id_estilo_cita = :estilo, id_estado = 8 WHERE id_espacio = :id_espacio");
        return $sentencia->execute(array('descripcion_cita' => $descripcion, 'cedula_cliente' => $cedula,
                    'title' => $title, 'estilo' => $estilo, 'id_espacio' => $id_espacio));
    }

    public function aceptarReserva($id_espacio) {
        $sentencia = $this->cnn->prepare("UPDATE espacio_agenda SET id_estado = 3, color = 'STEELBLUE' WHERE id_espacio = :id_espacio");
        return $sentencia->execute(array('id_espacio' => $id_espacio));
    }

    public function denegarReserva($descripcion, $cedula, $title, $estilo, $id_espacio) {
        $sentencia = $this->cnn->prepare("UPDATE espacio_agenda SET descripcion_cita = :descripcion_cita, cedula_cliente = :cedula_cliente"
                . ", title = :title, id_estilo_cita = :estilo, id_estado = 7, color = 'MEDIUMSEAGREEN' WHERE id_espacio = :id_espacio");
        return $sentencia->execute(array('descripcion_cita' => $descripcion, 'cedula_cliente' => $cedula,
                    'title' => $title, 'estilo' => $estilo, 'id_espacio' => $id_espacio));
    }

    public function consultarCitasProximas($fecha) {
        $sentencia = $this->cnn->prepare("SELECT * FROM espacio_agenda WHERE start = :fecha AND id_estado = 1");
        return $sentencia->execute(array('fecha' => $fecha));
    }

    public function consultarEventos($id_usuario) {
        $sentencia = $this->cnn->prepare("SELECT * FROM espacio_agenda WHERE id_estado != 8 AND id_usuario = :id_usuario");
        $sentencia->execute(array('id_usuario' => $id_usuario));
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return json_encode($consulta);
    }

}
