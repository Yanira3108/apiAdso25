<?php

class Realiza {
    private $connect;
    private $table = 'realiza';

    public $id_realiza;
    public $fk_id_cultivo;
    public $fk_id_actividad;

    public function __construct($db) {
        $this->connect = $db;
    }

    public function getRealiza() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function createRealiza() {
        $query = "INSERT INTO " . $this->table . " (fk_id_cultivo, fk_id_actividad) VALUES (:fk_id_cultivo, :fk_id_actividad)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(":fk_id_cultivo", $this->fk_id_cultivo);
        $stmt->bindParam(":fk_id_actividad", $this->fk_id_actividad);

        return $stmt->execute();
    }

    public function deleteRealiza() {
        $query = "DELETE FROM " . $this->table . " WHERE id_realiza = :id_realiza";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(":id_realiza", $this->id_realiza);
        return $stmt->execute();
    }
}

?>
