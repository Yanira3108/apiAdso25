<?php

class ControlFitosanitario {
    private $connect;
    private $table = 'control_fitosanitario';

    public $id_control_fitosanitario;
    public $fecha_control;
    public $descripcion;
    public $fk_id_desarrollan;

    public function __construct($db) {
        $this->connect = $db;
    }

    public function getControlFitosanitario() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function createControlFitosanitario() {
        $query = "INSERT INTO " . $this->table . " (fecha_control, descripcion, fk_id_desarrollan) VALUES (:fecha_control, :descripcion, :fk_id_desarrollan)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(":fecha_control", $this->fecha_control);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":fk_id_desarrollan", $this->fk_id_desarrollan);

        return $stmt->execute();
    }

    public function deleteControlFitosanitario() {
        $query = "DELETE FROM " . $this->table . " WHERE id_control_fitosanitario = :id_control_fitosanitario";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(":id_control_fitosanitario", $this->id_control_fitosanitario);
        return $stmt->execute();
    }
}

?>
