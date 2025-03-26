<?php

require_once 'Models/Semilleros.php';

class SemillerosController {
    private $db;
    private $semilleros;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getConnection();
        $this->semilleros = new Semilleros($this->db);
    }

    // Obtener todos los semilleros
    public function get() {
        $stmt = $this->semilleros->getSemilleros();
        $semilleros = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "código 200",
            "datos" => $semilleros
        ]);
    }

    // Crear un nuevo semillero
    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->nombre_semilla) && !empty($data->fecha_siembra) && !empty($data->fecha_estimada) && !empty($data->cantidad)) {
            $this->semilleros->nombre_semilla = $data->nombre_semilla;
            $this->semilleros->fecha_siembra = $data->fecha_siembra;
            $this->semilleros->fecha_estimada = $data->fecha_estimada;
            $this->semilleros->cantidad = $data->cantidad;

            if ($this->semilleros->createSemilleros()) {
                echo json_encode(["status" => "Semillero creado correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo crear el semillero"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

    // Eliminar un semillero por ID
    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id_semillero)) {
            $this->semilleros->id_semillero = $data->id_semillero;

            if ($this->semilleros->deleteSemilleros()) {
                echo json_encode(["status" => "Semillero eliminado correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo eliminar el semillero"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }
}

?>
