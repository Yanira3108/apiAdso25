<?php

require_once 'Models/TipoResiduos.php';

class TipoResiduosController {
    private $db;
    private $tipoResiduos;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getConnection();
        $this->tipoResiduos = new TipoResiduos($this->db);
    }

    // Obtener todos los tipos de residuos
    public function get() {
        $stmt = $this->tipoResiduos->getTipoResiduos();
        $tiposResiduos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "código 200",
            "datos" => $tiposResiduos
        ]);
    }

    // Crear un nuevo tipo de residuo
    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->nombre_residuo) && !empty($data->descripcion)) {
            $this->tipoResiduos->nombre_residuo = $data->nombre_residuo;
            $this->tipoResiduos->descripcion = $data->descripcion;

            if ($this->tipoResiduos->createTipoResiduos()) {
                echo json_encode(["status" => "Tipo de residuo creado correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo crear el tipo de residuo"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

    // Eliminar un tipo de residuo por ID
    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id_tipo_residuo)) {
            $this->tipoResiduos->id_tipo_residuo = $data->id_tipo_residuo;

            if ($this->tipoResiduos->deleteTipoResiduos()) {
                echo json_encode(["status" => "Tipo de residuo eliminado correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo eliminar el tipo de residuo"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }
}

?>
