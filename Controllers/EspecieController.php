<?php

require_once 'Models/Especie.php';

class EspecieController {
    private $db;
    private $especie;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getConnection();
        $this->especie = new Especie($this->db);
    }

    // Obtener todas las especies
    public function get() {
        $stmt = $this->especie->getEspecie();
        $especies = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "código 200",
            "datos" => $especies
        ]);
    }

    // Crear una nueva especie
    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->nombre_comun) && !empty($data->nombre_cientifico) && !empty($data->descripcion) && !empty($data->fk_id_tipo_cultivo)) {
            $this->especie->nombre_comun = $data->nombre_comun;
            $this->especie->nombre_cientifico = $data->nombre_cientifico;
            $this->especie->descripcion = $data->descripcion;
            $this->especie->fk_id_tipo_cultivo = $data->fk_id_tipo_cultivo;

            if ($this->especie->createEspecie()) {
                echo json_encode(["status" => "Especie creada correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo crear la especie"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

    // Eliminar una especie por ID
    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id_especie)) {
            $this->especie->id_especie = $data->id_especie;

            if ($this->especie->deleteEspecie()) {
                echo json_encode(["status" => "Especie eliminada correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo eliminar la especie"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }
}

?>
