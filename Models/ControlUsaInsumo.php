<?php

class ControlUsaInsumo {
    private $connect;
    private $table = 'control_usa_insumo';

    public $id_control_usa_insumo;
    public $fk_id_insumo;
    public $fk_id_control_fitosanitario;
    public $cantidad;

    public function __construct($db) {
        $this->connect = $db;
    }

    public function getControlUsaInsumo() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function createControlUsaInsumo() {
        $query = "INSERT INTO " . $this->table . " (fk_id_insumo, fk_id_control_fitosanitario, cantidad) VALUES (:fk_id_insumo, :fk_id_control_fitosanitario, :cantidad)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(":fk_id_insumo", $this->fk_id_insumo);
        $stmt->bindParam(":fk_id_control_fitosanitario", $this->fk_id_control_fitosanitario);
        $stmt->bindParam(":cantidad", $this->cantidad);

        return $stmt->execute();
    }

    public function deleteControlUsaInsumo() {
        $query = "DELETE FROM " . $this->table . " WHERE id_control_usa_insumo = :id_control_usa_insumo";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(":id_control_usa_insumo", $this->id_control_usa_insumo);
        return $stmt->execute();
    }
}

?>
