<?php

class categorias {
    
    public $id;
    public $nombre;
    
    
    
    
    
    static public function listar(){
        $db = new base_datos();
       return $db->listar("categorias");
    }
    
    public function guardar(){
        $db = new base_datos();
        return $db->insert("categorias", array("nombre"), array("?"), array($this->nombre));
    }
    
    static public function validar($nombre/*, $email, $precio*/){
        if (trim($nombre) == ''){
            echo "El nombre no puede ser vacio";
            return false;
        }
        
        return true;
    }  
    
}

