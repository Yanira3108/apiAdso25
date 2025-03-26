<?php
require_once ("./Config/dataBase.php");
require_once ("./Models/Actividad.php");

class ActividadController {
    private $db;
    private $actividad;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getConnection();
        $this->actividad = new Actividad($this->db);
    }

    // Obtener todas las actividades
    public function get() {
        $stmt = $this->actividad->getActividad();
        $actividades = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "código 200",
            "datos" => $actividades
        ]);
    }

    // Crear una nueva actividad
    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->nombre_actividad) && !empty($data->descripcion)) {
            $this->actividad->nombre_actividad = $data->nombre_actividad;
            $this->actividad->descripcion = $data->descripcion;

            if ($this->actividad->createActividad()) {
                echo json_encode(["status" => "Actividad creada correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo crear la actividad"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

      // Actualizar una actividad por ID
      public function update() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id_actividad)) {
            $this->actividad->id_actividad = $data->id_actividad;

            // Solo actualiza los campos que se envían en la petición
            if (!empty($data->nombre_actividad)) {
                $this->actividad->nombre_actividad = $data->nombre_actividad;
            }
            if (!empty($data->descripcion)) {
                $this->actividad->descripcion = $data->descripcion;
            }

            if ($this->actividad->updateActividad()) {
                echo json_encode(["status" => "Actividad actualizada correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo actualizar la actividad"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

    // Eliminar una actividad por ID
    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id_actividad)) {
            $this->actividad->id_actividad = $data->id_actividad;

            if ($this->actividad->deleteActividad()) {
                echo json_encode(["status" => "Actividad eliminada correctamente"]);
            } else {
                echo json_encode(["status" => "No se pudo eliminar la actividad"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }
}

?>
