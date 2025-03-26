<?php

class Herramientas {
    private $connect;
    private $table = 'herramientas';

    public $id_herramienta;
    public $nombre_h;
    public $fecha_prestamo;
    public $estado;

    public function __construct($db) {
        $this->connect = $db;
    }

    public function getHerramientas() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function createHerramientas() {
        $query = "INSERT INTO " . $this->table . " (nombre_h, fecha_prestamo, estado) VALUES (:nombre_h, :fecha_prestamo, :estado)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(":nombre_h", $this->nombre_h);
        $stmt->bindParam(":fecha_prestamo", $this->fecha_prestamo);
        $stmt->bindParam(":estado", $this->estado);

        return $stmt->execute();
    }

    public function deleteHerramientas() {
        $query = "DELETE FROM " . $this->table . " WHERE id_herramienta = :id_herramienta";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(":id_herramienta", $this->id_herramienta);
        return $stmt->execute();
    }
}

?>
