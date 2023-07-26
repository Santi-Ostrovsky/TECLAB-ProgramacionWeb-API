<?php

include 'class/autoload.php';

$productos = Productos::product_select();

include 'views/home.html';