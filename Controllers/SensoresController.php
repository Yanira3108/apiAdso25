<?php

require_once 'Models/Sensores.php';

class SensoresController {
    private $db;
    private $sensores;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getConnection();
        $this->sensores = new Sensores($this->db);
    }

    // Obtener todos los sensores
    public function get() {
        $stmt = $this->sensores->getSensores();
        $sensores = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "código 200",
            "datos" => $sensores
        ]);
    }

    // Crear un nuevo sensor
    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->nombre_sensor) && !empty($data->tipo_sensor) && !empty($data->unidad_medida) && !empty($data->descripcion) && !empty($data->medida_minima) && !empty($data->medida_maxima)) {
            $this->sensores->nombre_sensor = $data->nombre_sensor;
            $this->sensores->tipo_sensor = $data->tipo_sensor;
            $this->sensores->unidad_medida = $data->unidad_medida;
            $this->sensores->descripcion = $data->descripcion;
            $this->sensores->medida_minima = $data->medida_minima;
            $this->sensores->medida_maxima = $data->medida_maxima;

            if ($this->sensores->createSensores()) {
                echo json_encode(["status" => "Sensor creado correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo crear el sensor"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

    // Eliminar un sensor por ID
    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id_sensor)) {
            $this->sensores->id_sensor = $data->id_sensor;

            if ($this->sensores->deleteSensores()) {
                echo json_encode(["status" => "Sensor eliminado correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo eliminar el sensor"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }
}

?>
