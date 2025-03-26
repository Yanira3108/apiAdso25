<?php

class Desarrollan {
    private $connect;
    private $table = 'desarrollan';

    public $id_desarrollan;
    public $fk_id_cultivo;
    public $fk_id_pea;

    public function __construct($db) {
        $this->connect = $db;
    }

    public function getDesarrollan() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function createDesarrollan() {
        $query = "INSERT INTO " . $this->table . " (fk_id_cultivo, fk_id_pea) VALUES (:fk_id_cultivo, :fk_id_pea)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(":fk_id_cultivo", $this->fk_id_cultivo);
        $stmt->bindParam(":fk_id_pea", $this->fk_id_pea);

        return $stmt->execute();
    }

    public function deleteDesarrollan() {
        $query = "DELETE FROM " . $this->table . " WHERE id_desarrollan = :id_desarrollan";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(":id_desarrollan", $this->id_desarrollan);
        return $stmt->execute();
    }
}

?>
