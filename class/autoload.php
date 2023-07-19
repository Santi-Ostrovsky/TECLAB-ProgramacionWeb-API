<?php /* @autor Santiago Ostrovsky */

// DEFINE 'AUTOLOAD' CLASS
class Autoload {

    static public function loadClass($class) {
        $classArr = array();
        $from = __DIR__.DIRECTORY_SEPARATOR; // 'class/[nombre_del_archivo]'

        $classArr['database'] = $from . "database.php";
        $classArr['Categorias'] = $from . "categorias.php";
        $classArr['Productos'] = $from . "productos.php";

        if (isset($classArr[$class])) {
            if (file_exists($classArr[$class])) include $classArr[$class];
            else throw new Exception("La clase ".$classArr[$class]." es inexistente.");
        }
    }
}

spl_autoload_register('Autoload::loadClass');