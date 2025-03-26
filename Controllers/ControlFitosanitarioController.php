<?php
require_once ("./Config/database.php");
require_once 'Models/ControlFitosanitario.php';

class ControlFitosanitarioController {
    private $db;
    private $controlFitosanitario;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getConnection();
        $this->controlFitosanitario = new ControlFitosanitario($this->db);
    }

    // Obtener todos los controles fitosanitarios
    public function get() {
        $stmt = $this->controlFitosanitario->getControlFitosanitario();
        $controles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "código 200",
            "datos" => $controles
        ]);
    }

    // Crear un nuevo control fitosanitario
    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->fecha_control) && !empty($data->descripcion) && !empty($data->fk_id_desarrollan)) {
            $this->controlFitosanitario->fecha_control = $data->fecha_control;
            $this->controlFitosanitario->descripcion = $data->descripcion;
            $this->controlFitosanitario->fk_id_desarrollan = $data->fk_id_desarrollan;

            if ($this->controlFitosanitario->createControlFitosanitario()) {
                echo json_encode(["status" => "Control fitosanitario creado correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo crear el control fitosanitario"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

    // Eliminar un control fitosanitario por ID
    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id_control_fitosanitario)) {
            $this->controlFitosanitario->id_control_fitosanitario = $data->id_control_fitosanitario;

            if ($this->controlFitosanitario->deleteControlFitosanitario()) {
                echo json_encode(["status" => "Control fitosanitario eliminado correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo eliminar el control fitosanitario"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }
}

?>
