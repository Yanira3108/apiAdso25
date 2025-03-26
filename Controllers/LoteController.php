<?php

require_once 'Models/Lote.php';

class LoteController {
    private $db;
    private $lote;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getConnection();
        $this->lote = new Lote($this->db);
    }

    // Obtener todos los lotes
    public function get() {
        $stmt = $this->lote->getLote();
        $lotes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "código 200",
            "datos" => $lotes
        ]);
    }

    // Crear un nuevo lote
    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->dimension) && !empty($data->nombre_lote) && !empty($data->fk_id_ubicacion) && !empty($data->estado)) {
            $this->lote->dimension = $data->dimension;
            $this->lote->nombre_lote = $data->nombre_lote;
            $this->lote->fk_id_ubicacion = $data->fk_id_ubicacion;
            $this->lote->estado = $data->estado;

            if ($this->lote->createLote()) {
                echo json_encode(["status" => "Lote creado correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo crear el lote"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

    // Eliminar un lote por ID
    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id_lote)) {
            $this->lote->id_lote = $data->id_lote;

            if ($this->lote->deleteLote()) {
                echo json_encode(["status" => "Lote eliminado correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo eliminar el lote"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }
}

?>
