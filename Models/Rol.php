<?php

class Rol {
    private $conn;
    private $table_name = "rol";

    public $id_rol;
    public $nombre_rol;
    public $fecha_creacion;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todos los roles
    public function get() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Crear un nuevo rol
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (nombre_rol) VALUES (:nombre_rol)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":nombre_rol", $this->nombre_rol);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Eliminar un rol por su ID
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_rol = :id_rol";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":id_rol", $this->id_rol);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
