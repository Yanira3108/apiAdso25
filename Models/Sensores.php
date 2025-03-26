<?php

class Sensores {
    private $connect;
    private $table = 'sensores';

    public $id_sensor;
    public $nombre_sensor;
    public $tipo_sensor;
    public $unidad_medida;
    public $descripcion;
    public $medida_minima;
    public $medida_maxima;

    public function __construct($db) {
        $this->connect = $db;
    }

    public function getSensores() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function createSensores() {
        $query = "INSERT INTO " . $this->table . " (nombre_sensor, tipo_sensor, unidad_medida, descripcion, medida_minima, medida_maxima) VALUES (:nombre_sensor, :tipo_sensor, :unidad_medida, :descripcion, :medida_minima, :medida_maxima)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(":nombre_sensor", $this->nombre_sensor);
        $stmt->bindParam(":tipo_sensor", $this->tipo_sensor);
        $stmt->bindParam(":unidad_medida", $this->unidad_medida);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":medida_minima", $this->medida_minima);
        $stmt->bindParam(":medida_maxima", $this->medida_maxima);

        return $stmt->execute();
    }

    public function deleteSensores() {
        $query = "DELETE FROM " . $this->table . " WHERE id_sensor = :id_sensor";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(":id_sensor", $this->id_sensor);
        return $stmt->execute();
    }
}

?>
