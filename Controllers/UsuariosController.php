<?php

require_once('Config/dataBase.php');
require_once('Models/Usuarios.php');

class UsuariosController {
    private $db;
    private $user;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function get() {
        $stmt = $this->user->get();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "código 200",
            "datos" => $users
        ]);
    }

    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(["status" => "Entrada JSON no válida"]);
            return;
        }

        if (!empty($data->identificacion) && !empty($data->nombre) && !empty($data->contrasena) && !empty($data->email) && !empty($data->fk_id_rol)) {
            $this->user->identificacion = $data->identificacion;
            $this->user->nombre = $data->nombre;
            $this->user->contrasena = $data->contrasena;
            $this->user->email = $data->email;
            $this->user->fk_id_rol = $data->fk_id_rol;

            if ($this->user->create()) {
                echo json_encode(["status" => "Usuario creado correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo crear el usuario"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(["status" => "Entrada JSON no válida"]);
            return;
        }

        if (!empty($data->id)) {
            $this->user->id = $data->id;

            if ($this->user->delete()) {
                echo json_encode(["status" => "Usuario eliminado correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo eliminar el usuario"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
             http_response_code(405);
        }
    }
}
?>
