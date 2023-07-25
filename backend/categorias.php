<?php

include '../class/autoload.php';

if (isset($_POST['action']) && $_POST['action'] == 'guardar') {
    $nuevaCategoria = new Categorias();
    $nuevaCategoria -> nombre = $_POST['nombre_categoria'];
    $nuevaCategoria -> guardar();
}
else if (isset($_GET['add'])) {
    include 'views/categorias.html';
    die();
}

$listaCategorias = Categorias::category_select();
include 'views/lista_categorias.html';