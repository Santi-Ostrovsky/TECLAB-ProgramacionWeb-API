<?php 

include '../class/autoload.php';

if (isset($_POST['accion']) && $_POST['accion'] == "agregar"){
    $archivo = $_FILES['imagen_producto'];
    $archivo_extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
    $nombre_archivo = md5($archivo['tmp_name'].date("YmdHis"));
    if (productos::validar($_POST['producto_nombre'], $archivo_extension)){
    
        if (move_uploaded_file($archivo['tmp_name'], productos::$archivo_path.$nombre_archivo.".".$archivo_extension)){
            $mi_producto = new productos();
            $mi_producto->nombre = $_POST['producto_nombre'];
            $mi_producto->categoria = $_POST['producto_categoria'];
            $mi_producto->imagen = $nombre_archivo.".".$archivo_extension;
            if ($mi_producto->guardar()){
                echo "OK";
            } else {
                echo "Error al guardar";
            }
        } else {
            echo "Falló la subida del archivo";
        }
        
    } else {
        listar_productos();
    }
} else if (isset($_GET['accion']) && $_GET['accion'] == "agregar"){
    $categorias = categorias::listar();
    include './views/productos.html';
} else {
    listar_productos();
}


function listar_productos(){
    $productos = productos::listar();
    include './views/lista_productos.html';
    
}

//
//$categorias = categorias::listar();
//include './views/productos.html';


