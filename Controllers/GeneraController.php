<?php

require_once 'Models/Genera.php';

class GeneraController {
    private $db;
    private $genera;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getConnection();
        $this->genera = new Genera($this->db);
    }

    // Obtener todas las entradas de genera
    public function get() {
        $stmt = $this->genera->getGenera();
        $generas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "código 200",
            "datos" => $generas
        ]);
    }

    // Crear una nueva entrada de genera
    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->fk_id_cultivo) && !empty($data->fk_id_produccion)) {
            $this->genera->fk_id_cultivo = $data->fk_id_cultivo;
            $this->genera->fk_id_produccion = $data->fk_id_produccion;

            if ($this->genera->createGenera()) {
                echo json_encode(["status" => "Genera creada correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo crear la genera"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

    // Eliminar una entrada de genera por ID
    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id_genera)) {
            $this->genera->id_genera = $data->id_genera;

            if ($this->genera->deleteGenera()) {
                echo json_encode(["status" => "Genera eliminada correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo eliminar la genera"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }
}

?>
