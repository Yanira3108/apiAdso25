<?php

class Notificacion {
    private $connect;
    private $table = 'notificacion';

    public $id_notificacion;
    public $titulo;
    public $mensaje;
    public $fk_id_programacion;

    public function __construct($db) {
        $this->connect = $db;
    }

    public function getNotificacion() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function createNotificacion() {
        $query = "INSERT INTO " . $this->table . " (titulo, mensaje, fk_id_programacion) VALUES (:titulo, :mensaje, :fk_id_programacion)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(":titulo", $this->titulo);
        $stmt->bindParam(":mensaje", $this->mensaje);
        $stmt->bindParam(":fk_id_programacion", $this->fk_id_programacion);

        return $stmt->execute();
    }

    public function deleteNotificacion() {
        $query = "DELETE FROM " . $this->table . " WHERE id_notificacion = :id_notificacion";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(":id_notificacion", $this->id_notificacion);
        return $stmt->execute();
    }
}

?>
