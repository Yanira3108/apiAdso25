<?php

class Actividad {
    private $connect;
    private $table = 'actividad';

    public $id_actividad;
    public $nombre_actividad;
    public $descripcion;

    public function __construct($db) {
        $this->connect = $db;
    }

    public function getActividad() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function updateActividad() {
        $query = "UPDATE " . $this->table . " SET ";
        $fields = [];

        if (!empty($this->nombre_actividad)) {
            $fields[] = "nombre_actividad = :nombre_actividad";
        }
        if (!empty($this->descripcion)) {
            $fields[] = "descripcion = :descripcion";
        }

        if (empty($fields)) {
            return false; // No hay datos para actualizar
        }

        $query .= implode(", ", $fields);
        $query .= " WHERE id_actividad = :id_actividad";

        $stmt = $this->connect->prepare($query);

        if (!empty($this->nombre_actividad)) {
            $stmt->bindParam(":nombre_actividad", $this->nombre_actividad);
        }
        if (!empty($this->descripcion)) {
            $stmt->bindParam(":descripcion", $this->descripcion);
        }
        $stmt->bindParam(":id_actividad", $this->id_actividad);

        return $stmt->execute();
    }

    public function createActividad() {
        $query = "INSERT INTO " . $this->table . " (nombre_actividad, descripcion) VALUES (:nombre_actividad, :descripcion)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(":nombre_actividad", $this->nombre_actividad);
        $stmt->bindParam(":descripcion", $this->descripcion);

        return $stmt->execute();
    }

    public function deleteActividad() {
        $query = "DELETE FROM " . $this->table . " WHERE id_actividad = :id_actividad";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(":id_actividad", $this->id_actividad);
        return $stmt->execute();
    }
}

?>
