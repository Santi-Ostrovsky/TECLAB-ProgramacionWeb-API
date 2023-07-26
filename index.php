<?php

include 'class/autoload.php';

$lp = Productos::product_select();

include 'views/home.html';