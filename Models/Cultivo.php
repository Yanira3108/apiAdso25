<?php

class Cultivo {
    private $connect;
    private $table = 'cultivo';

    public $id_cultivo;
    public $fecha_plantacion;
    public $nombre_cultivo;
    public $descripcion;
    public $fk_id_especie;
    public $fk_id_semillero;

    public function __construct($db) {
        $this->connect = $db;
    }

    public function getCultivo() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function createCultivo() {
        $query = "INSERT INTO " . $this->table . " (fecha_plantacion, nombre_cultivo, descripcion, fk_id_especie, fk_id_semillero) VALUES (:fecha_plantacion, :nombre_cultivo, :descripcion, :fk_id_especie, :fk_id_semillero)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(":fecha_plantacion", $this->fecha_plantacion);
        $stmt->bindParam(":nombre_cultivo", $this->nombre_cultivo);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":fk_id_especie", $this->fk_id_especie);
        $stmt->bindParam(":fk_id_semillero", $this->fk_id_semillero);

        return $stmt->execute();
    }

    public function deleteCultivo() {
        $query = "DELETE FROM " . $this->table . " WHERE id_cultivo = :id_cultivo";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(":id_cultivo", $this->id_cultivo);
        return $stmt->execute();
    }
}

?>
