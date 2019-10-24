<?php

require_once './cargarTooink.php';
require_once './rutasTooink.php';

use modelo\basedatos\Conexion;
use modelo\vo\Usuario;

if (!isset($_SERVER['PATH_INFO'])) {
    if (isset($_COOKIE['usuario']) && !empty($_COOKIE['usuario'])) {
        //print_r($_COOKIE['usuario']);
        session_start();
        $usuario = $_COOKIE['usuario'];
        $objUsuario = new Usuario();
        $objUsuario->convertir(json_decode($usuario, TRUE), false);
        print_r($objUsuario);
        $_SESSION['usuario'] = $objUsuario;
        //echo $_SESSION['usuario']->getId_rol();
        if ($_SESSION['usuario']->getId_rol() == 1) {
            header('Location:' . ADMINISTRADOR_PRINCIPAL['url']);
        }
        if ($_SESSION['usuario']->getId_rol() == 2) {
            header('Location:' . TATUADOR_PRINCIPAL['url']);
        }
        if ($_SESSION['usuario']->getId_rol() == 3) {
            header('Location:' . CLIENTE_PRINCIPAL['url']);
        }
    } else {
        header('Location:' . DIRECTORIO_TATUADORES['url']);
        return;
    }
}

$ruta = URL_PRINCIPAL . $_SERVER['PATH_INFO'];
$cnn = Conexion::conectar();

foreach (get_defined_constants() as $constantte) {
    if (!is_array($constantte)) {
        continue;
    }

    if ($ruta == $constantte['url']) {
        $clase = '\\control\\' . $constantte['clase'];
        $metodo = $constantte['metodo'];
        $obj = new $clase($cnn);
        $obj->$metodo();
        break;
    }
}

//if (!isset($_SERVER['PATH_INFO'])) {
//    if (isset($_COOKIE['usuario']) && !empty($_COOKIE['usuario'])) {
//        session_start();
//        $usuario = $_COOKIE['usuario'];
//        $objUsuario = new Usuario();
//        $objUsuario->convertir(json_decode($usuario, TRUE), false);
//        $_SESSION['usuario'] = $objUsuario;
//        if ($_SESSION['usuario']->getId_rol() == 1) {
//            header('Location:' . ADMINISTRADOR_PRINCIPAL['url']);
//            return;
//        }
//        if ($_SESSION['usuario']->getId_rol() == 2) {
//            header('Location:' . TATUADOR_PRINCIPAL['url']);
//            return;
//        }
//        if ($_SESSION['usuario']->getId_rol() == 3) {
//            header('Location:' . CLIENTE_PRINCIPAL['url']);
//            return;
//        }
//        //header('Location:' . MENU['url']);
//        //return;
//    }
//    header('Location:' . DIRECTORIO_TATUADORES['url']);
//    return;
//}
//
//$ruta = URL_PRINCIPAL . $_SERVER['PATH_INFO'];
//$cnn = Conexion::conectar();
//
//foreach (get_defined_constants() as $constantte) {
//    if (!is_array($constantte)) {
//        continue;
//    }
//
//    if ($ruta == $constantte['url']) {
//        $clase = '\\control\\' . $constantte['clase'];
//        $metodo = $constantte['metodo'];
//        $obj = new $clase($cnn);
//        $obj->$metodo();
//        break;
//    }
//}
