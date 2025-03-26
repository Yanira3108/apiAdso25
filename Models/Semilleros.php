<?php

class Semilleros {
    private $connect;
    private $table = 'semilleros';

    public $id_semillero;
    public $nombre_semilla;
    public $fecha_siembra;
    public $fecha_estimada;
    public $cantidad;

    public function __construct($db) {
        $this->connect = $db;
    }

    public function getSemilleros() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function createSemilleros() {
        $query = "INSERT INTO " . $this->table . " (nombre_semilla, fecha_siembra, fecha_estimada, cantidad) VALUES (:nombre_semilla, :fecha_siembra, :fecha_estimada, :cantidad)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(":nombre_semilla", $this->nombre_semilla);
        $stmt->bindParam(":fecha_siembra", $this->fecha_siembra);
        $stmt->bindParam(":fecha_estimada", $this->fecha_estimada);
        $stmt->bindParam(":cantidad", $this->cantidad);

        return $stmt->execute();
    }

    public function deleteSemilleros() {
        $query = "DELETE FROM " . $this->table . " WHERE id_semillero = :id_semillero";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(":id_semillero", $this->id_semillero);
        return $stmt->execute();
    }
}

?>
