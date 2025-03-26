<?php

class Requiere {
    private $connect;
    private $table = 'requiere';

    public $id_requiere;
    public $fk_id_herramienta;
    public $fk_id_asignacion_actividad;

    public function __construct($db) {
        $this->connect = $db;
    }

    public function getRequiere() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function createRequiere() {
        $query = "INSERT INTO " . $this->table . " (fk_id_herramienta, fk_id_asignacion_actividad) VALUES (:fk_id_herramienta, :fk_id_asignacion_actividad)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(":fk_id_herramienta", $this->fk_id_herramienta);
        $stmt->bindParam(":fk_id_asignacion_actividad", $this->fk_id_asignacion_actividad);

        return $stmt->execute();
    }

    public function deleteRequiere() {
        $query = "DELETE FROM " . $this->table . " WHERE id_requiere = :id_requiere";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(":id_requiere", $this->id_requiere);
        return $stmt->execute();
    }
}

?>
