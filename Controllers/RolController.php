<?php

require_once 'Models/Rol.php';

class RolController {
    private $db;
    private $rol;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getConnection();
        $this->rol = new Rol($this->db);
    }

    // Obtener todos los roles
    public function get() {
        $stmt = $this->rol->get();
        $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "código 200",
            "datos" => $roles
        ]);
    }

    // Crear un nuevo rol
    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->nombre_rol)) {
            $this->rol->nombre_rol = $data->nombre_rol;

            if ($this->rol->createRol()) {
                echo json_encode(["status" => "Rol creado correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo crear el rol"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

    // Eliminar un rol por ID
    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id_rol)) {
            $this->rol->id_rol = $data->id_rol;

            if ($this->rol->deleteRol()) {
                echo json_encode(["status" => "Rol eliminado correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo eliminar el rol"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }
}

?>
