<?php

class Eras {
    private $connect;
    private $table = 'eras';

    public $id_eras;
    public $descripcion;
    public $fk_id_lote;

    public function __construct($db) {
        $this->connect = $db;
    }

    public function getEras() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function createEras() {
        $query = "INSERT INTO " . $this->table . " (descripcion, fk_id_lote) VALUES (:descripcion, :fk_id_lote)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":fk_id_lote", $this->fk_id_lote);

        return $stmt->execute();
    }

    public function deleteEras() {
        $query = "DELETE FROM " . $this->table . " WHERE id_eras = :id_eras";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(":id_eras", $this->id_eras);
        return $stmt->execute();
    }
}

?>

