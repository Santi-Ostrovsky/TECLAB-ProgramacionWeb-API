<?php

class base_datos{
    
    private $conexion;
    
    function __construct() {
        $conexion = new PDO("mysql:host=localhost:3306;port=3306;dbname=teclab", "aquiles248", "aquiles248");
        if ($conexion){
           $this->conexion = $conexion; 
        } else {
            echo "NO ME PUDE CONECTAR";
        }
    }
    
    function insert($tabla, $campos, $valores, $arr_prepare = null){
        
        // INSERT INTO categorias (nombre, imagen_de_categoria) VALUES (?, ?);
        $sql = "INSERT INTO ".$tabla." (".implode(", ", $campos).") VALUES (".implode(",",$valores).")";
        $resourse = $this->conexion->prepare($sql);
        $resourse->execute($arr_prepare);
        if ($resourse){
            return true;
        } else {
            echo $resourse->errorInfo();
            throw new Exception ("No se pudo realizar la consulta de eliminacion");
        }
    }
    
    
    public function listar($table_name, $join = null, array $campos = null, $filtro_where = null){
        $campos_select = "*";
        if ($campos != null){
            $campos_select = implode(",", $campos);
        }
        $sql = "SELECT ".$campos_select." FROM ".$table_name;
        if ($join){
            $sql .= " ".$join;
        }
        if ($filtro_where != null){
            $sql .= " ".$filtro_where;  // $sql = $sql."otra cadena";
        }
        $resource = $this->conexion->query($sql);
        if (!$resource){
            echo "Revisar la consulta";
            echo "<pre>";
            print_r($this->conexion->errorInfo());
            print_r($this->conexion->errorCode());
            echo "</pre>";
        } else {
            $result = $resource->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }    
}
