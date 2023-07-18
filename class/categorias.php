<?php

// DEFINE 'CATEGORIAS' CLASS
class Categorias {

    protected $id;
    public $nombre;
    private $exists;

    function _construct($id = null) {
        if ($id != null) {
            // Los condicionales PHP no funcionan como los condicionales JS.
            // En JS, puede usarse la expresión: if (id) {...}, ya que 'id',
            // evalúa a un valor (verdadero) o a la falta de valor (falsy/false).
            // En PHP, la condición de verdad o falsedad debe expresarse de forma literal.
            $db = new database("mysql", "miproyecto", "127.0.0.1", "root", "");
            $response = $db -> select("categorias", "id=?", array($id));

            if (isset($response[0]['id'])) {
                $this -> id = $response[0]['id'];
                $this -> nombre = $response[0]['nombre-categoria'];
                $this -> exists = true;
            }
        }
        else return false;
    }

    // DEFINE FUNCTION TO RENDER CATEGORIES ON SCREEN
    public function category_show() {
        echo '<pre>';
        print_r($this);
        echo '</pre>';
    }

    // DEFINE FUNCTION TO SAVE DATA TO DB
    public function guardar() {
        if ($this -> exists) return $this -> category_update();
        else return $this -> category_insert();
    }
    
    // DEFINE FUNCTION TO DELETE DATA FROM DB
    public function eliminar() {
        $db = new database("mysql", "miproyecto", "127.0.0.1", "root", "");
        return $db -> delete("categorias", "id = " . $this -> id);
    }
    
    // DEFINE FUNCTION TO CREATE NEW CATEGORIES
    private function category_insert() {
        $db = new database("mysql", "miproyecto", "127.0.0.1", "root", "");
        $response = $db -> insert("categorias", "nombre-categoria=?", "id=?", array($this -> nombre));

        if ($response) {
            $this -> id = $response;
            $this -> exists = true;
            return true;
        }
        else return false;
    }

    // DEFINE FUNCTION TO CREATE NEW CATEGORIES
    private function category_update() {
        $db = new database("mysql", "miproyecto", "127.0.0.1", "root", "");
        return $db -> update("categorias", "nombre-categoria=?", "id=?", array($this -> nombre));
    }

    // DEFINE FUNCTION TO SELECT CATEGORIES
    static public function category_select() {
        $db = new database("mysql", "miproyecto", "127.0.0.1", "root", "");
        return $db -> select("categorias");
    }
}