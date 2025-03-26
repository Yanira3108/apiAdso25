<?php

require_once 'Models/TipoCultivo.php';

class TipoCultivoController {
    private $db;
    private $tipoCultivo;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getConnection();
        $this->tipoCultivo = new TipoCultivo($this->db);
    }

    // Obtener todos los tipos de cultivos
    public function get() {
        $stmt = $this->tipoCultivo->getTipoCultivo();
        $tiposCultivos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "código 200",
            "datos" => $tiposCultivos
        ]);
    }

    // Crear un nuevo tipo de cultivo
    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->nombre) && !empty($data->descripcion)) {
            $this->tipoCultivo->nombre = $data->nombre;
            $this->tipoCultivo->descripcion = $data->descripcion;

            if ($this->tipoCultivo->createTipoCultivo()) {
                echo json_encode(["status" => "Tipo de cultivo creado correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo crear el tipo de cultivo"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

    // Eliminar un tipo de cultivo por ID
    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id_tipo_cultivo)) {
            $this->tipoCultivo->id_tipo_cultivo = $data->id_tipo_cultivo;

            if ($this->tipoCultivo->deleteTipoCultivo()) {
                echo json_encode(["status" => "Tipo de cultivo eliminado correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo eliminar el tipo de cultivo"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }
}

?>
