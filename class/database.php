<?php

// TRY CONNECTION TO REMOTE DB THROUGH DYNAMIC CREDENTIALS
try {
    $conector = new PDO("mysql:dbname=miproyecto;host=127.0.0.1", "root", "");
    echo "Conexión exitosa!";
} catch (Exception $e) {
    echo "Conexión fallida!" . $e -> getMessage();
}

// DEFINE DATABASE CLASS
class database {
    private $gbd;

    // DEFINE FUNCTION TO ESTABLISH DB CONNECTION
    function _construct($driver, $database, $host, $user, $pass) {
        $connection = $driver . ":dbname=" . $database . ";host=$host";
        $this -> gbd = new PDO($connection, $user, $pass);

        if (!$this -> gbd) throw new Exception("No se ha podido realizar la conexión.");
    }

    // ********************** BASIC  SQL QUERIES **********************
    
    // DEFINE -SELECT- FUNCTION TO EXTRACT DB DATA
    // SELECT [columns] FROM [table_name] WHERE [condition] ORDER BY [orden] [ASC | DESC] LIMIT [results_amount]
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
    
    // DEFINE -DELETE- FUNCTION TO REMOVE DB DATA
    // DELETE FROM [table_name] WHERE [condition]
    function delete($tabla, $filtros = null, $arr_prepare = null) {
        $sql = "DELETE FROM" . $tabla . "WHERE" . $filtros;

        $resource = $this -> gbd -> prepare($sql);
        $resource -> execute($arr_prepare);
        
        if ($resource) return true;
        else throw new Exception("Error al remover los datos.");
    }

    // DEFINE -INSERT- FUNCTION TO ADD NEW DATA TO THE DB
    // INSERT INTO [table_name] ([columns]) VALUES ([values])
    function insert($tabla, $campos, $valores, $arr_prepare = null) {
        $sql = "INSERT INTO" . $tabla . "(" . $campos . ") VALUES ($valores)";

        $resource = $this -> gbd -> prepare($sql);
        $resource -> execute($arr_prepare);

        if ($resource) return $this -> gbd -> lastInsertId();
        else {
            echo '<pre>';
            print_r($resource -> errorInfo());
            echo '</pre>';

            throw new Exception('Error al insertar los datos.');
        }
    }
    
    // DEFINE -UPDATE- FUNCTION TO MODIFY EXISTING DATA IN THE DB
    // UPDATE [table_name] SET [column] = [value] WHERE [condition]
    function update($tabla, $campos, $filtros, $arr_prepare = null) {
        $sql = "UPDATE" . $tabla . "SET" . $campos . "WHERE" . $filtros;

        $resource = $this -> gbd -> prepare($sql);
        $resource -> execute($arr_prepare);

        if ($resource) return true;
        else {
            echo '<pre>';
            print_r($resource -> errorInfo());
            echo '</pre>';

            throw new Exception('Error al actualizar los datos.');
        }
    }

    /*
    ********************** OTHER SQL QUERIES **********************
    → CREATE TABLE [table_name] ([column 1 datatype constraints], [column 2 datatype constraints], ...)
    → DROP TABLE [table_name]
    → ALTER TABLE [table_name] [ADD | ALTER COLUMN | DROP COLUMN] [column_name datatype]
    → CREATE INDEX, JOIN QUERIES, GROUP BY, etc...
    */
}
