<?php

require_once 'Models/Programacion.php';

class ProgramacionController {
    private $db;
    private $programacion;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getConnection();
        $this->programacion = new Programacion($this->db);
    }

    // Obtener todas las programaciones
    public function get() {
        $stmt = $this->programacion->getProgramacion();
        $programaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "código 200",
            "datos" => $programaciones
        ]);
    }

    // Crear una nueva programación
    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->estado) && !empty($data->fecha_programada) && !empty($data->duracion) && !empty($data->fk_id_asignacion_actividad) && !empty($data->fk_id_calendario_lunar)) {
            $this->programacion->estado = $data->estado;
            $this->programacion->fecha_programada = $data->fecha_programada;
            $this->programacion->duracion = $data->duracion;
            $this->programacion->fk_id_asignacion_actividad = $data->fk_id_asignacion_actividad;
            $this->programacion->fk_id_calendario_lunar = $data->fk_id_calendario_lunar;

            if ($this->programacion->createProgramacion()) {
                echo json_encode(["status" => "Programación creada correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo crear la programación"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

    // Eliminar una programación por ID
    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id_programacion)) {
            $this->programacion->id_programacion = $data->id_programacion;

            if ($this->programacion->deleteProgramacion()) {
                echo json_encode(["status" => "Programación eliminada correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo eliminar la programación"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }
}

?>
