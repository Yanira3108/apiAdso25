<?php

class CalendarioLunar {
    private $connect;
    private $table = 'calendario_lunar';

    public $id_calendario_lunar;
    public $fecha;
    public $descripcion_evento;
    public $evento;

    public function __construct($db) {
        $this->connect = $db;
    }

    public function getCalendarioLunar() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function createCalendarioLunar() {
        $query = "INSERT INTO " . $this->table . " (fecha, descripcion_evento, evento) VALUES (:fecha, :descripcion_evento, :evento)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(":fecha", $this->fecha);
        $stmt->bindParam(":descripcion_evento", $this->descripcion_evento);
        $stmt->bindParam(":evento", $this->evento);

        return $stmt->execute();
    }

    public function deleteCalendarioLunar() {
        $query = "DELETE FROM " . $this->table . " WHERE id_calendario_lunar = :id_calendario_lunar";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(":id_calendario_lunar", $this->id_calendario_lunar);
        return $stmt->execute();
    }
}

?>
