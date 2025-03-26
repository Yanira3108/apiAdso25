<?php

require_once 'Models/Residuos.php';

class ResiduosController {
    private $db;
    private $residuos;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getConnection();
        $this->residuos = new Residuos($this->db);
    }

    // Obtener todos los residuos
    public function get() {
        $stmt = $this->residuos->getResiduos();
        $residuos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "código 200",
            "datos" => $residuos
        ]);
    }

    // Crear un nuevo residuo
    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->nombre) && !empty($data->fecha) && !empty($data->descripcion) && !empty($data->fk_id_tipo_residuo) && !empty($data->fk_id_cultivo)) {
            $this->residuos->nombre = $data->nombre;
            $this->residuos->fecha = $data->fecha;
            $this->residuos->descripcion = $data->descripcion;
            $this->residuos->fk_id_tipo_residuo = $data->fk_id_tipo_residuo;
            $this->residuos->fk_id_cultivo = $data->fk_id_cultivo;

            if ($this->residuos->createResiduos()) {
                echo json_encode(["status" => "Residuo creado correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo crear el residuo"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

    // Eliminar un residuo por ID
    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id_residuo)) {
            $this->residuos->id_residuo = $data->id_residuo;

            if ($this->residuos->deleteResiduos()) {
                echo json_encode(["status" => "Residuo eliminado correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo eliminar el residuo"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }
}

?>
