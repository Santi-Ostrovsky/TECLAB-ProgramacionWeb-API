<?php

include '../class/autoload.php';

if (isset($_POST['action']) && $_POST['action'] == 'guardar') {
    $nuevoProducto = new Productos();
    $nuevoProducto -> nombre = $_POST['nombre_producto'];
    $nuevoProducto -> descripcion = $_POST['descripcion_producto'];
    $nuevoProducto -> precio = $_POST['precio_producto'];
    $nuevoProducto -> categoria = $_POST['categoria_producto'];
    $nuevoProducto -> imagen = $_POST['imagen_producto'];
    $nuevoProducto -> guardar();
}
else if (isset($_GET['add'])) {
    include 'views/productos.html';
    die();
}

$listaProductos = Productos::product_select();
include 'views/lista_productos.html';