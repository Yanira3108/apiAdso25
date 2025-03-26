<?php
require_once ("./Config/database.php");
require_once ("./Models/AsignacionActividad.php");

class AsignacionActividadController {
    private $db;
    private $asignacionActividad;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getConnection();
        $this->asignacionActividad = new AsignacionActividad($this->db);
    }

    // Obtener todas las asignaciones de actividad
    public function get() {
        $stmt = $this->asignacionActividad->getAsignacionActividad();
        $asignaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "código 200",
            "datos" => $asignaciones
        ]);
    }

    // Crear una nueva asignación de actividad
    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->fecha) && !empty($data->fk_id_actividad) && !empty($data->fk_identificacion)) {
            $this->asignacionActividad->fecha = $data->fecha;
            $this->asignacionActividad->fk_id_actividad = $data->fk_id_actividad;
            $this->asignacionActividad->fk_identificacion = $data->fk_identificacion;

            if ($this->asignacionActividad->createAsignacionActividad()) {
                echo json_encode(["status" => "Asignación de actividad creada correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo crear la asignación de actividad"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

    // Eliminar una asignación de actividad por ID
    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id_asignacion_actividad)) {
            $this->asignacionActividad->id_asignacion_actividad = $data->id_asignacion_actividad;

            if ($this->asignacionActividad->deleteAsignacionActividad()) {
                echo json_encode(["status" => "Asignación de actividad eliminada correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo eliminar la asignación de actividad"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }
}

?>
