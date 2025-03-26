<?php

class Insumos {
    private $connect;
    private $table = 'insumos';

    public $id_insumo;
    public $nombre;
    public $tipo;
    public $precio_unidad;
    public $cantidad;
    public $unidad_medida;

    public function __construct($db) {
        $this->connect = $db;
    }

    public function getInsumos() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function createInsumos() {
        $query = "INSERT INTO " . $this->table . " (nombre, tipo, precio_unidad, cantidad, unidad_medida) VALUES (:nombre, :tipo, :precio_unidad, :cantidad, :unidad_medida)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":tipo", $this->tipo);
        $stmt->bindParam(":precio_unidad", $this->precio_unidad);
        $stmt->bindParam(":cantidad", $this->cantidad);
        $stmt->bindParam(":unidad_medida", $this->unidad_medida);

        return $stmt->execute();
    }

    public function deleteInsumos() {
        $query = "DELETE FROM " . $this->table . " WHERE id_insumo = :id_insumo";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(":id_insumo", $this->id_insumo);
        return $stmt->execute();
    }
}

?>
