<?php

namespace modelo\generico;

interface IEntidad {

    function getCampos();

    function convertir(array $info, $alias = true);
}
