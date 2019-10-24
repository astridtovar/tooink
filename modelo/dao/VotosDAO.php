<?php

namespace modelo\dao;

use modelo\generico\GenericoDAO;
use PDO;

class VotosDAO extends GenericoDAO {

    public function __construct(&$cnn) {
        parent::__construct($cnn, 'votos');
    }

    public function insertarVoto($id_foto, $id_usuario) {
        $sentencia = $this->cnn->prepare("INSERT INTO votos (id_foto, id_usuario) VALUES (:id_foto, :id_usuario)");
        return $sentencia->execute(array('id_foto' => $id_foto, 'id_usuario' => $id_usuario));
    }

    public function consultarVoto($id_foto, $id_usuario) {
        $sentencia = $this->cnn->prepare("SELECT * FROM votos WHERE id_foto = :id_foto AND id_usuario = :id_usuario");
        $sentencia->execute(array('id_foto' => $id_foto, 'id_usuario' => $id_usuario));
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }

    public function consultarIcono() {
        $sentencia = $this->cnn->prepare("SELECT * FROM votos");
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }
    
    public function consultarParaRanking($id_usuario) {
        $sentencia = $this->cnn->prepare("SELECT V.id_foto, COUNT(V.id_foto) as maximo
        FROM votos V INNER JOIN imagen_portafolio I
        ON V.id_foto = I.id_imagen
        WHERE I.id_estado_img = 1 AND I.id_usuario = :id_usuario
        GROUP BY id_foto
        ORDER BY maximo DESC LIMIT 1");
        $sentencia->execute(array('id_usuario' => $id_usuario));
        $resultado = $sentencia->fetchAll();
        if (empty($resultado)) {
            return null;
        }
        $consulta = $resultado[0];
        return $consulta;
    }
    
    public function buscarRanking($id_foto) {
        $sentencia = $this->cnn->prepare("SELECT * FROM imagen_portafolio WHERE id_imagen = :id_foto");
        $sentencia->execute(array('id_foto' => $id_foto));
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }

}
