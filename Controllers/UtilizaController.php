<?php

require_once 'Models/Utiliza.php';

class UtilizaController {
    private $db;
    private $utiliza;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getConnection();
        $this->utiliza = new Utiliza($this->db);
    }

    // Obtener todas las entradas de utiliza
    public function get() {
        $stmt = $this->utiliza->getUtiliza();
        $utiliza = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "código 200",
            "datos" => $utiliza
        ]);
    }

    // Crear una nueva entrada de utiliza
    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->fk_id_insumo) && !empty($data->fk_id_asignacion_actividad)) {
            $this->utiliza->fk_id_insumo = $data->fk_id_insumo;
            $this->utiliza->fk_id_asignacion_actividad = $data->fk_id_asignacion_actividad;

            if ($this->utiliza->createUtiliza()) {
                echo json_encode(["status" => "Utiliza creada correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo crear utiliza"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

    // Eliminar una entrada de utiliza por ID
    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id_utiliza)) {
            $this->utiliza->id_utiliza = $data->id_utiliza;

            if ($this->utiliza->deleteUtiliza()) {
                echo json_encode(["status" => "Utiliza eliminada correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo eliminar utiliza"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }
}

?>
