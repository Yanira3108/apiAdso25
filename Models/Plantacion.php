<?php

class Plantacion {
    private $connect;
    private $table = 'plantacion';

    public $id_plantacion;
    public $fk_id_cultivo;
    public $fk_id_era;

    public function __construct($db) {
        $this->connect = $db;
    }

    public function getPlantacion() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function createPlantacion() {
        $query = "INSERT INTO " . $this->table . " (fk_id_cultivo, fk_id_era) VALUES (:fk_id_cultivo, :fk_id_era)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(":fk_id_cultivo", $this->fk_id_cultivo);
        $stmt->bindParam(":fk_id_era", $this->fk_id_era);

        return $stmt->execute();
    }

    public function deletePlantacion() {
        $query = "DELETE FROM " . $this->table . " WHERE id_plantacion = :id_plantacion";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(":id_plantacion", $this->id_plantacion);
        return $stmt->execute();
    }
}

?>
