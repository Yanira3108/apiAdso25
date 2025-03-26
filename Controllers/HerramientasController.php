<?php

require_once 'Models/Herramientas.php';

class HerramientasController {
    private $db;
    private $herramientas;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getConnection();
        $this->herramientas = new Herramientas($this->db);
    }

    // Obtener todas las herramientas
    public function get() {
        $stmt = $this->herramientas->getHerramientas();
        $herramientas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "código 200",
            "datos" => $herramientas
        ]);
    }

    // Crear una nueva herramienta
    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->nombre_h) && !empty($data->fecha_prestamo) && !empty($data->estado)) {
            $this->herramientas->nombre_h = $data->nombre_h;
            $this->herramientas->fecha_prestamo = $data->fecha_prestamo;
            $this->herramientas->estado = $data->estado;

            if ($this->herramientas->createHerramientas()) {
                echo json_encode(["status" => "Herramienta creada correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo crear la herramienta"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

    // Eliminar una herramienta por ID
    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id_herramienta)) {
            $this->herramientas->id_herramienta = $data->id_herramienta;

            if ($this->herramientas->deleteHerramientas()) {
                echo json_encode(["status" => "Herramienta eliminada correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo eliminar la herramienta"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }
}

?>
