<?php /* @autor Santiago Ostrovsky */

// DEFINE 'PRODUCTOS' CLASS
class Productos {

    protected $id;
    public $nombre;
    public $descripcion;
    public $precio;
    public $categoria;
    public $imagen;
    private $exists = false;

    // DEFINE CONSTRUCTOR FOR OBJECT CREATOR
    function _construct($id = null) {
        $db = new database("mysql", "miproyecto", "127.0.0.1", "root", "");
        $response = $db -> select("productos", "id=?", array($id));

        if(isset($response[0]['id'])) {
            $this -> id = $response[0]['id'];
            $this -> nombre = $response[0]['nombre-producto'];
            $this -> descripcion = $response[0]['descripcion-producto'];
            $this -> precio = $response[0]['precio-producto'];
            $this -> categoria = $response[0]['categoria-producto'];
            $this -> imagen = $response[0]['imagen-producto'];
            $this -> exists = true;
        }
        else return false;
    }

    // DEFINE FUNCTION TO RENDER PRODUCTS ON SCREEN
    public function product_show() {
        echo '<pre>';
        print_r($this);
        echo '</pre>';
    }
    
    // DEFINE FUNCTION TO SAVE DATA TO DB
    public function guardar() {
        if ($this -> exists) return $this -> product_update();
        else return $this -> product_insert();
    }
    
    // DEFINE FUNCTION TO DELETE DATA FROM DB
    public function eliminar() {
        $db = new database("mysql", "miproyecto", "127.0.0.1", "root", "");
        return $db -> delete("productos", "id = " . $this -> id);
    }

    // DEFINE FUNCTION TO CREATE NEW PRODUCTS
    private function product_insert() {
        $db = new database("mysql", "miproyecto", "127.0.0.1", "root", "");
        $response = $db -> insert("productos",
        "nombre-producto=?, descripcion-producto=?, precio-producto=?, categoria-producto=?, imagen-producto=?",
        "?,?,?,?", array($this -> nombre, $this -> descripcion, $this -> precio, $this -> categoria, $this -> imagen));

        if ($response) {
            $this -> id = $response;
            $this -> exists = true;
            return true;
        }
        else return false;
    }
    
    // DEFINE FUNCTION TO MODIFY EXISTING PRODUCTS
    private function product_update() {
        $db = new database("mysql", "miproyecto", "127.0.0.1", "root", "");
        return $db -> update("productos",
        "nombre-producto=?, descripcion-producto=?, precio-producto=?, categoria-producto=?, imagen-producto=?",
        "id=?", array($this -> nombre, $this -> descripcion, $this -> precio, $this -> categoria, $this -> imagen));
    }
    
    // DEFINE FUNCTION TO SELECT PRODUCTS
    static public function product_select() {
        $db = new database("mysql", "miproyecto", "127.0.0.1", "root", "");
        return $db -> select("productos");
    }
}