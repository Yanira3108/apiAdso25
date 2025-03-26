<?php

class TipoCultivo {
    private $connect;
    private $table = 'tipo_cultivo';

    public $id_tipo_cultivo;
    public $nombre;
    public $descripcion;

    public function __construct($db) {
        $this->connect = $db;
    }

    public function getTipoCultivo() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function createTipoCultivo() {
        $query = "INSERT INTO " . $this->table . " (nombre, descripcion) VALUES (:nombre, :descripcion)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);

        return $stmt->execute();
    }

    public function deleteTipoCultivo() {
        $query = "DELETE FROM " . $this->table . " WHERE id_tipo_cultivo = :id_tipo_cultivo";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(":id_tipo_cultivo", $this->id_tipo_cultivo);
        return $stmt->execute();
    }
}

?>
