<?php
class Ubicacion {
    private $connect;
    private $table = 'ubicacion';

    public $id_ubicacion;
    public $latitud;
    public $longitud;
    
 
    public function __construct($db) {
        $this->connect = $db;
    }

    public function get() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " (latitud,longitud) VALUES (:latitud,:longitud)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(":latitud", $this->latitud);
        $stmt->bindParam(":longitud", $this->longitud);


        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id_ubicacion";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(":id_ubicacion", $this->id_ubicacion);
        return $stmt->execute();
    }

}
?>
