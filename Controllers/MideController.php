<?php

require_once 'Models/Mide.php';

class MideController {
    private $db;
    private $mide;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getConnection();
        $this->mide = new Mide($this->db);
    }

    // Obtener todas las entradas de mide
    public function get() {
        $stmt = $this->mide->getMide();
        $medidas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "código 200",
            "datos" => $medidas
        ]);
    }

    // Crear una nueva entrada de mide
    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->fk_id_sensor) && !empty($data->fk_id_era)) {
            $this->mide->fk_id_sensor = $data->fk_id_sensor;
            $this->mide->fk_id_era = $data->fk_id_era;

            if ($this->mide->createMide()) {
                echo json_encode(["status" => "Mide creada correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo crear mide"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

    // Eliminar una entrada de mide por ID
    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id_mide)) {
            $this->mide->id_mide = $data->id_mide;

            if ($this->mide->deleteMide()) {
                echo json_encode(["status" => "Mide eliminada correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo eliminar mide"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }
}

?>
