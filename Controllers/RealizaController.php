<?php

require_once 'Models/Realiza.php';

class RealizaController {
    private $db;
    private $realiza;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getConnection();
        $this->realiza = new Realiza($this->db);
    }

    // Obtener todas las entradas de realiza
    public function get() {
        $stmt = $this->realiza->getRealiza();
        $realiza = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "código 200",
            "datos" => $realiza
        ]);
    }

    // Crear una nueva entrada de realiza
    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->fk_id_cultivo) && !empty($data->fk_id_actividad)) {
            $this->realiza->fk_id_cultivo = $data->fk_id_cultivo;
            $this->realiza->fk_id_actividad = $data->fk_id_actividad;

            if ($this->realiza->createRealiza()) {
                echo json_encode(["status" => "Realiza creada correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo crear realiza"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

    // Eliminar una entrada de realiza por ID
    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id_realiza)) {
            $this->realiza->id_realiza = $data->id_realiza;

            if ($this->realiza->deleteRealiza()) {
                echo json_encode(["status" => "Realiza eliminada correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo eliminar realiza"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }
}

?>
