<?php

class Genera {
    private $connect;
    private $table = 'genera';

    public $id_genera;
    public $fk_id_cultivo;
    public $fk_id_produccion;

    public function __construct($db) {
        $this->connect = $db;
    }

    public function getGenera() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function createGenera() {
        $query = "INSERT INTO " . $this->table . " (fk_id_cultivo, fk_id_produccion) VALUES (:fk_id_cultivo, :fk_id_produccion)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(":fk_id_cultivo", $this->fk_id_cultivo);
        $stmt->bindParam(":fk_id_produccion", $this->fk_id_produccion);

        return $stmt->execute();
    }

    public function deleteGenera() {
        $query = "DELETE FROM " . $this->table . " WHERE id_genera = :id_genera";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(":id_genera", $this->id_genera);
        return $stmt->execute();
    }
}

?>
