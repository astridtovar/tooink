<?php

function __autoload($clase) {
    $ruta = __DIR__ . '/' . str_replace('\\', '/', $clase . '.php');
    require_once $ruta;
}