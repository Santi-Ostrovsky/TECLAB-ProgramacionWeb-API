<?php /* @autor Santiago Ostrovsky */

define("DRIVER", 'mysql');
define("DB", 'miproyecto');
define("HOST", '127.0.0.1');
define("USER", 'root');
define("PASS", '');
define("TABLE", 'productos');

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
    function __construct($id = null) {
        $db = new database(DRIVER, DB, HOST, USER, PASS);
        // $db = new database("mysql", "miproyecto", "127.0.0.1", "root", "");
        $response = $db -> select(TABLE, "id=?", array($id));
        // $response = $db -> select("productos", "id=?", array($id));

        if(isset($response[0]['id'])) {
            $this -> id = $response[0]['id'];
            $this -> nombre = $response[0]['nombre_producto'];
            $this -> descripcion = $response[0]['descripcion_producto'];
            $this -> precio = $response[0]['precio_producto'];
            $this -> categoria = $response[0]['categoria_producto'];
            $this -> imagen = $response[0]['imagen_producto'];
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
        $db = new database(DRIVER, DB, HOST, USER, PASS);
        // $db = new database("mysql", "miproyecto", "127.0.0.1", "root", "");
        return $db -> delete(TABLE, "id = " . $this -> id);
        // return $db -> delete("productos", "id = " . $this -> id);
    }

    // DEFINE FUNCTION TO CREATE NEW PRODUCTS
    private function product_insert() {
        $db = new database(DRIVER, DB, HOST, USER, PASS);
        // $db = new database("mysql", "miproyecto", "127.0.0.1", "root", "");
        $response = $db -> insert(TABLE,
        // $response = $db -> insert("productos",
        "nombre_producto=?, descripcion_producto=?, precio_producto=?, categoria_producto=?, imagen_producto=?", "?,?,?,?",
        array($this -> nombre, $this -> descripcion, $this -> precio, $this -> categoria, $this -> imagen));
        
        if ($response) {
            $this -> id = $response;
            $this -> exists = true;
            return true;
        }
        else return false;
    }
    
    // DEFINE FUNCTION TO MODIFY EXISTING PRODUCTS
    private function product_update() {
        $db = new database(DRIVER, DB, HOST, USER, PASS);
        // $db = new database("mysql", "miproyecto", "127.0.0.1", "root", "");
        return $db -> update(TABLE,
        // return $db -> update("productos",
        "nombre_producto=?, descripcion_producto=?, precio_producto=?, categoria_producto=?, imagen_producto=?",
        "id=?", array($this -> nombre, $this -> descripcion, $this -> precio, $this -> categoria, $this -> imagen));
    }
    
    // DEFINE FUNCTION TO SELECT PRODUCTS
    static public function product_select() {
        $db = new database(DRIVER, DB, HOST, USER, PASS);
        // $db = new database("mysql", "miproyecto", "127.0.0.1", "root", "");
        return $db -> select(TABLE);
        // return $db -> select("productos");
    }
}