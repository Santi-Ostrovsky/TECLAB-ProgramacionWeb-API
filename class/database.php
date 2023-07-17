<?php

// TRY CONNECTION TO REMOTE DB THROUGH DYNAMIC CREDENTIALS
try {
    $conector = new PDO("mysql:dbname=miproyecto;host=127.0.0.1", "root", "");
    echo "Conexión exitosa!";
} catch (Exception $e) {
    echo "Conexión fallida!" . $e -> getMessage();
}

// DECLARE DATABASE CLASS
class database {
    private $gbd;

    // DECLARE FUNCTION TO ESTABLISH DB CONNECTION
    function _construct($driver, $database, $host, $user, $pass) {
        $connection = $driver . ":dbname=" . $database . ";host=$host";
        $this -> gbd = new PDO($connection, $user, $pass);
    

    if (!$this -> gbd) {
        throw new Exception("No se ha podido realizar la conexión.");
        }
    }

    // DECLARE SELECT FUNCTION TO EXTRACT DB DATA
    function select($tabla, $filtros = null, $arr_prepare = null, $orden = null, $limit = null) {
        $sql = "SELECT * TABLA " . $tabla;

        // if ($filtros) $sql .= " WHERE " . $filtros;
        if ($filtros != null) $sql .= " WHERE " . $filtros;
        if ($orden != null) $sql .= " ORDER BY " . $orden;
        if ($limit != null) $sql .= " LIMIT " . $limit;

        $resource = $this -> gbd -> prepare($sql);
        $resource -> execute($arr_prepare);

        if ($resource) return $resource -> fetchAll(PDO::FETCH_ASSOC);
        else throw new Exception("No se ha podido realizar la consulta.");
    }

    // DECLARE DELETE FUNCTION TO REMOVE DB DATA
    function delete($tabla, $filtros = null, $arr_prepare = null) {
        $sql = "DELETE FROM" . $tabla . "WHERE" . $filtros;

        $resource = $this -> gbd -> prepare($sql);
        $resource -> execute($arr_prepare);

        if ($resource) return true;
        else throw new Exception("Error al remover los datos.");
    }

    // DECLARE INSERT FUNCTION TO ADD NEW DATA TO THE DB
    function insert(){}

    // DECLARE UPDATE FUNCTION TO MODIFY EXISTING DATA IN THE DB
    function update(){}
}
