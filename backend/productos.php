<?php

include '../class/autoload.php';

if (isset($_POST['action']) && $_POST['action'] == 'guardar') {
    $nuevoProducto = new Productos();
    $nuevoProducto -> nombre = $_POST['nombre-producto'];
    $nuevoProducto -> descripcion = $_POST['descripcion-producto'];
    $nuevoProducto -> precio = $_POST['precio-producto'];
    $nuevoProducto -> categoria = $_POST['categoria-producto'];
    $nuevoProducto -> imagen = $_POST['imagen-producto'];
    $nuevoProducto -> guardar();
}
else if (isset($_GET['add'])) {
    include 'views/productos.html';
    die();
}

$listaProductos = Productos::product_select();
include 'views/lista_productos.html';