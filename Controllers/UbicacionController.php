<?php

require_once 'Models/Ubicacion.php';

class UbicacionController {
    private $db;
    private $ubicacion;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getConnection();
        $this->ubicacion = new Ubicacion($this->db);
    }

    // Obtener todos las ubicaciones
    public function get() {
        $stmt = $this->ubicacion->get();
        $ubicaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "código 200",
            "datos" => $ubicaciones
        ]);
    }

    // Crear una nueva ubicacion
    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->latitud) && !empty($data->longitud)) {
            $this->ubicacion->latidud = $data->latitud;
            $this->ubicacion->longitud = $data->longitud;
       

            if ($this->ubicacion->create()) {
                echo json_encode(["status" => "Ubicacion creada correctamente"]);

            } else {
                echo json_encode(["status" => "No se pudo crear la Ubicacion"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

    // Eliminar una ubicacion por ID
    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id_ubicacion)) {
            $this->ubicacion->id_ubicacion = $data->id_ubicacion;

            if ($this->ubicacion->delete()) {
                echo json_encode(["status" => "Ubicacion eliminado correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo eliminar la Ubicacion"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }
}
?>
