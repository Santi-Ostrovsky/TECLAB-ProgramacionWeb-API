<?php

try {
    $conector = new PDO("mysql:dbname=miproyecto;host=127.0.0.1", "root", "");
    echo "Conexión exitosa!";
} catch (Exception $e) {
    echo "Conexión fallida!" . $e->getMessage();
}

class database {
    private $gbd;

    function _construct($driver, $database, $host, $user, $pass) {
        $connection = $driver . ":dbname=" . $database . ";host=$host";
        $this->$gbd = new PDO($connection, $user, $pass);
    }

    if (!$this->$gbd) {
        throw new Exception("No se ha podido realizar la conexión.");
    }
}

?>