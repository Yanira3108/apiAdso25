<?php

class AsignacionActividad {
    private $connect;
    private $table = 'asignacion_actividad';

    public $id_asignacion_actividad;
    public $fecha;
    public $fk_id_actividad;
    public $fk_identificacion;

    public function __construct($db) {
        $this->connect = $db;
    }

    public function getAsignacionActividad() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function createAsignacionActividad() {
        $query = "INSERT INTO " . $this->table . " (fecha, fk_id_actividad, fk_identificacion) VALUES (:fecha, :fk_id_actividad, :fk_identificacion)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(":fecha", $this->fecha);
        $stmt->bindParam(":fk_id_actividad", $this->fk_id_actividad);
        $stmt->bindParam(":fk_identificacion", $this->fk_identificacion);

        return $stmt->execute();
    }

    public function deleteAsignacionActividad() {
        $query = "DELETE FROM " . $this->table . " WHERE id_asignacion_actividad = :id_asignacion_actividad";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(":id_asignacion_actividad", $this->id_asignacion_actividad);
        return $stmt->execute();
    }
}

?>
