<?php

class Programacion {
    private $connect;
    private $table = 'programacion';

    public $id_programacion;
    public $estado;
    public $fecha_programada;
    public $duracion;
    public $fk_id_asignacion_actividad;
    public $fk_id_calendario_lunar;

    public function __construct($db) {
        $this->connect = $db;
    }

    public function getProgramacion() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function createProgramacion() {
        $query = "INSERT INTO " . $this->table . " (estado, fecha_programada, duracion, fk_id_asignacion_actividad, fk_id_calendario_lunar) VALUES (:estado, :fecha_programada, :duracion, :fk_id_asignacion_actividad, :fk_id_calendario_lunar)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(":estado", $this->estado);
        $stmt->bindParam(":fecha_programada", $this->fecha_programada);
        $stmt->bindParam(":duracion", $this->duracion);
        $stmt->bindParam(":fk_id_asignacion_actividad", $this->fk_id_asignacion_actividad);
        $stmt->bindParam(":fk_id_calendario_lunar", $this->fk_id_calendario_lunar);

        return $stmt->execute();
    }

    public function deleteProgramacion() {
        $query = "DELETE FROM " . $this->table . " WHERE id_programacion = :id_programacion";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(":id_programacion", $this->id_programacion);
        return $stmt->execute();
    }
}

?>
