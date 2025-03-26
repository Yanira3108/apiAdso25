<?php

require_once 'Models/Insumos.php';

class InsumosController {
    private $db;
    private $insumos;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getConnection();
        $this->insumos = new Insumos($this->db);
    }

    // Obtener todos los insumos
    public function get() {
        $stmt = $this->insumos->getInsumos();
        $insumos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "código 200",
            "datos" => $insumos
        ]);
    }

    // Crear un nuevo insumo
    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->nombre) && !empty($data->tipo) && !empty($data->precio_unidad) && !empty($data->cantidad) && !empty($data->unidad_medida)) {
            $this->insumos->nombre = $data->nombre;
            $this->insumos->tipo = $data->tipo;
            $this->insumos->precio_unidad = $data->precio_unidad;
            $this->insumos->cantidad = $data->cantidad;
            $this->insumos->unidad_medida = $data->unidad_medida;

            if ($this->insumos->createInsumos()) {
                echo json_encode(["status" => "Insumo creado correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo crear el insumo"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

    // Eliminar un insumo por ID
    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id_insumo)) {
            $this->insumos->id_insumo = $data->id_insumo;

            if ($this->insumos->deleteInsumos()) {
                echo json_encode(["status" => "Insumo eliminado correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo eliminar el insumo"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }
}

?>
