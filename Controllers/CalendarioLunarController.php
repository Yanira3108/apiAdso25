<?php
require_once './Config/dataBase.php';
require_once 'Models/CalendarioLunar.php';

class CalendarioLunarController {
    private $db;
    private $calendarioLunar;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getConnection();
        $this->calendarioLunar = new CalendarioLunar($this->db);
    }

    // Obtener todas las entradas del calendario lunar
    public function get() {
        $stmt = $this->calendarioLunar->getCalendarioLunar();
        $calendarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "código 200",
            "datos" => $calendarios
        ]);
    }

    // Crear una nueva entrada en el calendario lunar
    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->fecha) && !empty($data->descripcion_evento) && !empty($data->evento)) {
            $this->calendarioLunar->fecha = $data->fecha;
            $this->calendarioLunar->descripcion_evento = $data->descripcion_evento;
            $this->calendarioLunar->evento = $data->evento;

            if ($this->calendarioLunar->createCalendarioLunar()) {
                echo json_encode(["status" => "Evento creado correctamente en el calendario lunar"]);
            } else {
                echo json_encode(["status" => "No se pudo crear el evento en el calendario lunar"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }

    // Eliminar una entrada del calendario lunar por ID
    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id_calendario_lunar)) {
            $this->calendarioLunar->id_calendario_lunar = $data->id_calendario_lunar;

            if ($this->calendarioLunar->deleteCalendarioLunar()) {
                echo json_encode(["status" => "Evento eliminado correctamente del calendario lunar"]);
            } else {
                echo json_encode(["status" => "No se pudo eliminar el evento del calendario lunar"]);
            }
        } else {
            echo json_encode(["status" => "Datos incompletos"]);
        }
    }
}

?>
