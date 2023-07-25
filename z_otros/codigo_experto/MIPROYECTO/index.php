<?php

include './class/autoload.php';

$filtro = null;
if (isset($_GET['filtro_categoria'])){
    $filtro = $_GET['filtro_categoria'];
}


$productos = productos::listar($filtro);
$categorias = categorias::listar();

include './view/home.html';