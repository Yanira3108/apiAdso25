<?php
class Pea {
    private $connect;
    private $table = 'pea';

    public $id_pea;
    public $tipo;
    public $nombre;
    public $descripcion;
 
    public function __construct($db) {
        $this->connect = $db;
    }

    public function getPea() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function createPea() {
        $query = "INSERT INTO " . $this->table . " (tipo,nombre,descripcion) VALUES (:tipo, :nombre, :descripcion)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(":tipo", $this->tipo);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);


        return $stmt->execute();
    }

    public function deletePea() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id_pea";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(":id_pea", $this->id);
        return $stmt->execute();
    }

}
?>
