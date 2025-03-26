<?php

class Produccion {
    private $connect;
    private $table = 'produccion';

    public $id_produccion;
    public $fk_id_cultivo;
    public $cantidad_producida;
    public $fecha_produccion;
    public $fk_id_lote;
    public $descripcion_produccion;
    public $estado;
    public $fecha_cosecha;

    public function __construct($db) {
        $this->connect = $db;
    }

    public function getProduccion() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function createProduccion() {
        $query = "INSERT INTO " . $this->table . " (fk_id_cultivo, cantidad_producida, fecha_produccion, fk_id_lote, descripcion_produccion, estado, fecha_cosecha) VALUES (:fk_id_cultivo, :cantidad_producida, :fecha_produccion, :fk_id_lote, :descripcion_produccion, :estado, :fecha_cosecha)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(":fk_id_cultivo", $this->fk_id_cultivo);
        $stmt->bindParam(":cantidad_producida", $this->cantidad_producida);
        $stmt->bindParam(":fecha_produccion", $this->fecha_produccion);
        $stmt->bindParam(":fk_id_lote", $this->fk_id_lote);
        $stmt->bindParam(":descripcion_produccion", $this->descripcion_produccion);
        $stmt->bindParam(":estado", $this->estado);
        $stmt->bindParam(":fecha_cosecha", $this->fecha_cosecha);

        return $stmt->execute();
    }

    public function deleteProduccion() {
        $query = "DELETE FROM " . $this->table . " WHERE id_produccion = :id_produccion";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(":id_produccion", $this->id_produccion);
        return $stmt->execute();
    }
}

?>
