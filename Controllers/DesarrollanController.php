<?php

require_once 'Models/Desarrollan.php';

class DesarrollanController {
    private $db;
    private $desarrollan;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getConnection();
        $this->desarrollan = new Desarrollan($this->db);
    }

    // Obtener todos los registros de desarrollan
    public function get() {
        $stmt = $this->desarrollan->getDesarrollan();
        $desarrollan = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "código 200",
            "datos" => $desarrollan
        ]);
    }

    // Crear un nuevo registro de desarrollan
    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->fk_id_cultivo) && !empty($data->fk_id_pea)) {
            $this->desarrollan->fk_id_cultivo = $data->fk_id_cultivo;
            $this->desarrollan->fk_id_pea = $data->fk_id_pea;

            if ($this->desarrollan->createDesarrollan()) {
                echo json_encode(["status" => "Registro creado correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo crear el registro"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

    // Eliminar un registro de desarrollan por ID
    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id_desarrollan)) {
            $this->desarrollan->id_desarrollan = $data->id_desarrollan;

            if ($this->desarrollan->deleteDesarrollan()) {
                echo json_encode(["status" => "Registro eliminado correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo eliminar el registro"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }
}

?>
