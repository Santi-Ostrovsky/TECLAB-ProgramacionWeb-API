<?php

class productos{
    
    public $id;
    public $nombre;
    public $categoria;
    public $imagen;
    
    static public $archivo_path = "D:\\wamp64\\www\\MIPROYECTO\\assets\\uploads\\productos\\";
    static public $archivo_url = "http://localhost/MIPROYECTO/assets/uploads/productos/";
    
    
    static private $_lista_productos = array(

         array("id" => 1,
            "nombre" => "Microprocesador",
            "categoria" => 1,
            "imagen" => "img1.png"
            ),
         array("id" => 2,
            "nombre" => "Memoria 32MB",
            "categoria" => 3,
            "imagen" => "img3.png"
            ),
        array("id" => 3,
            "nombre" => "Cable VGA",
            "categoria" => 3,
            "imagen" => "img5.png"
            )
);
    
    function __construct($id = null) {
        if ($id != null){
            foreach (self::$_lista_productos as $producto){
                if ($producto['id'] == $id){
                    $this->id = $producto['id'];
                    $this->imagen = $producto['imagen'];
                    $this->categoria = $producto['categoria'];
                    $this->nombre = $producto['nombre'];
                }
            } 
        }
    }
    
    public function guardar(){
        $db = new base_datos();
        return $db->insert("productos", array("nombre", "id_categoria", "imagen"), array("?", "?", "?"), 
                array($this->nombre, $this->categoria, $this->imagen));
        
    }
    
    static public function listar($id_categoria = null){
       $db = new base_datos();       
       $union = "INNER JOIN categorias ON categorias.id = productos.id_categoria";
       $campos_recuperar = array(
           "productos.id",
           "productos.nombre",
           "productos.imagen",
           "productos.descripcion",
           "productos.precio",
           "categorias.nombre AS nombre_categoria",
           "productos.id_categoria"
       );
       $filtro = null;
       if ($id_categoria != null){
           $filtro = "WHERE id_categoria = ".$id_categoria;
       }
       return $db->listar("productos", $union, $campos_recuperar, $filtro);
       
    }
    
    
    static function validar($nombre, $imagen_extension){
        $extensiones_permitidas = array("png", "jpeg", "jpg", "svg", "ico");
        $error = array();
        if (trim($nombre) == ""){
            $error[] = "El nombre no puede ser vacio";
        }
        if (!in_array($imagen_extension, $extensiones_permitidas)){
            $error[] = "La extensión es inválida";
        }
        if (count($error) > 0){ // empty($error)
            echo implode("<br>", $error);
            return false;
        } else {
            return true;
        }
        
    }
    
    
}

