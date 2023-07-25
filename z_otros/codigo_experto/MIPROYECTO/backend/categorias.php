<?php
include '../class/autoload.php';

if (isset($_POST['accion']) && $_POST['accion'] == 'guardar'){
    $mycategoria = new categorias();
    
    if (!categorias::validar($_POST['categoria_nombre'])){
        llamar_al_listado();
        die();
    }
    
    $nombre = $_POST['categoria_nombre'];
    
    $mycategoria->nombre = $_POST['categoria_nombre'];
    if ($mycategoria->guardar()){
        llamar_al_listado();
    }
} else if (isset($_GET['accion']) && $_GET['accion'] == "agregar"){
    include './views/categorias.html';
} else {
    llamar_al_listado();
}


function llamar_al_listado(){
    $categorias = categorias::listar();
    include './views/lista_categorias.html';
}