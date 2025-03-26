<?php
require_once ("./Config/database.php");
require_once 'Models/Cultivo.php';

class CultivoController {
    private $db;
    private $cultivo;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getConnection();
        $this->cultivo = new Cultivo($this->db);
    }

    // Obtener todos los cultivos
    public function get() {
        $stmt = $this->cultivo->getCultivo();
        $cultivos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "código 200",
            "datos" => $cultivos
        ]);
    }

    // Crear un nuevo cultivo
    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->fecha_plantacion) && !empty($data->nombre_cultivo) && !empty($data->descripcion) && !empty($data->fk_id_especie) && !empty($data->fk_id_semillero)) {
            $this->cultivo->fecha_plantacion = $data->fecha_plantacion;
            $this->cultivo->nombre_cultivo = $data->nombre_cultivo;
            $this->cultivo->descripcion = $data->descripcion;
            $this->cultivo->fk_id_especie = $data->fk_id_especie;
            $this->cultivo->fk_id_semillero = $data->fk_id_semillero;

            if ($this->cultivo->createCultivo()) {
                echo json_encode(["status" => "Cultivo creado correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo crear el cultivo"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

    // Eliminar un cultivo por ID
    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id_cultivo)) {
            $this->cultivo->id_cultivo = $data->id_cultivo;

            if ($this->cultivo->deleteCultivo()) {
                echo json_encode(["status" => "Cultivo eliminado correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo eliminar el cultivo"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }
}

?>
