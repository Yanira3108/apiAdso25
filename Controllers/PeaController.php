<?php

require_once 'Models/Pea.php';

class PeaController {
    private $db;
    private $pea;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getConnection();
        $this->pea = new Pea($this->db);
    }

    // Obtener todos los PEAS
    public function get() {
        $stmt = $this->pea->getPea();
        $peas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "código 200",
            "datos" => $peas
        ]);
    }

    // Crear un nuevo PEA
    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->tipo) && !empty($data->nombre) && !empty($data->descripcion)) {
            $this->pea->tipo = $data->tipo;
            $this->pea->nombre = $data->nombre;
            $this->pea->descripcion = $data->descripcion;

            if ($this->pea->createPea()) {
                echo json_encode(["status" => "PEA creado correctamente"]);

            } else {
                echo json_encode(["status" => "No se pudo crear el PEA"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

    // Eliminar un PEA por ID
    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id_pea)) {
            $this->pea->id_pea = $data->id_pea;

            if ($this->pea->deletePea()) {
                echo json_encode(["status" => "PEA eliminado correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo eliminar el PEA"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }
}

?>
