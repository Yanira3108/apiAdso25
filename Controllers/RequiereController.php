<?php

require_once 'Models/Requiere.php';

class RequiereController {
    private $db;
    private $requiere;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getConnection();
        $this->requiere = new Requiere($this->db);
    }

    // Obtener todas las entradas de requiere
    public function get() {
        $stmt = $this->requiere->getRequiere();
        $requieres = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "código 200",
            "datos" => $requieres
        ]);
    }

    // Crear una nueva entrada de requiere
    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->fk_id_herramienta) && !empty($data->fk_id_asignacion_actividad)) {
            $this->requiere->fk_id_herramienta = $data->fk_id_herramienta;
            $this->requiere->fk_id_asignacion_actividad = $data->fk_id_asignacion_actividad;

            if ($this->requiere->createRequiere()) {
                echo json_encode(["status" => "Requiere creada correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo crear requiere"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

    // Eliminar una entrada de requiere por ID
    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id_requiere)) {
            $this->requiere->id_requiere = $data->id_requiere;

            if ($this->requiere->deleteRequiere()) {
                echo json_encode(["status" => "Requiere eliminada correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo eliminar requiere"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }
}

?>
