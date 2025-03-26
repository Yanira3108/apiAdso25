<?php
class User {
    private $connect;
    private $table = 'usuarios';

    public $identificacion;
    public $nombre;
    public $contrasena;
    public $email;
    public $fk_id_rol;

    public function __construct($db) {
        $this->connect = $db;
    }

    public function get() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " (identificacion,nombre,contrasena, email, fk_id_rol) VALUES (:identificacion, :nombre, :contrasena, :email, :fk_id_rol)";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(":identificacion", $this->identificacion);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":contrasena", $this->contrasena);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":fk_id_rol", $this->fk_id_rol);

        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :identificacion";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(":identificacion", $this->id);
        return $stmt->execute();
    }

}
?>
