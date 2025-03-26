<?php

class Utiliza {
    private $connect;
    private $table = 'utiliza';

    public $id_utiliza;
    public $fk_id_insumo;
    public $fk_id_asignacion_actividad;

    public function __construct($db) {
        $this->connect = $db;
    }

    public function getUtiliza() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function createUtiliza() {
        $query = "INSERT INTO " . $this->table . " (fk_id_insumo, fk_id_asignacion_actividad) VALUES (:fk_id_insumo, :fk_id_asignacion_actividad)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(":fk_id_insumo", $this->fk_id_insumo);
        $stmt->bindParam(":fk_id_asignacion_actividad", $this->fk_id_asignacion_actividad);

        return $stmt->execute();
    }

    public function deleteUtiliza() {
        $query = "DELETE FROM " . $this->table . " WHERE id_utiliza = :id_utiliza";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(":id_utiliza", $this->id_utiliza);
        return $stmt->execute();
    }
}

?>
