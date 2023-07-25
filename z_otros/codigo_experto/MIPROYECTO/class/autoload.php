<?php


class autoload{
    
    static private $base_dir = "D:/wamp64/www/MIPROYECTO/class/"; 
    
    static public function autocarga($clase){
        $class = array();
        $class['productos'] = self::$base_dir."productos.php";
        $class['categorias'] = self::$base_dir."categorias.php";
        $class['base_datos'] = self::$base_dir."base_datos.php";        
        
        if (isset($class[$clase])){
            include $class[$clase];
        } else {
            echo "NO SE DEFINIO LA CLASE ".$clase;
            die();
        }        
    }    
}

spl_autoload_register("autoload::autocarga");