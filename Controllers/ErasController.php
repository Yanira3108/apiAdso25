<?php

require_once 'Models/Eras.php';

class ErasController {
    private $db;
    private $eras;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getConnection();
        $this->eras = new Eras($this->db);
    }

    // Obtener todas las eras
    public function get() {
        $stmt = $this->eras->getEras();
        $eras = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "código 200",
            "datos" => $eras
        ]);
    }

    // Crear una nueva era
    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->descripcion) && !empty($data->fk_id_lote)) {
            $this->eras->descripcion = $data->descripcion;
            $this->eras->fk_id_lote = $data->fk_id_lote;

            if ($this->eras->createEras()) {
                echo json_encode(["status" => "Era creada correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo crear la era"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

    // Eliminar una era por ID
    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id_eras)) {
            $this->eras->id_eras = $data->id_eras;

            if ($this->eras->deleteEras()) {
                echo json_encode(["status" => "Era eliminada correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo eliminar la era"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }
}

?>
