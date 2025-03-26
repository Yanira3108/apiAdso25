<?php

require_once 'Models/Produccion.php';

class ProduccionController {
    private $db;
    private $produccion;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getConnection();
        $this->produccion = new Produccion($this->db);
    }

    // Obtener todas las producciones
    public function get() {
        $stmt = $this->produccion->getProduccion();
        $producciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "código 200",
            "datos" => $producciones
        ]);
    }

    // Crear una nueva producción
    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->fk_id_cultivo) && !empty($data->cantidad_producida) && !empty($data->fecha_produccion) && !empty($data->fk_id_lote) && !empty($data->descripcion_produccion) && !empty($data->estado) && !empty($data->fecha_cosecha)) {
            $this->produccion->fk_id_cultivo = $data->fk_id_cultivo;
            $this->produccion->cantidad_producida = $data->cantidad_producida;
            $this->produccion->fecha_produccion = $data->fecha_produccion;
            $this->produccion->fk_id_lote = $data->fk_id_lote;
            $this->produccion->descripcion_produccion = $data->descripcion_produccion;
            $this->produccion->estado = $data->estado;
            $this->produccion->fecha_cosecha = $data->fecha_cosecha;

            if ($this->produccion->createProduccion()) {
                echo json_encode(["status" => "Producción creada correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo crear la producción"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

    // Eliminar una producción por ID
    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id_produccion)) {
            $this->produccion->id_produccion = $data->id_produccion;

            if ($this->produccion->deleteProduccion()) {
                echo json_encode(["status" => "Producción eliminada correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo eliminar la producción"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }
}

?>
