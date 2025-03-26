<?php

require_once('Config/dataBase.php');
require_once('Models/Venta.php');

class VentaController {
    private $db;
    private $venta;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getConnection();
        $this->venta = new Venta($this->db);
    }

    public function get() {
        $stmt = $this->venta->get();
        $ventas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "código 200",
            "datos" => $ventas
        ]);
    }

    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(["status" => "Entrada JSON no válida"]);
            return;
        }

        if (!empty($data->fk_id_produccion) && !empty($data->cantidad) && !empty($data->precio_unitario) && !empty($data->total_venta) && !empty($data->fecha_venta)) {
            $this->venta->fk_id_produccion = $data->fk_id_produccion;
            $this->venta->cantidad = $data->cantidad;
            $this->venta->precio_unitario = $data->precio_unitario;
            $this->venta->total_venta = $data->total_venta;
            $this->venta->fecha_venta = $data->fecha_venta;

            if ($this->venta->create()) {
                echo json_encode(["status" => "Venta creada correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo crear la venta"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(["status" => "Entrada JSON no válida"]);
            return;
        }

        if (!empty($data->id_venta)) {
            $this->venta->id_venta = $data->id_venta;

            if ($this->venta->delete()) {
                echo json_encode(["status" => "Venta eliminada correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo eliminar la venta"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }
}

?>
