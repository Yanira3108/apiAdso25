<?php

require_once 'Models/Plantacion.php';

class PlantacionController {
    private $db;
    private $plantacion;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getConnection();
        $this->plantacion = new Plantacion($this->db);
    }

    // Obtener todos los PEAS
    public function get() {
        $stmt = $this->plantacion->getPlantacion();
        $plantaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "código 200",
            "datos" => $plantaciones
        ]);
    }

    // Crear una nueva plantacin
    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->fk_id_cultivo) && !empty($data->fk_id_era)) {
            $this->plantacion->fk_id_cultivo = $data->fk_id_cultivo;
            $this->plantacion->fk_id_era = $data->fk_id_era;
          

            if ($this->plantacion->createPlantacion()) {
                echo json_encode(["status" => "Plantacion creada correctamente"]);

            } else {
                echo json_encode(["status" => "No se pudo crear la plantacion"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

    // Eliminar una Plantacion por ID
    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id_plantacion)) {
            $this->plantacion->id_plantacion = $data->id_plantacion;

            if ($this->plantacion->deletePlantacion()) {
                echo json_encode(["status" => "Plantacion eliminado correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo eliminar la Plantacion"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }
}

?>
