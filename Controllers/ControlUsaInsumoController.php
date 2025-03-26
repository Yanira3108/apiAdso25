<?php
require_once ("./Config/database.php");
require_once 'Models/ControlUsaInsumo.php';

class ControlUsaInsumoController {
    private $db;
    private $controlUsaInsumo;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getConnection();
        $this->controlUsaInsumo = new ControlUsaInsumo($this->db);
    }

    // Obtener todos los registros de control usa insumo
    public function get() {
        $stmt = $this->controlUsaInsumo->getControlUsaInsumo();
        $controles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "código 200",
            "datos" => $controles
        ]);
    }

    // Crear un nuevo registro de control usa insumo
    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->fk_id_insumo) && !empty($data->fk_id_control_fitosanitario) && !empty($data->cantidad)) {
            $this->controlUsaInsumo->fk_id_insumo = $data->fk_id_insumo;
            $this->controlUsaInsumo->fk_id_control_fitosanitario = $data->fk_id_control_fitosanitario;
            $this->controlUsaInsumo->cantidad = $data->cantidad;

            if ($this->controlUsaInsumo->createControlUsaInsumo()) {
                echo json_encode(["status" => "Registro creado correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo crear el registro"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

    // Eliminar un registro de control usa insumo por ID
    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id_control_usa_insumo)) {
            $this->controlUsaInsumo->id_control_usa_insumo = $data->id_control_usa_insumo;

            if ($this->controlUsaInsumo->deleteControlUsaInsumo()) {
                echo json_encode(["status" => "Registro eliminado correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo eliminar el registro"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }
}

?>
